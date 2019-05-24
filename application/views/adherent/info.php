
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-User"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2><?php echo $data['adherente']['lastname'].', '.$data['adherente']['firstname'];?></h2>
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url('/adherent')?>">Adhrentes</a></li>
                        <li class="breadcrumb-item active">Información </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <div class="col-sm-2 ml-auto">
            <button class="btn btn-primary btn-block" id="btnPrint" onclick="imprimir()">Imprimir</button>
            <br>
        </div>

        <div class="portlet-box portlet-gutter ui-buttons-col mb-30">
            <div id="accordion" class="card-accordions">
                <div class="card mb-2">
                    <div class="card-header" id="headingOne">
                            <a class="collapse-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Adherente
                            </a>
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
                                
                                <label for="nro" class="col-sm-2 col-form-label">Nombre:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['lastname'].', '.$data['adherente']['firstname'];?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Legajo:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['legajo'];?></strong>
                                
                                <label for="nro" class="col-sm-2 col-form-label">Teléfono:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['phone'];?></strong>
                            </div>
                            <div class="form-group row">
                                <label for="nro" class="col-sm-2 col-form-label">Municipio:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['name'];?></strong>
                                
                                <label for="nro" class="col-sm-2 col-form-label">Fecha:</label>
                                <strong class="col-sm-2 col-form-strong"><?php echo $data['adherente']['added'];?></strong>

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
                            <a class="collapse-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Aportes
                            </a>
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
                                            echo '<td class="text-right">'.'$ '.number_format($item['monto_abonado'], 2, ',', '.').'</td>';
                                            echo '<td class="text-right">'.$item['cuotas_pagas'].'</td>';
                                            echo '<td class="text-center">'.$item['added'].'</td>';
                                            echo '<td class="text-center">'.$item['cancelation'].'</td>';
                                            echo '<td class="text-center">'.($item['status'] == 1 ? 'Activo' : 'Deshabilitado').'</td>';
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
                                                        echo '<td class="text-right">'.'$ '.number_format($cuota['monto'], 2, ',', '.').'</td>';
                                                        echo '<td class="text-center">'.$cuota['added'].'</td>';
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
                            <a class="collapse-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Asistencias
                            </a>
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
                                            echo '<td class="text-right">'.'$ '.number_format($item['monto'], 2, ',', '.').'</td>';
                                            echo '<td class="text-right">'.'$ '.number_format($item['interes'], 2, ',', '.').'</td>';
                                            echo '<td class="text-right">'.'$ '.number_format($item['monto_total'], 2, ',', '.').'</td>';
                                            echo '<td class="text-right">'.$item['cuotas'].'</td>';
                                            echo '<td class="text-right">'.'$ '.number_format($item['monto_total_cuota'], 2, ',', '.').'</td>';
                                            echo '<td class="text-center">'.$item['added'].'</td>';
                                            echo '<td class="text-center">'.($item['status'] == 1 ? 'Activo' : 'Deshabilitado').'</td>';
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
                                                        echo '<td class="text-right">'.'$ '.number_format($cuota['total'], 2, ',', '.').'</td>';
                                                        echo '<td class="text-center">'.$cuota['added'].'</td>';
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
<?php //var_dump($data);?>

<input type="hidden" value="<?php echo base_url();?>" id="url">                

<!-- Modal -->
<div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel__"><span id="modalAction__"> </span> Comprobante</h4>
      </div>
      <div class="modal-body" id="modalBodyPrint">
        <div>
          <iframe style="width: 100%; height: 500px;" id="printDoc" src=""></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
function imprimir(){
    setTimeout("$('#modalPrint').modal('show')",800);
    $.ajax({
            type: 'POST',
            data: {
                    id : $('#adherenteId').val()
                  },
        url: '<?php echo base_url();?>Adherent/imprimirinfo',
        success: function(result){
                      var url = "<?php echo base_url();?>assets/reports/" + result;
                      $('#printDoc').attr('src', url);
                      setTimeout("$('#modalPrint').modal('show')",800);
              },
        error: function(result){
            alert('error!');
            //ProcesarError(result.responseText, 'modalPrint');
            },
            dataType: 'json'
        });
        
  };
</script>