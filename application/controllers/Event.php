<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

//        $this->load->model(array('Event_model', 'General_model'));
        if ($this->session->userdata('username')) {
            $this->load->model(array('Event_model', 'General_model'));
        } else {
            redirect(base_url('/'));
        }
    }

    public function index()
    {
        $vars['header'] = '';
        $vars['View'] = 'event/list';
        $vars['data'] = $this->Event_model->getData();
//        $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
        $vars['JScript'] = '';
        $this->load->view('theme/layout', $vars);
    }

    public function add()
    {
        $vars['header'] = '';
        $vars['View'] = 'event/add';
        $vars['artists'] = $this->General_model->getData('artist');
        $vars['JScript'] = base_url('assets/dist/js/Event.js');
        $this->load->view('theme/layout', $vars);
    }

    public function save()
    {
        /*echo "<pre>";
        print_r($sch);*/
        $this->load->library('upload');
        if ($_FILES['poster']['error'] != 4) {
            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2000;
//            $config['file_name'] = time() . '-' . $_FILES['poster']['name'];
            $config['file_name'] = $_FILES['poster']['name'];
            $this->upload->initialize($config, TRUE);

            if (!$this->upload->do_upload('poster')) {
                $this->session->set_flashdata('warning', 'Gagal upload gambar');
                redirect(base_url('event/add'));
            } else {
                $tgl = explode(" - ", $_POST['tanggal']);
                $str = str_replace("Rp ", "", $this->input->post('htm'));
                $data = [
                    'event_name'  => $this->input->post('event_name'),
                    'location'    => $this->input->post('location'),
                    'date_start'  => convertDate($tgl[0], 'dbEn'),
                    'date_end'    => convertDate($tgl[1], 'dbEn'),
                    'date_create' => date("Y-m-d H:i:s"),
                    'author'      => $this->session->userdata('username'),
                    'htm'         => str_replace(".", "", $str),
                    'poster'      => $config['file_name'],
                ];

//                $result = $this->Event_model->add($data);
                $this->db->insert('events', $data);
                $event_id = $this->db->insert_id();

                $sch = [];
                for ($i = 0; $i < count($_POST['artist_id']); $i++) {
                    $sch[] = array(
                        'event_id'    => $event_id,
                        'show_time'   => $_POST['show'][$i],
                        'artist_id'   => $_POST['artist_id'][$i],
                        'date_create' => date("Y-m-d H:i:s"),
                        'user_id'     => 1,
                    );
                }

                $this->db->insert_batch('schedule', $sch);

                $this->load->library('Sendnotif', 'sendnotif');
                $this->sendnotif->sendAll('Wartajazz - Info', $this->input->post('event_name') . ' di ' . $this->input->post('location'));

                $this->session->set_flashdata('sukses', 'Berhasil menambahkan event');
                redirect(base_url('event'));
            }
        } else {
            $this->session->set_flashdata('warning', 'Harap pilih foto');
            redirect(base_url('event/add'));
        }
    }

    public function detail($id)
    {
        $vars['header'] = '';
        $vars['View'] = 'event/detail';
        $vars['data'] = $this->Event_model->detail($id);
        $vars['JScript'] = '';

        if ($vars['data'] != null) {
            $this->load->view('theme/layout', $vars);
        } else {
            redirect(base_url('event'));
        }
    }

    public function edit($id)
    {
        $vars['header'] = '';
        $vars['View'] = 'event/edit';
        $vars['JScript'] = base_url('assets/dist/js/updateEvent.js');
        $vars['data'] = $this->Event_model->detail($id);
        $vars['artists'] = $this->General_model->getData('artist');

        /*echo "<pre>";
        print_r($vars['data']);*/
        if ($vars['data'] != null) {
            $this->load->view('theme/layout', $vars);
        } else {
            redirect(base_url('event'));
        }
    }

    public function update()
    {
        /*echo $this->input->post('tanggal');
        $tgl = explode(" - ", $this->input->post('tanggal'));
        print_r($tgl);*/


        $tgl = explode(" - ", $this->input->post('tanggal'));
        $str = str_replace("Rp ", "", $this->input->post('htm'));
        $event = [
            'event_id'    => $this->input->post('event_id'),
            'event_name'  => $this->input->post('event_name'),
            'location'    => $this->input->post('location'),
            'date_start'  => convertDate($tgl[0], 'dbEn'),
            'date_end'    => convertDate($tgl[1], 'dbEn'),
            'date_create' => date("Y-m-d H:i:s"),
            'author'      => $this->session->userdata('username'),
            'htm'         => str_replace(".", "", $str),
        ];

        $sch = [];
        for ($i = 0; $i < count($_POST['artist_id']); $i++) {
            $sch[] = array(
                'event_id'    => $this->input->post('event_id'),
                'show_time'   => $_POST['show'][$i],
                'artist_id'   => $_POST['artist_id'][$i],
                'date_create' => date("Y-m-d H:i:s"),
                'user_id'     => 1,
            );
        }

        if ($_FILES['poster']['error'] != 4) {
            $this->load->library('upload');

            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2000;
//            $config['file_name'] = time() . '-' . $_FILES['poster']['name'];
            $config['file_name'] = $_FILES['poster']['name'];
            $this->upload->initialize($config, TRUE);

            if (!$this->upload->do_upload('poster')) {
                $this->session->set_flashdata('warning', 'Gagal upload gambar');
                redirect(base_url('event/edit/') . $event['event_id']);
            } else {
                $event['poster'] = $config['file_name'];
            }
        }

        $result = $this->Event_model->update($event);

        if ($result) {
            //reschedule event
            $this->db->insert_batch('schedule', $sch);
            $this->session->set_flashdata('sukses', 'Event berhasil diubah');
            redirect(base_url('event'));
        } else {
            $this->session->set_flashdata('warning', 'Event gagal diubah');
            redirect(base_url('event/edit/') . $event['event_id']);
        }
    }

    public function modalDelete($id)
    {
        $data = $this->Event_model->detail($id);
        $vars['data'] = "Event <strong>" . $data['event_name'] . ' </strong>';
        $this->load->view('modals/modal-delete', $vars);
    }

    public function delete($id)
    {
        $result = $this->Event_model->delete($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
