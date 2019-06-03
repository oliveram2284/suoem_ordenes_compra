
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
                                <h2>Usuarios</h2>
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
                        <li class="breadcrumb-item active">Usuarios</li>
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
                    <h3>Permisos por Grupo</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                
                <?php endif;?> 
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Permisos para acceder</label>
                    <div class="col-sm-10">
                        <div class="well well-sm" style="">
                            <?php foreach($permissions as $permission):?>
                                    <div class="checkbox">
                                        <label>
                                            <?php if(in_array($permission,$access)):?>
                                                <input type="checkbox" name="permission[access][]" value="<?php echo $permission?>" checked="checked" />
                                                <?php echo $permission?>
                                            <?php else:?>
                                                <input type="checkbox" name="permission[access][]" value="<?php echo $permission?>" />
                                                <?php echo $permission?>
                                            <?php endif;?>
                                        
                                        </label>
                                    </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">PermEisos para EDITAR</label>
                    <div class="col-sm-10">
                        <div class="well well-sm" style="">
                            <?php foreach($permissions as $permission):?>
                                    <div class="checkbox">
                                        <label>
                                            <?php if(in_array($permission,$modify)):?>
                                                <input type="checkbox" name="permission[modify][]" value="<?php echo $permission?>" checked="checked" />
                                                <?php echo $permission?>
                                            <?php else:?>
                                                <input type="checkbox" name="permission[modify][]" value="<?php echo $permission?>" />
                                                <?php echo $permission?>
                                            <?php endif;?>
                                        
                                        </label>
                                    </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">



                