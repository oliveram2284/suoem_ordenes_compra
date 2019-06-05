<div class="page-content">
    <div class="container-fluid">

        <div class="portlet-box portlet-gutter ui-buttons-col mb-30">
            <div id="accordion" class="card-accordions">
                <div class="card mb-2">
                    <div class="card-header" id="headingOne">
                            <h3>
                            Adherente
                            </h3>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                        <div class="card-body text-muted">
                            <!-- Info Adherente -->
                            <input type="hidden" id="adherenteId" value="<?php echo $data['adherente']['id'];?>">
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Nro Adherente:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['nro'];?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">DNI:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['dni'];?></strong>
                            </div>
                            <div> 
                                <label for="nro" class="col-sm-offset-2 col-form-label">Nombre:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['lastname'].', '.$data['adherente']['firstname'];?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Legajo:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['legajo'];?></strong>
                            </div>
                            <div>
                                <label for="nro" class="col-sm-2 col-form-label">Teléfono:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['phone'];?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Municipio:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['name'];?></strong>
                            </div>
                            <div>
                                <label for="nro" class="col-sm-2 col-form-label">Fecha:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['added'];?></strong>
                            </div>
                            <div>
                                <label for="nro" class="col-sm-2 col-form-label">Activación:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['activation'];?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Estado:</label>
                                <strong class="col-sm-2 col-form-strong">
                                    <?php 
                                        switch($data['adherente']['name']){
                                            case 0: 
                                                echo 'Nuevo';
                                                break;
                                            case 1: 
                                                echo 'Aporte Completo';
                                                break;
                                            case 2: 
                                                echo 'Renovación';
                                                break;
                                        }
                                    ?></strong>
                                
                                <label for="nro" class="col-sm-2 col-form-label">Renovación:
                                <strong class="col-form-strong"><?php echo $data['adherente']['renovacion'] == 0 ? 'No':'Si';?></strong></label>

                                <label for="nro" class="col-sm-2 col-form-label">Cuotas:
                                <strong class="col-form-strong"><?php echo $data['adherente']['nro_cuotas'];?></strong></label>

                                <label for="nro" class="col-sm-2 col-form-label">Monto:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo  '$ '.number_format($data['adherente']['monto_cuota'], 2, ',', '.');?></strong>
                            </div>
                            <div>
                                <label for="nro" class="col-sm-2 col-form-label">Renovación:
                                <strong class="col-form-strong"><?php echo $data['adherente']['renovacion'] == 0 ? 'No':'Si';?></strong></label>
                            </div>
                            <div>
                                <label for="nro" class="col-sm-2 col-form-label">Cuotas:
                                <strong class="col-form-strong"><?php echo $data['adherente']['nro_cuotas'];?></strong></label>
                            </div>
                            <div>
                                <label for="nro" class="col-sm-2 col-form-label">Monto:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo  '$ '.number_format($data['adherente']['monto_cuota'], 2, ',', '.');?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Observación:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['observation'];?></strong>
                            </div>
                            <!-- End info Adherente -->
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="headingTwo">
                            <h4>Aportes</h4>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body text-muted">
                            <!-- Aportes -->
                            <table id="data-table" class="table mb-0 table-striped cell-border compact stripe table-sm mb-0" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th  class="text-center">Monto Abonado</th>
                                    <th  class="text-center">Coutas Pagas</th>
                                    <th  class="text-center">Fecha Inicio</th>
                                    <th  class="text-center">Fecha Cancelacíon</th>
                                    <th  class="text-center">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($data['aportes'] as $item) {
                                            echo '<tr>';
                                            echo '<td style="text-align: right">'.'$ '.number_format($item['monto_abonado'], 2, ',', '.').'</td>';
                                            echo '<td style="text-align: right">'.$item['cuotas_pagas'].'</td>';
                                            echo '<td style="text-align: center">'.$item['added'].'</td>';
                                            echo '<td style="text-align: center">'.$item['cancelation'].'</td>';
                                            echo '<td style="text-align: center">'.($item['status'] == 1 ? 'Activo' : 'Deshabilitado').'</td>';
                                            echo '</tr>';
                                            echo '<tr>';
                                            echo '<td></td>';
                                            echo '<td colspan="3">';
                                            echo '<table id="cuotas_table" class="table table-bordered  table-sm mb-0" >
                                                    <thead class="thead-dark">
                                                        <tr class="text-center">
                                                            <th>Importe</th>
                                                            <th>Vencimiento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                    foreach ($item['cuotas'] as $cuota) {
                                                        echo '<tr>';
                                                        echo '<td style="text-align: right">'.'$ '.number_format($cuota['monto'], 2, ',', '.').'</td>';
                                                        echo '<td style="text-align: center">'.$cuota['added'].'</td>';
                                                        echo '</tr>';
                                                    }
                                            echo   '</tbody>
                                                </table>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!------------->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                            <h4>
                            Asistencias
                            </h4>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body text-muted">
                            <!-- Asistencias -->
                            <table id="data-table" class="table mb-0 table-striped cell-border compact stripe table-sm mb-0" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th  class="text-center">Monto</th>
                                    <th  class="text-center">Tasa %</th>
                                    <th  class="text-center">Monto Total</th>
                                    <th  class="text-center">Cant. Cuotas</th>
                                    <th  class="text-center">Monto Cuotas</th>
                                    <th  class="text-center">Fecha</th>
                                    <th  class="text-center">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($data['asistencias']))
                                        foreach ($data['asistencias'] as $item) {
                                            echo '<tr>';
                                            echo '<td style="text-align: right">'.'$ '.number_format($item['monto'], 2, ',', '.').'</td>';
                                            echo '<td style="text-align: right">'.'$ '.number_format($item['interes'], 2, ',', '.').'</td>';
                                            echo '<td style="text-align: right">'.'$ '.number_format($item['monto_total'], 2, ',', '.').'</td>';
                                            echo '<td style="text-align: right">'.$item['cuotas'].'</td>';
                                            echo '<td style="text-align: right">'.'$ '.number_format($item['monto_total_cuota'], 2, ',', '.').'</td>';
                                            echo '<td style="text-align: center">'.$item['added'].'</td>';
                                            echo '<td style="text-align: center">'.($item['status'] == 1 ? 'Activo' : 'Deshabilitado').'</td>';
                                            echo '</tr>';
                                            echo '<tr>';
                                            echo '<td></td>';
                                            echo '<td colspan="3">';
                                            echo '<table id="cuotas_table" class="table table-bordered  table-sm mb-0" >
                                                    <thead class="thead-dark">
                                                        <tr class="text-center">
                                                            <th>Importe</th>
                                                            <th>Vencimiento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                    foreach ($item['cuotasd'] as $cuota) {
                                                        echo '<tr>';
                                                        echo '<td style="text-align: right">'.'$ '.number_format($cuota['total'], 2, ',', '.').'</td>';
                                                        echo '<td style="text-align: center">'.$cuota['added'].'</td>';
                                                        echo '</tr>';
                                                    }
                                            echo   '</tbody>
                                                </table>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!----------------->
                        </div>
                    </div>
                </div>
            </div>
        <!--------->
        </div>
    </div>
</div>