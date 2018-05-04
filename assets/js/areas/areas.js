var GetPosAjax=null;
$(document).ready(function () {
    var cama_aislado_select='No';
    $('select[name=area_camas]').val($('select[name=area_camas]').attr('data-value'));
    $('select[name=area_modulo]').val($('select[name=area_modulo]').attr('data-value'));
    $('.form-area-guardar').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+"areas/AjaxGuardarArea",function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                msj_success_noti('Registro Guardado');
                ActionCloseWindowsReload();
            }
        })
    });
    $('body').on('click','.add-cama-area',function (e) {
        AgregarCama({
            cama_id:0,
            title:'Agregar Cama',
            nombre_cama:'',
            cama_aislado:'Si',
            cama_genero:'Sin Especificar',
            area_id:$(this).attr('data-area'),
            accion:'add'
        });
    });
    $('body').on('click','.edit-cama',function (e) {
        AgregarCama({
            cama_id:$(this).attr('data-id'),
            title:'Editar Cama',
            nombre_cama:$(this).attr('data-cama'),
            cama_aislado:$(this).attr('data-aislado'),
            cama_genero:$(this).attr('data-genero'),
            area_id:$(this).attr('data-area'),
            accion:'edit'
        });
    });
    function AgregarCama(info) {
        sighMjsConfirm({
            'title':info.title,
            'message':'<div class="col-md-12">'+
                        '<div class="form-group m-t-5 m-b-5">'+
                            '<input type="text" placeholder="Nombre de la Cama" value="'+info.nombre_cama+'" name="cama_nombre" class="form-control">'+
                        '</div>'+
                        '<div class="form-group m-t-10 m-b-5">'+
                            '<div class="radio radio-success">'+
                                'CAMA AISLADA &nbsp;&nbsp;&nbsp;<input id="yes" type="radio" name="cama_aislado" value="Si">'+
                                '<label for="yes">Si</label>'+
                                '<input id="no" type="radio" name="cama_aislado" value="No" checked="checked">'+
                                '<label for="no">No</label>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var cama_nombre=$('body input[name=cama_nombre]').val();
                var cama_aislado=cama_aislado_select;
                sighAjaxPost({
                    cama_id:info.cama_id,
                    cama_nombre:cama_nombre,
                    cama_aislado:cama_aislado,
                    cama_genero:'Sin Especificar',
                    area_id:info.area_id,
                    accion:info.accion,
                },base_url+'Areas/GuardarCama',function (response) {
                    if(response.accion=='1'){
                        msj_success_noti('Registro Guardado')
                        ActionWindowsReload();
                    }
                })
            }
        })
        $('body input[name=cama_aislado]').click(function () {
            cama_aislado_select=$(this).val();
        })
        $('body input[name=cama_aislado][value="'+info.cama_aislado+'"]').prop("checked",true);
        
    }
    $('body').on('click','.del-area',function (e) {
        if(confirm('¿ELIMINAR REGISTRO Y TODAS LAS CAMAS ASOCIADOS A EL?')){
            sighAjaxGet(base_url+"areas/EliminarArea/"+$(this).attr('data-id'),function () {
                location.reload();
            });
        }
    })
    $('body').on('click','.del-cama',function (e) {
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"areas/EliminarCama/"+$(this).attr('data-id'),
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('Registro Eliminado');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    });
    $('select[name=area_genero]').val($('select[name=area_genero]').attr('data-value'));
    $('select[name=area_modulo]').change(function (e) {
        if($(this).val()=='Observación' && $('input[name=SiGH_OBSERVACION_ENFERMERIA]').val()=='No'){
            $('.mod-genero').removeClass('hide')
        }else{
            $('.mod-genero').addClass('hide');
            $('body select[name=area_genero]').val("");
        }
    });
    if($('select[name=area_modulo]').attr('data-value')=='Observación' && $('input[name=SiGH_OBSERVACION_ENFERMERIA]').val()=='No'){
        $('.mod-genero').removeClass('hide')
    }
})