$(document).ready(function() {
    var url = $("#url").val();
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
            { "className": "text-right", "targets": [0] },
            { "className": "text-center", "targets": "_all" }
        ],
        ajax: {
            'dataType': 'json',
            'method': 'POST',
            'url': 'vencimiento/datatable_list',
            'dataSrc': function(response) {
                var output = [];
                var permission = $("#permission").val();
                $.each(response.data, function(index, item) {
                    var col1, col2, col3, col4, col5, col6, col7 = '';
                    col1 = item.id;
                    col2 = item.fullname;
                    col3 = item.asistencia;
                    col4 = parseFloat(item.total).toFixed(2);
                    col5 = item.fecha;
                    col6 = (item.vencida == 1) ? '<span class="badge text-danger-light badge-danger ml-1 badge-text anibadge">Vencida</span>' : '-';
                    col7  = '<a href="#"  data-id="' + item.id + '" class="bt-views btn btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Registrar Pago"><i class="fa fa-check-circle"></i></a>';
                
                    output.push([col1, col2, col3, col4, col5, col6, col7]);
                });
                return output;
            },
            error: function(error) {
                console.debug(error);
            }
        }
    });


    $(document).on('click', ".bt-views", function() {
        var id = $(this).data('id');
        var data_ajax = {
            'dataType': 'json',
            'method': 'POST',
            'url': 'vencimiento/set/'+id,
            success: function(response) {
                location. reload(true);
            },
            error: function(error) {
                alert('Ocurrio un problema al guardar la información');
                console.debug("===> ERROR: %o", error);
            }
        };
        $.ajax(data_ajax);
    });

});