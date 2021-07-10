<div class="col-md-12">
  <!-- BAR CHART -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Grafik Keuangan</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <br>
    <form method="POST" class="form-horizontal">
      <div class='form-group'>
            <label class='col-sm-1 control-label'>Bulan :</label>
              <div class='col-sm-4'>
                <select name='o_grafik' class='form-control' id="grafik" onchange="change()" >
                  <option value="saldo" selected> Grafik Saldo </option>";
                  <option value="pendapatan"> Grafik Pendapatan & Pengeluaran </option>";
                </select>
              </div>
      </div>
  </form>
    <div class=" chart-responsive">
      <div class="chart" id="bar-chart" style="height: 300px;"></div>
    </div>
    <div class=" chart-responsive">
      <div class="chart" id="line-chart" style="height: 300px;"></div>
    </div>
    <!-- /.box-body -->

  </div>
  <!-- /.box -->

  <?php
  $data ="";
  $bulan = 0;
  $tahun = 0;
  foreach ($tgl_awal as $row) {
    $bulan = $row->bulan;
    $tahun = $row->tahun;
  }
  foreach ($pendapatan_per_bulan as $row) {
    for($month = $bulan; $month < $row->bulan || $tahun < $row->tahun; $month++){
      $data .= "{y: '".substr(bulan($month),0,3). " " .$tahun."',
      a: 0,
      b: 0},";
      if($month == 12){
        $month = 1;
        $tahun++;
    }
  }

    $data .= "{y: '".substr(bulan($row->bulan),0,3). " " .$row->tahun."',
              a: '".$row->pendapatan."',
              b: '".$row->pengeluaran."'},";
    $bulan = $row->bulan;
    if($bulan == 12){
      $bulan = 1;
      $tahun++;
    }
    else{
      $bulan ++;
    }
  }
  ?>
<?php
  $data2 ="";
  $bulan = 0;
  $tahun = 0;
  $sld = $saldo;
    foreach ($tgl_awal as $row) {
    $bulan = $row->bulan;
    $tahun = $row->tahun;
    }
    foreach ($pendapatan_per_bulan as $row) {
      for($month = $bulan; $month < $row->bulan || $tahun < $row->tahun; $month++){
        $data2 .= "{y: '".substr(bulan($month),0,3)." ".$tahun. "',
        a: '".$sld."'},";
        if($month == 12){
          $month = 1;
          $tahun++;
        }
            echo $month;
      }
      $sld += $row->pendapatan -= $row->pengeluaran;
      $data2 .= "{y: '".substr(bulan($row->bulan),0,3)." ".$row->tahun."',
            a: '".$sld."'},";
      $bulan = $row->bulan;
      if($bulan == 12){
        $bulan = 1;
        $tahun++;
      }
      else{
      $bulan++;
      }
  ;
    }
?>



<script src="<?php echo base_url('assets/template/back/bower_components') ?>/raphael/raphael.min.js"></script>
<script src="<?php echo base_url('assets/template/back/bower_components') ?>/morris.js/morris.min.js"></script>
<script>
function change() {
    var selectBox = document.getElementById("grafik");
    var selected = selectBox.options[selectBox.selectedIndex].value;
    if(selected === 'saldo'){
      $("#bar-chart").hide();
      $("#line-chart").show();
    }
    if(selected === 'pendapatan'){
      $("#line-chart").hide();
      $("#bar-chart").show();
    }
}
$(document).ready(function(){
  if($("#grafik").val()=="saldo"){
    $("#line-chart").show();
    $("#bar-chart").hide();
  }
  else if($("#grafik").val()=="pendapatan"){
    $("#line-chart").hide();
    $("#bar-chart").show();
  }
});
</script>
<script>
$(function () {
"use strict";

  //BAR CHART
  var bar = new Morris.Bar({
    xLabelAngle: 60,
    element: 'bar-chart',
    resize: true,
    data: [
    <?php echo $data; ?>
  ],
    barColors: ['#008080', '#f56954'],
    xkey: ['y'],
    ykeys: ['a', 'b'],
    labels: ['Pendapatan', 'Pengeluaran'],
    hideHover: 'auto'
  });
  });
</script>

<script>
$(function () {
"use strict";
// LINE CHART
var line = new Morris.Line({
  parseTime: false,
  xLabelAngle: 60,
  element: 'line-chart',
  resize: true,
  data: [
    <?php echo $data2; ?>
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Saldo'],
  lineColors: ['#008080'],
  hideHover: 'auto'
});

  });
</script>
