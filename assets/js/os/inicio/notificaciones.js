$(document).ready(function (){
    $('body').on('click','.marcar-como-visto',function (){
        var id=$(this).data('id');
        var el=$(this);
        $.ajax({
            url: base_url+"inicio/notificaciones/MarcarComoVisto",
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_token':csrf_token,
                'id':id
            },beforeSend: function (xhr) {
                
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    el.hide();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })
})