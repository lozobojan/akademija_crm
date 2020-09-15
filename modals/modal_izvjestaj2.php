<div class="modal fade" id="modal-izvjestaj2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Izvještaj o potkategorijama</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="GET" action="../backend/modul4/izvjestaj2.php" id="frm_izv2">
          <div class="row">
            <div class="col-6">
              <label for="operater_select">Sortiraj po:</label>
              <select class="form-control" name="polje_sort">
                <option value="1">Problem</option>
                <option value="2">Podrška</option>
                <option value="3">Ukupno</option>
              </select>
            </div>
            <div class="col-6">
              <label for="operater_select">Tip sortiranja:</label>
              <select class="form-control" name="tip_sort">
                <option value="1">Rastuće</option>
                <option value="2">Opadajuće</option>
              </select>
            </div>
          </div>
          
        </form>
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
        <button type="button" class="btn btn-primary" onclick="submitFrm('frm_izv2')">Generiši</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->