
                <footer class="content-footer bg-light b-t">
                    <div class="d-flex flex align-items-center pl-15 pr-15">
                        <div class="d-flex flex p-3 ml-auto">
                            <div class="invisible">
                                <a href="#" class="d-inline-flex pl-0 pr-2 b-r">Contacto</a>
                                <a href="#" class="d-inline-flex pl-2 pr-2 b-r">Almacenamiento</a>
                                <a href="#" class="d-inline-flex pl-2 pr-2 ">Privacy</a>
                            </div>
                        </div>
                        <div class="d-flex flex p-3 mr-auto justify-content-end">
                            <div class="text-muted">© Copyright <?php echo date('Y')?>. <a href="indevla.com" target="blank">INDEVLA.COM</a></div>
                        </div>
                    </div>
                </footer>
            </main><!-- page content end-->
        </div><!-- app's main wrapper end -->
        <!-- Common plugins -->
        
        <script type="text/javascript" src="<?php  echo base_url();?>assets/js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="<?php  echo base_url();?>assets/js/appUi-custom.js"></script>  
        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/data-tables/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/data-tables/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/data-tables/dataTables.responsive.min.js"></script> 
        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/data-tables/responsive.bootstrap4.min.js"></script>
        <script type="text/javascript" src="<?php  echo base_url();?>assets/jquery-typeahead/src/jquery.typeahead.js"></script>  
        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/select2/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/dt-picker/jquery.datetimepicker.full.min.js"></script>
        
        
        <?php if(isset($scripts)):?>
        <?php foreach ($scripts as $key => $value):?>
            <script type="text/javascript" src="<?php  echo base_url();?>assets/<?php  echo $value;?>"></script>
        <?php endforeach;?>
        <?php endif;?>

        <script type="text/javascript" src="<?php  echo base_url();?>assets/lib/sweet-alerts2/sweetalert2.min.js"></script>
    </body>
</html>
