
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
                                <h2>Usuarios de Comercio</h2>
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
                        <li class="breadcrumb-item active">Usuarios de Comercio</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <a href="<?php echo base_url('comercio/user_add/'.$comercio_id);?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2 pull-right">
            <i class="icon-Add-User"></i>Agregar
        </a>       
        <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>            
            <?php endif;?>
            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th class="center">-</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $key => $item): ?>
                        <tr>
                            <td><?php echo $item->id?></td>
                            <td><?php echo $item->username?></td>
                            <td><?php echo $item->firstname?></td>
                            <td><?php echo $item->lastname?></td>
                            <td><?php echo ($item->status=='1')?'Habilitado':'Deshabilitado'?></td>
                            <td>
                                <a href="<?php echo site_url('comercio/user_edit/'.$item->id);?>" class="bt-edit btn btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Editar"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo site_url('comercio/user_delete/'.$item->id);?>" class="bt-delete btn btn-icon-o btn-border-o btn-icon-sm btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Eliminar"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">



                