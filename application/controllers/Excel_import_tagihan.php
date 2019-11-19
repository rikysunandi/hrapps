<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import_tagihan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('excel_import_tagihan_model');
		$this->load->library('excel');
	}

	function index()
	{
		$this->load->view('tb_tracking_upload');
	}
	
	function fetch()
	{
		$data = $this->excel_import_model->select();
		$output = '
		<h3 align="center">Total Data - '.$data->num_rows().'</h3>
		<table class="table table-striped table-bordered">
			<tr>
				<th>id</th>
				<th>kode_vendor</th>
				<th>kode_pln</th>
				<th>tgl_tagihan Code</th>
				<th>no_tagihan</th>
			</tr>
		';
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->kode_vendor.'</td>
				<td>'.$row->kode_pln.'</td>
				<td>'.$row->tgl_tagihan.'</td>
				<td>'.$row->no_tagihan.'</td>
				
			</tr>
			';
		}
		$output .= '</table>';
		echo $output;
	}

	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$data[] = array(
						'CustomerName'		=>	$customer_name,
						'Address'			=>	$address,
						'City'				=>	$city,
						'PostalCode'		=>	$postal_code,
						'Country'			=>	$country
					);
				}
			}
			$this->excel_import_model->insert($data);
			echo 'Data Imported successfully';
		}	
	}
}

?>