
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-Monitor-Analytics nav-thumbnail"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Ingreso por Compensación</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 d-flex justify-content-end h-md-down">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb no-padding bg-trans mb-30">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Ingreso por Compensación</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                Desde: <input style="padding-left: 10px; padding-right: 15px;" type="date" id="datepicker_from" value="<?php echo $desde;?>" />
                Hasta: <input style="padding-left: 10px; padding-right: 15px;" type="date" id="datepicker_to" value="<?php echo $hasta;?>" />
                <a id="filter_btn" class="bt-views btn btn-icon-o btn-primary radius100 btn-icon-sm mr-2 mb-2" title="Filtrar">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </div>
        <br>

        <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3">
       

            <table id="data-table" class="table mb-0 table-striped table-bordered cell-border compact stripe table-sm mb-0 dataTable dtr-inline" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="text-center ">ID</th>
                    <th class="text-center fcol">Adherente</th>
                    <?php 
                        $totales = array();
                        foreach ($data['dates'] as $col) {
                            echo '<th  class="text-center">'.$col['columna'].'</th>';
                            $totales[$col['columna']] = 0;
                        }
                    ?>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $movimientos = array();
                        foreach ($data['moves'] as $move) {
                            $movimientos[$move['asistencia_id']]['asistencias'][$move['asistencia_id']][$move['columna']] = $move['monto'];
                            $movimientos[$move['asistencia_id']]['name'] = $move['lastname'].' '.$move['firstname'];
                        }

                        foreach ($movimientos as $move) {
                            foreach ($move['asistencias'] as $asistencia => $value) {
                                echo '<tr>';
                                echo '<td class="">'.$asistencia.'</td>';
                                echo '<td class="fcol">'.$move['name'].'(a: '.$asistencia.')</td>';
                                foreach ($data['dates'] as $col) {
                                    $suma = 0;
                                    foreach ($value as $date => $val) {
                                        if($col['columna'] == $date){
                                            $suma = $val;
                                        }
                                    }
                                    if($suma > 0)
                                        echo '<td  class="text-center"> $ '.number_format($suma, 2, ',', '.').'</td>';
                                    else
                                        echo '<td></td>';
                                    $totales[$col['columna']] += $suma;
                                }
                                
                                echo '</tr>';
                            }
                        }

                    ?>
                </tbody>
                <tfoot>
                <tr class="table-success">
                        <td class="text-center ">ID</td>
                        <td class="text-right footcol"><strong>Totales:</strong></td>
                        <?php 
                        foreach ($totales as $col) {
                            //echo '<td  class="text-center"> $ '.number_format($col, 2, ',', '.').' </td>';
                            echo sprintf(" <th  class='text-center'> $ %01.2f </th>", $col);
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>
    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">                