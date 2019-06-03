
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
                                <h2>Grupos de Usuarios</h2>
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
    <a href="<?php echo base_url('user/grupos_add');?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2">
                <i class="icon-Add-User"></i>Agregar
            </a>
        <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            
            <?php endif;?>
            <table id="data-tables" class="table mb-0 table-striped" cellspacing="0" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th class="center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($grupos as $key=>$group):?>
                        <tr>
                            <td class="text-center"><?php echo $key+1?></td>
                            <td class="text-center"><?php echo $group['name']?></td>
                            <td class="text-center"><?php echo ($group['status']==1)?'Habilitado':'Deshabilitado'?></td>
                            <td>
                                <a href="<?php echo site_url('user/grupos_edit/'.$group['id']);?>" data-id="<?php echo $group['id']?>" class="bt-renew btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Editar"><i class="fa fa-edit"></i></a>
                                <a href="#" data-id="<?php echo $group['id']?>" class="bt-renew btn-icon-o btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Renovar"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">



                