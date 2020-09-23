<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>maxISP | Prijava</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="./index2.html"><b>max</b>ISP</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Provjera statusa zahtjeva</p>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="kod" id="kod_input" placeholder="Jedinstveni kod zahtjeva">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-12">
            <button onclick="provjeriStatus()" class="btn btn-primary btn-block">Provjeri status</button>
          </div>
          <!-- /.col -->
        </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php  include './modals/modal_provjera_statusa.php';  ?>

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

<script type="text/javascript">
  
  function provjeriStatus(){

    $('#div_poruka_greska').addClass('d-none');
    $('.red-podaci').addClass('d-none');

    $.ajax({
      type: 'GET',
      url: './backend/modul1/provjera_stautsa.php',
      data: {
        kod: $("#kod_input").val()
      },
      success: function(response){
        var data = JSON.parse(response).data;
        var ok = JSON.parse(response).ok;
        if(ok){
          $('.red-podaci').removeClass('d-none');
          $('#pretplatnicki_broj_span').html(data.pretplatnicki_broj);
          $('#kategorija_span').html(data.kategorija);
          $('#potkategorija_span').html(data.potkategorija);
          $('#status_span').html(data.status);
          $('#operater_span').html(data.operater);
        }else{
          var err = JSON.parse(response).err;
          if(err == 1){
            $('#div_poruka_greska').html('Unesite pravilan kod!').removeClass('d-none');
          }else if(err == 2){
            $('#div_poruka_greska').html('Ne postoji zahtjev!').removeClass('d-none');
          }else if(err == 3){
            $('#div_poruka_greska').html('Pokušali ste previše puta!').removeClass('d-none');
          }
        }
        $('#modal-provjera-statusa').modal('show');
      }
    });
  }

</script>

</body>
</html>