$(document).ready(function() {
    var url = $("#url").val();
    var site_url = $("#site_url").val();
    $("#observation-error").hide();
    $('#data-table').DataTable({
        pageLength: 50,
        responsive: true,
        'processing': true,
        'serverSide': true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {
            "lengthMenu": "Ver _MENU_ filas por página",
            "zeroRecords": "No hay registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrando de un total de _MAX_ registros)",
            "sSearch": "Buscar:  ",
            "oPaginate": {
                "sNext": "Sig.",
                "sPrevious": "Ant."
            }
        },
        "pagingType": "full_numbers",
        "columnDefs": [
            { "className": "text-left fcol", "targets": [1] },
           /* { "className": "text-right", "targets": [7] },*/
           
           { "className": "text-left", "targets": [8] },
            { "className": "text-center", "targets": "_all" },
        ],
        ajax: {
            'dataType': 'json',
            'method': 'POST',
            'url': url + 'orden/datatable_list_comercio',
            'dataSrc': function(response) {
                console.log(response);
                console.log(response.data);
                var output = [];
                var permission = $("#permission").val();
                $.each(response.data, function(index, item) {
                    var col1, col2, col4, col5, col6, col7, col8, col9, col10 = '';
                    col1 = item.nro;
                    col2 = item.afiliado_nombre;
                    
                    col4 = parseFloat(item.monto).toFixed(2);
                    col5 = item.cuotas;
                    col6 = parseFloat(item.monto_total_cuota).toFixed(2);
                    col7 = item.fecha_liquidacion;
                    col8 = item.fecha;
                    //col6 = item.date_cancelation;
                    col9 = (item.estado == 1) ? 'Activo' : 'Cancelado';
                    //col9 = item.status;
                    //col10='Proximamente...';
                    
                    col10 += '<a href="#" class="bt-views btn btn-icon-o btn-info radius100 btn-icon-sm mr-1 mb-2" title="Abrir" onClick="abrirOrden('+item.nro+')"><i class="fa fa-search"></i></a>';
                    col10 += '<a href="#" class="bt-views btn bt-delete btn-icon-o btn-success radius100 btn-icon-sm mr-1 mb-2" title="Mensajes" onClick="abrirMensajes('+item.id+')"><i class="fa fa-comments"></i></a>';                   
                   
                    if(item.visto==1){
                        col10 += '<a href="#" class="bt-views btn btn-icon-o btn-info radius100 btn-icon-sm mr-1 mb-2" title="Visto el ' + item.fecha_visto + '"><i class="fa fa-check"></i></a>';
                    }
                    
                    output.push([col1, col2, col4, col5, col6, col7, col8, col9, col10]);
                });
                return output;
            },
            error: function(error) {
                console.debug(error);
            }
        }
    });

    /*
    $(document).on('click', ".bt-views", function() {
        var id = $(this).data('id');

        var data_ajax = {
            'dataType': 'json',
            'method': 'GET',
            'url': url + 'asistencia/get/' + id + '/detail',
            success: function(response) {
                console.log(response);
                var data = response.result;
                var output = '<div class="row">';
                output += '<div class="col-3" > Nro Adherente:      <strong>' + data.adherente.nro + '</strong></div>';
                output += ' <div class="col-6" > Nombre y Apellido : <strong>' + data.adherente.firstname + "  " + data.adherente.lastname + '</strong></div>';
                output += ' <div class="col-3" >Legajo :            <strong>' + data.adherente.legajo + '</strong> </div> ';
                output += '</div>';
                output += '<div class="row">';
                output += '<div class="col-3" > Monto             : <strong> $' + parseFloat(data.asistencia.monto).toFixed(2) + '</strong></div>';
                output += '<div class="col-2" > Cuotas            : <strong> ' + parseFloat(data.asistencia.cuotas).toFixed(0) + '</strong></div>';
                output += '<div class="col-3" > Interes           : <strong> ' + parseFloat(data.asistencia.interes).toFixed(3) + ' %</strong></div>';
                output += '<div class="col-4" > Monto A Devolver  : <strong> $' + parseFloat(data.asistencia.monto_total).toFixed(2) + '</strong></div>';
                output += '</div>';
                output += '<div class="row">';
                output += '<div class="col-3" > Fecha de Solicitud: <strong> ' + data.asistencia.date_added + '</strong></div>';
                output += '</div>';
                //output += ' Cuotas Abondas    : <strong> ' + response.result.cuotas_pagas + ' de ' + response.result.cuotas + '</strong><br >';
                output += ' ';

                $("#adherente_detail").html(output);
                output = '';
                $.each(data.cuotas, function(index, item) {
                    output += '<tr class="text-center">';
                    output += '<td>' + item.id + '</td>';
                    output += '<td>' + parseFloat(item.monto).toFixed(2) + '</td>';
                    output += '<td>' + parseFloat(item.compensacion).toFixed(2) + '</td>';
                    output += '<td>' + parseFloat(item.total).toFixed(2) + '</td>';
                    output += '<td>' + item.date_added + '</td>';
                    output += '</tr>';
                });

                $("#cuotas_table tbody").html(output);
                $("#viewPayment").show();
                return false;

            },
            error: function(error) {
                console.debug("===> ERROR: %o", error);
            }
        };
        console.debug("===> data_ajax: %o", data_ajax);
        $.ajax(data_ajax);
    });

    $(document).on('click', '#viewPayment .btn-secondary', function() {
        $("#viewPayment").hide();
    });

    $(document).on('click', ".bt-delete", function() {
        var id = $(this).data('id');
        swal({
            title: 'Para eliminar una Order debe ingresar el Motivo',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Borrar',
            showLoaderOnConfirm: true,
            preConfirm: (log) => {
                console.log("====> text: %o",log);
                //$.post( url + 'asistencia/delete/' + id,{log:log});
                
              return fetch(url + 'orden/delete/' + id+'/'+log)
                .then(response => {
                  if (!response.ok) {
                   
                    throw new Error(response.statusText)
                  }
                  return response.json()
                })
                .catch(error => {
                    console.log("AERRE: %o",error);
                  swal.showValidationMessage(
                    `Request failed: ${error}`
                  )
                })
            },
            allowOutsideClick: () => !swal.isLoading()
          }).then((result) => {
            console.log("====> result: %o",result);
            if (result.value) {
              swal({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url
              })
            }
          });
          $('#data-table').DataTable().ajax.reload();
     
    });
    */
    /*
    $(document).on('click', '.bt-payfeed', function() {
        var id = $(this).data('id');

        var data_ajax = {
            'dataType': 'json',
            'method': 'GET',
            'url': url + 'asistencia/get/' + id,
            success: function(response) {
                console.log(response);
                $('#aporte_id').val(id);
                $('#adherent_nro').val(response.result.adherent_nro);
                $('#adherent_name').val(response.result.fullname);
                $('#cuota_nro').val(response.result.cuota_sig);
                $('#monto').val(parseFloat(response.result.monto).toFixed(2));
                $('#monto_abonado').val(parseFloat(response.result.monto_abonado).toFixed(2));
                $('#monto_restante').val(parseFloat(response.result.monto_abonado).toFixed(2) - parseFloat(response.result.monto).toFixed(2));

                $("#feedPayment").show();
            },
            error: function(error) {
                console.debug("===> ERROR: %o", error);
            }
        };
        console.debug("===> data_ajax: %o", data_ajax);
        $.ajax(data_ajax);


    });

    $(document).on('click', '#feedPayment .btn-primary', function() {

        console.log($('#monto_paga').val().length);

        if ($('#monto_paga').val().length == 0) {
            $("#observation-error").show();
            return false;
        }
        $("#feedPayment form").submit();
    });

    $(document).on('click', '#feedPayment .btn-secondary', function() {
        $("#observation-error").hide();
        $("#feedPayment form input").val(null);
        $("#feedPayment").hide();
    });*/

});

function abrirOrden(nro_){
  //WaitingOpen('Cargando Proveedor');
  $.ajax({
          method: 'POST',
          data: { nro : nro_ },
            url: '../comercio/getOrden',
            success: function(result){
                        //WaitingClose();
                        $("#ordenDetailBody").html(result.html);
                        $('#ordenDetail').modal('show');
                  
                    },
            error: function(result){
                    //WaitingClose();
                    alert(result);
                },
          dataType: 'json'
        });
}

var idOrdenSeleccionada;
function abrirMensajes(id_){
    idOrdenSeleccionada = id_;
    $.ajax({
        method: 'POST',
        data: { id : id_, tipo: 2 },
          url: '../comercio/getMensajes',
          success: function(result){
                      //WaitingClose();
                      $("#ordenMensajesBody").html(result.html);
                      $('#ordenMensajes').modal('show');
                
                  },
          error: function(result){
                  //WaitingClose();
                  alert(result);
              },
        dataType: 'json'
      });
}