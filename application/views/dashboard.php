<div class="page-subheader mb-10">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="list">
                                    <div class="list-item pl-0">
                                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                                            <i class="icon-Folder-Pictures"></i>
                                        </div>
                                        <div class="list-body">
                                            <div class="list-title fs-2x">
                                                <h2>Inicio</h2>
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
                                        <li class="breadcrumb-item active">Inicio</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row invisible">
                            <div class="col-lg-3 mb-3 col-md-4 col-sm-6 col-xs-12 mb-20">                            
                                <div class="list bg-primary shadow-sm rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-primary-active text-primary-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="list-body text-right" href="SDSd">
                                            <span class="list-title fs-2x  lineH-1"><?php echo $totals['adherents']?> </span>
                                            <span class="list-content text-primary-light fs14">Adherentes</span>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('adherent')?>" class="d-flex text-muted flex text-right flex-row align-items-center justify-content-end pt-5 pb-5 pl-4 pr-4 bg-primary-active">
                                        Ver Todos<i class="fa fa-chevron-right ml-2 fs12 mt-1"></i>
                                    </a>
                                </div>
                            </div><!--col-->
                            <div class="col-lg-3 mb-3 col-md-4 col-sm-6 col-xs-12 mb-20">
                                <div class="list bg-primary shadow-sm rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-primary-active text-warning-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="icon-Money-Bag"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x lineH-1"><?php echo $totals['aporte']?></span>
                                            <span class="list-content text-warning-light fs14">Aportes</span>

                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('aporte')?>" class="d-flex text-muted flex text-right flex-row align-items-center justify-content-end pt-5 pb-5 pl-4 pr-4 bg-primary-active">
                                        
                                        Ver Todos<i class="fa fa-chevron-right ml-2 fs12 mt-1"></i>
                                    </a>
                                </div>
                            </div><!--col-->
                            <div class="col-lg-3 mb-3 col-md-4 col-sm-6 col-xs-12 mb-20">
                                <div class="list bg-primary shadow-sm rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-primary-active text-primary-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="icon-Money"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x  lineH-1"><?php echo $totals['asistencias']?></span>
                                            <span class="list-content text-primary-light fs14">Asistencias</span>

                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('asistencia')?>" class="d-flex text-muted flex text-right flex-row align-items-center justify-content-end pt-5 pb-5 pl-4 pr-4 bg-primary-active">
                                        Ver Más <i class="fa fa-chevron-right ml-2 fs12 mt-1"></i>
                                    </a>
                                </div>
                            </div><!--col-->
                        
                            <div class="col-lg-3 mb-3 col-md-4 col-sm-6 col-xs-12 mb-20">
                                <div class="list bg-primary shadow-sm rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-primary-active text-primary-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="fa fa-file-alt"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x  lineH-1">Reportes</span>
                                            <span class="list-content text-primary-light fs14">Reportes</span>

                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('asistencia')?>" class="d-flex text-muted flex text-right flex-row align-items-center justify-content-end pt-5 pb-5 pl-4 pr-4 bg-primary-active">
                                        Ver Más <i class="fa fa-chevron-right ml-2 fs12 mt-1"></i>
                                    </a>
                                </div>
                            </div><!--col-->
                        </div>
                        <div class="title-sep sep-body mb-30 invisible">
                            <span>Historial</span>
                        </div>
                        
                        <div class="row invisible">
                            <div class="col-lg-4">
                                <div class="portlet-box portlet-gutter  mb-30 p-3   rounded">
                                    <div class="portlet-header flex-row flex full-height d-flex align-items-center b-b">
                                        <div class="flex d-flex flex-column">
                                            <h3> <i class="icon-Calendar"></i> Actividades Recientes</h3> 
                                        </div>                                        
                                    </div>
                                    <div class="portlet-body">
                                    <ul class="timeline-alt list-unstyled">
                                        <?php foreach($recent_activities as $k=>$item):?>
                                        <li class="clearfix d-flex flex">
                                                <div class="tl-thumb si-colored-facebook rounded-circle">
                                                    <i class="icon-Calendar fs10"></i>
                                                </div>
                                                <div class="tl-content">
                                                    <span class="text-muted float-right fs12 d-inline-block"><?php echo $item['date_added']?></span>
                                                    <a href="#">
                                                        <span><?php echo ($item['tipo']==0)?'Nueva Adhesion ':'Asistencia '?>:  <?php echo $item['fullname']?></span>
                                                    </a> 
                                                   
                                                </div>
                                                
                                            </li>
                                        <?php endforeach;?>
                                           
                                          <!--
                                            <li class="clearfix d-flex flex text-right">
                                                <a href="#" class="btn btn-sm btn-primary">View All</a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div><!--portlet-->
                            </div>

                            <div class="col-lg-8">
                                <div class="portlet-box portlet-gutter  mb-30">
                                    <div class="portlet-header flex-row flex full-height d-flex align-items-center b-b">
                                        <div class="flex d-flex flex-column">
                                            <h3> <i class="icon-Affiliate"></i> Ultimas Adhesiones</h3> 
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body">
                                        <?php if(!empty($adherentes_ultimos)):?>
                                            <table class="table mb-0 table-striped table-bordered cell-border compact stripe table-sm" cellspacing="0" width="100%">
                                                <thead class="text-center">
                                                    <tr><th>Nro</th><th>Apellido y Nombre </th><th>Fecha Ingreso</th> <th>Fecha Alta</th> </tr>
                                                <thead>
                                                <tbody>
                                                    <?php foreach($adherentes_ultimos as $k=> $item):?>
                                                        <tr class="text-center">
                                                            <td><?php echo $item['nro']?></td>
                                                            <td class="fcol"><?php echo $item['fullname']?></td>
                                                            <td><?php echo $item['added']?></td>
                                                            <td><?php echo $item['actived']?></td>
                                                            

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php else:?>
                                        <p class="mb-0 text-muted">
                                           No hay Adhesiones.
                                        </p>
                                        <?php endif?>
                                        
                                    </div>
                                </div><!--portlet-->
                            </div>
                        </div>
                    </div>
                </div>
                
