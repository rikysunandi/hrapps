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
	<div class="row">
	<h4 class="box-title">&nbsp &nbsp Tagihan Kesehatan</h4>
	<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($total_tagihan as $r) {
                            echo $r->total_tagihan;
                        } 
						?>
                    </h3> 
                    <p>Total Tagihan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($rupiah_tagihan as $r) {
                            echo "Rp " . rupiah($r->rupiah_tagihan);
                        }
                        ?>
                    </h3>
                    <p>Rupiah Tagihan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calculator"></i>
                </div>
                <!--a href="<?php echo base_url('transaksi'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($tagihan_transfer as $r) {
                            echo "Rp " . rupiah($r->transfer_keu);
                        }
                        ?>
                    </h3>
                    <p>Transfered</p>
                </div>
                <div class="icon">
                    <i class="ion ion-thumbsup"></i>
                </div>
                <!--a href="<?php echo base_url('transaksi/lunas'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div> 
		<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($tagihan_jatuhtempo as $r) {
                            echo $r->total_tagihan;
                        } 
						?>
                    </h3> 
                    <p>Jatuh Tempo</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->		

    </div><!-- /.row -->	
	
	<!-- Left col -->
	<div class="row">
	<div class="col-md-9">
    <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Tagihan Jatuh Tempo</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <!-- /.box-header -->
        <div class='box-body table-responsive'>
				<table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PLN</th>
                            <th>Provider</th>
                            <th>No Tagihan</th>
                            <th>Tgl Tagihan</th>
                            <th>sla</th> 
                            <th>Jumlah</th>
                            <th>Rupiah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$start = 0;
                       // foreach ($detail_jatuhtempo as $transaksi) {
                        foreach ($detail_tagihan_jatuhtempo as $transaksi) {
                         ?>
                            <tr>
								<td><?php echo ++$start ?></td>
                                <td><?php echo $transaksi->kode_pln?></td>
                                <!--td><?php //echo $transaksi->kode_vendor?></td-->
                                <td><?php echo $transaksi->nama_vendor ?></td>
                                <td><?php echo $transaksi->no_tagihan ?></td>
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
				
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
         
        </div>
		<div class="col-md-3">
		<h3 class="box-title">SLA TAGIHAN KESEHATAN</h3>
		 <?php foreach ($detail_sla_tagihan as $transaksis) {
            ?>
		<div class="info-box bg-red">
		            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->adm)?></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">HARI</span>
                        <span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES TPA</span>
                    </div><!-- /.info-box-content -->
       </div>
		<div class="info-box bg-yellow">
		            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->sdm)?></i></span>
                    <div class="info-box-content">
					<span class="info-box-number">HARI</span>
                        <span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES SDM</span>
                    </div><!-- /.info-box-content -->
                </div>
		<div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->sap)?></i></span>
                    <div class="info-box-content">
					<span class="info-box-number">HARI</span>
					<span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES SAP</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
		<div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->trf)?></i></span>
                    <div class="info-box-content">
					<span class="info-box-number">HARI</span>
					<span class="info-box-text">==================</span>
                        <span class="info-box-number">PEMBAYARAN</span>
                    </div><!-- /.info-box-content -->
                </div>
		<div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"><?php echo round($transaksis->alls)?></i></span>
                    <div class="info-box-content">
					<span class="info-box-number">HARI</span>
					<span class="info-box-text">==================</span>
                        <span class="info-box-number">PROSES ALL</span>
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
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
</script>