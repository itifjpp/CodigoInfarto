$(document).ready(function () {
    $('.btn-obtener-camas').click(function () {
        if($('select[name=area_id]').val()!=''){
            $.ajax({
                url: base_url+"Sections/Pisos/AjaxObtenerCamas",
                type: 'POST',
                dataType: 'json',
                data:{
                    csrf_token:csrf_token,
                    area_id:$('select[name=area_id]').val(),
                    piso_id:$('input[name=piso_id]').val()
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    $('.col-camas').html(data.col_md_3);
                    $.each(data.CamasAsignadas,function (i,e) {
                        $('body .cama_'+e.cama_id).prop('checked',true).attr('data-accion','Eliminar');
                    })
                },error: function (jqXHR, textStatus, errorThrown) {
                    bootbox.hideAll();
                    msj_error_serve()
                }
            })
        }else{
            msj_error_noti('Seleccionar una área');
        }
    })
    $('body').on('click','input[name=cama_id]',function () {
        var el=$(this);
        
        var cama_id=$(this).attr('data-id');
        var piso_id=$(this).attr('data-piso');
        var accion=$(this).attr('data-accion');
        $.ajax({
            url: base_url+"Sections/Pisos/AjaxAsignarCamas",
            type: 'POST',
            dataType: 'json',
            data:{
                cama_id:cama_id,
                piso_id:piso_id,
                accion:accion,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                if(accion=='Agregar'){
                    msj_success_noti('Agregando Cama')
                }else{
                    msj_error_noti('Eliminando Cama')
                }
                
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    if(accion=='Agregar'){
                        msj_success_noti('<i class="fa fa-check" style="color:#4caf50"></i> Agregado')
                    }else{
                        msj_success_noti('<i class="fa fa-check" style="color:#4caf50"></i> Eliminado')
                    }
                    
                }if(data.accion=='2'){
                    el.attr('checked',false);
                    el.attr('data-accion','Agregar');
                    msj_error_noti('<i class="fa fa-times" style="color:red"></i> La cama ya esta asignada a otro piso')
                }
                AjaxCamasAsignadas()
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
        if(el.is(':checked')){
            el.attr('data-accion','Eliminar');
        }else{
            el.attr('data-accion','Agregar');
        }
    })
    AjaxCamasAsignadas();
    function AjaxCamasAsignadas() {
        $.ajax({
            url: base_url+"Sections/Pisos/AjaxCamasAsignadas",
            type: 'POST',
            dataType: 'json',
            data: {
                csrf_token:csrf_token,
                piso_id:$('input[name=piso_id]').val()
            },beforeSend: function (xhr) {
            },success: function (data, textStatus, jqXHR) {
                $('.col-camas-asignadas').html(data.col_md_3);
            },error: function (jqXHR, textStatus, errorThrown) {
                
            }
        })
    }
})