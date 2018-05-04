$(document).ready(function () {
    $('body .add-quirofano').click(function () {
        Quirofano({
            title:'Agregar Quirófano',
            quirofano_id:0,
            quirofano_nombre:'',
            accion:'add'
        })    
    });
    $('body').on('click','.edit-quirofano',function () {
        Quirofano({
            title:'Agregar Quirófano',
            quirofano_id:$(this).attr('data-id'),
            quirofano_nombre:$(this).attr('data-quirofano'),
            accion:'edit'
        })    
    });
    function Quirofano(info) {
        bootbox.dialog({
            title:'<h5>'+info.title+'</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" name="quirofano_nombre" value="'+info.quirofano_nombre+'" placeholder="Nombre del Quirófano" class="form-control">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                Cancelar:{
                    label:'Cancelar'
                },Guardar:{
                    label:'Guardar',
                    callback:function () {
                        var quirofano_nombre=$('body input[name=quirofano_nombre]').val();
                        if(quirofano_nombre!=''){
                            bootbox.hideAll();
                            $.ajax({
                                url: base_url+"areas/quirofano/AgregarQuirofano",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    quirofano_id:info.quirofano_id,
                                    quirofano_nombre:quirofano_nombre,
                                    accion:info.accion,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading()
                                },success: function (data, textStatus, jqXHR) {
                                    if(data.accion=='1'){
                                        msj_success_noti('Registro Guardado');
                                        ActionWindowsReload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    msj_error_serve()
                                }
                            })
                        }
                    }
                }
            }
        })
    }
    
    $('body .add-salas-quirofano').click(function () {
        QuirofanosSalas({
            title:'Nueva Sala',
            quirofano_id:$(this).attr('data-quirofano'),
            sala_id:0,
            sala_nombre:'',
            accion:'add'
        });
    });
    $('body').on('click','.edit-sala',function () {
        QuirofanosSalas({
            title:'Editar Sala',
            quirofano_id:$(this).attr('data-quirofano'),
            sala_id:$(this).attr('data-id'),
            sala_nombre:$(this).attr('data-sala'),
            accion:'edit',
        });
    })
    function QuirofanosSalas(info) {
        bootbox.dialog({
            title:'<h5>'+info.title+'</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" name="sala_nombre" value="'+info.sala_nombre+'" placeholder="Nombre de la Sala" class="form-control">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                Cancelar:{
                    label:'Cancelar'
                },Guardar:{
                    label:'Guardar',
                    callback:function () {
                        var sala_nombre=$('body input[name=sala_nombre]').val();
                        if(sala_nombre!=''){
                            bootbox.hideAll();
                            $.ajax({
                                url: base_url+"areas/quirofano/AgregarSala",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    quirofano_id:info.quirofano_id,
                                    sala_id:info.sala_id,
                                    sala_nombre:sala_nombre,
                                    accion:info.accion,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data, textStatus, jqXHR) {
                                    if(data.accion=='1'){
                                        msj_success_noti('Registro Guardado');
                                        ActionWindowsReload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    msj_error_serve();
                                }
                            });
                        }
                    }
                }
            }
        });
    }
    $('body').on('click','.del-sala',function (e) {
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"areas/quirofano/EliminarSala/"+$(this).attr('data-id'),
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('Registro Eliminado');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            });
        }
    });
    $('body').on('click','.del-quirofano',function (e) {
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"areas/quirofano/EliminarQuirofano/"+$(this).attr('data-id'),
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('Registro Eliminado');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            });
        }
    });
    $('input[name=triage_id]').focus();
    $('input[name=triage_id]').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"areas/Quirofano/ObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'triage_id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    console.log(data)
                    if(data.accion=='2' && input.val()!=''){
                        if(confirm('¿DESEA AGREGAR EL PACIENTE A ESTA ÁREA?')){
                            $.ajax({
                                url: base_url+"areas/Quirofano/IngresoPaciente/"+data.paciente.triage_id,
                                dataType: 'json',
                                beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data_a, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data_a.accion=='1'){
                                        msj_success_noti('Paciente Agregado');
                                       ActionWindowsReload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    msj_error_serve();
                                }
                            })
                        }
                    }if(data.accion=='3' && input.val()!=''){
                        msj_error_noti('EL N° DE PACIENTE YA TIENE ASIGNADO UNA SALA');
                    }if(data.accion=='4' && input.val()!=''){
                        msj_error_noti('EL PACIENTE YA FUE DADO DE ALTA');
                    }if(data.accion=='1' && input.val()!=''){
                        msj_error_noti('EL PACIENTE NO SE ENCUENTRA EN ESTA ÁREA');
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
            
            
        }
    });
    $('input[name=triage_id_jq]').focus();
    $('input[name=triage_id_jq]').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"areas/Quirofano/ObtenerPacienteJQ",
                type: 'POST',
                dataType: 'json',
                data: {
                    'triage_id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1' && input.val()!=''){
                        AsignarSala({
                            option:data.option,
                            triage_id:input.val(),
                            salas:data.salas
                        })
                    }if(data.accion=='2' && input.val()!=''){
                        msj_error_noti('EL N° DE PACIENTE YA TIENE ASIGNADO UNA SALA');
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
            
            
        }
    });
    function AsignarSala(info) {
        bootbox.dialog({
            title:'<h5>Asignar Sala</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<select name="quirofano_id" class="form-control">'+info.option+'</select>'+
                            '</div>'+
                            '<div class="form-group form-loading hide">'+
                                '<center><i class="fa fa-spinner fa-pulse fa-2x"></i></center>'+
                            '</div>'+
                            '<div class="form-group form-load hide">'+
                                '<select name="sala_id" class="form-control"></select>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                Guardar:{
                    label:'Guardar',
                    callback:function () {
                        var sala_id=$('body select[name=sala_id]').val();
                        var triage_id=info.triage_id;
                        if(sala_id!=''){
                            bootbox.hideAll();
                            $.ajax({
                                url: base_url+"areas/quirofano/AsignarSala",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    sala_id:sala_id,
                                    triage_id:triage_id,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        msj_success_noti('Sala asignado correctamente');
                                        ActionWindowsReload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    msj_error_serve();
                                    bootbox.hideAll();
                                }
                            })
                        }else{
                            msj_error_noti('Seleccionar Sala')
                        }
                    }
                }
            }
        })
        
        $('body').on('change','select[name=quirofano_id]',function () {
            $('body .form-load').addClass('hide');
            $('body .form-loading').addClass('hide');
            if($(this).val()!=''){
                $.ajax({
                    url: base_url+"areas/quirofano/ObtenerSalas/"+$(this).val(),
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        $('body .form-loading').removeClass('hide');
                    },success: function (data, textStatus, jqXHR) {
                        $('body .form-load').removeClass('hide');
                        $('body .form-loading').addClass('hide');
                        $('body select[name=sala_id]').html(data.option)
                        $.each(info.salas,function (i,e) {
                            $("body select[name=sala_id] option[value='"+e.sala_id+"']").remove();
                        })
                    },error: function (jqXHR, textStatus, errorThrown) {
                        msj_error_serve()
                    }
                })
            }
        })
        
    }
    $('body').on('click','.alta-paciente',function () {
        if(confirm('¿DESEA DAR DE ALTA ESTE PACIENTE?')){
            $.ajax({
                url: base_url+"areas/Quirofano/AltaPaciente/"+$(this).attr('data-id'),
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Paciente dado de alta');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    })
})
