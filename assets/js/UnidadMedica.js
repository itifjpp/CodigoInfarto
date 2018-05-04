$(document).ready(function (e) {
    /*AGREGAR & EDITAR ENCUESTAS*/
    $('.um-enc-add-edit').click(function (e) {
        e.preventDefault();
        var encuesta_nombre=prompt('NOMBRE DE LA ENCUESTA',$(this).attr('data-nombre'));
        if(encuesta_nombre!='' && encuesta_nombre!=null){
            SendAjaxPost({
                encuesta_id:$(this).attr('data-id'),
                encuesta_nombre:encuesta_nombre,
                encuesta_estado:$(this).attr('data-estado'),
                encuesta_accion:$(this).attr('data-accion'),
                csrf_token:csrf_token
            },'Um/Encuestas/AjaxEncuesta',function (response) {
                if(response.accion=='1'){
                    msj_success_noti('DATOS GUARDADOS');
                    ActionWindowsReload();
                }
            });
        }
    });
    $('body').on('click','.um-enc-estado',function () {
        var encuesta_id=$(this).attr('data-id');
        var encuesta_estado=$(this).attr('data-estado');
        SendAjaxPost({
            encuesta_id:encuesta_id,
            encuesta_estado:encuesta_estado,
            csrf_token:csrf_token
        },'Um/Encuestas/AjaxEstadoEncuesta',function (response) {
            location.reload();
        })
    })
    /*AGREGAR & EDITAR PREGUNTAS*/
    $('.um-enc-preg-add-edit').click(function (e) {
        e.preventDefault();
        var pregunta_nombre=prompt('NOMBRE DE LA PREGUNTA',$(this).attr('data-pregunta'));
        if(pregunta_nombre!='' && pregunta_nombre!=null){
            SendAjaxPost({
                pregunta_id:$(this).attr('data-id'),
                pregunta_nombre:pregunta_nombre,
                encuesta_id:$(this).attr('data-enc'),
                pregunta_accion:$(this).attr('data-accion'),
                csrf_token:csrf_token
            },'Um/Encuestas/AjaxEncuestaPreguntas',function (response) {
                if(response.accion=='1'){
                    msj_success_noti('DATOS GUARDADOS');
                    ActionWindowsReload();
                }
            });   
        }
    });
    /*AGREGAR & EDITAR RESPUESTA*/
    $('.um-enc-preg-res-add-edit').click(function (e) {
        var icono=$(this);
        e.preventDefault();
        bootbox.confirm({
            title:'<h5><b>NUEVA PREGUNTA</b></h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12 text-center" >'+
                            '<select class="form-control" name="respuesta_nombre">'+
                                '<option value="EXCELENTE;EMO_3.png" data-img="">EXCELENTE</option>'+
                                '<option value="BUENO;EMO_2.png" data-img="">BUENO</option>'+
                                '<option value="REGULAR;EMO_1.png" data-img="">REGULAR</option>'+
                                '<option value="MALO;EMO_5.png" data-img="E">MALO</option>'+
                                '<option value="MUY MALO;EMO_7.png" data-img="">MUY MALO</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                cancel:{
                    label:'Cancelar',
                    className:'btn-imss-cancel'
                },confirm:{
                    label:'Aceptar',
                    className:'back-imss'
                }
            },callback:function (res) {
                if(res==true){
                    var respuesta_nombre=$('body select[name=respuesta_nombre]').val().split(';');
                    if(respuesta_nombre[0]!='' && respuesta_nombre[0]!=null){
                        SendAjaxPost({
                            respuesta_id:icono.attr('data-id'),
                            respuesta_nombre:respuesta_nombre[0],
                            respuesta_icon:respuesta_nombre[1],
                            pregunta_id:icono.attr('data-pregunta'),
                            respuesta_accion:icono.attr('data-accion'),
                            csrf_token:csrf_token
                        },'Um/Encuestas/AjaxEncuestaPreguntasRespuetas',function (response) {
                            if(response.accion=='1'){
                                msj_success_noti('DATOS GUARDADOS');
                                ActionWindowsReload();
                            }
                        })    
                    }
                }
            }
        })
        $('body select[name=respuesta_nombre]').val(icono.attr('data-respuesta'));
        $('body select[name=respuesta_icon]').val(icono.attr('data-icon'));
        $('body .col-img-emoji').html('<br><center><img src="'+base_url+'assets/img/emoji/'+$('body select[name=respuesta_icon]').val()+'" style="width:30%"></center>');
//        $('body select[name=respuesta_nombre]').change(function (e) {
//            var emoji=$(this).val().split(';')
//            $('body .col-img-emoji').html('<br><center><img src="'+base_url+'assets/img/emoji/'+emoji[1]+'" style="width:30%"></center>');
//        })
    });
    /*ELIMINAR PREGUNTAS DE LA ENCUESTA*/
    $('body').on('click','.um-enc-preg-del',function () {
        SendAjaxPost({
            pregunta_id:$(this).attr('data-id'),
            csrf_token:csrf_token
        },'Um/Encuestas/AjaxEliminarPreguntas',function (response) {
            location.reload();
        })
    });
    /*ELIMINAR RESPUESTAS DE LA PREGUNTA*/
    $('body').on('click','.um-enc-preg-res-del',function () {
        SendAjaxPost({
            respuesta_id:$(this).attr('data-id'),
            csrf_token:csrf_token
        },'Um/Encuestas/AjaxEliminarRespuestas',function (response) {
            location.reload();
        })
    });
    var ChartLabel=[];
    var ChartData=[];
    $('body .respuesta_resultados').each(function (e) {
        ChartLabel.push($(this).attr('data-respuesta')+' ('+$(this).attr('data-value')+')');
        ChartData.push($(this).attr('data-value'));
    });
    if($('input[name=GraficasEncuestas]').val()!=undefined){
        setTimeout(function () {
            $('.load-graficas').addClass('hide');
            $('.GraficaResultadosEncuestas').removeClass('hide')
            ChartResultados();
        },2000);   
    }
    function ChartResultados(){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: ChartData, backgroundColor: [
                        "#795548",  //Verde 
                        "#607D8B"  //Verde Claro
                    ]
                }], labels: ChartLabel
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('GraficaResultadosEncuestas').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
   $('body .btn-ajax-resultados-encuestas').click(function (e) {
       $('.row-result-encuestas-loading').removeClass('hide');
        e.preventDefault();
        let inputTurno=$('select[name=inputTurno]').val();
        let inputFecha=$('input[name=inputFecha]').val();
        if(inputTurno!='' && inputFecha!=''){
            SendAjaxPost({
                inputTurno:inputTurno,
                inputFecha:inputFecha,
                csrf_token:csrf_token
            },'Um/Encuestas/AjaxResultadosUrg',function (response) {
                console.log(response)
                $('.row-result-encuestas-loading').addClass('hide');
                $('.row-result-encuestas-load').removeClass('hide');
                $('.result-ensat-fecha').html('Fecha de encuesta: '+response.EnsatFecha);
                $('.result-ensat-turno').html('Turno: '+response.EnsatTurno);
                $('.ensat-total-encuestas').html(response.EnsatTotal);
                $('body .row-result-encuestas').html(response.cols);
            })
        }
    })
})