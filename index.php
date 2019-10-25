<?php 
ob_start();
require_once('config/+koneksi.php');
require_once('models/database.php');

$connection = new Database($host, $user, $pass, $database);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
        echo "Dashboard";
    } elseif (@$_GET['page'] == 'barang') {
        echo "Barang";
    } elseif (@$_GET['page'] == 'barang_grafik') {
        echo "Grafik";
    } elseif (@$_GET['page'] == 'input') {
      echo "Input Data";
    } elseif (@$_GET['page'] == 'input_grafik') {
      echo "Grafik";
    } elseif (@$_GET['page'] == 'table') {
      echo "Tabel Grafik" ;
    }; ?> | TokoNovi</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/dataTables/datatables.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <script src="assets/js/fontawesome.js"></script>
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">TokoNovi</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> Barang <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=barang">Data Barang</a></li>
                <li><a href="?page=barang_grafik">Grafik</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-key"></i> OTP <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=input">Data Input</a></li>
                <li><a href="?page=input_grafik">Grafik</a></li>
              </ul>
            </li>
            <li><a href="?page=table"><i class="fa fa-table"> Tabel Data</i></a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
           
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
        <?php
          if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
            include "views/dashboard.php";
          } elseif (@$_GET['page'] == 'barang') {
            include "views/barang.php";
          } elseif (@$_GET['page'] == 'barang_grafik') {
            include "views/barang_grafik.php";
          } elseif (@$_GET['page'] == 'input') {
            include "views/input.php";
          } elseif (@$_GET['page'] == 'input_grafik') {
            include "views/input_grafik.php";
          } elseif (@$_GET['page'] == 'table') {
            include "views/table_data.php";
          } 
        ?>
        

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/sweetjs/sweetalert2.all.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/dataTables/datatables.min.js"></script>
    <script type="text/javaScript"">
    $(document).ready( function () {
        $('#datatables').DataTable();
    } );
    </script>
  </body>
</html>