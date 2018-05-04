$(document).ready(function (e) {
    $('.guardar-contratos').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Abasto/Contratos/AjaxGuardar',function (response) {
            location.href=base_url+'Abasto/Contratos';
        });
    });
    $('body').on('click','.abs-contrato-eliminar',function (e) {
        var contrato_id=$(this).attr('data-id');
        SendAjaxPost({
            contrato_id:contrato_id,
            csrf_token:csrf_token
        },'Abasto/Contratos/AjaxEliminar',function (response) {
            location.reload();
        });
    })
    $('select[name=proveedor_id]').val($('select[name=proveedor_id]').attr('data-value'));
})

