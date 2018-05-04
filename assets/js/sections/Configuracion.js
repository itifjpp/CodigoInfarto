$(document).ready(function () {
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
        msj_success_noti('GUARDANDO CAMBIOS...');
        sighAjaxPost({
            config_id:config_id,
            config_estatus:config_estatus,
        },base_url+"Sections/Configuracion/AjaxGuardar",function (response) {
            msj_success_noti('DATOS GUARDADOS');
        });
    });
    $('body').on('click','.setting-clasi-edit',function () {
        var elemento=$(this);
        sighMjsConfirm({
            title:'EDITAR TIEMPO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<label>TIEMPO</label>'+
                            '<input type="text" class="form-control" value="'+elemento.attr('data-tiempo')+'" name="clasificacion_tiempo">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group m-t-5 m-b-5">'+
                            '<label>TIEMPO MIN.</label>'+
                            '<input type="number" class="form-control" value="'+elemento.attr('data-min')+'" name="clasificacion_min">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group m-t-5 m-b-5">'+
                            '<label>TIEMPO MAX.</label>'+
                            '<input type="number" class="form-control" value="'+elemento.attr('data-max')+'" name="clasificacion_max">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var clasificacion_tiempo=$('body input[name=clasificacion_tiempo]').val();
                var clasificacion_min=$('body input[name=clasificacion_min]').val();
                var clasificacion_max=$('body input[name=clasificacion_max]').val();
                if(clasificacion_tiempo!='' && clasificacion_min!='' && clasificacion_max!=''){
                    sighAjaxPost({
                        clasificacion_id:elemento.attr('data-id'),
                        clasificacion_tiempo:clasificacion_tiempo,
                        clasificacion_min:clasificacion_min,
                        clasificacion_max:clasificacion_max
                    },base_url+'Triage/Configuracion/AjaxClasificacion',function (response) {
                        location.reload();
                    })
                }else{
                    sighMsjError('ESTE CAMPO NO PUEDE QUEDAR VACIO')
                }
            }
        });
    });
    $('body').on('click','.btn-save-config-le',function () {
        sighMsjLoading();
        sighAjaxPost({
            llamado_espera_amarillo:$('input[name=llamado_espera_amarillo]').val(),
            llamado_espera_verde:$('input[name=llamado_espera_verde]').val(),
            llamado_espera_azul:$('input[name=llamado_espera_azul]').val(),
            llamado_id:2
        },base_url+'Sections/Configuracion/AjaxConfigTurnos',function (response) {
            location.reload();
        })
    })
});