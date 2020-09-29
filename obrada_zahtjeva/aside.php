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
        <a href="#" class="d-block"><?=$korisnik['ime']." ".$korisnik['prezime']?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php $active_link == 'obrada_zahtjeva' ? $active1 = 'active' :  $active1 = ''; ?>
        <?php $active_link == 'obrada_zahtjeva' ? $menu_open = 'menu-open' :  $menu_open = ''; ?>
        <li class="nav-item has-treeview <?=$menu_open?> ">
          <a href="#" class="nav-link <?=$active1?> ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Obrada zahtjeva
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <?php $active_sublink == 'zahtjevi_za_dodjelu' ? $active2 = 'active' :  $active2 = ''; ?>
              <a href="./index.php" class="nav-link <?=$active2?> "> <!-- active -->
                <i class="far fa-circle nav-icon"></i>
                <p>Zahtjevi za dodjelu</p>
              </a>
            </li>
            <li class="nav-item">
              <?php $active_sublink == 'dodijeljeni_zahtjevi' ? $active2 = 'active' :  $active2 = ''; ?>
              <a href="./dodijeljeni.php" class="nav-link <?=$active2?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Dodijeljeni zahtjevi</p>
              </a>
            </li>
          </ul>
        </li>
        
        <?php

          $mdl1 = pristupModulu('izvjestaj_o_ucinku_operatera', $_SESSION['prijava']['korisnik_id']);
          $mdl2 = pristupModulu('izvjestaj_o_potkategorijama', $_SESSION['prijava']['korisnik_id']);
          $dugme_izvjestaji_klasa = "";
          if(!$mdl1 && !$mdl2)
            $dugme_izvjestaji_klasa = "d-none";
        ?>

        <li class="nav-item has-treeview <?=$dugme_izvjestaji_klasa?> ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Izvještaji
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php  

              if(pristupModulu('izvjestaj_o_ucinku_operatera', $_SESSION['prijava']['korisnik_id'])){
                echo '
                <li class="nav-item">
                  <a href="#" data-toggle="modal" data-target="#modal-izvjestaj1" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Učinak operatera</p>
                  </a>
                </li>
                ';
              }

              if(pristupModulu('izvjestaj_o_potkategorijama', $_SESSION['prijava']['korisnik_id'])){
                echo '
                <li class="nav-item">
                  <a href="#" data-toggle="modal" data-target="#modal-izvjestaj2" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Potkategorije</p>
                  </a>
                </li>
                ';
              }
            ?>
          </ul>
        </li>

        <?php $active_link == 'administracija' ? $active1 = 'active' :  $active1 = ''; ?>
        <?php $active_link == 'administracija' ? $menu_open = 'menu-open' :  $menu_open = ''; ?>
        <li class="nav-item has-treeview <?=$menu_open?> ">
          <a href="#" class="nav-link <?=$active1?>">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Administracija
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <?php $active_sublink == 'administracija_statusa' ? $active2 = 'active' :  $active2 = ''; ?>
          <ul class="nav nav-treeview">
            <?php  

              if(pristupModulu('administracija_statusa', $_SESSION['prijava']['korisnik_id'])){
                echo '
                <li class="nav-item ">
                  <a href="../admin/status.php" class="nav-link '.$active2.' ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Statusi zahtjeva</p>
                  </a>
                </li>
                ';
              }
              $active_sublink == 'administracija_korisnika' ? $active2 = 'active' :  $active2 = '';
              if(pristupModulu('administracija_korisnika', $_SESSION['prijava']['korisnik_id'])){
                echo '
                <li class="nav-item ">
                  <a href="../admin/korisnik.php" class="nav-link '.$active2.' ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Korisnici sistema</p>
                  </a>
                </li>
                ';
              }

            ?>
          </ul>
        </li>

        <?php 
          $active_link == 'kontrola_pristupa' ? $active3 = 'active' :  $active3 = ''; 
          if(pristupModulu('kontrola_pristupa', $_SESSION['prijava']['korisnik_id'])){
            echo '
            <li class="nav-item">
              <a href="../kontrola_pristupa/index.php" class="nav-link '.$active3.'">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Kontrola pristupa
              </p>
              </a>
            </li>';
          }
        ?>

        

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>