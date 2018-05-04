$(document).ready(function () {
    var viaExpediente=$('input[name=viaExpediente]').val();
    var empleadoSession=$('input[name=empleadoSession]').val();
    var ingreso_id=$('input[name=ingreso_id]').val();

    $('textarea[name=cpr_nota]').wysihtml5();
    $('.hf_motivo_abierto').wysihtml5();
    $('select[name=FoliosAsociados]').change(function (e) {
        if($(this).val()!=''){
            location.href=base_url+'Sections/Documentos/Expediente/'+$(this).val()+'/?tipo='+$(this).attr('data-tipo')
        }
    });
    $('select[name=FoliosAsociados]').val($('select[name=FoliosAsociados]').attr('data-folio'))
    var info_lugar_accidente=$('input[name=info_lugar_accidente]').val();
    if(info_lugar_accidente=='TRABAJO'){
        $('.col-hojafrontal-info').removeClass('hide');
        $('textarea[name=hf_motivo]').keyup(function (e){
            $('textarea[name=asistentesmedicas_da]').val($(this).val());
        })
        $('textarea[name=hf_exploracionfisica]').keyup(function (e){
            $('textarea[name=asistentesmedicas_dl]').val($(this).val());
        })
        $('textarea[name=hf_diagnosticos]').keyup(function (e){
            $('textarea[name=asistentesmedicas_ip]').val($(this).val());
        })
        $('textarea[name=hf_indicaciones]').keyup(function (e){
            $('textarea[name=asistentesmedicas_tratamientos]').val($(this).val());
        })
    }else{
        $('body .hojafrontal-info').removeAttr('required');
    }
    if($('select[name=hf_especialidad]').attr('data-value-2')!=''){
        $('select[name=hf_especialidad]').val($('select[name=hf_especialidad]').attr('data-value-2'));
    }else{
        $('select[name=hf_especialidad]').val($('select[name=hf_especialidad]').attr('data-value'));
    }
    
    $('input[name=po_donador]').click(function (e) {
        if($(this).val()=='Si'){
            $('.po_donador').removeClass('hide');
        }else{
            $('select[name=po_criterio]').val('');
            $('.po_donador').addClass('hide');
        }
    })
    if($('input[name=po_donador]').attr('data-value')!='' && $('input[name=po_donador]').attr('data-value')=='Si'){
        $('input[name=po_donador][value="Si"]').attr('checked',true);
        $('.po_donador').removeClass('hide');
        $('select[name=po_criterio]').val($('select[name=po_criterio]').attr('data-value'))
    }
    $('input[name=hf_intoxitacion]').click(function (e) {
        if($(this).val()=='No'){
            $('.hf_intoxitacion').addClass('hide');
            $('input[name=hf_intoxitacion_descrip]').val('');
        }else{
            $('.hf_intoxitacion').removeClass('hide');
        }
    })
    if($('input[name=hf_intoxitacion]').attr('data-value')!='' && $('input[name=hf_intoxitacion]').attr('data-value')=='Si'){
        $('input[name=hf_intoxitacion]').attr('checked',true);
        $('.hf_intoxitacion').removeClass('hide');
    }
    $('input[name=hf_incapacidad_ptr_eg][value="'+$('input[name=hf_incapacidad_ptr_eg]').attr('data-value')+'"]').attr('checked',true)
    $('.guardar-solicitud-hf').submit(function (e){
        e.preventDefault();
        let dataForm=$(this).serialize();
        sighMsjLoading();
        sighAjaxPost(dataForm,base_url+"Sections/Documentos/GuardarHojaFrontal",function (response) {
            bootbox.hideAll();
            if($('input[name=tipo]').val()=='Consultorios'){
                if($('input[name=ce_status]').val()!='Salida'){
                    GuardarDarAlta($('input[name=ingreso_id]').val());
                }else{
                    OpenLoadView(base_url+'Inicio/Documentos/HojaFrontalCE/'+$('input[name=ingreso_id]').val(),'Hola Frontal',function () {
                        if($('input[name=info_lugar_accidente]').val()=='TRABAJO'){
                            OpenLoadView(base_url+'Inicio/Documentos/ST7/'+$('input[name=ingreso_id]').val(),'ST7',function () {
                                if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                    OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                        window.opener.location.reload();
                                        window.top.close();
                                    });
                                }else{
                                    window.opener.location.reload();
                                    window.top.close();
                                }
                            });
                        }else{
                            if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                    window.opener.location.reload();
                                    window.top.close();
                                });
                            }else{
                                window.opener.location.reload();
                                window.top.close();
                            }
                        } 
                    })    
                }
            }else{
                OpenLoadView(base_url+'Inicio/Documentos/HojaFrontalCE/'+$('input[name=ingreso_id]').val(),'Hola Frontal',function () {
                    if($('input[name=info_lugar_accidente]').val()=='TRABAJO'){
                        OpenLoadView(base_url+'Inicio/Documentos/ST7/'+$('input[name=ingreso_id]').val(),'ST7',function () {
                            if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                    window.opener.location.reload();
                                    window.top.close();
                                });
                            }else{
                                window.opener.location.reload();
                                window.top.close();
                            }
                        });
                    }else{
                        if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                            OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                window.opener.location.reload();
                                window.top.close();
                            });
                        }else{
                            window.opener.location.reload();
                            window.top.close();
                        }
                    } 
                })    
            }
        });
    })
    $('input[name=asistentesmedicas_incapacidad_am]').click(function (e){
        if($(this).val()=='Si'){
            $('input[name=asistentesmedicas_incapacidad_ga]').removeAttr('disabled');
        }else{
            $('input[name=asistentesmedicas_incapacidad_ga]').attr('disabled',true);
            $('input[name=asistentesmedicas_incapacidad_ga][value=No]').prop("checked",true).click();
        }
    })
    $('input[name=asistentesmedicas_incapacidad_ga]').click(function (e){
        if($(this).val()=='Si'){
            $('select[name=asistentesmedicas_incapacidad_tipo]').removeAttr('disabled').click();
            $('input[name=asistentesmedicas_incapacidad_folio]').removeAttr('readonly');
            $('input[name=asistentesmedicas_incapacidad_fi]').removeAttr('readonly');
            $('input[name=asistentesmedicas_incapacidad_da]').removeAttr('readonly');
        }else{
            $('input[name=asistentesmedicas_incapacidad_folio]').attr('readonly',true).val('');
            $('input[name=asistentesmedicas_incapacidad_fi]').attr('readonly',true).val('');
            $('input[name=asistentesmedicas_incapacidad_da]').attr('readonly',true).val('');
            $('select[name=asistentesmedicas_incapacidad_tipo]').attr('disabled',true).val('');
            $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','hidden').val('');
            
        }
    })
    if($('input[name=asistentesmedicas_incapacidad_am]').attr('data-value')=='Si'){
        $('input[name=asistentesmedicas_incapacidad_ga]').removeAttr('disabled');
        $('input[name=asistentesmedicas_incapacidad_ga][value="'+$('input[name=asistentesmedicas_incapacidad_ga]').data('value')+'"]').prop("checked",true).click();
        $('select[name=asistentesmedicas_incapacidad_tipo]').val($('select[name=asistentesmedicas_incapacidad_tipo]').attr('data-value'));
        
    }
    if($('input[name=asistentesmedicas_incapacidad_ga]').attr('data-value')=='Si' && $('select[name=asistentesmedicas_incapacidad_tipo]').attr('data-value')=='Subsecuente'){
        $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','text');
    }
    $('select[name=asistentesmedicas_incapacidad_tipo]').click(function () {
        if($(this).val()=='Subsecuente'){
            $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','text');
        }else{
            $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','hidden');
        }
    })
    /**/
    $('input[name=hf_intoxitacion][value="'+$('input[name=hf_intoxitacion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_urgencia][value="'+$('input[name=hf_urgencia]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_especialidad][value="'+$('input[name=hf_especialidad]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_ab][value="'+$('input[name=hf_mecanismolesion_ab]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_td][value="'+$('input[name=hf_mecanismolesion_td]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_av][value="'+$('input[name=hf_mecanismolesion_av]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_maquinaria][value="'+$('input[name=hf_mecanismolesion_maquinaria]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_mordedura][value="'+$('input[name=hf_mecanismolesion_mordedura]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_quemadura_fd][value="'+$('input[name=hf_quemadura_fd]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_ce][value="'+$('input[name=hf_quemadura_ce]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_e][value="'+$('input[name=hf_quemadura_e]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_q][value="'+$('input[name=hf_quemadura_q]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_trataminentos_curacion][value="'+$('input[name=hf_trataminentos_curacion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_sutura][value="'+$('input[name=hf_trataminentos_sutura]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_vendaje][value="'+$('input[name=hf_trataminentos_vendaje]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_ferula][value="'+$('input[name=hf_trataminentos_ferula]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_vacunas][value="'+$('input[name=hf_trataminentos_vacunas]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_ministeriopublico][value="'+$('input[name=hf_ministeriopublico]').data('value')+'"]').prop("checked",true);
    
    $('select[name=hf_alta]').val($('select[name=hf_alta]').attr('data-value'))
    $('select[name=hf_alta]').click(function (e) {
        if($(this).val()=='Otros'){
            $('.hf_alta_otros').removeClass('hide');
        }else{
            $('.hf_alta_otros').addClass('hide');
        }
    });
    if($('select[name=hf_alta]').attr('data-value')=='Otros'){
        $('.hf_alta_otros').removeClass('hide');
    }
    $('input[name=asistentesmedicas_ss_in][value="'+$('input[name=asistentesmedicas_ss_in]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_ss_ie][value="'+$('input[name=asistentesmedicas_ss_ie]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_ss_in][value="'+$('input[name=asistentesmedicas_oc_hr]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_oc_hr][value="'+$('input[name=asistentesmedicas_ss_in]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_incapacidad_am][value="'+$('input[name=asistentesmedicas_incapacidad_am]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_omitir]').click(function (e){
        if($(this).val()=='Si'){
            $('.asistentesmedicas_omitir').addClass('hide').find('.hojafrontal-info').removeAttr('required');
        }else{
            $('.asistentesmedicas_omitir').removeClass('hide').find('.hojafrontal-info').attr('required',true);
        }
    })
    if($('input[name=asistentesmedicas_omitir]').data('value')!='' && info_lugar_accidente=='TRABAJO'){
        $('input[name=asistentesmedicas_omitir][value="'+$('input[name=asistentesmedicas_omitir]').data('value')+'"]').prop("checked",true);
        if($('input[name=asistentesmedicas_omitir]').data('value')=='Si'){
            $('.asistentesmedicas_omitir').addClass('hide').find('.hojafrontal-info').removeAttr('required');
        }if($('input[name=asistentesmedicas_omitir]').data('value')=='No'){
            $('.asistentesmedicas_omitir').removeClass('hide').find('.hojafrontal-info').attr('required',true);
        }
    }
    $('input[name=hf_alta][type=radio]').click(function (e){
        $('input[name=hf_alta][type=text]').val('');
    });
    /*SERVCIO TRATANTE*/
    $('body select[name=hf_servicio_tratante]').val($('body select[name=hf_servicio_tratante]').attr('data-value'))
    function GuardarDarAlta(Folio) {
        sighMjsConfirm({
            title:'GUARDAR Y DAR DE ALTA',
            message:'<div class="col-md-12">'+
                        '<h5 class="no-margin">¿GUARDAR DATOS DATOS DEL PACIENTE Y DAR DE ALTA DE CONSULTORIO?</h5>'+
                    '</div>',
            size:'medium',
            lb_cancel:'Espera Paciente',
            lb_accept:'Egresar Paciente'
        },function (result) {
            if(result==true){
                sighAjaxPost({
                    ingreso_id:Folio
                },base_url+"Consultorios/AjaxReportarSalida",function (response) {
                    OpenLoadView(base_url+'Inicio/Documentos/HojaFrontalCE/'+$('input[name=ingreso_id]').val(),'Hola Frontal',function () {
                        if($('input[name=info_lugar_accidente]').val()=='TRABAJO'){
                            OpenLoadView(base_url+'Inicio/Documentos/ST7/'+$('input[name=ingreso_id]').val(),'ST7',function () {
                                if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                    OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                        window.opener.location.reload();
                                        window.top.close();
                                    });
                                }else{
                                    window.opener.location.reload();
                                    window.top.close();
                                }
                            });
                        }else{
                            if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                    window.opener.location.reload();
                                    window.top.close();
                                });
                            }else{
                                window.opener.location.reload();
                                window.top.close();
                            }
                        } 
                    })    
                    
                })
            }else{
                bootbox.hideAll();
                OpenLoadView(base_url+'Inicio/Documentos/HojaFrontalCE/'+$('input[name=ingreso_id]').val(),'Hola Frontal',function () {
                    if($('input[name=info_lugar_accidente]').val()=='TRABAJO'){
                        OpenLoadView(base_url+'Inicio/Documentos/ST7/'+$('input[name=ingreso_id]').val(),'ST7',function () {
                            if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                    window.opener.location.reload();
                                    window.top.close();
                                });
                            }else{
                                window.opener.location.reload();
                                window.top.close();
                            }
                        });
                    }else{
                        if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                            OpenLoadView(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=ingreso_id]').val(),'NMP',function () {
                                window.opener.location.reload();
                                window.top.close();
                            });
                        }else{
                            window.opener.location.reload();
                            window.top.close();
                        }
                    } 
                })    
            }
        })
    }
    //$('textarea[name=nota_nota]').wysihtml5();
    
    $('.Form-Notas-HojaFrontal').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxHfCE",
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading()
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardado');
                    AbrirDocumento(base_url+'Inicio/Documentos/NotaConsultoriosEspecialidad/'+data.notas_id);
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                msj_error_serve(e);
                ReportarError(window.location.pathname,e.responseText);
            }
        })
    })
    /*Uso de generacion de documento dinamicos*/
    if($('select[name=notas_tipo]').attr('data-value')!=''){
        $('select[name=notas_tipo]').val($('select[name=notas_tipo]').attr('data-value'));
    }
    /***/
    $('#hf_mecanismolesion').change(function () {
        if($(this).val().indexOf('Caida')!=-1){
            $('.mecanismo-lesion-caida').removeClass('hide');
        }else{
            $('input[name=hf_mecanismolesion_mtrs]').val('');
            $('.mecanismo-lesion-caida').addClass('hide');
        }
        if($(this).val().indexOf('Otros')!=-1){
            $('.mecanismo-lesion-otros').removeClass('hide');
        }else{
            $('input[name=hf_mecanismolesion_otros]').val('');
            $('.mecanismo-lesion-otros').addClass('hide');
        }
    })
    $('#hf_quemadura').change(function () {
        if($(this).val().indexOf('Otros')!=-1){
            $('.quemadura-otros').removeClass('hide');
        }else{
            $('input[name=hf_quemadura_otros]').val('');
            $('.quemadura-otros').addClass('hide');
        }
    })
    if($("input[name=hf_mecanismolesion_mtrs]").val()!=undefined){
        $("#hf_quemadura").val($('#hf_quemadura').attr('data-value').split(',')).select2();
        $("#hf_mecanismolesion").val($('#hf_mecanismolesion').attr('data-value').split(',')).select2();
        $("#hf_trataminentos").val($('#hf_trataminentos').attr('data-value').split(',')).select2();
    }
    
    if($('input[name=hf_mecanismolesion_mtrs]').val()!=''){
        $('.mecanismo-lesion-caida').removeClass('hide');
    }
    if($('input[name=hf_mecanismolesion_otros]').val()!=''){
        $('.mecanismo-lesion-otros').removeClass('hide');
    }
    if($('input[name=hf_quemadura_otros]').val()!=''){
        $('.quemadura-otros').removeClass('hide');
    }
    $('#hf_trataminentos').change(function () {
        if($(this).val().indexOf('Otros')!=-1){
            $('.hf_trataminentos_otros').removeClass('hide');
        }else{
            $('input[name=hf_trataminentos_otros]').val('');
            $('.hf_trataminentos_otros').addClass('hide');
        }
    });
    if($('input[name=hf_trataminentos_otros]').val()!=''){
        $('.hf_trataminentos_otros').removeClass('hide');
    }
    
    /*Diagnosticos*/
    if($('input[name=cie10_nombre').val()!=undefined){
       $('input[name=cie10_nombre').shieldAutoComplete({
            dataSource: {
                data: CIE10,
            },minLength: 5
        }); 
    }
    
    $('input[name=cie10_nombre]').removeClass('sui-input');
    $('body').on('click','.add-cie10',function() {
        if($('input[name=cie10_nombre]').val()!=''){
            SendAjax({csrf_token:csrf_token,cie10_nombre:$('input[name=cie10_nombre]').val()},'Sections/Documentos/AjaxCheckCIE10',function (response) {
                if(response.accion=='1'){
                    AjaxGuardarDiagnostico({
                        cie10_nombre:$('input[name=cie10_nombre]').val(),
                        cie10hf_obs:'',
                        cie10hf_id:0,
                        accion:'add'
                    })
                    $('input[name=cie10_nombre]').val('');   
                }else{
                    msj_error_noti('EL DIAGNOSTICO CIE10 NO EXISTE POR FAVOR SELECCIONE UNO DE LA LISTA')
                }
            },'');
             
        }
        
    })
    $('body').on('click','.sui-listbox-item',function() {
        var diagnostico=$(this).text();
        AjaxGuardarDiagnostico({
            cie10_nombre:diagnostico,
            cie10hf_obs:'',
            cie10hf_id:0,
            accion:'add'
        })
        $('input[name=cie10_nombre]').val('');
    })
    $('body').on('click','.editar-diagnostico-cie10',function() {
        AjaxGuardarDiagnostico({
            cie10_nombre:$(this).attr('data-nombre'),
            cie10hf_obs:$(this).attr('data-obs'),
            cie10hf_id:$(this).attr('data-id'),
            accion:'edit',
        })
    })
    function AjaxGuardarDiagnostico(info){
        bootbox.confirm({
            title:"<h5>AGREGAR DIAGNOSTICO</h5>",
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<label class="mayus-bold">'+info.cie10_nombre+'</label><br>'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_tipo" value="Primario" checked="">'+
                                    '<i class="blue"></i>Primario'+
                                '</label>&nbsp;&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_tipo" value="Secundario">'+
                                    '<i class="blue"></i>Secundario'+
                                '</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_estado" value="Presuntivo" checked="">'+
                                    '<i class="blue"></i>Presuntivo'+
                                '</label>&nbsp;&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_estado" value="Definitivo">'+
                                    '<i class="blue"></i>Definitivo'+
                                '</label>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<textarea class="form-control" name="cie10hf_obs" placeholcer="Observaciones...">'+info.cie10hf_obs+'</textarea>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons:{
                cancel:{
                    label:'Cancelar',
                    className:'btn-imss-cancel'
                },confirm:{
                    label:'Acepar',
                    className:'back-imss'
                }
            },callback:function(response){
                if(response==true){
                    var cie10hf_obs=$('body textarea[name=cie10hf_obs]').val();
                    var triage_id=$('body input[name=triage_id]').val();
                    var cie10hf_tipo=$('body input[name=cie10hf_tipo]:checked').val();
                    var cie10hf_estado=$('body input[name=cie10hf_estado]:checked').val()
                    SendAjax({
                        accion:info.accion,
                        cie10_nombre:info.cie10_nombre,
                        triage_id:triage_id,
                        cie10hf_obs:cie10hf_obs,
                        cie10hf_tipo:cie10hf_tipo,
                        cie10hf_estado:cie10hf_estado,
                        cie10hf_id:info.cie10hf_id,
                        csrf_token:csrf_token
                    },'Sections/Documentos/AjaxGuardarDiagnosticos',function(response) {
                        console.log(response)
                        if(response.accion=='1'){
                            AjaxObtenerDiagnosticos();
                        }else{
                            msj_error_noti('EL DIAGNOSTICO NO EXISTE');
                        }
                    },'');
                }
            }
            
        })
    }
    function AjaxObtenerDiagnosticos() {
        SendAjax({
            triage_id:$('input[name=triage_id]').val(),
        },'Sections/Documentos/AjaxObtenerDiagnosticos',function(response) {
            $('.row-diagnosticos').html(response.row)
        },'');
    }
    if($('input[name=cie10_nombre]').val()!=undefined){
        //AjaxObtenerDiagnosticos();
    }
    $('body').on('click','.eliminar-diagnostico-cie10',function(e) {
        var cie10hf_id=$(this).attr('data-id');
        $.ajax({
            url:base_url+'Sections/Documentos/AjaxEliminarDiagnostico',
            type: 'POST',
            dataType: 'json',
            data:{
                cie10hf_id:cie10hf_id
            },beforeSend: function (xhr) {
                
            },success: function (data, textStatus, jqXHR) {
                AjaxObtenerDiagnosticos()
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                MsjError();
            }
        })
    })
    /*Documento de Hoja Frontal Formato Abierto*/
    $('.hf_diagnosticos_abierto').wysihtml5();
    $('.guardar-solicitud-hi-abierto').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxHojaInicialAbierto",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if($('input[name=tipo]').val()=='Consultorios'){
                    if($('input[name=ce_status]').val()!='Salida'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaInicialAbierto/'+$('input[name=triage_id]').val(),'Hola Inicial',100);
                        ActionCloseWindowsReload();
                    }else{
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaInicialAbierto/'+$('input[name=triage_id]').val(),'Hola Inicial',100);
                        if($('input[name=info_lugar_accidente]').val()=='TRABAJO'){
                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',500);
                        }
//                        if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
//                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=triage_id]').val(),'NMP',800);
//                        }
                    }
                    
                }else{
                    bootbox.hideAll();
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaInicialAbierto/'+$('input[name=triage_id]').val(),'Hola Inicial',100);
                    if($('input[name=info_lugar_accidente]').val()=='TRABAJO'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',500);
                    }
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                MsjError();
                console.log(e);
            }
        });
    });
    $('input[name=es_residente]').click(function () {
        if($(this).val()=='Si'){
            $('select[name=notas_medicotratante]').attr('required',true);
            $('.notas_medicotratante').removeClass('hide');
        }else{
            $('.notas_medicotratante').addClass('hide');
            $('select[name=notas_medicotratante]').select2('val','').select2();
            $('select[name=notas_medicotratante]').removeAttr('required');
        }
    })
    if($('input[name=TIPO_MEDICO]').val('Médico R. Torres Hospitalización')){
        $('select[name=notas_medico_autoriza]').select2('val',$('select[name=notas_medico_autoriza]').attr('data-value')).select2();
        $('select[name=notas_medico_supervisa]').select2('val',$('select[name=notas_medico_supervisa]').attr('data-value')).select2();
        
        $('select[name=ha_medico_autoriza]').select2('val',$('select[name=ha_medico_autoriza]').attr('data-value')).select2();
        $('select[name=ha_medico_supervisa]').select2('val',$('select[name=ha_medico_supervisa]').attr('data-value')).select2();
    }
    $('body').on('click','.medico-torres-prealta',function (e) {
        var triage_id=$(this).attr('data-id');
        _msjConfirm({
            message:'<div class="col-md-12">'+
                        '<h5 class="line-height">¿DESEA ASIGNAR ESTE PACIENTE EN ESTADO DE PRE-ALTA?</h5>'+
                    '</div>',
            size:'small'
        },function (res) {
            if(res==true){
                SendAjaxPost({
                    triage_id:triage_id,
                },'Pisos/Medico/AjaxPrealta',function (response) {
                    msj_success_noti('EL PACIENTE SE ENCUENTRA EN UN ESTADO DE PREALTA');
                    location.reload();
                });
            }
        });
    });
    var PasteImages=[];
    $('.Form-Notas-COC').submit(function (e) {
        e.preventDefault();
        PasteImages=[];
        $('.row-paste-img img').each(function (e) {
            PasteImages.push($(this).attr('src'));
        });
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Documentos/AjaxNotas',function (response) {
            if(response.accion=='1'){
                sighAjaxPost({
                    PasteImages:PasteImages,
                    notas_id:response.notas_id,
                    ingreso_id:$('input[name=ingreso_id]').val(),
                },base_url+'Sections/Documentos/AjaxNotasAnexos',function (response2) {
                    OpenLoadView(base_url+'Inicio/Documentos/GenerarNotas/'+response.notas_id+'?inputVia='+$('input[name=via]').val(),'NOTAS',function () {
                        bootbox.hideAll();
                        window.opener.location.reload();
                        window.top.close();
                    });
                })

            }
        },'','No')
    });
    $('body').on('click','.icon-remove-img',function () {
        var Padre=$(this).parents('.col-img-paste');
        Padre.remove();
    });
    $('body').on('click','.icon-remove-img-bd',function () {
        var anexo_id=$(this).attr('data-id');
        var Padre=$(this).parents('.col-img-anexos');
        SendAjaxPost({
            anexo_id:anexo_id,
        },'Sections/Documentos/AjaxNotasEliminarAnexo',function (response) {
            Padre.remove();
        });
        
    });
    $(document).on('click','.icono-remove-notas',function (e) {
        var notas_id=$(this).attr('data-value');
        if(confirm('¿DESEA ELIMINAR ESTA NOTA MÉDICA?')){
            SendAjaxPost({
                notas_id:notas_id,
            },'Sections/Documentos/AjaxEliminarNotas',function (response) {
                location.reload();
            });
        }
    });
    $(document).on('click','.btn-add-dx-hoja-alta',function (e) {
        e.preventDefault();
        var dx_id=$(this).attr('data-id');
        var dx_tipo_=$(this).attr('data-tipo');
        var dx_val=$(this).attr('data-dx');
        var ha_id=$(this).attr('data-ha');
        var key_temp=$(this).attr('data-key-temp');
        var dx_accion=$(this).attr('data-accion');
        _msjConfirmOpen({
            title:'AGREGAR DX',
            message:'<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<select class="form-control" name="dx_tipo">'+
                                '<option value="">SELECCIONAR TIPO DE DX</option>'+
                                '<option value="DX DE INGRESO">DX DE INGRESO</option>'+
                                '<option value="DX DE EGRESO(DX PRINCIPAL)">DX DE EGRESO(DX PRINCIPAL)</option>'+
                                '<option value="DX DE COMORBILIDAD">DX DE COMORBILIDAD</option>'+
                                '<option value="DX DE COMPLICACIÓN INTRAHOSPITALARIA">DX DE COMPLICACIÓN INTRAHOSPITALARIA</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<input type="text" name="dx_codificacion" class="form-control" placeholder="CODIFICACION">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<div class="form-group" style="margin-bottom:0px!important">'+
                            '<textarea class="form-control" placeholder="AGREGAR DIAGNOSTICO" rows="6" name="dx">'+dx_val+'</textarea>'+
                        '</div>'+
                    '</div>',
            size:'medium'
        },function (result) {
            if(result==true){
                var dx=$('body textarea[name=dx]').val();
                var dx_tipo=$('body select[name=dx_tipo]').val();
                if(dx!=''){
                    SendAjaxPost({
                        dx_id:dx_id,
                        dx_tipo:dx_tipo,
                        dx:dx,
                        dx_codificacion:$('input[name=dx_codificacion]').val(),
                        ha_id:ha_id,
                        dx_temp:key_temp,
                        dx_accion:dx_accion,
                    },'Sections/Documentos/AjaxHojaAltaDx',function (response) {
                        if(response.accion=='1'){
                            AjaxDxs();
                        }
                    })
                }else{
                    msj_error_noti('DIAGNOSTICO REQUERIDO!');
                }
            }
        });
    });
    $(document).on('click','.btn-add-proc-hoja-alta',function (e) {
        e.preventDefault();
        var pro_id=$(this).attr('data-id');
        var pro_fecha=$(this).attr('data-fecha');
        var pro_nombre=$(this).attr('data-pro')
        var ha_id=$(this).attr('data-ha');
        var key_temp=$(this).attr('data-key-temp');
        var pro_accion=$(this).attr('data-accion');
        _msjConfirmOpen({
            title:'AGREGAR PROCEDIMIENTOS',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<input type="text" name="pro_nombre" class="form-control" placeholder="NOMBRE DEL PROCEDIMIENTO">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<input type="text" name="pro_codificacion" class="form-control" placeholder="CODIFICACION">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<input type="text" name="pro_fecha" class="form-control" placeholder="FECHA DE PROCEDIMIENTO">'+
                        '</div>'+
                    '</div>',
                    
            size:'medium'
        },function (result) {
            if(result==true){
                var pro_nombre=$('body input[name=pro_nombre]').val();
                var pro_codificacion=$('body input[name=pro_codificacion]').val();
                var pro_fecha=$('body input[name=pro_fecha]').val();
                if(pro_nombre!=''){
                    SendAjaxPost({
                        pro_id:pro_id,
                        pro_nombre:pro_nombre,
                        pro_codificacion:pro_codificacion,
                        pro_fecha:pro_fecha,
                        ha_id:ha_id,
                        pro_temp:key_temp,
                        pro_accion:pro_accion,
                        csrf_token:csrf_token
                    },'Sections/Documentos/AjaxHojaAltaPro',function (response) {
                        if(response.accion=='1'){
                            AjaxProcedimientos();
                        }
                    })
                }else{
                    msj_error_noti('PROCEDIMIENTO REQUERIDO!');
                }
            }
        });
        $('body input[name=pro_fecha]').datepicker({
            autoclose:true,
            format:'yyyy-mm-dd'
        })
    });
    if($('input[name=ha_id]').val()!=undefined){
//        AjaxDxs();
//        AjaxProcedimientos();
    }
    function AjaxDxs(){
        SendAjaxPost({
            ha_id:$('input[name=ha_id]').val(),
            ha_temp:$('input[name=ha_temp]').val(),
        },'Sections/Documentos/AjaxHojaAltaDxGet',function (response) {
            $('.table-dx-hah tbody').html(response.tr)
        })
    };
    function AjaxProcedimientos(){
        SendAjaxPost({
            ha_id:$('input[name=ha_id]').val(),
            ha_temp:$('input[name=ha_temp]').val(),
        },'Sections/Documentos/AjaxHojaAltaProGet',function (response) {
            $('.table-procedimientos-hah tbody').html(response.tr)
        },'No')
    };
    $('select[name=ha_motivo_egreso]').click(function (e) {
        if($(this).val()=='DEFUNCIÓN'){
            $('.col-dx-defuncion').removeClass('hide');
        }else{
            $('.col-dx-defuncion').addClass('hide');
            $('textarea[name=ha_egreso_df_dx1]').val('');
            $('textarea[name=ha_egreso_df_dx2]').val('');
        }
    });
    $('.Form-Hoja-Alta-Hospitalaria').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Documentos/AjaxHojaAltaHospitalaria',function (response) {
            bootbox.hideAll();
            ActionCloseWindowsReload();
            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/GenerarHojaAltaHospitalaria/'+response.ha_id+'?inputVia='+$('input[name=inputVia]').val())
        });
    });
    $('select[name=ha_motivo_egreso]').val($('select[name=ha_motivo_egreso]').attr('data-value'));
    $('select[name=ha_envio]').val($('select[name=ha_envio]').attr('data-value'));
    $('input[name=ha_egreso_df_autopsia][value="'+$('input[name=ha_egreso_df_autopsia]').attr('data-value')+'"]').attr('checked',true);
    $('select[name=ha_ramo_seguro]').val($('select[name=ha_ramo_seguro]').attr('data-value'));
    $('select[name=ha_programa]').val($('select[name=ha_programa]').attr('data-value'));
    $('select[name=ha_planificacion]').val($('select[name=ha_planificacion]').attr('data-value'));
    if($('select[name=ha_motivo_egreso]').attr('data-value')=='DEFUNCIÓN'){
        $('.col-dx-defuncion').removeClass('hide');
    }else{
        $('.col-dx-defuncion').addClass('hide');
        $('textarea[name=ha_egreso_df_dx1]').val('');
        $('textarea[name=ha_egreso_df_dx2]').val('')
    }
    $(document).on('click','.btn-notificar-mp',function () {
        let triage_id=$(this).attr('data-folio');
        let mp_area=$(this).attr('data-tipo')
        if(confirm("ESTA SEGURO QUE DESEA NOTIFICAR AL MINISTERIO PUBLICO")){
            SendAjaxPost({
                triage_id:triage_id,
                mp_area:mp_area,
            },'Sections/Documentos/AjaxNotificarMP',function (response) {
                if(response.accion=='1'){
                    location.reload();
                }else{
                    msj_error_noti("ESTE PACIENTE YA TIENE UNA SOLICITUD ENVIADA AL MP")
                }
            });
        }
    });
    $(document).on('change','select[name=cie10_n1]',function () {
        let grp10=$(this).val();
        if(grp10!=''){
            let grp10_split=grp10.split(':');
            $('body select[name=cie10_n2]').html("");
            $('body select[name=cie10_n3]').html("");
            $('body select[name=cie10_n4]').html("");
            sighAjaxPost({
                grp10:grp10_split[0],
            },base_url+'Sections/Documentos/AjaxCie10N2',function (response) {
                $('body select[name=cie10_n2]').html(response.option);
                $("#cie10_n2 option[value='"+grp10_split[1]+"']").remove();
            },'No');
        }
    });
    $('select[name=cie10_n1]').select2();
    $('select[name=cie10_n2]').select2();
    $('select[name=cie10_n3]').select2();
    $('select[name=cie10_n4]').select2();
    $(document).on('change','select[name=cie10_n2]',function () {
        let grp10=$(this).val();
        if(grp10!=''){
            $('body select[name=cie10_n3]').html("");
            $('body select[name=cie10_n4]').html("");
            sighAjaxPost({
                grp10:grp10,
            },base_url+'Sections/Documentos/AjaxCie10N3',function (response) {
                $('body select[name=cie10_n3]').html(response.option);
            },'No');
        }
    });
    $(document).on('change','select[name=cie10_n3]',function () {
        let grp10=$(this).val();
        $('body select[name=cie10_n4]').val("");
        if(grp10!=''){
            sighAjaxPost({
                grp10:grp10,
            },base_url+'Sections/Documentos/AjaxCie10N4',function (response) {
                $('body select[name=cie10_n4]').html(response.option);
            },'No');
        }
    });
    $(document).on('submit','.form-add-dx-paciente',function (e) {
        e.preventDefault();
        var button=$(this).find('button').attr('data-accion');
        var button_dx=$(this).find('button').attr('data-dx');
        if(button=='Si'){
            window.top.close();
            window.opener.$('textarea[name='+$('input[name=input_text]').val()+']').val(button_dx);
        }else{
            sighMsjLoading();
            sighAjaxPost($(this).serialize(),base_url+'Sections/Documentos/AjaxDxPaciente',function (response) {
                bootbox.hideAll();
                if(response.accion=='1'){
                    window.top.close();
                    if($('select[name=dx_tipo]').val()=='PRIMARIO'){
                        window.opener.$('textarea[name='+$('input[name=input_text]').val()+']').val($('textarea[name=dx_dx]').val()+" | DX CIE10: "+$('select[name=cie10_n4]').val());
                    }else{
                        window.opener.$('textarea[name='+$('input[name=input_text]').val()+']').val($('textarea[name=dx_dx]').val()+" | DX CIE10: "+$('select[name=cie10_n4]').val());
                    }
                    window.opener.AjaxGetDx($('input[name=dx_temp]').val());
                }else{
                    msj_error_noti("NADA MAS SE PUEDE AGREGAR UN DIAGNOSTICO PRIMARIO")
                }

            },'No');     
        }

    });
    if($('input[name=getDX]').val()!=undefined){
        AjaxGetDx($('input[name=temp]').val());
    }
    if($('input[name=DxPrimario]').val()!=undefined){
        $('select[name=dx_tipo]').change(function (e) {
            if($(this).val()=='PRIMARIO' && $('input[name=DxPrimario]').val()>0){
                $('body button').attr('data-accion','Si');
                $('textarea[name=dx_dx],select[name=cie10_n1],#cie10_n2,#cie10_n3,#cie10_n4').attr('disabled',true);
                $('.form-dx-primario').removeClass('hide');
                $('button').attr('data-accion','Si');
            }else{
                $('button').attr('data-accion','No');
                $('textarea[name=dx_dx],select[name=cie10_n1],#cie10_n2,#cie10_n3,#cie10_n4').removeAttr('disabled');
                $('.form-dx-primario').addClass('hide');
            }
        });
    }
    $('input[name=ADD_MORE_DX]').click(function (e) {
        if($(this).val()=='SI'){
            $('textarea[name=dx_dx],select[name=cie10_n1],#cie10_n2,#cie10_n3,#cie10_n4').removeAttr('disabled');
            $('.form-dx-primario').addClass('hide');
            $('input[name=ADD_MORE_DX][value="NO"]').prop('checked',true);
            $('body button').attr('data-accion','No');
        }else{
            $('textarea[name=dx_dx],select[name=cie10_n1],#cie10_n2,#cie10_n3,#cie10_n4').attr('disabled',true);
            $('.form-dx-primario').removeClass('hide');
            $('body button').attr('data-accion','Si');
            
        }
    });
    $(document).on('click','.dx-cie10-del',function () {
        var dx_id=$(this).attr('data-id');
        sighMsjLoading();
        sighAjaxPost({
            dx_id:dx_id
        },base_url+'Sections/Documentos/AjaxElimiarDxCie10',function () {
            bootbox.hideAll();
            AjaxGetDx($('input[name=temp]').val());
        })
    });
    /*SOLICITANDO DATOS AL SERVIDOR DE NODE JS*/
    if($('input[name=ServerNodeJs]').val()!=undefined){
        
        
        sighAjaxGet(base_url_server+'InformacionPaciente/'+ingreso_id,function (res) {
            let response=res[0];
            let row='';
            row+=   '<div style="position: relative">'+
                        '<div style="top:-14px;position: absolute;height: 105px;width: 35px;left: -1px;" class="'+ObtenerColorClasificacion(response.ingreso_clasificacion)+'"></div>'+
                    '</div>'
            row+=   '<div class="col-md-8 col-xs-8" style="padding-left: 40px;">'+
                        '<h3 class="color-white semi-bold no-margin text-uppercase">'+response.paciente_nombre+' '+response.paciente_ap+' '+response.paciente_am+'</h3>'+
                        '<h4 class="text-uppercase color-white no-margin text-uppercase">'+response.paciente_sexo+' | <b>R.F.C:</b> '+response.paciente_rfc+'</h4>'+
                        '<h4 class="color-white no-margin text-uppercase">'+(response.info_procedencia_esp=='Si' ? 'ESPONTANEA: '+response.info_procedencia_esp_lugar : response.info_procedencia_hospital+' '+response.info_procedencia_hospital_num)+' | '+response.ingreso_clasificacion+'</h4>'+
                    '</div>';
            if(response.paciente_fn!=null){
                let pacienteFecha=response.paciente_fn.split('/');
                diffBetweenDatesMomentJS(getFechaHora(),pacienteFecha[2]+'-'+pacienteFecha[1]+'-'+pacienteFecha[0],function (result) {
                    row+='<div class="col-md-4 col-xs-4 text-right">'+
                          '<h4 class="text-right color-white">EDAD</h4>'+
                          '<h2 class="text-right color-white no-margin">'+result.years+' Años '+result.months+' Meses</h2>'+
                        '</div>'
                    $('.row-loading-expediente').addClass('hide');
                    $('.row-load-expediente').removeClass('hide').html(row);
                });
            }else{
                row+='<div class="col-md-4 col-xs-4">'+
                          '<h4 style="" class="text-right"><b>EDAD</b></h4>'+
                          '<h1 style="margin-top: 0px" class="text-right">SD AÑOS</h1>'+
                        '</div>'
                $('.row-loading-expediente').addClass('hide');
                $('.row-load-expediente').removeClass('hide').html(row);
            }
            if(response.info_lugar_accidente=='TRABAJO'){
                $('body .icon-st7').removeClass('hide');
            }
            $('input[name=paciente_id]').val(response.paciente_id);
            $('input[name=paciente_nss]').val(response.paciente_nss);
            $('input[name=paciente_nss_agregado]').val(response.paciente_nss_agregado);
            getEventosMedicos();
        })    
    }
    function getEventosMedicos() {
        var paciente_id=$('input[name=paciente_id]').val();
        SendAjaxGetApi(base_url_server+'EventosMedicos/'+paciente_id,function (response) {
            console.log(response)
            let totalEventos=0;
            $.each(response.eventos,function (i,e) {
                totalEventos++;
                $('select[name=FoliosAsociados]').append('<option value="'+e.ingreso_id+'">'+e.ingreso_id+' - '+e.ingreso_date_horacero+' '+e.ingreso_time_horacero+'</option>')
            });
            if(totalEventos>=10){
                $('.total-eventos-medicos').removeClass('col-sm-2').addClass('col-sm-3').find('h1').html(totalEventos);
            }else{
                $('.total-eventos-medicos').removeClass('col-sm-2').addClass('col-sm-2').find('h1').html(totalEventos);
            }
            getNotasMedicas();
        },'No');
    }
    function getNotasMedicas() {
        var inputIngresoEgreso=$('input[name=inputIngresoEgreso]').val();
        sighAjaxGet(base_url_server+'NotasMedicas/'+ingreso_id,function (response) {
            if(response.notas.length>0){
                var tr='';
                $.each(response.notas,function (i,e) {
                    tr+='<tr>';
                        tr+='<td>'+e.notas_fecha+' '+e.notas_hora+'</td>';
                        tr+='<td>'+e.notas_tipo+'</td>';
                        tr+='<td>'+e.notas_area+'</td>';
                        tr+='<td>'+e.empleado_nombre+' '+e.empleado_ap+' '+e.empleado_am+'</td>';
                        tr+='<td>'+
                                '<i class="fa fa-file-pdf-o sigh-color i-20 tip pointer abrir-documento__" data-url="Inicio/Documentos/GenerarNotas/'+e.notas_id+'?inputVia='+viaExpediente+'"></i>'+
                                (e.empleado_id==empleadoSession ? '&nbsp;&nbsp;<a href="'+base_url+'Sections/Documentos/Notas/'+e.notas_id+'?a=edit&TipoNotas='+e.notas_tipo+'&folio='+ingreso_id+'&via='+viaExpediente+'&temp='+e.notas_temp+'&DxTipo=Notas" class="'+(inputIngresoEgreso!=''? 'hide':'')+'" target="_blank"><i class="fa fa-pencil sigh-color i-20"></i></a>':'')
                            '</td>';
                    tr+='</tr>';
                });
                $('body .table-expediente-paciente tbody').append(tr);
                InicializeFootable('.table-expediente-paciente')
            }
        });
    }
    
    /*PETICIONES AL SERVIDOR NGINX*/
    $('body').on('click','.abrir-documento__',function () {
        AbrirDocumento(base_url+$(this).attr('data-url'))
    });
    $('body').on('click','.interconsulta-paciente',function (e){
        var ingreso_id=$(this).attr('data-id');
        if(confirm('¿INTERCONSULTA?')){
            sighMsjLoading();
            sighAjaxGet(base_url+"Consultorios/ObtenerEspecialidades",function (response) {
                bootbox.hideAll();
                sighMjsConfirm({
                    title:'SELECCIONAR DESTINO',
                    message:'<div class="col-sm-12">'+
                                '<div class="form-group">'+
                                    '<select id="select_destino" class="form-control" style="width:100%">'+response.option+'</select>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<textarea class="form-control" name="doc_diagnostico" rows="4" maxlength="300" placeholder="Diagnostico"></textarea>'+
                                '</div>'+
                            '</div>'
                },function (result) {
                    if(result==true){
                        var doc_servicio_solicitado=$('body #select_destino').val();
                        var doc_diagnostico=$('body textarea[name=doc_diagnostico]').val();
                        if(doc_diagnostico!=''){
                            bootbox.hideAll();
                            sighMsjLoading();
                            sighAjaxPost({
                                doc_servicio_solicitado:doc_servicio_solicitado,
                                doc_diagnostico:doc_diagnostico,
                                ingreso_id:ingreso_id
                            },base_url+'Sections/Documentos/AjaxInterConsulta',function (response) {
                                bootbox.hideAll();
                                if(response.accion=='1'){
                                    OpenLoadView(base_url+'Inicio/Documentos/DOC430200/'+response.Interconsulta,'Doc Interconsulta',function () {
                                        location.reload();
                                    });
                                    
                                }if(response.accion=='2'){
                                    MsjNotificacion('<h5>ERROR</h5>','<center><i class="fa fa-exclamation-triangle fa-5x" style="color:#E62117"></i><br>LA INTERCONSULTA SOLICITADO A ESTE CONSULTORIO YA FUE REALIZADO </center>')
                                }
                            });
                        }else{
                            msj_error_noti('DIAGNOSTICO REQUERIDO');
                        }
                    }
                });
                $("#select_destino option[value='"+$('input[name=especialidad_nombre]').val()+"']").remove();
            });
        }
    });
});
function AjaxGetDx(temp) {
    sighAjaxPost({
        temp:temp
    },base_url+'Sections/Documentos/AjaxGetDx',function (response) {
        $('body .table-dx-pac tbody').html(response.tr);
        InicializeFootable('.table-dx-pac');
    })
}
if($('input[name=PasteImg]').val()!=undefined){
    function paste(src) {
        $('.info-imp-paste').remove();
        $('.row-paste-img').append('<div class="col-md-4 col-img-anexos col-img-paste">'+
                                        '<i class="fa fa-trash-o color-imss i-20 icon-remove-img"></i>'+
                                        '<img src="' + src + '" style="width:100%">'+
                                    '</div>');
    }
    $(function() {
            $.pasteimage(paste);
    });   
}

