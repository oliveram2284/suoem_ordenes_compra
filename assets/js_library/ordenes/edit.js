$(function() {

    var constante = 1;
    //console.log("=====>   APORTES ADD JS LOAD <=====");
    //console.debug("=====>   constante : %o", constante);
    var site_url = $("#site_url").val();
    console.log("====> site_url: %o", site_url);

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
                console.log("====> DATAss: %o",dada);
            },
            initSelection: function(element, callback) {
                onsole.debug("====> initSelection element: %o", element);
                onsole.debug("====> initSelection callback: %o", callback);
                // the input tag has a value attribute preloaded that points to a preselected repository's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the repository name is shown preselected
                var id = $(element).val();
                if (id !== "") {
                    $.ajax("https://api.github.com/repositories/" + id, {
                        dataType: "json"
                    }).done(function(data) { callback(data); });
                }
            },/*,                
            processResults: function(data) {
                console.debug("====> AJAX RESPONSE: %o", data);
                return {
                    results: data
                };
            }*/

        }
    });
    $('#comercio_id').on('select2:select', function(e) {
        var data = e.params.data;
        console.log("====> DATA: %o",data);
        $("#comercio_nombre").val(data.id);
        $("#comercio_codigo").val(data.codigo);
    });

    /*$(".select2").val(4).trigger('change',function(re){
        console.log("ejec:%",re);
    });*/

    if($("#comercio_id_temp").val().length!=0){
        console.log("====?> comercio_id_temp: %o",$("#comercio_id_temp").val());
        $('#comercio_id').select2().val("4").trigger("change");        
       // console.log("====?> comercio_id_temp: %o",$("#comercio_id_temp").val());
    }


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
    $("#comercio_id").select2().val(2).trigger('change');//$("#comercio_id_temp").val());
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
        console.debug("===> data_ajax: %o", data_ajax);da
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

        var interes =0;// $("#interes").val().replace(/,/g, '.');
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