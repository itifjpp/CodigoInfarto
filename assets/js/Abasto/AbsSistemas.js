$(document).ready(function (e) {
    $('.guardar-sistemas').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Abasto/Sistemas/AjaxNuevoSistema',function (response) {
            window.top.close();
            window.opener.location.reload();
        },'No');
    });
    $('body').on('click','.abs-sistema-eliminar',function (e) {
        var sistema_id=$(this).attr('data-id');
        SendAjaxPost({
            sistema_id:sistema_id,
            csrf_token:csrf_token
        },'Abasto/Sistemas/AjaxEliminarSistema',function (response) {
            location.reload();
        });
    });
    $('select[name=contrato_id]').val($('select[name=contrato_id]').attr('data-value'));
    /*Elementos*/
    $('.guardar-elemento').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Abasto/Sistemas/AjaxNuevoElemento',function (response) {
            window.top.close();
            window.opener.location.reload();
        },'No');
    });
    $('body').on('click','.abs-elemento-eliminar',function (e) {
        var elemento_id=$(this).attr('data-id');
        SendAjaxPost({
            elemento_id:elemento_id,
            csrf_token:csrf_token
        },'Abasto/Sistemas/AjaxEliminarElemento',function (response) {
            location.reload();
        });
    });
    $('.guardar-rangos').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Abasto/Sistemas/AjaxNuevoRango',function (response) {
            window.top.close();
            window.opener.location.reload();
        },'No');
    });
    $('body').on('click','.abs-rango-eliminar',function (e) {
        var rango_id=$(this).attr('data-id');
        SendAjaxPost({
            rango_id:rango_id,
            csrf_token:csrf_token
        },'Abasto/Sistemas/AjaxEliminarRango',function (response) {
            location.reload();
        });
    });
    $('.sistemas-rango-inventario').click(function (e) {
        e.preventDefault();
        var rango_id=$(this).attr('data-rango');
        var inventario=prompt('AGREGAR NUMERO DE EXISTENCIA','');
        if(!isNaN(inventario) && inventario!=null && inventario!=''){
            SendAjaxPost({
                inventario:inventario,
                rango_id:rango_id,
                csrf_token:csrf_token
            },'Abasto/Sistemas/AjaxInventario',function (response) {
                location.reload();
            });
        }
    });
    $('body').on('click','.abs-inventario-eliminar',function (e) {
        var inventario_id=$(this).attr('data-id');
        SendAjaxPost({
            inventario_id:inventario_id,
            csrf_token:csrf_token
        },'Abasto/Sistemas/AjaxEliminarInventario',function (response) {
            location.reload();
        });
    });
})

