$(document).ready(function (e) {
    $('.select2').select2();
    $('.nueva-notificacion').submit(function (e) {
        e.preventDefault();
        var formData=new FormData($(this)[0]);
        $.ajax({
            url: base_url+"Sections/Notificaciones/AjaxNotificaciones",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            mimeType: 'multipart/form-data',
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Notificaciones Enviadas')
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                msj_error_serve();
                console.log(e)
            }
        })
    })
})