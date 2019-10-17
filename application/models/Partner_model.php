<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Partner_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
    }

    function validate($act = '')
    {
        // load validation
        $this->load->library('form_validation');
        // Validation
        $this->form_validation->set_rules('telp_pemilik', 'No Telpon', 'numeric|required|max_length[12]',
            array(
                'required'   => 'No Telpon Wajib Diisi',
                'numeric'    => 'No Telpon hanya bisa diisi dengan angka',
                'max_length' => 'No Telpon tidak valid',
            ));
    }

    public function getDetail($Id)
    {
        $this->db->join('bank', 'partner.Kode_Bank = bank.kode');
        $this->db->join('users', 'partner.ID_Partner = users.Source_Id');
        $this->db->select('partner.*,bank.nama Bank_Nama,users.created_at');
        $this->db->where('ID_Partner', $Id);
        $query = $this->db->get('partner');
        $result = $query->row_array();

        return $result;
    }

    public function listData()
    {
        $this->db->join('bank', 'partner.Kode_Bank = bank.kode');
        $this->db->join('users', 'partner.ID_Partner = users.Source_Id');
        $this->db->select('partner.*,bank.nama Bank_Nama,users.created_at');
        $this->db->order_by('ID_Partner', 'ASC');
        $this->db->from('partner');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function apiList($type = 'resto')
    {
        $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = partner.KabKot_Id');
        $this->db->select('partner.ID_Partner,partner.Nama,wilayah_kabupaten.nama Kota,partner.Alamat,partner.Rating,partner.Logo');
        if ($type == 'resto') {
            $this->db->where('Jenis_Tempat', 'rt');
        } else {
            $this->db->where('Jenis_Tempat', 'cf');
        }
        $this->db->order_by('ID_Partner', 'ASC');
        $this->db->from('partner');
        $query = $this->db->get();

        // reformat data
        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
//            $host = gethostbyname(gethostname());
//            $dt['Img'] = 'http://' . $host . '/tempat.in/' . $dt['Logo'];
            $dt['Img'] = "http://tempatin.000webhostapp.com/" . $dt['Logo'];
            unset($dt['Logo']);
            $result[] = $dt;
        }

        return $result;
    }

    public function Register()
    {
        $this->load->model('Outlet_model');
        $id = $this->General_model->getNoUrut('partner', 'ID_Partner', 'PT');
        $data = array(
            'ID_Partner'       => $id,
            'Nama'             => $_POST['pemilik'],
            'Bentuk'           => $_POST['badan_usaha'],
            'Jenis_Tempat'     => $_POST['kategori'],
            'Telp'             => $_POST['telp_pemilik'],
            'Provinsi_Id'      => $_POST['prov_pemilik'],
            'Kabkot_Id'        => $_POST['kabkot_pemilik'],
            'Alamat'           => $_POST['alamat_pemilik'],
            'Jenis_Identitas'  => $_POST['identitas_pemilik'],
            'Kode_Bank'        => $_POST['bank'],
            'Rekening'         => $_POST['no_rekening'],
            'Pemilik_Rekening' => $_POST['an_rekening'],
            'File_Identitas'   => $_POST['file_identitas'],
            'File_Rekening'    => $_POST['file_rekening'],
            'No_Identitas'     => $_POST['nomor_identitas']
        );
        $save = $this->db->insert('partner', $data);

        if ($save) {
            for ($i = 1; $i <= $_POST['jumlah-outlet']; $i++) {
                $outlet_id = $this->Outlet_model->getCode($id);
                $data = array(
                    'ID_Outlet'     => $outlet_id,
                    'Partner_Id'    => $id,
                    'Nama'          => $_POST['outlet-nama-' . $i],
                    'Alamat'        => 'default',
                    'Telp'          => $_POST['outlet-telp-' . $i],
                    'Berdiri_Sejak' => date("Y-m-d")
                );
                $this->db->insert('outlet', $data);
            }

            $user = array(
                'Name'       => str_replace(' ', '-', strtolower($_POST['pemilik'])),
                'Email'      => $_POST['email_pemilik'],
                'Type'       => 1,
                'Source_Id'  => $id,
                'Password'   => password_hash($_POST['random_pswd'], PASSWORD_DEFAULT),
                'Status'     => 0,
                'Token'      => $_POST['activation_code'],
                'created_at' => date("Y-m-d H:i:s")
            );
            $save_user = $this->db->insert('users', $user);

            if ($save_user) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($id)
    {
        // validasi inputan
        $this->validate();
        // jika inputan salah
        if ($this->form_validation->run() == FALSE) {
            $result = ['Status' => 'error', 'Msg' => $this->form_validation->validation_errors_remaster()];
        } else {
            $this->db->set('Nama', $_POST['pemilik']);
            $this->db->set('Bentuk', $_POST['badan_usaha']);
            $this->db->set('Jenis_Tempat', $_POST['kategori']);
            $this->db->set('Telp', $_POST['telp_pemilik']);
            $this->db->set('Alamat', $_POST['alamat_pemilik']);
            $this->db->set('Kode_Bank', $_POST['bank_kode']);
            $this->db->set('Rekening', $_POST['no_rekening']);
            $this->db->set('Pemilik_Rekening', $_POST['pemilik_rekening']);
            $this->db->where('ID_Partner', $id);
            $this->db->update('partner');
            if ($this->db->affected_rows() > 0) {
                $result = ['Status' => 'success', 'Msg' => 'Data Outlet Berhasil Diubah'];
            } else {
                $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
            }
        }

        return $result;
    }

    function delete($Id)
    {
        $this->db->where('ID_Partner', $Id);
        $this->db->delete('partner');
        if ($this->db->affected_rows() > 0) {
            $result = ['Status' => 'success', 'Msg' => 'Data Berhasil Dihapus'];
        } else {
            $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
        }

        return $result;
    }
}
