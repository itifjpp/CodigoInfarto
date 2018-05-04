$(document).ready(function () {
    $('input[name=ingreso_id]').keypress(function (e){
        var ingreso_id=$(this).val();
        var input=$(this);
        if(e.which==13 && ingreso_id!=''){
            sighMsjLoading();
            sighAjaxPost({
                ingreso_id:ingreso_id
            },base_url+"Asistentesmedicas/AjaxPaciente",function (response) {
                bootbox.hideAll();
                if(response.action==1){
                    if($('input[name=INFO_UM_VALIDARACCEDER]').val()=='Si'){
                        if(response.acceder=='Si'){
                            location.href=base_url+'Asistentesmedicas/Paciente/'+ingreso_id+'?via=HoraCero';
                        }else{
                            searchNSS_ACCEDER(ingreso_id,response.paciente_id);
                        }
                    }else{
                        location.href=base_url+'Asistentesmedicas/Paciente/'+ingreso_id+'?via=HoraCero';
                    }
                    
                }if(response.action==2){
                    sighMsjError('EL PACIENTE NO HA SIDO CLASIFICADO POR EL MÉDICO DE TRIAGE')
                }if(response.action==3){
                    sighMsjError('EL FOLIO INGRESADO NO EXISTE')
                }
                input.val('');
            });
        }
    });

    $('select[name=triage_consultorio_envio]').val($('select[name=triage_consultorio_envio]').data('value'));
    $('select[name=paciente_sexo]').val($('select[name=paciente_sexo]').data('value'));
    $('select[name=paciente_estadocivil]').val($('select[name=paciente_estadocivil]').data('value'));
    $('select[name=info_lugar_accidente]').val($('select[name=info_lugar_accidente]').data('value'));
    $('.solicitud-paciente').submit(function (e){
        var urlAsistenteMedica;
        if($('input[name=AsistenteMedicaTipo]').val()=='Asistente Médica Ortopedia'){
            urlAsistenteMedica=base_url+'Ortopedia/Asistentesmedicas/AjaxGuardar';
        }else{
            urlAsistenteMedica=base_url+'Asistentesmedicas/AjaxGuardar';
        }
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),urlAsistenteMedica,function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                if($('input[name=ConfigHojaInicialAsistentes]').val()=='Si'){
                    OpenLoadView(base_url+'inicio/documentos/HojaFrontal/'+$('input[name=ingreso_id]').val(),'HojaFrontal',function () {
                        if($('input[name=AsistenteMedicaTipo]').val()=='Asistente Médica'){
                            if($('select[name=info_lugar_accidente]').val()=='TRABAJO'){
                                OpenLoadView(base_url+'inicio/documentos/ST7/'+$('input[name=ingreso_id]').val(),'ST7',function () {
                                    if($('input[name=paciente_via]').val()=='Choque'){
                                       location.href=base_url+'Choque';
                                   }else{
                                       location.href=base_url+'Asistentesmedicas';
                                   }
                                });
                            }else{
                                if($('input[name=paciente_via]').val()=='Choque'){
                                    location.href=base_url+'Choque';
                               }else{
                                   location.href=base_url+'Asistentesmedicas';
                               }
                            }
                        }
                    });
                }
                
            }
        })
    });
    $('.btn-valida-nss').click(function (e) {
        e.preventDefault();
        AjaxValidaNss();
    });
    $('input[name=paciente_nss_agregado]').blur(function (evt) {
        //evt.preventDefault();
        //AjaxValidaNss();
    })
    function AjaxValidaNss() {
        if($('input[name=paciente_nss_agregado]').val()!='' && $('input[name=paciente_nss]').val()){
            sighMsjLoading();
            sighAjaxPost({
                paciente_nss:$('input[name=paciente_nss]').val(),
                paciente_nss_agregado:$('input[name=paciente_nss_agregado]').val(),
                paciente_id:$('input[name=paciente_id]').val(),
                ingreso_id:$('input[name=ingreso_id]').val()
            },base_url+'Asistentesmedicas/AjaxValidaNss',function (response) {
                bootbox.hideAll();
                if(response.accion==1){
                    sighMsjOk('INFORMACIÓN LOCALIZADA, VALIDAR CON EL PACIENTE Y/O FAMILIAR LA INFORMACIÓN.');
                    setTimeout(function () {
                        location.reload();
                    },2000);
                }else{
                    sighMsjError("INFORMACIÓN NO LOCALIZADA")
                }
                console.log(response);
            });  
        }else{
            sighMsjError("ESPECIFICAR NSS Y NSS AGREGADO")
        }
    }
    $('.solicitud-paciente-taod').submit(function (e){
        e.preventDefault();
        AbrirDocumentoMultiple(base_url+'inicio/documentos/HojaFrontalCE/'+$('input[name=triage_id]').val(),'HojaFrontal',100);
        if($('select[name=triage_paciente_accidente_lugar]').val()=='TRABAJO'){
            AbrirDocumentoMultiple(base_url+'inicio/documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',300);
        }
        ActionCloseWindows();
    });
    $('select[name=info_lugar_accidente]').change(function (e){
        if($('input[name=CONFIG_AM_INTERACCION_LT]').val()=='Si'){
            if($(this).val()=='TRABAJO'){
                $('.row-st7').removeClass('hide');
            }else{
                $('.row-st7').addClass('hide');
            }
        }
        
    })
    if($('input[name=CONFIG_AM_INTERACCION_LT]').val()=='Si'){
        if($('select[name=info_lugar_accidente]').attr('data-value')=='TRABAJO'){
            $('.row-st7').removeClass('hide');
        }
    }else{
        $('.row-st7').removeClass('hide');
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
    $('input[name=directorio_cp_2]').blur(function (e){
        if($(this).val()!=''){
            BuscarCodigoPostal({
                'cp':$(this).val(),
                'input1':'directorio_municipio_2',
                'input2':'directorio_estado_2',
                'input3':'directorio_colonia_2'
            });
        }   
    });
    function BuscarCodigoPostal(input) {
        $.ajax({
                url: base_url+"Asistentesmedicas/BuscarCodigoPostal",
                type: 'POST',
                dataType: 'json',
                data:{
                    'cp':input.cp,
                },success: function (data, textStatus, jqXHR) {
                    $('input[name='+input.input1+']').val(data.result_cp.Municipio);
                    $('input[name='+input.input2+']').val(data.result_cp.Estado);
                    if(data.result_cp.Colonia.length>0){
                        var Colonia=data.result_cp.Colonia.split(';');
                        $('input[name='+input.input3+']').shieldAutoComplete({
                            dataSource: {
                                data: Colonia
                            },minLength: 1
                        });
                        $('input[name='+input.input3+']').removeClass('sui-input');
                    }
                },error: function (e) {
                    console.log(e);
                }
            })
    }
    /*INDICADOR*/
    $('.clockpicker-am').clockpicker({
        placement: 'bottom',
        autoclose: true
    });
    $('.btn-buscar-st7-rc').click(function () {
        var inputTurno=$('select[name=inputTurno]').val();
        var inputFecha=$('input[name=inputFecha]').val();
        $('.btn-buscar-st7-rc').attr('disabled',true);
        AjaxIndicadorAm('.col-st7-iniciadas',{
            inputTurno:inputTurno,
            inputFecha:inputFecha,
            inputTipo:'Iniciadas',
            csrf_token:csrf_token
        },'Asistentesmedicas/AjaxIndicadorST7',function (response) {
            $('.col-st7-iniciadas').find('h4').html(response.Total+' DOCUMENTOS');
            AjaxIndicadorAm('.col-st7-terminadas',{
                inputTurno:inputTurno,
                inputFecha:inputFecha,
                inputTipo:'Terminadas',
                csrf_token:csrf_token
            },'Asistentesmedicas/AjaxIndicadorST7',function (response) {
                $('.col-st7-terminadas').find('h4').html(response.Total+' DOCUMENTOS');
                AjaxIndicadorAm('.col-procedencia-espontanea',{
                    inputTurno:inputTurno,
                    inputFecha:inputFecha,
                    inputTipo:'Si',
                    csrf_token:csrf_token
                },'Asistentesmedicas/AjaxIndicadorEspontaneas',function (response) {
                    $('.col-procedencia-espontanea').find('h4').html(response.Total+' DOCUMENTOS');
                    AjaxIndicadorAm('.col-procedencia-no-espontanea',{
                        inputTurno:inputTurno,
                        inputFecha:inputFecha,
                        inputTipo:'No',
                        csrf_token:csrf_token
                    },'Asistentesmedicas/AjaxIndicadorEspontaneas',function (response) {
                        $('.col-procedencia-no-espontanea').find('h4').html(response.Total+' DOCUMENTOS');
                        AjaxIndicadorAm('.col-am-total',{
                            inputTurno:inputTurno,
                            inputFecha:inputFecha,
                            csrf_token:csrf_token
                        },'Asistentesmedicas/AjaxIndicadorTotal',function (response) {
                            $('.col-am-total').find('h4').html('TOTAL DE PACIENTES: '+response.Total+' PACIENTES');
                            $('.btn-buscar-st7-rc').removeAttr('disabled');
                        });
                        
                    });
                });
            });
        });
    });
    function AjaxIndicadorAm(load,info,Url,response){
        $.ajax({
            url: base_url+Url,
            type: 'POST',
            dataType: 'json',
            data:info,
            beforeSend: function (xhr) {
                $(load).find('h4').html('<i class="fa fa-spinner fa-pulse"></i>');
            },success: function (data, textStatus, jqXHR) {
                response(data);
            },error: function (e) {
                console.log(e)
            }
        })
    }
    /*Egreso Pacientes Asistente Médica*/
    $('#ingreso_id_egreso').focus();
    $('#ingreso_id_egreso').keypress(function (e){
        var input=$(this);
        let ingreso_id=input.val();
        
        if(e.which==13 && ingreso_id!=''){ 
            sighAjaxGet(base_url_server+'getPacienteAm/'+ingreso_id,function (response) {
                console.log(response);
                if(response.action==1){
                    sighMjsConfirm({
                        title:'EGRESO DE PACIENTE</h5>',
                        message:'<div class="col-md-12">'+
                                    '<div class="form-group no-margin">'+
                                        '<select class="width100" id="ingreso_egreso_motivo">'+
                                            '<option value="">Seleccionar Motivo de Egreso</option>'+
                                            '<option value="Alta voluntaria">Alta voluntaria</option>'+
                                            '<option value="Defunción">Defunción</option>'+
                                            '<option value="Traslado a otra Unidad Médica">Traslado a otra Unidad Médica</option>'+
                                            '<option value="Alta a Domicilio">Alta a Domicilio</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>',
                        size:'small',
                    },function (cb) {
                        if(cb==true){
                            var ingreso_egreso_motivo=$('body #ingreso_egreso_motivo').val();
                            sighMsjLoading();
                            sighAjaxPost({
                                ingreso_id:ingreso_id,
                                ingreso_egreso_motivo:ingreso_egreso_motivo,
                            },base_url+"Asistentesmedicas/AjaxEgresoPaciente",function (response) {
                                bootbox.hideAll();
                                if(response.action=='1'){
                                    sighMsjOk('Paciente dado de alta de Unidad Médica');
                                    location.reload();
                                }if(response.action=='2'){
                                    sighMsjError('El paciente ya se encuentra dado de alta')
                                }
                            })    
                        }
                    })
                }else{
                    sighMsjError('EL N° DE FOLIO INGRESADO NO EXISTE');
                }
            })
            input.val('');
        }
    });
    /*Filtro Jefa AM*/
    $('.btn-turnos-v2').click(function (e) {
        var inputTurno=$('select[name=inputTurno]').val();
        var inputFecha=$('input[name=inputFecha]').val();
        sighMsjLoading();
        sighAjaxPost({
            inputTurno:inputTurno,
            inputFecha:inputFecha
        },base_url+'Asistentesmedicas/Jefa/Ajax43029',function (response) {
            $('.filtro-ingreso').html(response.Ingresos);
            $('.filtro-egreso').html(response.Egresos);
            $('.pdf-4-30-29').removeClass('hide');
            $('.pdf-4-30-29').attr('data-turno',inputTurno).attr('data-fecha',inputFecha)
            sighAjaxPost({
                inputTurno:inputTurno,
                inputFecha:inputFecha
            },base_url+'Asistentesmedicas/Jefa/Ajax43021',function (response) {
                bootbox.hideAll();
                $('.observacion-ingreso').html(response.Ingresos);
                $('.observacion-egreso').html(response.Egresos);
                $('.pdf-4-30-21-I,.pdf-4-30-21-E').removeClass('hide');
                $('.pdf-4-30-21-I')
                        .attr('data-turno',inputTurno)
                        .attr('data-fecha',inputFecha)
                        .attr('data-tipo','Ingreso');
                $('.pdf-4-30-21-E')
                        .attr('data-turno',inputTurno)
                        .attr('data-fecha',inputFecha)
                        .attr('data-tipo','Egreso');
            });
        });


    })
    $('.pdf-4-30-21-I, .pdf-4-30-21-E').click(function (e){
        AbrirDocumento(base_url+'Inicio/Documentos/Doc43021?fecha='+$(this).attr('data-fecha')+'&turno='+$(this).attr('data-turno')+'&tipo='+$(this).attr('data-tipo'));
    });
    $('.pdf-4-30-29').click(function (e){
        AbrirDocumento(base_url+'Inicio/Documentos/Doc43029?fecha='+$(this).attr('data-fecha')+'&turno='+$(this).attr('data-turno'));
    })
    if($('input[name=INDICADOR_AM]').val()!=undefined){
        var ChartId=$('#ChartAsistentesMedicas');
        var Rojo=ChartId.attr('data-rojo');
        var Naranja=ChartId.attr('data-naranja');
        var Amarillo=ChartId.attr('data-amarillo');
        var Verde=ChartId.attr('data-verde');
        var Azul=ChartId.attr('data-azul');
        var data = {
            labels: ["Rojo ("+Rojo+")", "Naranja ("+Naranja+")", "Amarillo ("+Amarillo+")", "Verde ("+Verde+")", "Azul ("+Azul+")"],
            datasets: [
                {
                    label: "Rojo",
                    backgroundColor: [
                        'rgba(229,9,20,1)',
                        'rgba(255, 112, 40, 1)',
                        'rgba(253, 233, 16, 1)',
                        'rgba(76, 187, 23, 1)',
                        'rgba(0, 0, 255, 1)'
                    ],
                    borderColor: [
                        'rgba(229,9,20,1)',
                        'rgba(255, 112, 40, 1)',
                        'rgba(253, 233, 16, 1)',
                        'rgba(76, 187, 23, 1)',
                        'rgba(0, 0, 255, 1)'
                    ],
                    borderWidth: 1,
                    data: [Rojo, Naranja, Amarillo, Verde, Azul]
                }
            ]
        };
        var ctx = document.getElementById("ChartAsistentesMedicas");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    }
    $('.select2').select2(); 
    function searchNSS_ACCEDER(ingreso_id,paciente){
        sighMjsConfirm({
            title:'VALIDAR VIGENCIA ACCEDER',
            message:'<div class="col-md-12"><input type="text" name="inputNssAcceder" class="form-control" placeholder="INGRESAR N.S.S A 10 DIGITOS"></div>',
            size:'small',
        },function (callback) {
            if(callback==true){
                var inputNss=$('body input[name=inputNssAcceder]').val();
                if(inputNss!=''){
                    sighMsjLoading();
                    sighAjaxPost({
                        inputNss:inputNss
                    },base_url+'Sections/VigenciaWs/AjaxVigenciaAcceder',function (response) {
                        bootbox.hideAll();
                        if(response.codigoError=='2'){
                            sighMsjError('EL N.S.S INGRESADO NO EXISTE EN LA BD DE ACCEDER');
                        }else{

                            var Message='';
                            Message+='<table class="table table-bordered table-striped table-no-padding">';
                                Message+='<thead>';
                                    Message+='<tr>';
                                        Message+='<th>TIPO</th><th>NOMBRE</th><th>NSS</th><th>VIGENTE</th> <th></th>';
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
                                                Message+='data-sexo="'+(e.Sexo=='F'?'MUJER':'HOMBRE')+'"';
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
                                title:'SELECCIONAR PACIENTE VIGENCIA ACCEDER</h5>',
                                message:'<div class="col-md-12">'+Message+'</div>',
                                size:'large'
                            },function (result) {
                                if(result==true){
                                    var SelectNss=$('body input[name=SelectPacienteNss]:checked');
                                    if(SelectNss.length==1){
                                        sighMsjLoading();
                                        sighAjaxPost({
                                            paciente_nombre:SelectNss.attr('data-nombre'),
                                            paciente_ap:SelectNss.attr('data-ap'),
                                            paciente_am:SelectNss.attr('data-am'),
                                            paciente_vigenciaacceder:SelectNss.attr('data-vigencia'),
                                            paciente_fn:SelectNss.attr('data-fechanac'),
                                            paciente_sexo:SelectNss.attr('data-sexo'),
                                            paciente_nss:SelectNss.attr('data-nss'),
                                            paciente_nss_agregado:SelectNss.attr('data-agregado'),
                                            info_umf:SelectNss.attr('data-umf'),
                                            info_delegacion:SelectNss.attr('data-delegacion'),
                                            paciente_curp:SelectNss.attr('data-curp'),
                                            ingreso_id:ingreso_id,
                                            paciente_id:paciente
                                        },base_url+'Asistentesmedicas/AjaxAsistentesmedicasAcceder',function (response) {
                                            bootbox.hideAll();
                                            location.href=base_url+'Asistentesmedicas/Paciente/'+ingreso_id;
                                        });
                                    }else{
                                        msj_error_noti('SELECCIONAR UN REGISTRO DE LA LISTA')
                                    }
                                }
                            });
                        }
                    })
                }else{
                    sighMsjError('POR FAVOR INGRESAR N.S.S A 10 DIGITOS');
                }
            }
        })
        $('body input[name=inputNssAcceder]').mask('9999999999');
    }
    function responseInfoAcceder(info,folio) {
        
    } 
})