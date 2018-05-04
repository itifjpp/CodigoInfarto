$(document).ready(function () {
    $('.actualizar-camas-pisos').click(function (e) {
        e.preventDefault();
        AjaxCamas();
    })
    if($('input[name=RealizarAjax]').val()!=undefined){
        AjaxCamas();
    }
    function AjaxCamas() {
        sighMsjLoading();
        sighAjaxGet(base_url+"Pisos/Enfermeria/AjaxCamas",function (response) {
            bootbox.hideAll();
            $('.result_camas').html(response.result_camas); 
        });
    }
    $('body').on('click','.btn-paciente-agregar',function (){
        var cama_id=$(this).data('cama');
        var area_id=$(this).attr('data-area');
        sighMjsConfirm({
            title:'INGRESAR N° DE PACIENTE',
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<input type="number" name="ingreso_id" class="form-control">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var ingreso_id=$('body input[name=ingreso_id]').val();
                if(ingreso_id!=''){
                    var info={
                        ingreso_id:ingreso_id,
                        cama_id:cama_id,
                        area_id:area_id,
                    };
                    sighAjaxPost(info,base_url+'Pisos/Enfermeria/AjaxObtenerPaciente',function (response) {
                        switch (response.action) { 
                            case "NO_EXISTE_EN_PISOS":
                                AjaxIngresoPacientePisos(info);
                                break;
                            case "EN_PISOS":
                                AjaxPacienteEnPisos(info);
                                break;
                            case "ALTA_DE_PISOS":
                                AjaxReingresoAPisos(info);
                                break;
                            }
                    });
                }    
            }
        })
    });
    $('body').on('click','.ingreso-paciente-quirofano',function () {
        var info={
            triage_id:$(this).attr('data-triage'),
            cama_id:$(this).attr('data-cama'),
            area_id:$(this).attr('data-area'),
        }
        _msjConfirm({
            message:'<div class="col-md-12">'+
                        '<h6 style="line-height:1.6">EL PACIENTE FUE ENVIADO A QUIROFANO ¿DESEA REINGRESAR ESTE PACIENTE AL ÁREA DE PISOS?</h6>'+
                    '</div>',
            size:'small'
        },function (resul) {
            if(resul==true){
                AjaxIngresoPacientePisos(info)
            }
        });
    })
    /*AGREGAR EL PACIENTE POR PRIMERA VEZ A PISOS*/
    function AjaxIngresoPacientePisos(info) {
        var empleado_matricula=prompt("CONFIRMACIÓN DE MATRICULA REQUERIDA");
        if(empleado_matricula!=null && empleado_matricula!=''){
            AjaxBuscarEmpleado(function (response) {
                if(response.accion=='1'){
                    sighMsjLoading('Ingresando paciente a pisos...')
                    sighAjaxPost({
                        ingreso_id:info.ingreso_id,
                        area_id:info.area_id,
                        cama_id:info.cama_id,
                        empleado_id:response.empleado_id,
                    },base_url+"Pisos/Enfermeria/AjaxIngresoPacientePisos",function (response) {
                        bootbox.hideAll();
                        AjaxCamas();
                    })                    
                }
            },empleado_matricula)
        }else{
            msj_success_noti('CONFIRMACIÓN DE MATRICULA REQUERIDA')
        }
    }
    function AjaxReingresoAPisos(info) {
        if(confirm('EL PACIENTE YA FUE DADO DE ALTA DE PISOS ¿DESEA REINGRESAR ESTE PACIENTE NUEVAMENTE?')){
            AjaxIngresoPacientePisos(info)
        }
    }
    function AjaxPacienteEnPisos(info) {
        SendAjax(info,"Pisos/Enfermeria/AjaxBuscarPacienteAreas",function (response) {
            bootbox.confirm({
                title:'<h5>ERROR AL ASIGNAR CAMA</h5>',
                message:'<div class="row">'+
                            '<div class="col-md-12" style="margin-top:-6px">'+
                                '<h4 style="text-transform:uppercase"><b>PACIENTE: </b>'+response.sqlPaciente.triage_nombre_ap+' '+response.sqlPaciente.triage_nombre_am+' '+response.sqlPaciente.triage_nombre+'</h4>'+
                            '</div>'+
                            '<div class="col-md-6" style="margin-top:-6px">'+
                                '<h4 style="text-transform:uppercase"><b>CAMA ASIGNADA: </b>'+response.sqlArea.cama_nombre+'</h4>'+
                            '</div>'+
                            '<div class="col-md-6" style="margin-top:-6px">'+
                                '<h4 style="text-transform:uppercase"><b>INGRESO: </b>'+response.sqlArea.ap_f_ingreso+' '+response.sqlArea.ap_h_ingreso+'</h4>'+
                            '</div>'+
                            '<div class="col-md-12" style="margin-top:-6px"><hr></div>'+
                            '<div class="col-md-6" style="margin-top:-6px">'+
                                '<h4 style="textE-transform:uppercase"><b>CAMA: </b>'+response.sqlCama.cama_nombre+'</h4>'+
                            '</div>'+
                            '<div class="col-md-6" style="margin-top:-6px">'+
                                '<h4 style="text-transform:uppercase"><b>ESTADO: </b>'+response.sqlCama.cama_status+'</h4>'+
                            '</div>'+
                            '<div class="col-md-12" style="margin-top:-6px">'+
                                '<h6 style="text-transform:uppercase">'+(response.sqlCama.cama_status=='Asignado' ? '<b style="color:red;">LA CAMA ACTUALMENTE TIENE UNA ASIGNACIÓN DE PACIENTE SOLICITADO POR ADMISIÓN HOSPITALARIA</b>' :'')+'</h6>'+
                            '</div>'+
                        '</div>',
                buttons:{
                    cancel:{
                        label:'Cancelar',
                        className:'btn-imss-cancel'
                    },confirm:{
                        label:'Forzar Ingreso',
                        className:'back-imss'
                    }
                },callback:function (res) {
                    if(res==true){
                        if(confirm('¿ESTA SEGURO QUE DESEA FORZAR EL INGRESO DE ESTA PACIENTE EN ESTA CAMA?')){
                            AjaxForzarIngreso({
                                triage_id:info.triage_id,
                                area_id:info.area_id,
                                cama_id:info.cama_id,
                                cama_id_old:response.sqlArea.cama_id, 
                                cama_status_old:response.sqlArea.cama_status
                            });
                        }
                    }
                }
            })
        })
    }
    function AjaxForzarIngreso(info) {
        var empleado_matricula=prompt("CONFIRMACIÓN DE MATRICULA REQUERIDA");
        if(empleado_matricula!=null && empleado_matricula!=''){
            AjaxBuscarEmpleado(function (response) {
                if(response.accion=='1'){
                    SendAjax({
                        triage_id:info.triage_id,
                        cama_id:info.cama_id,
                        cama_id_old:info.cama_id_old,
                        cama_status_old:info.cama_status_old,
                        area:info.area_id,
                        csrf_token:csrf_token
                    },"Pisos/Enfermeria/AjaxForzarIngreso",function (response) {
                        if(response.accion=='1'){
                            AjaxCamas();
                            msj_success_noti('Asignación de cama realizado correctamente');
                        }
                    },'Forzando ingreso del paciente a cama de pisos.....')
                }
            },empleado_matricula)
        }else{
            msj_success_noti('CONFIRMACIÓN DE MATRICULA REQUERIDA')
        }
    }
    $('body').on('click','.cambiar-cama-paciente',function (e) {
        e.preventDefault();
        e.preventDefault();
        var triage_id=$(this).attr('data-id');
        var area_id=$(this).attr('data-area');
        var cama_id_old=$(this).attr('data-cama');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR EN N° DE CAMA?')){
            SendAjax({
                area_id:area_id,
                csrf_token:csrf_token
            },"Pisos/Enfermeria/AjaxObtenerCamas",function (response) {
                bootbox.confirm({
                    title:'<h5>Cambiar Cama</h5>',
                    message:'<div class="row">'+
                                '<div class="col-md-12">'+
                                    '<div class="form-group">'+
                                        '<label>Seleccionar Cama</label>'+
                                        '<select name="cama_id" class="form-control">'+response.option+'</select>'+
                                    '</div>'+
                                '</div>'+
                            '</div>',
                    size:'small',
                    callback:function (res) {
                        if(res==true){
                            bootbox.hideAll();
                            SendAjax({
                                triage_id:triage_id,
                                area_id:area_id,
                                cama_id_old:cama_id_old,
                                cama_id_new:$('body select[name=cama_id]').val(),
                                csrf_token:csrf_token
                            },"Pisos/Enfermeria/AjaxCambiarCama",function (response) {
                                if(response.accion=='1'){
                                    AjaxCamas()
                                }
                            })
                        }
                    }
                })
            })     
        }
    })
    $('body').on('click','.cambiar-enfermera',function () {
        var triage_id=$(this).attr('data-id');
        var area_id=$(this).attr('data-area');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR DE ENFERMERO(A)?')){
            var matricula=prompt('INGRESAR MATRICULA DEL NUEVO ENFERMERO(A)');
            if(matricula!=null && matricula!=''){
                SendAjax({
                    area_id:area_id,
                    triage_id:triage_id,
                    empleado_matricula:matricula,
                    csrf_token:csrf_token
                },'Pisos/Enfermeria/AjaxCambiarEnfermera',function (response) {
                    if(response.accion=='1'){
                        msj_success_noti('Cambios guardados')
                        AjaxCamas();
                    }if(response.accion=='2'){
                        msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                    }
                },'Comprobando existencia de matricula, realizando cambio de enfermero(a)')
            }else{
                msj_error_noti('INGRESAR MATRICULA');
            }
        }
    })
    $('body').on('click','.add-tarjeta-identificacion',function (e) {
        e.preventDefault();
        AbrirVista(base_url+'Sections/Documentos/TarjetaDeIdentificacion/'+$(this).attr('data-id'),500,400)
        
    });
    $('.form-tarjeta-identificacion').submit(function (e) {
        e.preventDefault();
        SendAjax($(this).serialize(),'Sections/Documentos/AjaxTarjetaDeIdentificacion',function (response) {
            if(response.accion=='1'){
                AbrirDocumentoMultiple(base_url+'Inicio/Documentos/TarjetaDeIdentificacionAreas/'+$('input[name=triage_id]').val()+'/?area=0','Tarjeta de Identificacion');
                window.top.close();
            }
        },'');
    });
    $('body').on('click','.alta-paciente',function (e){
        var triage_id=$(this).data('triage');
        var cama_id=$(this).data('cama');
        var area_id=$(this).data('area');
        bootbox.confirm({
            title: '<h5>SELECCIONAR DESTINO</h5>',
            message:'<div class="row ">'+
                        '<div class="col-sm-12">'+
                            '<select name="ap_alta" class="form-control">'+
                                '<option value="Alta a domicilio">Alta a domicilio</option>'+
                                '<option value="Alta e ingreso quirófano">Alta e ingreso quirófano</option>'+
                                '<option value="Alta e ingreso a hospitalización">Alta e ingreso a hospitalización</option>'+
                                '<option value="Alta e ingreso a UCI">Alta e ingreso a UCI</option>'+
                                '<option value="Alta e ingreso a Observación">Alta e ingreso a Observación</option>'+
                                '<option value="Alta y Translado">Alta y Translado</option>'+
                                '<option value="Alta por Defunción">Alta por Defunció</option>'+
                                '<option value="Alta Voluntaria">Alta Voluntaria</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-sm-12" style="margin-top:5px">'+
                            '<input name="log_obs" class="form-control" placeholder="Observaciónes">'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons: {
                cancel: {
                    label: "Cancelar",
                    className: "btn-imss-cancel"
                },confirm:{
                    label: "Dar de alta al paciente",
                    className: "back-imss",
                }
            },callback:function (res) {
                if(res==true){
                    SendAjax({
                        area_id:area_id,
                        ap_alta:$('body select[name=ap_alta]').val(),
                        log_obs:$('body input[name=log_obs]').val(),
                        cama_id:cama_id,
                        triage_id:triage_id,
                        csrf_token:csrf_token
                    },"Pisos/Enfermeria/AjaxAltaPaciente",function (response) {
                         AjaxCamas();
                    })
                }
            }
        });
    })
    $('body').on('click','.finalizar-mantenimiento',function(e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?')){
            SendAjax({id:el,csrf_token:csrf_token},"Observacion/FinalizarLimpiezaMantenimiento",function(response) {
                AjaxCamas()
            });
        }
    })
    $('body').on('click','.btn-paciente-reingreso',function (e) {
        e.preventDefault();
        var triage_id=$(this).attr('data-id');
        var cama_id=$(this).attr('data-cama');
        if(confirm('¿DESEA REINGRESAR ESTE PACIENTE?')){
            SendAjax({
                triage_id:triage_id,
                cama_id:cama_id,
                csrf_token:csrf_token
            },"Pisos/Enfermeria/AjaxReingresoPisos",function (response) {
                AjaxCamas();
            },'Reingresado paciente al área de pisos...')
        }
    })
    /*Cambiar Área*/
    $('body').on('click','.cambiar-area',function () {
        var ap_id=$(this).attr('data-id');
        $.ajax({
            url: base_url+"Pisos/Enfermeria/AjaxObtenerAreas",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                bootbox.confirm({
                    title:'<h5>Seleccionar Área</h5>',
                    message:'<div class="row">'+
                                '<div class="col-xs-12">'+
                                    '<div class="form-group">'+
                                        '<select class="form-control" name="ap_area">'+data.option+'</select>'+
                                    '</div>'+
                                '</div>'+
                            '</div>',
                    size:'small',
                    callback:function (res) {
                        if(res==true){
                            var area_id=$('body select[name=ap_area]').val();
                            SendAjax({
                                ap_id:ap_id,
                                area_id:area_id,
                                csrf_token:csrf_token
                            },"Areas/Enfermeria/AjaxCambiarArea",function (response) {
                                AjaxCamas();
                            })
                        }
                    }
                })
            },error: function (e) {
                msj_error_serve();
                console.log(e)
            }
            
        })
    })
    $('body').on('click','.reportar-cama-descompuesta',function (e) {
        e.preventDefault();
        var cama_id=$(this).attr('data-cama');
        var triage_id=$(this).attr('data-id');
        if(confirm('¿DESEA REPORTAR ESTA CAMA COMO DESCOMPUESTA?')){
            SendAjax({
                cama_id:cama_id,
                triage_id:triage_id,
                csrf_token:csrf_token
            },"Pisos/Enfermeria/AjaxReportarDescompuesta",function (response) {
                AjaxCamas()
            })
        }
    })
    $('body').on('click','.mensaje-cama-decompuesta',function (e) {
        MsjNotificacion('<h5>Cama Descompuesta</h5>','<h5 style="line-height: 1.4;">Actualmente esta cama se encuentra en mantenimiento y/o limpieza al haber sido reportado como descompuesta</h5>')
    })
    $('body').on('click','.envio-qrirofano',function (e) {
        MsjNotificacion('<h5>ENVIADO A QUIRÓFANO</h5>','<h5 style="line-height: 1.4;">ESTATUS DE LA CAMA EN ESPERA POR QUE EL PACIENTE FUE ENVIADO A QUIRÓFANO</h5>')
    });
    
    $('body').on('click','.btn-paciente-agregar-ah',function (e) {
        e.preventDefault();
        var ingreso_id=prompt('INGRESAR N° DE PACIENTE','');
        var cama_id=$(this).attr('data-cama');
        var ap_area=$(this).attr('data-area');
        var ingreso_id_old=$(this).attr('data-ingreso');
        var cama_estatus=$(this).attr('data-status');
        if(ingreso_id!=null && ingreso_id!=''){
            sighAjaxPost({
                ingreso_id_old:ingreso_id_old,
                ingreso_id:ingreso_id,
                cama_id:cama_id,
            },base_url+"Pisos/Enfermeria/AjaxCheckAsignacionCama",function (response) {
                bootbox.hideAll();
                if(response.accion=='1'){
                    var ap_origen=prompt('ESPECIFICAR ORIGEN DE ENVÍO:','')
                    if(ap_origen!=null && ap_origen!=''){
                        AjaxIngresoPacienteAdmision({
                            ac_estatus:'Asignado',
                            cama_estatus:cama_estatus,
                            cama_id:cama_id,
                            ap_area:ap_area,
                            ingreso_id:ingreso_id,
                            ingreso_id_old:ingreso_id_old,
                            ap_origen:ap_origen
                        });
                    }else{
                        msj_error_noti('ESPECIFICAR ORIGEN DE ENVÍO');
                    }
                }if(response.accion=='2'){
                    if(confirm('EL N° DE PACIENTE NO CORRESPONDE A LA SOLICITUD DE CAMA REALIZADO ANTERIORMENTE EN ADMISIÓN HOSPITALARIA.\n\n¿DESEA ASIGNAR ESTE PACIENTE A ESTA CAMA?')){
                        AjaxIngresoPacienteAdmision({
                            ac_estatus:'No Asignado',
                            cama_estatus:cama_estatus,
                            cama_id:cama_id,
                            ap_area:ap_area,
                            triage_id:triage_id,
                            triage_id_old:triage_id_old,
                            ap_origen:ap_origen,
                            csrf_token:csrf_token
                        });
                    }
                }if(response.accion=='3'){
                    msj_error_noti('EL PACIENTE YA TIENE ASIGNADO UNA CAMA O YA FUE DADO DE ALTA')
                };
            })
        }
    });
    function AjaxIngresoPacienteAdmision(info) {
        SendAjax(info,"Pisos/Enfermeria/AjaxIngresoPacienteAdmision",function (response) {
            AjaxCamas();
        });
    }
    /*ELIMINAR EL PACIENTE EN EL AREA DE PSISO PARA SU POSTERIOR INGRESO*/
    $('body').on('click','.eliminar-paciente-pisos',function () {
        bootbox.prompt({
                title: "<h5>Confirmación de matricula</h5>",
                inputType: 'password',
                size:'small',
                callback: function (result) {
                    if(result!='' && result!=null){
                        AjaxBuscarEmpleado(function (response) {
                            if(response.accion=='1'){
                                if(confirm('EN CASO DE TENER PROBLEMA AL INGRESAR UN PACIENTE AL ÁREA DE PISOS, ESTA OPCIÓN PERMITE ELIMINAR EL PACIENTE PARA SU POSTERIOR INGRESO\n\n¿ELIMINAR REGISTRO DEL PACIENTE EN EL ÁREA DE PISOS?')){
                                    var triage_id=prompt('INGRESAR N° DE PACIENTE','');
                                    if(triage_id!='' && triage_id!=null){
                                        SendAjax({triage_id:triage_id,csrf_token:csrf_token},'Pisos/Enfermeria/AjaxEliminarPaciente',function (response) {
                                            if(response.accion=='1'){
                                                msj_success_noti('ACCCIÓN REALIZADO CORRECTAMENTE');
                                                AjaxCamas();
                                            }
                                        })
                                    }else{
                                        msj_error_noti('INGRESAR N° DE PACIENTE');
                                    }
                                } 
                            }else{
                                msj_error_noti('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCIÓN')
                            }
                        },result)
                    }else{
                        msj_error_noti('CONFIRMACIÓN DE MATRICULA REQUERIDA');
                    }
                }
            });
    });
    $('.btn-pisos-indicador-ie').click(function () {
        var inputFecha=$('input[name=inputFecha]').val();
        var inputTurno=$('select[name=inputTurno]').val();
        SendAjaxPost({
            inputFecha:inputFecha,
            inputTurno:inputTurno,
            csrf_token:csrf_token
        },'Pisos/Enfermeria/AjaxIndicador',function (response) {
            $('.col-pisos-ingresos a h3').html(response.Ingreso+' PACIENTES');
            $('.col-pisos-ingresos a').attr('href',base_url+'Inicio/Documentos/IndicadoresPisos?inputFecha='+inputFecha+'&inputTurno='+inputTurno+'&inputTipo=Ingreso').attr('target','_blank');
            $('.col-pisos-egresos a h3').html(response.Egreso+' PACIENTES');
            $('.col-pisos-egresos a').attr('href',base_url+'Inicio/Documentos/IndicadoresPisos?inputFecha='+inputFecha+'&inputTurno='+inputTurno+'&inputTipo=Egreso').attr('target','_blank');
        });
    });
});