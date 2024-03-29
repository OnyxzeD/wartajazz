<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Auth_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
    }

    public function detail($username)
    {
        $this->db->join('user_bio', 'users.username = user_bio.username');
        $this->db->select('users.*, user_bio.*');
        $this->db->from('users');
        $this->db->where('users.username', $username);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get($username)
    {
        $query = $this->db->where('username', $username)->get('users');
        return $query->row_array();
    }

    public function LoginCheck($username, $password, $type = 'web', $token = null)
    {
        $cek = $this->get($username);
        $result['error'] = true;

        if ($cek) {
            if (password_verify($password, $cek['password'])) {

                if ($type == 'mobile') {
                    $this->db->set('token', $token);
                    $this->db->where('username', $username);
                    $this->db->update('users');
                }

                $this->db->join('user_bio', 'users.username = user_bio.username');
                $this->db->select('users.*, user_bio.*');
                $this->db->from('users');
                $this->db->where('users.username', $cek['username']);
                $query = $this->db->get();

                $result['error'] = false;
                $result['msg'] = 'Welcome';
                $result['data'] = $query->row_array();
                // set session
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('level', $result['data']['role_id']);
                $this->session->set_userdata('name', $result['data']['fullname']);
                $this->session->set_userdata('join_date', $result['data']['join_date']);
            } else {
                $result['msg'] = 'Username atau password tidak sesuai.';
                $result['data'] = null;
            }
        } else {
            $result['msg'] = 'Username tidak ditemukan.';
            $result['data'] = null;
        }

        return $result;
    }

    public function register($data, $role = 2)
    {
        $data_user = array(
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role_id'  => $role,
            'status'   => 1
        );

        $save = $this->db->insert('users', $data_user);

        if ($save) {
            $data_bio = array(
                'username'     => $data['username'],
                'fullname'     => $data['fullname'],
                'phone_number' => $data['phone_number'],
                'address'      => $data['address'],
                'join_date'    => date("Y-m-d H:i:s")
            );

            if ($role > 2) {
                $data_bio['provider_id'] = $data['provider_id'];
                $data_bio['thumbnail'] = $data['thumbnail'];
            }
            $save_bio = $this->db->insert('user_bio', $data_bio);

            if ($save_bio) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function update($data)
    {
        $result = ['error' => true, 'message' => 'Proses Gagal'];

        $this->db->set('role_id', $data['role_id']);
        $this->db->set('email', $data['email']);
        if ($data['password'] != null || $data['password'] != '') {
            $this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
        }
        $this->db->where('username', $data['username']);
        $this->db->update('users');

        $this->db->set('fullname', $data['fullname']);
        $this->db->where('username', $data['username']);
        $this->db->update('user_bio');

        if ($this->db->affected_rows() > 0) {
            $result = ['error' => false, 'message' => 'Data Berhasil Diubah'];
        }

        return $result;
    }

    public function edit($data)
    {
        $result = ['error' => true, 'message' => 'Proses Gagal'];
        if ($data['password'] != null || $data['password'] != '') {
            $this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
            $this->db->where('username', $data['username']);
            $this->db->update('users');
        }

        $this->db->set('fullname', $data['fullname']);
        $this->db->set('phone_number', $data['phone_number']);
        $this->db->set('address', $data['address']);
        $this->db->where('username', $data['username']);
        $this->db->update('user_bio');

        if ($this->db->affected_rows() > 0) {
            $result = ['error' => false, 'message' => 'Data Berhasil Diubah'];
        }

        return $result;
    }

    public function checkAccount($user, $activation)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('Name', $user);
        $this->db->where('Token', $activation);
        $this->db->where('Status', 0);
        $query = $this->db->get();

        $result = $query->row_array();
        if (count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function activate($id, $type = null)
    {
        if ($type != null) {
            // aktif, tapi belum bayar
            $this->db->set('Status', 2);
        } else {
            $this->db->set('Status', 1);
        }
        $this->db->where('Id', $id);
        $this->db->update('users');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPass($data)
    {
        $this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->where('email', $data['email']);
        $this->db->update('users');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($username)
    {
        $this->db->join('user_bio', 'users.username = user_bio.username');
        $this->db->where_in('username', $username);
        $this->db->delete(array('users', 'user_bio'));

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function googleAuth($providerId, $email, $displayName, $thumb, $token)
    {
        $name = $dt = explode(" ", $displayName);
        $this->db->join('user_bio', 'users.username = user_bio.username');
        $this->db->where('users.email', $email);
        $this->db->where('users.username', strtolower($name[0]));
        $query = $this->db->get('users');
        $dataUser = $query->row_array();

        if ($dataUser == null) {
            $data = [
                'username'     => strtolower($name[0]),
                'password'     => "google",
                'email'        => $email,
                'fullname'     => $displayName,
                'phone_number' => "-",
                'type'         => 3,
                'address'      => "-",
                'provider_id'  => $providerId,
                'thumbnail'    => $thumb
            ];
            $register = $this->register($data, 3);
            if ($register) {
                return $this->LoginCheck(strtolower($name[0]), 'google', 'mobile', $token);
            }
        } else {
            $this->db->set('thumbnail', $thumb);
            $this->db->where('username', $dataUser['username']);
            $this->db->update('user_bio');
        }

        $result = [
            'error'   => false,
            'message' => 'Google login succeeded',
            'data'    => $dataUser
        ];

        return $result;
    }

    public function userList($type = 'all')
    {
        $this->db->join('user_bio', 'users.username = user_bio.username');
        $this->db->join('role', 'users.role_id = role.role_id');
        $this->db->select('users.*, user_bio.*, role.role_name');
        $this->db->from('users');
        if ($type == 'mobile') {
            $this->db->where('users.role_id >=', 2);
        } else {
            $this->db->where('users.role_id <>', 0);
        }
        $this->db->order_by('users.username', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllToken()
    {
        $this->db->select('users.token');
        $this->db->from('users');
        $this->db->where('users.role_id >=', 2);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function updateToken($data)
    {
        $result = ['error' => true, 'message' => 'Proses Gagal'];
        $this->db->set('token', $data['token']);
        $this->db->where('username', $data['username']);
        $this->db->update('users');

        if ($this->db->affected_rows() > 0) {
            $result = ['error' => false, 'message' => 'Token Updated'];
        }

        return $result;
    }

    function getMonthly()
    {
        $this->db->from('user_bio');
        $this->db->where("DATE_FORMAT(join_date,'%Y-%m')", date("Y-m"));
//        $query = $this->db->get();
        return $this->db->count_all_results();
    }
}
