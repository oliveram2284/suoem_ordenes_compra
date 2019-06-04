
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
                                <h2>Afiliados</h2>
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
                        <li class="breadcrumb-item active">Afiliados</li>
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
                    <h3>Solicitud de Alta</h3> 
                    <span class="portlet-subtitle">Complete todos los campos antes de guardar.</span>
                </div>
            </div>
            <div class="portlet-body">
            

                <?php echo form_open($action,array('method'=>'post')); ?>
                    
                    
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label">Apellido</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo set_value('lastname',$afiliado['lastname']); ?>" placeholder="Apellido">
                        </div>
                        <div class="col-sm-4">
                            <label id="lastname-error" class="error" for="lastname"><?php echo form_error('lastname'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo set_value('firstname',$afiliado['firstname']); ?>" placeholder="Nombre">
                        </div>
                        <div class="col-sm-4">
                            <label id="firstname-error" class="error" for="firstname"><?php echo form_error('firstname'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dni" class="col-sm-2 col-form-label">DNI</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo set_value('dni',$afiliado['dni']); ?>" placeholder="DNI">
                        </div>
                        <div class="col-sm-4">
                            <label id="dni-error" class="error" for="dni"><?php echo form_error('dni'); ?></label>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="legajo" class="col-sm-2 col-form-label">Legajo</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="legajo" name="legajo" value="<?php echo set_value('legajo',$afiliado['legajo']); ?>" placeholder="Legajo">
                        </div>
                        <div class="col-sm-4">
                            <label id="legajo-error" class="error" for="legajo"><?php echo form_error('legajo'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="municipality_code" class="col-sm-2 col-form-label">Municipalidad</label>
                        <div class="col-sm-6">
                            <select name="municipio_id" id="municipio_id" class="form-control">
                                <option value="">Municipio</option>
                                <?php foreach($municipios as $item):?>                                    
                                    <option value="<?php echo $item['id']?>"  <?php echo (isset($afiliado['municipio_id']) && $afiliado['municipio_id']==$item['id'] )?'selected':''?> ><?php echo utf8_decode($item['nombre']) ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label id="municipio_id-error" class="error" for="municipio_id"><?php echo form_error('municipio_id'); ?></label>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address',$afiliado['address']); ?>" placeholder="Dirección">
                        </div>
                        <div class="col-sm-4">
                            <label id="address-error" class="error" for="address"><?php echo form_error('address'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Teléfono / Celular</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone',$afiliado['phone']); ?>" placeholder="Nro de Teléfono o Celular">
                        </div>
                        <div class="col-sm-4">
                            <label id="phone-error" class="error" for="phone"><?php echo form_error('phone'); ?></label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email',$afiliado['email']); ?>" placeholder="Dirección de Email">
                        </div>
                        <div class="col-sm-4">
                            <label id="email-error" class="error" for="email"><?php echo form_error('email'); ?></label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="monto_aporte_inicial" class="col-sm-2 col-form-label">Cupo</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cupo" name="cupo" value="<?php echo set_value('cupo',( !empty($afiliado['cupo']))? number_format($afiliado['cupo'], 2, '.', '') :0); ?>" placeholder="Cupo">
                        </div>
                        <div class="col-sm-4">
                            <label id="cupo-error" class="error" for="cupo"><?php echo form_error('cupo'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="observation" class="col-sm-2 col-form-label">Observación</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="observation" name="observation" cols="30" rows="5" placeholder="Observacíon sobre el afiliadoe"><?php echo set_value('observation',$afiliado['observation']); ?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <label id="observation-error" class="error" for="observation"><?php echo form_error('observation'); ?></label>
                        </div>
                    </div>

                    <!--

                    <div class="form-group row">
                        <label for="monto_contado" class="col-sm-2 col-form-label">Adelanto de Contacto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto_contado" name="monto_contado" value="<?php echo set_value('monto_contado',( !empty($afiliado['monto_contado']))? number_format($afiliado['monto_contado'], 2, '.', '') :0); ?>" placeholder="Monto Cuota">
                        </div>
                        <div class="col-sm-4">
                            <label id="monto_contado-error" class="error" for="monto_contado"><?php echo form_error('monto_contado'); ?></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="monto_total_cuotas" class="col-sm-2 col-form-label">Monto Restante en Cuotas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="monto_total_cuotas" name="monto_total_cuotas" value="<?php echo set_value('monto_total_cuotas',( !empty($afiliado['monto_total_cuotas']))? number_format($afiliado['monto_total_cuotas'], 2, '.', '') :0); ?>" placeholder="Monto Restante en Cuotas" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label id="monto_total_cuotas-error" class="error" for="monto_total_cuotas" ><?php echo form_error('monto_total_cuotas'); ?></label>
                        </div>
                    </div>

                    <div id="section_cuotas">
                        <div class="form-group row">
                            <label for="nro_cuotas" class="col-sm-2 col-form-label">Nro Cuotas</label>
                            <div class="col-sm-6">
                                <select name="nro_cuotas" id="nro_cuotas" class="form-control">
                                    <option value="">Seleccione un Nro de Cuotas</option>
                                    <?php for($i=1;$i<=24;$i++):?>                                                                    
                                        <option value="<?php echo $i?>"  <?php echo ( $afiliado['nro_cuotas'] == $i )? 'selected':''; ?>>
                                            <?php echo $i ?>
                                        </option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label id="municipality_code-error" class="error" for="municipality_code"><?php echo form_error('municipality_code'); ?></label>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="monto_cuota" class="col-sm-2 col-form-label">Monto Minimo Por Cuota</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="monto_cuota" name="monto_cuota" value="<?php echo set_value('monto_cuota',(  !empty($afiliado['monto_cuota']))?number_format($afiliado['monto_cuota'], 2, '.', '') :1000); ?>" placeholder="Monto Cuota">
                            </div>
                            <div class="col-sm-4">
                                <label id="monto_cuota-error" class="error" for="monto_cuota"><?php echo form_error('monto_cuota'); ?></label>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="date_activation" class="col-sm-2 col-form-label">Fecha de Alta</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="date_activation" name="date_activation" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-" data-value="<?php echo set_value('date_activation',$afiliado['activation']); ?>" value="<?php echo set_value('date_activation',$afiliado['activation']); ?>" placeholder="Fecha de Activación">
                        </div>
                        <div class="col-sm-4">
                            <label id="date_activation-error" class="error" for="date_activation"><?php echo form_error('date_activation'); ?></label>
                        </div>
                    </div>  


                    -->

                    <div class="form-group row">
                        <div class="col-sm-2 ">
                            <button type="submit" class="btn btn-default btn-block">Volver</button>
                        </div>
                        <div class="col-sm-2 ml-auto">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



