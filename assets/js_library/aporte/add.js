$(function() {
    console.log("=====>   APORTES ADD JS LOAD <=====");
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
    $("#adherent_name").select2({
        ajax: {
            theme: "classic",
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
                /*
                            processResults: function(data) {
                                console.debug("====> AJAX RESPONSE: %o", data);
                                return {
                                    results: data
                                };
                            },*/

        }
    });
    $('#adherent_name').on('select2:select', function(e) {
        var data = e.params.data;
        console.log(data);
        $("#adherent_nro").val(data.id);
    });

});