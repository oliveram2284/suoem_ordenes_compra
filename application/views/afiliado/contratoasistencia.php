<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Contrato de Asistencia Economica</title>
    <style type="text/css">
        body {
         background-color: #fff;
         margin: 0px 20px;
         font-family: arial;
         font-size: 14px;
         color: #4F5155;
        }

        a {
         color: #003399;
         background-color: transparent;
         font-weight: normal;
        }

        h1 {
         color: #444;
         background-color: transparent;
         border-bottom: 1px solid #D0D0D0;
         font-size: 16px;
         font-weight: bold;
         margin: 24px 0 2px 0;
         padding: 5px 0 6px 0;
        }

        h2 {
         color: #444;
         background-color: transparent;
         border-bottom: 1px solid #D0D0D0;
         font-size: 16px;
         font-weight: bold;
         text-align: center;
        }

        table{
            text-align: center;
        }

        /* estilos para el footer y el numero de pagina */
        @page { margin: 180px 50px; }
        #header { 
            position: fixed; 
            left: 20px; 
            top: -180px; 
            right: 0px;
            text-align: center; 
            
        }
        #header #img_logo{           
            height:auto;
            width :100%;
            height : 80px;
            display : inline-block;
        }
        
        #header #box h4{
            border:1px solid blue;
        }
        
        #header #img_logo img{
            width:800px;
            height:auto;
        }
        #content{
            position: fixed; 
            left: 0px; 
            top: 20px; 
            right: 0px;
            width:100%;
            margin:0px auto;
            text-align: center; 
        }
        #content .present{
            position: fixed; 
            left: 0px; 
            top:10px;
            width:170px;
            border-bottom: 0px solid #000;
            height:150px;
            padding:0px;
            padding-bottom: 10px;
            text-align:left;
            font-size:12px;
        }

        #content .manifiesto{
            position: fixed; 
            left: 0px; 
            top:50px;
            width:100%;
            border-bottom: 0px solid #000;
            height:150px;
            padding:0px;
            padding-bottom: 20px;
            text-align:left;
            line-height: 30px;
            text-align:justify;
            color:#000;
        }

        #content .manifiesto span{
            min-width:50px;

        }
        #content .data{
            position: fixed; 
            left: 0px; 
            top:200px;
            width:100%;
            border-bottom: 0px solid #000;
            height:150px;
            padding:0px;
            padding-bottom: 20px;
            text-align:left;
            line-height: 30px;
            text-align:justify;
        }

        #content .tabla{
            width: 100%;
            position: fixed;
            top: 300px;
        }

        #footer { 
            position: fixed; 
            left: 0px; 
            bottom: -180px; 
            right: 0px; 
            height: 50px; 
            background-color: #333; 
            color: #fff;
        }
        #footer .page:after { 
            content: counter(page, upper-roman); 
        }
    </style>
</head>
<body>
    <!--header para cada pagina-->
    <div id="header">        
        <div  id="img_logo">
            <img src="assets/images/suoem_header_asistencia.jpg" alt="">
        </div>        
    </div>
    <div id="content">
        <p class="present">Sr. SECRETARIO GENERAL <br>           
           SUOEM<br>
           PRESENTE
        </p>
        <p class="manifiesto" ><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span>
            Manifiesto, en carácter de Declaración Jurada, conocer y aceptar el Reglamento del FONDO DE ASISTENCIA SOLIDARIA  
            DE LOS TRABAJADORES MUNICIPALES "FASTraM", 
            aprobado por Asamblea el día 09/09/16;por lo que solicito la Asistencia Económica contemplada en el mismo y autorizo a que se me practique el 
            descuento en mis haberes para la Restitución total de lo solicitado conforme a lo establecido en el Reglamento del FASTraM.
        </p> 
        <p class="manifiesto" ><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span>
            Manifiesto, en carácter de Declaración Jurada, conocer y aceptar el Reglamento del FONDO DE ASISTENCIA SOLIDARIA  
            DE LOS TRABAJADORES MUNICIPALES "FASTraM", 
            aprobado por Asamblea el día 09/09/16;por lo que solicito la Asistencia Económica contemplada en el mismo y autorizo a que se me practique el 
            descuento en mis haberes para la Restitución total de lo solicitado conforme a lo establecido en el Reglamento del FASTraM.
        </p> 
        <p class="data">
        <b>ADHERENTE </b>__<?php echo $data_line1?>___ <b>N° </b>__<?php echo $numero;?>___<br>
        <b>DNI </b>__<?php echo $data_line2_1?>_ <b>Legajo </b>__<?php echo $data_line2_3?>__ <b>Municipalidad </b> __ <?php echo $data_line3?><br>
        <b>ASISTENCIA ECONOMICA</b>
        </p>
        <table class="tabla">
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" ><b>MONTO</b></td>
                <td style="width: 23%; padding: 3px; text-align: right;"><?php echo '$ '.number_format($asistencia['monto'], 2, ',', '.');?></td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" ><b>IMPORTE COMPENSACIONES</b></td>
                <td style="width: 23%; padding: 3px; text-align: right;"><?php echo '$ '.number_format($asistencia['monto_compensacion'], 2, ',', '.');?></td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" ><b>MONTO TOTAL A RESTITUIR</b></td>
                <td style="width: 23%; padding: 3px; text-align: right;"><?php echo '$ '.number_format($asistencia['monto_total'], 2, ',', '.');?></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: left"><br><b>RESTITUCIÓN DE LA ASISTENCIA ECONOMICA</b></td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" ><b>CANTIDAD DE CUOTAS</b></td>
                <td style="width: 23%; padding: 3px; text-align: right;"><?php echo number_format($asistencia['cuotas'], 0, ',', '.');?></td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" ><b>MONTO DE CUOTAS</b></td>
                <td style="width: 23%; padding: 3px; text-align: right;"><?php echo '$ '.number_format($asistencia['monto_total_cuota'], 2, ',', '.');?></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: left"><br>
                    <?php 
                        $date = explode('-', $asistencia['date_added']);
                        switch ($date[1]) {
                            case '01':
                                $mes = 'Enero';
                                break;
                            case '02':
                                $mes = 'Febrero';
                                break;
                            case '03':
                                $mes = 'Marzo';
                                break;
                            case '04':
                                $mes = 'Abril';
                                break;
                            case '05':
                                $mes = 'Mayo';
                                break;
                            case '06':
                                $mes = 'Junio';
                                break;
                            case '07':
                                $mes = 'Julio';
                                break;
                            case '08':
                                $mes = 'Agosto';
                                break;
                            case '09':
                                $mes = 'Septiembre';
                                break;
                            case '10':
                                $mes = 'Octubre';
                                break;
                            case '11':
                                $mes = 'Noviembre';
                                break;
                            case '12':
                                $mes = 'Diciembre';
                                break;

                            
                            default:
                                $mes = 'xx';
                                break;
                        }
                    ?>
                    SAN JUAN, <?php echo '..'.$date[2].'.. días del ';?> MES de ....<?php echo $mes;?>.... DEL ..<?php echo $date[0];?>..
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" >FIRMA DE CONFORMIDAD</td>
                <td style="width: 23%; padding: 3px;">.................................</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" >ACLARACIÓN</td>
                <td style="width: 23%; padding: 3px;">.................................</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" >DNI</td>
                <td style="width: 23%; padding: 3px;">.................................</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 3px;"></td>
                <td style="width: 43%; text-align: left; padding: 3px;" >TELÉFONO</td>
                <td style="width: 23%; padding: 3px;">.................................</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: left"><br><hr></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;"><br><b>INFORME COMISIÓN DIRECTIVA</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:justify; line-height: 25px;"><br>
                    Visto la Solicitud de Asistencia Economica presentada y habiendo verificado el cumplimiento estricto del Reglamento del FONDO DE ASISTENCIA SOLIDARIA DE LOS TRABAJADORES MUNICIPALES "FASTraM", aprobado por Asamblea el día 09/09/16; se concluye que el afiliado Sr...<?php echo $nombre;?>... SI/NO reúne los requisitos pertinentes para acceder a lo peticionado.
                </td> 
            </tr>
            <tr>
                <td colspan="3" style="text-align: left"><br>
                    SAN JUAN, <?php echo '..'.$date[2].'.. días del ';?> MES de ....<?php echo $mes;?>.... DEL ..<?php echo $date[0];?>..
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><br>
                    *tachar lo que no corresponda
                </td>
            </tr>
        </table>

    </div>
   
</body>
</html>