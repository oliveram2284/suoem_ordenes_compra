$(document).ready(function() {
$('#norden').keyup(function(e){
    if ( event.which == 13 ) {
        buscarOrden();
    }
});

$('#buscar').click(function(){
    buscarOrden();
});

function buscarOrden(){
    $.ajax({
        type: 'POST',
        data: { nro : $('#norden').val() },
    url: '../orden/buscarOrden',
    success: function(result){
                    if(!result){
                        Limpiar();
                    }else{
                        $('#lblOrden').html(result['nro']);
                        $('#lblMonto').html(result['monto']);
                        $('#fsolicitud').html(result['date_added']);
                        $('#fliquidacion').html(result['fecha_liquidacion']);
                        $('#lblAfiliado').html(result['firstname'] + ' ' + result['lastname']);
                        $('#lblLegajo').html(result['legajo']);
                        $('#lblMunicipio').html('( ' + result['code'] + ' ) ' + result['nombre'] );
                        $('#lblComercio').html('( ' + result['codigo'] + ' ) ' + result['razon_social']);
                        $('#lblVisto').html(result['fecha_visto']);
                        $('#lblUsuario').html(result['userfn'] + ' ' + result['userln']);
                    }
            },
    error: function(result){
            Limpiar();
            setTimeout("$('#errorCust').fadeOut('slow');",2000);
        },
        dataType: 'json'
    });
}

function Limpiar(){
    $('#errorCust').fadeIn('slow');
    setTimeout("$('#errorCust').fadeOut('slow');",2000);
    $('#lblOrden').html('--');
    $('#lblMonto').html('--');
    $('#fsolicitud').html('--');
    $('#fliquidacion').html('--');
    $('#lblAfiliado').html('--');
    $('#lblLegajo').html('--');
    $('#lblMunicipio').html('--');
    $('#lblComercio').html('--');
    $('#lblVisto').html('--');
    $('#lblUsuario').html('--');
}
});