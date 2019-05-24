$(function() {
    console.log("LOAD ADD JS");
    $.datetimepicker.setLocale('es');
    check_montos();


    $(document).on('change',"#monto_contado,#nro_cuotas",function(){
        check_montos();
    });


    function check_montos(){

        var aporte_incial=parseFloat($("#monto_aporte_inicial").val());
        var contado=parseFloat($("#monto_contado").val());
        var resta_cuotas=0;
        
        console.log("====> aporte_incial: %o",aporte_incial);
        console.log("====> contado: %o",contado);       

        if(contado>aporte_incial){
            alert("Monto de Contado no puede ser mayor que Monto Aporte Inicial");
            $("#monto_contado").focus().val(0);
            return false;
        }
        if(contado==aporte_incial){
            $("#section_cuotas").css("display",'none');
        }else{
            $("#section_cuotas").css("display",'block');
        }
        if(contado!=0){
            resta_cuotas=aporte_incial-contado;
        }else{
            resta_cuotas=aporte_incial;
        }

        n_cuota=$("#nro_cuotas").val();
        n_cuota=(n_cuota.length!=0)?parseInt(n_cuota):6;

        console.log("====> resta_cuotas: %o",resta_cuotas.toFixed(2));
        console.log("====> n_cuota: %o",n_cuota);
        monto_cuota=resta_cuotas/n_cuota;
        $("#monto_total_cuotas").val(resta_cuotas.toFixed(2));
        $("#monto_cuota").val(monto_cuota.toFixed(2));
    }

    /*$("#date_activationas").datetimepicker({
        i18n: {
            es: {
                months: [
                    'Enero', 'Febrero', 'Marzo', 'Abril',
                    'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
                ],
                dayOfWeek: [
                    "Dom", "Lu", "Ma", "Mi",
                    "Jue", "Vi", "Sa",
                ]
            }
        },
        timepicker: false,
        format: 'd-m-Y'
    });*/
});