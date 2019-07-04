
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
                                <h2>Editar Asistencia Financiera</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 d-flex justify-content-end h-md-down">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb no-padding bg-trans mb-30">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                        <li class="breadcrumb-item">Inicio</li>
                        <li class="breadcrumb-item active">Asistencia Financiera</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
   

        <div class="portlet-box portlet-gutter ui-buttons-col mb-30">
            <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                <div class="flex d-flex flex-column">
                    <h3>Edición de Asistencia Financiera</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    <input type="hidden" id="asistencia_id" name="asistencia_id" value="<?php echo $asistencie['asistencia']['id'];?>"" >
                    <div class="form-group row">
                        <label for="adherent_nro" class="col-sm-2 col-form-label">Adherente</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control"  id="adherent_nro" name="adherent_nro" value="<?php echo $asistencie['adherente']['id'];?>" placeholder="Nro" readonly>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control"  id="adherent_name" name="adherent_name" value="<?php echo $asistencie['adherente']['lastname'].' '.$asistencie['adherente']['firstname'];?>" placeholder="Nombre y Apellido de Adherente" readonly>
                            <!--<select class="form-control"  id="adherent_name" name="adherent_name"></select>-->
                        </div>
                        <div class="col-sm-4">
                            <label id="-error" class="error" for="nro"><?php echo form_error('adherent_nro'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monto" class="col-sm-2 col-form-label">Monto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $asistencie['asistencia']['monto'];?>" placeholder="Monto">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto-error" class="error" for="monto"><?php echo form_error('monto'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interes" class="col-sm-2 col-form-label">Imp. Compensacion (% Tasa)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="interes" name="interes" value="<?php echo $asistencie['asistencia']['interes'];?>" placeholder="Monto">
                        </div>
                        <div class="col-sm-4">
                            <label id="interes-error" class="error" for="interes"><?php echo form_error('interes'); ?></label>
                        </div>
                    </div>

                   <div class="form-group row">
                        <label for="cuotas" class="col-sm-2 col-form-label">Cantidad de Cuotas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cuotas" name="cuotas" value="<?php echo $asistencie['asistencia']['cuotas'];?>" placeholder="Cantidad de Cuotas">
                        </div>
                        <div class="col-sm-4">
                            <label id="cuotas-error" class="error" for="cuotas"><?php echo form_error('cuotas'); ?></label>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="monto_total_cuota" class="col-sm-2 col-form-label">Monto de Cuotas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto_total_cuota" name="monto_total_cuota" value="<?php echo $asistencie['asistencia']['monto_total_cuota'];?>" placeholder="Monto de Cuotas">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto_total_cuota-error" class="error" for="cuotas"><?php echo form_error('monto_total_cuota'); ?></label>
                        </div>
                    </div>       

                    <div class="form-group row">
                        <label for="monto_total" class="col-sm-2 col-form-label">Monto Total a Restituir </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto_total" name="monto_total" value="<?php echo $asistencie['asistencia']['monto_total'];?>" placeholder="Monto Total a Restituir ">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto_total-error" class="error" for="monto_total"><?php echo form_error('monto_total'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="date_added" class="col-sm-2 col-form-label">Fecha de Solicitud </label>
                        <div class="col-sm-6">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="date_added" name="date_added" value="<?php echo $asistencie['asistencia']['date_added'];?>" placeholder="Fecha de Solicitud ">
                        </div>
                        <div class="col-sm-4">
                            <label id="date_added-error" class="error" for="date_added"><?php echo form_error('date_added'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_pago" class="col-sm-2 col-form-label">Fecha Comienzo de Pago </label>
                        <div class="col-sm-6">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="date_pago" name="date_pago" value="<?php echo $asistencie['cuotas'][0]['date_added'];?>" placeholder="Fecha de Comienzo de Pago ">
                        </div>
                        <div class="col-sm-4">
                            <label id="date_pago-error" class="error" for="date_pago"><?php echo form_error('date_pago'); ?></label>
                        </div>
                    </div>

                                                 

           
                    <div class="form-group row">
                        <div class="col-sm-2 ">
                            <a href="<?php echo base_url('asistencia')?>" class="btn btn-info ">Volver</a>
                        </div>
                        <div class="col-sm-2 ml-auto">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="site_url" value="<?php echo base_url('/')?>">



