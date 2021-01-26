<style type="text/css">
    ${demo.css}
</style>

<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light portlet-fit portlet-datatable bordered'>
        <div class='portlet-title'>
            <div class="caption">
                <i class="fa-bar-chart fa fa-lg"></i>
                <span class="caption-subject font-dark sbold uppercase">Fisik</span>
            </div>

        </div><!-- /.box-header -->
        <div class='portlet-body table-container'>
            <script type="text/javascript">

                $(function () {
                    $.post('<?php echo site_url('grafik/grafik_fisik') ?>', {pemain:<?php echo $id ?>}, function(data, textStatus, xhr) {

                        categ = data.categories;  
                        nilai = data.nilai;  

                        $('#container').highcharts({
                            title: {
                                text: 'Grafik Latihan Fisik',
                                x: -20 //center
                            },
                            subtitle: {
                                // text: 'Source: WorldClimate.com',
                                x: -20
                            },
                            xAxis: {
                                categories: categ
                                    // for (index = 0; index < categ.length; ++index) {
                                        // console.log(a[index]);
                                    // }
                                            
                                // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                            },
                            yAxis: {
                                title: {
                                    text: 'Waktu (detik)'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            tooltip: {
                                valueSuffix: ' detik'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle',
                                borderWidth: 0
                            },
                            series: nilai
                        });
                    });
                });
            </script>
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->


    <div class='row'>
        <div class='col-md-12'>
            <div class='portlet light portlet-fit portlet-datatable bordered'>
                <div class='portlet-title'>
                    <div class="caption">
                        <i class="fa-bar-chart fa fa-lg"></i>
                        <span class="caption-subject font-dark sbold uppercase">TEknik</span>
                    </div>
                </div><!-- /.box-header -->
            <div class='portlet-body table-container'>
                <script type="text/javascript">

                    $(function () {
                        $.post('<?php echo site_url('grafik/grafik_teknik') ?>', {pemain:<?php echo $id ?>}, function(data, textStatus, xhr) {

                            categ = data.categories;  
                            nilai = data.nilai;  

                            $('#container2').highcharts({
                                title: {
                                    text: 'Grafik Latihan Teknik',
                                    x: -20 //center
                                },
                                subtitle: {
                                    // text: 'Source: WorldClimate.com',
                                    x: -20
                                },
                                xAxis: {
                                    categories: categ
                                        // for (index = 0; index < categ.length; ++index) {
                                            // console.log(a[index]);
                                        // }
                                                
                                    // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                },
                                yAxis: {
                                    title: {
                                        text: 'Jumlah (kok)'
                                    },
                                    plotLines: [{
                                        value: 0,
                                        width: 1,
                                        color: '#808080'
                                    }]
                                },
                                tooltip: {
                                    valueSuffix: ' kok'
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle',
                                    borderWidth: 0
                                },
                                series: nilai
                            });
                        });
                    });
                </script>

                <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    S</div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url() ?>/assets/hc/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>/assets/hc/js/modules/exporting.js"></script>