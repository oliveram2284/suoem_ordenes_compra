
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-Monitor-Analytics nav-thumbnail"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Totales de Comercios</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 d-flex justify-content-end h-md-down">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb no-padding bg-trans mb-30">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Ordenes de Compra</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="form-row ml-2">
                <div class="form-group col-md-4">
                    Desde: <input  class="form-control" style="padding-left: 10px; padding-right: 15px;" type="date" id="datepicker_from" value="<?php echo $desde;?>" />
                    
                </div>
                <div class="form-group col-md-4">
                    Hasta: <input  class="form-control" style="padding-left: 10px; padding-right: 15px;" type="date" id="datepicker_to" value="<?php echo $hasta;?>" />
                   
                </div>
                <div class="form-group col-md-4">
                    <a id="sfilter_btn" class="bt-views btn btn-icon-o btn-primary radius100 btn-icon-sm mt-30 mr-2 mb-2" title="Filtrar">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </div>
            
        </div>
        <br>
        <div class="bg-white table-responsivess rounded shadow-sm pt-3 pb-3">
       
            <table id="data-table" class="datatable table table-striped table-sm table-bordered table-responsives" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th  class="text-center">Comercio</th>
                    <th  class="text-center">Cantidad de Ordenes</th>
                    <th  class="text-center">Monto Total</th>
                    
                </tr>
                </thead>
                <tbody>
                    <?php

                        
                        foreach ($data['moves'] as $item):
                    ?>
                        <tr>
                            <td class="text-left"><?php echo $item['razon_social']?></td>
                            <td class="text-right"><?php echo $item['total_ordenes']?></td>
                            <td class="text-right pr-10">$ <?php echo number_format($item['total_importe'],'2',',','.')?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">                