<?php 
include "models/m_input.php";
$inp = new input($connection);

if (@$_GET['act'] == '') {
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
</div>
<!-- /.row -->
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
                        <th>month</th>
                        <th>Year</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $tampil = $inp->tampilkan();
                    while ($data = $tampil->fetch_object()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data->motp ;?></td>
                        <td><?= $data->sms ;?></td>
                        <td><?= $data->smsotp ;?></td>
                        <td><?= $inp->bulan($data->month) ;?></td>
                        <td><?= $data->year; ?></td>
                        <td align="center">
                            <a id="edit_dt" data-toggle="modal" data-target="#edit" class="btn btn-info btn-xs" 
                            data-id="<?= $data->id;?>"
                            data-motp="<?= $data->motp;?>"
                            data-sms="<?= $data->sms;?>"
                            data-smsotp="<?= $data->smsotp;?>"
                            data-year="<?= $data->year;?>"
                            data-month="<?= $data->month;?>"
                            >
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="?page=input&act=del&id=<?= $data->id; ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')"
                            class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_dt" ><i class="fa fa-plus"></i> Tambah Data</a>
    </div>
</div>

<div id="tambah_dt" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" >
            <div class="modal-body">
                    <div class="form-group">
                        <label for="year" class="control-label">Tahun</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="year" id="inlineRadio1" value="2019"> 2019
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="year" id="inlineRadio2" value="2020"> 2020
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="year" id="inlineRadio3" value="2021"> 2021
                        </label>
                        <!-- <input type="number" name="year" class="form-control" id="year" required> -->
                    </div>
                    <div class="form-group">
                        <label for="month" class="control-label">Bulan</label>
                        <select class="form-control" name="month" id="month" required>
                            <option >Choose...</option>
                            <option value="1" >Januari</option>
                            <option value="2" >February</option>
                            <option value="3" >Maret</option>
                            <option value="4" >April</option>
                            <option value="5" >Mei</option>
                            <option value="6" >Juni</option>
                            <option value="7" >July</option>
                            <option value="8" >Agustus</option>
                            <option value="9" >September</option>
                            <option value="10" >Oktober</option>
                            <option value="11" >November</option>
                            <option value="12" >Desember</option>
                        </select>
                        <!-- <input type="number" name="month" class="form-control" id="month" required> -->
                    </div>
                    <div class="form-group">
                        <label for="motp" class="control-label">Jumlah MOTP</label>
                        <input type="number" name="motp" class="form-control" id="motp" required>
                    </div>
                    <div class="form-group">
                        <label for="sms" class="control-label">Jumlah SMS</label>
                        <input type="number" name="sms" class="form-control" id="sms" required>
                    </div>
                    <div class="form-group">
                        <label for="smsotp" class="control-label">Jumlah SMSOTP</label>
                        <input type="number" name="smsotp" class="form-control" id="motp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                </div>
            </form>
            <?php
            if (@$_POST['tambah']) {
                $motp = $connection->conn->real_escape_string($_POST['motp']);
                $sms = $connection->conn->real_escape_string($_POST['sms']);
                $smsotp = $connection->conn->real_escape_string($_POST['smsotp']);
                $year = $connection->conn->real_escape_string($_POST['year']);
                $month = $connection->conn->real_escape_string($_POST['month']);
                //$dt_tgl = $connection->conn->real_escape_string($_POST['dt_tgl']);
                $inp->tambah_dt($motp, $sms, $smsotp, $year, $month);
                header("Location: ?page=input");
            }
            ?>
        </div>
    </div>
</div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data </h4>
            </div>
            <form id="form" enctype="multipart/form-data" >
            <div class="modal-body" id="modal-edit">
                    <div class="form-group">
                        <!-- <label for="year" class="control-label">Tahun</label><br> -->
                        <!-- <label class="radio-inline" >
                            <input type="radio" name="year" id="inlineRadio1" value="2019"> 2018
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="year" id="inlineRadio2" value="2019"> 2019
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="year" id="inlineRadio3" value="2020"> 2020
                        </label> -->
                        <input type="hidden" name="year" class="form-control" id="year" required>
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="form-group">
                        <label for="month" class="control-label">Bulan</label>
                        <select readonly  class="form-control" name="month" id="month" required>
                            <option >Choose...</option>
                            <option value="1" >Januari</option>
                            <option value="2" >February</option>
                            <option value="3" >Maret</option>
                            <option value="4" >April</option>
                            <option value="5" >Mei</option>
                            <option value="6" >Juni</option>
                            <option value="7" >July</option>
                            <option value="8" >Agustus</option>
                            <option value="9" >September</option>
                            <option value="10" >Oktober</option>
                            <option value="11" >November</option>
                            <option value="12" >Desember</option>
                        </select>
                        <!-- <input type="number" name="month" class="form-control" id="month" required> -->
                    </div>
                    <div class="form-group">
                        <label for="motp" class="control-label">Jumlah MOTP</label>
                        <input type="number" name="motp" class="form-control" id="motp" required>
                    </div>
                    <div class="form-group">
                        <label for="sms" class="control-label">Jumlah SMS</label>
                        <input type="number" name="sms" class="form-control" id="sms" required>
                    </div>
                    <div class="form-group">
                        <label for="smsotp" class="control-label">Jumlah SMSOTP</label>
                        <input type="number" name="smsotp" class="form-control" id="smsotp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" name="edit" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).on("click", "#edit_dt", function(){
    var id = $(this).data('id');
    var motp = $(this).data('motp');
    var sms = $(this).data('sms');
    var smsotp = $(this).data('smsotp');
    var year = $(this).data('year');
    var month = $(this).data('month');

    $("#modal-edit #id").val(id);
    $("#modal-edit #motp").val(motp);
    $("#modal-edit #sms").val(sms);
    $("#modal-edit #smsotp").val(smsotp);
    $("#modal-edit #year").val(year);
    $("#modal-edit #month").val(month);
})

$(document).ready(function(e){
    $("#form").on("submit", (function(e){
        e.preventDefault();
        $.ajax({
            url : 'models/proses_edit.php',
            type : 'POST',
            data : new FormData(this),
            contentType : false,
            cache : false,
            processData : false,
            success : function(msg){
                $(".table").html(msg);
            }
        });
    }));
})
</script>

<?php 
} elseif (@$_GET['act'] == 'del') {
    $inp->delete($_GET['id']);
    header('Location: ?page=input');
}


?>

