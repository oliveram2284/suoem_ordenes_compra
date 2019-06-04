
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
                                <h2>Asistencia Financiera</h2>
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
                        <li class="breadcrumb-item active">Asistencia Financiera</li>
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
                <a id="sfilter_btn" class="bt-views btn btn-icon-o btn-primary radius100 btn-icon-sm mr-2 mb-2" title="Filtrar">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </div>
        <br>
        <div class="bg-white table-responsivess rounded shadow-sm pt-3 pb-3">
       
            <table id="data-table" class="datatable table table-striped table-sm table-bordered table-responsives" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th  class="text-center">ID</th>
                    <th  class="text-center">Adherente</th>
                    <?php 
                        $totales = array();
                        foreach ($data['dates'] as $key => $col) {
                            echo '<th  class="text-center">'.$col['columna'].'</th>';
                            $totales[$col['columna']] = 0;
                        }
                    ?>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data['moves'] as $move) {
                            echo '<tr>';
                            echo '<td class="">'.$move['id'].'</td>';
                            echo '<td class="fcol">'.$move['lastname'].' '.$move['firstname'].' '.$move['adherent_nro'].'</td>';
                            foreach ($data['dates'] as $k=> $col) {
                                if($col['columna'] == $move['columna']){
                                    echo '<td  class="text-center"> $ '.number_format($move['monto'], 2, ',', '.').'</td>';
                                    $totales[$col['columna']] += $move['monto'];
                                }
                                else 
                                    echo '<td  class="text-center"></td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="table-success">
                        <td class="text-center footcol">ID</td>
                        <td class="text-right footcol"><strong>Totales:</strong></td>
                        <?php 
                        foreach ($totales as $col) {
                            echo '<th  class="text-center"> $ '.number_format($col, 2, ',', '.').'</th>';
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">                