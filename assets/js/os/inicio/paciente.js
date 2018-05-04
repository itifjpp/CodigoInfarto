$(document).ready(function (){
    $('.buscar_paciente').focus();
    $('body .buscar_paciente').keyup(function (e){
        e.preventDefault();
        var input=$(this);
        if(input.val().length==11 && input.val()!=''){
            $.ajax({
                url: base_url+"inicio/pacientes/ObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data:{
                    'triage_id':input.val(),
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='2' && input.val()!=''){
                        msj_error_noti('EL N° PACIENTE NO EXISTE')
                    }if(data.accion=='1' && input.val()!=''){
                        window.open(base_url+'inicio/pacientes/paciente?folio='+input.val(),'_blank')
                    }
                    input.val('');
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    })
    $('input[name=buscar_por]').click(function (e){
        if($(this).val()=='Nombre'){
            $('.row-paciente-por-nombre').removeClass('hide');
            $('.row-paciente-por-numero').addClass('hide');
        }else{
            $('.row-paciente-por-numero').removeClass('hide');
            $('.row-paciente-por-nombre').addClass('hide');
        }
    })
    $('.btn-buscar-paciente').click(function (e){
        var nombre=$('.buscar_paciente_nombre').val();
        if(nombre!=''){
            $.ajax({
                url: base_url+"inicio/pacientes/BuscarPorNombre",
                type: 'POST',
                dataType: 'json',
                data:{
                    'nombre':nombre,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        $('.table-pacientes-nombre tbody').html(data.tr);
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    });
    $('.triage-enfermeria').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"inicio/pacientes/EditarTriageEnfermeria",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Datos Guardados');
                    window.opener.location.reload();
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    })
    $('.asistentes-medicas').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"inicio/pacientes/EditarAsistentesMedicas",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Datos Guardados');
                    window.opener.location.reload();
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('.consultorios-general').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"inicio/pacientes/EditarConsultorios",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Datos Guardados');
                    window.opener.location.reload();
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    })
    $('.consultorios-cpr').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"inicio/pacientes/EditarConsultoriosCpr",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Datos Guardados');
                    window.opener.location.reload();
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('body').on('click','.link-cambiar-destino',function (e) {
        var destino_nombre=$(this).data('destino-nombre');
        var triage_id=$(this).data('triage');
        e.preventDefault();
        bootbox.dialog({
            title: '<h5>CAMBIAR DESTINO</h5>',
            message:'<div class="row ">'+
                        '<div class="col-sm-12">'+
                            '<select class="form-control" id="cambiar_destino">'+
                                '<option value="Choque">Choque</option>'+
                                '<option value="Observación">Observación</option>'+
                                '<option value="Filtro">Filtro</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>',
            buttons: {
                Cancelar: {
                    label: "Cancelar",
                    className: "btn btn-fw green waves-effect",
                    callback:function(){}
                },Aceptar: {
                    label: "Aceptar",
                    className: "btn btn-fw btn-danger waves-effect",
                    callback:function(){
                        if(confirm('ESTA SEGURO QUE DESEA CAMBIAR EL DESTINO DE ESTE PACIENTE, AL HACER SE ELIMINARA DEL DESTINO ACTUAL Y LOS DATOS QUE POSIBLEMENTE SE HAYAN CAPTURADO EN DICHA ÁREA')){
                            bootbox.hideAll();
                            $.ajax({
                                url: base_url+"inicio/pacientes/CambiarDestino",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    'csrf_token':csrf_token,
                                    'triage_id':triage_id,
                                    'destino':$('#cambiar_destino').val()
                                },beforeSend: function (xhr) {
                                    msj_loading()
                                },success: function (data, textStatus, jqXHR) {
                                    console.log(data)
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        location.reload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    msj_error_serve();
                                    bootbox.hideAll();
                                }
                            })
                        }
                    }
                }
            }
            ,onEscape : function() {}
        });
        setting_modal(25);
        if(destino_nombre=='Observación'){
            $('#cambiar_destino option[value="Observación"]').remove();
        }else if(destino_nombre=='Choque'){
            $('#cambiar_destino option[value="Choque"]').remove();
        }else{
            $('#cambiar_destino option[value="Filtro"]').remove();
        }
        
        
    })
    function setting_modal(width){
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        if(width==undefined){
            $('.modal-dialog').css({
                'margin-top':'130px'
            })
        }else{
            $('.modal-dialog').css({
                'margin-top':'130px','width':width+'%'
            })
        }
        
        $('.modal-header').css('background','#02344A').css('padding','7px')
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    }
});