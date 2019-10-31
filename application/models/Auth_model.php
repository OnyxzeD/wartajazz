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

    public function LoginCheck($username, $password, $type = 'web', $token)
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
        // validasi inputan
//        $this->validate();
        // jika inputan salah
        /*if ($this->form_validation->run() == FALSE) {
            $result = ['Status' => 'error', 'Msg' => $this->form_validation->validation_errors_remaster()];
        } else {*/
        $this->db->set('role_id', $data['role_id']);
        $this->db->set('email', $data['email']);
        if ($data['password'] != null || $data['password'] != '') {
            $this->db->set('password', password_hash($data['password'], PASSWORD_DEFAULT));
        }
        $this->db->where('username', $data['username']);
        $this->db->update('users');

        $result = ['error' => true, 'message' => 'Proses Gagal'];
        if ($this->db->affected_rows() > 0) {

            $this->db->set('fullname', $data['fullname']);
            $this->db->set('phone_number', $data['phone_number']);
            $this->db->set('address', $data['address']);
            $this->db->set('thumbnail', $data['thumbnail']);
            $this->db->set('provider_id', $data['provider_id']);
            $this->db->set('device_token', $data['device_token']);
            $this->db->where('username', $data['username']);
            $this->db->update('user_bio');

            $result = ['error' => false, 'message' => 'Data Berhasil Diubah'];
        }
//        }

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

    public function changePass()
    {
        $id = $_POST['id'];
        $current = $_POST['currentpassword'];
        $new = $_POST['newpassword'];
        $query = $this->detail($id);
        if (password_verify($current, $query['Password']) == true) {
            $this->db->set(array('Password' => password_hash($new, PASSWORD_DEFAULT)));
            $this->db->where('Id', $id);
            $this->db->update('users');

            if ($this->db->affected_rows() > 0) {
                return "changed";
            } else {
                return "error";
            }
        } else {
            return "mismatch";
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

    public function googleAuth($providerId, $email, $displayName, $thumb)
    {
        $this->db->join('user_bio', 'users.username = user_bio.username');
        $this->db->where('users.email', $email);
        $this->db->where('user_bio.provider_id', $providerId);
        $query = $this->db->get('users');
        $data = $query->row_array();

        if ($data == null) {
            $name = $dt = explode(" ", $displayName);
            $data = [
                'username'     => strtolower($name[0]),
                'password'     => "-",
                'email'        => $email,
                'fullname'     => $displayName,
                'phone_number' => "-",
                'address'      => "-",
                'provider_id'  => $providerId,
                'thumbnail'    => $thumb
            ];
            $register = $this->register($data, 3);
            if ($register) {
                return $this->login(strtolower($name[0]), '-');
            }
        }

        $result = [
            'error'   => false,
            'message' => 'Login succeeded',
            'user'    => [
                'user_id'      => (int)$data['user_id'],
                'email'        => $data['email'],
                'fullname'     => $displayName,
                'phone_number' => $data['phone_number'],
                'join_date'    => convertDate($data['join_date'], 'indo'),
                'role'         => (int)$data['role_id'],
                'thumbnail'    => $data['thumbnail']
            ]

        ];

        return $result;
    }

    public function userList()
    {
        $this->db->join('user_bio', 'users.username = user_bio.username');
        $this->db->join('role', 'users.role_id = role.role_id');
        $this->db->select('users.*, user_bio.*, role.role_name');
        $this->db->from('users');
        $this->db->where('users.role_id <>', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllToken()
    {
        $this->db->select('users.token');
        $this->db->from('users');
        $query = $this->db->get();

        return $query->result_array();
    }
}
