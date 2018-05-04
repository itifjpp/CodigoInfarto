$(document).ready(function (e) {   
    if($('input[name=accion_rol]').val()=='Choque'){
        AjaxCamas();
    }
    function AjaxCamas() {
        $.ajax({
            url: base_url+"Choque/Camasv2/AjaxCamas",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading('Obteniendo información de camas')
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.result_camas=='NO_HAY_CAMAS'){
                    $('.NO_HAY_CAMAS').removeClass('hide')
                }else{
                    $('.result_camas').html(data.result_camas);
                }
                
            },error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    }
    $('body').on('click','.btn-paciente-agregar',function (){
        var cama_id=$(this).data('cama');
        var triage_id=prompt("N° Paciente",$('input[name=triage_id]').val());
        if(triage_id!='' && triage_id!=null){ 
            $.ajax({
                url: base_url+"Choque/Camasv2/AjaxObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    triage_id : triage_id,
                    csrf_token : csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) { 
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        AsociarCama(triage_id,cama_id);
                    }if(data.accion=='2'){
                        if(confirm('EL N° DE PACIENTE NO EXISTE, ¿DESEA AGREGARLO A ESTA ÁREA?')){
                            $.ajax({
                                url: base_url+"Choque/Choquev2/AjaxIngresoChoque",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    triage_id:triage_id,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading('Ingresando paciente a esta área...');
                                },success: function (data, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        AsociarCama(triage_id,cama_id);
                                    }
                                },error: function (e) {
                                    msj_error_serve();
                                    console.log(e);
                                    bootbox.hideAll();
                                    ReportarError(window.location.pathname,e.responseText)
                                }
                            })
                        }
                    }if(data.accion=='3'){
                        msj_error_noti('EL N° DE PACIENTE YA TIENE ASIGNADO UNA CAMA');
                    }if(data.accion=='4'){
                        if(confirm('EL PACIENTE YA FUE DADO DE ALTA DE ESTA ÁREA, ¿DESEA REINGRESAR AL PACIENTE?')){
                            $.ajax({
                                url: base_url+"Choque/Camasv2/AjaxReingreso",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    triage_id:triage_id,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading('Reingresando paciente a esta área...');
                                },success: function (data, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        AsociarCama(triage_id,cama_id);
                                    }
                                },error: function (e) {
                                    msj_error_serve();
                                    console.log(e);
                                    ReportarError(window.location.pathname,e.responseText)
                                }
                            })
                        }
                    }
                },error: function (e) {
                    msj_error_serve(e);
                    bootbox.hideAll();
                }
            }) 
        }
    
    })
    function AsociarCama(triage_id,cama_id) {
        $.ajax({
            url: base_url+"Choque/Camasv2/AjaxAsociarCama",
            type: 'POST',
            data: {
                triage_id:triage_id,
                cama_id:cama_id,
                csrf_token:csrf_token
            },dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading()
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                AjaxCamas();
            },error: function (e) {
                msj_error_serve(e);
                bootbox.hideAll();
            }
        })
    }
    $('body').on('click','.cambiar-cama-paciente',function (e) {
        e.preventDefault();
        e.preventDefault();
        var triage_id=$(this).attr('data-id');
        var area_id=$(this).attr('data-area');
        var cama_id_old=$(this).attr('data-cama');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR EN N° DE CAMA?')){
            $.ajax({
                url: base_url+"Observacion/ObtenerCamas",
                type: 'POST',
                dataType: 'json',
                data:{
                    area_id:area_id,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    bootbox.confirm({
                        title:'<h5>Cambiar Cama</h5>',
                        message:'<div class="row">'+
                                    '<div class="col-md-12">'+
                                        '<div class="form-group">'+
                                            '<label>Seleccionar Cama</label>'+
                                            '<select name="cama_id" class="form-control">'+data.option+'</select>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>',
                        size:'small',
                        callback:function (res) {
                            if(res==true){
                                bootbox.hideAll();
                                $.ajax({
                                    url: base_url+"Choque/Camasv2/AjaxCambiarCama",
                                    type: 'POST',
                                    dataType: 'json',
                                    data:{
                                        triage_id:triage_id,
                                        area_id:area_id,
                                        cama_id_old:cama_id_old,
                                        cama_id_new:$('body select[name=cama_id]').val(),
                                        csrf_token:csrf_token
                                    },beforeSend: function (xhr) {
                                        msj_loading()
                                    },success: function (data, textStatus, jqXHR) {
                                        bootbox.hideAll();
                                        if(data.accion=='1'){
                                            AjaxCamas()
                                        }
                                    },error: function (e) {
                                       bootbox.hideAll();
                                        msj_error_serve(e);
                                        ReportarError(window.location.pathname,e.responseText)
                                    }
                                })
                            }
                        }
                    })
                },error: function (e) {
                    bootbox.hideAll();
                    msj_error_serve(e)
                }
            })
            
        }
    })
    $('body').on('click','.cambiar-enfermera',function () {
        var triage_id=$(this).attr('data-id');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR DE ENFERMERO(A)?')){
            var matricula=prompt('INGRESAR MATRICULA DEL NUEVO ENFERMERO(A)');
            if(matricula!=null && matricula!=''){
                $.ajax({
                    url: base_url+"Choque/Camasv2/AjaxCambiarEnfermera",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        triage_id:triage_id,
                        empleado_matricula:matricula,
                        csrf_token:csrf_token
                    },beforeSend: function (xhr) {
                        msj_loading('Comprobando existencia de matricula, realizando cambio de enfermero(a)')
                    },success: function (data, textStatus, jqXHR) {
                        bootbox.hideAll();
                        if(data.accion=='1'){
                            msj_success_noti('Cambios guardados')
                            AjaxCamas();
                        }if(data.accion=='2'){
                            msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                        }
                    },error: function (e) {
                        msj_error_serve(e)
                        bootbox.hideAll();
                        ReportarError(window.location.pathname,e.responseText)
                    }
                })
            }else{
                msj_error_noti('INGRESAR MATRICULA');
            }
        }
    })
    $('body').on('click','.finalizar-mantenimiento',function(e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?')){
           $.ajax({
                url: base_url+"Observacion/FinalizarLimpiezaMantenimiento",
                type: 'POST',
                dataType: 'json',
                data:{id:el,csrf_token:csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando cambios');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        AjaxCamas()
                    }
                },error: function (e) {
                    msj_error_serve();
                    ReportarError(window.location.pathname,e.responseText)
                }
           })
        }
    })
})