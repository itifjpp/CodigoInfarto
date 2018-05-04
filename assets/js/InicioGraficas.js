$(document).ready(function () {
    $('select[name=AÑO]').change(function () {
        AjaxGraficaInicio($(this).val())
    })
    function AjaxGraficaInicio() {
        $.ajax({
            url: base_url+"Inicio/AjaxGraficaInicio",
            type: 'POST',
            dataType: 'json',
            data:{
                ANIO:$('select[name=AÑO]').val(),
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                $('.loading-grafica').removeClass('hide');
                $('.resultados').addClass('hide');
            },success: function (info, textStatus, jqXHR) {
                $('.loading-grafica').addClass('hide');
                $('.resultados').removeClass('hide');
                console.log(info);
                var Datos = {
                        labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets : [
                            {
                                label:'Reaminación',
                                backgroundColor : '#F44336',
                                data : [info.ENE_ROJO, info.FEB_ROJO, info.MAR_ROJO, info.ABR_ROJO, info.MAY_ROJO, info.JUN_ROJO, info.JUL_ROJO, info.AGO_ROJO, info.SEP_ROJO,info.OCT_ROJO, info.NOV_ROJO, info.DIC_ROJO]
                            },{
                                label:'Emergencia',
                                backgroundColor : '#FF9800',
                                data : [info.ENE_NARANJA, info.FEB_NARANJA, info.MAR_NARANJA, info.ABR_NARANJA, info.MAY_NARANJA, info.JUN_NARANJA, info.JUL_NARANJA, info.AGO_NARANJA, info.SEP_NARANJA,info.OCT_NARANJA, info.NOV_NARANJA, info.DIC_NARANJA]
                            },{
                                label:'Urgencia',
                                backgroundColor : '#FFD600',
                                data : [info.ENE_AMARILLO, info.FEB_AMARILLO, info.MAR_AMARILLO, info.ABR_AMARILLO, info.MAY_AMARILLO, info.JUN_AMARILLO, info.JUL_AMARILLO, info.AGO_AMARILLO, info.SEP_AMARILLO,info.OCT_AMARILLO, info.NOV_AMARILLO, info.DIC_AMARILLO]
                            },{
                                label:'Urgencia Menor',
                                backgroundColor : '#4CAF50',
                                data : [info.ENE_VERDE, info.FEB_VERDE, info.MAR_VERDE, info.ABR_VERDE, info.MAY_VERDE, info.JUN_VERDE, info.JUL_VERDE, info.AGO_VERDE, info.SEP_VERDE,info.OCT_VERDE, info.NOV_VERDE, info.DIC_VERDE]
                            },{
                                label:'Sin Urgencia',
                                backgroundColor : '#3F51B5',
                                data : [info.ENE_AZUL, info.FEB_AZUL, info.MAR_AZUL, info.ABR_AZUL, info.MAY_AZUL, info.JUN_AZUL, info.JUL_AZUL, info.AGO_AZUL, info.SEP_AZUL,info.OCT_AZUL, info.NOV_AZUL, info.DIC_AZUL]
                            }
                        ]
                    }
                    var contexto = document.getElementById('grafico').getContext('2d');
      
                    var myChart = new Chart(contexto, {
                        type: 'bar',
                        data: Datos,
                        responsive : true 
                    });
            },error: function (jqXHR, textStatus, errorThrown) {

            }
        });    
    }                             
})