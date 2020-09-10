<?php

  include '../connect.php';
  include '../funkcije.php';

  // provjerava je li korisnik prijavljen i redirektuje na login.html ako nije
  autorizacija();
  $korisnik = prijavljeni_korisnik();

  if(isset($_GET['id']) && is_numeric($_GET['id']) ){
    $id = $_GET['id'];
  }else{
    header("Location: ./index.php?msg=err1");
  }

  // citamo detalje zahtjeva
  $sql = "
          SELECT 
              z.ime as ime,
              z.prezime as prezime,
              k.naziv as kategorija,
              pk.naziv as potkategorija,
              z.pretplatnicki_broj as pret_br,
              s.id as status_id,
              s.naziv as status_naziv,
              z.jedinstveni_kod as kod,
              z.opis as opis,
              z.komentar_operatera as komentar
          FROM zahtjev z
            JOIN kategorija k on k.id = z.kategorija_id
            JOIN potkategorija pk on pk.id = z.potkategorija_id
            JOIN prioritet pr on pr.id = z.prioritet_id
            JOIN status s on s.id = z.status_id
          WHERE z.id = $id
          ";
  $res = mysqli_query($dbconn, $sql);
  $row = mysqli_fetch_assoc($res);

  $puno_ime = $row['ime']." ".$row['prezime'];
?>
<!DOCTYPE html>

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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php  include './nav.php';   ?>  
  <?php  include './aside.php';   ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Obrada zahtjeva - <?=$row['kod']?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../login.html">Prijava</a></li>
              <li class="breadcrumb-item"><a href="./index.php">Obrada zahtjeva</a></li>
              <li class="breadcrumb-item active"><?=$row['kod']?></li>
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
                
                <div class="row">
                  <div class="col-4">

                    <input type="hidden" name="zahtjev_id" id="zahtjev_id_hidden" value="<?=$id?>">

                    <div class="row">
                      <div class="col-5">
                        <label>Ime i prezime</label>
                      </div>
                      <div class="col-7">
                        <input type="text" disabled name="" class="form-control" value="<?=$puno_ime?>">
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-5">
                        <label>Kategorija</label>
                      </div>
                      <div class="col-7">
                        <input type="text" disabled name="" class="form-control" value="<?=$row['kategorija']?>">
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-5">
                        <label>Potkategorija</label>
                      </div>
                      <div class="col-7">
                        <input type="text" disabled name="" class="form-control" value="<?=$row['potkategorija']?>">
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-5">
                        <label>Pretpl. broj</label>
                      </div>
                      <div class="col-7">
                        <input type="text" disabled name="" class="form-control" value="<?=$row['pret_br']?>">
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-5">
                        <label>Tren. status</label>
                      </div>
                      <div class="col-7">
                        <select class="form-control" name="status" id="status_select" >
                          <?php
                            popuni_sifarnik('status', $row['status_id']);
                          ?>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="col-8">
                    
                    <div class="row mt-2">
                      <div class="col-12">
                        <label>Opis zahtjeva</label>
                        <textarea rows="3" class="form-control" disabled><?=$row['opis']?></textarea>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-12">
                        <label>Komentar operatera</label>
                        <textarea rows="2" class="form-control" id="komentar_operatera"><?=$row['komentar']?></textarea>
                        <button id="sacuvaj_komentar_btn" class="btn btn-sm btn-flat btn-primary btn-block mt-3">Sačuvaj komentar</button>
                      </div>
                    </div>

                  </div>
                </div>
                

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
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
  
  function poruka_uspjesno(tekst){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'success',
      title: tekst
    });
  }

  $("#status_select").change(function(){

    $.ajax({
      url: '../backend/modul3/obrada_zahtjeva/promijeni_status.php',
      type: 'POST',
      data: {
        status_id: $(this).val(),
        zahtjev_id: $("#zahtjev_id_hidden").val()
      },
      success: function(response){
        if(response == "OK")
          poruka_uspjesno("Status zahtjeva uspješno promijenjen!");
      }
    });

  });

  $("#sacuvaj_komentar_btn").click(function(){

    $.ajax({
      url: '../backend/modul3/obrada_zahtjeva/sacuvaj_komentar.php',
      type: 'POST',
      data: {
        komentar: $("#komentar_operatera").val(),
        zahtjev_id: $("#zahtjev_id_hidden").val()
      },
      success: function(response){
        if(response == "OK")
          poruka_uspjesno("Komentar je sačuvan!");
      }
    });

  });

</script>

</body>
</html>
