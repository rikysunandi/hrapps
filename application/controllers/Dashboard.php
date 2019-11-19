<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        chek_session();
    }

	function dash_asli(){ 
	
		$this->template->display('dashboard/dashboard_asli');
			
	}
	
	function dashurl(){ 
	 //redirect('http://10.2.6.111/dashboard/src/main/template/dashboard.php');.
	  $this->template->display('dashboard/dashboard_url');
	
	}
	
    function index() {
       $this->template->display('dashboard/dashboard_url');
		}
		
        
}
