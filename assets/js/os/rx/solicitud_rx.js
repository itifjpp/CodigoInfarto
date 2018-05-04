$(document).ready(function () {
    if($('select[name=solicitud_urgencia]').attr('data-value')!=''){
        $('select[name=solicitud_urgencia]').val($('select[name=solicitud_urgencia]').attr('data-value'));
    }
    
    $('.btn-nuevo-casoclinico').click(function (e) {
        AgregarCasoClinico({
            'casoclinico_id':0,
            'casoclinico_nombre':'',
            'casoclinico_datos':'',
            'triage_id':$('input[name=triage_id]').val(),
            'accion':'add'
        })
    })
    $('body').on('click','.icono-edit-casoclinico',function () {
        AgregarCasoClinico({
            'casoclinico_id':$(this).data('id'),
            'casoclinico_nombre':$(this).data('nombre'),
            'casoclinico_datos':$(this).data('datos'),
            'triage_id':$('input[name=triage_id]').val(),
            'accion':'edit'
        })
    })
    function AgregarCasoClinico(data) {
        bootbox.dialog({
            'title':'<h6>Agregar Caso Clinico</h6>',
            'message':'<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<select class="md-input" id="casoclinico_nombre">'+
                                        '<option value="">Seleccionar Estudio</option>'+
                                        '<option value="CRANEO">CRANEO</option>'+
                                        '<option value="SENOS PARASANALES">SENOS PARASANALES</option>'+
                                        '<option value="ABDOMEN SIMPLE">ABDOMEN SIMPLE</option>'+
                                        '<option value="ESOFAGO ESTOMAGO DUODENO">ESOFAGO ESTOMAGO DUODENO</option>'+
                                        '<option value="COLESISTOGRAFIA">COLESISTOGRAFIA</option>'+
                                        '<option value="COLON POR ENEMA">COLON POR ENEMA</option>'+
                                        '<option value="TORAX P.A">TORAX P.A</option>'+
                                        '<option value="UROGRAFIA EXCRETORA">UROGRAFIA EXCRETORA</option>'+
                                        '<option value="COLUMNA VERTEBRAL">COLUMNA VERTEBRAL</option>'+
                                        '<option value="HUESOS">HUESOS</option>'+
                                        '<option value="OTROS EXAMENES">OTROS EXAMENES</option>'+
                                    '</select>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<textarea class="md-input" rows="3" id="casoclinico_datos" placeholder="Anotar datos Clinicos">'+data.casoclinico_datos+'</textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
            size:'small',
            buttons:{
                guardar:{
                    label:'Guardar',
                    callback:function () {
                        var casoclinico_nombre=$('body #casoclinico_nombre').val();
                        var casoclinico_datos=$('body #casoclinico_datos').val();
                        if(casoclinico_nombre!=''){
                            $.ajax({
                                url: base_url+"consultoriosespecialidad/GuardarCasosClinicos",
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    'casoclinico_id':data.casoclinico_id,
                                    'casoclinico_nombre':casoclinico_nombre,
                                    'casoclinico_datos':casoclinico_datos,
                                    'triage_id':data.triage_id,
                                    'accion':data.accion,
                                    'csrf_token':csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data, textStatus, jqXHR) {
                                    if(data.accion=='1'){
                                        location.reload();
                                    }if(data.accion=='2'){
                                        msj_error_noti('El caso clinico ya existe');
                                        bootbox.hideAll();
                                    }

                                },error: function (jqXHR, textStatus, errorThrown) {
                                    msj_error_serve();
                                    bootbox.hideAll();
                                }
                            })
                        }
                    }
                }
            },onEscape:function () {
                
            }
        })
        $('body #casoclinico_nombre').val(data.casoclinico_nombre);
        $('.modal-header').css('background','#02344A').css('padding','7px');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
    }
    $('body').on('click','.icono-del-casoclinico',function (e) {
        var id=$(this).data('id');
        if(confirm('¿ELIMINAR CASO CLINICO?')){
            $.ajax({
                url: base_url+"consultoriosespecialidad/EliminarCasoClinico/"+id,
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    })
    $('.guardar-solicitud-rx').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"consultoriosespecialidad/guardar_solicitud_rx",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading()
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    if($('input[name=url_accion]').val()!=''){
                        window.open(base_url+'inicio/documentos/Clasificacion_RX/'+$('input[name=triage_id]').val(),'_blank');
                    }else{
                        window.open(base_url+'inicio/documentos/SolicitudRX/'+$('input[name=triage_id]').val(),'_blank');
                    }
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    })
})