<?php
  
  ini_set("display_errors", "on");
  include '../connect.php';
  include '../funkcije.php';

  // provjerava je li korisnik prijavljen i redirektuje na login.html ako nije
  autorizacija();
  $korisnik = prijavljeni_korisnik();

  $active_link = "administracija";
  $active_sublink = "administracija_korisnika";

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
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- slim select -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php  include '../obrada_zahtjeva/nav.php';   ?>  
  <?php  include '../obrada_zahtjeva/aside.php';   ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administracija korisnika</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../login.html">Prijava</a></li>
              <li class="breadcrumb-item active">Administracija korisnika</li>
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
              <div class="card-body table-responsive">

                <table id="korisnik_tabela" class="table table-hover table-stripped">
                  <thead>
                    <tr>
                      <th>Ime</th>
                      <th>Prezime</th>
                      <th>Korisničko ime</th>
                      <th>Uloga</th>
                      <th>Sektor</th>
                      <th>Spec.</th>
                      <th>Izmjena</th>
                      <th>Brisanje</th>
                    </tr>
                  </thead>

                  <tbody id="korisnik_tabela_body">
                    <!-- popunjava se AJAX-om -->
                  </tbody>

                </table>

                <p class="mt-4 mb-4">
                  <a href="#" data-toggle="modal" data-target="#modal_dodavanje_korisnika" >
                  <i class="fas fa-plus"></i>  Dodaj novog korisnika</a>
                </p>

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

  <?php include '../obrada_zahtjeva/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include '../modals/modal_dodijeli.php'; ?>
<?php include '../modals/modal_izvjestaj1.php'; ?>
<?php include '../modals/modal_izvjestaj2.php'; ?>
<?php include '../modals/modal_izmjena_korisnika.php'; ?>
<?php include '../modals/modal_brisanje_korisnika.php'; ?>
<?php include '../modals/modal_dodavanje_korisnika.php'; ?>

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
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- slim select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
<!-- zajednicke f.je -->
<script type="text/javascript" src="../js/funkcije.js"></script>

<script type="text/javascript">

  var trenutni_korisnik_id = null;

  $(document).ready(function(){
    popuni_tabelu();
    // var slim_select = new SlimSelect({
    //                                   select: '#spec_select_novi'
    //                                 }); 
  });
  
  function popuni_tabelu(){
    $.ajax({
      url: "../backend/admin/korisnik_tabela.php",
      type: "GET",
      success: function(response){
        var korisnici = JSON.parse(response);
        var redovi = "";
        for(var i = 0; i < korisnici.length; i++){
          redovi += "<tr id=\"red_"+korisnici[i].id+"\" >";
          redovi += " <td>"+ korisnici[i].ime +"</td>";
          redovi += " <td>"+ korisnici[i].prezime +"</td>";
          redovi += " <td>"+ korisnici[i].username +"</td>";
          redovi += " <td>"+ korisnici[i].uloga +"</td>";
          redovi += " <td>"+ korisnici[i].sektor +"</td>";
          redovi += " <td>"+ korisnici[i].spec +"</td>";
          redovi += " <td>"+ korisnici[i].link_edit +"</td>";
          redovi += " <td>"+ korisnici[i].link_delete +"</td>";
          redovi += "</tr>";
        }
        $("#korisnik_tabela_body").html(redovi);
      }
    });
  }

  function izmjena_korisnika_modal(korisnik_id){
    trenutni_korisnik_id = korisnik_id;
    $.ajax({
            type: 'GET',
            url: '../backend/admin/detalji_korisnika.php',
            data: { korisnik_id: korisnik_id },
            success: function(response){
              var korisnik = JSON.parse(response);

              $('#ime_input').val(korisnik.ime);
              $('#prezime_input').val(korisnik.prezime);
              $('#username_input').val(korisnik.username);
              $('#sektor_select').val(korisnik.sektor_id);
              $('#uloga_select').val(korisnik.uloga_id);
              $('#spec_select').val(korisnik.spec);
              $('#modal_izmjena_korisnika').modal('show');
            }
    });
  }

  function brisanje_korisnika_modal(korisnik_id){
    $('#modal_brisanje_korisnika').modal('show');
    trenutni_korisnik_id = korisnik_id;
  }

  function izmijeniKorisnika(){
    $.ajax({
        type: 'POST',
        url: '../backend/admin/izmjena_korisnika.php',
        data: { 
              korisnik_id: trenutni_korisnik_id,
              ime: $('#ime_input').val(),
              prezime: $('#prezime_input').val(),
              username: $('#username_input').val(),
              sektor: $('#sektor_select').val(),
              uloga: $('#uloga_select').val(),
              spec: $('#spec_select').val(),
        },
        success: function(response){
          if(response == 'OK'){
            $('#modal_izmjena_korisnika').modal('hide');
            popuni_tabelu();
            poruka_uspjesno('Korisnik uspješno izmijenjen!');
          }
        }
    });
  }

  function brisiKorisnika(){
    $.ajax({
            type: 'POST',
            url: '../backend/admin/brisanje_korisnika.php',
            data: { korisnik_id: trenutni_korisnik_id },
            success: function(response){
              if(response == 'OK'){
                $('#modal_brisanje_korisnika').modal('hide');
                popuni_tabelu();
                poruka_uspjesno('Korisnik uspješno izbrisan!');
              }
            }
    });
  }

  function dodajStatus(){
    $.ajax({
        type: 'POST',
        url: '../backend/admin/dodavanje_korisnika.php',
        data: { 
              ime: $('#ime_input_novi').val(),
              prezime: $('#prezime_input_novi').val(),
              username: $('#username_input_novi').val(),
              sektor: $('#sektor_select_novi').val(),
              uloga: $('#uloga_select_novi').val(),
              spec: $('#spec_select_novi').val(),
        },
        success: function(response){
          if(response == 'OK'){
            $('#modal_dodavanje_korisnika').modal('hide');
            popuni_tabelu();
            poruka_uspjesno('Korisnik uspješno dodat!');
          }
        }
    });
  }
</script>

</body>
</html>
