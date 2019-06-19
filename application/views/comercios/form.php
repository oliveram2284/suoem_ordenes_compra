
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
                                <h2>Comercio</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 d-flex justify-content-end h-md-down">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb no-padding bg-trans mb-30">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>"><i class="icon-Home mr-2 fs14"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Comercios</li>
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
                    <h3>Formulario de Comercio</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
            

                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    <div class="form-group row">
                        <label for="codigo" class="col-sm-2 col-form-label">Código de Comercio</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  id="codigo" name="codigo" value="<?php echo set_value('codigo',$comercio['codigo']); ?>" placeholder="Código de Comercio">
                        </div>
                        <div class="col-sm-4">
                            <label id="-error" class="error" for="codigo"><?php echo form_error('codigo'); ?></label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre',$comercio['nombre']); ?>" placeholder="Nombre">
                        </div>
                        <div class="col-sm-4">
                            <label id="nombre-error" class="error" for="nombre"><?php echo form_error('nombre'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="razon_social" class="col-sm-2 col-form-label">Razón Social</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="razon_social" name="razon_social" value="<?php echo set_value('razon_social',$comercio['razon_social']); ?>" placeholder="Razón Social">
                        </div>
                        <div class="col-sm-4">
                            <label id="razon_social-error" class="error" for="razon_social"><?php echo form_error('razon_social'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cuit" class="col-sm-2 col-form-label">CUIT</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cuit" name="cuit" value="<?php echo set_value('cuit',$comercio['cuit']); ?>" placeholder="cuit">
                        </div>
                        <div class="col-sm-4">
                            <label id="cuit-error" class="error" for="cuit"><?php echo form_error('cuit'); ?></label>
                        </div>
                    </div>
                   
                    
                    <div class="form-group row">
                        <label for="domicilio" class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="domicilio" name="domicilio" value="<?php echo set_value('domicilio',$comercio['domicilio']); ?>" placeholder="Dirección">
                        </div>
                        <div class="col-sm-4">
                            <label id="domicilio-error" class="error" for="domicilio"><?php echo form_error('domicilio'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Teléfono / Celular</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value('telefono',$comercio['telefono']); ?>" placeholder="Nro de Teléfono o Celular">
                        </div>
                        <div class="col-sm-4">
                            <label id="telefono-error" class="error" for="telefono"><?php echo form_error('telefono'); ?></label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="observation" class="col-sm-2 col-form-label">Observación</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="observacion" name="observacion" cols="30" rows="5" placeholder="Observacíon sobre el comercioe"><?php echo set_value('observacion',$comercio['observacion']); ?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label id="observation-error" class="error" for="observacion"><?php echo form_error('observacion'); ?></label>
                        </div>
                    </div>

                         

                    <div class="form-group row">
                        <div class="col-sm-2 ">
                            <button type="submit" class="btn btn-default btn-block">Volver</button>
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



