$(document).ready(function (e) {
    if($('input[name=LoadAjaxPacientes]').val()!=undefined){
        sighAjaxGet(base_url_server+'PacientesInChoque',function (response) {
            var tr='';
            $.each(response.sql,function (i,e) {
                tr+='<tr>';
                    tr+='<td>'+(e.ingreso_tipopaciente!==null ? e.ingreso_tipopaciente:'')+'</td>';
                    tr+='<td class="text-uppercase">'+(e.paciente_nombre==''  ? e.paciente_pseudonimo : e.paciente_nombre+' '+e.paciente_ap+' '+e.paciente_am)+'</td>';
                    tr+='<td>'+
                            (e.paciente_nss_armado!==null ? '<b style="color:#F44336">N.S.S/R.F.C ARMADO</b><br>'+e.paciente_nss_armado+'<br>':'')+
                            (e.paciente_nss!==null || e.paciente_nss.length!=0 ? '<b style="color:#256659">N.S.S/R.F.C</b><br>'+e.paciente_nss+' '+e.paciente_nss_agregado :'')
                        '</td>';
                    tr+='<td>'+(e.paciente_sexo!==null ? e.paciente_sexo:'')+'</td>';
                    tr+='<td>'+e.ingreso_date_horacero+' '+e.ingreso_time_horacero+'</td>';
                    tr+='<td>'+
                            '<a href="Asistentesmedicas/Paciente/'+e.ingreso_id+'?via=Choque">'+
                                '<i class="fa fa-share-square-o sigh-color i-20 tip" data-original-title="Requisitar Información" ></i>'+
                            '</a>'+
                        '</td>';
                tr+='</tr>';
            });
            $('.table-choque-index tbody').html(tr);
        });
    }
    $('input[name=paciente_fn]').mask('99/99/9999');

    $('.form-choque-nuevo-pac').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Choque/AjaxGenerarFolio',function (response) {
            bootbox.hideAll();
            location.href=base_url+'Choque';
        })
    });
    $('body select[name=ingreso_tipopaciente]').change(function (e) {
        if($(this).val()=='Identificado'){
            $('body .form-identificado').removeClass('hide');
            $('body .form-no-identificado').addClass('hide');
            $('body .form-espontaneo').removeClass('hide');
        }if($(this).val()=='No Identificado'){
            $('body .form-identificado-nss').addClass('hide');
            $('body .form-identificado').addClass('hide');
            $('body .form-no-identificado').removeClass('hide');
            $('body .form-espontaneo').removeClass('hide');
            $('body .form-no-espontanea').addClass('hide');
        }
    });
    $('body input[name=paciente_nss_bol]').click(function (e) {
       if($(this).val()=='No'){
           $('body .form-identificado-nss').addClass('hide');
       }else{
           $('body .form-identificado-nss').removeClass('hide');
       } 
    });
    $('body input[name=paciente_fna]').mask('9999');
    $('body').on('click','input[name=info_procedencia_esp]',function (e) {
        if($(this).val()=='Si'){
            $('body .form-no-espontanea').addClass('hide');
            $('body .form-espontaneo').removeClass('hide');
        }else{
            $('body .form-no-espontanea').removeClass('hide');
            $('body .form-espontaneo').addClass('hide');
        }
    });
    if($('input[name=inputGetInfoChoque]').val()!=undefined){
        //$('input[name=paciente_nss]').mask('9999999999');
    }
    $('body').on('click','.search-nss-pac-choque',function (e) {
        var inputNss=$('body input[name=pum_nss]').val();
        if(inputNss!=''){
            $.ajax({
                url: base_url+"Sections/VigenciaWs/AjaxVigenciaAcceder",
                type: 'POST',
                dataType: 'json',
                data:{
                    inputNss:inputNss
                },beforeSend: function (xhr) {
                    $('body .col-loading-nss-choque').removeClass('hide');
                },success: function (data, textStatus, jqXHR) {
                    $('body .col-loading-nss-choque').addClass('hide');
                    $('body input[name=triage_nombre_ap]').val(data[0].Paterno);
                    $('body input[name=triage_nombre_am]').val(data[0].Materno);
                    $('body input[name=triage_nombre]').val(data[0].Nombre);
                    $('body input[name=pum_nss_agregado]').val(data[0].AgregadoMedico);
                    $('body input[name=triage_fecha_nac]').val(data[0].FechaNacimiento);
                    $('body input[name=triage_paciente_curp]').val(data[0].Curp);
                    $('body input[name=pum_umf]').val(data[0].DhDeleg);
                    $('body input[name=pum_delegacion]').val(data[0].DhUMF);
                    $('body input[name=info_vigencia_acceder]').val(data[0].ConDerechoSm);
                    if(data[0].Sexo=='M'){
                        $('body select[name=triage_paciente_sexo]').val('HOMBRE');
                    }else{
                        $('body select[name=triage_paciente_sexo]').val('HOMBRE');
                    }
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
        }
    });
    $('.solicitud-am-choque').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+'Choque/AjaxAsistenteMedica',
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    AbrirDocumentoMultiple(base_url+'inicio/documentos/HojaFrontal/'+$('input[name=triage_id]').val(),'HojaFrontal',100);
                    if($('select[name=pia_lugar_accidente]').val()=='TRABAJO'){
                        AbrirDocumentoMultiple(base_url+'inicio/documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',800);
                    }
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                msj_error_serve();
                console.log(e)
                bootbox.hideAll();
                ReportarError(window.location.pathname,e.responseText)
            }
        })
    })
    if($('input[name=triage_paciente_afiliacion_bol]').attr('data-value')!=''){
        $('.triage_paciente_afiliacion_bol').removeClass('hide');
        $('input[name=triage_paciente_afiliacion_bol][value="Si"]').attr('checked',true);
    }
    $('input[name=triage_paciente_afiliacion_bol]').click(function () {
        if($(this).val()=='Si'){
            $('.triage_paciente_afiliacion_bol').removeClass('hide');
        }else{
            $('.triage_paciente_afiliacion_bol').addClass('hide');
        }
    });
    /*GESTION DE CAMAS ENFERMERIA CHOQUE*/
    $('body').on('click','.actualizar-camas-choque',function (e) {
        e.preventDefault();
        AjaxCamas();
    })
    if($('input[name=accion_rol]').val()=='Choque'){
        AjaxCamas();
    }
    function AjaxCamas() {
        $.ajax({
            url: base_url+"Choque/Camas/AjaxCamas",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading('Obteniendo información de camas')
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.result_camas=='NO_HAY_CAMAS'){
                    $('.NO_HAY_CAMAS').removeClass('hide')
                }else{
                    $('.result_camas').html(data.result_camas);
                }
                
            },error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    }
    if($('input[name=AjaxChoqueMedico]').val()!=undefined){
        SendAjaxGet('Choque/AjaxMedico',function (response) {
            var tr='';
            $.each(response.sql,function (i,e) {
                tr+='<tr>'+
                        '<td>'+e.triage_tipo_paciente+'</td>'+
                        '<td>'+(e.triage_nombre!=''? e.triage_nombre+' '+e.triage_nombre_ap+' '+e.triage_nombre_am : e.triage_nombre_pseudonimo)+'</td>'+
                        '<td>'+(e.pum_nss_armado!=null ? '<b style="color:#F44336">ARMADO:</b>'+e.pum_nss_armado+'<br>':'')+' '+(e.pum_nss!=null ? '<b>NSS:</b>'+e.pum_nss+' '+e.pum_nss_agregado:'')+'</td>'+
                        '<td>'+e.triage_paciente_sexo+'</td>'+
                        '<td>'+e.triage_horacero_f+' '+e.triage_horacero_h+'</td>'+
                        '<td>'+
                            '<a href="'+base_url+'Sections/Documentos/Expediente/'+e.triage_id+'/?tipo=Choque" target="_blank">'+
                                '<i class="fa fa-pencil-square-o i-24 color-imss tip" data-original-title="Requisitar Información"></i>'+
                            '</a>'+
                        '</td>'+
                    '</tr>';
            });
            $('.table-choque-medicos tbody').html(tr);
            InicializeFootable('.table-choque-medicos');
        },'No');
    }
    /*------------------------------------------------------------------------*/
    $('body').on('click','.btn-paciente-agregar',function (){
        var cama_id=$(this).data('cama');
        var triage_id=prompt("N° Paciente",$('input[name=triage_id]').val());
        if(triage_id!='' && triage_id!=null){ 
            SendAjaxPost({
                triage_id : triage_id
            },'Choque/Camas/AjaxObtenerPaciente',function (response) {
                console.log(response)
                if(response.accion=='1'){
                    AsociarCama(triage_id,cama_id);
                }if(response.accion=='3'){
                    msj_error_noti('EL N° DE PACIENTE YA TIENE ASIGNADO UNA CAMA');
                }if(response.accion=='4'){

                }
            });
        }
    })
    function AsociarCama(triage_id,cama_id) {
        $.ajax({
            url: base_url+"Choque/Camas/AjaxAsociarCama",
            type: 'POST',
            data: {
                triage_id:triage_id,
                cama_id:cama_id,
            },dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading()
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                AjaxCamas();
            },error: function (e) {
                msj_error_serve(e);
                bootbox.hideAll();
            }
        });
    }
    $('body').on('click','.cambiar-cama-paciente',function (e) {
        e.preventDefault();
        e.preventDefault();
        var triage_id=$(this).attr('data-id');
        var area_id=$(this).attr('data-area');
        var cama_id_old=$(this).attr('data-cama');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR EN N° DE CAMA?')){
            $.ajax({
                url: base_url+"Choque/ObtenerCamasChoque",
                type: 'POST',
                dataType: 'json',
                data:{
                    area_id:area_id,
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    bootbox.confirm({
                        title:'<h5>Cambiar Cama</h5>',
                        message:'<div class="row">'+
                                    '<div class="col-md-12">'+
                                        '<div class="form-group">'+
                                            (data.accion!='2' ? '<label>Seleccionar Cama</label><select name="cama_id" class="form-control">'+data.accion+'</select>' : '<input type="hidden" name="NO_CAMAS" value=""><center><i class="fa fa-warning fa-3x" style="color:#256659"></i><br><h6>NO HAY CAMAS DIPONIBLES</h6></center>')+
                                        '</div>'+
                                    '</div>'+
                                '</div>',
                        size:'small',
                        callback:function (res) {
                            if(res==true){
                                bootbox.hideAll();
                                if($('body input[name=NO_CAMAS]').val()==undefined){
                                    $.ajax({
                                        url: base_url+"Choque/Camas/AjaxCambiarCama",
                                        type: 'POST',
                                        dataType: 'json',
                                        data:{
                                            triage_id:triage_id,
                                            area_id:area_id,
                                            cama_id_old:cama_id_old,
                                            cama_id_new:$('body select[name=cama_id]').val(),
                                        },beforeSend: function (xhr) {
                                            msj_loading()
                                        },success: function (data, textStatus, jqXHR) {
                                            bootbox.hideAll();
                                            if(data.accion=='1'){
                                                AjaxCamas();
                                            }
                                        },error: function (e) {
                                           bootbox.hideAll();
                                            msj_error_serve(e);
                                        }
                                    });
                                }else{
                                    msj_error_noti('NO HAY CAMAS DISPONIBLES.');
                                }
                            }
                        }
                    });
                },error: function (e) {
                    bootbox.hideAll();
                    msj_error_serve(e);
                }
            });
            
        }
    });
    $('body').on('click','.cambiar-enfermera',function () {
        var triage_id=$(this).attr('data-id');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR DE ENFERMERO(A)?')){
            var matricula=prompt('INGRESAR MATRICULA DEL NUEVO ENFERMERO(A)');
            if(matricula!=null && matricula!=''){
                $.ajax({
                    url: base_url+"Choque/Camas/AjaxCambiarEnfermera",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        triage_id:triage_id,
                        empleado_matricula:matricula
                    },beforeSend: function (xhr) {
                        msj_loading('Comprobando existencia de matricula, realizando cambio de enfermero(a)')
                    },success: function (data, textStatus, jqXHR) {
                        bootbox.hideAll();
                        if(data.accion=='1'){
                            msj_success_noti('Cambios guardados')
                            AjaxCamas();
                        }if(data.accion=='2'){
                            msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                        }
                    },error: function (e) {
                        msj_error_serve(e)
                        bootbox.hideAll();
                    }
                })
            }else{
                msj_error_noti('INGRESAR MATRICULA');
            }
        }
    });
    $('body').on('click','.add-tarjeta-identificacion',function (e) {
        var enfermedad=$(this).attr('data-enfermedad');
        var alergia=$(this).attr('data-alergia');
        var triage_id=$(this).attr('data-id');
        e.preventDefault();
        _msjConfirmOpen({
            title:'TARJETA DE IDENTIFICACIÓN',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Enfermedades Cronicodegenerativas</label>'+
                            '<textarea class="form-control" name="ti_enfermedades" maxlength="50" rows="2">'+enfermedad+'</textarea>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="mayus-bold">Alergias</label>'+
                            '<textarea class="form-control" name="ti_alergias" maxlength="85" rows="2">'+alergia+'</textarea>'+
                        '</div>'+
                    '</div>',
            size:'medium'
        },function (result) {
            if(result==true){
                var ti_enfermedades=$('body textarea[name=ti_enfermedades]').val();
                var ti_alergias=$('body textarea[name=ti_alergias]').val();
                SendAjaxPost({
                    triage_id : triage_id,
                    ti_enfermedades : ti_enfermedades,
                    ti_alergias : ti_alergias
                },'Choque/AjaxTarjetaIdentificacion',function (response) {
                    AbrirDocumento(base_url+'Inicio/Documentos/TarjetaDeIdentificacionChoque/'+triage_id+'/?via=ChoqueV2');
                    AjaxCamas();
                });  
            }
        });
    });
    $('body').on('click','.imprimir-pulsera',function (e) {
        e.preventDefault();
        var empleado_matricula=prompt('CONFIRMAR MATRICULA:','');
        var triage_id=$(this).attr('data-id');
        if(empleado_matricula!=null && empleado_matricula!=''){
            $.ajax({
                url: base_url+"Observacion/AjaxVerificaMatricula",
                type: 'POST',
                dataType: 'json',
                data:{
                    empleado_matricula:empleado_matricula,
                    triage_id:triage_id
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        bootbox.confirm({
                            title:'<h5>CONFIRMAR DATOS DEL PACIENTE</h5>',
                            message:'<div class="row">'+
                                        '<div class="col-md-12">'+
                                            '<div class="form-group" style="margin-bottom: 4px!important;">'+
                                                '<label class="mayus-bold">Nombre del paciente</label>'+
                                                '<input type="text" class="form-control" name="triage_nombre" value="'+data.info.triage_nombre+'">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-6" style="padding-right:2px;">'+
                                            '<div class="form-group" style="margin-bottom: 4px!important;">'+
                                                '<label class="mayus-bold">A. Paterno</label>'+
                                                '<input type="text" class="form-control" name="triage_nombre_ap" value="'+data.info.triage_nombre_ap+'">'+
                                            '</div>'+
                                            '<div class="form-group" style="margin-bottom: 4px!important;">'+
                                                '<label class="mayus-bold">N.S.S</label>'+    
                                                '<input type="text" class="form-control" name="pum_nss" value="'+data.pinfo.pum_nss+'">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-6" style="padding-left:2px;">'+
                                            '<div class="form-group" style="margin-bottom: 4px!important;">'+
                                                '<label class="mayus-bold">A. Materno</label>'+
                                                '<input type="text" class="form-control" name="triage_nombre_am" value="'+data.info.triage_nombre_am+'">'+
                                            '</div>'+
                                            '<div class="form-group" style="margin-bottom: 4px!important;">'+
                                                '<label class="mayus-bold">N.S.S AGREGADO</label>'+
                                                '<input type="text" class="form-control" name="pum_nss_agregado" value="'+data.pinfo.pum_nss_agregado+'">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                            ,
                            size:'small',
                            buttons:{
                                cancel:{
                                    label:'Cancelar',
                                    className:'btn-danger'
                                },confirm:{
                                    label:'Guardar e Imprimir',
                                    className:'back-imss'
                                }
                            },callback:function (response) {
                                if(response==true){
                                    var triage_nombre=$('body input[name=triage_nombre]').val();
                                    var triage_nombre_ap=$('body input[name=triage_nombre_ap]').val();
                                    var triage_nombre_am=$('body input[name=triage_nombre_am]').val();
                                    var pum_nss=$('body input[name=pum_nss]').val();
                                    var pum_nss_agregado=$('body input[name=pum_nss_agregado]').val();
                                    $.ajax({
                                        url: base_url+"Observacion/AjaxConfirmarDatos",
                                        dataType: 'json',
                                        type: 'POST',
                                        data:{
                                            empleado_matricula:empleado_matricula,
                                            triage_id:triage_id,
                                            triage_nombre:triage_nombre,
                                            triage_nombre_ap:triage_nombre_ap,
                                            triage_nombre_am:triage_nombre_am,
                                            pum_nss:pum_nss,
                                            pum_nss_agregado:pum_nss_agregado,
                                            pulsera_tipo:'Observación',
                                            csrf_token:csrf_token
                                        },beforeSend: function (xhr) {
                                            msj_loading()
                                        },success: function (data, textStatus, jqXHR) {
                                            if(data.accion=='1'){
                                                AbrirDocumento(base_url+'Inicio/Documentos/ImprimirPulsera/'+triage_id);
                                                AjaxCamas()
                                            }
                                        },error: function (jqXHR, textStatus, errorThrown) {
                                            msj_error_serve();
                                            bootbox.hideAll();
                                        }
                                    })
                                }
                            }
                        })
                    }else{
                        msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    });
    $('body').on('click','.alta-paciente-choque-ne',function(){
        var triage_id=$(this).attr('data-id');
        if(confirm('¿ALTA PACIENTE POR MOTIVO NO ESPECIFICADO?')){
            $.ajax({
                url:base_url+'Choque/AjaxAltaNoEspecificado',
                type:'POST',
                dataType:'json',
                data:{
                    triage_id:triage_id,
                    csrf_token:csrf_token
                },beforeSend:function(e){
                    msj_loading();
                },success:function(data){
                    if(data.accion=='1'){
                        ActionWindowsReload();
                    }
                },error:function(error){
                    bootbox.hideAll();
                    MsjError();
                }
            });
        }
    });
    $('body').on('click','.alta-paciente',function (e){
        var triage_id=$(this).data('triage');
        var cama_id=$(this).data('cama');
        if(confirm('¿DAR DE ALTA PACIENTE?')){
            _msjConfirmOpen({
                title:'ALTA PACIENTE',
                message:'<div class="col-sm-12">'+
                            '<select name="choque_alta" class="form-control">'+
                                '<option value="Alta a Domicilio">Alta a Domicilio</option>'+
                                '<option value="Alta e Ingreso Quirófano">Alta e Ingreso Quirófano</option>'+
                                '<option value="Alta e Ingreso a Hospitalización">Alta e Ingreso a Hospitalización</option>'+
                                '<option value="Alta e ingreso a UCI">Alta e ingreso a UCI</option>'+
                                '<option value="Alta e ingreso a Observación">Alta e ingreso a Observación</option>'+
                                '<option value="Alta y Translado">Alta y Translado</option>'+
                            '</select>'+
                        '</div>',
                size:'small'
            },function (result) {
                if(result===true){
                    var choque_alta=$('body input[name=choque_alta]').val();
                    SendAjaxPost({
                        choque_alta:choque_alta,
                        cama_id:cama_id,
                        triage_id:triage_id,
                        csrf_token:csrf_token
                    },'Choque/AjaxAltaPaciente',function (response) {
                        AjaxCamas();
                    })
                }
            });
        };
    });
    $('body').on('click','.dar-mantenimiento',function(e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        var msj;
        if(accion=='Disponible'){
            msj='¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?';
        }else{
            msj='¿DESEA MANDAR A MANTENIMIENTO ESTA CAMA?';
        }
        if(confirm(msj)){
           $.ajax({
                url: base_url+"Pisos/Camas/AjaxLimpiezaMantenimientoCama",
                type: 'POST',
                dataType: 'json',
                data:{'id':el,'accion':accion,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando cambios');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        AjaxVisorCamas()
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
           })
        }
    });
    $('body').on('click','.finalizar-mantenimiento',function(e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?')){
            SendAjaxPost({
                id:el,
                csrf_token:csrf_token
            },'Observacion/FinalizarLimpiezaMantenimiento',function (response) {
                 AjaxCamas()
            })
        }
    })
});