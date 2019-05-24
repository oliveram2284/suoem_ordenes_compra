<?php
$date = explode('-', date('Y-m-d'));
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
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Solicitud de Admisión Fastram</title>
    <style type="text/css">
        body {
         background-color: #fff;
         margin: 0px 20px;
         font-family: Lucida Grande, Verdana, Sans-serif;
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
        
        #header .ad_nro{
            height:80px;
            color:#000;
            position:absolute;
            font-size: 18px;
            z-index:9999;
            top:160px;
            right:10px;
        }
        #header .ad_nro span{
            width:70px;
            height:70px;
            padding:10px;
            padding-top:10px ;
            padding-bottom:10px ;
            border:2px solid #000;
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
            height:850px;
            text-align: center; 
            border-bottom:2px solid #000;
        }
        #content .present{
            position: fixed; 
            left: 0px; 
            top:10px;
            width:170px;
            border-bottom: 0px solid #000;
            height:55px;
            padding:0px;
            padding-bottom: 10px;
            text-align:left;
            font-size:12px;
        }

        #content .manifiesto{
            position: fixed; 
            left: 0px; 
            top:80px;
            width:100%;
            border-bottom: 0px solid #000;
            height:150px;
            padding:0px;
            padding-bottom: 20px;
            text-align:left;
            line-height: 30px;
            text-align:justify;
        }

        #content .manifiesto span{
            min-width:50px;

        }

        #content .data{
            position: fixed; 
            left: 0px; 
            top:240px;
            width:100%;
            border-bottom: 0px solid #000;
            height:150px;
            padding:0px;
            padding-bottom: 20px;
            text-align:left;
            line-height: 30px;
            text-align:justify;
        }
        #content .date{
            position: fixed; 
            left: 0px; 
            top:410px;
            width:100%;
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
            top: 430px;
        }
        #content .sign{
            position: fixed; 
            left: 0px; 
            top:420px;
            width:100%;
            border-bottom: 0px solid #000;
            height:150px;
            padding:0px;
            padding-bottom: 20px;
            text-align:left;
            line-height: 30px;
            text-align:justify;
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
            <img src="assets/images/suoem_header1.jpg" alt="">
        </div>     
        <div class="ad_nro">
            Adherente Nº: <span><?php echo $adherent_id?></span>
        </div>   
    </div>
    <div id="content">
        <p class="present">Sr. SECRETARIO GENERAL <br>           
           SUOEM<br>
           PRESENTE
        </p>
        <p class="manifiesto"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span>
        Manifiesto, en carácter de Declaración Jurada, conocer y aceptar el Reglamento del FONDO DE ASISTENCIA SOLIDARIA  DE LOS TRABAJADORES MUNICIPALES "FASTRAM", 
        aprobado por Asamblea el día 09/09/16; por lo que solicito la inclusión al mismo y autorizo a que se me practique el descuento en mis haberes, para constituir
         el Aporte Inicial referido en la Cláusula SEXTA del referido reglamento. A continuación, detallo mis datos personales. A saber. -------------
        </p>
        <p class="data">
        <b>APELLIDO y NOMBRE:</b>__<?php echo $data_line1?> <br>
        <b>DNI:</b>__<?php echo $data_line2_1?><b>SITUACIÓN LABORAL:</b> __<?php echo $data_line2_2?><b>*N°Leg.:</b> __<?php echo $data_line2_3?><br>
        <b>MUNICIPALIDAD:</b>__<?php echo $data_line3?><br>
        <b>DOMICILIO:</b>__<?php echo $data_line4?><b>TELEFONO:</b>__<?php echo $data_line4_1?><br>
        <b>EMAIL:</b>__<?php echo $data_line5?>
        </p>

        <p class="date">
        SAN JUAN, <?php echo '..'.$date[2].'.. días del ';?> MES de ....<?php echo $mes;?>.... DEL ..<?php echo $date[0];?>..
        </p>

        <table class="tabla">
            
            <tr>
                <td colspan="3" style="text-align: left"><br>
                    <
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
                    Visto la Solicitud de Asistencia Admisión presentada y habiendo verificado el cumplimiento estricto de la 
                    CLÁUSULA PRIMERA del FONDO DE ASISTENCIA SOLIDARIA DE LOS TRABAJADORES MUNICIPALES "FASTraM", 
                    aprobado por Asamblea el día 09/09/16; 
                    se concluye que el afiliado Sr...<b><?php echo $adherente_name?></b>... SI/NO reúne los requisitos pertinentes para acceder a lo peticionado.
                </td> 
            </tr>
            <tr>
                <td colspan="3" style="text-align: left"><br>
                    SAN JUAN, <?php echo '..'.$date[2].'.. días del ';?> MES de ....<?php echo $mes;?>.... DEL ..<?php echo $date[0];?>..
                    <br>
                </td>
            </tr>
            <!--
            <tr>
                <td colspan="3" style="text-align: right;"><br>
                    *tachar lo que no corresponda
                </td>
            </tr> -->
        </table>
    </div>
    <!--footer para cada pagina-->
    
</body>
</html>