var roles;
$(document).ready(function (){
    $.ajax({
        url: base_url+"Sections/Menu/get_areas_acceso",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('body #tipo_usuarios_mn1').html(data['option']);
            roles=data['option'];
        },error: function (jqXHR, textStatus, errorThrown) {
            msj_error_serve();
        }
    })
    $('body #tipo_usuarios_mn1').select2();
    $('.btn-add-mn1').click(function (){
        mn1('add',{
            'mn1_id':0,
            'mn1_menu_1':'',
            'mn1_url'   :'',
            'mn1_icono' :'',
            'mn1_c_m'   :''
        })
    })
    $('.btn-edit-mn1').click(function (){
        $.ajax({
            url: base_url+"Sections/Menu/get_menuN1",
            dataType: 'json',
            type: 'POST',
            data:{
             'csrf_token' : $.cookie('csrf_cookie'),
             'id':$(this).attr('data-id')
            },success: function (data, textStatus, jqXHR) {
                console.log(data)
                mn1('edit',{
                    'mn1_id':data[0]['menuN1_id'],
                    'mn1_menu_1':data[0]['menuN1_menu'],
                    'mn1_url'   :data[0]['menuN1_url'],
                    'mn1_icono' :data[0]['menuN1_icono'],
                    'mn1_c_m'   :data[0]['menuN1_c_m']
                })
                $('body #mn1_c_m').val(data[0]['menuN1_c_m']);
                $('body #menuN1_status').val(data[0]['menuN1_status']);
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    function mn1(accion,data){
        sighMjsConfirm({    
            title: "AGREGAR MENU NIVEL 1",
            message:'<div class="col-md-6" >'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Nombre del Menu</label>'+
                            '<input type="text" class="form-control" value="'+data.mn1_menu_1+'" id="mn1_menu_1">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Url</label>'+
                            '<input type="text" class="form-control" value="'+data.mn1_url+'" id="mn1_url">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Status</label>'+
                            '<select class="width100" id="menuN1_status">'+
                                '<option value="1">Mostrar</option>'+
                                '<option value="0">Ocultar</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Icono</label>'+
                            '<input type="text" class="form-control" value="'+data.mn1_icono+'" id="mn1_icono">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Nivel 2</label>'+
                            '<select class="width100" id="mn1_c_m">'+
                                '<option value="1">Si</option>'+
                                '<option value="0">No</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>',
        },function (result) {
            if(result==true){
                if($('body #mn1_menu_1').val()!='' && $('body #mn1_url').val()!=''){
                    sighMsjLoading();
                    sighAjaxPost({
                        mn1_id:data.mn1_id,
                        mn1_menu_1      :$('body #mn1_menu_1').val(),
                        mn1_url         :$('body #mn1_url').val(),
                        mn1_icono       :$('body #mn1_icono').val(),
                        mn1_c_m         :$('body #mn1_c_m').val(),
                        menuN1_status   :$('body #menuN1_status').val(),
                        accion          :accion,
                        csrf_token      :$.cookie('csrf_cookie')
                    },base_url+'Sections/Menu/insert_menuN1',function (response) {
                        bootbox.hideAll();
                        if(response.accion=='1'){
                            msj_success_noti('Registro guardado.');
                            location.reload();
                        }
                    })      
                }else{
                    msj_error_noti('Todos los campos son requeridos')
                }
            }
        });

    }
    $('.btn-add-mn1-rol').click(function (){
        var id_mn1=$(this).attr('data-id');
        sighMjsConfirm({    
            title: "ASIGNAR ÁREA DE ACCESO",
            message: '<div class="col-md-12" >'+
                        '<select class="width100" id="tipo_usuarios_mn1">'+roles+'</select>'+
                    '</div>',
            size:'small',
        },function (call) {
            if(call==true){
                sighMsjLoading();
                sighAjaxPost({
                    'menuN1_id':id_mn1,
                    'areas_acceso_id':$('body #tipo_usuarios_mn1').val(),
                },base_url+"Sections/Menu/insert_mn1_rol",function (response) {
                    bootbox.hideAll();
                    switch (response.accion){
                        case '1':
                            msj_success_noti('Registro guardado');
                            location.reload();
                            break;
                        case '2':
                            msj_error_noti('Error al guardar el registro')
                            break;
                        case '3':
                            msj_error_noti(response.msj)
                            break;
                    }
                })
            }
        });
        $('.table').footable();
        
    })
    $('.del-mn1-rol').click(function (){
        var menuN1_id=$(this).attr('data-m');
        var areas_acceso_id= $(this).attr('data-r');
        
        if(confirm('¿Desea eliminar este registro?')){
            $.ajax({
                url: base_url+"Sections/Menu/delete_mn1_rol",
                dataType: 'json',
                type: 'POST',
                data:{
                    'menuN1_id'           :menuN1_id,
                    'areas_acceso_id' :areas_acceso_id,
                    'csrf_token'    : $.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        location.reload();
                    }
                },error: function (e) {
                    console.log(e)
                    msj_error_serve()
                }
            })
        }
    })
    $('.btn-add-mn2').click(function (){
        mn2('add',{
            'menuN2_id'     :0,
            'menuN2_menu'   :'',
            'menuN2_url'    :'',
            'menuN2_c_m'    :'',
            'menuN2_icono'  :'',
            'menuN2_status' :'',
            'menuN1_id'     :$(this).attr('data-id')
        })
    })
    $('.btn-edit-mn2').click(function (){
        $.ajax({
            url: base_url+"Sections/Menu/get_menuN2",
            dataType: 'json',
            type: 'POST',
            data:{
                'id'            :$(this).attr('data-id'),
                'csrf_token'    : $.cookie('csrf_cookie')
            },success: function (data, textStatus, jqXHR) {
                mn2('edit',{
                    'menuN2_id'     :data[0]['menuN2_id'],
                    'menuN2_menu'   :data[0]['menuN2_menu'],
                    'menuN2_url'    :data[0]['menuN2_url'],
                    'menuN2_c_m'    :data[0]['menuN2_c_m'],
                    'menuN2_icono'  :data[0]['menuN2_icono'],
                    'menuN1_id'     :data[0]['menuN1_id']
                })
                $('body #menuN2_status').val(data[0]['menuN2_status']);
                $('body #menuN2_c_m').val(data[0]['menuN2_c_m']);
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    function mn2(accion,data){
        sighMjsConfirm({
            title: "Menu Nivel 2",
            message:'<div class="col-md-6" >'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Nombre del Menu</label>'+
                            '<input class="form-control" value="'+data.menuN2_menu+'" id="menuN2_menu">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Url</label>'+
                            '<input class="form-control" value="'+data.menuN2_url+'" id="menuN2_url">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Status</label>'+
                            '<select class="form-control" id="menuN2_status">'+
                                '<option value="1">Mostrar</option>'+
                                '<option value="0">Ocultar</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Icono</label>'+
                            '<input class="form-control" value="'+data.menuN2_icono+'" id="menuN2_icono">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Nivel 3</label>'+
                            '<select class="form-control" id="menuN2_c_m">'+
                                '<option value="1">Si</option>'+
                                '<option value="0">No</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>',
        },function (cb) {
            if(cb==true){
                if($('body #menuN2_menu').val()!='' && $('body #menuN2_url').val()!=''){
                    sighAjaxPost({
                        menuN2_id     :data.menuN2_id,
                        menuN2_menu   :$('body #menuN2_menu').val(),
                        menuN2_url    :$('body #menuN2_url').val(),
                        menuN2_icono  :$('body #menuN2_icono').val(),
                        menuN2_c_m    :$('body #menuN2_c_m').val(),
                        menuN2_status :$('body #menuN2_status').val(),
                        menuN1_id     :data.menuN1_id,
                        accion        :accion,
                    },base_url+'Sections/Menu/insert_menuN2',function(response){
                        if(response.accion=='1'){
                            msj_success_noti('Registro guardado.');
                            location.reload();
                        }else{
                            msj_error_noti('Error al guardar el registro');
                        }
                    })        
                }else{
                    msj_error_noti('Todos los campos son requeridos')
                }
            }
        })
    }    
    $('.btn-add-mn3').click(function (){
        mn3('add',{
            'menuN3_id'     :0,
            'menuN3_menu'   :'',
            'menuN3_url'    :'',
            'menuN3_icono'  :'',
            'menuN3_status' :'',
            'menuN2_id'     :$(this).attr('data-id')
        })
    })
    $('.btn-edit-mn3').click(function (){
        $.ajax({
            url: base_url+"Sections/Menu/get_menuN3",
            dataType: 'json',
            type: 'POST',
            data:{
                'id'            :$(this).attr('data-id'),
                'csrf_token'    : $.cookie('csrf_cookie')
            },success: function (data, textStatus, jqXHR) {
                mn3('edit',{
                    'menuN3_id'     :data[0]['menuN3_id'],
                    'menuN3_menu'   :data[0]['menuN3_menu'],
                    'menuN3_url'    :data[0]['menuN3_url'],
                    'menuN3_icono'  :data[0]['menuN3_icono'],
                    'menuN2_id'     :data[0]['menuN2_id']
                })
                $('body #menuN3_status').val(data[0]['menuN3_status']);
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })    
    function mn3(accion,data){
        bootbox.dialog({    
            title: "Menu Nivel 3",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-6" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN3_menu+'" id="menuN3_menu">'+
                                    '<label>Nombre del Menu</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN3_url+'" id="menuN3_url">'+
                                    '<label>Url</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN3_icono+'" id="menuN3_icono">'+
                                    '<label>Icono</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<select class="md-input select2" id="menuN3_status">'+
                                        '<option value="1">Mostrar</option>'+
                                        '<option value="0">Ocultar</option>'+
                                    '</select>'+
                                    '<label>Status</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #menuN3_menu').val()!='' && $('body #menuN3_url').val()!=''){
                            $.ajax({
                                url: base_url+"Sections/Menu/insert_menuN3",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'menuN3_id'     :data.menuN3_id,
                                    'menuN3_menu'   :$('body #menuN3_menu').val(),
                                    'menuN3_url'    :$('body #menuN3_url').val(),
                                    'menuN3_icono'  :$('body #menuN3_icono').val(),
                                    'menuN3_status' :$('body #menuN3_status').val(),
                                    'menuN2_id'     :data.menuN2_id,
                                    'accion'        :accion,
                                    'csrf_token'    :$.cookie('csrf_cookie')
                                },beforeSend: function (xhr) {
                                    msj_success_noti('Guardando registro...');
                                },success: function (data, textStatus, jqXHR) {
                                    if(data['accion']=='1'){
                                        msj_success_noti('Registro guardado.');
                                        location.reload();
                                    }else{
                                        msj_error_noti('Error al guardar el registro');
                                    }
                                },error:function (){
                                    msj_error_serve()
                                }
                            })        
                        }else{
                            msj_error_noti('Todos los campos son requeridos')
                        }

                    }
                }
            }
        });
        $('.table').footable();
        $('.modal-header').addClass('b-green-b-i');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    } 
    $('.btn-delete-mn3').click(function (){
        var el=$(this).attr('data-id')
        if(confirm('¿Desea elimiar este registro?')){
            $.ajax({
                url: base_url+"Sections/Menu/delete_mn3",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':$(this).attr('data-id'),
                    'csrf_token'    :$.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                        msj_success_noti('Registro eliminado')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
    $('.btn-delete-mn2').click(function (){
        var el=$(this).attr('data-id')
        if(confirm('¿Desea elimiar este registro y todos lo datos asociados a el?')){
            $.ajax({
                url: base_url+"Sections/Menu/delete_mn2",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':$(this).attr('data-id'),
                    'csrf_token'    :$.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                        msj_success_noti('Registro eliminado')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
    $('.btn-delete-mn1').click(function (){
        var el=$(this).attr('data-id')
        if(confirm('¿Desea elimiar este registro y todos lo datos asociados a el?')){
            $.ajax({
                url: base_url+"Sections/Menu/delete_mn1",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':$(this).attr('data-id'),
                    'csrf_token'    :$.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                        msj_success_noti('Registro eliminado')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    }) 
})