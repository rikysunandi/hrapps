<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi_model extends CI_Model {

    public $table = 'tb_transaksi';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }
	
	function get_tb_lead_measure($unitpln,$unitpln2,$tglpilih,$tglpilih2,$bidang) {		
		if ($unitpln == '0') {
			$q ="DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' ";
		} else if ($unitpln <> '0' && $unitpln2 == '0'){
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' and a.unitap='$unitpln' ";
		} else {
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' and a.unitap='$unitpln' and a.unitup='$unitpln2' ";
		}
		
        return $this->db->query("
		select case when round(((a.pencapaian/a.target)*100),0) is null then '0'
		else round(((a.pencapaian/a.target)*100),0) end persen,a.*,b.nama namaap,c.nama namaup from tb_lead_measure a,tb_unitap b,tb_unitup c
			where $q and a.bidang='$bidang'
		and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
		order by a.unitap,a.unitup,a.id_lm,a.tanggal asc
		")->result();
    }
	
	function get_tb_rekap_lead_measure($unitpln,$unitpln2,$tglpilih,$bidang) {		
		if ($unitpln == '0') {
			$q ="DATE_FORMAT(tanggal, '%Y-%m-%d')='$tglpilih' ";
		} else if ($unitpln <> '0' && $unitpln2 == ''){
			$x = "where unitap='$unitpln' ";
			$q ="DATE_FORMAT(tanggal, '%Y-%m-%d')='$tglpilih' ";
		} else {
			$x = "where unitap='$unitpln' and unitup='$unitpln2' ";
			$q ="DATE_FORMAT(tanggal, '%Y-%m-%d')='$tglpilih' ";
		}
		
        return $this->db->query("		
		select unitup,unitap,nama namaap,namaup,count(target) target,count(pencapaian) pencapaian
from (select a.unitup,a.unitap,d.nama,a.nama namaup,b.unitup u2,b.target,b.pencapaian from tb_unitup a
left join tb_data_lead_measure b
on a.unitup = b.unitup and $q and b.bidang='$bidang'
left join tb_unitap d
on a.unitap=d.unitap) c
$x
group by unitup
order by unitap asc,unitup asc")->result();
    }
	
	function get_tb_rekap_pencapaian_lead_measure($id_wig,$id_lm,$unitpln,$unitpln2,$tglpilih,$bidang) {		
		
		if ($unitpln <> '0' && $unitpln2 == '') {
			$x = "b.unitap='$unitpln' and";
		} else if ($unitpln <> '0' && $unitpln2 <> '') {
			$x = "b.unitap='$unitpln' and b.unitup='$unitpln2' and";
		} 
		
		if ($id_wig <> '0') {
			$q = "b.id_lm = '$id_lm' and";
		} else {
			$bagi = '/3';
		}
		
        return $this->db->query("
select unitap,namaap,unitup,namaup,senin,selasa,rabu,kamis,jumat,sabtu,(dist_nilai(senin)+dist_nilai(selasa)+dist_nilai(rabu)+dist_nilai(kamis)+dist_nilai(jumat)+dist_nilai(sabtu)) nilai from (
select c.unitap,c.nama namaap,a.unitup,a.nama namaup,ifnull(round(sum(case when WEEKDAY(b.tanggal)=0 then 
ifnull((b.pencapaian),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=0 then 
ifnull((b.target),0)
else 0 end)*100$bagi,0),0) senin
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=1 then 
ifnull((b.pencapaian),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=1 then 
ifnull((b.target),0)
else 0 end)*100$bagi,0),0) selasa
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=2 then 
ifnull((b.pencapaian),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=2 then 
ifnull((b.target),0)
else 0 end)*100$bagi,0),0) rabu
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=3 then 
ifnull((b.pencapaian),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=3 then 
ifnull((b.target),0)
else 0 end)*100$bagi,0),0) kamis
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=4 then 
ifnull((b.pencapaian),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=4 then 
ifnull((b.target),0)
else 0 end)*100$bagi,0),0) jumat
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=5 then 
ifnull((b.pencapaian),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=5 then 
ifnull((b.target),0)
else 0 end)*100$bagi,0),0) sabtu
from tb_unitup a
left join tb_lead_measure b
on a.unitup = b.unitup and $x $q b.tanggal between SUBDATE(DATE_FORMAT('$tglpilih', '%Y-%m-%d'), WEEKDAY(DATE_FORMAT('$tglpilih', '%Y-%m-%d'))-0)
and SUBDATE(DATE_FORMAT('$tglpilih', '%Y-%m-%d'), WEEKDAY(DATE_FORMAT('$tglpilih', '%Y-%m-%d'))-5) and b.bidang='DISTRIBUSI'
left join tb_unitap c
on a.unitap = c.unitap
group by a.unitup
order by a.unitap asc,a.unitup asc) x
order by nilai desc")->result();
    }
	
	function get_tb_data_kogol($unitpln,$unitpln2,$tglpilih) {
		if ($unitpln == 0 && $unitpln2 == 0) {
			$q ="";
		} else if ($unitpln <> 0 && $unitpln2 == 0){
			$q = "and a.unitap='$unitpln'";
		} else {
			$q = "and a.unitap='$unitpln' and a.unitup='$unitpln2'";
		}
        return $this->db->query("select a.*,b.nama namaap,c.nama namaup from tb_tunggakan_kogol a,tb_unitap b,tb_unitup c
					where DATE_FORMAT(a.tgl_insert, '%Y-%m-%d')='$tglpilih' $q
					and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
					and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
					order by a.unitap,a.unitup asc")->result();
    }	
	
	function get_tb_data_lembar($unitpln,$tglpilih) {
		
		if ($unitpln == 0 && $unitpln2 == 0) {
			$q ="";
		} else if ($unitpln <> 0 && $unitpln2 == 0){
			$q = "and a.unitap='$unitpln'";
		} else {
			$q = "and a.unitap='$unitpln' and a.unitup='$unitpln2'";
		}
		
        return $this->db->query("
		select a.*,b.nama namaap,c.nama namaup from tb_tunggakan_lembar a,tb_unitap b,tb_unitup c
			where DATE_FORMAT(a.tgl_insert, '%Y-%m-%d')='$tglpilih' $q
		and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
		order by a.unitap,a.unitup asc
		")->result();
    }	
	
	function get_tb_data_lembar2($unitpln,$unitpln2,$tglpilih) {
		
		if ($unitpln == 0 && $unitpln2 == 0) {
			$q ="";
		} else if ($unitpln <> 0 && $unitpln2 == 0){
			$q = "and a.unitap='$unitpln'";
		} else {
			$q = "and a.unitap='$unitpln' and a.unitup='$unitpln2'";
		}	
		
        return $this->db->query("
		select a.*,c.nama namaup from tb_tunggakan_lembar a,tb_unitap b,tb_unitup c
			where DATE_FORMAT(a.tgl_insert, '%Y-%m-%d')='$tglpilih' $q
		and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
		order by a.unitap,a.unitup asc
		")->result();
    }	
	
	function get_m_unitup() {
        return $this->db->query("SELECT * from tb_m_unit_up")->result();
    }
	
	function tambah_lm($id_wig,$id_lm,$satuan,$target,$keterangan,$unitap,$unitup,$bidang) {

		 return $this->db->query("CALL tambah_lm('$id_wig','$id_lm','$satuan','$target','$keterangan','$unitap','$unitup','$bidang')");
		
	}
	
	function get_lm_id($id) {
        return $this->db->query("SELECT * from tb_lead_measure where id='$id'")->result();
    }
	
	public function upload_file($filename){
		
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '0';
		$config['overwrite'] = true;
		$config['file_name'] = $this->upload->file_name;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => $this->upload->file_name, 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	public function insert_Distribusi_kogol($data){	
		
		
		$this->db->insert_batch('tb_tunggakan_kogol_temp', $data); 
     //	$this->db->query("DROP temporary table dashboard.tb_tunggakan_kogol_temp")->result();

	}
	
	public function insert_Distribusi_lembar($data){	
		
		
	//	$this->db->insert_batch('tb_tunggakan_lembar', $data); 
     //	$this->db->query("DROP temporary table dashboard.tb_tunggakan_kogol_temp")->result();
		$numrow = 1;
		$unitups=null;
		$tgl_insert = date("Y-m-d h:i:s");
		foreach ($data as $datas) {	
					$unitup = $datas['unitup'];
					$lembar = $datas['lembar'];
					$jml_plg = $datas['jml_plg']; //$no_tagihan
					$jml_lbr = $datas['jml_lbr']; //$no_doc
					$rpptl = $datas['rpptl']; //$kd_vendor
					$rpbpju = $datas['rpbpju']; //$no_account 
					$rpppn = $datas['rpppn']; //$tgl_doc
					$rpmat = $datas['rpmat']; //$tgl_posting
					$rplain = $datas['rplain']; //$rupiah	
					$rptag = $datas['rptag']; //$bus_area	
					$rpbk = $datas['rpbk']; //$bus_area	
					$keterangan = $datas['keterangan']; //$bus_area	
		if($numrow > 0){
			/*	if($unitups) {
						$unitups;
					} else {
					   $unitups = $unitup;
				} */
				
				if ($lembar <> '') {
				$this->db->query("CALL proc_Distribusi_lembar('$unitup','$lembar','$jml_plg','$jml_lbr','$rpptl','$rpbpju','$rpppn','$rpmat','$rplain','$rptag','$rpbk','$keterangan','$tgl_insert')");
				}
				           
           
		   
        }
		   $numrow++;
		}
			
			$this->db->query("insert into tb_refnum (refnum) values ('$keterangan')"); 
	}
	
	public function insert_Distribusi_lembar2($data){	
		
		
	//	$this->db->insert_batch('tb_tunggakan_lembar', $data); 
     //	$this->db->query("DROP temporary table dashboard.tb_tunggakan_kogol_temp")->result();
		$numrow = 1;
		$unitups=null;
		$tgl_insert = date("Y-m-d h:i:s");
		$keterangan = 'lembar';
		foreach ($data as $datas) {	
					$kd_rayon = preg_replace('/^$/','0',trim($datas['kd_rayon']));		
					$nama_rayon = preg_replace('/^$/','0',trim($datas['nama_rayon']));		
					$lbr_awal1 = preg_replace('/^$/','0',trim($datas['lbr_awal1']));
					$lbr_awal2 = preg_replace('/^$/','0',trim($datas['lbr_awal2']));
					$lbr_awal3 = preg_replace('/^$/','0',trim($datas['lbr_awal3']));
					$lbr_awal4 = preg_replace('/^$/','0',trim($datas['lbr_awal4']));
					$lbr_akhir1 = preg_replace('/^$/','0',trim($datas['lbr_akhir1']));
					$lbr_akhir2 = preg_replace('/^$/','0',trim($datas['lbr_akhir2']));
					$lbr_akhir3 = preg_replace('/^$/','0',trim($datas['lbr_akhir3']));
					$lbr_akhir4 = preg_replace('/^$/','0',trim($datas['lbr_akhir4']));
					$tgl_nihil1 = preg_replace('/^$/','0',trim($datas['tgl_nihil1']));
					$tgl_nihil2 = preg_replace('/^$/','0',trim($datas['tgl_nihil2']));
					$realisasi = $datas['realisasi'];
		if($numrow > 0){
			/*	if($unitups) {
						$unitups;
					} else {
					   $unitups = $unitup;
				} */
				//log_message('error',$tgl_nihil1);
				//log_message('error','20'.substr($tgl_nihil1,6,2).substr($tgl_nihil1,3,2).substr($tgl_nihil1,0,2));
				
				$tgl1 = '20'.substr($tgl_nihil1,6,2).substr($tgl_nihil1,0,2).substr($tgl_nihil1,3,2);
				$tgl2 = '20'.substr($tgl_nihil2,6,2).substr($tgl_nihil2,0,2).substr($tgl_nihil2,3,2);
				if ($kd_rayon <> '') {
				$this->db->query("CALL proc_Distribusi_lembar2('$kd_rayon','$nama_rayon','$lbr_awal1','$lbr_awal2','$lbr_awal3','$lbr_awal4',
				'$lbr_akhir1','$lbr_akhir2','$lbr_akhir3','$lbr_akhir4','$tgl1','$tgl2','$realisasi','$tgl_insert')");
				}
				           
           
		   
        }
		   $numrow++;
		}
			
			$this->db->query("insert into tb_refnum (refnum) values ('$keterangan')"); 
	}
	
}