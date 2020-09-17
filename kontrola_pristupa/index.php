<?php
  
  ini_set("display_errors", "on");
  include '../connect.php';
  include '../funkcije.php';

  // provjerava je li korisnik prijavljen i redirektuje na login.html ako nije
  autorizacija();
  $korisnik = prijavljeni_korisnik();

  $active_link = "kontrola_pristupa";
  $active_sublink = "";

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

  <?php  include '../obrada_zahtjeva/nav.php';   ?>  
  <?php  include '../obrada_zahtjeva/aside.php';   ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kontrola pristupa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../login.html">Prijava</a></li>
              <li class="breadcrumb-item active">Kontrola pristupa</li>
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
                <table id="pristup_tabela" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Korisnik</th>
                      <!-- dinamicki prikazujemo naslove tabele, tj module -->
                      <?php
                        $niz_modula = [];
                        $sql_moduli = "SELECT * FROM modul ORDER BY id";
                        $res_moduli = mysqli_query($dbconn, $sql_moduli);
                        $moduli_th = "";
                        while($row_moduli = mysqli_fetch_assoc($res_moduli)){
                          $modul_naziv = $row_moduli['sistemski_naziv'];
                          $modul_id = $row_moduli['id'];
                          $niz_modula[] = ['naziv' => $modul_naziv, 'id' => $modul_id ];
                          $moduli_th .= "<th>".$row_moduli['naziv']."</th>";
                        }
                        echo $moduli_th;
                      ?>
                    </tr>
                  </thead>
                  <tbody id="pristup_tabela_body">
                    <?php

                      $redovi = "";
                      $sql_kor = "SELECT id, concat(ime, ' ', prezime) as korisnik from korisnik";
                      $res_kor = mysqli_query($dbconn, $sql_kor);

                      while($row_kor = mysqli_fetch_assoc($res_kor) ){

                        $kor_id = $row_kor['id'];
                        $kor_naziv = $row_kor['korisnik'];

                        $redovi_temp = "";
                        for($i=0;$i<count($niz_modula); $i++){

                          $modul_temp = $niz_modula[$i]['naziv'];
                          $modul_temp_id = $niz_modula[$i]['id'];
                          
                          if(pristupModulu($modul_temp, $kor_id)){
                            $checked = "checked";
                          }else{
                            $checked = "";
                          }

                          $id_temp = "customSwitch_$kor_id"."_".$modul_temp_id;
                          $on_change = "onchange=\"dodijeliPrava($kor_id, $modul_temp_id)\" ";
                          $redovi_temp .= 
                          '<td>
                            <div class="custom-control custom-switch">
                              <input type="checkbox" '.$checked.' class="custom-control-input" id="'.$id_temp.'" '.$on_change.' >
                              <label class="custom-control-label" for="'.$id_temp.'"></label>
                            </div>
                          </td>';
                          
                        }

                        $redovi .= "<tr>";
                        $redovi .= "  <td>$kor_naziv</td>";
                        $redovi .=    $redovi_temp;
                        $redovi .= "</tr>";

                      }

                      echo $redovi;
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Korisnik</th>
                    <?=$moduli_th?>
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

  <?php include '../obrada_zahtjeva/footer.php'; ?>
</div>
<!-- ./wrapper -->

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
  
  function dodijeliPrava(korisnik_id, modul_id){

    var checked = $("#"+"customSwitch_"+korisnik_id+"_"+modul_id).is(':checked');

    $.ajax({
      url: "../backend/modul5/kontrola_pristupa/dodijeli_pravo.php",
      type: "POST",
      data: {
        korisnik_id: korisnik_id,
        modul_id: modul_id,
        pravo: checked
      },
      success: function(response){
        if(response == "OK"){
          poruka_uspjesno("Uspješna dodijela prava!");
        }else{
          alert(response);
        }
      }
    });

  }

</script>
<script type="text/javascript" src="../js/funkcije.js"></script>
</body>
</html>
