<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Distribusi_model');
        $this->load->model('General_model');
        $this->load->library('form_validation');
        chek_session();
    }
	
	public function data_kogol() {  
		$data['data'] = $this->General_model->getUnitAp_by();
	
		//$data['data'] = $this->db->query("select * from tb_unitap order by unitap asc")->result();
		$this->template->display('Distribusi/tb_Distribusi_data_kogol',$data);
    }
	
	public function data_lembar() {    
		$data['data'] = $this->General_model->getUnitAp_by();
	
		$this->template->display('Distribusi/tb_Distribusi_data_lembar2',$data);
    }
	
	public function lead_measure() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
	
		$data['wig'] = $this->db->query("select * from tb_master_wig where bidang='DISTRIBUSI' order by id_wig asc")->result();
		$this->template->display('Distribusi/tb_Distribusi_lead_measure',$data);
		
		//$data['getunitap']=$this->General_model->getUnitPln();
        //$this->template->display('Distribusi/tb_Distribusi_lead_measure',$data);
		
        //$this->template->display('Distribusi/tb_Distribusi_lead_measure');
    }
	
	public function rekap_lead_measure() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
	
		$data['wig'] = $this->db->query("select * from tb_master_wig where bidang='DISTRIBUSI' order by id_wig asc")->result();
		 $this->template->display('Distribusi/tb_distribusi_rekap_lm',$data);
		
		//$data['getunitap']=$this->General_model->getUnitPln();
        //$this->template->display('Distribusi/tb_Distribusi_lead_measure',$data);
		
        //$this->template->display('Distribusi/tb_Distribusi_lead_measure');
    }
	
	public function rekap_pencapaian() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
	
		$data['wig'] = $this->db->query("select * from tb_master_wig where bidang='DISTRIBUSI' order by id_wig asc")->result();
		
		$this->template->display('Distribusi/tb_distribusi_rekap_pencapaian',$data);
		
		//$data['getunitap']=$this->General_model->getUnitPln();
        //$this->template->display('Distribusi/tb_Distribusi_lead_measure',$data);
		
        //$this->template->display('Distribusi/tb_Distribusi_lead_measure');
    }
	
	public function upload_kogol() {    
        $this->template->display('Distribusi/tb_Distribusi_upload_kogol');
    }
	
	public function upload_lembar() {    
        $this->template->display('Distribusi/tb_Distribusi_upload_lembar2');
    }
	
	function view_lead_measure(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$tglpilih2=$this->input->post('tglpilih2');
		$bidang='DISTRIBUSI';
		
		//log_message('error',$unitpln);
		
        $no=1;               
        $transaksi_data = $this->Distribusi_model->get_tb_lead_measure($unitpln,$unitpln2,$tglpilih,$tglpilih2,$bidang);
            foreach ($transaksi_data as $transaksi) {
				$edit = '<a class="btn btn-xs btn-success" href="javascript:void(0)" title="update" onclick="edit_lm('."'".$transaksi->id."'".')"><i class="glyphicon glyphicon-edit"></i>update</a>';
				
		
			$persen = $transaksi->persen;
			
			if ($persen > 100) {
			$persen = 100;
			}
				
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'bidang'=>$transaksi->bidang,               
                'nama_wig'=>$transaksi->nama_wig,               
                'id_lm'=>$transaksi->id_lm,              
                'tanggal'=>$transaksi->tanggal,              
                'nama_lm'=>$transaksi->nama_lm,              
                'satuan'=>$transaksi->satuan,              
                'target'=>$transaksi->target,              
                'pencapaian'=>$transaksi->pencapaian,
                'persen'=>$persen,
				'keterangan'=>$transaksi->keterangan,   				
				'edit'=>$edit,   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  
	
	
	function view_rekap_lead_measure(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$bidang='DISTRIBUSI';
		
		//log_message('error',$unitpln);
		
        $no=1;               
        $transaksi_data = $this->Distribusi_model->get_tb_rekap_lead_measure($unitpln,$unitpln2,$tglpilih,$bidang);
            foreach ($transaksi_data as $transaksi) {
				$edit = '<a class="btn btn-xs btn-success" href="javascript:void(0)" title="update" onclick="edit_lm('."'".$transaksi->id."'".')"><i class="glyphicon glyphicon-edit"></i>update</a>';
				
				if ($transaksi->target == 0) {
                    $status = "<span class='label label-danger'>0 - BELUM ADA</span>";
                } else if ($transaksi->target == 1){
					$status = "<span class='label label-warning'>1 - SATU LM</span>";
				} else if ($transaksi->target == 2){
					$status = "<span class='label label-warning'>2 - DUA LM</span>";
				} else if ($transaksi->target == 3){
					$status = "<span class='label label-success'>3 - OK</span>";
				} 
				
				if ($transaksi->pencapaian == 0) {
                    $status2 = "<span class='label label-danger'>0 - BELUM ADA</span>";
                } else if ($transaksi->pencapaian == 1){
					$status2 = "<span class='label label-warning'>1 - SATU LM</span>";
				} else if ($transaksi->pencapaian == 2){
					$status2 = "<span class='label label-warning'>2 - DUA LM</span>";
				} else if ($transaksi->pencapaian == 3){
					$status2 = "<span class='label label-success'>3 - OK</span>";
				} 
				
			$query[] = array(
                'no'=>$no++,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'target'=>$status,               
                'pencapaian'=>$status2, 
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    } 

function view_rekap_pencapaian_lead_measure(){ 
		$id_wig=$this->input->post('id_wig');
		$id_lm=$this->input->post('id_lm');
		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$bidang='DISTRIBUSI';
		
		//log_message('error',$unitpln);
		//log_message('error',$this->nilai('100'));
		
        $no=1;               
        $transaksi_data = $this->Distribusi_model->get_tb_rekap_pencapaian_lead_measure($id_wig,$id_lm,$unitpln,$unitpln2,$tglpilih,$bidang);
            foreach ($transaksi_data as $transaksi) {
				
				$total=($this->nilai($transaksi->senin) + $this->nilai($transaksi->selasa) + $this->nilai($transaksi->rabu) + $this->nilai($transaksi->kamis) + $this->nilai($transaksi->jumat) + $this->nilai($transaksi->sabtu));
				
							
			$query[] = array(
                'no'=>$no++,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'senin'=>$transaksi->senin, 
                'selasa'=>$transaksi->selasa, 
                'rabu'=>$transaksi->rabu, 
                'kamis'=>$transaksi->kamis, 
                'jumat'=>$transaksi->jumat, 
                'sabtu'=>$transaksi->sabtu, 
				'senin_icon'=>$this->icon($transaksi->senin), 
                'selasa_icon'=>$this->icon($transaksi->selasa), 
                'rabu_icon'=>$this->icon($transaksi->rabu), 
                'kamis_icon'=>$this->icon($transaksi->kamis), 
                'jumat_icon'=>$this->icon($transaksi->jumat), 
                'sabtu_icon'=>$this->icon($transaksi->sabtu), 
                //'nilai'=>$total,
               'nilai'=>$transaksi->nilai,  
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    } 	
	
	function icon($persen) {
		
		if ($persen >= 100) {
                    $icon = "<span class='label label-success'><i class='fa fa-star fa-fw'></i></span>";
                } else if ($persen >= 70 && $persen < 100) {
                    $icon = "<span class='label label-info'><i class='fa fa-check fa-fw'></i></span>";
                } else if ($persen >= 30 && $persen <= 69) {
                    $icon = "<span class='label label-warning'><i class='fa fa-sort-asc fa-fw'></i></span>";
                } else if ($persen >= 1 && $persen <= 29) {
                    $icon = "<span class='label label-default'><i class='fa  fa-arrows-h fa-fw'></i></span>";
                } else {
                    $icon = "<span class='label label-danger'><i class='fa fa-times fa-fw'></i></span>";
                }
				
		return $icon;
		
	}
	
	function nilai($nilai) {
		
		if ($nilai >= 100) {
                    $n = '4';
                } else if ($nilai >= 70 && $nilai < 100) {
                   $n = '3';
                } else if ($nilai >= 30 && $nilai <= 69) {
                   $n = '2';
                } else if ($nilai >= 1 && $nilai <= 29) {
                   $n = '1';
                } else {
                    $n = '0';
                }
				
		return $n;
		
	}
	
	function view_lm_id($id){ 
		//log_message('error',$id);
		$no=1;               
        $transaksi_data = $this->Distribusi_model->get_lm_id($id);
            foreach ($transaksi_data as $transaksi) {  
			
            $query[] = array(
                'no'=>$no++,
                'id'=>$transaksi->id,
                'unitap'=>$transaksi->unitap,
                'unitup'=>$transaksi->unitup,
                'nama_wig'=>$transaksi->nama_wig, 
                'nama_lm'=>$transaksi->nama_lm, 
                'target'=>$transaksi->target,
                'tanggal'=>$transaksi->tanggal,
                'pencapaian'=>$transaksi->pencapaian,
            );
			
		 }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }
	
	
	function tambah_lm(){ 

		$id_wig=$this->input->post('id_wig');
		$id_lm=$this->input->post('id_lm');
		$satuan=$this->input->post('satuan');
		$target=$this->input->post('target');
		$keterangan=$this->input->post('keterangan');
		$unitap=$this->input->post('id_unitpln3');
		$unitup=$this->input->post('id_unitpln4');
		$bidang='DISTRIBUSI';
		
			
		$hasil = $this->Distribusi_model->tambah_lm($id_wig,$id_lm,$satuan,$target,$keterangan,$unitap,$unitup,$bidang);		
		$a = 'Tambah LM ||'.$tgl_tagihan;
		
		$this->session->set_flashdata('msg', $a);
		//log_message('error',$a);
		
		redirect("Distribusi/lead_measure");
    }  
	
	function update_pencapaian_lm(){ 

		$unitap=$this->input->post('unitap');
		$unitup=$this->input->post('unitup');
		$tanggal=$this->input->post('tanggal');
		$nama_wig=$this->input->post('nama_wig');
		$nama_lm=$this->input->post('nama_lm');
		$pencapaian=$this->input->post('pencapaian');
		$target=$this->input->post('target');
		
		//log_message('error',$unitpln);
		
		$hasil =  $this->db->query("update tb_lead_measure set target=$target,
									pencapaian=$pencapaian, tgl_insert=current_timestamp
									where unitap='$unitap' and unitup='$unitup'  and nama_wig='$nama_wig' 
									and nama_lm='$nama_lm'  and DATE_FORMAT(tanggal, '%Y-%m-%d')='$tanggal'
									");
									
		$hasil =  $this->db->query("insert into tb_refnum (keterangan) values ('LM')");
		   
		$a = 'Tambah LM ||'.$tgl_tagihan;
		
		$this->session->set_flashdata('msg', $a);
		//log_message('error',$a);
		
		redirect("Distribusi/lead_measure");
    }  
	
	function view_data_kogol(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		
		//log_message('error',$tglpilih);
		
        $no=1;               
        $transaksi_data = $this->Distribusi_model->get_tb_data_kogol($unitpln,$unitpln2,$tglpilih);
            foreach ($transaksi_data as $transaksi) {
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'kogol'=>$transaksi->kogol,               
                'lembar'=>$transaksi->lembar,              
                'rpptl'=>$transaksi->rpptl,              
                'rpbpju'=>$transaksi->rpbpju,              
                'rpppn'=>$transaksi->rpppn,              
                'rpmat'=>$transaksi->rpmat,              
                'rplain'=>$transaksi->rplain,              
                'rptag'=>$transaksi->rptag,              
                'rpbk'=>$transaksi->rpbk,                         
                'tgl_insert'=>$transaksi->tgl_insert,  
				'keterangan'=>$transaksi->keterangan,   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  
	
	function view_data_lembar(){ 
        $unitpln=$this->input->post('unitpln');
		$tglpilih=$this->input->post('tglpilih');
		
		//log_message('error',$tglpilih);
		
        $no=1;               
        $transaksi_data = $this->Distribusi_model->get_tb_data_lembar($unitpln,$tglpilih);
            foreach ($transaksi_data as $transaksi) {
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'lembar'=>$transaksi->lembar,              
                'jml_plg'=>$transaksi->jml_plg,              
                'jml_lbr'=>$transaksi->jml_lbr,              
                'rpptl'=>$transaksi->rpptl,              
                'rpbpju'=>$transaksi->rpbpju,              
                'rpppn'=>$transaksi->rpppn,              
                'rpmat'=>$transaksi->rpmat,              
                'rplain'=>$transaksi->rplain,              
                'rptag'=>$transaksi->rptag,              
                'rpbk'=>$transaksi->rpbk,                         
                'tgl_insert'=>$transaksi->tgl_insert,  
				'keterangan'=>$transaksi->keterangan,   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  
	
	function view_data_lembar2(){ 
        $unitpln=$this->input->post('unitpln');
        $unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		
		//log_message('error',$tglpilih);
		
        $no=1;               
        $transaksi_data = $this->Distribusi_model->get_tb_data_lembar2($unitpln,$unitpln2,$tglpilih);
            foreach ($transaksi_data as $transaksi) {
				
				$jml1 = $transaksi->lbr1_awal + $transaksi->lbr2_awal + $transaksi->lbr3_awal + $transaksi->lbr4_awal;
				$jml2 = $transaksi->lbr1_akhir + $transaksi->lbr2_akhir + $transaksi->lbr3_akhir + $transaksi->lbr4_akhir;
				//$persen = ($jml1 - $jml2) / $jml2;
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'lbr1_awal'=>$transaksi->lbr1_awal,              
                'lbr2_awal'=>$transaksi->lbr2_awal,              
                'lbr3_awal'=>$transaksi->lbr3_awal,              
                'lbr4_awal'=>$transaksi->lbr4_awal, 
				'lbrjml_awal'=>$jml1,              				
                'lbr1_akhir'=>$transaksi->lbr1_akhir,              
                'lbr2_akhir'=>$transaksi->lbr2_akhir,              
                'lbr3_akhir'=>$transaksi->lbr3_akhir,              
                'lbr4_akhir'=>$transaksi->lbr4_akhir,
				'lbrjml_akhir'=>$jml2,              
				//'persen'=>$persen,              
                'tgl_nihil1'=>$transaksi->tgl_nihil1,              
                'tgl_nihil2'=>$transaksi->tgl_nihil2,              
                'realisasi'=>$transaksi->realisasi,                         
                'tgl_insert'=>$transaksi->tgl_insert,  
				'keterangan'=>$transaksi->keterangan,   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  

	public function Distribusi_upload_kogol(){
		 
		
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			
			$upload = $this->Distribusi_model->upload_file($this->filename);
			
			//log_message('error',$upload['result']);
			
			if($upload['result']<> "failed"){ // Jika proses upload sukses
				
				$filename = $upload['result'];
				// Load plugin PHPExcel nya
				
				/*log_message('error','====');
				log_message('error', APPPATH.'third_party/PHPExcel/PHPExcel.php');
				log_message('error', $this->filename);
				log_message('error','====');*/
				
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$filename); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
				$data['filename'] = $filename;	
				
			/*	$data['kode_unit'] = $this->input->post('kode_unit');
			$data['tgl_tagihandoc'] = $this->input->post('tgl_tagihandoc');
				$data['unitpln']=$this->General_model->unitpln();
				$data['vendor']=$this->General_model->vendor();	*/
		
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; 
				log_message('error',$upload['error']);
			}
		}
		
		//$this->load->view('tracking/tracking_upload', $data);
		$this->template->display('Distribusi/tb_Distribusi_upload_kogol', $data);
		//$this->load->view('tracking/form', $data);
	}
	
	public function Distribusi_upload_lembar(){
		 
		
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			
			$upload = $this->Distribusi_model->upload_file($this->filename);
			
			//log_message('error',$upload['result']);
			
			if($upload['result']<> "failed"){ // Jika proses upload sukses
				
				$filename = $upload['result'];
				// Load plugin PHPExcel nya
				
				/*log_message('error','====');
				log_message('error', APPPATH.'third_party/PHPExcel/PHPExcel.php');
				log_message('error', $this->filename);
				log_message('error','====');*/
				
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$filename); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
				$data['filename'] = $filename;
				$data['tgl_tagihan'] = $this->input->post('tgl_tagihan');				
				
			/*	$data['kode_unit'] = $this->input->post('kode_unit');
			$data['tgl_tagihandoc'] = $this->input->post('tgl_tagihandoc');
				$data['unitpln']=$this->General_model->unitpln();
				$data['vendor']=$this->General_model->vendor();	*/
		
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; 
				log_message('error',$upload['error']);
			}
		}
		
		//$this->load->view('tracking/tracking_upload', $data);
		$this->template->display('Distribusi/tb_Distribusi_upload_lembar2', $data);
		//$this->load->view('tracking/form', $data);
	}
	
	public function Distribusi_import_lembar(){
		
		$namafile=$this->input->post('namafile');
		//log_message('error',$namafile);
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$namafile); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		$tgl='current_date()';
		$numrow = 1;
		$rand = rand(1, 1000000);
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 2){
				
			//	log_message('error',$row['E']);
				
				// Kita push (add) array data ke variabel data
				array_push($data, array(
				'unitup' =>$row['A'],
				'lembar' =>str_replace(",","",$row['B']),
				'jml_plg' =>str_replace(",","",$row['C']),
				'jml_lbr' =>str_replace(",","",$row['D']),
				'rpptl' =>str_replace(",","",$row['E']),
				'rpbpju' =>str_replace(",","",$row['F']),
				'rpppn' =>str_replace(",","",$row['G']),
				'rpmat' =>str_replace(",","",$row['H']),
				'rplain' =>str_replace(",","",$row['I']),
				'rptag' =>str_replace(",","",$row['J']),
				'rpbk' =>str_replace(",","",$row['K']),
				'keterangan' =>$rand,
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		//print_r($data);
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		//$this->db->set('tgl_insert', 'current_date()', FALSE);
		$this->Distribusi_model->insert_Distribusi_lembar($data);
		
		//$this->db->query("CALL proc_Distribusi_lembar('$rand')");
		
		redirect("Distribusi/data_lembar"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
	
	public function Distribusi_import_lembar2(){
		
		$namafile=$this->input->post('namafile');
		//log_message('error',$namafile);
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$namafile); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		$tgl='current_date()';
		$numrow = 1;
		$rand = rand(1, 1000000);
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 7){
				
			//	log_message('error',$row['E']);
				
				// Kita push (add) array data ke variabel data
				array_push($data, array(
				'kd_rayon' =>$row['D'],
				'nama_rayon' =>str_replace(",","",$row['E']),
				'lbr_awal1' =>str_replace(",","",$row['F']),
				'lbr_awal2' =>str_replace(",","",$row['G']),
				'lbr_awal3' =>str_replace(",","",$row['H']),
				'lbr_awal4' =>str_replace(",","",$row['I']),
				'lbr_akhir1' =>str_replace(",","",$row['K']),
				'lbr_akhir2' =>str_replace(",","",$row['L']),
				'lbr_akhir3' =>str_replace(",","",$row['M']),
				'lbr_akhir4' =>str_replace(",","",$row['N']),
				'tgl_nihil1' =>$row['Q'],
				'tgl_nihil2' =>$row['R'],
				'realisasi' =>str_replace(",","",$row['S']),
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		//print_r($data);
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		//$this->db->set('tgl_insert', 'current_date()', FALSE);
		$this->Distribusi_model->insert_Distribusi_lembar2($data);
		
		//$this->db->query("CALL proc_Distribusi_lembar('$rand')");
		
		redirect("Distribusi/data_lembar"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
	
	public function Distribusi_import(){
		
		$namafile=$this->input->post('namafile');
		//log_message('error',$namafile);
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$namafile); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		$tgl='current_date()';
		$numrow = 1;
		$rand = rand(1, 1000000);
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				
			//	log_message('error',$row['E']);
				
				// Kita push (add) array data ke variabel data
				array_push($data, array(
				'unitupi' =>$row['A'],
				'unitap' =>$row['B'],
				'unitup' =>$row['D'],
				'kogol' =>$row['C'],
				'lembar' =>str_replace(",","",$row['E']),
				'rpptl' =>str_replace(",","",$row['F']),
				'rpbpju' =>str_replace(",","",$row['G']),
				'rpppn' =>str_replace(",","",$row['H']),
				'rpmat' =>str_replace(",","",$row['I']),
				'rplain' =>str_replace(",","",$row['J']),
				'rptag' =>str_replace(",","",$row['K']),
				'rpbk' =>str_replace(",","",$row['L']),
				'keterangan' =>$rand,
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		//print_r($data);
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		//$this->db->set('tgl_insert', 'current_date()', FALSE);
		$this->Distribusi_model->insert_Distribusi_kogol($data);
		
		$this->db->query("CALL proc_Distribusi_kogol('$rand')");
		
		redirect("Distribusi/data_kogol"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
	
	
}
