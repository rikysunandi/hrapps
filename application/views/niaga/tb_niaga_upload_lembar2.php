
<section class='content-header'>
    <h1>
        UPLOAD
        <small>NIAGA - LEMBAR 2</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Dashboard Niaga</a></li>
        <li class='active'>Upload LEMBAR 2</li>
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
				<div class="col-xs-3">
                        <label class="control-label col-xs-4" >Tanggal</label>
                        <input name="tgl_tagihan" data-date-format="yyyy-mm-dd" class="form-control datepicker" type="text" placeholder="Tgl Tagihan..." style="width:125px;" required>
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
			
				<form method='post' action="<?php echo base_url("niaga/niaga_import_lembar2"); ?>" onsubmit="return confirm('Pastikan Data yang akan di upload sudah benar?');">
				<div class='box-header with-border'>				       
					   <div class="col-md-4">
							<label class="control-label col-xs-5" >FILE:  <?php  
								echo $filename; 
								?> </label>							
                        </div>
						<div class="col-xs-4">
							<label class="control-label col-xs-5" >TANGGAL:  <?php  
								echo $tgl_tagihan; 
								?> </label>							
                        </div>
				</div>
				<div class='box-header with-border'>
				<input class="btn btn-primary btn-sm" type="submit" name="import" value="Import Data" />
				<input name="namafile" class="form-control" type="hidden" placeholder="Nama File...." style="width:335px;" value="<?php  
								echo $filename; 
								?>" > 
				<input name="tgl_tagihan" class="form-control" type="hidden" placeholder="Nama File...." style="width:335px;" value="<?php  
								echo $tgl_tagihan; 
								?>" > 
				</div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>NO</th>
								<th>ULP</th>
								<th>NAMA</th>
								<th>LBR AWAL 1</th>
								<th>LBR AWAL 2</th>
								<th>LBR AWAL 3</th>
								<th>LBR AWAL > 3</th>
								<th>LBR AKHIR 1</th>
								<th>LBR AKHIR 2</th>
								<th>LBR AKHIR 3</th>
								<th>LBR AKHIR > 3</th>
								<th>TGL NIHIL 1</th>
								<th>TGL NIHIL 2</th>
								<th>REALISASI</th>
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
								$kd_rayon = $datas['D'];		
								$nama_rayon = $datas['E'];		
								$lbr_awal1 = preg_replace('/^$/','0',trim($datas['F']));
								$lbr_awal2 = preg_replace('/^$/','0',trim($datas['G']));
								$lbr_awal3 = preg_replace('/^$/','0',trim($datas['H']));
								$lbr_awal4 = preg_replace('/^$/','0',trim($datas['I']));
								$lbr_akhir1 = preg_replace('/^$/','0',trim($datas['K']));
								$lbr_akhir2 = preg_replace('/^$/','0',trim($datas['L']));
								$lbr_akhir3 = preg_replace('/^$/','0',trim($datas['M']));
								$lbr_akhir4 = preg_replace('/^$/','0',trim($datas['N']));
								$tgl_nihil1 = $datas['Q'];
								$tgl_nihil2 = $datas['R'];
								$realisasi = $datas['S'];
								
							if($numrow > 7){
                                ?>
                                <tr>
								    <td><?php echo ++$start ?></td>
                                    <td><?php echo $kd_rayon ?></td>
                                    <td><?php echo $nama_rayon ?></td>
                                    <td><?php echo $lbr_awal1 ?></td>
                                    <td><?php echo $lbr_awal2 ?></td>
                                    <td><?php echo $lbr_awal3 ?></td>
                                    <td><?php echo $lbr_awal4 ?></td>
                                    <td><?php echo $lbr_akhir1 ?></td>
                                    <td><?php echo $lbr_akhir2 ?></td>
                                    <td><?php echo $lbr_akhir3 ?></td>
                                    <td><?php echo $lbr_akhir4 ?></td>
                                    <td><?php echo $tgl_nihil1 ?></td>
                                    <td><?php echo $tgl_nihil2 ?></td>
                                    <td><?php echo $realisasi ?></td>
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

