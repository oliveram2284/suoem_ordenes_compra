<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SUOEM - Validación de Ordenes de Compra</title>    
        <!-- Bootstrap-->
        <link href="<?php  echo base_url();?>assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--Common Plugins CSS -->
        <link href="<?php  echo base_url();?>/assets/css/plugins/plugins.css" rel="stylesheet">
        <!--fonts-->
        <link href="<?php  echo base_url();?>assets/lib/line-icons/line-icons.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/css/style.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="<?php  echo base_url();?>assets/lib/dt-picker/jquery.datetimepicker.min" rel="stylesheet" />
        <link href="<?php  echo base_url();?>assets/lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet" />
        <link rel="shortcut icon" href="<?php  echo base_url();?>assets/images/logo.png" type="image/x-icon">
        
    </head>
    <body class="pace-done">
    
        <div class="page-wrapper" id="page-wrapper">
            <aside id="page-aside" class=" page-aside ">
                <div class="sidenav whiteNav">
                    <a href="/" class="app-logo d-flex flex flex-row align-items-center overflow-hidden justify-content-center">
                        <img src="<?php  echo base_url();?>assets/images/suoem_head_logo.png" class="img-responsive" alt="FASTraM">
                    </a>
                    <div class="flex">
                        <div class="aside-content slim-scroll">
                            <ul class="metisMenu" id="metisMenu">
                                <?php if($this->auth->allow('municipio')):?>
                                    <li class="">
                                        <i class="icon-Monitor-Analytics nav-thumbnail"></i>
                                        <a href="<?php echo base_url('municipio')?>">
                                            <span class="nav-text">
                                                Municipios
                                            </span>
                                        </a>
                                    </li>
                                <?php endif;?>
                                <?php if($this->auth->allow('user')):?>
                                    <li>
                                        <i class="icon-User nav-thumbnail"></i>
                                        <a href="<?php echo base_url('/user')?>">
                                            <span class="nav-text">
                                                Usuarios
                                            </span>
                                        </a>
                                    </li>
                                <?php endif;?>


                                <?php if($this->auth->allow('comercio')):?>
                                    <li>
                                        <i class="icon-User nav-thumbnail"></i>
                                        <a href="<?php echo base_url('/comercio')?>">
                                            <span class="nav-text">
                                                Comercios
                                            </span>
                                        </a>
                                    </li>
                                <?php endif;?>
                                <?php if($this->auth->allow('afiliado')):?>
                                <li class="">
                                    <i class="icon-Affiliate nav-thumbnail"></i>
                                    <a href="<?php echo base_url('/afiliado')?>">
                                        <span class="nav-text">
                                            Afiliados 
                                        </span>
                                    </a>
                                </li>
                                <?php endif;?>


                                <!-- <li class="">
                                <li class="">
                                    <i class="icon-Monitor-Analytics nav-thumbnail"></i>
                                    <a href="<?php echo base_url('municipio')?>">
                                        <span class="nav-text">
                                            Municipios
                                        </span>
                                    </a>
                                </li>
                                <li class="">
                                    <i class="icon-Affiliate nav-thumbnail"></i>
                                    <a href="<?php echo base_url('/afiliado')?>">
                                        <span class="nav-text">
                                            Afiliados 
                                        </span>
                                    </a>
                                </li> <li class="">
                                    <i class="icon-Affiliate nav-thumbnail"></i>
                                    <a href="<?php echo base_url('/')?>">
                                        <span class="nav-text">
                                            Ordenes 
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <i class="icon-Money-Bag nav-thumbnail"></i>
                                    <a href="<?php echo base_url('&')?>">
                                        <span class="nav-text">
                                            Comercios 
                                        </span>
                                    </a>
                                </li>
                                
                                <li>
                                    <i class="icon-Money-Bag nav-thumbnail"></i>
                                    <a href="<?php echo base_url('/')?>">
                                        <span class="nav-text">
                                            Mensajes 
                                        </span>
                                    </a>
                                </li>Menu-item-->                                
                                <!--Menu-item-->
                                <!--
                                <li class="">
                                    <i class="icon-Monitor-Analytics nav-thumbnail"></i>
                                    <a href="<?php echo base_url('/')?>">
                                        <span class="nav-text">
                                            Reportes
                                        </span>
                                    </a>
                                </li>
                                
                                
                               
                                <li>
                                    <i class="icon-Monitor nav-thumbnail"></i>
                                    <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                        <span class="nav-text">Sistema</span>
                                    </a>
                                    <ul aria-expanded="false">
                                        <li>
                                            <span class="nav-thumbnail"></span>
                                            <a href="<?php echo base_url('setting')?>">Configuración</a>
                                        </li>
                                        <li>
                                            <span class="nav-thumbnail"></span>
                                            <a href="<?php echo base_url('setting/export')?>">Exportar</a>
                                        </li>
                                    </ul>
                                </li>
                                -->
                            </ul>
                        </div><!-- aside content end-->
                    </div><!-- aside hidden scroll end-->
                    <div class="aside-footer p-3 pl-25">
                        <div class="">
                            App Version - 2.0
                        </div>
                    </div><!-- aside footer end-->
                </div><!-- sidenav end-->
            </aside><!-- page-aside end-->
            <main class="content">
                <header class="navbar page-header darkHeader bg-dark navbar-expand-lg">
                    <ul class="nav flex-row mr-auto">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link sidenav-btn h-lg-down">
                                <span class="navbar-toggler-icon"></span>
                            </a>
                            <a class="nav-link sidenav-btn h-lg-up" href="#page-aside"  data-toggle="dropdown" data-target="#page-aside">
                                <span class="navbar-toggler-icon"></span>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav flex-row order-lg-2 ml-auto nav-icons">                        
                        <li class="nav-item dropdown user-dropdown align-items-center">
                            <a class="nav-link" href="#" id="dropdown-user" role="button" data-toggle="dropdown">
                                <span class="user-states states-online">
                                    <img src="<?php  echo base_url();?>assets/images/avatar6.jpg" width="35" alt="" class=" img-fluid rounded-circle">
                                </span>
                                <span class="ml-2 h-lg-down dropdown-toggle">
                                    <?php echo $this->session->userdata('firstname')." ".$this->session->userdata('lastname')?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <div class="text-center p-3 pt-0 b-b mb-5">
                                    <span class="mb-0 d-block font300 text-title fs-1x">Hola! <span class="font700"> <?php echo $this->session->userdata('username')?></span></span>
                                    <span class="fs12 mb-0 text-muted">Administrator</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="icon-User"></i>Perfil</a>                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('logout')?>"><i class="icon-Power"></i> Salir</a>

                            </div>
                        </li>
                        <li class="h-lg-up nav-item">
                            <a href="#" class=" nav-link collapsed" data-toggle="collapse" data-target="#navbarToggler" aria-expanded="false">
                                <i class="icon-Magnifi-Glass2"></i>
                            </a>
                        </li>
                    </ul>
                    <!--
                    <div class="collapse navbar-collapse search-collapse" id="navbarToggler">
                        <form class="form-inline ml-1">     
                            <button class="no-padding bg-trans border0" type="button"><i class="icon-Magnifi-Glass2"></i></button>
                            <input class="form-control border0" type="search" placeholder="Search..." aria-label="Search">
                        </form>
                    </div>
-->
                </header>