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
	
	<div class="row">
	<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <h3> 
                        SLA
                    </h3> 
					<p>Tagihan Kesehatan</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->	
		
	<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($detail_sla_tagihan as $r) {
                            echo round($r->adm);
                        } 
						?>
                    </h3> 
                    <p>Proses TPA</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($detail_sla_tagihan as $r) {
                            echo round($r->sdm);
                        }
                        ?>
                    </h3>
                    <p>Proses SDM</p>
                </div>
                <!--a href="<?php echo base_url('transaksi'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($detail_sla_tagihan as $r) {
                            echo round($r->sap);
                        }
                        ?>
                    </h3>
                    <p>Proses SAP</p>
                </div>
                <!--a href="<?php echo base_url('transaksi/lunas'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div> 
		<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($detail_sla_tagihan as $r) {
                             echo round($r->trf);
                        } 
						?>
                    </h3> 
                    <p>Pembayaran</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->	
		<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <h3> 
                        HARI
                    </h3> 
                    <p>SLA</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div><!-- ./col -->				

		
    </div><!-- /.row -->	
	
	<div class="row">
	<h4 class="box-title"><font color='RED'>&nbsp &nbsp Daftar Pasien Perlu Perhatian</font></h4>
	 <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($total_freq_berobat as $r) {
                            echo $r->total;
                        } 
						?>
                    </h3> 
                    <p>Freq Berobat > 5</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
            </div>
		
		<div class="col-lg-2 col-xs-6">
			<div class="small-box bg-green">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($total_rwj_berobat as $r) {
                            echo $r->total;
                        } 
						?>
                    </h3> 
                    <p>RWJ > Rp 3 Jt</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
            </div>
		
		 <div class="col-lg-2 col-xs-6">
			<div class="small-box bg-green">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($total_rwi_berobat as $r) {
                            echo $r->total;
                        } 
						?>
                    </h3> 
                    <p>RWI > Rp 30 Jt</p>
                </div>
                <!--a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a-->
            </div>
        </div>

    </div><!-- /.row -->	
	
	<!-- Left col -->
	<div class="row">
	<div class="col-md-12">
    <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Freq berobat > 5</h3>
        <div class="box-tools pull-right">
                <button type="button" 
				id="butons" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <!-- /.box-header -->
        <div class='box-body table-responsive'>
				<table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>TOTAL CLAIM</th>
                            <th>BULAN</th>
                            <th>RUPIAH</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$start = 0;
                       // foreach ($detail_jatuhtempo as $transaksi) {
                        foreach ($detail_freq_berobat as $transaksi) {
                         ?>
                            <tr>
								<td><?php echo ++$start ?></td>
                                 <!--td><?php //echo $transaksi->kode_vendor?></td-->
                                <td><?php echo $transaksi->kd_nipeg ?></td>
                                <td><?php echo $transaksi->total ?></td>
                                <td><?php echo $transaksi->bulan ?></td>               
                                <td><?php echo rupiah($transaksi->rupiah) ?></td>               
                                      
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
	
	<div class="col-md-12">
    <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Rawat Jalan > Rp 3.000.000</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <!-- /.box-header -->
        <div class='box-body table-responsive'>
				<table class="table table-striped" id="mytable2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>NO CLAIM</th>
                            <th>NO TAGIHAN</th>
                            <th>TGL TAGIHAN</th>
                            <th>TGL BEROBAT</th>
                            <th>JNS PENYAKIT</th>
                            <th>NAMA PENYAKIT</th>
                            <th>VENDOR</th>
                            <th>RUPIAH</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$start = 0;
                       // foreach ($detail_jatuhtempo as $transaksi) {
                        foreach ($detail_rwj_berobat as $transaksi) {
                         ?>
                            <tr>
								<td><?php echo ++$start ?></td>
                                 <!--td><?php //echo $transaksi->kode_vendor?></td-->
                                <td><?php echo $transaksi->kd_nipeg ?></td>
                                <td><?php echo $transaksi->no_claim ?></td>             
                                <td><?php echo $transaksi->tx_nokwitag ?></td>               
                                <td><?php echo $transaksi->tgl_tagihan ?></td>               
                                <td><?php echo $transaksi->tgl_mulai ?></td>               
                                <td><?php echo $transaksi->jns_penyakit ?></td>               
                                <td><?php echo $transaksi->nama_penyakit ?></td>               
                                <td><?php echo $transaksi->nama_vendor_tpa ?></td>               
                                <td><?php echo rupiah($transaksi->rupiah) ?></td>               
                                      
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
		
	<div class="col-md-12">
    <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Rawat Jalan > Rp 30.000.000</h3>
          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <!-- /.box-header -->
        <div class='box-body table-responsive'>
				<table class="table table-striped" id="mytable3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>NO CLAIM</th>
                            <th>NO TAGIHAN</th>
                            <th>TGL TAGIHAN</th>
                            <th>TGL BEROBAT</th>
                            <th>JNS PENYAKIT</th>
                            <th>NAMA PENYAKIT</th>
                            <th>VENDOR</th>
                            <th>RUPIAH</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$start = 0;
                       // foreach ($detail_jatuhtempo as $transaksi) {
                        foreach ($detail_rwi_berobat as $transaksi) {
                         ?>
                            <tr>
								<td><?php echo ++$start ?></td>
                                 <!--td><?php //echo $transaksi->kode_vendor?></td-->
                                <td><?php echo $transaksi->kd_nipeg ?></td>
                                <td><?php echo $transaksi->no_claim ?></td>              
                                <td><?php echo $transaksi->tx_nokwitag ?></td>               
                                <td><?php echo $transaksi->tgl_tagihan ?></td>               
                                <td><?php echo $transaksi->tgl_mulai ?></td>               
                                <td><?php echo $transaksi->jns_penyakit ?></td>               
                                <td><?php echo $transaksi->nama_penyakit ?></td>               
                                <td><?php echo $transaksi->nama_vendor_tpa ?></td>               
                                <td><?php echo rupiah($transaksi->rupiah) ?></td>               
                                      
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
		
		<!-- ./col -->	
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
    </div>
	</div>
</section>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable({"aLengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "iDisplayLength": 5});
		 $("#mytable2").dataTable({"aLengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "iDisplayLength": 5});
		 $("#mytable3").dataTable({"aLengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "iDisplayLength": 5});
		
    });
	 
</script>