$(document).ready(function () {
    $('input[name=inventario_id]').focus();
    $('input[name=inventario_id]').keypress(function (e) {
        let input=$(this);
        let inventario_id=$(this).val();
        let rc_id=$('input[name=rc_id]').val();
        if(e.which==13 && inventario_id!=''){
            SendAjaxPost({
                inventario_id:inventario_id,
                rc_id:rc_id,
                csrf_token:csrf_token
            },'Abasto/Inventario/AjaxCheckExistencia',function (response) {
                if(response.accion=='1'){
                    location.reload();
                }if(response.accion=='2'){
                    msj_error_noti("EL CÓDIGO INGRESADO NO EXISTE EN LA BASE DE DATOS DEL INVENTARIO");
                }if(response.accion=='3'){
                    msj_error_noti("EL CÓDIGO DE MATERIAL YA ESTA ASIGNADO")
                }
                input.val("");
                $('input[name=inventario_id]').get(0).focus();
            });
        }
    });
    $('body').on('click','.eliminar-rc-in',function (e) {
        let inventario_id=$(this).attr('data-inventario');
        SendAjaxPost({
            inventario_id:inventario_id,
            csrf_token:csrf_token
        },'Abasto/Inventario/AjaxEliminaRCIN',function (response) {
            location.reload();
        })
    });
    $('input[name=inventario_id_dev]').focus();
    $('input[name=inventario_id_dev]').keypress(function (e) {
        let input=$(this);
        let inventario_id=$(this).val();
        let rc_id=$('input[name=rc_id]').val();
        if(e.which==13 && inventario_id!=''){
            SendAjaxPost({
                inventario_id:inventario_id,
                rc_id:rc_id,
                csrf_token:csrf_token
            },'Abasto/Inventario/AjaxCheckDevolucion',function (response) {
                if(response.accion=='1'){
                    location.reload();
                }if(response.accion=='2'){
                    msj_error_noti("EL CÓDIGO INGRESADO NO EXISTE EN LA BASE DE DATOS DEL INVENTARIO");
                }if(response.accion=='3'){
                    msj_error_noti("EL CÓDIGO INGRESADO AUN NO SE A ASOCIADO A UNA RELACIÓN DE SALIDA");
                }if(response.accion=='4'){
                    msj_error_noti("EL CÓDIGO DEL MATERIAL INGRESADO HA SIDO OCUPADO");
                }
                input.val("");
                $('input[name=inventario_id_inv]').get(0).focus();
            });
        }
    });
});