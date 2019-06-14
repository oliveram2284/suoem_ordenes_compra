$(function() {

    var constante = 1;
    console.log("=====>   APORTES ADD JS LOAD <=====");
    console.debug("=====>   constante : %o", constante);
    var site_url = $("#site_url").val();
    console.debug("====> site_url: %o", site_url);

    $(document).on('change', '#adherent_nro', function() {
        console.debug("====> adherent_nro: %o", $(this).val());
        var data_ajax = {
            'dataType': 'json',
            'method': 'GET',
            'url': site_url + 'adherent/search/nro/' + $(this).val(),
            success: function(response) {
                console.log(response);
                if (response.adherent !== undefined) {
                    $("#adherent_name").val(response.adherent.firstname + " " + response.adherent.lastname);
                } else {
                    $("#adherent_name").val(null);
                }
            },
            error: function(error) {
                console.debug("===> ERROR: %o", error);
            }
        };
        console.debug("===> data_ajax: %o", data_ajax);
        $.ajax(data_ajax);
    });

    // Single Select
    $("#comercio_id").select2({
        ajax: {
            language: "es",
            //url: 'https://api.github.com/search/repositories',
            //'url': site_url + 'adherent/search_by_name/',
            url: function(params) {
                return site_url + 'comercio/search/name/' + params.term;
            },
            dataType: 'json',
            select: function(data) {
                console.log(dada);
            }
                /*
                            processResults: function(data) {
                                console.debug("====> AJAX RESPONSE: %o", data);
                                return {
                                    results: data
                                };
                            },*/

        }
    });
    $('#comercio_id').on('select2:select', function(e) {
        var data = e.params.data;
        console.log(data);
        $("#comercio_nombre").val(data.id);
        $("#comercio_codigo").val(data.codigo);
    });


    // Single Select
    $("#afiliado_id").select2({
        ajax: {
            language: "es",
            //url: 'https://api.github.com/search/repositories',
            //'url': site_url + 'adherent/search_by_name/',
            url: function(params) {
                return site_url + 'afiliado/search/name/' + params.term;
            },
            dataType: 'json',
            select: function(data) {
                console.log(dada);
            }
            /*
            processResults: function(data) {
                console.debug("====> AJAX RESPONSE: %o", data);
                return {
                    results: data
                };
            },*/

        }
    });
    $('#afiliado_id').on('select2:select', function(e) {
        var data = e.params.data;
        console.log(data);
        $("#municipio_id").val(data.municipio_id);
        $("#municipio_nombre").val(data.municipio);
        $("#legajo").val(data.legajo);
    });

    /*$(document).on('keyup', "#cuotas", function() {


    }
    );*/
    $(document).on('change','#monto',function(){
        if ($(this).val().lenght == 0) {
            $("#monto_total").val(0);
            $("#monto_total_cuota").val(0);
            return false;
        }
        $('#cuotas').val(1);
    });
    $(document).on('keyup', "#cuotas", function() {
        if ($(this).val().lenght == 0) {
            $("#monto_total").val(0);
            $("#monto_total_cuota").val(0);
            return false;
        }

        var cuotas = ($(this).val().lenght!=0)?$(this).val():1;
        console.log("===> #cuotas: %o", $(this).val().lenght);
        console.log("===> #cuotas: %o", cuotas);
        var interes = 0;

        var monto = parseFloat($("#monto").val());
        console.log("===> #monto: %o", monto);

        var interes = 0;//$("#interes").val().replace(/,/g, '.');
        console.log("===> #interes: %o", interes);
        interes = parseFloat(interes);
        console.log("===> #interes: %o", interes);


        var porcentual = constante + (interes * cuotas);
        console.debug("===> #porcentual: %o", porcentual);

        var total = monto * porcentual;
        console.log("===> #total: %o", total);

        var monto_cuota = total / cuotas;
        console.log("===> #monto_cuota: %o", monto_cuota);

        $("#monto_total").val(total.toFixed(2));
        $("#monto_total_cuota").val(monto_cuota.toFixed(2));
    });


});