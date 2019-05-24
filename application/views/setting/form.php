
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
                                <h2>Configuración</h2>
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
                        <li class="breadcrumb-item active">Configuración</li>
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
                    <h3>Formulario de Configuración</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
             <?php echo validation_errors(); ?>

                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    <div class="form-group row">
                        <label for="nro" class="col-sm-2 col-form-label">Número</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nro" name="nro" value="<?php echo set_value('nro',$setting['nro']); ?>" placeholder="Número">
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">Código</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="code" name="code" value="<?php echo set_value('code',$setting['code']); ?>" placeholder="Código">

                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="key" class="col-sm-2 col-form-label">Clave</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="key" name="key" value="<?php echo set_value('key',$setting['key']); ?>" placeholder="Clave">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="value" class="col-sm-2 col-form-label">Valor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="value" name="value" value="<?php echo set_value('value',$setting['value']); ?>" placeholder="Valor">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="serialized" class="col-sm-2 col-form-label">Serializa</label>
                        <div class="col-sm-6">
                            <input type="checkbox" name="serialized" id="serialized" value="1" <?php echo $setting['serialized'] == 1 ? "checked": ""; ?>
                        </div>
                        <!--
                        <div class="col-sm-4">
                            <label id="date_activation-error" class="error" for="date_activation"><?php echo form_error('date_activation'); ?></label>
                        </div> -->
                    </div>  

                    <div class="form-group row">
                        <div class="col-sm-10 ml-auto">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



