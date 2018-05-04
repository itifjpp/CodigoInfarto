$(document).ready(function (e) {
    $('input[name=clasificacion_omision]').click(function (e) {
        if($(this).val()=='Si'){
            $('input[name=clasificacionColor]').attr('required',true);
            $('.msj-clasificacion').hide();
            $('.col-omitir-clasificacion').addClass('hide');
            $('.row-clasificacion-omitida').removeClass('hide')
        }else{
            $('input[name=clasificacionColor]').removeProp('checked');
            $('input[name=clasificacionColor]').removeAttr('required');
            $('.col-omitir-clasificacion').removeClass('hide');
            $('.row-clasificacion-omitida').addClass('hide');
        }
    })
    var TriageArea=$('input[name=TriageArea]').val();
    $('#input_search,#input_search_am').focus()
    $('#input_search').keypress(function (e){
        var input=$(this);
        var ingreso_id=$(this).val();
        if(e.which==13 && ingreso_id!=''){ 
            sighMsjLoading();
            sighAjaxGet(base_url_server+'TriagePaciente/'+ingreso_id+'/'+TriageArea,function (response) {
                console.log(response)
                bootbox.hideAll();
                if(response.msj=='FOLIO NO VALIDO'){
                    sighMsjError('ERROR EL FOLIO INGRESADO NO EXISTE','small','Si');
                }if(response.msj=='NO ENFERMERIA'){
                    sighMsjError('ESTE PACIENTE NO TIENE REGISTRADO SIGNOS VITALES, ENVIAR AL PACIENTE CON LA ENFERMERA DE TRAIGE','small','No');
                }if(response.msj=='PACIENTE NO CLASIFICADO'){
                    location.href=base_url+'Triage/Paciente/'+ingreso_id;
                }if(response.msj=='PACIENTE CLASIFICADO'){
                    sighMjsConfirm({
                        title:'EL PACIENTE YA FUE CLASIFICADO',
                        message:'<div class="col-xs-12">'+
                                    '<div style="height:10px;width:100%;margin-top:0px" class="'+ObtenerColorClasificacion(response.info.ingreso_clasificacion)+'"></div>'+
                                '</div>'+
                                '<div class="col-xs-12 m-t-10">'+
                                    '<h3 class="m-t-5 m-b-5 text-uppercase"><b>PACIENTE: </b> '+response.info.paciente_nombre+' '+response.info.paciente_ap+' '+response.info.paciente_am+'</h3>'+
                                    '<h3 class="m-t-5 m-b-5 text-uppercase"><b>MÉDICO: </b> '+response.medico.empleado_nombre+' '+response.medico.empleado_ap+' '+response.medico.empleado_am+'</h3>'+
                                    '<h3 class="m-t-5 m-b-5 text-uppercase"><b>DESTINO: </b> '+response.info.ingreso_destino_triage+' '+response.info.ingreso_consultorio_nombre+'</h3>'+
                                '</div>'+
                                '<div class="col-xs-4">'+
                                    '<h6 class="line-height"><b><i class="fa fa-clock-o sigh-color"></i> HORA CERO: </b><br> '+response.info.ingreso_date_horacero+' '+response.info.ingreso_time_horacero+'</h6>'+
                                '</div>'+
                                '<div class="col-xs-4">'+
                                    '<h6 class="line-height"><b><i class="fa fa-heartbeat sigh-color"></i> HORA ENFERMERÍA: </b><br> '+response.info.ingreso_date_enfermera+' '+response.info.ingreso_time_enfermera+'</h6>'+
                                '</div>'+
                                '<div class="col-xs-4">'+
                                    '<h6 class="line-height"><b><i class="fa fa-user-md sigh-color"></i> HORA CLASIFICACIÓN: </b><br> '+response.info.ingreso_date_medico+' '+response.info.ingreso_time_medico+'</h6>'+
                                '</div>'+
                                '<div class="col-xs-12 '+(response.info.ingreso_en=='Médico Triage' && response.medico.empleado_id==SiGH_USER ? '':'hide')+'">'+
                                    '<h5 class="no-margin pointer mt-cambiar-clasificacion" style="color:red" data-id="'+response.info.ingreso_id+'"><i class="fa fa-pencil-square-o "></i> CAMBIAR DESTINO Y CLASIFICACIÓN</h5>'+
                                '</div>',
                        size:'medium',
                        lb_accept:'Generar Hoja de Clasificación',
                        lb_cancel:'Cancelar'
                    },function (cb) {
                        if(cb==true){
                            AbrirDocumento(base_url+'inicio/Documentos/Clasificacion/'+response.info.ingreso_id)
                        }
                    });
                }
            });
            input.val("");
        }else{
            //sighMsjError('FOLIO DE INGRESO NO VALIDO','small');
        }
    });
    $('body').on('click','.mt-cambiar-clasificacion',function (evt) {
        var ingreso_id=$(this).attr('data-id');
        var msjConfirm= sighMjsConfirm({
            title:'CAMBIAR CLASIFICACIÓN',
            message:'<div class="col-xs-12">'+
                        '<h6 class="no-margin line-height">¿ESTA SEGURO QUE SEGURO QUE DESEA RECLASIFICAR A ESTE PACIENTE?</h6>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id:ingreso_id
                },base_url+'Triage/AjaxReclasificar',function () {
                    bootbox.hideAll();
                    location.href=base_url+'Triage/Paciente/'+ingreso_id;
                });
                
            }
        });
    })
    
    $('.input-radio-medico').click(function (e){
        var TotalClasificacion=0;
        $('.input-radio-medico').each(function (i,e) {
            var inputValue=$(this).val();
            if($(this).is(':checked')){
                TotalClasificacion=TotalClasificacion+parseInt($(this).val());
            }
        });
        var clasificacion_bg='';
        var clasificacion_msj='';
        if(TotalClasificacion<14){
            clasificacion_bg='blue';
            clasificacion_msj='Urgencia Sentida'
        }if(TotalClasificacion>=15 && TotalClasificacion<19){
            clasificacion_bg='yellow-A700';
            clasificacion_msj='Urgencia Relativa';
        }if(TotalClasificacion>19){
            clasificacion_bg='red';
            clasificacion_msj='Urgencia Real';
        }
        $('.msj-clasificacion').removeClass('blue yellow-A700 red').show();
        $('.msj-clasificacion').addClass(clasificacion_bg);
        $('.msj-clasificacion h3').html('<i class="fa fa-stethoscope color-sigh"></i> '+TotalClasificacion+' '+clasificacion_msj);
        
        
    });
    $('body input[name=clasificacionColor]').click(function () {
        if($('input[name=clasificacionColor]:checked').val()=='Rojo' || $('input[name=clasificacionColor]:checked').val()=='Naranja'){
            sighMjsConfirm({
                title:'URGENCIA REAL',
                message:'<div class="col-xs-12">'+
                            '<h5 class="line-height no-margin text-justify">LOS PACIENTES CON CLASIFICACIÓN <span style="color:#F14D4D">ROJA O NARANJA</span> PASAN <span style="color:#F14D4D">DIRECTAMENTE A CHOQUE.</span> ¿ESTA SEGURO DE CLASIFICAR ESTE PACIENTE CON ESTE NIVEL DE URGENCIA?</h5>'+
                        '</div>',
                size:'small'
            },function (cb) {
                if(cb==true){
                    sighMsjLoading();
                    sighAjaxPost({
                        ingreso_id:$('input[name=ingreso_id]').val(),
                        clasificacionColor:$('input[name=clasificacionColor]:checked').val(),
                        paciente_id:$('input[name=paciente_id]').val()
                    },base_url+'Triage/AjaxClasificacionChoque',function (response) {
                        
                        OpenLoadView(base_url+'Inicio/documentos/Clasificacion/'+$('input[name=ingreso_id]').val(),'Clasifiacion',function () {
                            socket.emit('UpdateAnalisisIngresos',{
                                action:1
                            });
                            socket.emit('UpdateWaitingList',{
                                action:1
                            });
                            location.href=base_url+'Triage/Medicotriage';
                        });
                        
                    });
                }else{
                    $('input[name=clasificacionColor]').removeAttr('checked')
                }
            })
        }    
    })
    
    $('.btn-submit-paso2').on('click',function(e){
        e.preventDefault();
        
        if($('input[name=clasificacion_omision][value="Si"]').is(':checked') && !$('input[name=clasificacionColor]').is(":checked")){
            return ;
        }
        sighMsjLoading();
        sighAjaxGet(base_url+"Consultorios/AjaxObtenerConsultoriosV2",function (response) {
            bootbox.hideAll();
            if($('input[name=ConfigDestinosMT]').val()=='Si'){
                AjaxSeleccionarConsultorio(response.option);
            }else{
                AjaxGuardarTriage();
            }  
        });
    });
    function AjaxSeleccionarConsultorio(option){
        sighMjsConfirm({
            title: 'SELECCIONAR DESTINO',
            message:'<div class="col-xs-12">'+
                        '<div class="form-group no-margin">'+
                            '<select class="width100" name="destino_paciente">'+
                                '<option value="">SELECCIONAR DESTINO</option>'+
                                '<option value="Consultorios">Consultorios</option>'+
                                '<option value="Observación">Observación</option>'+
                                '<option value="Reanimación-Choque">Reanimación-Choque</option>'+
                                '<option value="Alta de Unidad">Alta de Unidad</option>'+
                                '<option value="Otra Unidad Médica">Otra Unidad Médica</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="form-group div-seleccionar-destino hide m-t-10 m-b-5">'+
                            '<select class="width100" name="select_destino" id="select_destino"></select>'+
                        '</div>'+
                        '<div class="form-group m-t-10 m-b-5">'+
                            '<label>AGREGAR NOTAS:</label>'+
                            '<input type="text" class="form-control" name="clasificacion_notas_" placeholder="EJ. EL PACIENTE SE ENVIA A RX, CHOQUE">'+
                        '</div>'+
                        '<textarea name="ac_diagnostico_select" rows="3" maxlength="200" class="form-control hide" placeholder="Diagnostico Presuncional" style="margin-top:10px"></textarea>'+
                    '</div>',
            size:'small'
        },function (res) {
            if(res==true){
                if($('body select[name=destino_paciente]').val()=='Consultorios'){
                    var select_destino=$('body #select_destino').val().split(';');
                    $('input[name=ingreso_consultorio]').val(select_destino[0]);
                    $('input[name=ingreso_consultorio_nombre]').val(select_destino[1]);
                    
                }
                $('input[name=clasificacion_notas]').val($('body input[name=clasificacion_notas_]').val());
                $('input[name=ac_diagnostico]').val($('body textarea[name=ac_diagnostico_select]').val());
                AjaxGuardarTriage();
            }
        });
        $('body').on('change','select[name=destino_paciente]',function (evt) {
            //var loading=sighMsjLoading();
            var destino_paciente=$(this).val();
            $('input[name=ingreso_destino_triage]').val(destino_paciente);
            if(destino_paciente=='Consultorios'){
                sighAjaxPost({
                    destino_paciente:destino_paciente
                },base_url+'Triage/AjaxGetDestinoPacientes',function (response) {
                    $('body .div-seleccionar-destino').removeClass('hide');
                    $('body select[name=select_destino]').html(response.option);
                });
            }else{
                $('body .div-seleccionar-destino').addClass('hide');
            }
            
        })
        $('body').on('change','#select_destino',function (e){
            if($(this).val()=='0;Ortopedia-Admisión Continua'){
                $('body textarea[name=ac_diagnostico_select]').removeClass('hide');
            }else{
                $('body textarea[name=ac_diagnostico_select]').addClass('hide');
            }
        })
    }
    $('input[name=triage_preg1_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Pérdida súbita del estado de alerta','Si el paciente tiene o no el antecedente inmediato previo o situación clínica de ausencia abrupta de respuesta a los'+
            'estímulos del medio ambiente, lo que motiva su atención en el servicio.');
        }
    })
    $('input[name=triage_preg2_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Apnea','Si el paciente presenta o no ausencia de movimientos respiratorios al examinar su habitus exterior.');
        }
    })
    $('input[name=triage_preg3_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Ausencia de pulso','Si el paciente'+
                'presenta o no ausencia del latido intermitente de las arterias, que normalmente se puede percibir en varias'+
                'partes del cuerpo y especialmente en la muñeca de la mano.')
        }
    })
    $('input[name=triage_preg4_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Intubación de vía respiratoria','Si el paciente'+
                'se encuentra o no con intubación de la vía respiratoria orotraqueal, o con la presencia de cualquier dispositivo'+
                'cilíndrico hueco en la vía respiratoria superior, cuya finalidad es asegurar la permeabilidad de las mismas y'+
                'lograr una ventilación pulmonar eficaz.')
        }
    })
    $('input[name=triage_preg5_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Angor o equivalente','Si el paciente'+
                'presenta o no un cuadro caracterizado por dolor torácico'+
                'anterior de tipo opresivo habitualmente irradiado al'+
                'brazo izquierdo y al cuello, potencialmente acompañado'+
                'de palidez, sudoración fría, náusea, disnea, sensación'+
                'de ahogo y de urgencia urinaria o deseos de defecar;'+
                'producto todo de isquemia miocárdica.')
        }
    })
    
    function msj_evaluacion(el,title,msj){
        sighMjsConfirm({
            title: title,
            message:'<div class="col-sm-12">'+
                        '<h5 class="line-height no-margin text-uppercase">'+msj+'</h5>'+
                    '</div>',
            size:'medium'
        },function (res) {
            if(res==true){
                AjaxGuardarTriage();   
            }else{
                $('body input[name='+el.attr('name')+'][value="0"]').prop('checked',true);
            }
        });
    }
    function AjaxGuardarTriage() {
        var form=$('body .agregar-paso2').serialize();  
        sighMsjLoading();
        sighAjaxPost(form,base_url+"Triage/GuardarClasificacion",function (response) {
            bootbox.hideAll();
            if($('input[name=ingreso_solicitud_rx]').val()=='Si'){
                OpenLoadView(base_url+'inicio/documentos/Clasificacion/'+response.ingreso_id+'?sol='+$('input[name=solicitud_id]').val(),'Clasificacion',function () {
//                    socket.emit('UpdateAnalisisIngresos',{
//                        action:1
//                    });
                    socket.emit('UpdateWaitingList',{
                        action:1
                    });
                    location.href=base_url+'Triage/Medicotriage';
                });
            }else{
                OpenLoadView(base_url+'inicio/documentos/Clasificacion/'+response.ingreso_id,'Clasifiacion',function () {
//                    socket.emit('UpdateAnalisisIngresos',{
//                        action:1
//                    });
                    socket.emit('UpdateWaitingList',{
                        action:1
                    });
                    location.href=base_url+'Triage/Medicotriage';
                });
            }
        });
    }
    $('.form-indicador-triage').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+"Triage/AjaxIndicador",function (response) {
            console.log(response)
            bootbox.hideAll();
            $('.triage-indicador-export').removeClass('hide');
            $('.triage-indicador-rs').html(response.TOTAL_INFO_CAP)   
        });
    });
    $('.triage-indicador-export').click(function (e) {
        AbrirVista(base_url+'Inicio/Documentos/ReporteIndicadorTriage?inputFecha='+$('input[name=inputFecha]').val()+'&inputTurno='+$('select[name=inputTurno]').val())
    })
    if($('input[name=SolicitudRx]').val()!=undefined){
        AjaxSolicitudesRx();
    }
    function AjaxSolicitudesRx() {
       
        sighAjaxPost({
            ingreso_id:$('input[name=ingreso_id]').val(),
        },base_url+'Rx/AjaxSolicitudesRxTriage',function (response) {
            $('.table-solicitudes-rx-triage tbody').html(response.tr);
        },'No');
    }
    $('body').on('click','.btn-rx-nueva-solicitud',function (e) {
        e.preventDefault();
        var ingreso_id=$(this).attr('data-ingreso');
        var solicitud_id=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        var solicitud_dx_val=$(this).attr('data-dx');
        var SIGH_VALIDAR_VIGENCIA=$('input[name=SIGH_VALIDAR_VIGENCIA]').val();
        if(SIGH_VALIDAR_VIGENCIA=='Si'){
            sighMjsConfirm({
                title:'INGRESAR N.S.S',
                message:'<div class="col-md-12"><input type="text" name="inputNssAcceder" class="form-control" placeholder="INGRESAR N.S.S A 10 DIGITOS"></div>',
                size:'small'
            },function (result) {
                if(result==true){
                    var inputNss=$('body input[name=inputNssAcceder]').val();
                    if(inputNss!=''){
                        let loading=sighMsjLoading();
                        sighAjaxPost({
                            inputNss:inputNss,
                        },base_url+'Sections/VigenciaWs/AjaxVigenciaAcceder',function (response) {
                            loading.modal('hide');
                            if(response.codigoError=='2'){
                                sighMsjError('NO EXISTE EL NSS SOLICITADO','small')
                            }else{

                                var Message='';
                                Message+='<table class="table table-bordered table-striped table-no-padding">';
                                    Message+='<thead>';
                                        Message+='<tr>';
                                            Message+='<th>TIPO</th><th>NOMBRE</th><th>NSS</th> <th>VIGENTE</th><th></th>';
                                        Message+='</tr>';
                                    Message+='</thead';
                                    Message+='<tbody>';
                                        $.each(response,function (i,e) {
                                            Message+='<tr>';
                                                Message+='<td>'+(e.mensajeError!=undefined ? 'TITULAR':'BENEFICIARIO')+'</td>';
                                                Message+='<td>'+e.Nombre+' '+e.Paterno+' '+e.Materno+'</td>';
                                                Message+='<td>'+e.Nss+' '+e.AgregadoMedico+'</td>';
                                                Message+='<td>'+e.ConDerechoSm+'</td>';
                                                Message+='<td class="text-center"><label class="md-check">';
                                                    Message+='<input type="radio" name="SelectPacienteNss"';
                                                        Message+='data-nss="'+e.Nss+'"';
                                                        Message+='data-agregado="'+e.AgregadoMedico+'"';
                                                        Message+='data-nombre="'+e.Nombre+'"';
                                                        Message+='data-ap="'+e.Paterno+'"';
                                                        Message+='data-am="'+e.Materno+'"';
                                                        Message+='data-vigencia="'+e.ConDerechoSm+'"';
                                                        Message+='data-fechanac="'+e.FechaNacimiento+'"';
                                                        Message+='data-sexo="'+(e.Sexo=='F' ? 'MUJER' : 'HOMBRE')+'"';
                                                        Message+='data-umf="'+e.DhUMF+'"';
                                                        Message+='data-delegacion="'+e.DhDeleg+'"';
                                                        Message+='data-curp="'+e.Curp+'"';
                                                    Message+='><i class="back-imss"></i></label>'
                                                Message+='</td>';
                                            Message+='</tr>';
                                        });   

                                    Message+='</tbody>';

                                Message+='</table>';
                                sighMjsConfirm({
                                title:'SELECIONAR PACIENTE',
                                message:'<div class="col-md-12">'+Message+'</div>',
                                size:'large'
                                },function (result) {
                                    if(result==true){
                                        var NssSelect=$('body input[name=SelectPacienteNss]:checked');
                                        if(NssSelect.length!=0){
                                            $('input[name=paciente_nombre]').val(NssSelect.attr('data-nombre'));
                                            $('input[name=paciente_ap]').val(NssSelect.attr('data-ap'));
                                            $('input[name=paciente_am]').val(NssSelect.attr('data-am'));
                                            $('input[name=ingreso_vigenciaacceder]').val(NssSelect.attr('data-vigencia'));
                                            $('input[name=paciente_fn]').val(NssSelect.attr('data-fechanac'));
                                            $('input[name=paciente_sexo]').val(NssSelect.attr('data-sexo'));
                                            $('input[name=paciente_nss]').val(NssSelect.attr('data-nss'));
                                            $('input[name=paciente_nss_agregado]').val(NssSelect.attr('data-agregado'));
                                            $('input[name=info_umf]').val(NssSelect.attr('data-umf'));
                                            $('input[name=info_delegacion]').val(NssSelect.attr('data-delegacion'));
                                            $('input[name=paciente_curp]').val(NssSelect.attr('data-curp'));
                                            if(NssSelect.attr('data-vigencia')=='SI'){
                                                SolicitarEstudiosRx({
                                                    solicitud_dx_val:solicitud_dx_val,
                                                    solicitud_id:solicitud_id,
                                                    ingreso_id:ingreso_id,
                                                    accion:accion,
                                                });
                                            }else{
                                                sighMsjError('EL PACIENTE NO CUENTA CON VIGENCIA DE DERECHOS EN ACCEDER, ENVIAR A ARIMAC','small')
                                            }
                                        }else{
                                            sighMsjError('SELECCIONAR UN REGISTRO DE LA LISTA','small');
                                        }
                                    }
                                })
                            }
                        })
                    }else{
                        sighMsjError('INGRESAR N.S.S A 10 DIGITOS','small')
                    }
                }
            });
            $('body input[name=inputNssAcceder]').mask('9999999999');    
        }else{
            SolicitarEstudiosRx({
                solicitud_dx_val:solicitud_dx_val,
                solicitud_id:solicitud_id,
                ingreso_id:ingreso_id,
                accion:accion,
            });
        }
        

    });
    function SolicitarEstudiosRx(info) {
        sighMjsConfirm({
            title:'Nueva Solicitud de RX',
            message:'<div class="col-md-12"><textarea class="form-control" rows="4" name="solicitud_dx" placeholder="Diagnostico presuncional">'+info.solicitud_dx_val+'</textarea></div>'
        },function (rs) {
            if(rs==true){
                var solicitud_dx=$('body textarea[name=solicitud_dx]').val();
                sighAjaxPost({
                    solicitud_id:info.solicitud_id,
                    solicitud_dx:solicitud_dx,
                    ingreso_id:info.ingreso_id,
                    accion:info.accion,
                },base_url+'Rx/AjaxSolicitudesRx',function (response) {
                    $('.btn-rx-nueva-solicitud').addClass('hide');
                    $('input[name=ingreso_solicitud_rx]').val('Si');
                    $('input[name=solicitud_id]').val(response.SolicitudId);
                    AjaxSolicitudesRx();
                    AbrirVista(base_url+'Rx/AgregarEstudios?sol='+response.SolicitudId+'&folio='+info.ingreso_id,900,600);
                });
            }
        });
    }
    $(document).on('click','.solicitud-rx-estudio-triage',function (e) {
        e.preventDefault();
        AbrirVista(base_url+$(this).attr('href'),900,500);
    });
    $(document).on('click','.icon-rx-remove',function (response) {
        var solicitud_id=$(this).attr('data-id');
        if(confirm("DESEA ELIMINAR ESTA SOLICITUD Y LOS ESTUDIOS DE RX SOLICITADOS")){
            SendAjaxPost({
                solicitud_id:solicitud_id,
            },'Rx/AjaxRxElimiarSolicitudes',function (response) {
                AjaxSolicitudesRx();
            });
        }
    });
    
    $(document).on('click','.col-seleccionar-codigo',function (e) {
        e.preventDefault();
        let msjLoading=sighMsjLoading();
        sighAjaxGet( base_url+'Sections/Codigos/getCodigos',function (response) {
            msjLoading.modal('hide');
            var table='';
            table+='<table class="table table-bordered footable table-no-padding table-seccion-ci">'
                table+='<thead>';
                    table+='<tr>';
                        table+='<th>CODIGO</th>';
                        table+='<th>COLOR</th>';
                        table+='<th>ACCIÓN</th>';
                    table+='</tr>';
                table+='</thead>';
                table+='<tbody>';
                    $.each(response.sql,function (i,e) {
                        table+='<tr>';
                            table+='<td>'+e.ci_codigo+'</td>';
                            table+='<td>'+e.ci_color+'</td>';
                            table+='<td>'+
                                        '<label class="md-check"><input type="radio" name="radio" value="'+e.ci_id+'" data-codigo="'+e.ci_codigo+'" data-color="'+e.ci_color+'">'+
                                            '<i class="blue"></i>'+
                                        '</label>'+
                                    '</td>';
                        table+='</tr>'
                    });
                table+='</tbody>';
            table+='</table>';
            sighMjsConfirm({
                title:'SELECCIONAR CODIGO',
                message:'<div class="col-md-12">'+table+'</div>'
            },function (result) {
                if(result==true){
                    $('body .table-seccion-ci tbody').each(function () {
                       let table=$(this);
                       let selecciona=table.find('input[type=radio]:checked');
                       if(selecciona.length>0){
                           $('input[name=ci_id]').val(selecciona.val());
                           $('.col-seleccion-codigo').html('<h5><b>CODIGO:</b> '+selecciona.attr('data-codigo')+'</h5>');
                           AjaxGuardarTriage();
                       }
                    });
                }
            });
        });
    });
})