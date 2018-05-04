$(document).ready(function (){
    $('input[name=buscar_paciente_rx]').focus();
    $('input[name=buscar_paciente_rx]').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"areas/rx/ObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'triage_id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) {
                    console.log(data)
                    if(data.accion=='1' && input.val()!=''){
                        if(data.rx.rx_status=='En Espera'){
                            bootbox.confirm({
                                'title':'<h5>¿Desea agregar a la lista de RX?</h5>',
                                'message':'<h6><b>Folio: </b> '+data.paciente.triage_id+'</h6><h6><b>Nombre: </b> '+data.paciente.triage_nombre+'</h6>',
                                'size':'small',
                                buttons:{
                                    confirm:{
                                        label:'Si'
                                    },cancel:{
                                        label:'No'
                                    }
                                },callback:function (result) {
                                    if(result==true){
                                        bootbox.hideAll();
                                        $.ajax({
                                            url: base_url+"areas/rx/AgregarPacienteRx",
                                            dataType: 'json',
                                            type: 'POST',
                                            data:{
                                                'csrf_token':csrf_token,
                                                'triage_id':data.paciente.triage_id
                                            },
                                            beforeSend: function (xhr) {
                                                msj_loading();
                                            },success: function (data, textStatus, jqXHR) {
                                                bootbox.hideAll();
                                                if(data.accion=='1'){
                                                    location.reload();
                                                }
                                            },error: function (jqXHR, textStatus, errorThrown) {
                                                bootbox.hideAll();
                                                msj_error_serve();
                                            }
                                        })
                                    }
                                },onEscape:function() {}
                            })
                        }if(data.rx.rx_status=='Asignado'){
                            msj_error_noti('EL PACIENTE YA SE ENCUENTRA EN LA LISTA DE RX')
                        }if(data.rx.rx_status=='Salida'){
                            msj_error_noti('EL PACIENTE YA FUE DADO DE ALTA DE RX PARA INGRESAR A CONUSLTORIOS DE ESPECIALIDAD')
                        }
                    }if(data.accion=='2' && input.val()!=''){
                        msj_error_noti('EL PACIENTE NO SE ENCUENTRA EN ESTA ÁREA');
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
    $('body').on('click','.acceso-area-rx-paciente',function (e){
        var rx_traige=$(this).data('id');
        if(confirm('¿Salida al Consultorio de Especialidad?')){
            var rx_anexar_url=prompt("ANEXAR URL","");
            $.ajax({
                url: base_url+"areas/rx/AltaIngresoCE",
                type: 'POST',
                dataType: 'json',
                data: {
                    'triage_id':rx_traige,
                    'csrf_token':csrf_token,
                    'rx_anexar_url':rx_anexar_url
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                    bootbox.hideAll();
                }
            })
        }
    })
})