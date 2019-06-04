
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-Money-2"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Inversiones en Plazo Fijo</h2>
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
                        <li class="breadcrumb-item active">Aportes Inciales</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
       
        
        <div class="bg-white table-responsive rounded shadow-sm pt-3 ">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            
            <?php endif;?>
            <a href="<?php echo base_url('Investment/add');?>" class="bt-add btn btn-dark float-lg-right mr-1 mb-2">
                <i class="icon-Add-File"></i>Agregar
            </a>
            <h3 class="ml-3 pt-20 pb-10" >Inversiones</h3>
            <table id="data-table_invess" class="table mb-0 table-striped table-bordered table-sm cell-border compact stripe" cellspacing="0" width="100%">
                <thead>
                <tr class="text-center">
                   
                    <th>EMISIÓN/RENOVACIÓN</th>
                    <th>FECHA VENC</th>
                    <th>IMPORTATE</th>
                    <th>INTERES</th>
                    <th>TASA</th>
                    <th>IMPUESTO</th>
                    <th>TOTAL A COBRAR</th>
                    <th>FECHA IMPUTACIÓN</th>
                    <th>ACCIÓN</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($investment as $key=>$inv):?>
                        <?php if($inv['import']==0):?>
                        <tr class="table-danger">
                            <td colspan="9" class="text-white-50"><b>Junio sin plazo fijo por carencia de Importe</b></td>
                            <td style="display: none;"></td> 
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                        </tr>

                        <?php else:?>   
                            <tr  >
                               
                                <td class="text-center"><?php echo date('d-m-Y',strtotime($inv['fecha_emision']))?></td>
                                <td class="text-center"><?php echo date('d-m-Y',strtotime($inv['fecha_vencimiento']))?></td>
                                <td class="text-right pr-15">$ <?php echo number_format($inv['import'],2,",",".") ?></td>
                                <td class="text-right pr-15">$ <?php echo number_format($inv['interes'],2,",",".")?></td>
                                <td class="text-right pr-15">$ <?php echo number_format($inv['tasa'],2,",",".")?></td>
                                <td class="text-right pr-15">$ <?php echo number_format($inv['impuesto'],2,",",".")?></td>
                                <td class="text-right pr-15">$ <?php echo number_format($inv['cobrar'],2,",",".")?></td>
                                <td class="text-center"><?php echo ($inv['fecha_imputacion'])?date('d-m-Y',strtotime($inv['fecha_imputacion'])):'-'?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url('investment/edit/'.$inv['id']);?>"  data-id="" class="bt-edit btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?php echo base_url('investment/delete/'.$inv['id']);?>" data-id="" class="bt-delete btn-icon-o btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Eliminar">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                </tbody>
            </table>

    
        </div>
        
        <div class="bg-white table-responsive rounded shadow-sm pt-3 mt-60 ">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            
            <?php endif;?>
            <a href="<?php echo base_url('Investment/add_earnings');?>" class="bt-add btn btn-dark float-lg-right mr-1 mb-2">
                <i class="icon-Add-File"></i>Agregar
            </a>
            <h3 class="ml-3 pt-20 pb-10" >Ganancias</h3>
            <table id="data-table2" class="table mb-0 table-striped table-bordered table-sm cell-border compact stripe" cellspacing="0" width="80%">
                <thead>
                <tr class="text-center">
                   
                    <th>#</th>
                    <th>FECHA </th>                    
                    <th>IMPORTE</th>
                    <th>ACCIÓN</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($earnings as $key=>$inv):?>
                        <?php if($inv['import']==0):?>
                        <tr class="table-danger">
                        <td colspan="9" class="text-white-50"><b>Junio sin plazo fijo por carencia de Importe</b></td>
                        </tr>

                        <?php else:?>   
                            <tr >
                            <td class="text-center"><?php echo $key+1?></td>

                                <td class="text-center"><?php echo date('d-m-Y',strtotime($inv['date_imputation']))?></td>
                                <td class="text-right pr-15">$ <?php echo number_format($inv['import'],2,",",".") ?></td>                                
                                <td class="text-center">
                                    <a href="<?php echo base_url('investment/edit_earnings/'.$inv['id']);?>"  data-id="" class="bt-edit btn-icon-o btn-success radius100 btn-icon-sm mr-2 mb-2" title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?php echo base_url('investment/delete_earnings/'.$inv['id']);?>" data-id="" class="bt-delete btn-icon-o btn-danger radius100 btn-icon-sm mr-2 mb-2" title="Eliminar">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                </tbody>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">







                