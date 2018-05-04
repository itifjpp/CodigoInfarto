$(document).ready(function (e) {
    $('.guardar-proveedor').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Abasto/Proveedores/AjaxGuardar',function (response) {
            location.href=base_url+'Abasto/Proveedores';
        });
    });
    $('body').on('click','.abs-proveedor-eliminar',function (e) {
        var proveedor_id=$(this).attr('data-id');
        SendAjaxPost({
            proveedor_id:proveedor_id,
            csrf_token:csrf_token
        },'Abasto/Proveedores/AjaxEliminar',function (response) {
            location.reload();
        });
    })
})