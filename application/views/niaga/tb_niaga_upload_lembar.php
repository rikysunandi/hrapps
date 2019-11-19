
<section class='content-header'>
    <h1>
        UPLOAD
        <small>NIAGA - LEMBAR</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Dashboard Niaga</a></li>
        <li class='active'>Upload LEMBAR</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'> 
				
				<div class='box-header with-border'>
				<form method="post" action="<?php echo base_url("niaga/niaga_upload_lembar"); ?>" 
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
			
				<form method='post' action="<?php echo base_url("niaga/niaga_import_lembar"); ?>" onsubmit="return confirm('Pastikan Data yang akan di upload sudah benar?');">
				<div class='box-header with-border'>				       
					   <div class="col-md-4">
							<label class="control-label col-xs-5" >FILE:  <?php  
								echo $filename; 
								?> </label>							
                        </div>
				</div>
				<div class='box-header with-border'>
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
								<th>ULP</th>
								<th>LEMBAR</th>
								<th>JML PLG</th>
								<th>JML LEMBAR</th>
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
							$previousValue = null;
						if (is_array($sheet) || is_object($sheet))
							{
								
                            foreach ($sheet as $datas) {
								$kd_rayon = $datas['A'];		
								$lembar = $datas['B'];
								$jml_plg = $datas['C'];
								$jml_lbr = $datas['D'];
								$rpptl = $datas['E'];
								$rpbpju = $datas['F'];
								$rpppn = $datas['G'];
								$rpmat = $datas['H'];
								$rplain = $datas['I'];
								$rptag = $datas['J'];
								$rpbk = $datas['K'];
								
							if($numrow > 2){
                                ?>
                                <tr>
								    <td><?php echo ++$start ?></td>
                                    <td><?php /* 
									if($previousValue) {
											echo $previousValue;
									} else {
										echo $previousValue = $kd_rayon;
									}*/
									echo $kd_rayon
									?></td>
                                    <td><?php echo $lembar ?></td>
                                    <td><?php echo $jml_plg ?></td>
                                    <td><?php echo $jml_lbr ?></td>
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

