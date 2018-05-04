$(document).ready(function () {
    $('input[name=triage_id]').focus();
    $('input[name=triage_id]').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"areas/am_areas/ObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'triage_id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    console.log(data)
                    if(data.accion=='1' && input.val()!=''){
                        if(confirm('¿DESEA AGREGAR EL PACIENTE A ESTA ÁREA?')){
                            $.ajax({
                                url: base_url+"areas/am_areas/IngresoPaciente/"+data.paciente.triage_id,
                                dataType: 'json',
                                beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data_a, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data_a.accion=='1'){
                                        msj_success_noti('Paciente Agregado');
                                       ActionWindowsReload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    msj_error_serve();
                                }
                            })
                        }
                    }if(data.accion=='2' && input.val()!=''){
                        msj_error_noti('EL N° DE PACIENTE NO PERTENECE A ESTA ÁREA');
                    }if(data.accion=='3' && input.val()!=''){
                        msj_error_noti('EL PACIENTE YA SE ENCUENTRA AGREGADO A ESTA ÁREA');
                    }if(data.accion=='4' && input.val()!=''){
                        bootbox.confirm({
                            title:'<h5>Cama Ocupada</h5>',
                            message:'LA CAMA ASIGNADA AL PACIENTE NO ESTA DISPONIBLE, ¿DESEA CAMBIAR LA CAMA A OTRA DISPONIBLE?',
                            size:'small',
                            buttons:{
                                confirm:{label:'Si'
                                },cancel:{label:'No'
                                }
                            },callback:function (e) {
                                if(e==true){
                                    bootbox.hideAll();
                                    bootbox.alert({
                                        'title':'<h5 class="text-left color-white" >Seleccionar Cama</h5>',
                                        'message':'<div class="row">'+
                                                    '<div class="col-md-12">'+
                                                        '<div class="form-group">'+
                                                            '<select class="form-control" id="cama_id">'+data.camas+'</select>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>',
                                        'size':'small',
                                        callback:function () {
                                            var cama_id=$('body #cama_id').val();
                                            if(cama_id!=''){
                                                bootbox.hideAll();
                                                $.ajax({
                                                    url: base_url+"areas/am_areas/CambioCamaIngreso",
                                                    type: 'POST',
                                                    dataType: 'json',
                                                    data:{
                                                        ap_id:data.ap_id,
                                                        cama_id:cama_id,
                                                        csrf_token:csrf_token
                                                    },beforeSend: function (xhr) {
                                                        msj_loading();
                                                    },success: function (data_cama, textStatus, jqXHR) {
                                                        bootbox.hideAll();
                                                        if(data_cama.accion=='1'){
                                                            msj_success_noti('Cambio de cama realizado correctamente e ingreso a esta área');
                                                            ActionWindowsReload()
                                                        }
                                                    },error: function (jqXHR, textStatus, errorThrown) {
                                                        msj_error_serve();
                                                        bootbox.hideAll();
                                                    }
                                                })
                                            }
                                        }
                                    })
                                }
                            }
                        })
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
            
            
        }
    })
    $('body').on('click','.alta-paciente',function () {
        if(confirm('¿DAR DE ALTA ESTE PACIENTE?')){
            $.ajax({
                url: base_url+"areas/am_areas/EgresoPaciente/"+$(this).attr('data-id'),
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('Paciente dado de alta');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    bootbox.hideAll();
                    msj_error_serve()
                }
            })
        }
    })
})