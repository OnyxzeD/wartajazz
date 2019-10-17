<?php
/**
 * Created by PhpStorm.
 * User: - ASUS -
 * Date: 12/26/2018
 * Time: 10:38 AM
 */

class Reservasi_model extends CI_Model
{

    protected $host;

    public function __construct()
    {
        parent::__construct();
        $this->host = "http://tempatin.000webhostapp.com/";
//        $this->host = 'http://' . gethostbyname(gethostname()) . '/tempat.in/';
        $this->load->model('General_model');
    }

    public function getDetail($kode_booking)
    {
        $query = $this->db->where('Id_Reservasi', $kode_booking)->get('reservasi');
        return $query->row_array();
    }

    public function listData()
    {
        $this->db->join('outlet', 'reservasi.Outlet_Id = outlet.ID_Outlet');
        $this->db->join('customer', 'reservasi.Customer_Id = customer.Id_Customer');
        $this->db->join('manager', 'manager.Outlet_Id = outlet.ID_Outlet');
        $this->db->join('users', 'users.Source_Id = manager.Id_Manager');
        $this->db->select('reservasi.*, outlet.nama Outlet_Nama, customer.Nama Cust_Nama');
        $this->db->order_by('Id_Reservasi', 'ASC');
        $this->db->where('users.Id', $_SESSION['Account']['Id']);
        $this->db->from('reservasi');
        $query = $this->db->get();

        return $query->result_array();
    }

    function reserveCheck($customer_id)
    {
        $this->db->join('outlet', 'reservasi.Outlet_Id = outlet.ID_Outlet');
        $this->db->where('Customer_Id', $customer_id);
        $this->db->where('reservasi.Status', 0);
        $this->db->order_by('created_at', 'DESC');
        $this->db->select('reservasi.*,outlet.Nama Outlet_Nama');
        $query = $this->db->get('reservasi');
        $result = $query->row_array();

        return $result;
    }

    function getSaldo($customer_id)
    {
        $this->db->where('Id_Customer', $customer_id);
        $query = $this->db->get('customer');
        $result = $query->row_array();

        return $result['Saldo'];
    }

    public function apiList($user_id)
    {
        $this->db->join('users', 'users.Source_Id = reservasi.Customer_Id');
        $this->db->join('outlet', 'outlet.ID_Outlet = reservasi.Outlet_Id');
        $this->db->where('users.Id', $user_id);
        $this->db->where('reservasi.Status', 1);
        $this->db->select('reservasi.*, outlet.Nama Outlet_Nama');
        $this->db->order_by('created_at', 'DESC');
        $this->db->from('reservasi');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function activeList($user_id)
    {
        $this->db->join('users', 'users.Source_Id = customer.Id_Customer');
        $this->db->where('users.Id', $user_id);
        $this->db->from('customer');
        $query = $this->db->get();
        $customer = $query->row_array();

        $this->db->join('outlet', 'outlet.ID_Outlet = reservasi.Outlet_Id');
        $this->db->where('Customer_Id', $customer['Id_Customer']);
        $this->db->where('Status', 0);
        $this->db->select('reservasi.*, outlet.Nama Outlet_Nama, outlet.Alamat Outlet_Alamat, outlet.Thumbnail');
        $this->db->order_by('created_at', 'DESC');
        $this->db->from('reservasi');
        $query = $this->db->get();
        $reservation = $query->row_array();

        if ($reservation['Thumbnail'] != null) {
            $thumbnail = $this->host . $reservation['Thumbnail'];
        } else {
            $thumbnail = $this->host . 'assets/landing/img/partners/thumb.jpg';
        }

        $status = ['Aktif', 'Hadir', 'Tidak Hadir'];
        if ($reservation) {
            return [
                "Saldo"         => convertRupiah($customer['Saldo']),
                "Kode_Booking"  => $reservation['Id_Reservasi'],
                "Thumbnail"     => $thumbnail,
                "Outlet_Nama"   => $reservation['Outlet_Nama'],
                "Outlet_Alamat" => $reservation['Outlet_Alamat'],
                "Waktu"         => convertDate($reservation['created_at'], 'indo'),
                "Orang"         => $reservation['Orang'],
                "Status"        => $status[(int)$reservation['Status']],
            ];
        }

        return [
            "Saldo"         => convertRupiah($customer['Saldo']),
            "Kode_Booking"  => null,
            "Thumbnail"     => null,
            "Outlet_Nama"   => null,
            "Outlet_Alamat" => null,
            "Waktu"         => null,
            "Orang"         => null,
            "Status"        => null,
        ];
    }

    public function historyList($user_id)
    {
        $this->db->join('users', 'users.Source_Id = reservasi.Customer_Id');
        $this->db->join('outlet', 'outlet.ID_Outlet = reservasi.Outlet_Id');
        $this->db->where('users.Id', $user_id);
        $this->db->select('reservasi.*, reservasi.Status Reservasi_Status, outlet.Nama Outlet_Nama, outlet.Alamat Outlet_Alamat, outlet.Thumbnail');
        $this->db->order_by('created_at', 'DESC');
        $this->db->from('reservasi');
        $query = $this->db->get();
        $reservation = $query->result_array();

        $status = ['Aktif', 'Hadir', 'Tidak Hadir'];
        if ($reservation) {
            $result = [];
            foreach ($reservation as $dt) {

                if ($dt['Thumbnail'] != null) {
                    $thumbnail = $this->host . $dt['Thumbnail'];
                } else {
                    $thumbnail = $this->host . 'assets/landing/img/partners/thumb.jpg';
                }

                $result[] = [
                    "Kode_Booking"  => $dt['Id_Reservasi'],
                    "Thumbnail"     => $thumbnail,
                    "Outlet_Nama"   => $dt['Outlet_Nama'],
                    "Outlet_Alamat" => $dt['Outlet_Alamat'],
                    "Waktu"         => convertDate($dt['created_at'], 'indo'),
                    "Orang"         => $dt['Orang'],
                    "Status"        => $status[(int)$dt['Reservasi_Status']],
                ];
            }

            return $result;
        }

        return [
            "Kode_Booking"  => null,
            "Thumbnail"     => null,
            "Outlet_Nama"   => null,
            "Outlet_Alamat" => null,
            "Waktu"         => null,
            "Orang"         => null,
            "Status"        => null,
        ];
    }

    public function reserve($dt)
    {
        $this->load->model('Outlet_model');
        $check = $this->reserveCheck($dt['customer_id']);
        if ($check['Outlet_Nama']) {
            $result = ['error' => true, 'message' => "Maaf, reservasi gagal karena anda sudah melakukan reservasi \ndi : " . $check['Outlet_Nama'] . "\npada : " . convertDate($check['created_at'], 'indo')];
        } else {
            $saldo = $this->getSaldo($dt['customer_id']);
            if (((int)$saldo - 2000) > 0) {
                $kursi = $this->Outlet_model->getKursi($dt['outlet_id'], $dt['tanggal']);

                if (((int)$kursi - (int)$dt['orang']) > 0) {
                    $id = $this->General_model->randomPassword();
                    $data = array(
                        'Id_Reservasi' => $id,
                        'Outlet_Id'    => $dt['outlet_id'],
                        'Customer_Id'  => $dt['customer_id'],
                        'Orang'        => $dt['orang'],
                        'created_at'   => $dt['tanggal'] . " " . $dt['jam'],
                        'Status'       => 0
                    );
                    $save = $this->db->insert('reservasi', $data);
                    if ($save) {

                        // update jumlah kursi tersedia
                        $this->db->set('Kursi_Tersedia', ((int)$kursi - (int)$dt['orang']));
                        $this->db->where('ID_Outlet', $dt['outlet_id']);
                        $this->db->update('outlet');

                        // update saldo t-cash customer
                        $this->db->set('Saldo', ((int)$saldo - 3000));
                        $this->db->where('Id_Customer', $dt['customer_id']);
                        $this->db->update('customer');
                        if ($this->db->affected_rows() > 0) {
                            $result = ['error' => false, 'message' => 'Tempat Berhasil Dipesan'];
                        }
                    } else {
                        $result = ['error' => true, 'message' => 'Something Gone Wrong'];
                    }
                } else {
                    $result = ['error' => true, 'message' => 'Maaf, reservasi gagal karena kursi tidak mencukupi. Kursi tersisa : ' . (int)$kursi];
                }
            } else {
                $result = ['error' => true, 'message' => 'Maaf, reservasi gagal karena saldo t-cash tidak mencukupi. Saldo tersisa : ' . (int)$saldo];
            }
        }

        return $result;
    }

    public function verify($id)
    {
        $this->db->set('Status', $_POST['kehadiran']);
        $this->db->set('verified_at', date("Y-m-d H:i:s"));
        $this->db->where('Id_Reservasi', $id);
        $this->db->update('reservasi');
        if ($this->db->affected_rows() > 0) {

            $this->db->join('outlet', 'outlet.ID_Outlet = reservasi.Outlet_Id');
            $this->db->where('Id_Reservasi', $id);
            $this->db->select('reservasi.*, Outlet.Kursi_Tersedia');
            $query = $this->db->get('reservasi');
            $rsv = $query->row_array();

            $this->db->set('Kursi_Tersedia', (int)$rsv['Kursi_Tersedia'] + (int)$rsv['Orang']);
            $this->db->where('ID_Outlet', $rsv['Outlet_Id']);
            $this->db->update('outlet');

            $result = ['Status' => 'success', 'Msg' => 'Berhasil Verifikasi'];
        } else {
            $result = ['Status' => 'error', 'Msg' => 'Verifikasi Gagal'];
        }

        return $result;
    }

    public function cancel($data)
    {
        $this->load->model('Outlet_model');

        $kursi = $this->Outlet_model->getKursi($data['Outlet_Id'], $data['created_at']);
        // update jumlah kursi tersedia
        $this->db->set('Kursi_Tersedia', ((int)$kursi + (int)$data['Orang']));
        $this->db->where('ID_Outlet', $data['Outlet_Id']);
        $this->db->update('outlet');

        // update saldo t-cash customer
        /*$saldo = $this->getSaldo($data['Customer_Id']);
        $this->db->set('Saldo', ((int)$saldo + 5000));
        $this->db->where('Id_Customer', $data['Customer_Id']);
        $this->db->update('customer');
        if ($this->db->affected_rows() > 0) {*/
            $this->db->where('Id_Reservasi', $data['Id_Reservasi']);
            $save = $this->db->delete('reservasi');

            if ($save) {
                $result = ['error' => false, 'message' => 'Reservasi Dibatalkan'];
            } else {
                $result = ['error' => true, 'message' => 'Something Gone Wrong'];
            }
//        }

        return $result;
    }

    public function countReservation($outlet_id)
    {
        $this->db->where('Outlet_Id', $outlet_id);
        $this->db->where('Status', 0);
        $this->db->where('created_at >', date("Y-m-d") . " 00:00:00");
        $this->db->where('created_at <', date("Y-m-d") . " 23:59:59");
        $this->db->from('reservasi');
        return $this->db->count_all_results();
    }
}
