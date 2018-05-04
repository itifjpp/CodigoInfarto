$(document).ready(function (e){
    $('#input_search').focus()
    $('#input_search').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"observacion/ObtenerPacienteMedico",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    console.log(data)
                    if(data.accion=='1' && input.val()!=''){                        
                        if(confirm('¿DESEA AGREGAR ESTE PACIENTE?')){
                            var matricula=prompt('CONFIRMAR MATRICULA','');
                            if(matricula!='' && matricula!=null){
                                $.ajax({
                                    url: base_url+"observacion/asociar_medico",
                                    type: 'POST',
                                    dataType: 'json',
                                    data:{
                                        'triage_id':input.val(),
                                        'csrf_token':csrf_token,
                                        'matricula':matricula
                                    },beforeSend: function (xhr) {
                                        msj_loading();
                                    },success: function (data) {
                                        bootbox.hideAll();
                                        if(data.accion=='1'){
                                            location.reload();
                                        }if(data.accion=='2'){
                                            msj_error_noti('LA MATRICULA ESCRITA NO EXISTE!')
                                        }
                                    },error: function (e) {
                                        bootbox.hideAll();
                                        msj_error_serve();
                                    }
                                })
                            }else{
                                msj_error_noti('Confirmación de matricula requerida');
                            }
                        }
                        //window.open(base_url+'observacion/asignar_cama?t='+input.val(),'_blank');
                    }if(data.accion=='2' && input.val()!=''){
                        AgregarPacienteObservacion(data.paciente);
                    }if(data.accion=='3' && input.val()!=''){
                        msj_success_noti('EL N° PACIENTE YA SE ENCUENTRA REGISTRADO O SE HA DADO DE ALTA') 
                    }
                    if(data.accion=='4' && input.val()!=''){
                        msj_success_noti('EL N° PACIENTE NO CORRESPONDE A ESTA AREA') 
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            }) 
        }
    })
    function AgregarPacienteObservacion(info) {
        if(confirm("EL PACIENTE NO SE ENCUENTRA EN ESTA ÁREA, ¿DESEA AGREGARLO?\n\nFOLIO: "+info.triage_id+"\nPACIENTE: "+info.triage_nombre)){
            $.ajax({
                url: base_url+"observacion/AgregarPacienteObservacion",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'triage_id':info.triage_id
                },beforeSend: function (xhr) {
                    msj_loading('Agregando paciente al área de observación')
                },success: function (data1, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data1.accion=='1'){
                        var matricula=prompt('CONFIRMAR MATRICULA','');
                            if(matricula!='' && matricula!=null){
                                $.ajax({
                                    url: base_url+"observacion/asociar_medico",
                                    type: 'POST',
                                    dataType: 'json',
                                    data:{
                                        'triage_id':info.triage_id,
                                        'csrf_token':csrf_token,
                                        'matricula':matricula
                                    },beforeSend: function (xhr) {
                                        msj_loading();
                                    },success: function (data) {
                                        bootbox.hideAll();
                                        if(data.accion=='1'){
                                            location.reload();
                                        }
                                    },error: function (e) {
                                        bootbox.hideAll();
                                        msj_error_serve();
                                    }
                                })
                            }else{
                                msj_error_noti('Confirmación de matricula requerida');
                            }
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    }
    $('body').on('click','.add-cama-paciente',function (e){
        var area_id=$(this).data('area');
        var triage=$(this).data('triage');
        if(confirm('¿ASIGNAR CAMA?')){
            $.ajax({
                url: base_url+"observacion/buscar_camas",
                type: 'POST',
                dataType: 'json',
                data: {'area_id':area_id,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data) {
                    bootbox.hideAll();
                    bootbox.dialog({
                        title: '<h5>ASIGNAR CAMA</h5>',
                        message:'<div class="row ">'+
                                    '<div class="col-sm-12">'+(data.option!='NO_RESULT' ? '<label>ASIGNAR CAMA</label><select id="select_cama" style="width:100%">'+data.option+'</select>' :' <center>NO HAY CAMAS DISPONIBLES PARA ESTA ÁREA</center>' )+
                                    '</div>'+
                                '</div>',
                        buttons: {
                            main: {
                                label: "Aceptar",
                                className: "btn-fw green-700",
                                callback:function(){
                                    var select_cama=$('#select_cama').val();
                                    if(select_cama!=undefined){
                                        $.ajax({
                                            url: base_url+"observacion/asignar_cama_paciente",
                                            type: 'POST',
                                            dataType: 'json',
                                            data:{
                                                'csrf_token':csrf_token,
                                                'observacion_cama':select_cama,
                                                'triage_id':triage
                                            },beforeSend: function (xhr) {
                                                msj_loading();
                                            },success: function (data, textStatus, jqXHR) {
                                                bootbox.hideAll();
                                                if(data.accion=='1'){
                                                    location.reload();
                                                }
                                            },error: function (jqXHR, textStatus, errorThrown) {
                                                bootbox.hideAll();
                                                msj_error_serve();
                                            }
                                        })
                                    }
                                }
                            }
                        }
                        ,onEscape : function() {}
                    });
                    setting_modal(25)

                    
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    
                }
            })
                
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
    $('body').on('click','.observacion-asociar-medico',function (e){
        var triage_id=$(this).data('id');
        if (confirm("¿ASOCIAR MÉDICO?")){
            var matricula=prompt('CONFIRMAR MATRICULA','');
            if(matricula!='' && matricula!=null){
                $.ajax({
                    url: base_url+"observacion/asociar_medico",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        'csrf_token':csrf_token,
                        'triage_id':triage_id,
                        'matricula':matricula
                    },beforeSend: function (xhr) {
                        msj_loading()
                    },success: function (data, textStatus, jqXHR) {
                        bootbox.hideAll();
                        if(data.accion=='1'){
                            msj_success_noti('Médico asociado correctamente');
                            location.reload()                       
                        }
                    },error:function (){
                        bootbox.hideAll();
                        msj_error_noti();
                    }
                })
            }
        }
    })
    $('body').on('click','.destino-paciente',function (e){
            var triage_id=$(this).data('id');
            $.ajax({
                url: base_url+"observacion/EstadoDatosAM",
                type: 'POST',
                dataType: 'json',
                data:{
                    'triage_id':triage_id,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        var area_acceso=$('input[name=accion_area_acceso]').val();
                           
                    }if(data.accion=='2'){
                        msj_error_noti('DATOS NO CAPTURADOS POR ASISTENTES MÉDICAS')
                    }
                    
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
            
            
            
    })
    $('.solicitud-transfucion').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"observacion/solicitud_transfucion",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Solicitud Guardada');
                    location.reload();
                    
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
            url: base_url+"observacion/cirugia_segura",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardada');
                    location.reload();
                    
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('.consentimiento-informado').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"observacion/concentimiento_informado",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardada');
                    location.reload();
                    
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
            url: base_url+"observacion/cci",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardada');
                    location.reload();
                    
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
            url: base_url+"observacion/isq",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardada');
                    location.reload();
                    
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('input[name=isq_turno][value="'+$('input[name=isq_turno]').data('value')+'"]').prop("checked",true);
    if($('input[name=accion_rol]').val()=='Enfermeria'){
        CargarCamasEnfemeria()
    }
    function CargarCamasEnfemeria() {
        $.ajax({
            url: base_url+"observacion/CargarCamas",
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
    
    var triage_paciente_accidente_lugar=$('input[name=triage_paciente_accidente_lugar]').val();
    $('.guardar-solicitud-hf-observacion').submit(function (e) {
        e.preventDefault();
        e.preventDefault();
        $.ajax({
            url: base_url+"observacion/hojafrontalht7guardar",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    window.open(base_url+'inicio/documentos/HojaFrontalCE/'+$('input[name=triage_id]').val(),'blank');
                    if(triage_paciente_accidente_lugar=='TRABAJO'){
                        window.open(base_url+'inicio/documentos/ST7/'+$('input[name=triage_id]').val(), '_blank');
                    }
                    
                }
                window.opener.location.reload();
                window.top.close();
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                msj_error_serve()
            }
        })
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
                        CargarCamasEnfemeria()
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
           })
        }
    })
    $('body').on('click','.add-tarjeta-identificacion',function (e) {
        var enfermedad=$(this).attr('data-enfermedad');
        var alergia=$(this).attr('data-alergia');
        var triage_id=$(this).attr('data-id');
        e.preventDefault();
        bootbox.dialog({
            title:'<h5>Tarjeta de Identificación</h5>',
            message:'<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Enfermedades Cronicodegenerativas</label>'+
                                    '<textarea class="form-control" name="ti_enfermedades" maxlength="50" rows="1">'+enfermedad+'</textarea>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Alergias</label>'+
                                    '<textarea class="form-control" name="ti_alergias" maxlength="85" rows="2">'+alergia+'</textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
            buttons:{
                Cancelar:{
                    label:'Cancelar',
                    callback:function () {}
                },Guardar:{
                    label:'Guardar',
                    callback:function () {
                        var ti_enfermedades=$('body textarea[name=ti_enfermedades]').val();
                        var ti_alergias=$('body textarea[name=ti_alergias]').val();
                        bootbox.hideAll();
                        $.ajax({
                            url: base_url+"Observacion/AjaxTarjetaIdentificacion",
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                triage_id : triage_id,
                                ti_enfermedades : ti_enfermedades,
                                ti_alergias : ti_alergias,
                                csrf_token : csrf_token
                            },beforeSend: function (xhr) {
                                msj_loading()
                            },success: function (data, textStatus, jqXHR) {
                                bootbox.hideAll();
                                if(data.accion=='1'){
                                    AbrirDocumento(base_url+'Inicio/Documentos/TarjetaDeIdentificacion/'+triage_id);
                                    CargarCamasEnfemeria()
                                }
                            },error: function (e) {
                                msj_error_serve(e);
                                bootbox.hideAll();
                            }
                        })
                    }
                }
            },onEscape:function () {}
        });
    });
    $('body').on('click','.cambiar-cama-paciente',function (e) {
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
                                    url: base_url+"Observacion/AjaxCambiarCama",
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
                                            CargarCamasEnfemeria()
                                        }
                                    },error: function (e) {
                                       bootbox.hideAll();
                                        msj_error_serve(e)
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
                    url: base_url+"Observacion/CambiarEnfermera",
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
                            CargarCamasEnfemeria();
                        }if(data.accion=='2'){
                            msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                        }
                    },error: function (e) {
                        msj_error_serve(e)
                        bootbox.hideAll();
                    }
                })
            }else{
                msj_error_noti('INGRESAR MATRICULA');
            }
        }
    })
});