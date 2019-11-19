<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi_new_model extends CI_Model {

    public $table = 'tb_transaksi';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }
	
	function get_tb_lead_measure($unitpln,$unitpln2,$tglpilih,$tglpilih2,$bidang,$vlm) {
	
	//log_message('error',$unitpln.'-'.$unitpln2);
		
		if ($unitpln == '0') {
			$q ="DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' ";
		} else if ($unitpln <> '0' && $unitpln2 == '0'){
			$x = "a.unitap='$unitpln' and";
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' and a.unitap='$unitpln' ";
		} else {
			$x = "a.unitap='$unitpln' and a.unitup='$unitpln2' and";
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' and a.unitap='$unitpln' and a.unitup='$unitpln2' ";
		}
		
		if ($vlm == '0') {
			$r ="";
		} else {
			$r = "AND a.id_lm='$vlm' ";
		} 
		
        return $this->db->query("select a.id_lm,d.nama_bidang,e.nama_wig,f.nama_lm,case when round(((a.pencapaian_1/a.target_1)*100),0) is null then '0'
		else round(((a.pencapaian_1/a.target_1)*100),0) end persen1,
		case when round(((a.pencapaian_2/a.target_2)*100),0) is null then '0'
		else round(((a.pencapaian_2/a.target_2)*100),0) end persen2,a.*,b.nama namaap,c.nama namaup 
		from tb_data_lead_measure a,tb_unitap b,tb_unitup c, tb_m_bidang d, tb_m_wig e, tb_m_lm f
			where $x $q and a.id_bidang='$bidang' $r
		and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
		and a.id_bidang=d.id_bidang and a.id_wig=e.id_wig and a.id_lm=f.id_lm    
		 group by a.tanggal,a.id_lm,a.unitap,a.unitup
        order by a.tanggal,a.unitap,a.id_bidang asc")->result();
    }
	
	function tambah_lm($tanggal,$id_wig,$target1,$target2,$realisasi1,$realisasi2,$keterangan,$unitap,$unitup,$bidang) {
			
		try {
			$query_str = "CALL tambah_lm_dist('$tanggal','$id_wig','$target1','$target2','$realisasi1','$realisasi2','$keterangan','$unitap','$unitup','$bidang')";
			$result = $this->db->query($query_str);

		if (!$result)
		{
			throw new Exception('error in query');
			return false;
		}        

			return true;

		} catch (Exception $e) {
			return;
		}

	}
	
	function get_lm_id($id) {
        return $this->db->query("SELECT a.id,a.unitap,a.unitup,a.id_lm,b.nama_lm,
				a.target_1 target1,a.target_2 target2,a.pencapaian_1 pencapaian1,a.pencapaian_2 pencapaian2,
				a.tanggal from 
				tb_data_lead_measure a, tb_m_lm b where a.id='$id' and a.id_lm = b.id_lm")->result();
    }
	
	function get_tb_rekap_lead_measure($unitpln,$unitpln2,$tglpilih,$tglpilih2,$bidang,$vlm) {		
		
		if ($unitpln == '0') {
			$q ="DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' ";
		} else if ($unitpln <> '0' && $unitpln2 == '0'){
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' and a.unitap='$unitpln' ";
		} else {
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m-%d') between '$tglpilih' and '$tglpilih2' and a.unitap='$unitpln' and a.unitup='$unitpln2' ";
		}
		
		if ($vlm == '0') {
			$r ="";
		} else {
			$r = "AND a.id_lm='$vlm' ";
		} 
		
        return $this->db->query("select a.id_lm,d.nama_bidang,e.nama_wig,f.nama_lm,case when round(((sum(a.pencapaian_1)/sum(a.target_1))*100),0) is null then '0'
        else round(((sum(a.pencapaian_1)/sum(a.target_1))*100),0) end persen1,
        case when round(((sum(a.pencapaian_2)/sum(a.target_2))*100),0) is null then '0'
        else round(((sum(a.pencapaian_2)/sum(a.target_2))*100),0) end persen2,
        a.target_1 target_1,a.target_2 target_2,a.pencapaian_1 pencapaian_1,a.pencapaian_2 pencapaian_2,b.nama namaap,c.nama namaup 
        from tb_data_lead_measure a,tb_unitap b,tb_unitup c, tb_m_bidang d, tb_m_wig e, tb_m_lm f
            where $q and a.id_bidang='$bidang' $r
		and a.unitap=c.unitap and a.unitup = c.unitup and a.unitap = b.unitap
        and a.id_bidang=d.id_bidang and a.id_wig=e.id_wig and a.id_lm=f.id_lm    
        group by a.id_bidang,a.id_wig,a.id_lm,a.unitupi,a.unitap,a.unitup
        order by a.unitap,a.unitup,a.id_bidang,a.id_wig,a.id_lm,a.tanggal asc")->result();
    }
	
	function get_tb_rekap_lead_measure_bln($unitpln,$unitpln2,$tglpilih,$tglpilih2) {		
		
		/*if ($unitpln == '0') {
			$q ="DATE_FORMAT(a.tanggal, '%Y-%m') = substring('$tglpilih',1,7) ";
		} else if ($unitpln <> '0' && $unitpln2 == '0'){
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m') = substring('$tglpilih',1,7) and a.unitap='$unitpln' ";
		} else {
			$q = "DATE_FORMAT(a.tanggal, '%Y-%m') = substring('$tglpilih',1,7) and a.unitap='$unitpln' and a.unitup='$unitpln2' ";
		}
		
        return $this->db->query("select
		unitap,namaap,unitup,namaup,
		sum(t11) t11,
        sum(p11) p11,
		sum(t12) t12,
        sum(p12) p12,
		sum(t21) t21,
        sum(p21) p21,
		sum(t22) t22,
        sum(p22) p22,
		sum(t31) t31,
        sum(p31) p31,
		sum(t32) t32,
        sum(p32) p32
		from vw_dist_rekap_lm a where $q
		group by DATE_FORMAT(a.tanggal, '%Y-%m')
		order by a.unitap asc ")->result();*/
		
		return $this->db->query("call getDistRekapLM('53','$unitpln','$unitpln2','$tglpilih','$tglpilih2')")->result();
    }
	
	function get_tb_mon_lead_measure($unitpln,$unitpln2,$tglpilih,$bidang) {		
		if ($unitpln == '0') {
			$q ="DATE_FORMAT(tanggal, '%Y-%m-%d')='$tglpilih' ";
		} else if ($unitpln <> '0' && $unitpln2 == '0'){
			$x = "where unitap='$unitpln' ";
			$q ="DATE_FORMAT(tanggal, '%Y-%m-%d')='$tglpilih' ";
		} else {
			$x = "where unitap='$unitpln' and unitup='$unitpln2' ";
			$q ="DATE_FORMAT(tanggal, '%Y-%m-%d')='$tglpilih' ";
		}
		
        return $this->db->query("		
		select unitup,unitap,nama namaap,namaup,count(target_1) target,count(pencapaian_1) pencapaian
from (select a.unitup,a.unitap,d.nama,a.nama namaup,b.unitup u2,b.target_1,b.pencapaian_1 from tb_unitup a
left join tb_data_lead_measure b
on a.unitup = b.unitup and $q and b.id_bidang='1'
left join tb_unitap d
on a.unitap=d.unitap) c $x
group by unitup
order by unitap asc,unitup asc")->result();
    }
	
function get_tb_rekap_pencapaian_lead_measure($id_wig,$unitpln,$unitpln2,$tglpilih,$bidang) {		
		
		//log_message('error',$unitpln.'-'.$unitpln2);
		
		if ($unitpln == '0') {
			$x ="";
		} else if ($unitpln <> '0' && $unitpln2 == '0'){
			$x = "where b.unitap='$unitpln'";
		} else {
			$x = "where b.unitap='$unitpln' and b.unitup='$unitpln2'";
		}
		
		if ($id_wig <> '0') {
			$q = "b.id_lm = '$id_wig' and";
		} else {
			$bagi = '/3';
		}
		
        return $this->db->query("
select unitap,namaap,unitup,namaup,senin,selasa,rabu,kamis,jumat,sabtu,(dist_nilai(senin)+dist_nilai(selasa)+dist_nilai(rabu)+dist_nilai(kamis)+dist_nilai(jumat)+dist_nilai(sabtu)) nilai from (
select c.unitap,c.nama namaap,a.unitup,a.nama namaup,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=0 then 
ifnull((b.pencapaian_2),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=0 then 
ifnull((b.target_2),0)
else 0 end)*100/3,0),0) senin
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=1 then 
ifnull((b.pencapaian_2),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=1 then 
ifnull((b.target_2),0)
else 0 end)*100$bagi,0),0) selasa
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=2 then 
ifnull((b.pencapaian_2),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=2 then 
ifnull((b.target_2),0)
else 0 end)*100$bagi,0),0) rabu
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=3 then 
ifnull((b.pencapaian_2),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=3 then 
ifnull((b.target_2),0)
else 0 end)*100$bagi,0),0) kamis
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=4 then 
ifnull((b.pencapaian_2),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=4 then 
ifnull((b.target_2),0)
else 0 end)*100$bagi,0),0) jumat
,
ifnull(round(sum(case when WEEKDAY(b.tanggal)=5 then 
ifnull((b.pencapaian_2),0)
else 0 end)/sum(case when WEEKDAY(b.tanggal)=5 then 
ifnull((b.target_2),0)
else 0 end)*100$bagi,0),0) sabtu
from tb_unitup a
left join tb_data_lead_measure b
on a.unitup = b.unitup and $q b.tanggal between SUBDATE(DATE_FORMAT('$tglpilih', '%Y-%m-%d'), WEEKDAY(DATE_FORMAT('$tglpilih', '%Y-%m-%d'))-0)
and SUBDATE(DATE_FORMAT('$tglpilih', '%Y-%m-%d'), WEEKDAY(DATE_FORMAT('$tglpilih', '%Y-%m-%d'))-5) and b.id_bidang='1'
left join tb_unitap c
on a.unitap = c.unitap
$x
group by a.unitup
order by a.unitap asc,a.unitup asc) x
order by nilai desc")->result();
    }
	
}