<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
    // get data dropdown
    function getUnitPln()
    {
		$result = $this->db->query("select * from tb_unitup order by unitap asc");
        return $result;
    } 
	
	
	 function getUnitPln2()
    {
		$result = $this->db->query("select * from tb_unitap order by unitap asc");
       
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
			return array();
		}
    } 
	
	function getUnitPln_by($unit)
    {
		$uid=$this->session->userdata('company');
		$uid2=$this->session->userdata('kode_vendor');

		$sql = "select * from tb_unitup where unitap='$unit' order by unitap asc";
		
		$result = $this->db->query($sql);
       
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
			return array();
		}
    }
	
	function getUnitAp_by()
    {
		//log_message('error',$this->session->userdata('kode_vendor'));
		//log_message('error',$this->session->userdata('company'));
		$kodeunit=$this->session->userdata('kode_vendor');
		
		if ($this->session->userdata('company') == 'UP3') {
			$q=" select b.nama,b.unitap from tb_unitup a,tb_unitap b
			where a.unitap=b.unitap and a.unitap='$kodeunit'
			order by unitap asc";
		} if ($this->session->userdata('company') == 'ULP') {
			$q=" select b.nama,b.unitap from tb_unitup a,tb_unitap b
				where a.unitap=b.unitap and a.unitup='$kodeunit'
				order by unitap asc";
		} else {
			$q="select nama,unitap from tb_unitap order by unitap asc ";
		}

		/*if ($kodeunit == 0){
		$q="select nama,unitap from tb_unitap order by unitap asc ";	
		} else {
		$q=" select b.nama,b.unitap from tb_unitup a,tb_unitap b
		where a.unitap=b.unitap and a.unitup='$kodeunit'
		order by unitap asc";
		}*/
		
		return $this->db->query($q)->result();
    }
	
	function getUnitUp_by($unit)
    {
		$idunit=$this->session->userdata('company');
		$kodeunit=$this->session->userdata('kode_vendor');
		
		//log_message('error',$idunit);
		
		if ($idunit == 'ULP') {
			$q="select * from tb_unitup where unitup = '$kodeunit' order by unitup asc";
		} if ($kodeunit == 0) {
			$q="select * from tb_unitup where unitap = '$unit' order by unitup asc";
		} else {
			$q="select * from tb_unitup where unitap = '$unit' order by unitup asc";
		}
		return $this->db->query($q)->result();

    }
	
	function getVendorPln()
    {
		$uid=$this->session->userdata('company');
		$uid2=$this->session->userdata('kode_vendor');
		if ($uid == 'PLNID'){
			$sql='select * from tb_m_vendor order by nama_vendor asc';
		} else {
			$sql="select * from tb_m_vendor order by kode_vendor asc";
		}
		
		$result = $this->db->query($sql);
       
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
			return array();
		}
    }
	
	function GetWig(){
		$result=$this->db->query("select * from tb_master_wig order by id_wig asc");
		if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
			return array();
		}
	}
	
	function GetLm_by($by,$bidang){
		//log_message('error',$by);
		$result=$this->db->query("select * from tb_master_lm where id_wig='$by' and bidang='$bidang' order by id_wig,id_lm asc");
		if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
			return array();
		}
	}
	
	function GetSubLm_by($by,$bidang){
		//log_message('error',$by);
		$result=$this->db->query("select * from tb_m_lm_sub where id_lm='$by' and bidang='$bidang' order by id_lm,id_lm_sub asc");
		if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
			return array();
		}
	}
	
	function unitpln(){
		$hsl=$this->db->query("select * from tb_unitap order by unitap asc");
		return $hsl;
	}

	function vendor(){
		$uid=$this->session->userdata('kode_vendor');
		if ($uid == '0000'){
			$sql='select * from tb_m_vendor order by nama_vendor asc';
		} else {
			$sql="select * from tb_m_vendor where kode_vendor=$uid order by kode_vendor asc";
		}
		$hsl=$this->db->query($sql);
		return $hsl;
	}
}