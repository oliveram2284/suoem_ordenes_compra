$(document).ready(function() {

    console.log("=====>   APORTES ADD JS LOAD <=====");
    var url = $("#url").val();
    console.debug("====> site_url: %o", url);
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
        columnDefs: [
            { "className": "text-left fcol", "targets": [1] },
            { "className": "text-right", "targets": [7] },
            { "className": "text-center", "targets": "_all" },
        ],
        ajax: {
            'dataType': 'json',
            'method': 'POST',
            'url': 'aporte/datatable_list',
            'dataSrc': function(response) {
                console.log(response);
                console.log(response.data);
                var output = [];
                var permission = $("#permission").val();
                $.each(response.data, function(index, item) {
                    var col1, col2, col3, col4, col5, col6, col7, col8, col9 = '';
                    col1 = item.adherent_nro;
                    col2 = item.fullname;
                    col3 = " $ " + parseFloat(item.monto_abonado).toFixed(2);
                    col4 = item.cuotas_pagas + " de " + item.cuotas;
                    col5 = item.added;
                    col6 = item.canceled;
                    col7 = (item.status == 1) ? 'Activo' : 'Cancelado';
                    if (item.status == 3) {
                        col7 = '<span class="p-1 bg-danger text-center">Eliminado</span>';
                    }
                    //col7 = item.status;
                    col8 = '<a href="#"  data-id="' + item.id + '" class="bt-view btn btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Ver Historial"><i class="fa fa-eye"></i></a>';
                    if (item.cuotas_pagas < item.cuotas && item.status != 3) {
                        col8 += '<a href="#"  data-id="' + item.id + '" class="bt-payfeed btn btn-icon-o btn-teal radius100 btn-icon-sm mr-2 mb-2" title="Pagar Cuota"><i class="fa fa-credit-card"></i></a>';
                    }

                    col9 = item.status;
                    //col8 += '<a href="#" data-id="' + item.id + '" class="bt-delete btn-icon-o btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Eliminar"><i class="fa fa-times"></i></a>';

                    output.push([col1, col2, col3, col4, col5, col6, col7, col8, col9]);
                });
                return output;
            },
            error: function(error) {
                console.debug(error);
            }
        },
        createdRow: function(row, data, dataIndex) {
            console.debug("===> row: %o", row);
            console.debug("===> data: %o", data[8]);
            console.debug("===> dataIndex: %o", dataIndex);
            if (data[8] !== undefined && data[8] == 3) {
                $(row).addClass('table-danger');
            }
            // Set the data-status attribute, and add a class

        },
    });


    $(document).on('click', ".bt-view", function() {
        var id = $(this).data('id');
        //console.log("HOASD");

        var data_ajax = {
            'dataType': 'json',
            'method': 'GET',
            'url': url + 'aporte/get/' + id + '/detail',
            success: function(response) {
                console.log(response);
                var output = '<p>';
                output += ' Nro Adherente:      <strong>' + response.result.adherent_nro + '</strong><br>';
                output += ' Nombre y Apellido : <strong>' + response.result.fullname + '</strong><br >';
                output += ' Legajo :            <strong>' + response.result.legajo + '</strong><br >';
                output += ' Fecha de Adhesión : <strong>' + response.result.date_added + '</strong><br >';
                output += ' Monto             : <strong> $' + parseFloat(response.result.monto).toFixed(2) + '</strong><br >';
                output += ' Monto Cancelado   : <strong> $' + parseFloat(response.result.monto_abonado).toFixed(2) + '</strong><br >';
                output += ' Cuotas Abondas    : <strong> ' + response.result.cuotas_pagas + ' de ' + response.result.cuotas + '</strong><br >';
                output += ' </p>';

                $("#adherente_detail").html(output);
                output = '';
                $.each(response.result.aporte_cuotas, function(index, item) {
                    output += '<tr class="text-center">';
                    output += '<td>' + item.id + '</td>';
                    output += '<td>' + parseFloat(item.monto).toFixed(2) + '</td>';
                    output += '<td>' + item.fecha + '</td>';
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
        var url = $("#url").val();
        var full_url = url + "adherent/delete/" + id;
        window.location.href = full_url;
    });

    $(document).on('click', '.bt-payfeed', function() {
        var id = $(this).data('id');

        var data_ajax = {
            'dataType': 'json',
            'method': 'GET',
            'url': url + 'aporte/get/' + id,
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
    });

});