
<section class='content-header'>
    <h1>
        UPLOAD
        <small>NIAGA - KOGOL</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Dashboard Niaga</a></li>
        <li class='active'>Upload KOGOL</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'> 
				
				<div class='box-header with-border'>
				<form method="post" action="<?php echo base_url("niaga/niaga_upload_kogol"); ?>" 
				enctype="multipart/form-data" > 

				<div class='col-md-3'>
				<input type="file" name="file" required>
				</div>
				<div class='col-md-2'>
				<input type="submit" name="preview" value="Preview" class="btn btn-primary btn-sm">
				</div>
				</form>
				<div class="table-responsive" id="customer_data">
					
				</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
	
		</div>
	</div>		
	 <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'> 
			
				<form method='post' action="<?php echo base_url("niaga/niaga_import"); ?>" onsubmit="return confirm('Pastikan Data yang akan di upload sudah benar?');">
				<div class='box-header with-border'>				       
					   <div class="col-md-4">
							<label class="control-label col-xs-5" >FILE:  <?php  
								echo $filename; 
								?> </label>							
                        </div>
				</div>
				<div class='box-header with-border'>
				<? $a= strtolower(str_replace('.xlxs','',substr($filename,-13)));
			
				$b= str_replace('-', '', $tgl_tagihan).'.xlsx';
				?>
				<input class="btn btn-primary btn-sm" type="submit" name="import" value="Import Data" />
				<input name="namafile" class="form-control" type="hidden" placeholder="Nama File...." style="width:335px;" value="<?php  
								echo $filename; 
								?>" > 
				</div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>NO</th>
								<th>Distribusi</th>
								<th>UP3</th>
								<th>ULP</th>
								<th>KOGOL</th>
								<th>LEMBAR</th>
                                <th>RPPTL</th>
								<th>RPBPJU</th>
								<th>RPPPN</th>
								<th>RPMAT</th>
								<th>RP LAIN</th>
								<th>RP TAGIHAN</th>
								<th>RP BK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            $numrow = 1;

						if (is_array($sheet) || is_object($sheet))
							{
                            foreach ($sheet as $datas) {			
								$kd_unit = $datas['A'];
								$kd_area = $datas['B'];
								$kd_rayon = $datas['D'];
								$kogol = $datas['C'];
								$lembar = $datas['E'];
								$rpptl = $datas['F'];
								$rpbpju = $datas['G'];
								$rpppn = $datas['H'];
								$rpmat = $datas['I'];
								$rplain = $datas['J'];
								$rptag = $datas['K'];
								$rpbk = $datas['L'];
								
							if($numrow > 1){
                                ?>
                                <tr>
								    <td><?php echo ++$start ?></td>
                                    <td><?php echo $kd_unit ?></td>
                                    <td><?php echo $kd_area ?></td>
                                    <td><?php echo $kd_rayon ?></td>
                                    <td><?php echo $kogol ?></td>
                                    <td><?php echo $lembar ?></td>
                                    <td><?php echo $rpptl ?></td>
                                    <td><?php echo $rpbpju ?></td>
                                    <td><?php echo $rpppn ?></td>
                                    <td><?php echo $rpmat ?></td>
                                    <td><?php echo $rplain ?></td>
                                    <td><?php echo $rptag ?></td>
                                    <td><?php echo $rpbk ?></td>
                                </tr>
                                <?php
                            }
							$numrow++;
							}
}
                            ?>
                        </tbody>
                    </table>					
                </div><!-- /.box-body -->
				</form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
	
	
</section><!-- /.content -->

