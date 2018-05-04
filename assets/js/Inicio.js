$(document).ready(function (){ 
    function AjaxCargarEncuestasPersonal() {
        if($('body input[name=CargarEncuestas]').val()=='Si'){
            sighAjaxGet(base_url+'Um/Encuestas/AjaxVerificarEncuestas',function (response) {
                if(response.accion=='1'){
                    bootbox.dialog({
                        title:'<h4 style="margin:6px!important"><b>'+response.EncuestaNombre+'</b></h4><h6 style="margin:6px!important;font-size:12px;line-height:1.4">RESPONDE LA SIGUIENTE ENCUESTA, PARA CONOCER TU OPINIÓN. GRACIAS <br><b>(ESTÁ ENCUESTA ES ANÓNIMA)</b></h6>',
                        message:'<div class="row">'+response.Encuesta+'</div>',
                        closeButton:false,
                        size:'medium'
                    });
                }
            });
        }
    }

    var EncuestasTotalRespondidas=0;
    
    var EncuestasRespondidas=[];
    $('body').on('click','.input-radio-save',function () {
        EncuestasTotalRespondidas++;
        var Respuesta=$(this).attr('data-value').split(';');
        var EncuestaId=$('body input[name=EncuestaId]').val();
        var EncuestasTotalPreguntas=$('body input[name=TotalPreguntas]').val();
        EncuestasRespondidas.push({
            encuesta_id:Respuesta[0],
            pregunta_id:Respuesta[1],
            respuesta_id:Respuesta[2]
        });
        $('body .col_pregunta'+Respuesta[1]).addClass('hide');
        if(EncuestasTotalRespondidas==EncuestasTotalPreguntas){
            msj_success_noti("GUARDANDO RESULTADOS DE LA ENCUESTA...");
            SendAjaxPost({
                EncuestasRespondidas:EncuestasRespondidas,
                encuesta_id:EncuestaId,
            },'Um/Encuestas/AjaxFinalizarEncuesta',function (response) {
                msj_success_noti('RESULTADOS DE LA ENCUESTA GUARDADOS,GRACIAS...');
            })
        }
    });
    $(document).on('click','.open-new-windows',function (e) {
        window.open($(this).attr('data-url'),'_blank');
    });
    if($('input[name=ResultEnsat]').val()!=undefined){
        sighAjaxGet(base_url+'Encuestas/AjaxResultadosEncuestas',function (response) {
            if(response.hide_row=='false'){
                $('.row-result-encuestas-status').removeClass('hide');
                $('.row-result-ensat-loading').addClass('hide');
                $('.row-result-ensat-load').removeClass('hide');
                $('.result-ensat-fecha').html(response.EnsatFecha);
                $('.result-ensat-turno').html(response.EnsatTurno);
                $('.result-ensat-total').html(response.EnsatTotal);
                $('body .row-result-encuestas').html(response.rows);
            }
            AjaxCargarEncuestasPersonal();
        },'No');
    }
}); 

