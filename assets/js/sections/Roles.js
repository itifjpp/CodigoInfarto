$(document).ready(function (e) {
    $('body').on('click','.acciones-roles',function () {
        var data_id=$(this).attr('data-id');
        var data_accion=$(this).attr('data-accion');
        var data_rol=$(this).attr('data-rol');
        
        if(data_accion=='Agregar'){
            AccionRol({
                title:'Agregar Rol',
                rol_id:data_id,
                rol_nombre:data_rol,
                accion:data_accion
            })
        }if(data_accion=='Editar'){
            AccionRol({
                title:'Editar Rol',
                rol_id:data_id,
                rol_nombre:data_rol,
                accion:data_accion
            })
        }if(data_accion=='Eliminar'){
            
        }
    })
    
    function AccionRol(info) {
        sighMjsConfirm({
            title:info.title,
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<input name="rol_nombre" value="'+info.rol_nombre+'" placeholder="Nombre del Nuevo Rol" class="form-control">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                if($('body input[name=rol_nombre]').val()!=''){
                    sighAjaxPost({
                        rol_id:info.rol_id,
                        rol_nombre: $('body input[name=rol_nombre]').val(),
                        accion: info.accion,
                    },base_url+"Sections/Roles/AjaxGuardar",function (response) {
                        msj_success_noti('Registro Guardado');
                        ActionWindowsReload();
                    })
                }else{
                    msj_error_noti('Campo requerido')
                }
            }
        });
    }
    $('body').on('click','.acciones-roles-documentos',function (evt) {
        evt.preventDefault();
        var rol_id=$(this).attr('data-rol');
        var documento_id=$(this).attr('data-id');
        var documento_nombre_=$(this).attr('data-documento');
        var documento_action=$(this).attr('data-action')
        sighMjsConfirm({
            title:'AGREGAR DOCUMENTO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<input type="text" name="documento_nombre" class="form-control" value="'+documento_nombre_+'" placeholder="NOMBRE DEL DOCUMENTO">'+
                        '</div>'+
                    '</div>',
            size:'medium'
        },function (cb) {
            if(cb==true){
                var documento_nombre=$('body input[name=documento_nombre]').val();
                if(documento_nombre!=''){
                    sighAjaxPost({
                        rol_id:rol_id,
                        documento_id:documento_id,
                        documento_nombre:documento_nombre,
                        documento_action:documento_action
                    },base_url+'Sections/Roles/AjaxDocumentosRegistro',function (response) {
                        location.reload();
                    })
                }else{
                    sighMsjError('NOMBRE DEL DOCUMENTO REQUERIDO');
                }
            }
        })
    })
})