<div class="modal fade" id="modal_izmjena_statusa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Izmjena statusa zahtjeva</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <label for="naziv_input">Naziv:</label>
            <input type="text" class="form-control" name="naziv" id="naziv_input" value="">
          </div>
        </div>

        <div class="row mt-3 mb-3">
          <div class="col-12">
            <input type="checkbox" name="obavjestenje" id="obavjestenje_chk">
            <label for="obavjestenje_chk">Obavještenje</label>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="obavjestenje_tekst_txt">Tekst obavještenja:</label>
            <textarea rows="3" name="obavjestenje_tekst" id="obavjestenje_tekst_txt" class="textarea form-control" ></textarea>
          </div>
        </div>
          
        </select>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
        <button type="button" class="btn btn-primary" onclick="izmijeniStatus()" >Potvrdi</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->