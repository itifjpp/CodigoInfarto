$(document).ready(function (e) {
    $('.form-guardar-multimedia').submit(function (e) {
        e.preventDefault();
        var Form=new FormData($(this)[0]);
        $.ajax({
            url: base_url+"Sections/Multimedia/AjaxAgregar",
            type: 'POST',
            dataType: 'json',
            data:Form,
            contentType: false,
            processData: false,
            mimeType: 'multipart/form-data',
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('ARCHIVO MULTIMEDIA GUARDADO');
                    location.href=base_url+'Sections/Multimedia/';
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })
    $('body').on('click','.accion-publicar',function () {
        var multimedia_id=$(this).attr('data-id');
        var multimedia_accion=$(this).attr('data-accion');
        $.ajax({
            url: base_url+"Sections/Multimedia/AjaxPublicacion",
            type: 'POST',
            dataType: 'json',
            data:{
                multimedia_id:multimedia_id,
                multimedia_accion:multimedia_accion,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    ActionWindowsReload();
                }
            },error: function (e) {
                msj_error_serve();
                console.log(e)
            }
        })
    })
})