$(document).ready(function () {
    $('.unidadmedica-registro').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"inicio/unidadesmedicas/GuardarUnidadMedica",
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Unidad Médica Guardada')
                    window.top.close();
                    window.opener.location.reload();
                    
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })
    $('select[name=unidadmedica_tipo]').val($('select[name=unidadmedica_tipo]').attr('data-value'));
    $('select[name=unidadmedica_nivel]').val($('select[name=unidadmedica_nivel]').attr('data-value'));
    $('select[name=unidadmedica_estado]').select2('val',$('select[name=unidadmedica_estado]').attr('data-value'));
})