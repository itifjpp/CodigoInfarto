$(document).ready(function (){
    $('body').on('click','input[name=area_nombre]',function (e){
        CargarCamas($(this).val());
    })
    if($('input[name=BY_AREA]').val()!=''){
        CargarCamas($('input[name=BY_AREA]').val());
    }
    function CargarCamas(area){
        $.ajax({
            url: base_url+"areas/limpiezacamas/CamasAreas",
            type: 'POST',
            dataType: 'json',
            data:{
                'area':area,
                'csrf_token':csrf_token
            },beforeSend: function (xhr) {
                msj_loading()
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.result_camas=='NO_HAY_CAMAS'){
                    $('.NO_HAY_CAMAS').removeClass('hide')
                }else{
                    $('.result_camas').html(data.result_camas);
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                msj_error_serve();
            }
        })    
    }
    $('body').on('click','.dar-mantenimiento',function(e){
        e.preventDefault();
        var area=$(this).data('area');
        var el=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        var msj;
        if(accion=='Disponible'){
            msj='¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?';
        }else{
            msj='¿DESEA MANDAR A MANTENIMIENTO ESTA CAMA?';
        }
        if(confirm(msj)){
           $.ajax({
                url: base_url+"urgencias/dar_mantenimiento",
                type: 'POST',
                dataType: 'json',
                data:{'id':el,'accion':accion,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando cambios');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        CargarCamas(area)
                        //location.reload();
                        
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
           })
        }
    })
})