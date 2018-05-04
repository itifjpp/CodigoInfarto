$(document).ready(function () {
    $('select[name=SELECCIONAR_AREA]').change(function () {
        AjaxGestionCamas($(this).val());
    })
    if($('input[name=tipo]').val()!=undefined){
        if($('input[name=area]').val()!='Administrador'){
            AjaxGestionCamas($('input[name=area_id]').val());
        }else{
            AjaxGestionCamas('');
        }
    }
    
    function AjaxGestionCamas(area){
        $.ajax({
            url: base_url+"Sections/Camas/AjaxGestionCamas",
            type: 'POST',
            dataType: 'json',
            data:{
                area:area,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.Total_Camas').attr('data-area',area).attr('data-tipo','Total').find('h2').html(data.Total+' Camas');
                $('.Total_Camas_Disponibles').attr('data-area',area).attr('data-tipo','Disponibles').find('h2').html(data.Disponibles+' Camas');
                $('.Total_Camas_Ocupadas').attr('data-area',area).attr('data-tipo','Ocupados').find('h2').html(data.Ocupados+' Camas');
                $('.Total_Camas_Mantenimiento').attr('data-area',area).attr('data-tipo','Mantenimiento').find('h2').html(data.Mantenimiento+' Camas');
                $('.Total_Camas_Limpieza').attr('data-area',area).attr('data-tipo','Limpieza').find('h2').html(data.Limpieza+' Camas');
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        });
    }
    $('.Total_Camas,.Total_Camas_Disponibles, .Total_Camas_Ocupadas,.Total_Camas_Limpieza,.Total_Camas_Mantenimiento').click(function (e) {
        e.preventDefault();
        if($(this).attr('data-area')!=''){
            window.open(base_url+'Sections/Camas/CamasDetalles?area='+$(this).attr('data-area')+'&tipo='+$(this).attr('data-tipo'),'_blank')
        }
    })
});