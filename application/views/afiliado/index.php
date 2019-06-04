
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-Affiliate"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Afiliados</h2>
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
                        <li class="breadcrumb-item active">Afiliados</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <a href="<?php echo base_url('afiliado/add');?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2">
            <i class="icon-Add-User"></i>Agregar
        </a>
        <!--
        <a href="<?php echo base_url('afiliado/import');?>" class="bt-add btn btn-info float-lg-right mr-1 mb-2">
            <i class="icon-upload"></i>Importar
        </a>
        -->
        <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            
            <?php endif;?>
            <table id="data-table" class="table mb-0 table-striped cell-border compact stripe table-sm mb-0" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th  class="text-center" >#</th>
                    <th  class="text-center">Afiliado</th>
                    <th  class="text-center">Legajo</th>
                    <th  class="text-center">Municipio</th>
                    <th  class="text-center">Fecha Alta</th>
                    <!--<th  class="text-center">Fecha Activacíon</th>-->
                    <th  class="text-center">Estado</th>
                    <th class="text-center">-</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">


<div id="viewPayment" class="modal fade show" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Renovación de Aporte Inicial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
      </div>
      <div class="modal-body">
            <?php echo form_open('aportes/renew',array('method'=>'post')); ?>
                <div id="message_error" class="alert alert-danger" role="alert">
                   
                </div>
                <input type="hidden" id="aporte_id" name="aporte_id">
                <div class="form-group row">
                    <label for="adherent_nro" class="col-sm-4 col-form-label">Adherente</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control text-center"  id="adherent_nro" name="adherent_nro"  placeholder="Nro" readonly>
                    </div>
                    <div class="col-sm-6">                        
                        <input type="text" class="form-control"  id="adherent_name" readonly  placeholder="Nombre y Apellido de Adherente">
                    </div>
                </div>

                <div class="form-group row">
                        <label for="nro_cuotas" class="col-sm-4 col-form-label">Nro Cuotas</label>
                    <div class="col-sm-8">
                        <select name="nro_cuotas" id="nro_cuotas" class="form-control">
                            <option value="">Seleccione un Nro de Cuotas</option>
                            <?php for($i=1;$i<=10;$i++):?>                                
                                <option value="<?php echo (int)$i*6?>"  <?php echo ($i==1)?'selected':''?>   ><?php echo (int)$i*6 ?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="monto_cuota" class="col-sm-4 col-form-label">Monto Minimo Por Cuota</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="monto_cuota" name="monto_cuota" value="1000" placeholder="Monto Cuota">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="adherent_date_cancelation" class="col-sm-4 col-form-label">Fecha de Vencimiento</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="adherent_date_cancelation" name="adherent_date_cancelation" value="" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                        <label for="date_renew" class="col-sm-4 col-form-label">Fecha de Renovación </label>
                        <div class="col-sm-8">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="date_renew" name="date_renew" value="<?php echo set_value('date_added'); ?>" placeholder="Fecha de Solicitud ">
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>



                