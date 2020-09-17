
function submitFrm(frm_id){
  $('#'+frm_id).submit();
}

function inicijalizuj_tabelu(){
	$('#zahtjevi_tabela').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });}

function modalDodijeli(zahtjev_id){

    $.ajax({
      url: '../backend/modul2/obrada_zahtjeva/popuni_operatere.php',
      type: 'GET',
      data: {
        zahtjev_id: zahtjev_id
      },
      success: function(response){
        var operateri = JSON.parse(response);
        var operateri_opt = "";
        for(var i = 0; i < operateri.length; i++){
          var op = operateri[i].ime;
          var id = operateri[i].id;
          var cnt = operateri[i].cnt;
          var cnt_poruka = " ("+cnt+" zahtjeva) ";
          if(cnt == -1){
            cnt_poruka = "";
          }
          operateri_opt += "<option value=\""+id+"\" >"+op+cnt_poruka+"</option>";
        }
        $("#zahtjev_id_hidden").val(zahtjev_id);
        $("#operater_select").html(operateri_opt);
      }
    });

    $("#modal-dodijeli").modal('show');
  }

function poruka_uspjesno(tekst = 'Zahtjev dodijeljen operateru!'){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'success',
      title: tekst
    });
  }

function dodijeliZahtjev(){
    var operater_id = $("#operater_select").val();
    var zahtjev_id = $("#zahtjev_id_hidden").val();

    $.ajax({
      url: '../backend/modul2/obrada_zahtjeva/dodijeli_zahtjev.php',
      type: 'POST',
      data: {
        zahtjev_id: zahtjev_id,
        operater_id: operater_id,
      },
      success: function(response){
        $("#modal-dodijeli").modal('hide');
        // $("#red_"+zahtjev_id).remove();
        popuni_tabelu();
        poruka_uspjesno();
      }
    });
  }
