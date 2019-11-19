<section class='content-header'>
    <h1>
        MASTER
        <small>Unit UP</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Unit UP</li>
    </ol>
</section>     
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<script>    
    $(document).ready(function(){  
        $.fn.dataTable.ext.errMode = 'throw';                  
        $('#mytable').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "Data Masih Kosong",
                    "sEmptyTable": "No data available in table",
					"sLoadingRecords" : '<span style="width:100%;"><img src="<?php echo base_url('assets/img/ajaxload.gif');?>"></span>'
                    },
        "ajax": "<?php echo base_url('master/view_m_unitup');?>",
        "columns": [
                { "mData": "no" },
                { "mData": "unitap" },
                { "mData": "unitup" },
                { "mData": "nama" },
                { "mData": "alamat" },
                { "mData": "telp" },
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
    });
</script>   
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <!--h3 class='box-title'><?php echo anchor('transaksi/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php //echo anchor(site_url('transaksi/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode AP</th>
                                <th>Kode UP</th>
                                <th>Nama UP</th>
                                <th>Alamat</th>
                                <th>Telp</th>
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

