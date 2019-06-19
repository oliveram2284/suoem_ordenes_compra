<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SUOEM - Validación de Ordenes de Compra</title>    
        <!-- Bootstrap-->
        <link href="<?php  echo base_url();?>assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--Common Plugins CSS -->
        <link href="<?php  echo base_url();?>/assets/css/plugins/plugins.css" rel="stylesheet">
        <!--fonts-->
        <link href="<?php  echo base_url();?>assets/lib/line-icons/line-icons.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/css/style.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="<?php  echo base_url();?>assets/lib/dt-picker/jquery.datetimepicker.min" rel="stylesheet" />
        <link href="<?php  echo base_url();?>assets/lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet" />
        <script src="<?php  echo base_url();?>assets/lib/jquery/dist/jquery.min.js"></script>
       <!-- <link rel="shortcut icon" href="<?php  echo base_url();?>assets/images/suoem_logo_header.png" type="image/x-icon"> -->
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

    </head>
    <body class="pace-done">
    
        <div class="page-wrapper" id="page-wrapper">
            <main class="content">
                <header class="navbar page-header darkHeader bg-dark navbar-expand-lg bg-dark">
                    <ul class="nav flex-row mr-auto">
                        <li class="nav-item">
                        <div class="sidenav whiteNav">
                            <a href="<?php echo base_url('/')?>" class="app-logo d-flex flex flex-row align-items-center overflow-hidden justify-content-center">
                                <img src="<?php  echo base_url();?>assets/images/suoem_compra_logo_sm2.png" class="img-responsive" alt="SUOEM VALIDACION DE ORDENES DE COMPRAS">
                            </a>
                        </div>
                        </li>

                    </ul>

                </header>

                <div class="container">
                    <br>
                    <div class="row" > 
                        <div class="col-sm-2">
                            <label>Número de Orden: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="norden" name="norden" value="" placeholder="Ingrese el número de orden a buscar">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary btn-block" id="buscar">Buscar</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-danger alert-dismissable" id="errorCust" style="display: none">
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                <p>Orden no encontrada!!!</p>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>N° Orden:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblOrden">--</strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Monto:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblMonto">--</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Solicitada:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="fsolicitud">--</strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Liquidación:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="fliquidacion">--</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Afiliado:</p>
                        </div>
                        <div class="col-sm-10">
                            <strong id="lblAfiliado">--</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Legajo:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblLegajo">--</strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Municipio:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblMunicipio">--</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Comercio:</p>
                        </div>
                        <div class="col-sm-10">
                            <strong id="lblComercio">--</strong>
                        </div>
                    </div>
                </div>


<script>
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
                    }else{
                        $('#lblOrden').html(result['nro']);
                        $('#lblMonto').html(result['monto']);
                        $('#fsolicitud').html(result['date_added']);
                        $('#fliquidacion').html(result['fecha_liquidacion']);
                        $('#lblAfiliado').html(result['firstname'] + ' ' + result['lastname']);
                        $('#lblLegajo').html(result['legajo']);
                        $('#lblMunicipio').html('( ' + result['code'] + ' ) ' + result['nombre'] );
                        $('#lblComercio').html('( ' + result['codigo'] + ' ) ' + result['razon_social']);
                    }
            },
    error: function(result){
            $('#errorCust').fadeIn('slow');
            setTimeout("$('#errorCust').fadeOut('slow');",2000);
        },
        dataType: 'json'
    });
}
</script>