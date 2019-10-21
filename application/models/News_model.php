<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class News_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
    }

    public function detail($url)
    {
        $this->db->join('user_bio', 'news.author = user_bio.username');
        $this->db->select('news.*, user_bio.fullname');
        $this->db->from('news');
        $this->db->where('url', $url);
        $query = $this->db->get();

        return $query->row_array();
    }

    function getData()
    {
        $this->db->join('user_bio', 'news.author = user_bio.username');
        $this->db->select('news.*, user_bio.fullname');
        $this->db->from('news');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add($data)
    {
        $save = $this->db->insert('news', $data);

        if ($save) {
            return true;
        } else {
            return false;
        }

    }

    public function update($data)
    {
        $this->db->where('url', $data['url']);
        $this->db->update('news', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function delete($url)
    {
        $this->db->where('url', $url);
        $this->db->delete('news');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
