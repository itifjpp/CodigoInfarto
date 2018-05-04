$(document).ready(function (e) {
    /*AGREGAR & EDITAR ENCUESTAS*/
    $('.form-encuesta').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Encuestas/AjaxEncuesta',function (response) {
            location.href=base_url+'Encuestas';
        });
    });
    $('select[name=equipo_id]').val($('select[name=equipo_id]').attr('data-value'));
    $('select[name=encuesta_tipo]').val($('select[name=encuesta_tipo]').attr('data-value'));
    $('select[name=encuesta_para]').val($('select[name=encuesta_para]').attr('data-value'));
    $('body').on('click', '.cambiar-estado-encuesta', function(){
        var encuesta_id = $(this).attr("data-id");
        var encuesta_estado = $(this).attr('data-estado');
        sighAjaxPost({
            encuesta_estado:encuesta_estado,
            encuesta_id:encuesta_id
        },base_url+'Encuestas/AjaxCambiarEstado',function (response) {
            location.reload();
        });
    });
    $('body').on('click', '.eliminar_encuesta', function(){
        var id = $(this).attr("data-id");
        if(confirm("¿DESEA ELIMINAR ESTA ENCUESTA?")){
            sighAjaxPost({
                id:id
            },base_url+'Encuestas/AjaxEliminarEncuesta',function (response) {
                if(response.accion==='1'){
                    msj_success_noti('DATOS GUARDADOS');
                    ActionWindowsReload();
                }
            });
        }
    });
    $('.btn-ensat-areas').click(function (evt) {
        var acceso_id=$('select[name=acceso_id]').val();
        var encuesta_id=$('input[name=encuesta_id]').val();
        if(acceso_id!=''){
            sighAjaxPost({
                area_id:acceso_id,
                encuesta_id:encuesta_id,
                action:'add'
            },base_url+'Encuestas/AjaxEncuestasAreas',function (response) {
                if(response.action==1){
                    location.reload();
                }else{
                    sighMsjError('EL ÁREA QUE DESEA AGREGAR YA ESTA AGREGADO A ESTA ENCUESTA.');
                }
            });
        }else{
            sighMsjError('SELECCIONAR UNA ÁREA');
        }
    });
    $('body').on('click','.encuesta-area-eliminar',function (evt) {
        var acceso_id=$(this).attr('data-area');
        var encuesta_id=$(this).attr('data-encuesta');
        sighAjaxPost({
            area_id:acceso_id,
            encuesta_id:encuesta_id,
            action:'delete'
        },base_url+'Encuestas/AjaxEncuestasAreas',function (response) {
            if(response.action==1){
                location.reload();
            }else{
                sighMsjError('EL ÁREA QUE DESEA AGREGAR YA ESTA AGREGADO A ESTA ENCUESTA.');
            }
        });
    })
    $('.form-encuesta-respuesta').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Encuestas/AjaxEncuestaRespuesta',function () {
           bootbox.hideAll();
           window.top.close();
           window.opener.location.reload();
        });
    });
    $('select[name=respuesta_nombre]').val($('select[name=respuesta_nombre]').attr('data-value'));
    $('input[name=respuesta_icon][value="'+$('input[name=respuesta_icon]').attr('data-value')+'"]').attr('checked',true);
    /*AGREGAR & EDITAR PREGUNTAS*/
    $('.ensat-enc-preg-add-edit').click(function (e) {
        e.preventDefault();
        var pregunta_nombre_=$(this).attr('data-pregunta');
        var pregunta_encabezado_=$(this).attr('data-encabezado');
        var pregunta_action=$(this).attr('data-action');
        var encuesta_id=$(this).attr('data-encuesta');
        var pregunta_id=$(this).attr('data-id');
        sighMjsConfirm({
            title:'AGREGAR/EDITAR PREGUNTA',
            message:'<div class="col-md-12">'+
                        '<div class="form-group m-b-10">'+
                            '<label>NOMBRE DE LA PREGUNTA</label>'+
                            '<input name="pregunta_nombre" value="'+pregunta_nombre_+'" class="form-control">'+
                        '</div>'+
                        '<div class="form-group no-margin">'+
                            '<label>ENCABEZADO DE LA PREGUNTA</label>'+
                            '<input name="pregunta_encabezado" value="'+pregunta_encabezado_+'" class="form-control">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var pregunta_nombre=$('body input[name=pregunta_nombre]').val();
                var pregunta_encabezado=$('body input[name=pregunta_encabezado]').val();
                if(pregunta_nombre!='' && pregunta_encabezado!=''){
                    sighMsjLoading();
                    sighAjaxPost({
                        pregunta_id:pregunta_id,
                        pregunta_nombre:pregunta_nombre,
                        pregunta_encabezado:pregunta_encabezado,
                        encuesta_id:encuesta_id,
                        pregunta_action:pregunta_action,
                    },base_url+'Encuestas/AjaxEncuestaPreguntas',function (response) {
                        bootbox.hideAll();
                        if(response.accion=='1'){
                            msj_success_noti('DATOS GUARDADOS');
                            ActionWindowsReload();
                        }
                    }); 
                }
            }
        })
    });
    $('body').on('click','.enc-preg-res-action',function (evt) {
        var respuesta_id=$(this).attr('data-id');
        var respuesta_nombre_get=$(this).attr('data-respuesta');
        var respuesta_valor_get=$(this).attr('data-valor');
        var respuesta_action=$(this).attr('data-action');
        var pregunta_id=$(this).attr('data-pregunta');
        sighMjsConfirm({
            title:'AGREGAR RESPUESTA',
            message:'<div class="col-md-12">'+
                        '<div class="form-group m-t-5 m-b-5">'+
                            '<label>RESPUESTA</label>'+
                            '<input type="text" name="respuesta_nombre" class="form-control" valor="'+respuesta_nombre_get+'">'+
                        '</div>'+
                        '<div class="form-group no-margin">'+
                            '<label>VALOR</label>'+
                            '<input type="text" name="respuesta_valor" class="form-control" value="'+respuesta_valor_get+'">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var respuesta_nombre=$('body input[name=respuesta_nombre]').val();
                var respuesta_valor=$('body input[name=respuesta_valor]').val();
                if(respuesta_nombre!='' && respuesta_valor!=''){
                    sighAjaxPost({
                        respuesta_id:respuesta_id,
                        respuesta_nombre:respuesta_nombre,
                        respuesta_valor:respuesta_valor,
                        respuesta_action:respuesta_action,
                        pregunta_id:pregunta_id
                    },base_url+'Encuestas/AjaxPreguntasRespuestas',function (response) {
                        location.reload();
                    });
                }else{
                    sighMsjError('TODOS LOS CAMPOS REQUERIDOS')
                }
            }
        })
    })
    var EnsatRespuestas=[];
    var EnsatTotalPreguntas=$('input[name=TotalPreguntas]').val();
    var EnsatTotalRespondidas=0;
    $('body').on('click','.input-encuesta-satisfaccion',function () {
        EnsatTotalRespondidas++;
        var Respuesta=$(this).attr('data-value').split(';');
        var empleado_id=$('input[name=empleado_id]').val();
        EnsatRespuestas.push({
            encuesta_id:Respuesta[0],
            pregunta_id:Respuesta[1],
            respuesta_id:Respuesta[2]
        });
        $('body .col_pregunta'+Respuesta[1]).addClass('hide');
        if (EnsatTotalPreguntas == EnsatTotalRespondidas) {
            
            sighAjaxPost({
                encuesta_id:Respuesta[0],
                EnsatRespuestas:EnsatRespuestas,
                empleado_id:empleado_id
            },base_url+'Encuestas/AjaxResultadoEncuestas',function (response) {
                bootbox.hideAll();
                var socket=io.connect(base_url_server);
                sighAjaxGet(base_url+'Encuestas/AjaxResultadosRealTime',function (response) {
                    bootbox.dialog({
                        closeButton:false,
                        title:'<h3 class="no-margin color-white semi-bold">EVALUACIÓN FINALIZADA</h3>',
                        message:'<div class="row">'+
                                    '<div class="col-md-12 text-center">'+
                                        '<img src="'+base_url+'assets/img/emoji/EMO_2.png" style="width:30%">'+
                                        '<h2 class="line-height">GRACIAS POR RESPONDER ESTA ESCUESTA</h2>'+
                                    '</div>'+
                                '</div>'
                    });
                    setTimeout(function () {
                        location.reload();
                    },5000);
                    var y = window.top.outerHeight / 4 ;
                    $('.modal-dialog').css({
                        'margin-top':y+'px'
                    });
                    socket.emit('EnsatRealTime',response);
                },'No');
            });
        }
    });
    $('body').on('click','.btn-encuesta-evaluacion-end',function (evt) {
        evt.preventDefault();
        var RespuestasEvaluacion=[];
        var empleado_id=$('input[name=empleado_id]').val();
        var PreguntasTotal=$('input[name=TotalPreguntas]').val();
        $('.input-encuesta-evaluacion').each(function (i,e) {
            if($(this).is(':checked')){
                var Respuesta=$(this).attr('data-value').split(';');
                RespuestasEvaluacion.push({
                    encuesta_id:Respuesta[0],
                    pregunta_id:Respuesta[1],
                    respuesta_id:Respuesta[2]
                });
            }
        });
        if(PreguntasTotal==RespuestasEvaluacion.length){
            sighMsjLoading('Guardando resultados de la encuesta...');
            sighAjaxPost({
                encuesta_id:$('input[name=encuesta_id]').val(),
                EnsatRespuestas:RespuestasEvaluacion,
                empleado_id:empleado_id
            },base_url+'Encuestas/AjaxResultadoEncuestas',function (response) {
                sighAjaxGet(base_url+'Encuestas/AjaxResultadosRealTime',function (response) {
                    bootbox.hideAll();
                    bootbox.dialog({
                        closeButton:false,
                        title:'<h3 class="no-margin color-white semi-bold">EVALUACIÓN FINALIZADA</h3>',
                        message:'<div class="row">'+
                                    '<div class="col-md-12 text-center">'+
                                        '<img src="'+base_url+'assets/img/emoji/EMO_2.png" style="width:30%">'+
                                        '<h2 class="line-height">GRACIAS POR RESPONDER ESTA ESCUESTA</h2>'+
                                    '</div>'+
                                '</div>'
                    });
                    
                    var y = window.top.outerHeight / 4 ;
                    $('.modal-dialog').css({
                        'margin-top':y+'px'
                    });
                    socket.emit('EnsatRealTime',response);
                    setTimeout(function () {
                        location.reload();
                    },2000);
                });
            });
        }else{
            sighMsjError('POR FAVOR DE RESPONDER TODAS LAS PREGUNTAS');
        }
    })
    setTimeout(function () {
        launchFullScreen('');
    },2000)
    $('.pantalla-completa').click(function (e) {
        launchFullScreen(document.documentElement);
    });
    launchFullScreen('FullScreen');
    function launchFullScreen(element) {
        $('body .accion-windows').addClass('hide');
        
        if(element.requestFullScreen) {
            element.requestFullScreen();
        } else if(element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if(element.webkitRequestFullScreen) {
            element.webkitRequestFullScreen();
        }
        
    }
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
   $('body .btn-ajax-resultados-ensat').click(function (e) {
       $('.row-result-ensat-loading').removeClass('hide');
        e.preventDefault();
        let inputTurno=$('select[name=inputTurno]').val();
        let inputFecha=$('input[name=inputFecha]').val();
        if(inputTurno!='' && inputFecha!=''){
            SendAjaxPost({
                inputTurno:inputTurno,
                inputFecha:inputFecha,
            },'Encuestas/AjaxResultadosEnsatUrg',function (response) {
                console.log(response)
                $('.row-result-ensat-loading').addClass('hide');
                $('.row-result-ensat-load').removeClass('hide');
                $('.result-ensat-fecha').html('Fecha de encuesta: '+response.EncuestaFecha);
                $('.result-ensat-turno').html('Turno: '+response.EncuestaTurno);
                $('.ensat-total-encuestas').html(response.EncuestaTotal);
                $('body .row-result-ensat').html(response.cols);
            })
        }
    });
    if($('input[name=EnsatRealTime]').val()!=undefined){
        socket.on('EnsatRealTime',function(response) {
            $('.result-ensat-fecha').html('<i class="fa fa-calendar color-imss"></i> FECHA: '+response.EnsatFecha);
            $('.result-ensat-turno').html('<i class="fa fa-clock-o color-imss"></i> TURNO: '+response.EnsatTurno);
            $('.result-ensat-total').html('<i class="fa fa-pencil-square-o color-imss"></i> TOTAL DE ENCUESTAS: '+response.EnsatTotal);
            $('.row-result-ensat-load').html(response.rows);
        });
        sighAjaxGet(base_url+'Encuestas/AjaxResultadosRealTime',function (response) {
            $('.result-ensat-fecha').html('<i class="fa fa-calendar color-imss"></i> FECHA: '+response.EnsatFecha);
            $('.result-ensat-turno').html('<i class="fa fa-clock-o color-imss"></i> TURNO: '+response.EnsatTurno);
            $('.result-ensat-total').html('<i class="fa fa-pencil-square-o color-imss"></i> TOTAL DE ENCUESTAS: '+response.EnsatTotal);
            $('.row-result-ensat-load').html(response.rows);
        },'No')
    }
})