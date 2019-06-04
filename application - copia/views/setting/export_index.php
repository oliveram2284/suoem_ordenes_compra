
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-Download"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Exportar / Copia de seguridad </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 d-flex justify-content-end h-md-down">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb no-padding bg-trans mb-30">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'/'?>"><i class="icon-Home mr-2 fs14"></i></a></li>
                        <li class="breadcrumb-item">Inicio</li>
                        <li class="breadcrumb-item active">Exportar Datos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <a href="<?php echo base_url('setting/add');?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2 invisible">
                <i class="icon-Add-User"></i>Agregar
            </a>
        <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
               
            <?php endif;?>
            <h4 class=" pl-5">Exportar / Copia de seguridad </h4>
            <p class=" pl-5">Usted puede crear una copia de Seguridad de la Base de Dato.
            <br> Todos Los datos ingresados en el sistema serar descargados en un archivos</p>

            <a href="<?php echo base_url('setting/backup');?>" class=" bt-add btn btn-dark  ml-5 mb-2 pl-10"> Exportar </a>
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">



                