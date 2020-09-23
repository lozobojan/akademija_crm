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
            <h1 class="m-0 text-dark"><small>Prijava kvara / zahtjevanje podrške</small></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">

          <div class="d-none alert alert-success alert-dismissible col-12 text-center" id="div_poruka">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-check"></i> Hvala na zahtjevu!</h5>
            Obraticemo Vam se u najkracem mogucem roku! Status zahtjeva možete pratiti korišćenjem koda: 
            <span id="kod_zahtjeva"></span>
          </div>

          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Dodavanje novog zahtjeva</h5>
              </div>
              <div class="card-body">
                
                <form id="dodavanje_forma" action="./zahtjev/dodavanje.php" method="POST">
                  
                  <div class="row">
                    <div class="col-6">
                      <label for="ime_input">Ime</label>
                      <input type="text" name="ime" id="ime_input" class="form-control required" placeholder="Unesite Vase ime">
                    </div>
                    <div class="col-6">
                      <label for="prezime_input">Prezime</label>
                      <input type="text" name="prezime" id="prezime_input" class="form-control required" placeholder="Unesite Vase prezime">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <label>Jedinstveni pretplatnički broj</label>
                      <input type="text" name="pretplatnicki_broj" id="pretplatnicki_broj_input" class="form-control required" placeholder="Unesite Vaš jedinstveni pretplatnički broj">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <label for="kategorija_select">Kategorija</label>
                      <select class="form-control required" name="kategorija" id="kategorija_select">
                        <option value="">-odaberite kategoriju-</option>
                        <?php popuni_sifarnik('kategorija'); ?>
                      </select>
                    </div>
                    <div class="col-4">
                      <label for="potkategorija_select">Potkategorija</label>
                      <select class="form-control required" name="potkategorija" id="potkategorija_select">
                        <option value="">-odaberite potkategoriju-</option>
                        <?php popuni_sifarnik('potkategorija'); ?>
                      </select>
                    </div>
                    <div class="col-4">
                      <label for="prioritet_select">Prioritet</label>
                      <select class="form-control required" name="prioritet" id="prioritet_select">
                        <option value="">-odaberite prioritet-</option>
                        <?php popuni_sifarnik('prioritet'); ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <label for="opis_textarea">Opis zahtjeva</label>
                      <textarea name="opis" id="opis_textarea" class="form-control required" placeholder="Opis zahtjeva" rows="4"></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <label for="telefon_input">Kontakt telefon</label>
                      <input type="text" name="telefon" id="telefon_input" class="form-control required" placeholder="Kontakt telefon">
                    </div>
                    <div class="col-4">
                      <label for="mail_input">Mail adresa</label>
                      <input type="text" name="mail" id="mail_input" class="form-control required" placeholder="Mail adresa">
                    </div>
                    <div class="col-4">
                      <input type="checkbox" name="obavjestenje_saglasnost" id="obavjestenje_saglasnost_chk" class="mt-5">
                      <label for="obavjestenje_saglasnost_chk">Želim da primam obavještenja</label>
                    </div>
                  </div>

                  <div class="row mt-5">
                    <button type="submit" class="btn btn-flat btn-primary btn-block">POŠALJI ZAHTJEV</button>
                  </div>

                </form>

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
      maxISP korisnički portal
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="#">Web obuka</a>.</strong> generacija IV
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
  
<script type="text/javascript">
  
  // validacija required polja
  $("#dodavanje_forma").on('submit', function(e){
    
    e.preventDefault();

    var greska = false;
    $(".required").each(function(){
      if($(this).val() == "" || $(this).val() == null){
        $(this).addClass('is-invalid');
        greska = true;
      }else{
        $(this).removeClass('is-invalid');
      }
    });

    if(greska) return;
    
    var form_data = $(this).serialize();

    $.ajax({
      url: "./backend/modul1/zahtjev/dodavanje.php",
      type: "POST",
      data: form_data,
      success: function(response){
        var odgovor = JSON.parse(response);
        if(odgovor['ok']){
          $("#div_poruka").removeClass('d-none');
          $("#kod_zahtjeva").html(odgovor['kod']);
        }
      }
    });

  });

</script>

</body>
</html>
