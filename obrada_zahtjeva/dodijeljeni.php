<?php

  include '../connect.php';
  include '../funkcije.php';

  // provjerava je li korisnik prijavljen i redirektuje na login.html ako nije
  autorizacija();
  $korisnik = prijavljeni_korisnik();

  $active_link = "obrada_zahtjeva";
  $active_sublink = "dodijeljeni_zahtjevi";

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
                      <th>Operater</th>
                      <th>Datum</th>
                      <th>...</th>
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
                    <th>Operater</th>
                    <th>Datum</th>
                    <th>...</th>
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

  <?php include './footer.php'; ?>
  
</div>
<!-- ./wrapper -->

<?php include '../modals/modal_dodijeli.php'; ?>
<?php include '../modals/modal_status.php'; ?>

<?php include '../modals/modal_izvjestaj1.php'; ?>
<?php include '../modals/modal_izvjestaj2.php'; ?>

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
  
  $(function () {
    
    popuni_tabelu();  
    inicijalizuj_tabelu();

  });

  function popuni_tabelu(){
    $.ajax({
      url: "../backend/modul2/obrada_zahtjeva/popuni_tabelu.php",
      type: "GET",
      data:{
        prikazi_dodijeljene: true
      },
      success: function(response){
        var zahtjevi = JSON.parse(response);
        var redovi = "";
        for(var i = 0; i < zahtjevi.length; i++){

          var obrada_link = "<a href=\"#\" onclick=\"modalDodijeli("+zahtjevi[i].id+")\" ><i class=\"fas fa-users\" ></i></a>";
          var status_link = "<a href=\"#\" onclick=\"modalStatus("+zahtjevi[i].id+")\" ><i class=\"fas fa-edit\" ></i></a>";

          redovi += "<tr id=\"red_"+zahtjevi[i].id+"\" >";
          redovi += " <td>"+ zahtjevi[i].korisnik +"</td>";
          redovi += " <td>"+ zahtjevi[i].kategorija +"</td>";
          redovi += " <td>"+ zahtjevi[i].potkategorija +"</td>";
          redovi += " <td>"+ zahtjevi[i].prioritet +"</td>";
          redovi += " <td>"+ zahtjevi[i].status +"</td>";
          redovi += " <td>"+ zahtjevi[i].operater +"</td>";
          redovi += " <td>"+ zahtjevi[i].datum +"</td>";
          redovi += " <td>"+ obrada_link +"</td>";
          redovi += " <td>"+ status_link +"</td>";
          redovi += "</tr>";
        }
        $("#zahtjevi_tabela_body").html(redovi);
      }
    });
  }

  function modalStatus(zahtjev_id){

    $.ajax({
      url: '../backend/modul2/obrada_zahtjeva/popuni_statuse.php',
      type: 'GET',
      data: {
        zahtjev_id: zahtjev_id
      },
      success: function(response){
        var statusi = JSON.parse(response);
        var statusi_opt = "";
        for(var i = 0; i < statusi.length; i++){
          var st = statusi[i].naziv;
          var id = statusi[i].id;
          var sel = statusi[i].selected;
          if(sel)
            statusi_opt += "<option selected value=\""+id+"\" >"+st+"</option>";
          else
            statusi_opt += "<option value=\""+id+"\" >"+st+"</option>";
        }
        $("#zahtjev_id_hidden_status").val(zahtjev_id);
        $("#status_select").html(statusi_opt);
      }
    });

    $("#modal-status").modal('show');
  }

  function promijeniStatus(){
    var status_id = $("#status_select").val();
    var zahtjev_id = $("#zahtjev_id_hidden_status").val();

    $.ajax({
      url: '../backend/modul2/obrada_zahtjeva/promijeni_status.php',
      type: 'POST',
      data: {
        zahtjev_id: zahtjev_id,
        status_id: status_id,
      },
      success: function(response){
        $("#modal-status").modal('hide');
        if(response == "OK"){
          popuni_tabelu();
          poruka_uspjesno("Uspješna promjena statusa!");
        }else{
          alert(response);
        }
      }
    });
  }

</script>
<!-- zajednicke f.je -->
<script type="text/javascript" src="../js/funkcije.js"></script>
</body>
</html>
