$(document).ready(function () {
    if($('input[name=AdmisionHospitalaria]').val()!=undefined){
        AjaxCamas();
    }
    $('.ajax-load-camas').click(function (e) {
        e.preventDefault();
        AjaxCamas();
    })
    function AjaxCamas() {
        $.ajax({
            url: base_url+"AdmisionHospitalaria/AjaxVisorCamas",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.visor-camas').html(data.Col);
            },error: function (e) {
                msj_error_serve();
                bootbox.hideAll();
                console.log(e)
            }
        })
    }
    $('input[name=directorio_cp]').blur(function (e){
        if($(this).val()!=''){
            BuscarCodigoPostal({
                'cp':$(this).val(),
                'input1':'directorio_municipio',
                'input2':'directorio_estado',
                'input3':'directorio_colonia'
            })
        }   
    })
    $('body').on('click','.btn-paciente-agregar',function () {
        var cama_id=$(this).attr('data-cama');
        var cama_estatus=$(this).attr('data-accion');
        if(confirm('¿DESEA REALIZAR UNA SOLICITUD DE ASIGNACIÓN DE CAMA A ESTE PACIENTE?')){
            var triage_id=prompt('ESCANEAR N° DE FOLIO','');
            if(triage_id!=null && triage_id!=''){
                $.ajax({
                    url: base_url+"AdmisionHospitalaria/AjaxBuscarPaciente",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        cama_id:cama_id,
                        triage_id:triage_id,
                        csrf_token:csrf_token
                    },beforeSend: function (xhr) {
                        msj_loading();
                    },success: function (data, textStatus, jqXHR) {
                        bootbox.hideAll();
                        if(data.accion=='1'){
                            msj_error_noti('EL PACIENTE ACTUALMENTE TIENE UNA SOLICITUD DE ASIGNACIÓN DE CAMA');
                            
                        }if(data.accion=='2'){
                            var empleado_matricula=prompt('CONFIRMAR MATRICULA','');
                            if(empleado_matricula!=null && empleado_matricula!=''){
                                AbrirVista(base_url+'AdmisionHospitalaria/AsignarCama?cama='+cama_id+'&triage_id='+triage_id+'&empleado_matricula='+empleado_matricula+'&cama_estatus='+cama_estatus,800,500)
                            }else{
                                msj_error_noti('CONFIRMACIÓN DE MATRICULA REQUERIDA');
                            }
                            
                        }
                    },error: function (e) {
                        bootbox.hideAll();
                        MsjError();
                        console.log(e);
                    }
                })
            }else{
                msj_error_noti('ESPECIFICAR N° DE FOLIO')
            }
        }
    });
    $('.form-asignacion-cama').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"AdmisionHospitalaria/AjaxAsignarCama_v2",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading('','No');
            },success: function (data, textStatus, jqXHR) {
                console.log(data);
                bootbox.hideAll();
                if(data.accion=='1'){
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/DOC43051/'+$('input[name=triage_id]').val(),'DOC43051');
                    //AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ImprimirPulsera/'+$('input[name=triage_id]').val(),'Imprimir Pulsera');
                    ActionCloseWindowsReload();
                    
                }if(data.accion=='2'){
                    ActionCloseWindows();
                    msj_error_noti('LA MATRICULA ESPECIFICADA NO EXISTE')
                }
            },error: function (e) {
                bootbox.hideAll();
                MsjError();
                console.log(e)
            }
        })
    });
    $('body input[name=ac_ingreso_matricula]').blur(function () {
        if($(this).val()!=''){
            AjaxBuscarEmpleado(function (response) {
                $('input[name=ac_ingreso_medico]').val(response.empleado_nombre+' '+response.empleado_ap+' '+response.empleado_am)
            },$(this).val())
        }
        
    })
    $('body input[name=ac_salida_matricula]').blur(function () {
        if($(this).val()!=''){
            AjaxBuscarEmpleado(function (response) {
                $('input[name=ac_salida_medico]').val(response.empleado_nombre+' '+response.empleado_ap+' '+response.empleado_am)
            },$(this).val())
        }
    });
    $('body').on('click','.eliminar43051',function () {
        var cama_id=$(this).attr('data-cama');
        var triage_id=$(this).attr('data-triage');
        bootbox.confirm({
            title:'<h5>ELIMINAR SOLICITUD</h5>',
            message:'<div class="row">'+
                        '</div class="col-md-12"><h5>¿ELIMINAR SOLICITUD 43051?</h5></div>'+
                    '</div>',
            size:'small',
            buttons:{
                confirm:{
                    label:'Eliminar',
                    className:'btn-imss-cancel'
                },cancel:{
                    label:'Cancelar',
                    className:'back-imss'
                }
            },callback:function (res) {
                if(res==true){
                    SendAjax({
                        cama_id:cama_id,
                        triage_id:triage_id,
                        csrf_token:csrf_token
                    },'AdmisionHospitalaria/AjaxEliminar43051',function (response) {
                        AjaxCamas();
                        msj_success_noti('SOLICITUD ELIMINADA');
                    },'');
                }
            }
        })
    })
    $('body').on('click','.liberar43051',function () {
        var cama_id=$(this).attr('data-cama');
        var triage_id=$(this).attr('data-triage');
        bootbox.confirm({
            title:'<h5>LIBERAR CAMA DE SOLICITUD</h5>',
            message:'<div class="row">'+
                        '</div class="col-md-12"><h5>¿LIBERAR CAMA SOLICITUD 43051?</h5></div>'+
                    '</div>',
            size:'small',
            buttons:{
                confirm:{
                    label:'Liberar',
                    className:'btn-imss-cancel'
                },cancel:{
                    label:'Cancelar',
                    className:'back-imss'
                }
            },callback:function (res) {
                if(res==true){
                    SendAjax({
                        cama_id:cama_id,
                        triage_id:triage_id,
                        csrf_token:csrf_token
                    },'AdmisionHospitalaria/AjaxLiberarCama43051',function (response) {
                        AjaxCamas();
                        msj_success_noti('CAMA LIBERADA');
                    },'');
                }
            }
        })
    })
    $('body').on('click','.generar43051',function (e) {
        e.preventDefault();
        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/DOC43051/'+$(this).attr('data-triage'),'DOC43051');
    });
    $('.PaseDeVisitaFamiliar').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'AdmisionHospitalaria/AjaxAgregarFamiliar',function (response) {
            window.top.close();
            window.opener.location.reload();
        },'No')
    });
    $('body').on('click','.pases-eliminar-familiar',function (e) {
        SendAjaxPost({
            familiar_id:$(this).attr('data-id'),
            csrf_token:csrf_token
        },'AdmisionHospitalaria/AjaxEliminarFamiliar',function (response) {
            location.reload();
        })
    })
    if($('input[name=inputPerfilFamiliar]').val()!=undefined){
        Webcam.set({
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
        $('.btn-tomar-foto').click(function (e) {
            // TOMAR UNA FOTO INSTANTANEA Y MOSTRARLO EN UNA IMAGEN RETORNANDO EN base64
            Webcam.snap( function(src) {
                    // display results in page
                    $('input[name=familiar_perfil]').val(src);
                    $('.image_profile').attr('src',src).css({
                        width:'100%'
                    });
            } );
        })
        $('.btn-save-img').click(function(e) {
           SendAjaxPost({
               familiar_perfil:$('input[name=familiar_perfil]').val(),
               familiar_id:$('input[name=familiar_id]').val(),
               triage_id:$('input[name=triage_id]').val(),
               csrf_token:csrf_token
           },'AdmisionHospitalaria/AjaxGuardarPerfilFamiliar',function(response) {
               window.close();
               window.opener.location.reload();
            },'Si','No')
        })
    }
    $('input[name=triage_id_pv]').keyup(function (e) {
        var triage_id=$(this).val();
        var input=$(this);
        var tipo_pase=$('input[name=tipo_pase]:checked').val();
        if(triage_id.length==11 && triage_id!=''){
            SendAjaxPost({
                triage_id:triage_id,
                csrf_token:csrf_token
            },'AdmisionHospitalaria/AjaxPacientePV',function (response) {
                if(response.accion=='1'){
                    location.href=base_url+'AdmisionHospitalaria/PasesdeVisitasFamiliares?folio='+triage_id+'&tipo='+tipo_pase
                }
            })
            input.val('');
        }
    });
    $('.form-validar-pase-visita').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'AdmisionHospitalaria/AjaxValidarPase',function (response) {
            window.top.close();
            window.opener.location.reload();
            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/PaseDeVisitaTemp/'+$('input[name=triage_id]').val()+'?tipo='+$('input[name=tipo]').val(),'Vale Visita Tem');
        })
    });
    $('.ajax-del43052').click(function () {
        _msjConfirmOpen({
            title:'ELIMINAR 43051',
            message:'<div class="col-md-12"><h6 class="line-height" style="margin:0px">DESEA ELIMINAR LA ASIGNACIÓN DE CAMA POR 43051, ESTO SE REALIZARA SIEMPRE Y CUANDO NO SE HAYA ASIGNADO CAMA EN ALGUN PISO</h6></div>',
            size:'small'
        },function (result) {
            if(result==true){
                _msjConfirmOpen({
                    title:'INGRESAR N° DE FOLIO',
                    message:'<div class="col-md-12"><input type="text" name="triage_id43051" class="form-control" placeholder="N° DE FOLIO"></div>',
                    size:'small'
                },function (result) {
                    if(result==true){
                        SendAjaxPost({
                            triage_id:$('body input[name=triage_id43051]').val(),
                            csrf_token:csrf_token
                        },'AdmisionHospitalaria/AjaxEliminar43051All',function (response) {
                            if(response.accion=='1'){
                                msj_success_noti('43051 ELIMINADO');
                                AjaxCamas();
                            }else{
                                msj_error_noti('LA ASIGNACIÓN DE CAMAS POR MEDIO DE LA 43051 DEL PACIENTE QUE ESTA INTENTADO ELIMINAR, YA FUE ASIGNADO A UNA CAMA.')
                            }
                        })
                    }
                })    
            }
        })
    });
})