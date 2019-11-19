<section class='content-header'>
    <h1>
        Niaga
        <small>Rekap Lembar</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Niaga</a></li>
        <li class='active'>Rekap Lembar</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<script>    
    $(document).ready(function(){  
	
		$.ajax({
        url: '<?php echo site_url('general/unitpln'); ?>',
		type: 'POST',
        success: function(data) {
            $("#id_unitpln").html(data);
        },
		error: function (xhr, ajaxOptions, thrownError) {
        console.log('ERROR : '+xhr.status);
        //alert(thrownError);
		}
		});
		
		$('#btn_cari').on('click',function(){
						
			var unitpln=$('#id_unitpln').val();
				console.log('unitpln' + unitpln);
			var tglpilih=$('#tgl1').val();
				console.log('tgl1 ' + tgl1);	
				
			tampil_data_barang(unitpln,tglpilih);

		});
		
		function tampil_data_barang(unitpln,tglpilih){
        $.fn.dataTable.ext.errMode = 'throw';                  
        $('#mytable').dataTable( {  
		"destroy": true,		
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 100,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "Data Masih Kosong",
                    "sEmptyTable": "No data available in table",
					//"sLoadingRecords" : '<span style="width:100%;"><img src="<?php echo base_url('assets/img/ajaxload.gif');?>"></span>'
                    },
		"ajax": {
                        "url": '<?php echo site_url('niaga/view_data_Lembar'); ?>',
                        "type": "POST",
						data : {unitpln:unitpln, tglpilih:tglpilih},
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
                { "mData": "namaap" },
                { "mData": "unitup" },
                { "mData": "namaup" },
                { "mData": "lembar" },
                { "mData": "jml_plg" },
                { "mData": "jml_lbr" },
                { "mData": "rpptl" },
                { "mData": "rpbpju" },
                { "mData": "rpppn" },
                { "mData": "rpmat" },
                { "mData": "rplain" },
                { "mData": "rptag" },
                { "mData": "rpbk" },
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
                    <h3 class='box-title'><?php echo anchor('transaksi/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo anchor(site_url('transaksi/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
								<div class='box-header with-border'>
				<div class='col-md-2'>
                                <div class='form-group'>Unit PLN <?php echo form_error('id_unitpln') ?>
                                    <select name="id_unitpln" id="id_unitpln" class="form-control" > 
                                        <option value="">- Pilih Unit PLN -</option>  
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
                                <th>Nama AP</th>
                                <th>Kode UP</th>
                                <th>Nama UP</th>
                                <th>Lembar</th>
                                <th>Jml Plg</th>
                                <th>Jml Lbr</th>
                                <th>RpPTL</th>
                                <th>RpBBPJU</th>
                                <th>RpPPN</th>
                                <th>RpMAT</th>
                                <th>RP Lain2</th>
                                <th>Rp TAG</th>
                                <th>Rp BK</th>
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

