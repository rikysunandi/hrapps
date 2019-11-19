<section class="content-header">
    <h1>
        Dashboard
        <small>CHART TOP 10</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/highchart/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highchart/highcharts.js'); ?>"></script>
<!-- end load library -->
<section class="content"> 
	<div class="row">
	
	<div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Tagihan Per Bulan</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <div class="box-body">
		<div id="report7"></div>
		<div id="report8"></div>
		 </div>
    </div>
	
    <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Tagihan Terbesar</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <div class="box-body">		
		<div id="report6"></div>
		<div id="report"></div>
		 </div>
    </div>
	
	 <div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Penyakit Terbanyak</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <div class="box-body">
		<div id="report2"></div>
		<div id="report5"></div>
		 </div>
    </div>
	
	<div class="box box-info">
	<div class="box-header with-border">
                        <h3 class="box-title">Keluarga Terbanyak</h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
                    </div>
        <div class="box-body">
		<div id="report3"></div>
		<div id="report4"></div>
		 </div>
    </div>
        </div>
		
<?php
    foreach($report7 as $result7){
        $id7[] = (float) $result7->rupiah; //ambil bulan
        $nama7[] = $result7->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'line',
            margin: 90,
			renderTo: 'report7',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'TAGIHAN KESEHATAN',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: 'By Jumlah',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama7);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'JUMLAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Rp. '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id7);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>
		
<?php
    foreach($report8 as $result8){
        $id8[] = (float) $result8->rupiah; //ambil bulan
        $nama8[] = $result8->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report8',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'TAGIHAN KESEHATAN',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: 'By Rupiah',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama8);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'RUPIAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Rp. '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id8);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>
		
<?php
    foreach($report as $result){
        $id[] = (float) $result->rupiah; //ambil bulan
        $nama[] = $result->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'TAGIHAN KESEHATAN',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: 'By Rupiah',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'RUPIAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Rp. '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>
		
<?php
    foreach($report6 as $result6){
        $id6[] = (float) $result6->rupiah; //ambil bulan
        $nama6[] = $result6->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report6',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'TAGIHAN KESEHATAN',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: 'by Jumlah Klaim',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama6);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'JUMLAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Total : '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id6);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>

		
<?php
    foreach($report2 as $result2){
        $id2[] = (float) $result2->rupiah; //ambil bulan
        $nama2[] = $result2->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report2',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'TAGIHAN KESEHATAN',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: '10 PENYAKIT TERBANYAK',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama2);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'JUMLAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Total : '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id2);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>
		
<?php
    foreach($report5 as $result5){
        $id5[] = (float) $result5->rupiah; //ambil bulan
        $nama5[] = $result5->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report5',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'TAGIHAN KESEHATAN',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: '10 PENYAKIT TERBANYAK',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama5);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'RUPIAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Rp. '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id5);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>

<?php
    foreach($report3 as $result3){
        $id3[] = (float) $result3->rupiah; //ambil bulan
        $nama3[] = $result3->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report3',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'KELUARGA TERBANYAK',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: 'by Jumlah Klaim',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama3);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'RUPIAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Total : '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id3);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>

		<?php
    foreach($report4 as $result4){
        $id4[] = (float) $result4->rupiah; //ambil bulan
        $nama4[] = $result4->nama; //ambil nilai
    }
     
?>
<script type="text/javascript">
$(function () {
	
	var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            margin: 90,
			renderTo: 'report4',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            },
			// Edit chart spacing
        spacingBottom: 15,
        spacingTop: 10,
        spacingLeft: 10,
        spacingRight: 10,

        // Explicitly tell the width and height of a chart
        width: null,
        height: 250
        },
        title: {
            text: 'KELUARGA TERBANYAK',
            style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        subtitle: {
           text: 'by Rupiah tagihan',
           style: {
                    fontSize: '10px',
                    fontFamily: 'Calibri, Arial'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama4);?>,
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'RUPIAH',
				style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            },
			labels: {
                style: {
                    fontSize:'10px',
					color: '#000000',
				    fontFamily: 'Calibri, Arial'
                }
            }
        },
        tooltip: {
             formatter: function() {
                //return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
                return this.x + ' Rp. '+ Highcharts.numberFormat(this.y,0);
             }
          },
        series: [{
            name: 'Data',
            data: <?php echo json_encode($id4);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Calibri, Arial'
                }
            }
        }]
    });
});
        </script>
</section>