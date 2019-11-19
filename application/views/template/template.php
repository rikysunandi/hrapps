<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>4DX</title>
        <link href='<?php echo base_url("assets/img/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon'/>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Required CSS -->
		<!-- bootstrap 3.3.2 -->        
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- font Awesome -->
        <link href="<?php echo base_url('assets/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet">
        
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/pace/pace-theme-flash.css">
		<!--datepicker -->
        <link href="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" type="text/css">
       
		<!-- Datatables Buttons -->
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/css/buttons.bootstrap.min.css">

		<!-- textarea editor -->
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/codemirror/lib/codemirror.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/froala_editor/css/froala_editor.pkgd.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/froala_editor/css/froala_style.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/froala_editor/css/themes/royal.min.css">
		<!-- /texarea editor; -->

		<!-- Custom CSS -->
		<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/mystyle.css">
	
		<!-- Select2 -->
		<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileinput/fileinput.min.css') ?>">
		
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">
        <!-- AdminLTE Skins. Choose a skin from the css/skins -->
        <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css'); ?>" rel="stylesheet">

	</head>

		<!-- Must Load First -->
		<script src="<?=base_url()?>assets/bower_components/jquery/jquery-3.3.1.min.js"></script>
		<script src="<?=base_url()?>assets/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
		<script src="<?=base_url()?>assets/bower_components/moment/min/moment.min.js"></script>
		<script src="<?=base_url()?>assets/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>		
		
<!--body class="hold-transition skin-blue sidebar-collapse sidebar-mini"-->
<body class="hold-transition skin-yellow-light sidebar-collapse sidebar-mini">
<!--layout-top-nav-->
 <!--body class="hold-transition skin-blue sidebar-collapse"-->
        <div class="wrapper">
            <?php echo $_header; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php echo $_sidebar; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php echo $_content; ?> 
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; </strong> UID JAWA BARAT (BIDANG SDM - ASDM) 2019
            </footer>

            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

		<!-- Required JS -->
			<script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/jquery.dataTables.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

			<!-- Datatables Buttons -->
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/JSZip-2.5.0/jszip.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.html5.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.print.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.colVis.min.js"></script>

			<script src="<?= base_url() ?>assets/bower_components/pace/pace.min.js"></script>
					<!-- AdminLTE App -->
			<script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>"></script>
				<!-- AdminLTE for demo purposes -->
			<script src="<?php echo base_url('assets/js/AdminLTE/demo.js'); ?>"></script>

			<!-- Textarea editor -->
			<script src="<?= base_url() ?>assets/bower_components/codemirror/lib/codemirror.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/codemirror/mode/xml.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/froala_editor/js/froala_editor.pkgd.min.js"></script>

			<!-- App JS -->
			<script src="<?= base_url() ?>assets/dist/js/app/dashboard.js"></script>

			 <!-- Datepicker -->
			<script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
			<script src="<?php echo base_url('assets/js/plugins/datepicker/locales/bootstrap-datetimepicker.id.js'); ?>"></script>
      
			 <!-- Select2 -->
			<script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>	
			
			<!-- Custom JS -->
			<script type="text/javascript">
				$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
					return {
						"iStart": oSettings._iDisplayStart,
						"iEnd": oSettings.fnDisplayEnd(),
						"iLength": oSettings._iDisplayLength,
						"iTotal": oSettings.fnRecordsTotal(),
						"iFilteredTotal": oSettings.fnRecordsDisplay(),
						"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
						"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
					};
				};

				function ajaxcsrf() {
					var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
					var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
					var csrf = {};
					csrf[csrfname] = csrfhash;
					$.ajaxSetup({
						"data": csrf
					});
				}

				function reload_ajax() {
					table.ajax.reload(null, false);
				}
			</script>
			
			 
		
    </body>
</html>
<script>
    $(function () {
        $('.datepicker').datetimepicker({
            language: 'id',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    });
	
    $(function () {
        $('#datetimepicker').datetimepicker();
        $('#datetimepicker1').datetimepicker();
    });
</script>