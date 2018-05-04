$(document).ready(function () {
    var cama_aislado_select='No'
    var area_camas_select='Si'
    var area_tipo_select='Pisos';
    $('body').on('click','.add-area',function (e) {
        AgregarArea({
            area_id:0,
            title:'Agregar Área',
            area_nombre:'',
            area_camas:'Si',
            area_tipo:'Pisos',
            accion:'add'
        });
    });
    $('body').on('click','.edit-area',function (e) {
        AgregarArea({
            area_id:$(this).attr('data-id'),
            title:'Editar Área',
            area_nombre:$(this).attr('data-area'),
            area_camas:$(this).attr('data-cama'),
            area_tipo:$(this).attr('data-tipo'),
            accion:'edit'
        });
    });
    function AgregarArea(info) {
        bootbox.dialog({
            'title':'<h5>'+info.title+'</h5>',
            'message':'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" placeholder="Nombre del Área" value="'+info.area_nombre+'" name="area_nombre" class="form-control">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Tiene Camas</label>&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="area_camas" value="Si">'+
                                    '<i class="indigo"></i>Si'+
                                '</label>&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="area_camas" value="No" >'+
                                    '<i class="indigo"></i>No'+
                                '</label>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Tipo</label>&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="area_tipo" value="Pisos">'+
                                    '<i class="indigo"></i>Pisos'+
                                '</label>&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="area_tipo" value="Subareas" >'+
                                    '<i class="indigo"></i>Subareas'+
                                '</label>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                Cancelar:{
                    label:'Cancelar',
                    classname:'btn btn-primary'
                },Guardar:{
                    label:'Guardar',
                    classname:'btn btn-primary',
                    callback:function () {
                        bootbox.hideAll()
                        var area_nombre=$('body input[name=area_nombre]').val();
                        $.ajax({
                            url: base_url+"Pisos/Areas/GuardarArea",
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                area_id:info.area_id,
                                area_nombre:area_nombre,
                                area_camas:area_camas_select,
                                area_tipo:area_tipo_select,
                                accion:info.accion,
                                csrf_token:csrf_token
                            },
                            beforeSend: function (xhr) {
                                msj_loading();
                            },success: function (data, textStatus, jqXHR) {
                                if(data.accion=='1'){
                                    msj_success_noti('Registro Guardado')
                                    ActionWindowsReload();
                                }
                            },error: function (jqXHR, textStatus, errorThrown) {
                                msj_error_serve();
                                bootbox.hideAll();
                            }
                        })
                    }
                }
            },onEscape:function () {
                
            }
        })
        $('body input[name=area_camas]').click(function () {
            area_camas_select=$(this).val();
        })
        $('body input[name=area_tipo]').click(function () {
            area_tipo_select=$(this).val();
        })
        $('body input[name=area_camas][value="'+info.area_camas+'"]').prop("checked",true);
        $('body input[name=area_tipo][value="'+info.area_tipo+'"]').prop("checked",true);
    }
    $('.agregar-area').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"Pisos/Areas/GuardarArea",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardado');
                    ActionCloseWindowsReload();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('body').on('click','.add-cama-area',function (e) {
        AgregarCama({
            cama_id:0,
            title:'Agregar Cama',
            nombre_cama:'',
            cama_aislado:'Si',
            cama_genero:'Sin Especificar',
            area_id:$(this).attr('data-area'),
            accion:'add'
        });
    });
    $('body').on('click','.edit-cama',function (e) {
        AgregarCama({
            cama_id:$(this).attr('data-id'),
            title:'Editar Cama',
            nombre_cama:$(this).attr('data-cama'),
            cama_aislado:$(this).attr('data-aislado'),
            cama_genero:$(this).attr('data-genero'),
            area_id:$(this).attr('data-area'),
            accion:'edit'
        });
    });
    function AgregarCama(info) {
        bootbox.dialog({
            'title':'<h5>'+info.title+'</h5>',
            'message':'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" placeholder="Nombre de la Cama" value="'+info.nombre_cama+'" name="cama_nombre" class="form-control">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Cama Aislada</label>&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cama_aislado" value="Si">'+
                                    '<i class="indigo"></i>Si'+
                                '</label>&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cama_aislado" value="No" >'+
                                    '<i class="indigo"></i>No'+
                                '</label>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<select name="cama_genero" class="form-control">'+
                                    '<option value="Sin Especificar">Sin Especificar</option>'+
                                    '<option value="Hombre">Para Hombre</option>'+
                                    '<option value="Mujer">Para Mujer</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                Cancelar:{
                    label:'Cancelar',
                    classname:'btn btn-primary'
                },Guardar:{
                    label:'Guardar',
                    classname:'btn btn-primary',
                    callback:function () {
                        bootbox.hideAll()
                        var cama_nombre=$('body input[name=cama_nombre]').val();
                        var cama_aislado=cama_aislado_select;
                        var cama_genero=$('body select[name=cama_genero]').val();
                        $.ajax({
                            url: base_url+"Pisos/Areas/GuardarCama",
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                cama_id:info.cama_id,
                                cama_nombre:cama_nombre,
                                cama_aislado:cama_aislado,
                                cama_genero:cama_genero,
                                area_id:info.area_id,
                                accion:info.accion,
                                csrf_token:csrf_token
                            },
                            beforeSend: function (xhr) {
                                msj_loading();
                            },success: function (data, textStatus, jqXHR) {
                                if(data.accion=='1'){
                                    msj_success_noti('Registro Guardado')
                                    ActionWindowsReload();
                                }
                            },error: function (jqXHR, textStatus, errorThrown) {
                                msj_error_serve();
                                bootbox.hideAll();
                            }
                        })
                    }
                }
            },onEscape:function () {
                
            }
        })
        $('body input[name=cama_aislado]').click(function () {
            cama_aislado_select=$(this).val();
        })
        $('body select[name=cama_genero]').val(info.cama_genero);
        $('body input[name=cama_aislado][value="'+info.cama_aislado+'"]').prop("checked",true);
    }
    $('body').on('click','.del-area',function (e) {
        if(confirm('¿ELIMINAR REGISTRO Y TODAS LAS CAMAS ASOCIADOS A EL?')){
            $.ajax({
                url: base_url+"Pisos/Areas/EliminarArea/"+$(this).attr('data-id'),
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
            })
        }
    })
    $('body').on('click','.del-cama',function (e) {
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"Pisos/Areas/EliminarCama/"+$(this).attr('data-id'),
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
            })
        }
    })
})