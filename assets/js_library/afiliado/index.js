$(document).ready(function() {
    $("#viewPayment").find("#message_error").hide();
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
                "sFirst":'Primera',
                "sLast":'Ultima',
                "sNext": "Sig.",
                "sPrevious": "Ant."
            }
        },
        "pagingType": "full_numbers",
        "columnDefs": [

            { "className": "text-left fcol", "targets": [1] },
            { "className": "text-right", "targets": [6] },
            { "targets": [7], "visible": false },
            { "className": "text-center", "targets": "_all" },
        ],
        ajax: {
            'dataType': 'json',
            'method': 'POST',
            'url': 'afiliado/datatable_list',
            'dataSrc': function(response) {
                //console.log(response);
                //console.log(response.data);
                var output = [];
                var permission = $("#permission").val();
                var url = $("#url").val();
                $.each(response.data, function(index, item) {
                    var col1, col2, col3, col4, col5, col6, col7, col8, col9 = '';
                    col1 = item.id;
                    col2 = item.fullname;
                    col3 = item.legajo;
                    col4 = item.muni_code;
                    col5 = item.added;
                    //col6 = item.actived;

                    if (item.status == 2) {
                        col7 = '<span class="badge text-danger-light badge-danger ml-1 badge-text anibadge">Eliminado</span>';
                        col8 = '';

                    } else {
                        col7 = (item.status == '1') ? '<span class="badge text-sucess-light badge-info ml-1 badge-text anibadge">Activo</span>' : '<span class="badge text-danger-light badge-success ml-1 badge-text anibadge">Habilitado</span>';


                        col8 = '';
                        col8 += '<a href="#"  data-id="' + item.id + '" class="bt-edit btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Editar"><i class="fa fa-edit"></i></a>';
                        col8 += '<a href="#" data-id="' + item.id + '" class="bt-delete btn-icon-o btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Eliminar"><i class="fa fa-times"></i></a>';
                        //col8 += '<a href="#" data-id="' + item.id + '" class="bt-info btn-icon-o btn-warning radius100 btn-icon-sm mr-2 mb-2" title="Informe"><i class="fa fa-address-book"></i></a>';
                        //col8 += '<a href="'+url +'afiliado/imprimirContrato/'+item.id+'" target="_blank" class="btn btn-icon-o btn-info radius100 btn-icon-sm mr-2 mb-2" title="Imprimir Contrato Adhesión" alt="Imprimir Contrato Adhesión"><i class="fa fa-print"></i></a>';
                        
                    }
                    col9 = item.status;
                    //col6 += '<a href="#" data-id="' + item.id + '" class="bt-reset btn-icon-o btn-info radius100 btn-icon-sm mr-2 mb-2" title="Restaurar Contraseña"><i class="fa fa-sync"></i></a>';
                    output.push([col1, col2, col3, col4, col5,  col7, col8, col9]);//col6,
                });
                return output;
            },

            error: function(error) {
                console.debug(error);
            }
        },
        createdRow: function(row, data, dataIndex) {
            console.debug("===> row: %o", row);
            console.debug("===> data: %o", data[7]);
            console.debug("===> dataIndex: %o", dataIndex);
            if (data[7] !== undefined && data[7] == 3) {
                $(row).addClass('table-danger');
            }
            // Set the data-status attribute, and add a class

        },
    });


    $(document).on('click', ".bt-edit", function() {
        var id = $(this).data('id');
        var url = $("#url").val();
        var full_url = url + "afiliado/edit/" + id;
        window.location.href = full_url;
    });
    $(document).on('click', ".bt-delete", function() {
        var id = $(this).data('id');
        var url = $("#url").val();
        var full_url = url + "afiliado/delete/" + id;
        window.location.href = full_url;
    });
    $(document).on('click', ".bt-info", function() {
        var id = $(this).data('id');
        var url = $("#url").val();
        var full_url = url + "afiliado/info/" + id;
        window.location.href = full_url;
    });

    $(document).on('click', ".bt-renew", function() {
        var id = $(this).data('id');
        var url = $("#url").val();



        var data_ajax = {
            'dataType': 'json',
            'method': 'GET',
            'url': url + 'aporte/get/' + id + '/detail',
            success: function(response) {
                console.log(response);
                console.log(response.response);

                $("#adherent_nro").val(response.result.adherent_nro);
                $("#adherent_name").val(response.result.fullname);
                $("#adherent_date_cancelation").val(response.result.fecha_cancelacion);
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

    $(document).on('click', '#viewPayment .btn-primary', function() {
        //$("#viewPayment").modal('hide');
        //validation
        if ($("#viewPayment").find("#nro_cuotas").val() == '') {
            $("#viewPayment").find("#nro_cuotas").focus();
            $("#viewPayment").find("#message_error").html("Debe Seleccionar un Nro de Cuotas").show();
            return false;
        }

        if ($("#viewPayment").find("#monto_cuota").val() == '' && $("#viewPayment").find("#monto_cuota").val() > 0) {
            $("#viewPayment").find("#monto_cuota").focus();
            $("#viewPayment").find("#message_error").html("Debe Ingresar Un Monto Mínimo").show();
            return false;
        }
        if ($("#viewPayment").find("#date_renew").val() == '') {
            $("#viewPayment").find("#date_renew").focus();
            $("#viewPayment").find("#message_error").html("Debe Ingresar Nueva Fecha de Renovación").show();
            return false;
        }

        $("#viewPayment").find("#message_error").html("").hide();

        var data_form = $("#viewPayment").find("form").serialize();
        console.debug("===> data_form:%o", data_form);
        //return false;
        //var id = $(this).data('id');
        var url = $("#url").val();

        var data_ajax = {
            'dataType': 'json',
            'method': 'POST',
            'data': data_form,
            'url': url + '/aporte/renew',
            success: function(response) {
                console.debug("===> response:%o", response);
                if (response.result) {
                    $("#viewPayment form input").val(null);
                    $("#viewPayment").hide();
                    location.reload();

                    return false;
                }
                return false;

            },
            error: function(error) {
                console.debug("===> ERROR: %o", error);
            }
        };
        console.debug("===> data_ajax: %o", data_ajax);
        $.ajax(data_ajax);
        return false;
    });

    $(document).on('click', '#viewPayment .btn-secondary', function() {
        $("#viewPayment form input").val(null);
        location.reload();
        $("#viewPayment").hide();
        //$('#data-table').reload();
    });

});