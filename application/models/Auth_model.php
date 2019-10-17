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

    public function detail($id)
    {
        $this->db->from('users');
        $this->db->where('Id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    function get($username)
    {
        $query = $this->db->where('Name', $username)->get('users');
        return $query->row_array();
    }

    public function listData()
    {
        $this->db->select('*');
        $this->db->order_by('Id', 'ASC');
        $this->db->from('users');
        $query = $this->db->get();

        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
            if ($dt['Type'] == 1) {
                $this->db->where('ID_Partner', $dt['Source_Id']);
                $query = $this->db->get('partner');
                $office = $query->row_array()['Nama'];
            } else if ($dt['Type'] == 2) {
                $this->db->join('outlet', 'outlet.ID_Outlet = manager.Outlet_Id');
                $this->db->join('partner', 'partner.ID_Partner = outlet.Partner_Id');
                $this->db->select('partner.Nama');
                $this->db->where('Id_Manager', $dt['Source_Id']);
                $query = $this->db->get('manager');
                $office = $query->row_array()['Nama'];
            } else if ($dt['Type'] == 3) {
                $office = "Customer";
            } else {
                $office = "Administrator";
            }
            $dt['Office'] = $office;
            $result[] = $dt;
        }

        return $result;
    }

    public function LoginCheck($username, $password, $type = 'web')
    {
        $cek = $this->get($username);
        $result['Status'] = 'error';
        if ($cek) {
            if (password_verify($password, $cek['Password'])) {
                // Aktif
                if ($cek['Status'] != 13) {
                    if ($type == 'mobile') {
                        $this->db->join('customer', 'users.Source_Id = customer.Id_Customer');
                        $this->db->select('users.*,customer.nama Cust_Name, customer.telp');
                        $this->db->from('users');
                        $this->db->where('Id', $cek['Id']);
                        $query = $this->db->get();

                        $result['Data'] = $query->row_array();
                    } else {
                        if ($cek['Type'] == 1) {
                            $this->db->join('partner', 'users.Source_Id = partner.ID_Partner');
                            $this->db->select('users.*, partner.Nama User_Name, partner.Logo Picture');
                        } else if ($cek['Type'] == 2) {
                            $this->db->join('manager', 'users.Source_Id = manager.Id_Manager');
                            $this->db->select('users.*, manager.Nama User_Name, manager.Photo Picture');
                        } else if ($cek['Type'] == 3) {
                            $this->db->join('customer', 'users.Source_Id = customer.Id_Customer');
                            $this->db->select('users.*, customer.Nama User_Name, customer.Photo Picture');
                        } else {
                            $this->db->select('users.*, users.Name User_Name, users.Source_Id Picture');
                        }
                        $this->db->from('users');
                        $this->db->where('Id', $cek['Id']);
                        $query = $this->db->get();

                        $result['Data'] = $query->row_array();

                        // set session
                        $_SESSION['Account']['Id'] = $result['Data']['Id'];
                        $_SESSION['Account']['Name'] = $result['Data']['User_Name'];
                        $_SESSION['Account']['Type'] = $result['Data']['Type'];
                        $_SESSION['Account']['Status'] = $result['Data']['Status'];
                        $_SESSION['Account']['Picture'] = $result['Data']['Picture'];
                        $_SESSION['Account']['created_at'] = $result['Data']['created_at'];
                    }

                    $result['Status'] = 'success';
                    $result['Msg'] = 'Login berhasil';
                } // Belum confirm email
                else if ($cek['Status'] == -1) {
                    $result['Msg'] = 'Email belum dikonfirmasi. Silahkan cek email anda.';
                } //
                else if ($cek['Status'] == 13) {
                    $result['Msg'] = 'Akun anda telah dibekukan.';
                }
            } else {
                $result['Msg'] = 'Username atau password tidak sesuai.';
            }
        } else {
            $result['Msg'] = 'Username atau password tidak sesuai.';
        }

        return $result;
    }

    public function register($dt, $type = 'Customer')
    {

        if ($type == 'Customer') {
            $id = $this->General_model->getNoUrut('customer', 'Id_Customer', 'CS');
        } else {
            $id = $this->General_model->getNoUrut('manager', 'Id_Manager', 'MGR');
        }

        $data = array(
            'Name'       => $dt['username'],
            'Email'      => $dt['email'],
            'Password'   => password_hash($dt['password'], PASSWORD_DEFAULT),
            'Type'       => $dt['type'],
            'Source_Id'  => $id,
            'Status'     => 0,
            'Token'      => $dt['token'],
            'created_at' => date("Y-m-d H:i:s")
        );
        $save = $this->db->insert('users', $data);

        if ($save) {
            if ($type == 'Customer') {
                $data2 = array(
                    'Id_Customer' => $id,
                    'Nama'        => $dt['fullname'],
                    'Telp'        => $dt['phone'],
                    'Saldo'       => 10000
                );
                $saveSource = $this->db->insert('customer', $data2);
            } else {
                $data2 = array(
                    'Id_Manager' => $id,
                    'Nama'       => $dt['fullname'],
                    'Telp'       => $dt['phone'],
                    'Photo'      => $dt['photo'],
                    'Outlet_Id'  => $dt['outlet_id']
                );
                $saveSource = $this->db->insert('manager', $data2);
            }

            if ($saveSource) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
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

    public function delete($Id)
    {
        $query = $this->detail($Id);

        if ($query) {
            $this->db->where('Id_Customer', $query['Source_Id']);
            $delCustomer = $this->db->delete('customer');

            if ($delCustomer) {

                $this->db->where('Id', $Id);
                $save = $this->db->delete('users');

				if ($save) {
					$result = ['Status' => 'success', 'Msg' => 'Data Berhasil Dihapus'];
				} else {
					$result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
				}
				return $result;
            }
        }
    }

    public function getNewcomers()
    {
        $this->db->where('Type', 3);
        $this->db->where('created_at >', date("Y-m") . "-01 00:00:00");
        $this->db->where('created_at <', date("Y-m-t", strtotime(date("Y-m-d"))) . " 23:59:59");
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function getNewpartners(){
    	$this->db->where('Type', 1);
    	$this->db->where('created_at >', date("Y-m") . "-01 00:00:00");
    	$this->db->where('created_at <', date("Y-m-t", strtotime(date("Y-m-d"))) . " 23:59:59");
    	$this->db->from('users');
    	return $this->db->count_all_results();
	}

	public function getTopup(){
    	$this->db->where('Status', 2);
		$this->db->where('Tgl_Transaksi >', date("Y-m") . "-01 00:00:00");
		$this->db->where('Tgl_Transaksi <', date("Y-m-t", strtotime(date("Y-m-d"))) . " 23:59:59");
    	$this->db->from('topup');
    	return $this->db->count_all_results();
	}
}
