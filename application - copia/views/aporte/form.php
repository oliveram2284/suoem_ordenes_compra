
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
                                <h2>Alta Aporte Inicial</h2>
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
                        <li class="breadcrumb-item active">Aportes</li>
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
                    <h3>Alta de Aporte Inicial</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
            

                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    <div class="form-group row">
                        <label for="adherent_nro" class="col-sm-2 col-form-label">Adherente</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control"  id="adherent_nro" name="nro" value="" placeholder="Nro" readonly>
                        </div>
                        <div class="col-sm-5">
                            <!--
                            <input type="text" class="form-control"  id="adherent_name" name="adherent_name" value="" placeholder="Nombre y Apellido de Adherente">
                                -->
                            <select class="form-control"  id="adherent_name" name="adherent_name"></select>
                        </div>
                        <div class="col-sm-4">
                            <label id="-error" class="error" for="nro"><?php echo form_error('nro'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monto" class="col-sm-2 col-form-label">Monto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto" name="monto" value="<?php echo set_value('monto'); ?>" placeholder="Monto">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto-error" class="error" for="monto"><?php echo form_error('monto'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cuotas" class="col-sm-2 col-form-label">Cuotas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cuotas" name="cuotas" value="<?php echo set_value('cuotas'); ?>" placeholder="Nro de Cuotas">
                        </div>
                        <div class="col-sm-4">
                            <label id="cuotas-error" class="error" for="cuotas"><?php echo form_error('cuotas'); ?></label>
                        </div>
                    </div>                                   

                    <div class="form-group row">
                        <label for="observation" class="col-sm-2 col-form-label">Observación</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="observation" name="observation" cols="30" rows="5" placeholder="Observación"><?php echo set_value('observation'); ?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label id="observation-error" class="error" for="observation"><?php echo form_error('observation'); ?></label>
                        </div>
                    </div>
           
                    <div class="form-group row">
                        <div class="col-sm-2 ">
                            <a href="<?php echo base_url('aporte')?>" class="btn btn-info ">Volver</a>
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



