<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Artist_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
    }

    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('artist');
        $this->db->where('artist_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    function artistList()
    {
        $this->db->select('*');
        $this->db->from('artist');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert($data)
    {
        $save = $this->db->insert('artist', $data);

        if ($save) {
            return true;
        } else {
            return false;
        }

    }

    public function update($data)
    {
        $this->db->where('artist_id', $data['artist_id']);
        $this->db->update('artist', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $this->db->where('artist_id', $id);
        $this->db->delete('artist');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
