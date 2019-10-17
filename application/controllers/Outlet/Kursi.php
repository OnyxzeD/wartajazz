<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'Outlet_Middleware.php';

class Kursi extends Outlet_Middleware
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Outlet_model');
	}

	public function index()
	{
		$vars['header'] = 'Kursi';
		$vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
		$vars['View'] = 'Outlet/Kursi/index';
		$vars['Data'] = 50;
		$this->load->view('Outlet/layout', $vars);
	}

//	public function modalCreate()
//	{
//		$this->load->view('Partner/Outlet/modal-entry');
//	}
//
//	public function create()
//	{
//		$result = $this->Outlet_model->store();
//		$this->output
//			->set_content_type('application/json')
//			->set_output(json_encode($result));
//	}
//
//	public function modalEdit($id)
//	{
//		$vars['data'] = $this->Outlet_model->getDetail($id);
//		$this->load->view('Partner/Outlet/modal-entry', $vars);
//	}
//
//	public function edit($id)
//	{
//		$result = $this->Outlet_model->update($id);
//		$this->output
//			->set_content_type('application/json')
//			->set_output(json_encode($result));
//	}
//
//	public function modalDelete($id)
//	{
//		$data = $this->Outlet_model->getDetail($id);
//		$vars['data'] = "Outlet " . $data['Nama'];
//		$this->load->view('modals/modal-delete', $vars);
//	}
//
//	public function delete($id)
//	{
//		$result = $this->Outlet_model->delete($id);
//		$this->output
//			->set_content_type('application/json')
//			->set_output(json_encode($result));
//	}
//
//	public function show()
//	{
//		$this->db->join('partner', 'partner.ID_Partner = outlet.Partner_Id');
//		$this->db->select('outlet.ID_Outlet, partner.nama Owner');
//		$this->db->where('Partner_Id', $_SESSION['Account']['Source_Id']);
//		$this->db->order_by('ID_Outlet', 'DESC');
//		$this->db->limit(1);
//		$query = $this->db->get('outlet');
//		$result = $query->row_array();
//		$urut = (int)filter_var($result['ID_Outlet'], FILTER_SANITIZE_NUMBER_INT) + 1;
//
//
//		$vocal = ["a", "i", "u", "e", "o", " "];
//		$a = $result['Owner'];
//		$b = "";
//		for ($i = 0; $i < strlen($a); $i++) {
//			if (in_array($a[$i], $vocal) == false) {
//				$b .= strtoupper($a[$i]);
//			}
//		}
//		echo substr($b, 0, 5) . "_" . $urut;
//
//	}
}
