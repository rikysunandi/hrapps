<section class='content-header'>
    <h1>
        Distribusi
        <small>Monitoring Pencapaian Lead Measure</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Distribusi</a></li>
        <li class='active'>Monitoring PencapaianLead Measure</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<script>    
    $(document).ready(function(){  
		
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
		
		$('#btn_cari').on('click',function(){
						
			var unitpln=$('#id_unitpln').val();
			var unitpln2=$('#id_unitpln2').val();
			var tglpilih=$('#tgl1').val();
			var id_wig=$('#id_wig').val();
				
			tampil_data_barang(id_wig,unitpln,unitpln2,tglpilih);

		});
		
		function tampil_data_barang(id_wig,unitpln,unitpln2,tglpilih){
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
                        "url": '<?php echo site_url('distribusi_new/view_rekap_pencapaian_lead_measure'); ?>',
                        "type": "POST",
						data : {id_wig:id_wig, unitpln:unitpln, unitpln2:unitpln2, tglpilih:tglpilih},
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
                { "mData": "unitap" },
                { "mData": "namaap" },
                { "mData": "unitup" },
                { "mData": "namaup" },
                { "mData": "nilai" },
				{ "mData": "senin_icon" },
                { "mData": "selasa_icon" },
                { "mData": "rabu_icon" },
                { "mData": "kamis_icon" },
                { "mData": "jumat_icon" },
                { "mData": "sabtu_icon" },
                { "mData": "senin" },
                { "mData": "selasa" },
                { "mData": "rabu" },
                { "mData": "kamis" },
                { "mData": "jumat" },
                { "mData": "sabtu" },
                ],
		//"order": [[ 5, 'desc' ]],
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
    });
</script>   
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'>
					 </div><!-- /.box-header -->
				<div class='box-header with-border'>
				<div class='col-md-2'>
                                <div class='form-group'>UP3 <?php echo form_error('id_unitpln') ?>
                                    <select name="id_unitpln" id="id_unitpln" class="form-control" > 
                                        <option value="0">-  UP3  -</option> 			
										<?php foreach($data as $row) {?>
											<option value="<?php echo $row->unitap;?>"><?php echo $row->nama;?></option>
										<?php }?>
                                    </select>                                    
                                </div>
                </div>
				<div class='col-md-2'>
                                <div class='form-group'>ULP <?php echo form_error('id_unitpln2') ?>
                                    <select name="id_unitpln2" id="id_unitpln2" class="form-control" > 
                                        <option value="0">- ULP -</option>  
                                    </select>                                    
                                </div>
                </div>
			    <div class="col-md-2">
							<div class='form-group'>LM <?php echo form_error('id_unitpln') ?>
                            <select name="id_wig" id="id_wig" class="form-control" > 
                                        <option value="0">-  PILIH LM  -</option> 			
										<?php foreach($wig as $row) {?>
											<option value="<?php echo $row->id_lm;?>"><?php echo $row->nama_lm;?></option>
										<?php }?>  
                                    </select>   
							</div>
                </div>
				<div class='col-md-2'>
				<div class='form-group'>Tanggal <?php echo form_error('tgl_transaksi') ?>
								<input type="text" class="form-control datepicker" name="tgl1" data-date-format="yyyy-mm-dd" id="tgl1" placeholder="Tanggal" required>
                                </div>
				</div>
				<div class='col-md-2'>
				<div class='form-group'> 
				<br><button class="btn btn-info" id="btn_cari">Cari</button></div>
				</div>				
				</div>
				<div class='box-header with-border'>
				<div class='col-md-3'>
				PENCAPAIAN (PERSEN) : 
				<span class='label label-success'><i class='fa fa-check fa-fw'></i></span> >=100 Nilai 3
				</div>
				<div class='col-md-2'>
				<span class='label label-warning'><i class='fa fa-check fa-fw'></i></span> >= 71 | <= 99 Nilai 2
				</div>
				<div class='col-md-2'>
				<span class='label label-danger'><i class='fa fa-check fa-fw'></i></span> >= 31 | <= 70 Nilai 1
				</div>
				<div class='col-md-2'>
				<span class='label label-default'><i class='fa  fa-check fa-fw'></i></span> <= 30 Nilai 0
				</div>
				</div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode AP</th>
                                <th>Nama AP</th>
                                <th>Kode UP</th>
                                <th>Nama UP</th>
                                <th>Nilai</th>
								<th>SENIN</th>
                                <th>SELASA</th>
                                <th>RABU</th>
                                <th>KAMIS</th>
                                <th>JUMAT</th>
                                <th>SABTU</th>
                                <th>SENIN</th>
                                <th>SELASA</th>
                                <th>RABU</th>
                                <th>KAMIS</th>
                                <th>JUMAT</th>
                                <th>SABTU</th>
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
	
</section><!-- /.content -->

