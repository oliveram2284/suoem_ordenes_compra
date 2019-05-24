
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
                                <h2>Plazo Fijo</h2>
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
                        <li class="breadcrumb-item active">Plazo Fijo</li>
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
                    <h3> Formulario de Plazo Fijo</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
            

                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    <div class="form-group row">
                        <label for="fecha_emision" class="col-sm-2 col-form-label">Fecha de Emisión </label>
                        <div class="col-sm-6">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="fecha_emision" name="fecha_emision" value="<?php echo set_value('fecha_emision',$invesment_data['fecha_emision']); ?>" placeholder="Fecha Emisión ">
                        </div>
                        <div class="col-sm-4">
                            <label id="fecha_emision-error" class="error" for="fecha_emision"><?php echo form_error('fecha_emision'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha_vencimiento" class="col-sm-2 col-form-label">Fecha de Vencimiento </label>
                        <div class="col-sm-6">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo set_value('fecha_vencimiento',$invesment_data['fecha_vencimiento']); ?>" placeholder="Fecha Vencimiento ">
                        </div>
                        <div class="col-sm-4">
                            <label id="fecha_vencimiento-error" class="error" for="fecha_vencimiento"><?php echo form_error('fecha_vencimiento'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="import" class="col-sm-2 col-form-label">Importe</label>
                        <div class="col-sm-6">
                            <input type="number"  step="0.01" class="form-control" id="import" name="import" value="<?php echo set_value('import',$invesment_data['import']); ?>" placeholder="Importe">
                        </div>
                        <div class="col-sm-4">
                            <label id="import-error" class="error" for="import"><?php echo form_error('import'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interes" class="col-sm-2 col-form-label">Interes</label>
                        <div class="col-sm-6">
                            <input type="number"  step="0.01" class="form-control" id="interes" name="interes" value="<?php echo set_value('interes',$invesment_data['interes']); ?>" placeholder="Interes">
                        </div>
                        <div class="col-sm-4">
                            <label id="interes-error" class="error" for="interes"><?php echo form_error('interes'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tasa" class="col-sm-2 col-form-label">Tasa</label>
                        <div class="col-sm-6">
                            <input type="number"  step="0.01" class="form-control" id="tasa" name="tasa" value="<?php echo set_value('tasa',$invesment_data['tasa']); ?>" placeholder="Tasa">
                        </div>
                        <div class="col-sm-4">
                            <label id="tasa-error" class="error" for="tasa"><?php echo form_error('tasa'); ?></label>
                        </div>
                    </div>

                    

                    <div class="form-group row">
                        <label for="impuesto" class="col-sm-2 col-form-label">Impuesto</label>
                        <div class="col-sm-6">
                            <input type="number"  step="0.01" class="form-control" id="impuesto" name="impuesto" value="<?php echo set_value('impuesto',$invesment_data['impuesto']); ?>" placeholder="Impuesto">
                        </div>
                        <div class="col-sm-4">
                            <label id="impuesto-error" class="error" for="impuesto"><?php echo form_error('impuesto'); ?></label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="cobrar" class="col-sm-2 col-form-label">Total a Cobrar</label>
                        <div class="col-sm-6">
                            <input type="number"  step="0.01" class="form-control" id="cobrar" name="cobrar" value="<?php echo set_value('cobrar',$invesment_data['cobrar']); ?>" placeholder="Total a Cobrar">
                        </div>
                        <div class="col-sm-4">
                            <label id="cobrar-error" class="error" for="cobrar"><?php echo form_error('cobrar'); ?></label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="observation" class="col-sm-2 col-form-label">Observación</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="observation" name="observation" cols="30" rows="5" placeholder="Observación sobre plazo fijo"><?php echo set_value('observation',$invesment_data['observation']); ?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label id="observation-error" class="error" for="observation"><?php echo form_error('observation'); ?></label>
                        </div>
                    </div>
                                                 

           
                    <div class="form-group row">
                        <div class="col-sm-2 ">
                            <a href="<?php echo base_url('investment')?>" class="btn btn-info ">Volver</a>
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



