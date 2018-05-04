$(document).ready(function (e) {
    $('body').on('click','.posible-donador',function (e) {
        var input_type=$(this).attr('data-tipo');
        var input_value=$(this).attr('value');
    })
    $('input[name=po_potencial_donador]').click(function () {
        if($(this).val()=='Si'){
            $('.po_donador_elegible').removeClass('hide');
        }else{
            $('.po_donador_util').addClass('hide');
            $('.po_donador_elegible').addClass('hide');
            $('.po_donador_efectivo').addClass('hide');
            $('input[name=po_donador_util][value="No"]').prop('checked',true);
            $('input[name=po_donador_efectivo][value="No"]').prop('checked',true);
            $('input[name=po_donador_elegible][value="No"]').prop('checked',true);
        }
        
    })
    $('input[name=po_donador_elegible]').click(function () {
        if($(this).val()=='Si'){
            $('.po_donador_efectivo').removeClass('hide');
        }else{
            $('.po_donador_efectivo').addClass('hide');
            $('.po_donador_util').addClass('hide');
            $('input[name=po_donador_util][value="No"]').prop('checked',true);
            $('input[name=po_donador_efectivo][value="No"]').prop('checked',true);
        }
    })
    $('input[name=po_donador_efectivo]').click(function () {
        if($(this).val()=='Si'){
            $('.po_donador_util').removeClass('hide');
        }else{
            $('.po_donador_util').addClass('hide');
        }
    })
    $('.posible-donador-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"ProcuracionOrganos/AjaxPosibleDonador",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('DATOS GUARDADOS');
                    ActionCloseWindowsReload();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    })
    if($('input[name=po_potencial_donador]').attr('data-value')=='Si'){
        $('input[name=po_potencial_donador][value="Si"]').prop('checked',true);
        $('.po_donador_elegible').removeClass('hide');
    }else{
        $('.po_donador_elegible').addClass('hide');
        $('.po_donador_efectivo').addveClass('hide');
        $('.po_donador_util').addClass('hide');
    }
    if($('input[name=po_donador_elegible]').attr('data-value')=='Si' ){
        $('input[name=po_donador_elegible][value="Si"]').prop('checked',true);
        $('.po_donador_efectivo').removeClass('hide');
    }
    if($('input[name=po_donador_efectivo]').attr('data-value')=='Si' ){
        $('input[name=po_donador_efectivo][value="Si"]').prop('checked',true);
        $('.po_donador_util').removeClass('hide');
    }
    if($('input[name=po_donador_util]').attr('data-value')=='Si' ){
        $('input[name=po_donador_util][value="Si"]').prop('checked',true);
    }
})