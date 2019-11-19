<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendemail extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Tagihan_model');
		$this->load->library('form_validation');
		chek_session();
    }
	
	public function index()
	{
		$this->load->view('sendemail');
	}

	public function send()
	{
		
		$unitpln=$this->input->post('unitpln');
		$tglpilih=$this->input->post('tglpilih');
		
		//log_message('error',$tglpilih);
		
		$no=1;               
        $transaksi_data = $this->Tagihan_model->get_tagihan_monitoring($unitpln,$tglpilih);
            foreach ($transaksi_data as $transaksi) {  
				
			if ($transaksi->rp_sel <> 0 ) {
				$status_sel = "<span class='label label-danger'>SELISIH</span>";
			} else if ($transaksi->rp_sel == 0 ){
				$status_sel = "<span class='label label-success'>OK</span>";
			}
				
			if ($transaksi->aktif == 0) {
                    $status = "<span class='label label-danger'>0-UPLOAD</span>";
                } else if ($transaksi->aktif == 1){
					$status = "<span class='label label-warning'>1-PROSES SDM</span>";
				} else if ($transaksi->aktif == 2){
					$status = "<span class='label label-danger'>2-HARD TIDAK ADA</span>";
				} else if ($transaksi->aktif == 3){
					$status = "<span class='label label-danger'>3-SELISIH JML/RUPIAH</span>";
				} else if ($transaksi->aktif == 4){
					$status = "<span class='label label-warning'>4-PROSES SAP</span>";
				} else if ($transaksi->aktif == 5){
					$status = "<span class='label label-warning'>5-KIRIM KEU</span>";
				} else if ($transaksi->aktif == 6){
					$status = "<span class='label label-warning'>6-PROSES KEU</span>";
				}  else if ($transaksi->aktif == 7){
					$status = "<span class='label label-success'>7-TRANSFERED</span>";
				}
				
			if ($transaksi->sla > 30) {
                    $slastatus = "<span class='label label-danger'><b>$transaksi->sla</span>";
                }else if ($transaksi->sla < 15) {
                    $slastatus = "<span class='label label-success'><b>$transaksi->sla</span>";
                } else if ($transaksi->sla > 15 || $transaksi->sla < 30) {
                    $slastatus = "<span class='label label-warning'><b>$transaksi->sla</span>";
                } 
				
			$edit = '<a class="btn btn-xs btn-success" href="javascript:void(0)" title="Update" onclick="edit_tracking('."'".$transaksi->id."'".')"><i class="glyphicon glyphicon-edit"></i>Update</a>';
							
					$message .=	'
								<font face="calibri"><tr>
								<td width="2%"><font face="calibri" size="1">'.$no++.'</font></td>
								<td width="5%"><font face="calibri" size="1">'.$transaksi->kode_pln.'</font></td>
								<td width="25%"><font face="calibri" size="1">'.$transaksi->kode_vendor.'</font></td>
								<td width="20%"><font face="calibri" size="1">'.$transaksi->tx_nokwitag.'</font></td>
								<td width="8%"><font face="calibri" size="1">'.tgl_indo($transaksi->tgl_terima_tpa).'</font></td>
								<td width="8%"><font face="calibri" size="1">'.tgl_indo($transaksi->tgl_kirim_tpa).'</font></td>
								<td width="8%"><font face="calibri" size="1">'.tgl_indo($transaksi->tgl_terima_pln).'</font></td>
								<td width="5%"><font face="calibri" size="1">'.$transaksi->jumlah.'</font></td>
								<td width="10%"><font face="calibri" size="1">'.rupiah($transaksi->rupiah2).'</font></td>
								<td width="8%"><font face="calibri" size="1"><b>'.$status.'</b></font></td>
								</tr></font>';
			
           /* $query[] = array(
                'no'=>$no++,
                'id'=>$transaksi->id,
                'kode_sap'=>$transaksi->kode_sap,
                'kode_pln'=>$transaksi->kode_pln,
                'tgl_tagihan'=>tgl_indo($transaksi->tgl_tagihan), 
                'tx_nokwitag'=>$transaksi->tx_nokwitag, 
                'kd_vendor_tpa'=>$transaksi->kd_vendor_tpa, 
                'no_surat_jalan'=>$transaksi->no_surat_jalan, 				
                'nama_vendor_tpa'=>$transaksi->nama_vendor_tpa, 				
				'jumlah'=>$transaksi->jumlah,				
				'jumlah2'=>$transaksi->jumlah2,				
                'sla'=>$slastatus,
                'rupiah'=>rupiah($transaksi->rupiah),
                'rupiah2'=>rupiah($transaksi->rupiah2),
                'tgl_terima_tpa'=>tgl_indo($transaksi->tgl_terima_tpa), 
                'tgl_kirim_tpa'=>tgl_indo($transaksi->tgl_kirim_tpa), 
                'tgl_terima_pln'=>tgl_indo($transaksi->tgl_terima_pln),
                'aktif'=>$status,
                'status_sel'=>$status_sel,
                'edit'=>$edit,       
            );*/
			
		 }    
		 $messages = '
			<table border="0" width="100%" cellpadding="2">
			<font face="calibri">
			Yth Provider Kesehatan
			<br>
			<br>
			Berikut Kami sampaikan Rekap Tagihan Kesehatan PLN
			</br>
			</table>
			<h4 align="center">Rekap Tagihan Kesehatan PLN <br> Tanggal Tagihan '.tgl_indo($tglpilih).'</h3>
				<table border="0" width="100%" cellpadding="0">
				<font face="calibri"><tr>
								<th width="2%" align="left"><font face="calibri" size="2">No</font></th>
								<th width="5%" align="left"><font face="calibri" size="2">Kode PLN</font></th>
								<th width="25%" align="left"><font face="calibri" size="2">Provider</font></th>
								<th width="20%" align="left"><font face="calibri" size="2">No Tagihan</font></th>
								<th width="8%" align="left"><font face="calibri" size="2">Tgl Terima TPA</font></th>
								<th width="8%" align="left"><font face="calibri" size="2">Tgl Kirim TPA</font></th>
								<th width="8%" align="left"><font face="calibri" size="2">Tgl Terima PLN</font></th>
								<th width="5%" align="left"><font face="calibri" size="2">Jumlah</font></th>
								<th width="10%" align="left"><font face="calibri" size="2">Rupiah</font></th>
								<th width="8%" align="left"><font face="calibri" size="2">Status</font></th>
								</tr></font>
								'.$message.'</table>';
		$subject = 'Test APP -> Report Tagihan Kesehatan Tanggal Tagihan - '.tgl_indo(date("Y-m-d"));
		//$programming_languages = implode(", ", $this->input->post("programming_languages"));
		//$file_data = $this->upload_file();

			

			/*$config = Array(
			   'useragent' => 'CodeIgniter',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'djbkesehatan@gmail.com', // Ganti dengan email gmail Anda
               'smtp_pass' => 'Kesehatan_1234', // Password gmail Anda
               'smtp_port' => 465,
               'smtp_keepalive' => TRUE,
               'smtp_crypto' => 'SSL',
               'wordwrap'  => TRUE,
               'wrapchars' => 80,
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'validate'  => TRUE,
               'crlf'      => "rn",
               'newline'   => "rn"
		    );*/
			//$file_path = 'uploads/' . $file_name;
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from('PLN UID DJB - REPORT TAGIHAN');
			//$this->email->to($list);
			//$list = array('budi.mulyadi@pln.co.id','anne_setiyani@pln.co.id','agi.aditya@pln.co.id','deti.nurwulandari@pln.co.id','monifa.adhelia@pln.co.id','desti.ardelaputri@pln.co.id');
			$list = array('agi.aditya@pln.co.id','monifa.adhelia@pln.co.id','desti.ardelaputri@pln.co.id');
			$this->email->to($list);
		   // $this->email->to('agi.aditya@pln.co.id','agihagia@gmail.com','haviscarf@gmail.com');
		    $this->email->subject($subject);
	        $this->email->message($messages);
	       // $this->email->attach($file_data['full_path']);
	        if($this->email->send())
	        {
					$a = 'Updated||'.$kode_pln.'||'.$tgl_tagihan;
	        		$this->session->set_flashdata('msg', $a);
	        		//log_message('error','send email');
	        		redirect('tagihan/monitoring');
	     
	        }
	        else
	        {
				$a = 'Updated||'.$kode_pln.'||'.$tgl_tagihan;
	        	$this->session->set_flashdata('msg', $a);
	        		//log_message('error','error email');
	        		redirect('tagihan/monitoring');
	       
	        }
	    }

	function upload_file()
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$this->load->library('upload', $config);
		if($this->upload->do_upload('resume'))
		{
			return $this->upload->data();			
		}
		else
		{
			return $this->upload->display_errors();
		}
	}
}