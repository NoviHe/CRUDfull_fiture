<?php 
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_barang.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);

$fileName = "excel-barang-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename=$fileName");
header("Content-Type: application/vnd.ms-excel");
?>
<div>
    <h4>Laporan Data per tgl <?= date('d-m-Y'); ?></h4>
    <table border="1px">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
            <?php 
            $no = 1;
            $tampil = $brg->tampil();
            while ($data = $tampil->fetch_object()) {
                echo "<tr>";
                echo "<td align=center>".$no++."</td>";
                echo "<td>".$data->nama_brg."</td>";
                echo "<td>".$data->harga_brg."</td>";
                echo "<td>".$data->stok_brg."</td>";
                echo "</tr>";
            }
            ?>
    </table>
</div>