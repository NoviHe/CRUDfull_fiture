<?php
include "models/m_barang.php";

$brg = new barang($connection);

if(@$_GET['act'] == ''){
?>
<div class="row">
    <div class="col-lg-12">
    <h1>Barang <small>Data Barang</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="#">Barang</a></li>
        <li class="active">Data Barang</li>
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
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok Barang</th>
                        <th>Gambar Barang</th>
                        <th>Tanggal Publish</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $tampil = $brg->tampil();
                    while ($data = $tampil->fetch_object()) {
                    ?>
                    <tr>
                        <td align="center"><?= $no++."." ?></td>
                        <td><?= $data->nama_brg; ?></td>
                        <td>Rp. <?= number_format( $data->harga_brg, 2,",","." ); ?></td>
                        <td><?= $data->stok_brg; ?></td>
                        <td align="center">
                            <img src="assets/img/barang/<?= $data->gbr_brg; ?>" alt="" width="70px">
                        </td>
                        <td><?= /*date('d F Y', strtotime(*/$data->tgl_publish/*))*/; ?></td>
                        <td align="center">
                            <a id="edit_brg" data-toggle="modal" data-target="#edit" 
                            data-id="<?= $data->id_brg; ?>"
                            data-nama="<?= $data->nama_brg; ?>"
                            data-harga="<?= $data->harga_brg; ?>"
                            data-stok="<?= $data->stok_brg; ?>"
                            data-gbr="<?= $data->gbr_brg; ?>" 
                            class="btn btn-info btn-xs">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="?page=barang&act=del&id=<?= $data->id_brg; ?>" 
                            onclick="return confirm('Yakin Ingin Menghapus Data?')"
                            class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a> 
                            <a href="./report/cetak_barang.php?id=<?= $data->id_brg; ?>" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-print"></i> Cetak</a>
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
        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah" ><i class="fa fa-plus"></i> Tambah Data</a>
        <a href="report/export_excel_barang.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Export Excel</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#cetakpdf"><i class="fa fa-print"> Cetak PDF</i></a>
    </div>
</div>

<!-- //Modal Cetak PDF -->
<div id="cetakpdf" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cetak PDF Data Barang</h4>
            </div>
            <div class="modal-body">
                <form action="./report/cetak_barang.php" method="POST" target="_blank">
                    <table>
                        <tr>
                            <td>
                                <div class="form-group">Dari Tanggal</div>
                            </td>
                            <td align="center" width="5%">
                                <div class="form-group">:</div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="tgl_a" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">Sampai Tanggal</div>
                            </td>
                            <td align="center">
                                <div class="form-group">:</div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="tgl_b" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" name="cetak_barang" class="btn btn-primary" value="Cetak">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <a href="./report/cetak_barang.php" target="_blank" class="btn btn-primary btn-sm">Cetak Semua Data</a>
            </div>
        </div>
    </div>
</div>

<!-- // Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nm_brg" class="control-label">Nama Barang</label>
                        <input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_brg" class="control-label">Harga Barang</label>
                        <input type="number" name="harga_brg" class="form-control" id="harga_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="stok_brg" class="control-label">Stok Barang</label>
                        <input type="number" name="stok_brg" class="form-control" id="stok_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="gbr_brg" class="control-label">Gambar Barang</label>
                        <input type="file" name="gbr_brg" class="form-control" id="gbr_brg" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                </div>
            </form>
            <?php
            if (@$_POST['tambah']) {
                $nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
                $harga_brg = $connection->conn->real_escape_string($_POST['harga_brg']);
                $stok_brg = $connection->conn->real_escape_string($_POST['stok_brg']);
                
                $extensi = explode(".", $_FILES['gbr_brg']['name']);
                $gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
                $sumber = $_FILES['gbr_brg']['tmp_name'];
                $upload = move_uploaded_file($sumber, "assets/img/barang/".$gbr_brg);
                if ($upload) {
                    $brg->tambah($nm_brg, $harga_brg, $stok_brg, $gbr_brg);
                    header("Location: ?page=barang");
                } else {
                    echo "<script>alert('Gagal Upload Gambar')</script>";
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- // Modal Edit -->
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Barang</h4>
            </div>
            <form id="form" enctype="multipart/form-data" >
                <div class="modal-body" id="modal-edit">
                    <div class="form-group">
                        <label for="nm_brg" class="control-label">Nama Barang</label>
                        <input type="hidden" name="id_brg" id="id_brg">
                        <input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_brg" class="control-label">Harga Barang</label>
                        <input type="number" name="harga_brg" class="form-control" id="harga_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="stok_brg" class="control-label">Stok Barang</label>
                        <input type="number" name="stok_brg" class="form-control" id="stok_brg" required>
                    </div>
                    <div class="form-group">
                        <label for="gbr_brg" class="control-label">Gambar Barang</label>
                        <div style="padding-bottom: 5px;">
                            <img src="" id="pict" width="70px">
                        </div>
                        <input type="file" name="gbr_brg" class="form-control" id="gbr_brg">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).on("click", "#edit_brg", function() {
    var idbrg = $(this).data('id');
    var nmbrg = $(this).data('nama');
    var hrgbrg = $(this).data('harga');
    var stokbrg = $(this).data('stok');
    var gbrbrg = $(this).data('gbr');
    $("#modal-edit #id_brg").val(idbrg);
    $("#modal-edit #nm_brg").val(nmbrg);
    $("#modal-edit #harga_brg").val(hrgbrg);
    $("#modal-edit #stok_brg").val(stokbrg);
    $("#modal-edit #pict").attr("src", "assets/img/barang/"+gbrbrg);
})
$(document).ready(function(e) {
    $("#form").on("submit", (function(e) {
        e.preventDefault();
        $.ajax({
            url : 'models/proses_edit_barang.php',
            type : 'POST',
            data : new FormData(this),
            contentType : false,
            cache : false,
            processData : false,
            success : function(msg) {
                $(".table").html(msg);
            }
        });
    }));
})
</script>

<?php 
} else if(@$_GET['act'] == 'del') {
    $gbr_awal = $brg->tampil($_GET['id'])->fetch_object()->gbr_brg;
    unlink("assets/img/barang/".$gbr_awal);

    $brg->hapus($_GET['id']);
    header("location: ?page=barang");
}

?>