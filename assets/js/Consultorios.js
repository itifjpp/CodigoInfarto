$(document).ready(function () {
    if($('input[name=totalListaConsultorio]').val()!=undefined){
        if($('input[name=totalListaConsultorio]').val()>=5){
            $('input[name=ingreso_id]').attr('disabled',true);
            $('.btn-lista-espera').addClass('hide');
        }
    }
    $('body').on('click','.ver-texto',function () {
        sighMsjInformation({
            title:$(this).attr('data-content-title'),
            message:'<div class="col-md-12"><h5 class="line-height no-margin">'+$(this).attr('data-content-text')+'</h5></div>',
            size:'medium'
        });
    });
    
    $('input[name=ingreso_id]').keypress(function (e) {
        var ingreso_id=$(this).val();
        var input=$(this);
        if(e.which==13 && ingreso_id!=''){
            sighMsjLoading();
            sighAjaxPost({
                ingreso_id:ingreso_id
            },base_url+"Consultorios/AjaxObtenerPaciente",function (response) {
                bootbox.hideAll();
                console.log(response);
                if(response.action=='NO_AM'){
                    sighMsjError('DATOS DEL PACIENTE NO CAPTURADOS POR ASISTENTE MÉDICA','small')
                }else if(response.action=='NO_EXISTE_EN_CE'){
                    AjaxAgregarConsultorio(response.paciente);
                }else if(response.action=='NO_ASIGNADO'){
                    AjaxIngresoConsultorio(response.paciente);
                }else if(response.action=='ASIGNADO'){
                    PacienteAgregado(response.paciente,response.ce,response.medico,response.TieneInterconsulta)
                }else if(response.action=='NO EXISTE EL N° DE INGRESO'){
                    sighMsjError('EL N° DE FOLIO INGRESADO NO EXISTE','small');
                }else if(response.action=='DATOS NO ENFERMERA'){
                    sighMsjError('DATOS DEL PACIENTE NO CAPTURADOS POR ENFERMERÍA TRIAGE')
                }else{
                    sighMsjError('ERROR NO ESPECIFICADO','small')
                }
            });
            input.val('');
        }
    });
    function PacienteAgregado(info,ce, medico,TieneInterconsulta) {
        sighMjsConfirm({
            title: "PACIENTE ASIGNADO O DADO DE ALTA",
            message:'<div class="col-md-12 ">'+
                        '<div style="height:10px;width:100%;margin-top:10px" class="'+ObtenerColorClasificacion(info.ingreso_clasificacion)+'"></div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                            '<h3 class="n-t-5 m-b-5"><b>FOLIO:</b> '+info.ingreso_id+'</h3>'+
                            '<h3 class="m-t-5 m-b-5" ><b>PACIENTE:</b> '+info.paciente_nombre+' '+info.paciente_ap+' '+info.paciente_am+'</h3>'+
                            '<h3 class="m-t-5 m-b-5"><b>C. ASIGNADO:</b> '+ce.ce_asignado_consultorio+'</h3>'+
                            '<h3 class="m-t-5 m-b-5"><b>M. ASIGNADO:</b> '+medico.empleado_nombre+' '+medico.empleado_ap+' '+medico.empleado_am+'</h3>'+
                            '<h3 class="m-t-5 m-b-5"><b>INGRESO:</b> '+ce.ce_fe+' '+ce.ce_he+'</h3>'+
                            (ce.ce_status=='Salida' ? '<h3 class="m-t-5 m-b-5"><b>SALIDA:</b> '+ce.ce_fs+' '+ce.ce_hs+'</h3>' : '')+
                            (TieneInterconsulta.length>0 ? '<hr class="no-margin"><h3 class="m-t-5 m-b-5 text-center"><b>ESTE PACIENTE CUENTA CON INTERCONSULTA':'')+
                        '</div>'+
                    '</div>',
            size:'medium',
            lb_accept:'Ver Expediente'
        },function (result) {
            if(result==true){
                window.open(base_url+'Sections/Documentos/Expediente/'+info.ingreso_id+'/?tipo=Consultorios','_blank')
            }
        })
    }
    function AjaxIngresoConsultorio(info) {
        sighMjsConfirm({
            title:'AGREGAR PACIENTE A CONSULTORIO',
            message:'<div class="col-md-12 ">'+
                        '<div style="height:10px;width:100%;margin-top:10px" class="'+ColorClasificacion(info.ingreso_clasificacion)+'"></div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<h3><b>FOLIO:</b> '+info.ingreso_id+'</h3>'+
                        '<h3 style="margin-top:-5px"><b>PACIENTE:</b> '+info.paciente_nombre+' '+info.paciente_ap+' '+info.paciente_am+'</h3>'+
                        '<h3 style="margin-top:-5px"><b>N.S.S:</b> '+info.paciente_nss+' '+info.paciente_nss_agregado+'</h3>'+
                        '<h3 style="margin-top:-5px"><b>DESTINO:</b> '+info.ingreso_consultorio_nombre+'</h3>'+
                    '</div>',
            size:'small',
            lb_accept:'Agregar a Consultorio'
        },function (result) {
            if(result==true){
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id:info.ingreso_id
                },base_url+"Consultorios/AjaxIngresoConsultorioV2",function (response) {
                    bootbox.hideAll();
                    location.reload();
                })
            }
        })
        bootbox.confirm({
            title: "<h5>AGREGAR PACIENTE A CONSULTORIO</h5>",
            message: '<div class="row" style="margin-top:-10px">'+
                        '<div class="col-md-12 ">'+
                            '<div style="height:10px;width:100%;margin-top:10px" class="'+ColorClasificacion(info.triage_color)+'"></div>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h3><b>FOLIO:</b> '+info.triage_id+'</h3>'+
                            '<h3 style="margin-top:-5px"><b>PACIENTE:</b> '+info.triage_nombre+' '+info.triage_nombre_ap+' '+info.triage_nombre_am+'</h3>'+
                            '<h3 style="margin-top:-5px"><b>N.S.S:</b> '+info.triage_paciente_afiliacion+'</h3>'+
                            '<h3 style="margin-top:-5px"><b>DESTINO:</b> '+info.triage_consultorio_nombre+'</h3>'+
                        '</div>'+
                    '</div>'
            ,
            buttons: {
                cancel: {
                    label: 'Cancelar',
                    className: 'back-imss'
                },confirm: {
                    label: 'Agregar a Consultorio',
                    className: 'back-imss'
                }
            },
            callback: function (result) {
                if(result==true){
                    
                }
            }
        });
    }
    function AjaxAgregarConsultorio(info) {
        sighMjsConfirm({
            title:'N° DE PACIENTE NO ENCONTRADO',
            message:'<div class="col-md-12"><h5 class="no-margin text-center line-height">EL N° DE PACIENTE NO ENCONTRADO. ¿DESEA AGREGAR ESTE PACIENTE A ESTE CONSULTORIO?</h5></div>',
            size:'small'
        },function (callback) {
            if(callback==true){
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id:info.ingreso_id
                },base_url+"Consultorios/AjaxAgregarConsultorioV2",function () {
                    bootbox.hideAll();
                    location.reload();
                })
            }else{
                
            }
        });
    }
    $('body').on('click','.ver-detalles-medico',function (evt) {
        var element=$(this);
        sighMsjInformation({
            title:'DETALLES DEL MÉDICO QUE INGRESO',
            message:'<div class="col-xs-3">'+
                        '<img src="'+base_url+'assets/img/perfiles/'+element.attr('data-perfil')+'" class="width100">'+
                    '</div>'+
                    '<div class="col-xs-9" style="padding-left:3px">'+
                        '<h5 class="no-margin semi-bold">'+element.attr('data-nombre')+'</h5>'+
                        '<h6 class="m-t-5 m-b-5">'+element.attr('data-matricula')+'</h6>'+
                    '</div>',
            size:'small'
        })
    })
        
    $('body').on('click','.lista-espera-quitar',function (evt) {
        evt.preventDefault();
        var lista_espera_id=$(this).attr('data-id');
        var ingreso_id=$(this).attr('data-ingreso');
        sighAjaxPost({
            lista_espera_id:lista_espera_id,
            ingreso_id:ingreso_id
        },base_url+'Consultorios/AjaxListaEsperaAsignados',function (response) {
            location.reload();
        });
    });
    /*INDICADORES*/
    $('.dd-mm-yyyy-ce').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        placement: 'bottom'
    });
    $('.clockpicker-ce').clockpicker({
        placement: 'bottom',
        autoclose: true
    });
    $('.btn-indicador-ce').click(function () {
        sighMsjLoading();
        sighAjaxPost({
            inputFechaInicio:$('input[name=inputFechaInicio]').val(),
        },base_url+"Consultorios/AjaxIndicadores",function (response) {
            bootbox.hideAll();
                $('.TOTAL_PACIENTES_CONSULTORIOS_DOC').find('span').html(response.TOTAL_DOCS+' DOCUMENTOS GENERADOS');
                $('.GENERAR_LECHAGA_CONSULTORIOS')
                        .attr('data-inputfecha',$('input[name=inputFechaInicio]').val()).removeClass('hide');
        })
    })
    $('.GENERAR_LECHAGA_CONSULTORIOS').click(function (e) {
        AbrirDocumento(base_url+'Inicio/Documentos/LechugaConsultorios?inputFechaInicio='+$(this).attr('data-inputfecha'),'_blank');
    });
    /*Destinos*/
    $('body').on('click','.btn-add-dest',function (e) {
        e.preventDefault();
        var destino_id=$(this).attr('data-id');
        var destino_nombre_=$(this).attr('data-destino');
        var destino_action=$(this).attr('data-action');
        sighMjsConfirm({
            title:'AGREGAR & EDITAR DESTINO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<input type="text" name="destino_nombre" value="'+destino_nombre_+'" class="form-control" placeholder="Nombre del destino">'+
                        '</div>'+
                    '</div>',
            size:'small',
        },function (cb) {
            if(cb==true){
                var destino_nombre=$('body input[name=destino_nombre]').val();
                if(destino_nombre!=''){
                    sighAjaxPost({
                        destino_id:destino_id,
                        destino_nombre:destino_nombre,
                        destino_accion:destino_action
                    },base_url+"Consultorios/AjaxDestinos",function (response) {
                        msj_success_noti('Dato Guardados');
                        ActionWindowsReload();
                    });     
                }else{
                    sighMsjError('CAMPO REQUERIDO!');
                }
            }
        });
    });
    $('body').on('click','.destino-eliminar',function () {
        var destino_id=$(this).attr('data-id');
        if(confirm('¿ELIMINAR REGISTRO?')){
            sighAjaxPost({
                destino_id:destino_id
            },base_url+"Consultorios/AjaxDestinosEliminar",function (response) {
                var sigh_ok=sighMsjOk('REGISTRO ELIMINADO!');
                setTimeout(function () {
                    sigh_ok.modal('hide');
                    location.reload();
                },1000);
            });
        }
    });
    /*Lista Espera*/
    $('body .btn-lista-espera').click(function (e) {
        e.preventDefault();
        var loading=sighMsjLoading();
        var stop_waiting='No';
        sighAjaxGetv2(base_url+'Consultorios/AjaxListaEspera',function (response) {
            loading.modal('hide');
            console.log(response)
            switch (response.action) {
                case "PACIENTE_EN_ESPERA":
                    sighMsjLoading();
                    sighAjaxPost({
                        lista_espera_id:response.lista_espera_id ,
                        ingreso_id:response.ingreso_id
                    },base_url+'Consultorios/AjaxListaEsperaIngreso',function (cb_ingreso) {
                        sighAjaxPost({
                            ingreso_id:response.ingreso_id
                        },base_url+"Consultorios/AjaxAgregarConsultorioV2",function (cb_ingreso_cb) {
                            bootbox.hideAll();
                            socket.emit('UpdateWaitingList',{
                                action:1
                            });
                            location.href=base_url+'Consultorios?WaitingBtnCall=Si';
                        });
                    });
                    break;
                /*PACIENTE AUSENTE CON EVENTOS DE LLAMADA MAS DE UNA VEZ*/
                case "PACIENTE_AUSENTE":
                    sighMsjLoading();
                    sighAjaxPost({
                        lista_espera_id:response.lista_espera_id ,
                        ingreso_id:response.ingreso_id
                    },base_url+'Consultorios/AjaxListaEsperaIngreso',function (cb_ingreso) {
                        //bootbox.hideAll()
                        sighAjaxPost({
                            ingreso_id:response.ingreso_id
                        },base_url+"Consultorios/AjaxAgregarConsultorioV2",function (cb_ingreso_cb) {
                            bootbox.hideAll();
                            socket.emit('UpdateWaitingList',{
                                action:1
                            });
                            location.href=base_url+'Consultorios?WaitingBtnCall=Si';
                        });
                    });
                    break;
                case "NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA":
                    
                    if(response.ListaEspera==0){
                        sighMsjError("NO HAY PACIENTES EN LA LISTA DE ESPERA");
                        $('body input[name=WaitingBtnCall]').val('Si');
                        stop_waiting='Si';
                    }else{
                        $('body .btn-lista-espera').trigger('click')
                    }
                    break;
            }
            //
        },function (e) {
            sighAjaxGet(base_url+'Consultorios/AjaxResetCounter',function (response) {
                bootbox.hideAll();
                $('body .btn-lista-espera').trigger('click');
            })
        });
        if(stop_waiting=='Si'){
            $('.col-loading-process').addClass('hide');
            $('.col-waiting-btn-call').removeClass('hide');
            var process_waiting=10;
            var my_interval=setInterval(function () {
                process_waiting--;
                if(process_waiting==0){
                    process_waiting=10;
                    clearInterval(my_interval);
                    $('.col-loading-process').removeClass('hide');
                    $('.col-waiting-btn-call').addClass('hide');
                }
                $('.time-waiting-btn').text(process_waiting);
            },1000);
        }
    });
    if($('input[name=WaitingBtnCall]').val()=='Si'){
        $('.col-loading-process').addClass('hide');
        $('.col-waiting-btn-call').removeClass('hide');
        var process_waiting_load=10;
        var my_interval=setInterval(function () {
            process_waiting_load--;
            if(process_waiting_load==0){
                process_waiting_load=10;
                clearInterval(my_interval);
                $('.col-loading-process').removeClass('hide');
                $('.col-waiting-btn-call').addClass('hide');
            }
            $('.time-waiting-btn').text(process_waiting_load);
        },1000);
    }
    
    $('body').on('click','.lista-espera-alta',function (evt) {
        evt.preventDefault();
        var lista_espera_id=$(this).attr('data-id');
        sighMjsConfirm({
            title:'ALTA PACIENTE',
            message:'<div class="col-md-12">'+
                        '<h5 class="no-margin line-height">¿ESTA SEGURO QUE QUIERE DAR DE ALTA ESTE PACIENTE DE LA LISTA DE ESPERA?</h5>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    lista_espera_id:lista_espera_id
                },base_url+'Consultorios/AjaxListaEsperaAlta',function (response) {
                    bootbox.hideAll();
                    location.reload();
                });
            }
        });
    });
    $('body').on('click','.history-aventos-llamada',function (evt) {
        evt.preventDefault();
        sighMsjLoading();
        sighAjaxPost({
            ingreso_id:$(this).attr('data-id')
        },base_url+'Consultorios/AjaxHistorialEventosLlamadas',function (response) {
            bootbox.hideAll();
            sighMsjInformation({
                title:'Eventos de Llamada',
                message:'<div class="col-md-12">'+response.historial+'</div>',
                size:'small'
            });    
        });
    });
    /*DEPURACIÓN DE LA CODIFICACION DE CONSULTORIOS 01-04-2018 07:13*/
    $('body').on('click','.consultorios-altapaciente',function (evt) {
        evt.preventDefault();
        var ce_id=$(this).attr('data-consultorio');
        var ingreso_id=$(this).attr('data-ingreso');
        sighMjsConfirm({
            title:'DESTINO DE ALTA DEL PACIENTE',
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<select name="ce_alta" class="width100">'+
                                '<option value="">SELECCIONAR...</option>'+
                                '<option value="ENVIAR AL CORTA ESTANCIA">ENVIAR AL CORTA ESTANCIA</option>'+
                                '<option value="ENVIAR A OBSERVACIÓN">ENVIAR A OBSERVACIÓN</option>'+
                                '<option value="ALTA POR AUSENCIA">NO SE PRESENTO(AUSENTE-ESPERA)</option>'+
                                '<option value="ALTA PACIENTE DE CONSULTORIOS">ALTA DEL HOSPITAL(PACIENTE EGRESA)</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var ce_alta=$('body select[name=ce_alta]').val();
                if(ce_alta!=''){
                    sighMsjLoading();
                    sighAjaxPost({
                        ce_alta:ce_alta,
                        ce_id:ce_id,
                        ingreso_id:ingreso_id
                    },base_url+'Consultorios/AjaxConsAltaPaciente',function (response) {
                        bootbox.hideAll();
                        switch (response.action) {
                            case 0:
                                sighMsjError("ERROR NO ESPECIFICADO");
                                break;
                            case 1:
                                location.reload();
                                break;
                        }
                    });
                }else{
                    sighMsjError("DESTINO NO VÁLIDO");
                }
            }
        });
    });
    $('.form-indicador-lista-espera select[name=inputFilter]').click(function () {
        if($(this).val()=='POR_TURNOS'){
            $('.input-filter-turnos').removeClass('hide');
            $('.input-filter-fechas').addClass('hide');
        }else{
            $('.input-filter-turnos').addClass('hide');
            $('.input-filter-fechas').removeClass('hide');
        }
    });
    $('.form-indicador-lista-espera').submit(function (evt) {
        evt.preventDefault();
        var inputFilter=$('select[name=inputFilter]').val();
        var inputDateStart=$('input[name=inputDateStart]').val();
        var inputDateEnd=$('input[name=inputDateEnd]').val();
        var inputTurno=$('select[name=inputTurno]').val();
        sighMsjLoading();
        sighAjaxPost({
            inputFilter:inputFilter,
            inputDateStart:inputDateStart,
            inputDateEnd:inputDateEnd,
            inputTurno:inputTurno
        },base_url+'Consultorios/AjaxListaEsperaIndicadores',function (response) {
            bootbox.hideAll();
            $('.row-rs-indicador').html(response.consultorios);
        });
    });
    $('body').on('click','.btn-ce-lista-espera-alta-all',function (evt) {
        evt.preventDefault();
        if(confirm("¿DAR DE ALTA A TODOS LOS PACIENTES EN LISTA DE ESPERA?")){
            sighMsjLoading();
            sighAjaxGet(base_url+'Consultorios/AjaxListaEsperaAltaAll',function (response) {
                bootbox.hideAll();
                location.reload();
            });
        }
    });
    $('body').on('click','.consultorios-llamar-paciente',function (e) {
        $('body .consultorios-llamar-paciente').hide();
        msj_success_noti('LLamando paciente en pantalla...');
        var ArtyomPaciente=$(this).attr('data-artyompaciente');
        socket.emit('CallPatientOnScreen',{
            ArtyomPaciente:ArtyomPaciente
        });
    });
    socket.on('CallPatientOnScreenReady',function (data) {
        $('body .consultorios-llamar-paciente').show();
    })
    $('body').on('click','.btn-indicador-ce-personal',function () {
        var inputDateStart=$('input[name=inputDateStart]').val();
        var inputDateEnd=$('input[name=inputDateEnd]').val();
        if(inputDateStart!='' && inputDateEnd!=''){
            diffBetweenDatesMomentJS(inputDateEnd,inputDateStart,function (cb) {
                if(cb.months<=1){
                    sighMsjLoading();
                    sighAjaxPost({
                        inputDateStart:inputDateStart,
                        inputDateEnd:inputDateEnd
                    },base_url+'Consultorios/AjaxIndicadorPersonal',function (response) {
                        bootbox.hideAll();
                        $('.ce-total-ingresados').html(response.total+" INGRESADOS");
                    });    
                }else{
                    msj_error_noti("EL RANGO DE FECHA NO DEBE SUPERAR A MAS DE UN MES")
                }
            });

        }else{
            msj_error_noti("TODOS LOS CAMPOS SON REQUERIDOS");
        }
    });
    socket.on('UpdateWaitingList',function (data) {
        sighAjaxGet(base_url+'Consultorios/AjaxListaEsperaTotal',function (response) {
            $('.ce-lista-espera-total').text(response.TotalEspera);
        });
    });
    if($('input[name=AjaxPacientesEnEspera]').val()!=undefined){
        sighMsjLoading('Actualizando lista de espera de pacientes...');
        sighAjaxGet(base_url+'Sections/Listas/AjaxPacientesEnEsperaConsultorios',function (response) {
            bootbox.hideAll();
            $('.lista-pacientes-espera tbody').html(response.tr);
            $('.h4-le-total').html(response.le_total);
            $('.h4-turno-amarillo').text(response.le_turno_amarillo);
            $('.h4-turno-verde').text(response.le_turno_verde);
            $('.h4-turno-azul').text(response.le_turno_azul);
            InicializeFootable('.lista-pacientes-espera');
        });
    }
    $('body').on('click','.consultorios-agregar-paciente-manual',function (evt) {
        evt.preventDefault();
        var ingreso_id=$(this).attr('data-id');
        sighMjsConfirm({
            title:'INGRESO DE PACIENTE',
            message:'<div class="col-md-12">'+
                        '<h5 class="no-margin line-height">¿ESTA SEGURO DE QUE DESEA INGRESAR ESTE PACIENTE A CONSULTORIOS?</h5>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id:ingreso_id
                },base_url+"Consultorios/AjaxAgregarConsultorioV2",function (response) {
                    socket.emit('UpdateWaitingList',{
                        action:1
                    });
                    bootbox.hideAll();
                    window.location.href=base_url+'Consultorios';
                })
            }
        })
    })
});