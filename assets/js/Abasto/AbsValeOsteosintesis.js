$(document).ready(function (e) {
    $(document).on('click','.agregar-solicitud-rangos',function () {
        var rango_id=$(this).attr('data-rango');
        var procedimiento_id=$(this).attr('data-procedimiento');
        _msjConfirm({
            message:'<div class="col-md-12"><br><input type="number" name="cantidad_solicitada" class="form-control" placeholder="Cantidad Requerida"></div>',
            size:'small'
        },function (result) {
            if(result==true){
                var cantidad_solicitada=$('body input[name=cantidad_solicitada]').val();
                if(cantidad_solicitada!=''){
                    SendAjaxPost({
                        rango_id:rango_id,
                        cantidad_solicitada:cantidad_solicitada,
                        procedimiento_id:procedimiento_id,
                        csrf_token:csrf_token
                    },'Abasto/ValeOsteosintesis/AjaxSolicitud',function (response) {
                        location.reload();
                    })
                }
            }
        });
    });
    $(document).on('click','.eliminar-vs-solicitud',function () {
        var vale_id=$(this).attr('data-id');
        var rango_id=$(this).attr('data-rango');
        var procedimiento_id=$(this).attr('data-procedimiento');
        SendAjaxPost({
            vale_id:vale_id,
            rango_id:rango_id,
            procedimiento_id:procedimiento_id,
            csrf_token:csrf_token
        },'Abasto/ValeOsteosintesis/AjaxEliminarSolicitud',function (response) {
            location.reload();
        });
    });
    $(document).on('click','.btn-finalizar-vs',function (e) {
        var tratamiento_id=$(this).attr('data-tratamiento');
        e.preventDefault();
        _msjConfirm({
            message:'<div class="col-md-12"><h5 class="line-height">¿GUARDAR Y TERMINAR LA SOLICITUD DEL VALE DE SERVICIO?</h5></div>',
            size:'small'
        },function (result) {
            if(result==true){
                SendAjaxPost({
                    tratamiento_id:tratamiento_id,
                    csrf_token:csrf_token
                },'Abasto/ValeOsteosintesis/AjaxFinalizar',function (response) {
                    location.href=$('.finalizar-tratamiento-url').attr('href');
                })
            }
        })
    })
})