$(document).ready(function (evt) {
    $('body').on('click','.btn-protocolo-add',function (evt) {
        var protocolo_id=$(this).attr('data-id');
        var protocolo_nombre_=$(this).attr('data-nombre');
        var protocolo_descripcion_=$(this).attr('data-descripcion');
        var protocolo_action=$(this).attr('data-action');
        sighMjsConfirm({
            title:'AGREGAR PROTOCOLO',
            message:'<div class="col-xs-12">'+
                        '<div class="form-group">'+
                            '<label>NOMBRE DEL PROTOCOLO</label>'+
                            '<input name="protocolo_nombre" value="'+protocolo_nombre_+'" placeholcer="NOMBRE DEL PROTOCOLO..." class="form-control">'+
                        '</div>'+
                        '<div class="form-group no-margin">'+
                            '<label>DESCRIPCIÓN DEL PROTOCOLO</label>'+
                            '<textarea name="protocolo_descripcion" rows="3" value="" placeholcer="ESCRIPCIÓN DEL PROTOCOLO..." class="form-control">'+protocolo_descripcion_+'</textarea>'+
                        '</div>'+
                    '</div>',
            size:'medium'
        },function (cb) {
            if(cb==true){
                var protocolo_nombre=$('body input[name=protocolo_nombre]').val();
                var protocolo_descripcion=$('body textarea[name=protocolo_descripcion]').val();
                if(protocolo_nombre!='' && protocolo_descripcion!=''){
                    sighMsjLoading();
                    sighAjaxPost({
                        protocolo_id:protocolo_id,
                        protocolo_nombre:protocolo_nombre,
                        protocolo_descripcion:protocolo_descripcion,
                        protocolo_action:protocolo_action
                    },base_url+'Sections/Protocolos/AjaxAgregar',function (response) {
                        location.reload();
                    })
                }else{
                    msj_error_noti("TODOS LOS CAMPOS SON REQUERIDOS");
                }
            }
        });
    });
    $('body').on('click','.btn-buscar',function (evt) {
        var empleado_nombre=$('empleado_nombre').val();
        if(empleado_nombre!=''){
            sighMsjLoading();
            sighAjaxPost({
                empleado_nombre:empleado_nombre
            },base_url+'Sections/Protocolos/AjaxBuscarPaciente',function (response) {
                bootbox.hideAll();
                $('#tableResultSearch tbody').html(response.tr);
                InicializeFootable('#tableResultSearch')
            });
        }
    });
    $('body').on('click','.protocolo-agregar-usuario',function (evt) {
        var empleado_id=$(this).attr('data-id');
        var protocolo_id=$('input[name=protocolo_id]').val();
        if(confirm("AGREGAR PACIENTE A ESTE PROTOCOLO")){
            sighAjaxPost({
                empleado_id:empleado_id,
                protocolo_id:protocolo_id
            },base_url+'Sections/Protocolos/AjaxUsuarioProtocolo',function (response) {
                if(response.action==1){
                    msj_success_noti("PACIENTE AGREGADO A ESTE PROTOCOLO");
                }else{
                    msj_error_noti("ESTE PACIENTE YA ESTA AGREGADO A ESTE PROTOCOLO");
                }
            })
        }
    })
});