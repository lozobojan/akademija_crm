<?php

  include './connect.php';
  include './funkcije.php';

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>maxISP | Portal za prijavu problema/zahtijevanje podrške</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="./index3.html" class="navbar-brand">
        <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">maxISP</span>
      </a>
      
      <span>Portal za prijavu problema/zahtjevanje podrške</span>


    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><small>Dobro došli na <em>maxISP</em> korisnički portal!</small></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">

          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Odaberite željenu akciju</h5>
              </div>
              <div class="card-body">
               
               <div class="row mt-5 mb-5">
                 <div class="col-12">
                  <ul>
                    <li>
                      <p>Ukoliko imate problem pri radu našeg servisa ili Vam treba podrška, kliknite <a href="./zahtjev.php">ovdje</a></p>
                    </li>
                    <li>
                      <p>Za prijavu kao administrator ili operater, kliknite <a href="./login.html">ovdje</a></p>
                    </li>
                  </ul>
                 </div>
               </div>

              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

</body>
</html>
