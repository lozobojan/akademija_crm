<div class="modal fade" id="modal-izvjestaj1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Izvještaj o učinku operatera</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="GET" action="../backend/modul4/izvjestaj1.php" id="frm_izv1">
          <label for="operater_select">Odaberite operatera</label>
          <select class="form-control" name="operater" id="operater_select">
          
            <option value=""> - svi operateri - </option>
            <?php 
              $res = mysqli_query($dbconn, "SELECT * FROM korisnik WHERE uloga_id = 2");
              while($row = mysqli_fetch_assoc($res)){
                $id_temp = $row['id'];
                $naziv_temp = $row['ime']." ".$row['prezime'];
                echo "<option value=\"$id_temp\">$naziv_temp</option>";
              }
            ?>
            
          </select>
        </form>
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
        <button type="button" class="btn btn-primary" onclick="submitFrm('frm_izv1')">Generiši</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->