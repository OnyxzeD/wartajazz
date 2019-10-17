<?php

class Wilayah_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_provinsi()
    {
        $this->db->select('*');
        $this->db->from('wilayah_provinsi');
        $query = $this->db->get();

        return $query->result();
    }

    function getKabupatenByProv($prov_id)
    {
        // show kota with selected prov
        $this->db->select('*');
        $this->db->where('provinsi_id', $prov_id);
        $query = $this->db->get('wilayah_kabupaten');
        $result = $query->result_array();

        return $result;
    }
}
