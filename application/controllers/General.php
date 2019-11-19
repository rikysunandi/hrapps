<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General extends CI_Controller
{
	function __construct() {
        parent::__construct();
        $this->load->model('General_model');
		$this->load->library('form_validation');
        chek_session();
    }

    // create akan menampilkan form 
    public function unitpln() {
		$transaksi_data = $this->General_model->getUnitPln2();
		//$data .= "<option value=''>--pilih Unit--</option>";
		foreach ($transaksi_data as $units){
			$data .="<option value='$units[unitap]'>$units[nama]</option>";
		}
		echo $data;
    }
	
	public function GetWig() {
		$transaksi_data = $this->General_model->GetWig();
		//$data .= "<option value=''>--pilih Unit--</option>";
		foreach ($transaksi_data as $units){
			$data .="<option value='$units[id_wig]'>$units[nama_wig]</option>";
		}
		echo $data;
    }
	
	public function GetLm_by() {
		$idlm=$this->input->post('idwig');
		$bidang=$this->input->post('bidang');
		
		$transaksi_data = $this->General_model->GetLm_by($idlm,$bidang);
		//$data .= "<option value=''>--pilih Unit--</option>";
		foreach ($transaksi_data as $units){
			$data .="<option value='$units[id_lm]'>$units[nama_lm]</option>";
		}
		echo $data;
    }
	
	public function GetSubLm_by() {
		$idlm=$this->input->post('idwig');
		$bidang='1';
		
		$transaksi_data = $this->General_model->GetSubLm_by($idlm,$bidang);
		//$data .= "<option value=''>--pilih Unit--</option>";
		foreach ($transaksi_data as $units){
			$data .="<option value='$units[id_lm]'>$units[nama_lm]</option>";
		}
		echo $data;
    }
	
	public function unitpln_by() {
		$unit=$this->input->post('unitpln2');
		
		$transaksi_data = $this->General_model->getUnitPln_by($unit);
		//$data .= "<option value=''>--pilih Unit--</option>";
		foreach ($transaksi_data as $units){
			$data .="<option value='$units[unitup]'>$units[nama]</option>";
		}
		echo $data;
    }
	
	public function vendorpln() {
		$transaksi_data = $this->General_model->getVendorPln();
		//$data .= "<option value=''>--pilih Vendor--</option>";
		foreach ($transaksi_data as $datas){
			$data .="<option value='$datas[kode_vendor]'>$datas[nama_vendor]</option>";
		}
		echo $data;
    }
	
	 public function listunitup(){
    // Ambil data ID Provinsi yang dikirim via ajax post
	
			$unit=$this->input->post('unitap');
			$transaksi_data = $this->General_model->getUnitUp_by($unit);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
	
	    $kodeunit=$this->session->userdata('kode_vendor');
	   // log_message('error',$kodeunit);
	    $idunit=$this->session->userdata('company');
		
		if ($idunit <> 'ULP'){
			$lists = "<option value='0'>--ALL ULP--</option>";
		}
		foreach($transaksi_data as $data){
			$lists .= "<option value='".$data->unitup."'>".$data->nama."</option>"; 
			// Tambahkan tag option ke variabel $lists
		}
		$callback = array('list_unitup'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}