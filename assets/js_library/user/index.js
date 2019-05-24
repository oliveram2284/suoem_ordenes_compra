$(document).ready(function() {

    $('#data-table').DataTable({
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
        ajax: {
            'dataType': 'json',
            'method': 'POST',
            'url': 'user/datatable_list',
                'dataSrc': function(response) {
                    console.log(response);
                    console.log(response.data);
                    var output = [];
                    var permission = $("#permission").val();
                    $.each(response.data, function(index, item) {
                        var col1, col2, col3, col4, col5, col6 = '';
                        col1 = item.id;
                        col2 = item.username;
                        col3 = item.firstname;
                        col4 = item.lastname;
                        col5 = (item.status == 1) ? 'Habilitado' : 'Deshabilitado';
                        col6 = '<a href="#"  data-id="' + item.id + '" class="bt-edit btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Editar"><i class="fa fa-edit"></i></a>';
                        col6 += '<a href="#" data-id="' + item.id + '" class="bt-delete btn-icon-o btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Eliminar"><i class="fa fa-times"></i></a>';
                        //col6 += '<a href="#" data-id="' + item.id + '" class="bt-reset btn-icon-o btn-info radius100 btn-icon-sm mr-2 mb-2" title="Restaurar Contraseña"><i class="fa fa-sync"></i></a>';
                        output.push([col1, col2, col3, col4, col5, col6]);
                    });
                    return output;
                },
                error: function(error) {
                    console.debug(error);
                }
        }
    });


    $(document).on('click', ".bt-edit", function() {
        var id = $(this).data('id');
        var url = $("#url").val();
        var full_url = url + "user/edit/" + id;
        window.location.href = full_url;
    });
    $(document).on('click', ".bt-delete", function() {
        var id = $(this).data('id');
        var url = $("#url").val();
        var full_url = url + "user/delete/" + id;
        window.location.href = full_url;
    });


    /*$(document).on('submit', 'form', function() {
        console.log("=====> FORM SUBMIT");
        var form_data = $("form").serialize();
        console.log(form_data);
        $.ajax({

        });
        return false;
    });*/

});