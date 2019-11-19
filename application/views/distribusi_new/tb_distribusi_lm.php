<section class='content-header'>
    <h1>
        Distribusi
        <small>Input Lead Measure</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Distribusi</a></li>
        <li class='active'>Lead Measure</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<script>    
    $(document).ready(function(){  
	
		<?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
		$('#id_unitpln').change(function(){
		$.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("general/listunitup"); ?>", // Isi dengan url/path file php yang dituju
        data: {unitap : $("#id_unitpln").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#id_unitpln2").html(response.list_unitup).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
		});
	 	});
		<?php } else { ?>
		$.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("general/listunitup"); ?>", // Isi dengan url/path file php yang dituju
        data: {unitap : $("#id_unitpln").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#id_unitpln2").html(response.list_unitup).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
		});
		<?php } ?>	
		
		$('#btn_cari').on('click',function(){
						
			var unitpln=$('#id_unitpln').val();
			var unitpln2=$('#id_unitpln2').val();
			var vlm=$('#id_wig').val();
			var tglpilih2=$('#tgl2').val();
			var tglpilih=$('#tgl1').val();
				
			tampil_data_barang(unitpln,unitpln2,tglpilih,tglpilih2,vlm);

		});
		
		function tampil_data_barang(unitpln,unitpln2,tglpilih,tglpilih2,vlm){
        $.fn.dataTable.ext.errMode = 'throw';                  
        $('#mytable').dataTable( {  
		"destroy": true,
        "Processing": true, 
        "ServerSide": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
		dom:
		  "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
		  "<'row'<'col-sm-12'tr>>" +
		  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		buttons: [
		  {
			extend: "copy"
		  },
		  {
			extend: "print"
		  },
		  {
			extend: "excel"
		  },
		  {
			extend: "colvis"
		  }
		],
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "Tidak Ada Data",
                    "sEmptyTable": "No data available in table"
                    },
		"ajax": {
                        "url": '<?php echo site_url('Distribusi_new/view_lead_measure'); ?>',
                        "type": "POST",
						data : {unitpln:unitpln, unitpln2:unitpln2, tglpilih:tglpilih, tglpilih2:tglpilih2,vlm:vlm},
						complete: function() {
							},
						/*success: function() {
							loadout();
						},*/
						error: function (xhr, ajaxOptions, thrownError) {
						console.log('ERROR : '+xhr.status);
						alert(thrownError);
					}
					
                },			
        "columns": [
                { "mData": "no" },
                { "mData": "namaap" },
                { "mData": "namaup" },
                { "mData": "nama_wig" },
                { "mData": "nama_lm" },
                { "mData": "tanggal" },
                { "mData": "target_1" },
                { "mData": "pencapaian_1" },				
                { "mData": "persen1" },
                { "mData": "target_2" },
                { "mData": "pencapaian_2" },
                { "mData": "persen2" },
                { "mData": "keterangan" },
                { "mData": "edit" },
                ],
        "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/,.*|\D/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };
                total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                pageTotal = api
                        .column(4, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);    
			
            }
        } );
		}
		
		$('#btn_tambah').on('click',function(){
			$('#modal_manual_bayar').modal('show');
		
		});
			
		<?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
		$('#id_unitpln3').change(function(){
		$.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("general/listunitup"); ?>", // Isi dengan url/path file php yang dituju
        data: {unitap : $("#id_unitpln3").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ 
          $("#loading").hide(); 
          $("#id_unitpln4").html(response.list_unitup).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
		});
		});
		<?php } else { ?>
		$.ajax({
        type: "POST", 
        url: "<?php echo base_url("general/listunitup"); ?>", 
        data: {unitap : $("#id_unitpln3").val()},
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#id_unitpln4").html(response.list_unitup).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
		});
		<?php } ?>	
		
		<?php if($this->session->flashdata('msg')){
			$a=$this->session->flashdata('msg');
			$dataex = explode('||', $a);
			$status = $dataex[1];
		?>
	var status="<?php echo $status; ?>";
	alert(status);
	<?php } ?>
		
    });
</script>   
<section class='content'>
<div class="box box-primary">
        <div class="box-header with-border">
		  <div class="user-block">
                <img class="img-circle" src="<?php echo base_url('assets/img/target.png'); ?>" alt="User Image">
                <span class="username"><a href="#">Input Data Lead Measure</a></span>
              </div>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
		  <div class='col-xs-9'>
            <div class="col-md-3">
              <div class="form-group">
                <label>UP3</label>
                 <select name="id_unitpln" id="id_unitpln" class="form-control" > 
										<?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
                                        <option value="0">-  UP3  -</option> 			
										<?php } ?>
										<?php foreach($data as $row) {?>
											<option value="<?php echo $row->unitap;?>"><?php echo $row->nama;?></option>
										<?php }?>
                 </select>  
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>ULP</label>
                <select name="id_unitpln2" id="id_unitpln2" class="form-control" > 
                                        <?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
                                        <option value="0">- ULP -</option>  			
										<?php } ?>
				 </select> 
              </div>
              <!-- /.form-group -->
            </div>
			<div class="col-md-3">
              <div class="form-group">
                <label>TGL AWAL</label>
                <?php echo form_error('tgl_transaksi') ?>
								<input type="text" class="form-control datepicker" name="tgl1" data-date-format="yyyy-mm-dd" id="tgl1" placeholder="Tanggal" value="<?php echo date('Y-m-d') ?>" required/>
              </div>
              <!-- /.form-group -->
             <div class="form-group">
                <label>TGL AKHIR</label>
                <?php echo form_error('tgl_transaksi') ?>
								<input type="text" class="form-control datepicker" name="tgl2" data-date-format="yyyy-mm-dd" id="tgl2" placeholder="Tanggal" value="<?php echo date('Y-m-d') ?>" required/>
                                
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label>LEAD MEASURE</label>
                 <select name="id_wig" id="id_wig" class="form-control" > 
                                        <option value="0">-  ALL LM  -</option> 			
										<?php foreach($wig as $row) {?>
											<option value="<?php echo $row->id_lm;?>"><?php echo $row->nama_lm;?></option>
										<?php }?>  
                                    </select> 
				</div>
              <!-- /.form-group -->
            </div>
			 <div class='col-md-3'>
				<div class='form-group'> 
				<br><button class="btn btn-info" id="btn_cari">Cari Data</button></div>
				</div>
          </div>
          </div>
        </div>
		<div class='box-header with-border'>
				<div class='col-md-3'>
				PENCAPAIAN (PERSEN) : 
				<span class='label label-success'><i class='fa fa-check fa-fw'></i></span> >=100
				</div>
				<div class='col-md-2'>
				<span class='label label-warning'><i class='fa fa-check fa-fw'></i></span> >= 71 | <= 99
				</div>
				<div class='col-md-2'>
				<span class='label label-danger'><i class='fa fa-check fa-fw'></i></span> >= 31 | <= 70
				</div>
				<div class='col-md-2'>
				<span class='label label-default'><i class='fa  fa-check fa-fw'></i></span> <= 30
				</div>
				</div>
        <div class="box-footer">
        </div>
      </div>
	  
	<div class='row'>	  
		  <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
					<div class="box-footer">
					 <div class="user-block">
                <img class="img-circle" src="<?php echo base_url('assets/img/medical.png'); ?>" alt="User Image">
                <span class="username"><a href="#">Rekap Data Lead Measure</a></span>
              </div>
					<span class="pull-right">
					<button class="btn btn-danger btn-md" id="btn_tambah">TAMBAH LM</button>
					</span>
					</div>
                </div><!-- /.box-header -->		
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable" width="100%">
                        <thead>
							<tr>
										<!--th colspan="2" class="text-center"><button class="btn btn-info" id="btn_proses">proses tagihan</button></th-->
										<th colspan="6" class="text-center"></th>
										<th colspan="2" class="text-center">PLG / UNIT</th>
										<th colspan="1" class="text-center">%</th>
										<th colspan="2" class="text-center">kWh</th>
										<th colspan="1" class="text-center">%</th>
										<!--th colspan="2" bgcolor="#00FFFF" class="text-center">PLN KEU</th-->
							</tr>
                            <tr>
								<th>No</th>
                                <th>Nama AP</th>
                                <th>Nama UP</th>
                                <th>WIG</th>
                                <th>Nama LM</th>
                                <th>Tanggal</th>
                                <th>T</th>
                                <th>R</th>
                                <th>%</th>
                                <th>T</th>
                                <th>R</th>
                                <th>%</th>
                                <th>Ket</th>
                                <th>edit</th>
                            </tr>
                        </thead>
						<tfoot>
                            
                        </tfoot>
                        <tbody>
                           
                        </tbody>
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
	
	</div>
	
<!--script>
$(function(){
 $("#id_wig2").on('change', function(){
   if($("#id_wig2").val() == 3) {
	$("#target22").val('0');
	$("#realisasi22").val('0');
	$("#t2").hide();
	$("#r2").hide();
   } else {
	$("#t2").show();
	$("#r2").show(); 
	$("#target22").val('');
	$("#realisasi22").val('');	
   }
 })
  
});
</script-->

	<div class="modal fade" id="modal_manual_bayar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" action="<?php echo base_url().'Distribusi_new/tambah_lm'?>" id="form" class="form-horizontal">
                    <div class="form-body">
						<div class="box box-info">
									
						<div class="box box-info">
						<div class="box-header with-border">
                        <h3 class="box-title">TAMBAH DATA LM Distribusi</h3>						
						<br>
						<br>
					<div class="form-group">
                        <label class="control-label col-xs-3" >UNITAP</label>
                        <div class="col-xs-6">
						<select name="id_unitpln3" id="id_unitpln3" class="form-control" > 
                                        <?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
										<option value="0">-  ALL  -</option> 	
										<?php } ?>										
										<?php foreach($data as $row) {?>
											<option value="<?php echo $row->unitap;?>"><?php echo $row->nama;?></option>
										<?php }?>
                                    </select>                                        
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >UNITUP</label>
                        <div class="col-xs-6">
                             <select name="id_unitpln4" id="id_unitpln4" class="form-control" > 
                                        <option value="0">- Pilih ULP -</option>  
                                    </select>   
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >LM</label>
                        <div class="col-xs-6">
                              <select name="id_wig" id="id_wig2" class="form-control"> 
                                       <?php foreach($wig as $row) {?>
											<option value="<?php echo $row->id_lm;?>"><?php echo $row->nama_lm;?></option>
										<?php }?>  
                                    </select> 
                        </div>
					</div>
					<div class="form-group">
					<?php if ($this->session->userdata('company') <> 'ULP') { ?> 
                        <label class="control-label col-xs-3" >TANGGAL</label>
                        <div class="col-xs-6">
										<input type="text" class="form-control datepicker" name="tgllm" data-date-format="yyyy-mm-dd" id="tgllm" placeholder="Tanggal" required/>									
                                </div>
					<?php } ?>	
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >TARGET</label>
                        PELANGGAN / UNIT
						<div class="col-xs-4">
                            <input name="target11"  id="target11" class="form-control" type="number" 
							placeholder="0" required> 
                        </div> 
					</div>
					<div class="form-group">
                        <div id="t2">
						<label class="control-label col-xs-3" ></label>
                        kWh
						<div class="col-xs-4">
                            <input name="target22"  id="target22" class="form-control" type="number" 
							placeholder="0" required> 
                        </div> 
                        </div> 
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >REALISASI</label>
                        PELANGGAN / UNIT
						<div class="col-xs-4">
                            <input name="realisasi11"  id="realisasi11" class="form-control" type="number" 
							placeholder="0"> 
                        </div> 
					</div>
					<div class="form-group">
					<div id="r2">
                        <label class="control-label col-xs-3" ></label>
						kWh
						<div class="col-xs-4">
                            <input name="realisasi22"  id="realisasi22" class="form-control" type="number" 
							placeholder="0"> 
                        </div> 
                        </div> 
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >KETERANGAN</label>
                        <div class="col-xs-6">
                            <input name="keterangan"  id="keterangan" class="form-control" type="text" 
							placeholder="keterangan..."> 
                        </div>
					</div>
										
                    </div><!-- /.box-header -->
                    
                </div>
					
                </form>
            </div>
            <div class="modal-footer">
				<button class="btn btn-info">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
</div>

<div class="modal fade" id="modal_edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
               <form class="form-horizontal" method="post" action="<?php echo base_url().'Distribusi_new/update_pencapaian_lm'?>">
                    <div class="form-body">
						<div class="box box-info">
						<div class="box-header with-border">
						<div class="form-group">
							<div class="col-xs-4">
                            <b>ID : </b> <input name="ids" id="ids" class="form-control" readonly>
							</div>
							<div class="col-xs-4">
                            <b>UP3 : </b> <input name="unitap" id="unitap" class="form-control" readonly>
							</div>
                            <div class="col-xs-4">
                            <b>ULP : </b> <input name="unitup" id="unitup" class="form-control" readonly>
                            </div><div class="col-xs-4">
                            <b>TANGGAL : </b> <input name="tanggal" id="tanggal" class="form-control" readonly>
                            </div>
							<div class="col-xs-4">
                            <b>ID LM : </b> <input name="id_lm" id="id_lm" class="form-control" readonly>
                            </div>
							<div class="col-xs-4">
                            <b>NAMA LM : </b> <input name="nama_lm" id="nama_lm" class="form-control" readonly>
                            </div>
							<div class="col-xs-4">
                            <b>TARGET PLG / UNIT: </b> <input name="target1" id="target1" class="form-control" readonly>
                            </div>
							<div class="col-xs-4">
                            <b>TARGET kWh : </b> <input name="target2" id="target2" class="form-control" readonly>
                            </div>

						</div>		
				    </div>						
						<div class="box box-info">
						<div class="box-header with-border">
                        <h3 class="box-title">UPDATE TARGET</h3>						
						<div class="form-group">
						<label class="control-label col-xs-3" >PLG/UNIT </label>
                        <div class="col-xs-4">
                            <input name="target1"  id="target1" class="form-control" type="number" 
							placeholder="0" style="width:335px;" required>
                        </div>	
                        </div>	
						<div class="form-group">
                        <label class="control-label col-xs-3" >kWh </label>
                        <div class="col-xs-4">
                            <input name="target2"  id="target2" class="form-control" type="number" 
							placeholder="0" style="width:335px;" required>
                        </div>
						</div>
						
                    </div>
						<div class="box-header with-border">
                        <h3 class="box-title">UPDATE REALISASI</h3>						
						<div class="form-group">
						<label class="control-label col-xs-3" >PLG/UNIT </label>
                        <div class="col-xs-4">
                            <input name="pencapaian1"  id="pencapaian1" class="form-control" type="number" 
							placeholder="0" style="width:335px;" required>
                        </div>	
                        </div>	
						<div class="form-group">
                        <label class="control-label col-xs-3" >kWh </label>
                        <div class="col-xs-4">
                            <input name="pencapaian2"  id="pencapaian2" class="form-control" type="number" 
							placeholder="0" style="width:335px;" required>
                        </div>
						</div>
						
                    </div><!-- /.box-header -->
                    
                </div>
					
                </form>
            </div>
            <div class="modal-footer">
				<!--button class="btn btn-info">Simpan</button-->
				<button class="btn btn-info" id="btn_update">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
</div>

<script>		
function edit_lm(id)
	{
    save_method = 'update';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Distribusi_new/view_lm_id/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {  		
		   for (i = 0; i < data.data.length; i++) {			
			$("input[name='ids']").val(data.data[i].id);
			$("input[name='unitap']").val(data.data[i].unitap);
			$("input[name='unitup']").val(data.data[i].unitup);
			$("input[name='id_lm']").val(data.data[i].id_lm);
			$("input[name='nama_lm']").val(data.data[i].nama_lm);
			$("input[name='target1']").val(data.data[i].target1);
			$("input[name='target2']").val(data.data[i].target2);
			$("input[name='tanggal']").val(data.data[i].tanggal);
			$("input[name='pencapaian1']").val(data.data[i].pencapaian1);
			$("input[name='pencapaian2']").val(data.data[i].pencapaian2);
			$('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pencapaian LM'); // Set title to Bootstrap modal title
			}

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	
}
</script>

</section><!-- /.content -->

