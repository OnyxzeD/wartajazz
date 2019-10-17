<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include 'Middleware.php';

class Partner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Partner_model');
        $this->load->model('Bank_model');
        $this->load->model('General_model');
        $this->load->library('MY_Library');
    }

    function upload_ktp()
    {
        $config['upload_path'] = './assets/landing/img/identitas';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['file_name'] = strtolower($this->input->post('pemilik')) . '-' . date("YmdHis");
        $this->upload->initialize($config, TRUE);

        if (!$this->upload->do_upload('foto_identitas')) {
            $result = ['Status' => 'error', 'data' => $this->upload->display_errors()];
        } else {
            $result = ['Status' => 'success', 'data' => $this->upload->data()];
        }
        return $result;
    }

    function upload_rekening()
    {
        $config['upload_path'] = './assets/landing/img/rekening';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['file_name'] = strtolower($this->input->post('pemilik')) . '-' . date("YmdHis");
        $this->upload->initialize($config, TRUE);

        if (!$this->upload->do_upload('foto_rekening')) {
            $result = ['Status' => 'error', 'data' => $this->upload->display_errors()];
        } else {
            $result = ['Status' => 'success', 'data' => $this->upload->data()];
        }
        return $result;
    }

    public function index()
    {
        $vars['header'] = 'Partner';
        $vars['View'] = 'Admin/Partner/index';
        $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
        $vars['Data'] = $this->Partner_model->listData();
        $vars['bank'] = $this->Bank_model->get_all_bank();
        $this->load->view('Admin/layout', $vars);
    }

    public function Join()
    {
        $this->load->library('upload');

        if ($_FILES['foto_rekening']['error'] != 4) {
            $identitas = $this->upload_ktp();
            if ($identitas['Status'] == 'success') {
                $_POST['file_identitas'] = 'assets/landing/img/identitas/' . $identitas['data']['file_name'];
                $rekening = $this->upload_rekening();
                if ($rekening['Status'] == 'success') {
                    $_POST['file_rekening'] = 'assets/landing/img/rekening/' . $rekening['data']['file_name'];
                    $random = $this->General_model->randomPassword();
                    $activation_code = $this->General_model->activationCode();
                    $_POST['random_pswd'] = $random;
                    $_POST['activation_code'] = $activation_code;

                    $save = $this->Partner_model->Register();
                    if ($save) {
                        $name = str_replace(' ', '-', strtolower($_POST['pemilik']));
                        $url = "http://tempatin.id/manage/confirm/" . $name . '/' . $activation_code . '/1';
                        $data['user'] = [
                            'name'     => $name,
                            'password' => $random,
                            'link'     => $url
                        ];
                        $email = $this->my_library->sendEmail($_POST['email_pemilik'], 'Pendaftaran Berhasil', $data);
                        if ($email) {
                            redirect(base_url('/'));
                        }
                    } else {
                        redirect(base_url('/register'));
                    }
                } else {
                    print_r($rekening);
                }
            } else {
                print_r($identitas);
            }
        }
    }

    public function modalDetail($id)
    {
        $vars['data'] = $this->Partner_model->getDetail($id);
        $dt = explode(" ", $vars['data']['created_at']);
        $expDate = date_create($dt[0]);
        date_add($expDate, date_interval_create_from_date_string("61 days"));
        $vars['expDate'] = date_format($expDate, "Y-m-d");
        $this->load->view('Admin/Partner/modal-detail', $vars);
    }

    public function modalEdit($id)
    {
        $vars['data'] = $this->Partner_model->getDetail($id);
        $vars['bank'] = $this->Bank_model->get_all_bank();
        $this->load->view('Admin/Partner/modal-entry', $vars);
    }

    public function edit($id)
    {
        $result = $this->Partner_model->update($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalDelete($id)
    {
        $data = $this->Partner_model->getDetail($id);
        $vars['data'] = "Partner " . $data['Nama'];
        $this->load->view('modals/modal-delete', $vars);
    }

    public function delete($id)
    {
        $result = $this->Partner_model->delete($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
