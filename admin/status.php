<?php
  
  ini_set("display_errors", "on");
  include '../connect.php';
  include '../funkcije.php';

  // provjerava je li korisnik prijavljen i redirektuje na login.html ako nije
  autorizacija();
  $korisnik = prijavljeni_korisnik();

  $active_link = "administracija";
  $active_sublink = "administracija_statusa";

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
            <h1 class="m-0 text-dark">Administracija statusa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../login.html">Prijava</a></li>
              <li class="breadcrumb-item active">Administracija statusa</li>
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

                <table id="status_tabela" class="table table-hover table-stripped">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Obavještenje</th>
                      <th>Izmjena</th>
                      <th>Brisanje</th>
                    </tr>
                  </thead>

                  <tbody id="status_tabela_body">
                    <!-- popunjava se AJAX-om -->
                  </tbody>

                </table>

                <p class="mt-4 mb-4">
                  <a href="#" data-toggle="modal" data-target="#modal_dodavanje_statusa" >
                  <i class="fas fa-plus"></i>  Dodaj novi status</a>
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
<?php include '../modals/modal_izmjena_statusa.php'; ?>
<?php include '../modals/modal_brisanje_statusa.php'; ?>
<?php include '../modals/modal_dodavanje_statusa.php'; ?>

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
<!-- zajednicke f.je -->
<script type="text/javascript" src="../js/funkcije.js"></script>

<script type="text/javascript">

  var trenutni_status_id = null;

  $(document).ready(function(){
    popuni_tabelu();
    $('#obavjestenje_tekst_txt').summernote();
    $('#obavjestenje_tekst_novi').summernote();
  });
  
  function popuni_tabelu(){
    $.ajax({
      url: "../backend/admin/status_tabela.php",
      type: "GET",
      success: function(response){
        var statusi = JSON.parse(response);
        var redovi = "";
        for(var i = 0; i < statusi.length; i++){

          redovi += "<tr id=\"red_"+statusi[i].id+"\" >";
          redovi += " <td>"+ statusi[i].naziv +"</td>";
          redovi += " <td>"+ statusi[i].obavjestenje +"</td>";
          redovi += " <td>"+ statusi[i].link_edit +"</td>";
          redovi += " <td>"+ statusi[i].link_delete +"</td>";
          redovi += "</tr>";
        }
        $("#status_tabela_body").html(redovi);
      }
    });
  }

  function izmjena_statusa_modal(status_id){
    trenutni_status_id = status_id;
    $.ajax({
            type: 'GET',
            url: '../backend/admin/detalji_statusa.php',
            data: { status_id: status_id },
            success: function(response){
              var status = JSON.parse(response);
              $('#naziv_input').val(status.naziv);
              if(status.obavjestenje == '1'){
                $('#obavjestenje_chk').attr('checked', true );
              }else{
                $('#obavjestenje_chk').attr('checked', false );
              }
              $('#obavjestenje_tekst_txt').summernote('code', status.obavjestenje_tekst);
              $('#modal_izmjena_statusa').modal('show');
            }
    });
  }

  function brisanje_statusa_modal(status_id){
    $('#modal_brisanje_statusa').modal('show');
    trenutni_status_id = status_id;
  }

  function izmijeniStatus(){
    $.ajax({
        type: 'POST',
        url: '../backend/admin/izmjena_statusa.php',
        data: { 
              status_id: trenutni_status_id,
              naziv: $('#naziv_input').val(),
              obavjestenje_tekst: $('#obavjestenje_tekst_txt').val(),
              obavjestenje: $('#obavjestenje_chk').is(':checked')
        },
        success: function(response){
          if(response == 'OK'){
            $('#modal_izmjena_statusa').modal('hide');
            popuni_tabelu();
            poruka_uspjesno('Status uspješno izmijenjen!');
          }
        }
    });
  }

  function brisiStatus(){
    $.ajax({
            type: 'POST',
            url: '../backend/admin/brisanje_statusa.php',
            data: { status_id: trenutni_status_id },
            success: function(response){
              if(response == 'OK'){
                $('#modal_brisanje_statusa').modal('hide');
                popuni_tabelu();
                poruka_uspjesno('Status uspješno izbrisan!');
              }
            }
    });
  }

  function dodajStatus(){
    $.ajax({
        type: 'POST',
        url: '../backend/admin/dodavanje_statusa.php',
        data: { 
              naziv: $('#naziv_input_novi').val(),
              obavjestenje_tekst: $('#obavjestenje_tekst_novi').val(),
              obavjestenje: $('#obavjestenje_chk_novi').is(':checked')
        },
        success: function(response){
          if(response == 'OK'){
            $('#modal_dodavanje_statusa').modal('hide');
            popuni_tabelu();
            poruka_uspjesno('Status uspješno dodat!');
          }
        }
    });
  }
</script>

</body>
</html>
