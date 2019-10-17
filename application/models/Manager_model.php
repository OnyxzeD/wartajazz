<?php

class Manager_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_Model');
    }

    function validate($act = '')
    {
        // load validation
        $this->load->library('form_validation');
        // Validation
        $this->form_validation->set_rules('manager-phone', 'No Telpon', 'numeric|required|max_length[12]',
            array(
                'required'   => 'No Telpon Wajib Diisi',
                'numeric'    => 'No Telpon hanya bisa diisi dengan angka',
                'max_length' => 'No Telpon tidak valid',
            ));
    }

    public function listData($partner = null)
    {
        if (is_null($partner)) {
            $partner = $_SESSION['Account']['Source_Id'];
        }

        $this->db->where('Partner_Id', $partner);
        $this->db->select('ID_Outlet');
        $this->db->from('outlet');
        $subQuery = $this->db->get_compiled_select();

        $this->db->join('users', 'manager.Id_Manager = users.Source_Id');
        $this->db->join('outlet', 'outlet.ID_Outlet = manager.Outlet_Id');
        $this->db->select('manager.*, users.Email, outlet.Nama Outlet_Nama');
        $this->db->where("Outlet_Id IN ($subQuery)", NULL, FALSE);
        $this->db->order_by('Nama', 'ASC');
        $this->db->from('manager');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getOutlet($partner = null, $condition = null)
    {
        if (is_null($partner)) {
            $partner = $_SESSION['Account']['Source_Id'];
        }

        $this->db->join('outlet', 'outlet.ID_Outlet = manager.Outlet_Id');
        $this->db->where('outlet.Partner_Id', $partner);
        $this->db->select('manager.Outlet_Id');
        $this->db->from('manager');
        $subQuery = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->where('Partner_Id', $partner);
        if ($condition == null) {
            $this->db->where("ID_Outlet NOT IN ($subQuery)", NULL, FALSE);
        }
        $this->db->order_by('Nama', 'ASC');
        $this->db->from('outlet');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getDetail($Id)
    {
        $this->db->join('users', 'users.Source_Id = manager.Id_Manager');
        $this->db->select(
            'users.Email, users.Name,users.Password, manager.*'
        );
        $this->db->where('manager.Id_Manager', $Id);
        $query = $this->db->get('manager');
        $result = $query->row_array();

        return $result;
    }

    public function update($id)
    {
//		 validasi inputan
        $this->validate();
        // jika inputan salah
        if ($this->form_validation->run() == FALSE) {
            $result = ['Status' => 'error', 'Msg' => $this->form_validation->validation_errors_remaster()];
        } else {
            $this->db->set('Nama', $_POST['manager-fullname']);
            $this->db->set('Telp', $_POST['manager-phone']);
            $this->db->set('Outlet_Id', $_POST['outlet-id']);
            $this->db->where('Id_Manager', $id);
            $save = $this->db->update('manager');

            if ($save) {
                $this->db->set('Name', $_POST['manager-username']);
                $this->db->set('Email', $_POST['manager-email']);
                $this->db->where('Source_id', $id);
                $saveSource = $this->db->update('users');

                if ($saveSource) {
                    $result = ['Status' => 'success', 'Msg' => 'Data Berhasil Di Ubah'];
                } else {
                    $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
                }
                return $result;
            }
        }
    }

    public function delete($Id)
    {
        $this->db->where('Id_Manager', $Id);
        $save = $this->db->delete('manager');

        if ($save) {
            $this->db->where('Source_id', $Id);
            $saveSource = $this->db->delete('users');

            if ($saveSource) {
                $result = ['Status' => 'success', 'Msg' => 'Data Berhasil Dihapus'];
            } else {
                $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
            }
            return $result;
        }

    }
}
