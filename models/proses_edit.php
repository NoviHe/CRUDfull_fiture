<?php 
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_input.php";

$connection = new Database($host, $user, $pass, $database);
$inp = new input($connection);

$id = $_POST['id'];
$motp = $connection->conn->real_escape_string($_POST['motp']);
$sms = $connection->conn->real_escape_string($_POST['sms']);
$smsotp = $connection->conn->real_escape_string($_POST['smsotp']);
$year = $connection->conn->real_escape_string($_POST['year']);
$month = $connection->conn->real_escape_string($_POST['month']);
//$dt_tgl = $connection->conn->real_escape_string($_POST['dt_tgl']);
$inp->edit_dt("UPDATE sales SET motp = '$motp', sms = '$sms', smsotp = '$smsotp' WHERE id = '$id' ");
echo "<script>window.location='?page=input';</script>"

?>