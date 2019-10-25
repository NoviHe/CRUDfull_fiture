<?php 
include "models/m_input.php";

$inp = new input($connection);
?>
<div class="row">
    <div class="col-lg-12">
    <h1>Input <small>Data Input</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="#">Input</a></li>
        <li class="active">Data Input</li>
    </ol>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="datatables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>MOTP</th>
                        <th>SMS</th>
                        <th>SMSOTP</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $tampil = $inp->tampil_dt();
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
                </tbody>
            </table>
        </div>
    </div>
</div>