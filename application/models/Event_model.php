<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Event_model extends CI_Model
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
        $this->db->join('user_bio', 'events.author = user_bio.username');
        $this->db->select('events.*, user_bio.fullname');
        $this->db->from('events');
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

    public function jsonData()
    {
        $this->db->select('events.*');
        $this->db->from('events');
        $this->db->order_by('event_id', 'ASC');
        $query = $this->db->get();

        // reformat data
        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
            if ($dt['poster'] != null) {
                $dt['poster'] = base_url() . '/'.$dt['poster'];
            } else {
                $dt['poster'] = base_url() . "assets/dist/img/flyer.png";
            }
            $result[] = $dt;
        }

        return $result;
    }

    public function jsonDetail($id)
    {
        $this->db->join('schedule', 'events.event_id = schedule.event_id');
        $this->db->join('artist', 'artist.artist_id = schedule.artist_id');
        $this->db->select('events.*, schedule.show_time, artist.artist_name, artist.country_of_origin');
        $this->db->from('events');
        $this->db->where('events.event_id', $id);
        $this->db->order_by('event_id', 'ASC');
        $this->db->order_by('show_time', 'ASC');
        $query = $this->db->get();

        // reformat data
        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
            if ($dt['poster'] != null) {
                $dt['poster'] = base_url() . '/'.$dt['poster'];
            } else {
                $dt['poster'] = base_url() . "assets/dist/img/flyer.png";
            }
            $result[] = $dt;
        }

        return $result;
    }
}
