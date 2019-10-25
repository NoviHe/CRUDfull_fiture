<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_barang.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);

require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$content = '
<style type="text/css">
.tabel { border-collapse:collapse; }
.tabel th { padding:8px 5px; background-color:#f60; color:#fff;}
.tabel td { padding:3px;}
img {width:70px;}

.header { padding :4mm ; border:1px solid;}
.header span {font-size:25px;}

.lp { padding: 20px 0 10px; font-size:20px;}

</style>';

$content .= '
<page>
    <div class="header" align="center">
        <span>Aplikasi By NoviHerlambang</span>
    </div>
    <div class="lp">
        Laporan Data Barang
    </div>

    <table border="1px" class="tabel">
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Haraga Barang</th>
            <th>Stok Barang</th>
            <th>Gambar Barang</th>
        </tr>';
        $no=1;
        if (@$_GET['id'] != '') {
            $tampil = $brg->tampil(@$_GET['id']);    
        } else {
            if (@$_POST['cetak_barang']) {
                $tampil = $brg->tampil_tgl(@$_POST['tgl_a'], @$_POST['tgl_b']);  
            } else {
                $tampil = $brg->tampil();    
            }
        }
        while ($data = $tampil->fetch_object()) {
            $content .='
            <tr>
                <td align="center">'.$no++.'</td>
                <td>'.$data->nama_brg.'</td>
                <td>Rp. '.number_format($data->harga_brg, 2,",",".").'</td>
                <td>'.$data->stok_brg.'</td>
                <td align="center"><img src="../assets/img/barang/'.$data->gbr_brg.'"></td>
            </tr>';
        }
$content .='
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('Report_'.date('d-m-Y').'.pdf');