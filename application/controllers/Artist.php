<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username')) {
            $this->load->model(array('Artist_model', 'General_model'));
        } else {
            redirect(base_url('/'));
        }
    }

    public function index()
    {
        $vars['header'] = 'Artist';
        $vars['View'] = 'artist/list';
        $vars['data'] = $this->Artist_model->artistList();
        $vars['JScript'] = base_url('assets/dist/js/User.js');
        $this->load->view('theme/layout', $vars);
    }

    public function modalCreate()
    {
//        $vars['roles'] = $this->General_model->getData('role', array('role_id <>' => 0));
        $this->load->view('artist/modal-entry');
    }

    public function create()
    {
        $data = [
            'artist_name'       => $this->input->post('artist_name'),
            'country_of_origin' => $this->input->post('country_of_origin'),
            'artist_detail'     => $this->input->post('artist_detail'),
            'date_create'       => date("Y-m-d H:i:s")
        ];

        $this->load->library('form_validation');

        $this->form_validation->set_rules('artist_name', 'Nama Artist / Group', 'required|is_unique[artist.artist_name]',
            array(
                'required'  => '%s Harus diisi.',
                'is_unique' => '%s sudah ada.'
            ));
        $this->form_validation->set_rules('country_of_origin', 'Asal', 'required|min_length[3]');
        $this->form_validation->set_rules('artist_detail', 'Detail', 'required');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                'error'   => true,
                'message' => $this->form_validation->validation_errors_remaster()
            ];
        } else {
            $save = $this->Artist_model->insert($data);
            if ($save) {
                $result = [
                    'error'   => false,
                    'message' => 'success'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalEdit($id)
    {
        $vars['data'] = $this->Artist_model->detail($id);
        $this->load->view('artist/modal-entry', $vars);
    }

    public function edit()
    {
        $data = [
            'artist_id'         => $this->input->post('id'),
            'artist_name'       => $this->input->post('artist_name'),
            'country_of_origin' => $this->input->post('country_of_origin'),
            'artist_detail'     => $this->input->post('artist_detail')
        ];
        $result = $this->Artist_model->update($data);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalDelete($id)
    {
        $data = $this->Artist_model->detail($id);
        $vars['data'] = "Artist / Group <strong> " . $data['artist_name'] . ' </strong>';
        $this->load->view('modals/modal-delete', $vars);
    }

    public function delete($id)
    {
        $result = $this->Artist_model->delete($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
