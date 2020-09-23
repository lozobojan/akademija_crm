<div class="modal fade" id="modal-provjera-statusa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Status zahtjeva</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      

      <div class="modal-body" id="modal-provjera-statusa-body">

        <div class="alert alert-danger text-center d-none" id="div_poruka_greska" ></div>

        <div class="row d-none red-podaci">
          <div class="col-5">
            <label>Pretplatnički broj:</label>
          </div>
          <div class="col-7">
            <span id="pretplatnicki_broj_span" ></span>
          </div>
        </div>

        <div class="row d-none red-podaci">
          <div class="col-5">
            <label>Kategorija:</label>
          </div>
          <div class="col-7">
            <span id="kategorija_span" ></span>
          </div>
        </div>

        <div class="row d-none red-podaci">
          <div class="col-5">
            <label>Potkategorija:</label>
          </div>
          <div class="col-7">
            <span id="potkategorija_span" ></span>
          </div>
        </div>

        <div class="row d-none red-podaci">
          <div class="col-5">
            <label>Status zahtjeva:</label>
          </div>
          <div class="col-7">
            <span id="status_span" ></span>
          </div>
        </div>

        <div class="row d-none red-podaci">
          <div class="col-5">
            <label>Operater:</label>
          </div>
          <div class="col-7">
            <span id="operater_span" ></span>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Zatvori</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->