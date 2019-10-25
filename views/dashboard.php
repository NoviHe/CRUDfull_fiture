<?php
//get tahun


?>

<div class="row">
    <div class="col-lg-12">
    <h1>Dashboard <small>Admin</small></h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-4">
        <h4>Selamat Datang Di Dashborad</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form action="" method="GET" id="form-tahun">
        <div class="form-row">
            <div class="form-group col-md-6">
            <select id="inputState" class="form-control" name="tahun" id="tahun" onChange="this.form.submit()" >
                <option selected>Tahun...</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
            </select>
            </div>
            <div class="form-group col-md-4">
            <!-- <button type="submit" class="btn btn-primary">OK</button> -->
            </div>
        </div>
        </form>
    </div>
</div>

<!-- <meta http-equiv="refresh" content="60" /> -->

<?php
include "models/m_function.php";
include "models/m_input.php";
$inp = new input($connection);


$no = 1 ;

if (@$_GET['tahun'] == '') {
    $tahun = '2019';
} else {
    $tahun = $_GET['tahun'];
}

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
            <div>
                <h4 align="center">Server</h4>
            </div>
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
</div>
<div class="row">
<div class="col-lg-12">
    <div>
        <h4 align="center">Tabel Data Tahun <?= $tahun ;?></h4>
    </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="datatables">
                <tr>
                    <th>No.</th>
                    <th>MOTP</th>
                    <th>SMS</th>
                    <th>SMSOTP</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                </tr>
                <?php 
                    $no = 1;
                    $tampil = $inp->tabel_ds($tahun);
                    // $angka = 1;
                    // $bln = "Januari.Februari.Maret.April.Juni.Juli.Agustus.September.Oktober.Desember";
                    // $arraybln = explode(".",$bln);
                    // echo $arraybln[$angka-1];
                    while ($data = $tampil->fetch_object()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data->motp ;?></td>
                        <td><?= $data->sms ;?></td>
                        <td><?= $data->smsotp ;?></td>
                        <td><?= $inp->bulan($data->month) ;?></td>
                        <td><?= $data->year ;?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php 
//server test
    $ser = error($url1);
    $ser = error($url2);
    $ser = error($url3);
    $ser = error($url4);
    $ser = error($url5);
    echo $ser;


//tahun
  


//high charts 

$tampil = $inp->tampil_grafik($tahun);

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
        text: 'Statistik bulanan <?= $tahun ?>'
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

<!-- script auto refresh per 60 det -->
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


<!-- script alert suara -->
<script type="text/javascript">
    function play_sound() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'views/alarm.mp3');
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.load();
        audioElement.play();
    }
</script>

<!-- <script type="text/javascript">

function formAutoSubmit () {

var frm = document.getElementById("#form-tahun");

frm.submit();

}

window.onload = formAutoSubmit;

</script> -->