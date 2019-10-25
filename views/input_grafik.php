<!-- <meta http-equiv="refresh" content="60" /> -->



<div class="row">
    <div class="col-lg-12">
    <h1>OTP <small>Grafik OTP</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="#">OTP</a></li>
        <li class="active">Grafik OTP</li>
    </ol>
    </div>
</div><!-- /.row -->

<?php
include "models/m_function.php";
$no = 1 ;

    // $url1 = 0;
    $url1 = webCloud('http://104.199.196.122/cek.php');
    $url2 = APIDomain("https://gateway.citcall.com/cek.php");
    $url3 = Dashboard("https://dashboard.citcall.com/cek.php");
    $url4 = TIFA('http://103.16.198.54:3200/cek.php');
    $url5 = Jupiter('http://103.251.44.90:3200/cek.php');

 ?>

<div class="row">
    <div class="col-lg-7">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-5">
        <div id="container">
            
            <table class="table table-hover">
              <thead>
                  <tr>
                      <td>No</td>
                      <td>Name</td>
                      <td>Status</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td><?= $no++?></td>
                      <td>WEB Cloud</td>
                      <td><?= status($url1); ?></td>
                  </tr>
                  <tr>
                      <td><?= $no++?></td>
                      <td>API Domain</td>
                      <td><?= status($url2); ?></td>
                  </tr>
                    <tr>
                        <td><?= $no++?></td>
                        <td>Dashboard</td>
                        <td><?= status($url3); ?></td>
                    </tr>
                    <tr>
                        <td><?= $no++?></td>
                        <td>TIFA</td>
                        <td><?= status($url4); ?></td>
                    </tr>
                    <tr>
                        <td><?= $no++?></td>
                        <td>Jupiter</td>
                        <td><?= status($url5); ?></td>
                    </tr>
              </tbody>
            </table>
        </div>
    </div>


<?php 
    $ser = error($url1);
    $ser = error($url2);
    $ser = error($url3);
    $ser = error($url4);
    $ser = error($url5);
    echo $ser;
?>

<?php 
include "models/m_input.php";
$inp = new input($connection);
$tampil = $inp->tampil_dt();

$sms = array();
$motp = array();
$tgl = array();
$tgl2 = array();
$smsotp =array();
$table = array();
   
while ($data = $tampil->fetch_object()) {
    //  $tgl[] = date('F', strtotime($data->dt_tgl));
    //$tgl2[] = date('d M Y', strtotime($data->dt_tgl));
    $tgl2[] = $inp->bulan($data->month);
    $sms[] = intval($data->sms);
    $motp[] = intval($data->motp);
    $smsotp[] = intval($data->smsotp);
}
?>

<script src="assets/highcharts/series-label.js"></script>
<script src="assets/highcharts/export-data.js"></script>
<script src="assets/highcharts/highcharts.js"></script>
<script src="assets/highcharts/exporting.js"></script>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Statistik bulanan 2019'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: <?= json_encode($tgl2); ?>
    },
    yAxis: {
        title: {
            text: 'Jumlah'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    series: [{
        name: 'SMS',
        data: <?= json_encode($sms); ?>
    }, {
        name: 'MOTP',
        data: <?= json_encode($motp); ?>
    }, {
        name: 'SMSOTP',
        data: <?= json_encode($smsotp); ?>
    }]
});
</script>

<script type="text/javascript">
setTimeout(function() {
    window.location.reload(1);
}, 60000);
</script>
<!-- 
<script type="text/javascript">
if (  = false){
    var snd = new audio('../assets/mp3/Bleep.mp3');
    snd.play();
    alert("error");
}
</script> -->

<script type="text/javascript">
    function play_sound() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'views/alarm.mp3');
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.load();
        audioElement.play();
    }
</script>