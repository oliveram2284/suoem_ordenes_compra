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
        <link href="<?php  echo base_url();?>assets/css/plugins/plugins.css" rel="stylesheet">
        <!--fonts-->
        <link href="<?php  echo base_url();?>assets/lib/line-icons/line-icons.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="<?php  echo base_url();?>assets/css/style.css" rel="stylesheet">
    </head>
    <body class='bg-light'>

        <div class="page-wrapper" id="page-wrapper">

            <main class="content">
                <?php echo form_open('login',array('method'=>'post')); ?>
                <div class="container flex d-flex">
                    <div class='row flex align-items-center'>
                        <div class=' mt-60 mb-60  col-lg-6 col-md-6 col-sm-12 ml-auto mr-auto'>
                            <div class="bg-white shadow-sm overflow-hidden rounded">
                                <div class="p-4 text-center bg-white text-dark">
                                    <a href="index.html" class="">  
                                    <img src="<?php echo base_url('assets/images/suoem_compra_logo_sm.png')?>" class="img-responsive" alt="FASTraM">
                                    </a>
                                    <h5 class='text-center h5 pt-10 mb-0 text-dark'>Bienvenido, Inicie Sesión!</h5>
                                </div>
                                <div class="p-3 pt-30 pb-30">

                                    
                                        <div class="input-icon-group">
                                            <div class="d-flex flex flex-row">
                                                <label class="flex d-flex mr-auto" for='pass'>Usuario</label>
                                            <div class="flex d-flex ml-auto justify-content-end invisible">
                                                <a href="#" class="text-primary fs12">Remind Me</a>
                                            </div>
                                           </div>
                                            <div class='input-icon-append'>
                                                <i class="fa fa-user"></i>
                                                <input placeholder="Usuario" name="username" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="input-icon-group">
                                           <div class="d-flex flex flex-row">
                                               <label class="flex d-flex mr-auto" for='pass'>Contraseña</label>
                                            <div class="flex d-flex ml-auto justify-content-end invisible">
                                                <a href="#" class="text-primary fs12">Olvidar</a>
                                            </div>
                                           </div>
                                            <div class='input-icon-append'>
                                                <i class="fa fa-lock"></i>
                                                <input id="pass" placeholder="Password" name="password" type="password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="customUi-checkbox  pb-2 invisible">
                                            <input id="check-remember" type="checkbox" name="agree">
                                            <label for="check-remember">
                                                <span class="label-checkbox"></span>
                                                <span class="label-helper">Remember Me</span>
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary btn-block btn-lg">Ingresar</button>
                                        <div class="pt-20 text-center invisible">
                                            Don't have an account? <a href='page-sign-up.html' class='text-primary ml-2 b-b d-inline-block pb-1'>Sign Up Here</a>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- main end-->
                </form>
                <footer class="content-footer bg-light b-t">
                    <div class="d-flex flex align-items-center pl-15 pr-15">
                        <div class="d-flex flex p-3 mr-auto ml-auto justify-content-center">
                            <div class="text-muted">© Copyright 2018. Indev</div>
                        </div>
                    </div>
                </footer><!-- footer end-->
            </main><!-- page content end-->
        </div><!-- app's main wrapper end -->
        <!-- Common plugins -->
        <script type="text/javascript" src="<?php  echo base_url();?>assets/js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="<?php  echo base_url();?>assets/js/appUi-custom.js"></script> 
    </body>
</html>
