
<div class="page-subheader mb-30">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="list">
                    <div class="list-item pl-0">
                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                            <i class="icon-File-HorizontalText"></i>
                        </div>
                        <div class="list-body">
                            <div class="list-title fs-2x">
                                <h2>Ordenes de Compras</h2>
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
                        <li class="breadcrumb-item active">Asistencia Financiera</li>
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
                    <h3>Alta de Ordenes de Compra</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body ">
            

                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    <div class="form-group row bg-gradient-success ">
                        <div class="col-lg-4">
                            <label for="adherent_nro" class="col-form-label">Orden Nº</label>
                            <input type="text" class="form-control"  id="nro" name="nro" value="<?php echo set_value('nro',$data['orden']['nro']); ?>" placeholder="Orden Nº" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-4 align-items-start ">
                            <div class="form-row ">                            
                                <div class="form-group col-md-4">
                                    <label for="monto" class="col-form-label">Importe Total</label>
                                    <input type="text" class="form-control" id="monto" name="monto" value="<?php echo set_value('monto',$data['orden']['monto']); ?>" placeholder="Importe Total">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="monto" class="col-form-label">Cuotas</label>
                                    <input type="text" class="form-control" id="cuotas" name="cuotas" value="<?php echo set_value('cuotas',$data['orden']['cuotas']); ?>" placeholder="Cuotas">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="monto" class="col-form-label">Valor Cuotas</label>
                                    <input type="text" class="form-control" id="monto_total_cuota" name="monto_total_cuota" value="<?php echo set_value('monto_total_cuota',$data['orden']['monto_total_cuota']); ?>" placeholder="Valor Cuotas">
                                </div>
                            </div>
                        </div>
                        <div class="col col-3 ">                            
                            <div class="form-row">
                                <div class="form-group col-md-5 justify-content-center">
                                        <label for="monto" class="col-form-label">Fecha de Liquidación</label>
                                        <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="fecha_liquidacion" name="fecha_liquidacion" data-value="<?php echo $data['orden']['fecha_liquidacion']; ?>" value="<?php echo date('d-m-Y'); ?>" placeholder="Fecha de Liquidacíon">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-8 align-items-start ">
                            <div class="form-row ">
                                <div class="form-group col-md-5">
                                    <label for="monto" class="col-form-label">Nombre Comercio</label>
                                    <input type="hidden" id="comercio_id_temp" value="<?php echo set_value('comercio_id',$data['orden']['comercio_id']); ?>">
                                    <input type="text" class="form-control" id="comercio_nombre" name="comercio_nombre" value="<?php echo $data['comercio']['nombre']; ?>"  placeholder="Nombre Comercio" readonly>
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="monto" class="col-form-label">Cod. Nº</label>

                                    <input type="text" class="form-control text-right" id="comercio_codigo" name="comercio_codigo" value="<?php echo $data['comercio']['codigo']; ?>"  placeholder="Cod. Nº" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-8 align-items-start ">
                            <div class="form-row ">
                                <div class="form-group col-md-5">
                                    <label for="monto" class="col-form-label">Afiliado</label>
                                    
                                    <input type="text" class="form-control" id="afiliado_nombre"  value="<?php echo $data['afiliado']['lastname'].''.$data['afiliado']['firstname']; ?>"  placeholder="Afiliado" readonly>
                                    <!-- 
                                    <select class="form-control"  id="afiliado_id" name="afiliado_id" ></select>
                                    <input type="text" class="form-control" id="afiliado_nombre" name="afiliado_nombre" value=""  placeholder="Afiliado"> -->
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="monto" class="col-form-label">Municipio</label>
                                    <input type="text" class="form-control" id="municipio_nombre" name="municipio_nombre" placeholder="Cod. Nº" value="<?php echo $data['afiliado']['municipio_id']; ?>" readonly>
                                    <input type="hidden" class="form-control" id="municipio_id" name="municipio_id" readonly>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="monto" class="col-form-label">Legajo</label>
                                    <input type="text" class="form-control" id="legajo" name="legajo" value="<?php echo $data['afiliado']['legajo']; ?>"  placeholder="Legajo Nº" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!--
                    <div class="form-group row">
                        <label for="adherent_nro" class="col-sm-2 col-form-label">Adherente</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control"  id="adherent_nro" name="adherent_nro" value="" placeholder="Nro" readonly>
                        </div>
                        <div class="col-sm-5">
                           
                            <select class="form-control"  id="adherent_name" name="adherent_name"></select>
                        </div>
                        <div class="col-sm-4">
                            <label id="-error" class="error" for="nro"><?php echo form_error('adherent_nro'); ?></label>
                        </div>
                    </div> -->
                    <!--
                    <div class="form-group row">
                        <label for="monto" class="col-sm-2 col-form-label">Monto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto" name="monto" value="<?php echo set_value('monto'); ?>" placeholder="Monto">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto-error" class="error" for="monto"><?php echo form_error('monto'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interes" class="col-sm-2 col-form-label">Imp. Compensacion (% Tasa)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="interes" name="interes" value="<?php echo set_value('interes','0,02'); ?>" placeholder="Monto">
                        </div>
                        <div class="col-sm-4">
                            <label id="interes-error" class="error" for="interes"><?php echo form_error('interes'); ?></label>
                        </div>
                    </div>

                   <div class="form-group row">
                        <label for="cuotas" class="col-sm-2 col-form-label">Cantidad de Cuotas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cuotas" name="cuotas" value="<?php echo set_value('cuotas'); ?>" placeholder="Cantidad de Cuotas">
                        </div>
                        <div class="col-sm-4">
                            <label id="cuotas-error" class="error" for="cuotas"><?php echo form_error('cuotas'); ?></label>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="monto_total_cuota" class="col-sm-2 col-form-label">Monto de Cuotas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto_total_cuota" name="monto_total_cuota" value="<?php echo set_value('monto_total_cuota'); ?>" placeholder="Monto de Cuotas">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto_total_cuota-error" class="error" for="cuotas"><?php echo form_error('monto_total_cuota'); ?></label>
                        </div>
                    </div>       

                    <div class="form-group row">
                        <label for="monto_total" class="col-sm-2 col-form-label">Monto Total a Restituir </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto_total" name="monto_total" value="<?php echo set_value('monto_total'); ?>" placeholder="Monto Total a Restituir ">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto_total-error" class="error" for="monto_total"><?php echo form_error('monto_total'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="date_added" class="col-sm-2 col-form-label">Fecha de Solicitud </label>
                        <div class="col-sm-6">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="date_added" name="date_added" value="<?php echo set_value('date_added'); ?>" placeholder="Fecha de Solicitud ">
                        </div>
                        <div class="col-sm-4">
                            <label id="date_added-error" class="error" for="date_added"><?php echo form_error('date_added'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_pago" class="col-sm-2 col-form-label">Fecha Comienzo de Pago </label>
                        <div class="col-sm-6">
                            <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" class="form-control" id="date_pago" name="date_pago" value="<?php echo set_value('date_pago'); ?>" placeholder="Fecha de Comienzo de Pago ">
                        </div>
                        <div class="col-sm-4">
                            <label id="date_pago-error" class="error" for="date_pago"><?php echo form_error('date_pago'); ?></label>
                        </div>
                    </div>

-->                                  

           
                   <div class="row">
                        <div class="col col-8 align-items-start ">
                            <a href="<?php echo base_url('asistencia')?>" class="btn btn-info float-left ">Volver</a>
                        
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="site_url" value="<?php echo base_url('/')?>">



