<section class='content-header'>
    <h1>
        Niaga
        <small>Lead Measure</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Niaga</a></li>
        <li class='active'>Lead Measure</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<script>    
    $(document).ready(function(){  
	
		/*$.ajax({
        url: '<?php echo site_url('general/unitpln'); ?>',
		type: 'POST',
        success: function(data) {
            $("#id_unitpln").html(data).show();
        },
		error: function (xhr, ajaxOptions, thrownError) {
        console.log('ERROR : '+xhr.status);
        //alert(thrownError);
		}
		});*/
		
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
			var tglpilih2=$('#tgl2').val();
			var tglpilih=$('#tgl1').val();
				
			tampil_data_barang(unitpln,unitpln2,tglpilih,tglpilih2);

		});
		
		function tampil_data_barang(unitpln,unitpln2,tglpilih,tglpilih2){
        $.fn.dataTable.ext.errMode = 'throw';                  
        $('#mytable').dataTable( {  
		"destroy": true,		
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 100, 
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
                    "sZeroRecords": "Data Masih Kosong",
                    "sEmptyTable": "No data available in table",
					//"sLoadingRecords" : '<span style="width:100%;"><img src="<?php echo base_url('assets/img/ajaxload.gif');?>"></span>'
                    },
		"ajax": {
                        "url": '<?php echo site_url('niaga/view_lead_measure'); ?>',
                        "type": "POST",
						data : {unitpln:unitpln, unitpln2:unitpln2, tglpilih:tglpilih, tglpilih2:tglpilih2},
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
                { "mData": "unitupi" },
                { "mData": "unitap" },
                { "mData": "namaap" },
                { "mData": "unitup" },
                { "mData": "namaup" },
                { "mData": "nama_wig" },
                { "mData": "id_lm" },
                { "mData": "nama_lm" },
                { "mData": "tanggal" },
                { "mData": "satuan" },
                { "mData": "target" },
                { "mData": "pencapaian" },
                { "mData": "keterangan" },
                { "mData": "edit" },
                ],
        "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/,.*|\D/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };
                // Total over all pages
                total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                // Total over this page
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
			
				
		$('#id_wig').change(function(){
		var id=$(this).val();
		$.ajax({
        url: '<?php echo site_url('general/GetLm_by'); ?>',
		data : {idwig:id,bidang:'NIAGA'},
		type: 'POST',
        success: function(data) {
            $("#id_lm").html(data).show();
        },
		error: function (xhr, ajaxOptions, thrownError) {
        console.log('ERROR : '+xhr.status);
        //alert(thrownError);
		}
		});
		});
		
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
		});
		<?php } else { ?>
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
		
    });
</script>   
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'>
					<button class="btn btn-info" id="btn_tambah">TAMBAH LM</button>
                </div><!-- /.box-header -->
								<div class='box-header with-border'>
				<div class='col-md-2'>
                                <div class='form-group'>UP3 <?php echo form_error('id_unitpln') ?>
                                    <select name="id_unitpln" id="id_unitpln" class="form-control" > 
										<?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
                                        <option value="0">-  UP3  -</option> 			
										<?php } ?>
										<?php foreach($data as $row) {?>
											<option value="<?php echo $row->unitap;?>"><?php echo $row->nama;?></option>
										<?php }?>
                                    </select>                                    
                                </div>
                </div>
				<div class='col-md-2'>
                                <div class='form-group'>ULP <?php echo form_error('id_unitpln2') ?>
                                    <select name="id_unitpln2" id="id_unitpln2" class="form-control" > 
                                        <?php if ($this->session->userdata('kode_vendor') == 0) { ?> 
                                        <option value="">- ULP -</option>  			
										<?php } ?>
										</select>                                    
                                </div>
                </div>
				<div class='col-md-2'>
				<div class='form-group'>Tanggal Awal<?php echo form_error('tgl_transaksi') ?>
								<input type="text" class="form-control datepicker" name="tgl1" data-date-format="yyyy-mm-dd" id="tgl1" placeholder="Tanggal" value="<?php echo date('Y-m-d') ?>" required/>
                                </div>
				</div>
				<div class='col-md-2'>
				<div class='form-group'>Tanggal Akhir<?php echo form_error('tgl_transaksi') ?>
								<input type="text" class="form-control datepicker" name="tgl2" data-date-format="yyyy-mm-dd" id="tgl2" placeholder="Tanggal" value="<?php echo date('Y-m-d') ?>" required/>
                                </div>
				</div>
				<div class='col-md-2'>
				<div class='form-group'> 
				<br><button class="btn btn-info" id="btn_cari">Cari</button></div>
				</div>				
				</div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Dist</th>
                                <th>Kode AP</th>
                                <th>Nama AP</th>
                                <th>Kode UP</th>
                                <th>Nama UP</th>
                                <th>Nama WIG</th>
                                <th>Id WIG</th>
                                <th>Tanggal</th>
                                <th>Nama LM</th>
                                <th>Satuan</th>
                                <th>Target</th>
                                <th>Pencapaian</th>
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
        </div><!-- /.col -->
    </div><!-- /.row -->
	
	<div class="modal fade" id="modal_manual_bayar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" action="<?php echo base_url().'niaga/tambah_lm'?>" id="form" class="form-horizontal">
                    <div class="form-body">
						<div class="box box-info">
									
						<div class="box box-info">
						<div class="box-header with-border">
                        <h3 class="box-title">TAMBAH DATA LM NIAGA</h3>						
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
                                        <option value="">- Pilih ULP -</option>  
                                    </select>   
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >WIG</label>
                        <div class="col-xs-6">
                            <select name="id_wig" id="id_wig" class="form-control" > 
                                        <option value="0">-  PILIH WIG  -</option> 			
										<?php foreach($wig as $row) {?>
											<option value="<?php echo $row->id_wig;?>"><?php echo $row->nama_wig;?></option>
										<?php }?>  
                                    </select>   
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-xs-3" >LM</label>
                        <div class="col-xs-6">
                             <select name="id_lm" id="id_lm" class="form-control" > 
                                        <option value="">- Pilih LM -</option>  
                                    </select>  
                        </div>
					</div>
					<!--div class="form-group">
                        <label class="control-label col-xs-3" >SATUAN</label>
                        <div class="col-xs-3">
                            <input name="satuan"  id="satuan" class="form-control" type="text" 
							placeholder="satuan..." required> 
                        </div>
					</div-->
					<div class="form-group">
                        <label class="control-label col-xs-3" >TARGET HARI INI</label>
                        <div class="col-xs-3">
                            <input name="target"  id="target" class="form-control" type="number" 
							placeholder="0" required> 
                        </div>
					</div>
					<!--div class="form-group">
                        <label class="control-label col-xs-3" >PENCAPAIAN</label>
                        <div class="col-xs-3">
                            <input name="pencapaian"  id="pencapaian" class="form-control" type="text" 
							placeholder="pencapaian..." required> 
                        </div>
					</div-->
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
               <form class="form-horizontal" method="post" action="<?php echo base_url().'niaga/update_pencapaian_lm'?>">
                    <div class="form-body">
						<div class="box box-info">
						<div class="box-header with-border">
						<div class="form-group">
							<div class="col-xs-4">
                            <b>UP3 : </b> <input name="unitap" id="unitap" class="form-control" readonly>
							</div>
                            <div class="col-xs-4">
                            <b>ULP : </b> <input name="unitup" id="unitup" class="form-control" readonly>
                            </div><div class="col-xs-4">
                            <b>TANGGAL : </b> <input name="tanggal" id="tanggal" class="form-control" readonly>
                            </div>
							<div class="col-xs-4">
                            <b>NAMA WIG : </b> <input name="nama_wig" id="nama_wig" class="form-control" readonly>
                            </div>
							<div class="col-xs-4">
                            <b>NAMA LM : </b> <input name="nama_lm" id="nama_lm" class="form-control" readonly>
                            </div><div class="col-xs-4">
                            <b>TARGET : </b> <input name="target" id="target" class="form-control" readonly>
                            </div>

						</div>		
				    </div>						
						<div class="box box-info">
						<div class="box-header with-border">
                        <h3 class="box-title">UPDATE PENCAPAIAN</h3>						
						<div class="form-group">
						<label class="control-label col-xs-3" >TARGET </label>
                        <div class="col-xs-9">
                            <input name="target"  id="target" class="form-control" type="text" 
							placeholder="target..." style="width:335px;" required>
                        </div>	
                        <label class="control-label col-xs-3" >PENCAPAIAN </label>
                        <div class="col-xs-9">
                            <input name="pencapaian"  id="pencapaian" class="form-control" type="number" 
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
        url : "<?php echo site_url('niaga/view_lm_id/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {  	
		
		                   if(data.data.length > 0)
                            {
                                for(key in data.data)
                                {
                                    var tmp = data.data[key];
                                    console.log(tmp.tgl_terima_pln);
                                }
                            }
                            else
                            {
                                console.log("no result");
                            }
							
				
		   for (i = 0; i < data.data.length; i++) {			
			$("input[name='unitap']").val(data.data[i].unitap);
			$("input[name='unitup']").val(data.data[i].unitup);
			$("input[name='nama_wig']").val(data.data[i].nama_wig);
			$("input[name='nama_lm']").val(data.data[i].nama_lm);
			$("input[name='target']").val(data.data[i].target);
			$("input[name='tanggal']").val(data.data[i].tanggal);
			$("input[name='pencapaian']").val(data.data[i].pencapaian);
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

