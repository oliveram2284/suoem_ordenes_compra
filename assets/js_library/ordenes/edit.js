$(function() {

    var constante = 1;
    //console.log("=====>   APORTES ADD JS LOAD <=====");
    //console.debug("=====>   constante : %o", constante);
    var site_url = $("#site_url").val();
    //console.debug("====> site_url: %o", site_url);
    /*
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
    $("#adherent_name").select2({
        ajax: {
            language: "es",
            //url: 'https://api.github.com/search/repositories',
            //'url': site_url + 'adherent/search_by_name/',
            url: function(params) {
                return site_url + 'adherent/search/name/' + params.term;
            },
            dataType: 'json',
            select: function(data) {
                    console.log(dada);
                }
        }
    });
    $('#adherent_name').on('select2:select', function(e) {
        var data = e.params.data;
        console.log(data);
        $("#adherent_nro").val(data.id);
    });
    */

    $(document).on('keyup', "#cuotas", function() {
        if ($(this).val().lenght == 0) {
            $("#monto_total").val(0);
            $("#monto_total_cuota").val(0);
            return false;
        }
        console.debug("===> #cuotas: %o", $(this).val());
        var cuotas = $(this).val();

        var monto = parseFloat($("#monto").val());
        console.debug("===> #monto: %o", monto);

        var interes = $("#interes").val().replace(/,/g, '.');
        console.debug("===> #interes: %o", interes);
        interes = parseFloat(interes);
        console.debug("===> #interes: %o", interes);


        var porcentual = constante + (interes * cuotas);
        console.debug("===> #porcentual: %o", porcentual);

        var total = monto * porcentual;
        console.debug("===> #total: %o", total);

        var monto_cuota = total / cuotas;
        console.debug("===> #monto_cuota: %o", monto_cuota);

        $("#monto_total").val(total.toFixed(2));
        $("#monto_total_cuota").val(monto_cuota.toFixed(2));
    });


});