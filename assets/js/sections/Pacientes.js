$(document).ready(function (){
    $('select[name=inputSelect]').change(function () {
        if($(this).val()=='POR_NUMERO'){
            $('input[name=inputSearch]').attr('placeholder','INGRESAR N° DE PACIENTE');
        }if($(this).val()=='POR_NOMBRE'){
            $('input[name=inputSearch]').attr('placeholder','Ejemplo: PEREZ PEREZ FELIPE DE JESUS');
        }if($(this).val()=='POR_NSS'){
            $('input[name=inputSearch]').attr('placeholder','INGRESAR N.S.S (SIN AGREGADO)');
        }
    });
    
    $('input[name=inputSearch]').keyup(function (e) {
        if($('select[name=inputSelect]').val()=='POR_NUMERO' && $(this).val().length==11){
            AjaxPaciente();
            $(this).val('');
        }
    })
    $('.formSearch').submit(function (e) {
        e.preventDefault();
        if($('input[name=inputSearch]').val()!=''){
            AjaxPaciente();
        }else{
            msj_error_noti('ESPECIFICAR UN VALOR')
        }
    });
    function AjaxPaciente() {
        sighMsjLoading();
        sighAjaxPost($('.formSearch').serialize(),base_url+"Sections/Pacientes/AjaxPaciente",function (response) {
            bootbox.hideAll();
            if($('select[name=inputSelect]').val()=='POR_NOMBRE'){
                $('.inputSelectNombre').removeClass('hide');
            }else{
                $('.inputSelectNombre').addClass('hide');
            }
            $('#tableResultSearch tbody').html(response.tr)
            InicializeFootable('#tableResultSearch');
            $('body .tip').tooltip();
        })
    }
    $('body').on('click','.iconoPrintTicket',function (e) {
        e.preventDefault();
        AbrirDocumentoMultiple(base_url+'HoraCero/GenerarTicket/'+$(this).attr('data-id'),'Imprimir Ticket')
    })
    $('input[name=triage_id]').keyup(function () {
        var input=$(this);
        var ingreso_id=$(this).val();
        alert('REPORTAR ESTO: Sections/Pacientes/AjaxBuscar')
        if(ingreso_id.length==11 && ingreso_id!=''){
            $.ajax({
                url: base_url+"Sections/Pacientes/AjaxBuscar",
                type: 'POST',
                dataType: 'json',
                data:{
                    ingreso_id:ingreso_id,
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        $('.row-info-paciente').removeClass('hide');
                        $('input[name=ingreso_id_val]').val(data.paciente.ingreso_id);
                        $('input[name=paciente_nombre]').val(data.paciente.triage_nombre);
                        $('input[name=paciente_ap]').val(data.paciente.triage_nombre_ap);
                        $('input[name=paciente_am]').val(data.paciente.paciente_am);
                        $('input[name=paciente_nss]').val(data.pum.paciente_nss);
                        $('input[name=paciente_nss_agregado]').val(data.pum.paciente_nss_agregado);
                    }else{
                        msj_error_noti('EL PACIENTE NO EXISTE');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    MsjError();
                }
            });
            input.val('');
        }
    })
    $('.form-update-info-paciente').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Pacientes/AjaxActualizarInfo",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Información Actualizada');
                    $('.row-info-paciente').addClass('hide');
                    $('.row-info-paciente')[0].reset();
                }
            },error: function (e) {
                bootbox.hideAll();
                console.log(e);
                MsjError();
            }
        })
    });
    /*Eliminar Historial del Paciente*/
    $('input[name=inputSearchDelete]').keyup(function (e) {
        e.preventDefault();
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id!='' && triage_id.length==11){
            SendAjax({
                triage_id:triage_id,
                csrf_token:csrf_token
            },'Sections/Pacientes/AjaxBuscar',function (response) {
                if(response.accion=='1'){
                    bootbox.confirm({
                        title:'<h5>DETALLES DEL PACIENTE</h5>',
                        message:'<div class="row">'+
                                    '<div class="col-md-12">'+
                                        '<h4><b>N° DE FOLIO:</b> '+response.paciente.triage_id+'</h4>'+
                                        '<h4><b>PACIENTE:</b> '+response.paciente.triage_nombre+' '+response.paciente.triage_nombre_ap+' '+response.paciente.triage_nombre_am+'</h4>'+
                                    '</div>'+
                                '</div>',
                        buttons:{
                            cancel:{
                                label:'Cancelar',
                                className:'back-imss'
                            },confirm:{
                                label:'Eliminar Historial',
                                className:'btn-imss-cancel'
                            }
                        },callback:function (res) {
                            if(res==true){
                                var matricula=prompt('CONFIRMAR MATRICULA','');
                                if(matricula!=null & matricula!=''){
                                    AjaxBuscarEmpleado(function (response) {
                                        console.log(response)
                                        if(response.empleado_nivel_acceso=='1'){
                                            SendAjax({
                                                triage_id:triage_id,
                                                csrf_token:csrf_token
                                            },'Sections/Pacientes/AjaxEliminarHistorial',function (response) {
                                                if(response.accion=='1'){
                                                    msj_success_noti('REGISTRO ELIMINADO');
                                                }
                                            },'')
                                        }else{
                                            msj_error_noti('NO TIENE PERMISOS PARA REALIZAR ESTA ACCIÓN');
                                        }
                                    },matricula)
                                }
                            }
                        }
                    })
                }if(response.accion=='2'){
                    msj_error_noti('EL N° DE FOLIO NO EXISTE');
                }
            })
            input.val('');
        }
    });
    $('input[name=NumFolio]').focus();
    $('input[name=NumFolio]').keyup(function () {
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id!='' && triage_id.length==11){
            SendAjaxPost({
                triage_id:triage_id,
                csrf_token:csrf_token
            },'Sections/Pacientes/AjaxExpediente',function (response) {
                if(response.accion=='1'){
                    location.href=base_url+'Sections/Documentos/Expediente/'+triage_id+'/?tipo=Medicos&area='+response.area;
                }else{
                    msj_error_noti('EL N° DE FOLIO INGRESADO NO EXISTE EN LA BASE DE DATOS.')
                }
            });
            input.val("");
        }
    });
});