<div class="row" >
    <div class="col-sm-10">
        <input type="text" class="form-control" id="msj_" name="msj_" value="" placeholder="Escribe tu mensaje.">
    </div>
    <div class="col-sm-2">
        <button class="btn btn-secondary " id="send">Enviar</button>
    </div>
</div>
<hr>
<?php 
foreach($msj as $m){
    
    //Mensaje Propio
    if($m['user_id'] == $usrId){
        echo ' <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8 text-right">'.$m['mensaje'].'</div>
               </div>
               <div class="row" style="font-size:9px;">
                <div class="col-sm-4"></div>
                <div class="col-sm-8 text-right">'.$m['fecha_formateada'].' Yo </div>
               </div><hr>';
    } else {
        //Mensaje de otro
        echo '<div class="row">
                <div class="col-sm-8">'.$m['mensaje'].'</div>
              </div>
              <div class="row" style="font-size:9px;">
                <div class="col-sm-8">'.$m['fecha_formateada'].' '.$m['userfn'].' '.$m['userln'].' </div>
              </div><hr>';
    }
}
?>

<script>
    $('#send').click(function(){
        if($('#msj_').val() != ''){
            $.ajax({
            method: 'POST',
            data: { msj : $('#msj_').val(),
                    ord : idOrdenSeleccionada  },
                url: '../comercio/setMsj',
                success: function(result){
                            $('#msj_').val('');
                            abrirMensajes(idOrdenSeleccionada); 
                            //WaitingClose();
                            //$("#ordenDetailBody").html(result.html);
                            //$('#ordenDetail').modal('show');
                    
                        },
                error: function(result){
                        //WaitingClose();
                        alert(result);
                    },
            dataType: 'json'
            });
        }
    });
</script>