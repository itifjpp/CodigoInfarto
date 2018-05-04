$(document).ready(function () {
    $('body').on('click','.marcar-como-recibido',function () {
        var mp_id=$(this).attr('data-id');
        var triage_id=$(this).attr('data-triage');
        $.ajax({
            url: base_url+"TrabajoSocial/AjaxMarcarComoRecibido",
            type: 'POST',
            data: {
                mp_id:mp_id,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('MARCADO COMO RECIBIDO')
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+triage_id,'NMP');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                MsjError();
            }
        })
    });
    $('body').on('click','.marcar-como-terminado',function () {
        var mp_id=$(this).attr('data-id');
        $.ajax({
            url: base_url+"TrabajoSocial/AjaxMarcarComoTerminado",
            type: 'POST',
            data: {
                mp_id:mp_id,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    
                    msj_success_noti('MARCADO COMO TERMINADO');
                    ActionWindowsReload();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                MsjError();
            }
        })
    });
})