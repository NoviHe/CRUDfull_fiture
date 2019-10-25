<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$content = "
<h1>HelloWorld</h1>This is my first test 
<br>
kunjungi <a href='https://kuu-tech.blogspot.com'>Kuu_tech</a> 
awowkwokwokaowk";

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('Report '.date('d-m-Y').'.pdf');