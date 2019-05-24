
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
                                <h2>Saldos Mensuales</h2>
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
                        <li class="breadcrumb-item active">Saldos Mensuales</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-fluid">
        <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3">
       
            <table id="data-table" class="table mb-0 table-striped table-bordered cell-border compact stripe table-sm mb-0 dataTable dtr-inline" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th  class="text-center">#</th>
                    <th  class="text-center">MES</th>
                    <th  class="text-center">COMPENSACIONES</th>
                    <th  class="text-center">INVERSIONES</th>
                    <th  class="text-center text-danger">ASISTENCIAS</th>
                    <th  class="text-center">Devoluciones</th>
                    <th  class="text-center">Aporte Inicial</th>
                    <th  class="text-center">SALDO</th>
                   
                </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($balance as $mes=> $saldo) {
                            echo '<tr>';
                            echo '<td class="fcol">'.$mes.'</td>';
                            echo '<td class="fcol">'.date('M-Y',strtotime($mes)).'</td>';
                            echo '<td  class="text-center">$'.number_format($saldo['interes'],2,",",".").'</td>';
                            echo '<td  class="text-center">$'.number_format($saldo['inversion'],2,",",".").'</td>';
                            echo '<td  class="text-center text-danger">$'.number_format($saldo['asistencias'],2,",",".").'</td>';
                            echo '<td  class="text-center">$'.number_format($saldo['devolucion'],2,",",".").'</td>';
                            echo '<td  class="text-center">$'.number_format($saldo['aportes'],2,",",".").'</td>';
                            echo '<td  class="text-center">$'.number_format($saldo['saldo'],2,",",".").'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>

    
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo base_url();?>" id="url">                