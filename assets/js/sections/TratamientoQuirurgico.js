$(document).ready(function () {
    $('.solicitud-transfucion').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxSolicitudTransfusion",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    ActionCloseWindowsReload();
                    AbrirDocumento(base_url+'inicio/documentos/SolicitudServicioTransfusion/'+$('input[name=tratamiento_id]').val()+'/?folio='+$('input[name=triage_id]').val());
                    
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    
    $('input[name=solicitudtransfucion_sangre][value="'+$('input[name=solicitudtransfucion_sangre]').data('value')+'"]').prop("checked",true);
    $('input[name=solicitudtransfucion_plasma][value="'+$('input[name=solicitudtransfucion_plasma]').data('value')+'"]').prop("checked",true);
    $('input[name=solicitudtransfucion_suspensionconcentrada][value="'+$('input[name=solicitudtransfucion_suspensionconcentrada]').data('value')+'"]').prop("checked",true);
    
    $('input[name=solicitudtransfucion_otros][value="'+$('input[name=solicitudtransfucion_otros]').data('value')+'"]').prop("checked",true);
    $('input[name=solicitudtransfucion_ordinaria][value="'+$('input[name=solicitudtransfucion_ordinaria]').data('value')+'"]').prop("checked",true);
    $('input[name=solicitudtransfucion_urgente][value="'+$('input[name=solicitudtransfucion_urgente]').data('value')+'"]').prop("checked",true);
    $('input[name=solicitudtransfucion_gs_ignora][value="'+$('input[name=solicitudtransfucion_gs_ignora]').data('value')+'"]').prop("checked",true);
    
    $('.cirugia-segura').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxCirugiaSegura",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    ActionCloseWindowsReload();
                    AbrirDocumento(base_url+'inicio/documentos/CirugiaSegura/'+$('input[name=tratamiento_id]').val()+'/?folio='+$('input[name=triage_id]').val());
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    
    $('.solicitud-intervencion').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxSolicitudeIntervencion",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    ActionCloseWindowsReload();
                    AbrirDocumento(base_url+'inicio/documentos/SolicitudIntervencionQuirurgica/'+$('input[name=tratamiento_id]').val()+'/?folio='+$('input[name=triage_id]').val());
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('select[name=ci_prioridad]').val($('select[name=ci_prioridad]').attr('data-value'));
    $('select[name=ci_ap]').val($('select[name=ci_ap]').attr('data-value'));
    $('select[name=ci_operacion_eu]').val($('select[name=ci_operacion_eu]').attr('data-value'));
    
    $('.cci').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxConsentimientoInformado",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    ActionCloseWindowsReload();
                    AbrirDocumento(base_url+'inicio/documentos/CartaConsentimientoInformado/'+$('input[name=tratamiento_id]').val()+'/?folio='+$('input[name=triage_id]').val());
                    
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('input[name=cci_caracter][value="'+$('input[name=cci_caracter]').data('value')+'"]').prop("checked",true);
    $('input[name=cci_tipo_ct][value="'+$('input[name=cci_tipo_ct]').data('value')+'"]').prop("checked",true);
    
    $('.isq').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxListaVerificacionISQ",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    ActionCloseWindowsReload();
                    AbrirDocumento(base_url+'inicio/documentos/ISQ/'+$('input[name=tratamiento_id]').val()+'/?folio='+$('input[name=triage_id]').val());
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('input[name=isq_turno][value="'+$('input[name=isq_turno]').data('value')+'"]').prop("checked",true);
    
    $('.btn-add-tratamiento-quirurgico').click(function (e) {
        AgregarTratamiento({
            tratamiento_id:0,
            tratamiento_nombre:'',
            triage_id:$(this).attr('data-triage-id'),
            accion:'add'
        })
    })
    $('body').on('click','.icono-editar-tratamiento',function (e) {
        AgregarTratamiento({
            tratamiento_id:$(this).attr('data-tratamiento_id'),
            tratamiento_nombre:$(this).attr('data-tratamiento_nombre'),
            triage_id:$(this).attr('data-triage_id'),
            accion:'edit'
        })
    })
    function AgregarTratamiento(info) {
        var tratamiento_nombre=prompt('NOMBRE DEL TRATAMIENTO QUIRÚRGICO',info.tratamiento_nombre);
        if(tratamiento_nombre!='' && tratamiento_nombre!=null){
            $.ajax({
                url: base_url+"Sections/Documentos/AjaxTratamientosQuirurgicos",
                type: 'POST',
                dataType: 'json',
                data:{
                    tratamiento_id:info.tratamiento_id,
                    tratamiento_nombre:tratamiento_nombre,
                    triage_id:info.triage_id,
                    accion:info.accion,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (e) {
                    msj_error_serve();
                    console.log(e);
                    bootbox.hideAll();
                }
            })
        }
    }
})