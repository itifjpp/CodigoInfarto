$(document).ready(function (e) {
    $('.form-guardar-especialidad').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Especialidades/AjaxGuardarEspecialidad',function (response) {
           if(response.accion=='1'){
               window.opener.location.reload();
               window.top.close();
           } 
        });
    });
    $('body').on('click','.especialidades-eliminar',function (evt) {
        var especialidad_id=$(this).attr('data-id');
        if(confirm("¿DESEA ELIMINAR ESTE REGISTRO Y TODOS LOS DATOS ASOCIADOS A ESTE?")){
            sighMsjLoading();
            sighAjaxPost({
                especialidad_id:especialidad_id
            },base_url+'Sections/Especialidades/AjaxEliminarEspecialidad',function () {
                location.reload();
            });
        }
    });
    $('input[name=especialidad_consultorios][value="'+$('input[name=especialidad_consultorios]').attr('data-value')+'"]').attr('checked',true);
    $('input[name=especialidad_43029][value="'+$('input[name=especialidad_43029]').attr('data-value')+'"]').attr('checked',true);
    /*Agregar Consultorio*/
    $('.form-guardar-especialidad-cons').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Especialidades/AjaxAgregarConsultorios',function (response) {
           if(response.accion=='1'){
               window.opener.location.reload();
               window.top.close();
           } 
        })
    });
    $('input[name=consultorio_especialidad][value='+$('input[name=consultorio_especialidad]').attr('data-value')+']').attr('checked',true);
    
    
    /*Agregar Consultorios*/
    $('.form-consultorio').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+"Consultorios/AjaxNuevoConsultorio",function (response) {
            msj_success_noti('Datos Guardados')
            ActionCloseWindowsReload();
        });
    });
    $('input[name=consultorio_especialidad][value="'+$('input[name=consultorio_especialidad]').attr('data-value')+'"]').attr('checked',true);
    $('body').on('click','.especialidades-con-eliminar',function (evt) {
        var consultorio_id=$(this).attr('data-id');
        if(confirm("¿DESEA ELIMINAR ESTE REGISTRO Y TODOS LOS DATOS ASOCIADOS A ESTE?")){
            sighAjaxPost({
                consultorio_id:consultorio_id
            },base_url+'Sections/Especialidades/AjaxEliminarConsultorio',function (response) {
                location.reload();
            })
        }
    })
    /*Documentos para el expediente del paciente*/
    $('body').on('click','.documentos-add',function (evt) {
        var documento_id=$(this).attr('data-id');
        var documento_nombre_val=$(this).attr('data-documento');
        var documento_action=$(this).attr('data-action');
        sighMjsConfirm({
            title:'AGREGAR DOCUMENTO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<input name="documento_nombre" class="form-control" value="'+documento_nombre_val+'" placeholder="NOMBRE DEL DOCUMENTO">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var documento_nombre=$('body input[name=documento_nombre]').val();
                if(documento_nombre!=''){
                    sighAjaxPost({
                        documento_id:documento_id,
                        documento_nombre:documento_nombre,
                        documento_action:documento_action
                    },base_url+'Sections/Especialidades/AjaxDocumentosNuevo',function (response) {
                        location.reload();
                    });
                }else{
                    sighMsjError('CAMPO REQUERIDO!');
                }
            }
        });
    });
    $('body').on('click','.pc-doc-del',function () {
        var doc_id=$(this).attr('data-id');
        if(confirm('¿ELIMIAR ESTE REGISTRO?')){
            sighAjaxPost({
                doc_id:doc_id
            },base_url+"Sections/Especialidades/AjaxEliminarDocumentos",function (response) {
                msj_success_noti('Registro Eliminado');
                ActionWindowsReload();
            });
        }
    });
});