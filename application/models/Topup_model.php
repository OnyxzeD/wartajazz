<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Topup_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
    }

    public function getDetail($Id)
    {
        $this->db->join('customer', 'topup.Id_Customer = customer.Id_Customer');
        $this->db->select('topup.*, customer.Nama');
        $this->db->where('Id_Topup', $Id);
        $query = $this->db->get('topup');
        $result = $query->row_array();

        return $result;
    }

    public function listData()
    {
        $this->db->join('customer', 'topup.Id_Customer = customer.Id_Customer');
        $this->db->select('topup.*, customer.Nama');
        $this->db->from('topup');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function topup($data)
    {
        $id = $this->General_model->getNoUrut('topup', 'Id_Topup', 'TOP');
        $rand = rand(101, 909);
        $nominal = (int)filter_var($data['nominal'], FILTER_SANITIZE_NUMBER_INT);
        $jumlah = $nominal + $rand;
        $data = array(
            'Id_Topup'      => $id,
            'Id_Customer'   => $data['customer_id'],
            'Nominal'       => $nominal,
            'Tgl_Transaksi' => date("Y-m-d H:i:s"),
            'Code'          => $rand,
            'Status'        => 0
        );
        $save = $this->db->insert('topup', $data);
        if ($save) {
            $result = ['error' => false, 'Id_Topup' => $id, 'Jumlah' => convertRupiah($jumlah)];
        } else {
            $result = ['error' => true, 'message' => 'Something Gone Wrong'];
        }

        return $result;
    }

    public function confirm($data)
    {
        $this->db->set('Status', 2);
        $this->db->set('Photo', $data['bukti']);
        $this->db->set('confirmed_at', date("Y-m-d H:i:s"));
        $this->db->where('Id_Topup', $data['id']);
        $this->db->update('topup');
        if ($this->db->affected_rows() > 0) {
            $result = ['error' => false, 'message' => 'Upload berhasil, silahkan tunggu verifikasi'];
        } else {
            $result = ['error' => true, 'message' => 'Upload Gagal'];
        }

        return $result;
    }

    public function verify($id)
    {
        $this->db->set('Status', 1);
        $this->db->set('verified_at', date("Y-m-d H:i:s"));
        $this->db->where('Id_Topup', $id);
        $this->db->update('topup');
        if ($this->db->affected_rows() > 0) {
            $cust = $this->getDetail($id);
            $this->db->where('Id_Customer', $cust['Id_Customer']);
            $query = $this->db->get('customer');
            $data = $query->row_array();

            $this->db->set('Saldo', (int)$data['Saldo'] + (int)$cust['Nominal']);
            $this->db->where('Id_Customer', $data['Id_Customer']);
            $this->db->update('customer');

            $result = ['Status' => 'success', 'Msg' => 'Transaksi berhasil diverifikasi'];
        } else {
            $result = ['Status' => 'error', 'Msg' => 'Verifikasi Gagal'];
        }

        return $result;
    }

    public function reject($id)
    {
        $this->db->set('Status', 3);
        $this->db->set('verified_at', date("Y-m-d H:i:s"));
        $this->db->where('Id_Topup', $id);
        $this->db->update('topup');
        if ($this->db->affected_rows() > 0) {
            $result = ['Status' => 'success', 'Msg' => 'Transaksi berhasil ditolak'];
        } else {
            $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
        }

        return $result;
    }
}
