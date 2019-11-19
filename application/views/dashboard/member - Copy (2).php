<section class="content-header">
    <h1>
        Dashboard
        <small>Vendor</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
	<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($total as $r) {
                            echo $r->total_tagihan;
                        } 
						?>
                    </h3> 
                    <p>Total Tagihan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($rupiah as $r) {
                            echo "Rp " . rupiah($r->rupiah_tagihan);
                        }
                        ?>
                    </h3>
                    <p>Rupiah Tagihan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calculator"></i>
                </div>
                <a href="<?php echo base_url('transaksi'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($transfer as $r) {
                            echo "Rp " . rupiah($r->transfer_keu);
                        }
                        ?>
                    </h3>
                    <p>Transfered</p>
                </div>
                <div class="icon">
                    <i class="ion ion-thumbsup"></i>
                </div>
                <a href="<?php echo base_url('transaksi/lunas'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div> 
		<div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3> 
                        <?php  foreach ($jatuhtempo as $r) {
                            echo $r->total_tagihan;
                        } 
						?>
                    </h3> 
                    <p>Jatuh Tempo</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->		

    </div><!-- /.row -->
	
		<h4>
	<?php
	echo $this->session->userdata('kode_vendor');
	
		foreach ($vendor as $r) {
			echo "-".$r->nama_vendor;
			/*echo "<br>";
			echo $r->nama_bank;
			echo "<br>";
			echo $r->akun_bank;
			echo "<br>";
			echo $r->nama_rek_bank;*/
		}
    ?>
	</h4>
	<!-- Left col -->
    <div class="box box-info">
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Nama Bank</th>
                            <th>Akun Bank</th>
                            <th>Nama Rek Bank</th>
                            <th>Nama Pic</th>
                            <th>Telp Pic</th>                            
							<th>Nama Pic</th>
                            <th>Telp Pic</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($detail as $transaksi) {
                         ?>
                            <tr>
                                <td><?php echo $transaksi->alamat.' '.$transaksi->kota?></td>
                                <td><?php echo $transaksi->telp ?></td>
                                <td><?php echo $transaksi->nama_bank ?></td>
                                <td><?php echo $transaksi->akun_bank ?></td>
                                <td><?php echo $transaksi->nama_rek_bank ?></td>                
                                <td><?php echo $transaksi->pic1 ?></td>                
                                <td><?php echo $transaksi->telp_pic1 ?></td>  
								<td><?php echo $transaksi->pic2 ?></td>                
                                <td><?php echo $transaksi->telp_pic2 ?></td>                
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