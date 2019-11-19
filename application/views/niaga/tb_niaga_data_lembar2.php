<section class='content-header'>
    <h1>
        Niaga
        <small>Rekap Lembar 2</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Niaga</a></li>
        <li class='active'>Rekap Lembar 2</li>
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
			tampil_data_barang(unitpln,unitpln2,tglpilih);

		});
		
		function tampil_data_barang(unitpln,unitpln2,tglpilih){
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
                        "url": '<?php echo site_url('niaga/view_data_Lembar2'); ?>',
                        "type": "POST",
						data : {unitpln:unitpln, unitpln2:unitpln2, tglpilih:tglpilih},
						complete: function() {
							loadout();
						},
						/*success: function() {
							loadout();
						},*/
						error: function (xhr, ajaxOptions, thrownError) {
						console.log('ERROR : '+xhr.status);
						loadout();
						alert(thrownError);
					}
					
                },		
        "columns": [
                { "mData": "no" },
                { "mData": "unitupi" },
                { "mData": "unitap" },
                { "mData": "unitup" },
                { "mData": "namaup" },
                { "mData": "lbr1_awal" },
                { "mData": "lbr2_awal" },
                { "mData": "lbr3_awal" },
                { "mData": "lbr4_awal" },
                { "mData": "lbr1_akhir" },
                { "mData": "lbr2_akhir" },
                { "mData": "lbr3_akhir" },
                { "mData": "lbr4_akhir" },				
                { "mData": "lbrjml_awal" },
                { "mData": "lbrjml_akhir" },
                //{ "mData": "persen" },
                { "mData": "tgl_nihil1" },
                { "mData": "tgl_nihil2" },
                { "mData": "realisasi" },
                { "mData": "tgl_insert" },
                { "mData": "keterangan" },
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
    });
</script>   
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                
								<div class='box-header with-border'>
				<div class='col-md-2'>
                                <div class='form-group'>UP3 <?php echo form_error('id_unitpln') ?>
                                    <select name="id_unitpln" id="id_unitpln" class="form-control" > 
                                        <option value="0">-  Pilih UP3  -</option> 			
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
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Dist</th>
                                <th>Kode AP</th>
                                <th>Kode UP</th>
                                <th>Nama UP</th>
                                <th>Lbr Awal 1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>> 3</th>
                                <th>Lbr Akhir 1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>> 3</th>
                                <th>JML AWAL</th>
                                <th>JML AKHIR</th>
                                <!--th>PERSEN</th-->
                                <th>tgl nihil 1</th>
                                <th>tgl nihil 2</th>
                                <th>realisasi</th>
                                <th>Tgl Insert</th>
                                <th>Ket</th>
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

