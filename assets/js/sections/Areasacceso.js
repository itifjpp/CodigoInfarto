$(document).ready(function (){
    $('.btn-add').click(function (){
        add_rol('add',{
            areas_acceso_nombre:'',
            areas_acceso_rol:'',
            areas_acces_id:'0',
            areas_acceso_mod:'',
            areas_acceso_mod_val:''
        })
    })
    $('.fa-pencil').click(function (){
        sighMsjLoading();
        sighAjaxPost({
            areas_acceso_id:$(this).attr('data-id')
        },base_url+'Sections/Areasacceso/AjaxObtenerArea',function (response) {
            add_rol('edit',{
                areas_acceso_nombre:response[0]['areas_acceso_nombre'],
                areas_acceso_rol:response[0]['areas_acceso_rol'],
                areas_acceso_id:response[0]['areas_acceso_id'],
                areas_acceso_mod:response[0]['areas_acceso_mod'],
                areas_acceso_mod_val:response[0]['areas_acceso_mod_val']
            });
            
        },'No');
        
    })
    $('.fa-trash-o').click(function (){
        var el =$(this).attr('data-id')
        if(confirm('AL ELIMINAR ESTE REGISTRO SE ELIMINARA TODOS LOS DATOS ASOCIADOS A ELLO, ¿DESEA CONTINUAR?')){
            sighMsjLoading();
            sighAjaxPost({areas_acceso_id :el
            },base_url+'Sections/Areasacceso/AjaxEliminarArea',function (response) {
                bootbox.hideAll();
                msj_success_noti('Registro eliminado');
                $('#'+el).remove();
            })
        }
    })
    function add_rol(accion,data){
        sighAjaxGet(base_url+"Sections/Areasacceso/AjaxGetRoles",function (response) {
            sighMjsConfirm({
                title: "AGREGAR AREA DE ACCESO</h5>",
                message:'<div class="col-md-6" >'+
                            '<div class="form-group" style="margin-bottom: 5px;">'+
                                '<label>NOMBRE DEL ÁREA DE ACCESO</label>'+
                                '<input class="form-control" value="'+data.areas_acceso_nombre+'" name="areas_acceso_nombre">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-6" >'+
                            '<div class="form-group" style="margin-bottom: 5px;">'+
                                '<label>ROL AL QUE PERTENECE</label>'+
                                '<select class="form-control" name="areas_acceso_rol" >'+
                                    response.option+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-6 col-mod-enfermeria hide" >'+
                            '<div class="form-group" style="margin-bottom: 5px;">'+
                                '<label>PERTENECE ALGÚN MODULO</label>'+
                                '<select class="form-control" name="areas_acceso_mod" >'+
                                    '<option value="">Seleccionar</option>'+
                                    '<option value="Observación">Observación</option>'+
                                    '<option value="Corta Estancia">Corta Estancia</option>'+
                                    '<option value="Choque">Choque</option>'+
                                    '<option value="Pisos">Pisos</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-6 hide areas_acceso_mod_val" >'+
                            '<div class="form-group" style="margin-bottom: 5px;">'+
                                '<label >PERTENECE ALGÚN MODULO</label>'+
                                    '<select class="form-control" name="areas_acceso_mod_val" >'+'</select>'+
                            '</div>'+
                        '</div>',
                size:'medium',
            },function (cb) {
                if(cb==true){
                    if($('body select[name=areas_acceso_nombre]').val()!=''){
                        sighAjaxPost({
                            areas_acceso_id:data.areas_acceso_id,
                            areas_acceso_nombre:$('body input[name=areas_acceso_nombre]').val(),
                            areas_acceso_rol:$('body select[name=areas_acceso_rol]').val(),
                            areas_acceso_mod:$('body select[name=areas_acceso_mod]').val(),
                            areas_acceso_mod_val:$('body select[name=areas_acceso_mod_val]').val(),
                            accion:accion,
                        },base_url+'Sections/Areasacceso/AjaxArea',function (response) {
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
            $('body select[name=areas_acceso_rol]').val(data.areas_acceso_rol);
            if(data.areas_acceso_rol=='3' && data.areas_acceso_mod!='' && data.areas_acceso_mod!=null){
                $('body .col-mod-enfermeria').removeClass('hide');
                $('body select[name=areas_acceso_mod]').val(data.areas_acceso_mod);
                $('body .areas_acceso_mod_val').removeClass('hide');
                if(data.areas_acceso_mod=='Pisos'){
                    AjaxObtenerPisos('',data.areas_acceso_mod_val);
                }else if(data.areas_acceso_mod=='Observación' && $('input[name=SiGH_OBSERVACION_ENFERMERIA]').val()=='No'){
                    AjaxObtenerAreas(data.areas_acceso_mod,data.areas_acceso_mod_val);
                }else{
                    $('body .areas_acceso_mod_val').addClass('hide');
                }
            }
        })  
    }
    $('body').on('change','select[name=areas_acceso_rol]',function () {
        if($(this).val()=='3'){
            $('body .col-mod-enfermeria').removeClass('hide');
        }else{
            $('body .col-mod-enfermeria').addClass('hide');
            $('body .areas_acceso_mod_area').addClass('hide');
        }
    })
    $('body').on('change','select[name=areas_acceso_mod]',function () {
        if($(this).val()!=''){
            if($(this).val()=='Pisos'){
                AjaxObtenerPisos($(this).val(),'');
            }if($(this).val()=='Observación' && $('input[name=SiGH_OBSERVACION_ENFERMERIA]').val()=='No'){
                AjaxObtenerAreas($(this).val(),'');
                $('body .areas_acceso_mod_val').removeClass('hide');
            }else{
                $('body .areas_acceso_mod_val').removeClass('hide');
                $('body .areas_acceso_mod_area').addClass('hide');
            }
            
        }else{
            $('body .areas_acceso_mod_area').addClass('hide');
        }
    });
    function AjaxObtenerAreas(area,val) {
        
        $.ajax({
            url:base_url+'Areas/AjaxObtenerAreas',
            type: 'POST',
            dataType: 'json',
            data:{
                areas_acceso_mod:area,
            },success: function (data, textStatus, jqXHR) {
                $('body select[name=areas_acceso_mod_val]').html(data.option);
                $('body select[name=areas_acceso_mod_val]').val(val)
            },error: function (e) {
                console.log(e)
            }
        })
    }
    function AjaxObtenerPisos(area,val) {
        $('body .areas_acceso_mod_val').removeClass('hide');
        $.ajax({
            url:base_url+'Areas/AjaxObtenerPisos',
            type: 'POST',
            dataType: 'json',
            data:{
            },success: function (data, textStatus, jqXHR) {
                $('body select[name=areas_acceso_mod_val]').html(data.option);
                $('body select[name=areas_acceso_mod_val]').val(val)
            },error: function (e) {
                console.log(e)
            }
        })
    }
    $('body').on('click','.available-not-available-access',function (e) {
        e.preventDefault();
        var areas_acceso_id=$(this).attr('data-id');
        var areas_acceso_status=$(this).attr('data-accion');
        sighMsjLoading();
        sighAjaxPost({
            areas_acceso_id:areas_acceso_id,
            areas_acceso_status:areas_acceso_status,
        },base_url+"Sections/Areasacceso/AjaxAcciones",function () {
            bootbox.hideAll();
            ActionWindowsReload();
            msj_success_noti('DATOS GUARDADOS');
        });
    })
})
