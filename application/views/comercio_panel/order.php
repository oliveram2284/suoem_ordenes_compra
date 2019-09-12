<!--
    o.id, 
    o.nro, 
    o.monto, 
    DATE_FORMAT(o.date_added, "%d-%m-%Y") as date_added, 
    DATE_FORMAT(o.fecha_liquidacion, "%d-%m-%Y") as fecha_liquidacion, 
    a.firstname, 
    a.lastname, 
    a.legajo, 
    m.nombre, 
    m.code, 
    c.razon_social, 
    c.codigo, 
    DATE_FORMAT(o.fecha_visto, "%d-%m-%Y %H:%i") as fecha_visto, 
    u.firstname as userfn, 
    u.lastname as userln'
    -->
<div class="container">
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>N° Orden:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblOrden"><?php echo $nro;?></strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Monto:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblMonto"><?php echo $monto;?></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Solicitada:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="fsolicitud"><?php echo $date_added;?></strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Liquidación:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="fliquidacion"><?php echo $fecha_liquidacion;?></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Afiliado:</p>
                        </div>
                        <div class="col-sm-10">
                            <strong id="lblAfiliado"><?php echo $firstname.' '.$lastname;?></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Legajo:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblLegajo"><?php echo $legajo;?></strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Municipio:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblMunicipio"><?php echo '('.$code.')'.$nombre;?></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Comercio:</p>
                        </div>
                        <div class="col-sm-10">
                            <strong id="lblComercio"><?php echo $razon_social;?></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Creada por:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblUsuario"><?php echo $userfn.' '.$userln;?></strong>
                        </div>
                        <div class="col-sm-2">
                            <p>Vista el:</p>
                        </div>
                        <div class="col-sm-4">
                            <strong id="lblVisto"><?php echo $fecha_visto;?></strong>
                        </div>
                    </div>
                </div>