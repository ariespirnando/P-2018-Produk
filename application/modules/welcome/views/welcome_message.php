<h4>Selamat Datang</h4>
<hr>
<?php echo date('d-m-Y H:i:s')?> || <?php echo $this->session->userdata('cnama')?>


<script type="text/javascript">
	$(function () {
    // Create the chart
    	$('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'STOK PRODUK BAHAN BAKU - BAHAN SIAP JUAL'
        },
        subtitle: {
            text: 'STOK 7 HARI'
        },
        xAxis: {
            categories: ['STOK']
        },
        yAxis: {
          title: {
            text: 'Jumlah KG'
          }
        },
        legend: {
            enabled: true
        },

        series:            
              [ 
                {
                    name: 'STOK Pembelian',
                    data: [50]
                },  
                {
                    name: 'STOK Giling',
                    data: [80]
                }, 
                {
                    name: 'STOK Jual',
                    data: [150]
                }, 
              ]
        }); 
    });
</script>
<script src="<?php echo base_url(); ?>assets/grafik/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/grafik/js/data.js"></script>
<script src="<?php echo base_url(); ?>assets/grafik/js/themes/grid-light.js"></script>
<script src="<?php echo base_url(); ?>assets/grafik/js/drilldown.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	