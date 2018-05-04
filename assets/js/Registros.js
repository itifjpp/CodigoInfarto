$(document).ready(function (e) {
    ObtenerRegistro('');
    $('body').on('click','.input-buscar-registro',function (e) {
        ObtenerRegistro($('input[name=acceso_fecha]').val());
    })
    function ObtenerRegistro(fecha) {
        $.ajax({
            url: base_url+"Sections/Registros/AjaxRegistros",
            type: 'POST',
            dataType: 'json',
            data:{
                acceso_fecha:fecha,
                csrf_token:csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                $('.table-registros tbody').html(data.tr);
                InicializeFootable('.table-registros')
                bootbox.hideAll();
            },error: function (e) {
                msj_error_serve(e);
                bootbox.hideAll();
            }
        })
    }
})