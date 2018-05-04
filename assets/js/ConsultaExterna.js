$(document).ready(function () {
    $('.agregar-horacero-paciente').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"Horacero/GenerarFolio",
            dataType: 'json',
            beforeSend: function (data, textStatus, jqXHR) {
                msj_loading('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    location.href=base_url+'Consultaexterna/AsistenteMedica/'+data.max_id;
               }
            },error: function (e) {
                bootbox.hideAll();
                msj_error_serve();
                ReportarError(window.location.pathname,e.responseText)
            }
        });     
    });
    $('input[name=triage_fecha_nac]').mask('99/99/9999');
    $('.solicitud-am-consultaexterna').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+'Consultaexterna/AjaxAsistenteMedica',
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    AbrirDocumentoMultiple(base_url+'inicio/documentos/HojaFrontal/'+$('input[name=triage_id]').val(),'HojaFrontal',100);
                    if($('select[name=triage_paciente_accidente_lugar]').val()=='TRABAJO'){
                        AbrirDocumentoMultiple(base_url+'inicio/documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',300);
                    }
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ImprimirPulsera/'+$('input[name=triage_id]').val(),'ImprimirPulsera',100);
                    window.location.href=base_url+'Consultaexterna/';
                    
                }
            },error: function (e) {
                msj_error_serve();
                bootbox.hideAll();
                ReportarError(window.location.pathname,e.responseText)
            }
        })
    })
    $('body').on('click','.prealta-accion',function (e) {
        e.preventDefault();
        let triage_id=$(this).attr('data-id');
        let prealta_confirm=$(this).attr('data-confirm');
        _msjConfirm({
            message:'<div class="col-md-12">'+
                        '<h5 class="line-height">¿DESEA REALIZAR ESTA ACCIÓN?</h5>'+
                    '</div>',
            size:'small'
        },function (res) {
            if(res==true){
                SendAjaxPost({
                    triage_id:triage_id,
                    prealta_confirm:prealta_confirm,
                    csrf_token:csrf_token
                },'Consultaexterna/AjaxPrealtaConfirmacion',function (response) {
                    msj_success_noti('ACCIÓN REALIZADO CORRECTAMENTE');
                    location.reload();
                })
            }
        })
    })
})