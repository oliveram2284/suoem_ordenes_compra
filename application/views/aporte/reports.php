<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-Money-Bag"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Aportes Iniciales</h2>
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
        <!--
        <a href="<?php echo base_url('aporte/add');?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2">
            <i class="icon-Add-User"></i>Agregar
        </a> -->
        <a href="<?php echo base_url('aporte/grafico');?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2">
            <i class="icon-upload"></i>Grafico
        </a> 
        <div class="bg-white table-responsive rounded shadow-sm pt-30 ">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            
            <?php endif;?>
            <table id="data-table" class="datatable table table-striped table-sm table-bordered table-responsive" cellspacing="0" width="100%">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>Nro</th>
                        <th>Adherente</th>
                        <?php foreach($table['months'] as $key=>$item): ?>                    
                            <th><?php echo $item['fecha']?></th>                   
                        <?php endforeach;?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($table['aportes'] as $key=>$item): ?>   
                        <tr>                 
                            <td class="text-left  fcol"> <?php echo $item['adherent_nro']?> </td>
                            <td class="text-left  fcol"> <?php echo $item['fullname']?> </td>
                            <?php foreach($table['months'] as $skey=>$sitem): ?>                
                                <?php 
                                $monto_text='';
                                if($item['cuotas']!=null){
                                    foreach($item['cuotas'] as $crow){                                                                        
                                        
                                        if($sitem['fecha'] == $crow['fecha']){
                                            $monto_text=$crow['monto'];
                                            break;
                                        }    
                                    };   
                                }
                                ?>
                                <td class="text-center" data-monto="<?php echo $monto_text?>" ><?php echo ($monto_text!='')? " $ ".round($monto_text, 2)."":''; ?></td>          
                            <?php endforeach;?>                           
                        </tr>                

                    <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr class="table-success">
                                <td>ID</td>
                        <td class="text-right footcol">Totales</td>
                        <?php foreach($table['totales'] as $key=>$total):?>
                            <td><strong><?php echo "$ ".floatval($total);?></strong></td>
                        <?php endforeach;?>
                    </tr>
                </tfoot>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">

                