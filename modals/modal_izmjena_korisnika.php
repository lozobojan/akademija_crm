<div class="modal fade" id="modal_izmjena_korisnika">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detalji korisnika sistema</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <label for="ime_input_novi">Ime:</label>
            <input type="text" class="form-control" name="ime" id="ime_input" value="">
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="prezime_input_novi">Prezime:</label>
            <input type="text" class="form-control" name="prezime" id="prezime_input" value="">
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="username_input_novi">Korisničko ime:</label>
            <input type="text" class="form-control" name="prezime" id="username_input" value="">
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="uloga_select_novi">Uloga:</label>
            <select class="form-control" name="uloga" id="uloga_select">
              <option value="">-odaberite ulogu-</option>
              <?php popuni_sifarnik('uloga'); ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="sektor_select_novi">Sektor:</label>
            <select class="form-control" name="uloga" id="sektor_select">
              <option value="">-odaberite sektor-</option>
              <?php popuni_sifarnik('sektor'); ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="spec_select_novi">Specijalizacije:</label>
            <select multiple class="form-control" name="uloga" id="spec_select">
              <?php popuni_sifarnik('specijalizacija'); ?>
            </select>
          </div>
        </div>
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
        <button type="button" class="btn btn-primary" onclick="izmijeniKorisnika()" >Potvrdi</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->