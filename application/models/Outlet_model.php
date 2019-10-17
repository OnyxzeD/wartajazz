<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Outlet_model extends CI_Model
{
    protected $host;

    public function __construct()
    {
        parent::__construct();
        $this->host = "http://tempatin.000webhostapp.com/";
//        $this->host = 'http://' . gethostbyname(gethostname()) . '/tempat.in/';
    }

    function validate($act = '')
    {
        // load validation
        $this->load->library('form_validation');
        // Validation
        $this->form_validation->set_rules('outlet-telp', 'No Telpon', 'numeric|required|max_length[12]',
            array(
                'required'   => 'No Telpon Wajib Diisi',
                'numeric'    => 'No Telpon hanya bisa diisi dengan angka',
                'max_length' => 'No Telpon tidak valid',
            ));
    }

    public function store()
    {
        $code = $this->getCode();
        $data = array(
            'ID_Outlet'      => $code,
            'Partner_Id'     => $_SESSION['Account']['Source_Id'],
            'Nama'           => $_POST['outlet-nama'],
            'Alamat'         => $_POST['outlet-alamat'],
            'Jumlah_Kursi'   => $_POST['outlet-kursi'],
            'Kursi_Tersedia' => $_POST['outlet-kursi'],
            'Telp'           => $_POST['outlet-telp'],
            'Berdiri_Sejak'  => date("Y-m-d")
        );
        $save = $this->db->insert('outlet', $data);

        if ($save) {
            return true;
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
            $this->db->set('Nama', $_POST['outlet-nama']);
            $this->db->set('Alamat', $_POST['outlet-alamat']);
            if ($this->getDetail($id)['Jumlah_Kursi'] == null && $this->getDetail($id)['Kursi_Tersedia'] == null) {
                $this->db->set('Kursi_Tersedia', $_POST['outlet-kursi']);
            }
            $this->db->set('Jumlah_Kursi', $_POST['outlet-kursi']);
            $this->db->set('Telp', $_POST['outlet-telp']);
            $this->db->where('ID_Outlet', $id);
            $this->db->update('outlet');
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
        $this->db->where('ID_Outlet', $Id);
        $this->db->delete('outlet');
        if ($this->db->affected_rows() > 0) {
            $result = ['Status' => 'success', 'Msg' => 'Data Berhasil Dihapus'];
        } else {
            $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
        }

        return $result;
    }

    public function listData($partner = null)
    {
        if (is_null($partner)) {
            $partner = $_SESSION['Account']['Source_Id'];
        }
        $this->db->select('*');
        $this->db->where('Partner_Id', $partner);
        $this->db->order_by('Nama', 'ASC');
        $this->db->from('outlet');
        $query = $this->db->get();

        // reformat data
        $result = [];
        $data = $query->result_array();
        foreach ($data as $dt) {
            if ($dt['Thumbnail'] != null) {
                $dt['Thumbnail'] = $this->host . $dt['Thumbnail'];
            } else {
                $dt['Thumbnail'] = $this->host . "assets/landing/img/partners/thumb.jpg";
            }
            $result[] = $dt;
        }

        return $result;
    }

    public function getDetail($Id)
    {
        $this->db->join('partner', 'partner.ID_Partner = outlet.Partner_Id');
        $this->db->select(
            'outlet.*, partner.Nama Nama_Pemilik'
        );
        $this->db->where('outlet.ID_Outlet', $Id);
        $query = $this->db->get('outlet');
        $result = $query->row_array();

        // reformat data
        if ($result['Thumbnail'] != null) {
            $result['Thumbnail'] = $this->host . $result['Thumbnail'];
        } else {
            $result['Thumbnail'] = $this->host . "assets/landing/img/partners/thumb.jpg";
        }

        return $result;
    }

    public function getKursi($Id, $date)
    {
        $detailOutlet = $this->getDetail($Id);

        /*$this->db->select_sum('Orang');
        $this->db->where('Outlet_Id', $Id);
        $this->db->where('created_at >', $date . " 00:00:00");
        $this->db->where('created_at <', $date . " 23:59:59");
        $this->db->where('status', 0);
        $query = $this->db->get('reservasi');
        $dtreservasi = $query->row_array();

        $result = $detailOutlet['Kursi_Tersedia'] - (int)$dtreservasi['Orang'];*/

        $result = $detailOutlet['Kursi_Tersedia'];
        return $result;
    }

    public function getCode($partner = null)
    {
        if (is_null($partner)) {
            $partner = $_SESSION['Account']['Source_Id'];
        }

        // get partner detail
        $this->db->select('*');
        $this->db->where('ID_Partner', $partner);
        $query = $this->db->get('partner');
        $dtpartner = $query->row_array();

        $this->db->select('outlet.ID_Outlet');
        $this->db->where('Partner_Id', $partner);
        $this->db->order_by('ID_Outlet', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('outlet');
        $result = $query->row_array();
        $urut = (int)filter_var($result['ID_Outlet'], FILTER_SANITIZE_NUMBER_INT) + 1;

        $vocal = ["a", "i", "u", "e", "o", " "];
        $a = $dtpartner['Nama'];
        $b = "";
        for ($i = 0; $i < strlen($a); $i++) {
            if (in_array($a[$i], $vocal) == false) {
                $b .= strtoupper($a[$i]);
            }
        }

        return substr($b, 0, 5) . "_" . $urut;
    }
}
