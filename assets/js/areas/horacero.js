$(document).ready(function () {
    $('.agregar-horacero-paciente').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"areas/horacero/GenerarFolio",
            dataType: 'json',
            beforeSend: function (data, textStatus, jqXHR) {
                msj_loading('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    window.open(base_url+'areas/horacero/GenerarTicket/'+data.max_id, '_blank');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                msj_error_serve();
            }
        });
    });
    $('body').on('click','.select_filter',function (e) {
        
        if($(this).val()=='by_fecha'){
            $('.by_fecha').removeClass('hide');
            $('.by_hora').addClass('hide');
           
        }else if($(this).val()=='by_hora'){
            $('.by_hora').removeClass('hide');
            $('.by_fecha').addClass('hide');
        }else{
            $('.by_fecha').addClass('hide');
            $('.by_hora').addClass('hide');
        }
        $('input[name=filter_select]').val($(this).val());
    });
    $('.by_fecha, .by_hora').submit(function (e) {
        console.log($(this).serialize())
        e.preventDefault();
        $.ajax({
            url: base_url+"areas/horacero/AjaxIndicador",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.table-filtros tbody').html(data.tr);
                $('.total_tickets').html('TOTAL DE TICKETS GENERADOS :</b>'+data.total+'</b> Tickets');
                InicializeFootable('.table-filtros');
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    })
});