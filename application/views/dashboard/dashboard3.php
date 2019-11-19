<section class="content-header">
    <h1>
        Dashboard
        <small>PLN</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
			<h4>
	<?php
	echo $this->session->userdata('kode_vendor');
	
		foreach ($vendor as $r) {
			echo "-".$r->nama_pln;
			/*echo "<br>";
			echo $r->alamat;
			echo "<br>";
			echo $r->kota;
			echo "<br>";
			echo $r->telp;*/
		}
    ?>
	</h4>	
	<!-- Left col -->
	<div class="row">
	<div class="col-md-8">
    <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Tagihan Jatuh Tempo</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>PLN</th>
                            <!--th>Vendor</th-->
                            <th>Tgl Tagihan</th>
                            <th>sla</th> 
                            <th>Jumlah</th>
                            <th>Rupiah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       // foreach ($detail_jatuhtempo as $transaksi) {
                        foreach ($detail_tagihan_jatuhtempo as $transaksi) {
                         ?>
                            <tr>
                                <td><?php echo $transaksi->kode_pln?></td>
                                <!--td><?php //echo $transaksi->kode_vendor?></td>
                                <td><?php //echo $transaksi->nama_vendor ?></td>
                                <td><?php ////echo $transaksi->no_tagihan ?></td-->
                                <td><?php echo $transaksi->tgl_tagihan ?></td>								      							
                                <td><?php echo "<span class='label label-danger'><b>$transaksi->sla </span>"?></td>  
                                <td><?php echo $transaksi->jml_tpa ?></td>                
                                <td><?php echo rupiah($transaksi->rp_tpa) ?></td> 
								<td><?php echo $transaksi->aktif ?></td>                
                                      
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
				
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
        
        </div>
		<div class="col-md-3">
		 <?php foreach ($detail_sla_tagihan as $transaksis) {
            ?>
		<div class="info-box bg-red">
		            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->adm)?></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES ADM</span>
                    </div><!-- /.info-box-content -->
       </div>
		<div class="info-box bg-yellow">
		            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->sdm)?></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES SDM</span>
                    </div><!-- /.info-box-content -->
                </div>
		<div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->sap)?></i></span>
                    <div class="info-box-content">
					<span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES SAP</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
		<div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->trf)?></i></span>
                    <div class="info-box-content">
					<span class="info-box-text">==================</span>
                        <span class="info-box-number">PEMBAYARAN</span>
                    </div><!-- /.info-box-content -->
                </div>
		<?php
            }
        ?>
		</div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
    </div>
	</div-->
	</div>

	<!--div class="box box-info">
		<div class="box-header with border">
		<h3 class="box-tittle">Tagihan Jatuh Tempo > 30 hari</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
         <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Unit PLN</th>
                            <th>No Tagihan</th>
                            <th>Tgl Tagihan</th>
                            <th>Tgl Kirim TPA</th>
                            <th>SLA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       // foreach ($detail_tagihan as $transaksi) {
                         ?>
                            <tr>
                                <td><?php // echo $transaksi->nama_pln?></td>
                                <td><?php// echo $transaksi->no_tagihan ?></td>
                                <td><?php// echo tgl_indo($transaksi->tgl_tagihan) ?></td>               
                                <td><?php// echo tgl_indo($transaksi->tgl_kirim_tpa) ?></td>              
                                <td><?php// echo $transaksi->sla ?></td>              
                            </tr>
                            <?php
                      //  }
                        ?>
                    </tbody>
                </table>
				
            </div>
       </div>
    </div>
	</div-->
</section>