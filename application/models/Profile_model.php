<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listDataPartner($partner = null)
    {
        if (is_null($partner)) {
            $partner = $_SESSION['Account']['Source_Id'];
        }

        $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = partner.Kabkot_Id');
        $this->db->join('wilayah_provinsi', 'wilayah_provinsi.id = partner.Provinsi_Id');
        // $this->db->join('bank', 'bank.kode = partner.Kode_Bank');
        $this->db->select('*');
        $this->db->where('ID_Partner', $partner);
        $this->db->from('partner');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function listDataOutlet($partner = null)
    {
        if (is_null($partner)) {
            $partner = $_SESSION['Account']['Source_Id'];
        }
        $this->db->select('*');
        $this->db->where('Partner_Id', $partner);
        $this->db->order_by('Nama', 'ASC');
        $this->db->from('outlet');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function listDataUser($partner = null)
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
}
