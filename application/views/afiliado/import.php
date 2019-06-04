
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
                                <h2>Adherentes</h2>
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
                        <li class="breadcrumb-item active">Adherentes</li>
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
                    <h3>Importar Adherentes</h3> 
                    <span class="portlet-subtitle">Seleccione un archivo xls o xlsx</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                
                <?php endif;?>
                

                <?php echo form_open_multipart($action,array('method'=>'post')); ?>
                    
                    <div class="form-group row">
                        <label for="nro" class="col-sm-2 col-form-label">Archivo XLS o XLSX</label>
                        <div class="col-sm-6">
                            <input type="file" name="import_file" id="import_file">
                            
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <div class="col-sm-2 ">
                            <a href="<?php echo base_url('adherent');?>" class="btn btn-dark mr-1 mb-2">Volver</a>
                        </div>
                        <div class="col-sm-2 ml-auto">
                            <button type="submit" class="btn btn-primary btn-block">Importar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



