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

    public function detail($id)
    {
        $this->db->where('event_id', $id);
        $query = $this->db->get('events');

        $event = $query->row_array();
        if ($event['poster'] != null) {
            $event['poster'] = base_url() . 'assets/images/' . $event['poster'];
        } else {
            $event['poster'] = base_url() . "assets/images/flyer.png";
        }

        $this->db->join('schedule', 'events.event_id = schedule.event_id');
        $this->db->join('artist', 'artist.artist_id = schedule.artist_id');
        $this->db->select('events.event_id, schedule.show_time, artist.artist_name, artist.country_of_origin');
        $this->db->from('events');
        $this->db->where('events.event_id', $id);
        $this->db->order_by('event_id', 'ASC');
        $this->db->order_by('show_time', 'ASC');
        $query = $this->db->get();

        // reformat data
        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
            $result[] = $dt;
        }
        $event['details'] = $result;

        return $event;
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

    public function delete($id)
    {
        $this->db->where('event_id', $id);
        $this->db->delete('schedule');

        if ($this->db->affected_rows() > 0) {
            $this->db->where('event_id', $id);
            $this->db->delete('events');

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
            $dt['date_start'] = convertDate($dt['date_start'], 'indo2');
            $dt['date_end'] = convertDate($dt['date_end'], 'indo2');
            $dt['htm'] = 'Rp ' . number_format($dt['htm'], 0, ".", ".");

            if ($dt['poster'] != null) {
                $dt['poster'] = base_url() . 'assets/images/' . $dt['poster'];
            } else {
                $dt['poster'] = base_url() . "assets/images/flyer.png";
            }

            $this->db->join('schedule', 'events.event_id = schedule.event_id');
            $this->db->join('artist', 'artist.artist_id = schedule.artist_id');
            $this->db->select('events.event_id, schedule.show_time, artist.artist_name, artist.country_of_origin');
            $this->db->from('events');
            $this->db->where('events.event_id', $dt['event_id']);
            $this->db->order_by('event_id', 'ASC');
            $this->db->order_by('show_time', 'ASC');
            $query2 = $this->db->get();

            // reformat data
            $details = [];
            $detail = $query2->result_array();
            foreach ($detail as $d) {
                $details[] = $d;
            }
            $dt['details'] = $details;

            $result[] = $dt;
        }

        return $result;
    }

    public function jsonDetail($id)
    {
        $this->db->where('event_id', $id);
        $query = $this->db->get('events');

        $event = $query->row_array();
        $event['date_start'] = convertDate($event['date_start'], 'indo');
        $event['date_end'] = convertDate($event['date_end'], 'indo');
        $event['htm'] = 'Rp ' . number_format($event['htm'], 0, ".", ".");
        if ($event['poster'] != null) {
            $event['poster'] = base_url() . 'assets/images/' . $event['poster'];
        } else {
            $event['poster'] = base_url() . "assets/images/flyer.png";
        }

        $this->db->join('schedule', 'events.event_id = schedule.event_id');
        $this->db->join('artist', 'artist.artist_id = schedule.artist_id');
        $this->db->select('events.event_id, schedule.show_time, artist.artist_name, artist.country_of_origin');
        $this->db->from('events');
        $this->db->where('events.event_id', $id);
        $this->db->order_by('event_id', 'ASC');
        $this->db->order_by('show_time', 'ASC');
        $query = $this->db->get();

        // reformat data
        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
            $result[] = $dt;
        }
        $event['details'] = $result;

        return $event;
    }
}
