<?php

  include '../connect.php';
  include '../funkcije.php';

  // provjerava je li korisnik prijavljen i redirektuje na login.html ako nije
  autorizacija();

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

  <title>AdminLTE 3 | Starter</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- ODJAVA FORMA -->
    <div class="ml-auto">
      <form action="../backend/logout.php" method="POST" class="form-inline ml-3">
        <div class="input-group input-group-sm">
          
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              Odjava
            </button>
          </div>

        </div>
      </form>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">maxISP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Obrada zahtjeva</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../login.html">Prijava</a></li>
              <li class="breadcrumb-item active">Obrada zahtjeva</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <table id="zahtjevi_tabela" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Korisnik</th>
                      <th>Kategorija</th>
                      <th>Potkategorija</th>
                      <th>Prioritet</th>
                      <th>Status</th>
                      <th>Datum</th>
                      <th>...</th>
                    </tr>
                  </thead>
                  <tbody id="zahtjevi_tabela_body">
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Korisnik</th>
                    <th>Kategorija</th>
                    <th>Potkategorija</th>
                    <th>Prioritet</th>
                    <th>Status</th>
                    <th>Datum</th>
                    <th>...</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.card -->
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<?php include '../modals/modal_dodijeli.php'; ?>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
  
  $(function () {
    
    popuni_tabelu();  

    $('#zahtjevi_tabela').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });

  function popuni_tabelu(){
    $.ajax({
      url: "../backend/modul2/obrada_zahtjeva/popuni_tabelu.php",
      type: "GET",
      success: function(response){
        var zahtjevi = JSON.parse(response);
        var redovi = "";
        for(var i = 0; i < zahtjevi.length; i++){

          var obrada_link = "<a href=\"#\" onclick=\"modalDodijeli("+zahtjevi[i].id+")\" ><i class=\"fas fa-check\" ></i></a>";

          redovi += "<tr>";
          redovi += " <td>"+ zahtjevi[i].korisnik +"</td>";
          redovi += " <td>"+ zahtjevi[i].kategorija +"</td>";
          redovi += " <td>"+ zahtjevi[i].potkategorija +"</td>";
          redovi += " <td>"+ zahtjevi[i].prioritet +"</td>";
          redovi += " <td>"+ zahtjevi[i].status +"</td>";
          redovi += " <td>"+ zahtjevi[i].datum +"</td>";
          redovi += " <td>"+ obrada_link +"</td>";
          redovi += "</tr>";
        }
        $("#zahtjevi_tabela_body").html(redovi);
      }
    });
  }

  function modalDodijeli(zahtjev_id){

    $.ajax({
      url: '../backend/modul2/obrada_zahtjeva/popuni_operatere.php',
      type: 'GET',
      data: {
        zahtjev_id: zahtjev_id
      },
      success: function(response){
        var operateri = JSON.parse(response);
        var operateri_opt = "";
        for(var i = 0; i < operateri.length; i++){
          operateri_opt += "<option value=\""+operateri[i].id+"\" >"+operateri[i].ime+"</option>";
        }
        $("#operater_select").html(operateri_opt);
      }
    });

    $("#modal-dodijeli").modal('show');
  }

</script>
</body>
</html>
