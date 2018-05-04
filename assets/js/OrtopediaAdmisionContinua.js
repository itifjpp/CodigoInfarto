$(document).ready(function (e) {
    $('input[name=triage_id]').focus();
    $('input[name=triage_id]').keyup(function (e) {
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id.length===11 && triage_id!==''){
            $.ajax({
                url: base_url+"Ortopedia/AjaxPaciente",
                type: 'POST',
                dataType: 'json',
                data:{
                    triage_id:triage_id,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    switch (data.accion){
                        case 'NO_ENVIADO':
                            msj_error_noti('EL N° DE PACIENTE NO HA SIDO ENVIADO A ORTOPEDIA ADMISIÓN CONTINUA')
                            break;
                        case 'ASIGNADO':
                            msj_error_noti('EL PACIENTE YA SE ENCUENTRA EN ORTOPEDIA ADMISIÓN CONTINUA')
                            break;
                        case 'NO_AM':
                            msj_error_noti('DATOS NO CAPTURADOS POR ASISTENTE MÉDICA')
                            break;
                        case 'NO_ASIGNADO':
                            if(confirm('¿DESEA AGREGAR ESTE PACIENTE A MÉDICO ORTOPEDIA - ADMISIÓN CONTINUA?')){
                                AjaxAgregarAdmisionContinua(triage_id);
                            }
                            break;
                    }
                },error: function (e) {
                    bootbox.hideAll();
                    ReportarError(window.location.pathname,e.responseText)
                    MsjError();
                }
            });
            input.val('');
        }
    });
    function AjaxAgregarAdmisionContinua(triage_id) {
        $.ajax({
            url: base_url+"Ortopedia/AjaxIngresoAC",
            type: 'POST',
            dataType: 'json',
            data: {
                triage_id:triage_id,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('ACCIÓN REALIZADA');
                    ActionWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                ReportarError(window.location.pathname,e.responseText)
                MsjError();
            }
        })
    }
});