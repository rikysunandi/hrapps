<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi_new extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Distribusi_new_model');
        $this->load->model('General_model');
        $this->load->library('form_validation');
        chek_session();
    }
		
	public function input_lm() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
		$data['wig'] = $this->db->query("select * from tb_m_lm where id_wig='1' order by id_lm asc")->result();
		$this->template->display('Distribusi_New/tb_distribusi_lm',$data);
    }

	function view_lead_measure(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$tglpilih2=$this->input->post('tglpilih2');
		$vlm=$this->input->post('vlm');
		$bidang='1';
		
		//log_message('error',$unitpln.'-'.$unitpln2);
        $no=1;               
        $transaksi_data = $this->Distribusi_new_model->get_tb_lead_measure($unitpln,$unitpln2,$tglpilih,$tglpilih2,$bidang,$vlm);
            foreach ($transaksi_data as $transaksi) {
				log_message('error',$this->session->userdata('company'));
				log_message('error',$transaksi->tanggal.'***'.date('Y-m-d'));
				
				if($this->session->userdata('company') <> 'ULP'){
				$edit = '<a class="btn btn-xs btn-info" href="javascript:void(0)" title="update" onclick="edit_lm('."'".$transaksi->id."'".')"><i class="glyphicon glyphicon-edit"></i>edit</a>';
				} 
				else if($this->session->userdata('company') == 'ULP' && $transaksi->tanggal == date('Y-m-d')){
				$edit = '<a class="btn btn-xs btn-info" href="javascript:void(0)" title="update" onclick="edit_lm('."'".$transaksi->id."'".')"><i class="glyphicon glyphicon-edit"></i>edit</a>';
				}
			
			$persen1 = $transaksi->persen1;
			$status2 = '';
					if($persen1 >= '100'){
						$status1 = "<span class='label label-success'>$persen1</span>";
					} else if ($persen1 >= '70' && $persen1 < '100') {
						$status1 = "<span class='label label-warning'>$persen1</span>";
					} else {
						$status1 = "<span class='label label-danger'>$persen1</span>";
					};
			
			$persen2 = $transaksi->persen2;
			
					if($persen2 >= '100'){
						$status2 = "<span class='label label-success'>$persen2</span>";
					} else if ($persen2 >= '70' && $persen2 < '100') {
						$status2 = "<span class='label label-warning'>$persen2</span>";
					} else {
						$status2 = "<span class='label label-danger'>$persen2</span>";
					};
					
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'bidang'=>$transaksi->nama_bidang,               
                'nama_wig'=>$transaksi->nama_wig,                       
                'nama_lm'=>$transaksi->nama_lm,
                'tanggal'=>$transaksi->tanggal,				
                'target_1'=>$transaksi->target_1,              
                'pencapaian_1'=>$transaksi->pencapaian_1,    
                'target_2'=>$transaksi->target_2,              
                'pencapaian_2'=>$transaksi->pencapaian_2,
                'persen1'=>$status1,
                'persen2'=>$status2,
				'keterangan'=>$transaksi->keterangan,   				
				'edit'=>$edit,   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }
	
	function tambah_lm(){ 
		if ($this->session->userdata('company') <> 'ULP') {
		$tanggal=$this->input->post('tgllm');
		} else {
		$tanggal=date('Y-m-d');
		}
		
		$id_wig=$this->input->post('id_wig');
		$target1=$this->input->post('target11');
		$target2=$this->input->post('target22');
		$realisasi1=$this->input->post('realisasi11');
		$realisasi2=$this->input->post('realisasi22');
		$keterangan=$this->input->post('keterangan');
		$unitap=$this->input->post('id_unitpln3');
		$unitup=$this->input->post('id_unitpln4');
		$bidang='1';
		
			
		$hasil = $this->Distribusi_new_model->tambah_lm($tanggal,$id_wig,$target1,$target2,$realisasi1,$realisasi2,$keterangan,$unitap,$unitup,$bidang);		
		
		if($hasil) {
			$h='SUKSES TAMBAH DATA LM';
		} else {
			$h='XXX GAGAL TAMBAH DATA LM XXX';
		}
		$a = 'Tambah LM ||'.$h;
		
		$this->session->set_flashdata('msg', $a);
		log_message('error',$a);
		
		redirect("Distribusi_new/input_lm");
    } 
	
	function view_lm_id($id){ 
		//log_message('error',$id);
		$no=1;               
        $transaksi_data = $this->Distribusi_new_model->get_lm_id($id);
            foreach ($transaksi_data as $transaksi) {  
			
            $query[] = array(
                'no'=>$no++,
                'id'=>$transaksi->id,
                'unitap'=>$transaksi->unitap,
                'unitup'=>$transaksi->unitup,
                'id_lm'=>$transaksi->id_lm, 
                'nama_lm'=>$transaksi->nama_lm, 
                'target1'=>$transaksi->target1,
                'target2'=>$transaksi->target2,
                'pencapaian1'=>$transaksi->pencapaian1,
                'pencapaian2'=>$transaksi->pencapaian2,
                'tanggal'=>$transaksi->tanggal
            );
			
		 }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }
	
	function update_pencapaian_lm(){ 

		$ids=$this->input->post('ids');
		$unitap=$this->input->post('unitap');
		$unitup=$this->input->post('unitup');
		$tanggal=$this->input->post('tanggal');
		$id_lm=$this->input->post('id_lm');
		$nama_lm=$this->input->post('nama_lm');
		$pencapaian1=$this->input->post('pencapaian1');
		$pencapaian2=$this->input->post('pencapaian2');
		$target1=$this->input->post('target1');
		$target2=$this->input->post('target2');
		
		//log_message('error',$unitpln);
		
		$hasil =  $this->db->query("update tb_data_lead_measure set target_1=$target1,
									pencapaian_1=$pencapaian1, target_2=$target2,
									pencapaian_2=$pencapaian2, tgl_insert=current_timestamp
									where id='$ids'
									");
									
		//$hasil =  $this->db->query("insert into tb_refnum (keterangan) values ('LM')");
		   
		 if($hasil) {
			$h = 'SUKSES UPDATE DATA LM';
		 } else {
			$h='XXX GAGAL UPDATE XXX';
		 }
		 
		$a = 'UPDATE LM ||'.$h;
		
		$this->session->set_flashdata('msg', $a);
		log_message('error',$a);
		
		redirect("Distribusi_new/input_lm");
    }
	
	public function rekap_lm() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
		$data['wig'] = $this->db->query("select * from tb_m_lm where id_wig='1' order by id_lm asc")->result();
		$this->template->display('Distribusi_New/tb_distribusi_rekap_lm',$data);
    }

	function view_rekap_lead_measure(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$tglpilih2=$this->input->post('tglpilih2');
		$vlm=$this->input->post('vlm');
		$bidang='1';
		
		//log_message('error',$unitpln);
        $no=1;               
        $transaksi_data = $this->Distribusi_new_model->get_tb_rekap_lead_measure($unitpln,$unitpln2,$tglpilih,$tglpilih2,$bidang,$vlm);
            foreach ($transaksi_data as $transaksi) {
							
			$persen1 = $transaksi->persen1;
			$status2 = '';
					if($persen1 >= '100'){
						$status1 = "<span class='label label-success'>$persen1</span>";
					} else if ($persen1 >= '70' && $persen1 < '100') {
						$status1 = "<span class='label label-warning'>$persen1</span>";
					} else {
						$status1 = "<span class='label label-danger'>$persen1</span>";
					};
			
			$persen2 = $transaksi->persen2;
			
					if($persen2 >= '100'){
						$status2 = "<span class='label label-success'>$persen2</span>";
					} else if ($persen2 >= '70' && $persen2 < '100') {
						$status2 = "<span class='label label-warning'>$persen2</span>";
					} else {
						$status2 = "<span class='label label-danger'>$persen2</span>";
					};
					
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->namaap,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->namaup,               
                'bidang'=>$transaksi->nama_bidang,               
                'nama_wig'=>$transaksi->nama_wig,                       
                'nama_lm'=>$transaksi->nama_lm,
                'tanggal'=>$transaksi->tanggal,				
                'target_1'=>$transaksi->target_1,              
                'pencapaian_1'=>$transaksi->pencapaian_1,    
                'target_2'=>$transaksi->target_2,              
                'pencapaian_2'=>$transaksi->pencapaian_2,
                'persen1'=>$status1,
                'persen2'=>$status2,
				'keterangan'=>$transaksi->keterangan,   				   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }
	
	public function rekap_lm_bulan() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
		$data['wig'] = $this->db->query("select * from tb_m_lm where id_wig='1' order by id_lm asc")->result();
		$this->template->display('Distribusi_New/tb_distribusi_rekap_lm_bulan',$data);
    }

	function view_rekap_lead_measure_bulan(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$tglpilih2=$this->input->post('tglpilih2');
		$vlm=$this->input->post('vlm');
		$bidang='1';
		
		
        $no=1;               
        $transaksi_data = $this->Distribusi_new_model->get_tb_rekap_lead_measure_bln($unitpln,$unitpln2,$tglpilih,$tglpilih2);
            foreach ($transaksi_data as $transaksi) {
				
			
			$persen1=($transaksi->p11!=0)?($transaksi->p11/$transaksi->t11)*100:'';
			$persen2=($transaksi->p12!=0)?($transaksi->p12/$transaksi->t12)*100:'';
			$persen3=($transaksi->p21!=0)?($transaksi->p21/$transaksi->t21)*100:'';
			$persen4=($transaksi->p22!=0)?($transaksi->p22/$transaksi->t22)*100:'';
			$persen5=($transaksi->p31!=0)?($transaksi->p31/$transaksi->t31)*100:'';
			$persen6=($transaksi->p32!=0)?($transaksi->p32/$transaksi->t32)*100:'';
		
			$query[] = array(
                'no'=>$no++,
                'unitupi'=>$transaksi->unitupi,
                'unitap'=>$transaksi->unitap,                
                'namaap'=>$transaksi->unitap_nm,                
                'unitup'=>$transaksi->unitup,               
                'namaup'=>$transaksi->unitup_nm,                  
                't11'=>$transaksi->t11, 
				'p11'=>$transaksi->p11, 
				'per1'=>$this->iconpersen($persen1),
                't12'=>$transaksi->t12,                       
                'p12'=>$transaksi->p12,  
				'per2'=>$this->iconpersen($persen2),				
                't21'=>$transaksi->t21,                       
                'p21'=>$transaksi->p21, 
				'per3'=>$this->iconpersen($persen3),
				't22'=>$transaksi->t22, 
				'p22'=>$transaksi->p22,
				'per4'=>$this->iconpersen($persen4),				
                't31'=>$transaksi->t31,                      
                'p31'=>$transaksi->p31, 
				'per5'=>$this->iconpersen($persen5),                       
                't32'=>$transaksi->t32,                       
                'p32'=>$transaksi->p32, 
				'per6'=>$this->iconpersen($persen6),				   				
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }
	
	
	public function mon_lm() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
		$data['wig'] = $this->db->query("select * from tb_m_lm where id_wig='1' order by id_lm asc")->result();
		$this->template->display('Distribusi_new/tb_distribusi_mon_4dx',$data);
		
    }
	
	function view_mon_lead_measure(){ 

		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$bidang='DISTRIBUSI';
		
		//log_message('error',$unitpln);
		
        $no=1;               
        $transaksi_data = $this->Distribusi_new_model->get_tb_mon_lead_measure($unitpln,$unitpln2,$tglpilih,$bidang);
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
	
	
	public function rekap_capai() {    
		
		$data['data'] = $this->General_model->getUnitAp_by();
		$data['wig'] = $this->db->query("select * from tb_m_lm where id_wig='1' order by id_lm asc")->result();
		
		$this->template->display('Distribusi_new/tb_distribusi_rekap_pencapaian',$data);

    }
	
	function view_rekap_pencapaian_lead_measure(){ 
		$id_wig=$this->input->post('id_wig');
		$unitpln=$this->input->post('unitpln');
		$unitpln2=$this->input->post('unitpln2');
		$tglpilih=$this->input->post('tglpilih');
		$bidang='DISTRIBUSI';
		
		//log_message('error',$unitpln);
		//log_message('error',$this->nilai('100'));
		
        $no=1;               
        $transaksi_data = $this->Distribusi_new_model->get_tb_rekap_pencapaian_lead_measure($id_wig,$unitpln,$unitpln2,$tglpilih,$bidang);
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
	
	function nilai($nilai) {
		
		if ($nilai >= 100) {
                    $n = '3';
                } else if ($nilai >= 71 && $nilai < 100) {
                   $n = '2';
                } else if ($nilai >= 31 && $nilai <= 70) {
                   $n = '1';
                } else {
                    $n = '0';
                }
				
		return $n;
		
	}
	
	function icon($persen) {
		$persen2 = ($persen!=0)?number_format($persen,0):'';
		if ($persen >= 100) {
                    $icon = "<span class='label label-success'>$persen2</span>";
                } else if ($persen >= 71 && $persen < 100) {
                    $icon = "<span class='label label-warning'>$persen2</span>";
                } else if ($persen >= 31 && $persen <= 70) {
                    $icon = "<span class='label label-danger'>$persen2</span>";
                } else {
                    $icon = "<span class='label label-default'>$persen2</span>";
                }
				
		return $icon;
		
	}
	
	function iconpersen($persen) {
		$persen2 = ($persen!=0)?number_format($persen,0):'';
		
		if ($persen >= 100) {
                    $icon = "<span class='label label-success'>$persen2</span>";
                } else if ($persen >= 71 && $persen < 100) {
                    $icon = "<span class='label label-warning'>$persen2</span>";
                } else if ($persen >= 31 && $persen <= 70) {
                    $icon = "<span class='label label-danger'>$persen2</span>";
                } else {
                    $icon = "<span class='label label-default'>$persen2</span>";
                }
				
		return $icon;
		
	}
	
}
