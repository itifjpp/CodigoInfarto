$(document).ready(function (e) {
    $('body').on('click','.btn-rx-ra-add',function (e) {
        e.preventDefault();
        var ra_id=$(this).attr('data-id');
        var ra_nombre=prompt('NOMBRE DE LA REGIÓN ANATÓMICA',$(this).attr('data-region'));
        var ra_accion=$(this).attr('data-accion');
        if(ra_nombre!='' && ra_nombre!=null){
            sighMsjLoading();
            sighAjaxPost({
                ra_id:ra_id,
                ra_nombre:ra_nombre,
                ra_accion:ra_accion,
            },base_url+'Rx/AjaxRegionAnatomica',function (response) {
                bootbox.hideAll();
                location.reload();
            });    
        }    
    });
    $('body').on('click','.i-rx-ra-del',function (e) {
        e.preventDefault();
        var ra_id=$(this).attr('data-id');
        sighAjaxPost({
            ra_id:ra_id,
        },base_url+'Rx/AjaxEliminarRegionAnatomica',function (e) {
            location.reload();
        });
    });
    $('body').on('click','.btn-rx-ra-estudios-add',function (e) {
        e.preventDefault();
        var estudio_id=$(this).attr('data-id');
        var ra_id=$(this).attr('data-ra');
        var estudio_nombre=prompt('NOMBRE DEL ESTUDIO',$(this).attr('data-estudio'));
        var estudio_accion=$(this).attr('data-accion');
        if(estudio_nombre!='' && estudio_nombre!=null){
            sighMsjLoading();
            sighAjaxPost({
                estudio_id:estudio_id,
                ra_id:ra_id,
                estudio_nombre:estudio_nombre,
                estudio_accion:estudio_accion,
            },base_url+'Rx/AjaxEstudios',function (response) {
                bootbox.hideAll();
                location.reload();
            });    
        }    
    });
    $('body').on('click','.i-rx-ra-estudio-del',function (e) {
        e.preventDefault();
        var estudio_id=$(this).attr('data-id');
        sighAjaxPost({
            estudio_id:estudio_id,
        },base_url+'Rx/AjaxEliminarEstudio',function (e) {
            location.reload();
        });
    });
    $('body').on('click','.btn-rx-nueva-solicitud',function (e) {
        var ingreso_id=$(this).attr('data-ingreso');
        var solicitud_id=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        var solicitud_dx_val=$(this).attr('data-dx');
        sighMjsConfirm({
            title:'Nueva Solicitud de RX',
            message:'<div class="col-md-12"><textarea class="form-control" rows="6" name="solicitud_dx" placeholder="Diagnostico presuncional">'+solicitud_dx_val+'</textarea></div>',
            size:'medium'
        },function (rs) {
            if(rs==true){
                var solicitud_dx=$('body textarea[name=solicitud_dx]').val();
                sighMsjLoading();
                sighAjaxPost({
                    solicitud_id:solicitud_id,
                    solicitud_dx:solicitud_dx,
                    ingreso_id:ingreso_id,
                    accion:accion,
                },base_url+'Rx/AjaxSolicitudesRx',function (response) {
                    bootbox.hideAll();
                    
                    AbrirVista(base_url+'Rx/AgregarEstudios?sol='+response.SolicitudId+'&folio='+ingreso_id+'&via=Expediente',900,600);
                    location.reload();
                });
            }
        })
    });
    $('select[name=ra_id]').change(function (e) {
        var ra_id=$(this).val();
        sighAjaxPost({
            ra_id:ra_id
        },base_url+"Rx/AjaxObtenerEstudios",function (response) {
            bootbox.hideAll();
            $('select[name=estudio_id]').html(response.option);
        })
    });
    $('.form-agregar-estudio').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Rx/AjaxSolicitudAgregarEs',function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                location.reload();
            }else{
                msj_error_noti('EL ESTUDIO YA FUE SOLICITADO');
            }
        });
    });
    $('body').on('click','.icon-rx-se-remove',function () {
        var se_id=$(this).attr('data-id');
        sighMsjLoading();
        sighAjaxPost({
            se_id:se_id,
        },base_url+'Rx/AjaxSolicitudEliminarEs',function (response) {
            bootbox.hideAll();
            location.reload();
        });
    });
    $('.btn-rx-estudio-especial').click(function (e) {
        $('.add-estudio-especial').removeClass('hide');
        $('.form-agregar-estudio').addClass('hide');
    })
    $('.add-estudio-especial').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Rx/AjaxAgregarEstudioEspecial',function (response) {
            location.reload();
        })
    });
    $('select[name=estudio_id]').select2();
    $('.btn-windows-close-estudio').click(function (e) {
        var solicitud_id=$(this).attr('data-solicitud');
        var folio=$(this).attr('data-folio');
        e.preventDefault();
        if($('input[name=inputVia]').val()=='Expediente'){
            window.top.close();
            window.opener.location.reload();
            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/SolicitudRx?sol='+solicitud_id+'&folio='+folio);
        }else{
            window.top.close();
        }
    })
});
