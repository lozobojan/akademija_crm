<div class="modal fade" id="modal-status">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Promjena statusa zahtjeva</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <label for="status_select">Odaberite novi status</label>
        <select class="form-control" name="operater" id="status_select">
        <!-- hidden polje za zahtjev_id -->
        <input type="hidden" name="zahtjev_id" id="zahtjev_id_hidden_status">
          
        </select>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
        <button type="button" class="btn btn-primary" onclick="promijeniStatus()" >Potvrdi</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->