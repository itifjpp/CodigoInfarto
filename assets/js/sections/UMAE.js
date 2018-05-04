$(document).ready(function () {
    $('select[name=um_clasificacion]').val($('select[name=um_clasificacion]').attr('data-value'));
    $('.umae-config-admin').submit(function (e) {
        e.preventDefault();
        var formData=new FormData($(this)[0]);
        $.ajax({
            url:  base_url+"Sections/Configuracion/AjaxUnidadMedica",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            mimeType: 'multipat/form-data',
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('DATOS GUARDADOS');
                    ActionWindowsReload()
                }
            },error: function (e) {
                bootbox.hideAll();
                console.log(e);
                msj_error_serve();
            }
        })    
    })
    /*Configuracion de Modulos de la Unidad Médica*/
    $('.inputModules').click(function () {
        if($(this).is(':checked')){
            $(this).attr('value','Si');
        }else{
            $(this).attr('value','No');
        }
    });
    $('input[type=radio]').each(function (i,e) {
        $('input[type=radio][name="'+$(this).attr('name')+'"][value="'+$(this).attr('data-value')+'"]').attr('checked',true);
    })
    $('body').on('click','.save-config-um',function (e) {
        var config_id=$(this).attr('data-id');
        var config_estatus=$(this).val();
        $.ajax({
            url: base_url+"Sections/Configuracion/AjaxGuardar",
            type: 'POST',
            dataType: 'json',
            data:{
                config_id:config_id,
                config_estatus:config_estatus,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_success_noti('GUARDANDO CAMBIOS...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('DATOS GUARDADOS');
                }
            },error: function (e) {
                msj_error_serve();
                console.log(e)
            }
        })
    })
})