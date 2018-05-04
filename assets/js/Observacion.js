$(document).ready(function () {
    $('input[name=triage_id]').focus();
    if($('input[name=accion_rol]').val()=='Enfermeria'){
        CargarCamasEnfemeria();
    }
    $('input[name=ingreso_id]').keypress(function (e) {
        var input=$(this);
        var ingreso_id=$(this).val();
        if(e.which==13 && ingreso_id!=''){
            sighMsjLoading();
            sighAjaxPost({
                ingreso_id:ingreso_id
            },base_url+'Observacion/AjaxObservacionMedico',function (response) {
                bootbox.hideAll();
                console.log(response)
                if(response.action=='Ok'){
                    
                    msj_success_noti('INGRESO DE PACIENTE A OBSERVACIÓN');
                    location.reload();
                }else if(response.action=='Ingreso'){
                    sighMjsConfirm({
                        title:'ERROR DE INGRESO',
                        message:'<div class="col-md-12">'+
                                    '<h5 class="no-margin line-height text-justify">EL PACIENTE YA FUE INGRESADO AL ÁREA DE OBSERVACIÓN POR UN MÉDICO DE ESTA ÁREA. ¿QUE DESEA HACER?</h5>'+
                                '</div>',
                        lb_accept:'VER EXPEDIENTE',
                        lb_cancel:'CANCELAR',
                        size:'small'
                    },function (cb) {
                        if(cb==true){
                            location.href=base_url+'Sections/Documentos/Expediente/'+ingreso_id+'/?tipo=Observación'
                        }
                    })
                }else if(response.action=='Alta Médico' || response.action=='Sin Especificar'){
                    sighMjsConfirm({
                        title:'ERROR DE INGRESO',
                        message:'<div class="col-md-12">'+
                                    '<h5 class="no-margin line-height text-justify">EL PACIENTE YA FUE DADO DE ALTA DEL ÁREA DE OBSERVACIÓN. ¿DESEA INGRESAR NUEVAMENTE EL PACIENTE A ESTA ÁREA?</h5>'+
                                '</div>',
                        size:'small',
                        lb_accept:'REINGRESO',
                        lb_cancel:'CANCELAR'
                    },function (cb) {
                        if(cb==true){
                            sighAjaxPost({
                                ingreso_id:ingreso_id
                            },base_url+'Observacion/AjaxObservacionMedicoReingreso',function () {
                                msj_success_noti('INGRESO DE PACIENTE A OBSERVACIÓN');
                                location.reload();
                            })
                        }
                    })
                }else if(response.action=='No Existe'){
                    sighMsjError('EL N° DE FOLIO INGRESADO NO EXISTE');
                }else if(response.action=='Datos NO Capturados por AM'){
                    sighMsjError('DATOS DEL PACIENTE NO CAPTURADOS POR ASISTENTE MÉDICA');
                }
            })
            input.val("");
        }
    });
    $('body').on('click','.obs-medico-alta',function (evt) {
        var ingreso_id=$(this).attr('data-id');
        if(confirm('ALTA PACIENTE DEL ÁREA DE OBSERVACIÓN')){
            sighAjaxPost({
                ingreso_id:ingreso_id
            },base_url+'Observacion/AjaxObservacionMedicoAlta',function (response) {
                msj_success_noti('ALTA PACIENTE DEL ÁREA DE OBSERVACIÓN');
                location.reload();
            })
        }
    })
    if($('input[name=accion_rol]').val()=='Médico'){
        if($('input[name=especialidad_nombre]').val()==''){
            sighAjaxGet(base_url+"Consultorios/ObtenerEspecialidades",function (response) {
                sighMjsConfirm({
                    title: 'SELECCIONAR ESPECIALIDAD',
                    message:'<div class="col-sm-12">'+
                                '<div class="form-group no-margin">'+
                                    '<select id="observacion_servicio" class="form-control" style="width:100%">'+response.option+'</select>'+
                                '</div>'+
                            '</div>',
                    size:'small'
                },function (cb) {
                    if(cb==true){
                        var observacion_servicio=$('body #observacion_servicio').val();
                        if(observacion_servicio!=''){
                            sighMsjLoading();
                            sighAjaxPost({
                                observacion_servicio: observacion_servicio,
                            },base_url+'Observacion/AjaxCrearSessionServicio',function () {
                                bootbox.hideAll();
                                ActionWindowsReload();
                            })
                        }else{
                            msj_error_noti('SELECCIONAR SERVICIO AL QUE PERTENECE COMO MÉDICO');
                        }
                    }else{
                        location.reload();
                    }
                });
            });
        }
    }
    $('.actualizar-camas-observacion').click(function (e) {
        e.preventDefault();
        CargarCamasEnfemeria();
    })
    function CargarCamasEnfemeria() {
        sighMsjLoading();
        sighAjaxGet(base_url+"Observacion/"+$('input[name=SiGH_OBSERVACION_ENFERMERIA]').val(),function (response) {
            bootbox.hideAll();
            $('.col-AjaxLoadCamasTipos').html(response.result_camas);
        });
    }
    $('body').on('click','.enf-finalizar-mantenimiento',function(e){
        e.preventDefault();
        var cama_id=$(this).attr('data-id');
        if(confirm('¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?')){
            sighMsjLoading();
            sighAjaxPost({
                cama_id:cama_id
            },base_url+"Areas/AjaxEndMantenimiento",function (response) {
                bootbox.hideAll();
                if(response.accion=='1'){
                    CargarCamasEnfemeria()
                }
            })
        }
    })
    $('body').on('click','.observacion-enf-tarjeta',function (e) {
        var enfermedad=$(this).attr('data-enfermedad');
        var alergia=$(this).attr('data-alergia');
        var ingreso_id=$(this).attr('data-id');
        e.preventDefault();
        sighMjsConfirm({
            title:'Tarjeta de Identificación',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<label>Enfermedades Cronicodegenerativas</label>'+
                            '<textarea class="form-control" name="ti_enfermedades" maxlength="50" rows="1">'+enfermedad+'</textarea>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>Alergias</label>'+
                            '<textarea class="form-control" name="ti_alergias" maxlength="85" rows="2">'+alergia+'</textarea>'+
                        '</div>'+
                    '</div>',
            size:'medium'       
        },function (cb) {
            if(cb==true){
                var ti_enfermedades=$('body textarea[name=ti_enfermedades]').val();
                var ti_alergias=$('body textarea[name=ti_alergias]').val();
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id : ingreso_id,
                    ti_enfermedades : ti_enfermedades,
                    ti_alergias : ti_alergias,
                },base_url+"Observacion/AjaxTarjetaIdentificacion",function (response) {
                    bootbox.hideAll();
                    if(response.accion=='1'){
                        AbrirDocumento(base_url+'Inicio/Documentos/TarjetaDeIdentificacion/'+ingreso_id+'?via=Observación');
                        CargarCamasEnfemeria()
                    }
                })
            }
        })
    });
    $('body').on('click','.observacion-enf-cambiarcama',function (e) {
        e.preventDefault();
        var ingreso_id=$(this).attr('data-id');
        var area_id=$(this).attr('data-area');
        var cama_id_old=$(this).attr('data-cama');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR EN N° DE CAMA?')){
            sighMsjLoading();
            sighAjaxPost({
                area_id:area_id
            },base_url+"Areas/AjaxObtenerCamas",function (response) {
                bootbox.hideAll();
                sighMjsConfirm({
                    title:'Cambiar Cama',
                    message:'<div class="col-md-12">'+
                                '<div class="form-group no-margin">'+
                                    '<label>SELECCIONAR CAMA</label>'+
                                    '<select name="cama_id" class="form-control">'+response.option+'</select>'+
                                '</div>'+
                            '</div>',
                    size:'small'
                },function (cb) {
                    if(cb==true){
                        sighMsjLoading();
                        sighAjaxPost({
                            ingreso_id:ingreso_id,
                            area_id:area_id,
                            cama_id_old:cama_id_old,
                            cama_id_new:$('body select[name=cama_id]').val()
                        },base_url+"Observacion/AjaxCambiarCama",function (response) {
                            bootbox.hideAll();
                            if(response.accion=='1'){
                                CargarCamasEnfemeria()
                            }
                        });
                    }
                });
            }); 
        }
    });
    $('body').on('click','.observacion-enf-cambiarenfermera',function () {
        var ingreso_id=$(this).attr('data-id');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR DE ENFERMERO(A)?')){
            var matricula=prompt('INGRESAR MATRICULA DEL NUEVO ENFERMERO(A)');
            if(matricula!=null && matricula!=''){
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id:ingreso_id,
                    empleado_matricula:matricula,
                },base_url+"Observacion/AjaxCambiarEnfermera",function (response) {
                    bootbox.hideAll();
                    if(response.accion=='1'){
                        sighMsjOk('Cambios guardados')
                        CargarCamasEnfemeria();
                    }if(response.accion=='2'){
                        sighMsjError('LA MATRICULA ESCRITA NO EXISTE');
                    }
                })
            }else{
                sighMsjError('INGRESAR MATRICULA');
            }
        }
    })
    $('body').on('click','.observacion-enf-alta',function (e){
        var ingreso_id=$(this).data('ingreso');
        var cama_id=$(this).data('cama');
        if(confirm('¿DAR DE ALTA PACIENTE?')){
            sighMjsConfirm({
                title:'SELECCIONAR DESTINO',
                message:'<div class="col-sm-12">'+
                            '<select class="width100" name="observacion_alta">'+
                                '<option value="Alta a domicilio">ALTA A DOMICILIO</option>'+
                                '<option value="Alta e ingreso quirófano">ALTA E INGRESO A QUIRÓFANO</option>'+
                                '<option value="Alta e ingreso a hospitalización">ALTA E INGRESO A HOSPITALIZACIÓN</option>'+
                                '<option value="Alta e ingreso a UCI">ALTA E INGRESO A UCI</option>'+
                                '<option value="Alta e ingreso a Choque">ALTA E INGRESO A CHOQUE</option>'+
                                '<option value="Alta Desconocido">ALTA DESCONOCIDO</option>'+
                            '</select>'+
                        '</div>',
                size:'small'
            },function (cb) {
                if(cb==true){
                    sighMsjLoading();
                    sighAjaxPost({
                        observacion_alta:$('body select[name=observacion_alta]').val(),
                        cama_id:cama_id,
                        ingreso_id:ingreso_id
                    },base_url+'Observacion/AjaxAltaPaciente',function (response) {
                        bootbox.hideAll();
                        CargarCamasEnfemeria();
                    });
                }
            });
        };
    });
    $('.clockpicker-obs').clockpicker({
        placement: 'bottom',
        autoclose: true
    });
    $('.datepicker-obs').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        placement: 'bottom'
    });
    $('.form-obs-enfermeria').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost({
            inputDateStart:$('input[name=inputDateStart]').val(),
            inputDateEnd:$('input[name=inputDateEnd]').val(),
            inputMatricula:$('input[name=inputMatricula]').val()
        },base_url+'Observacion/Indicadores/AjaxEnfermeria',function (response) {
            bootbox.hideAll();
            if(response.action==1){
                $('.obs-enfermeria-ingreso').attr('data-tipo','Ingreso Enfermería Observación').find('h2').html(response.TOTAl_INGRESO+' Pacientes');
                $('.obs-enfermeria-egreso').attr('data-tipo','Egreso Enfermería Observación').find('h2').html(response.TOTAL_EGRESO+' Pacientes');
            }else{
                sighMsjError('LA MATRICULA ESCRITA NO EXISTE');
            }
            
        })
    })
    $('.obs-enfermeria-ingreso, .obs-enfermeria-egreso').click(function (e) {
        e.preventDefault();
        var inputTipo=$(this).attr('data-tipo');
        var inputDateStart=$('input[name=inputDateStart]').val();
        var inputDateEnd=$('input[name=inputDateEnd]').val();
        var inputMatricula=$('input[name=inputMatricula]').val();
        AbrirVista(base_url+'Inicio/Documentos/ReporteIndicadorEnfermeriaObs?start='+inputDateStart+'&end='+inputDateEnd+'&matricula='+inputMatricula+'&tipo='+inputTipo)
    });
    $('body').on('click','.observacion-enf-imprimirpulsera',function (e) {
        e.preventDefault();
        var ingreso_id=$(this).attr('data-id');
        AbrirVista(base_url+'Inicio/Documentos/ImprimirPulsera/'+ingreso_id);
    });
    
    /*OBSERVACION ESTADOS DE CAMAS(HABILITACION Y DESABILITACIÓN)*/
    $('body').on('click','.camas-acciones',function (e) {
        let cama_id=$(this).attr('data-cama');
        let cama_display=$(this).attr('data-display');
        SendAjaxPost({
            cama_id:cama_id,
            cama_display:cama_display,
            csrf_token:csrf_token
        },'Observacion/Camas/AjaxEstados',function (response) {
            if(response.accion=='1'){
                location.reload();
            }
        });
    });
    /*__________________________________________________________________________
      _____________________________OBSERVACIÓN__________________________________
    AGREGAR PACIENTES A ENFERMERIA OBSERVACION*/
    $('body').on('click','.btn-paciente-agregar',function (){
        var cama_id=$(this).data('cama');
        var area_id=$(this).data('area');
        var ingreso_id=prompt("INGRESAR FOLIO DE INGRESO DEL PACIENTE","");
        
        if(ingreso_id!='' && ingreso_id!=null){
            sighMsjLoading();
            sighAjaxPost({
                ingreso_id:ingreso_id,
            },base_url+'Observacion/AjaxVerificarAreaEnfermeria',function (response) {
                bootbox.hideAll();
                switch (response.accion){
                    case 'NO_INFO_AM':
                        sighMsjError('DATOS DEL PACIENTE NO CAPTURADOS POR ASISTENTES MÉDICAS','small')
                        break;
                    case 'NO_PERTENECE_AL_AREA':
                        sighMsjError('AL PACIENTE NO PERTENECE A ESTA ÁREA');
                        break;
                    case 'AGREGAR_A_OBSERVACION':/*NO EXISTE EN OBSERVACION SE PROCEDE A INGRESARLO*/
                        AjaxAgregarPacienteEnfermeria({
                            ingreso_id:ingreso_id,
                            area_id:area_id,
                            cama_id:cama_id,
                        })
                        break;
                    case 'EL_PACIENTE_NO_TIENE_UNA_CAMA':
                        AjaxAsignarCamaPaciente({
                            ingreso_id:ingreso_id,
                            area_id:area_id,
                            cama_id:cama_id,
                        });
                        break;
                    case 'EL_PACIENTE_YA_TIENE_UNA_CAMA':
                        AjaxPacienteAsignadoEnfermeria({//
                            ingreso_id:ingreso_id,
                            area_id:area_id,
                            cama_id:cama_id
                        });
                        break;
                    case 'EL_PACIENTE_YA_SE_ENCUENTRA_EN_OBS':
                        AjaxReingresoPacienteEnfermeria({
                            ingreso_id:ingreso_id,
                            area_id:area_id,
                            cama_id:cama_id,
                        });
                        break;
                }
            })
        }
    });
    $('body').on('click','.observacion-enf-verexpediente',function (evt) {
        evt.preventDefault();
        window.open(base_url+'Sections/Documentos/Expediente/'+$(this).attr('data-id')+'?tipo=Observación&url=Enfermeria','_blank')
    })
    function AjaxAgregarPacienteEnfermeria(info){
        sighMsjLoading();
        sighAjaxPost(info,base_url+'Observacion/AjaxAgregarPacienteEnfermeria',function (response) {
            if(response.accion=='1'){
                bootbox.hideAll();
                sighMsjOk('INGRESO DE PACIENTE CORRECTAMENTE');
                CargarCamasEnfemeria();
            }
        });
    }
    function AjaxAsignarCamaPaciente(info) {
        sighMsjLoading();
        sighAjaxPost(info,base_url+'Observacion/AjaxAsignarCamaPaciente',function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                sighMsjOk('INGRESO DE PACIENTE CORRECTAMENTE');
                CargarCamasEnfemeria();
            }
        });
    }
    function AjaxReingresoPacienteEnfermeria(info) {
        SendAjaxPost(info,'Observacion/AjaxObtenerPacienteEnfermeria',function (response) {
            sighMjsConfirm({
                title:'EL PACIENTE YA FUE DADO DE ALTA DE OBSERVACÓN',
                message:'<div class="col-md-12">'+
                            '<div style="height:15px;width:100%;margin-top:0px" class="'+ObtenerColorClasificacion(response.ingreso_clasificacion)+'"></div>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h3 style="no-margin"><b>PACIENTE:</b> '+response.paciente_nombre+' '+response.paciente_ap+' '+response.paciente_am+'</h3>'+
                            '<h3 style="no-margin"><b>ALTA:</b> '+response.observacion_alta+'</h3>'+
                            '<h5 style="no-margin line-height">EL PACIENTE FUE DADO ¿DESEA REINGRESAR ESTE PACIENTE AL ÁREA DE OBSERVACIÓN?</h5>'+
                        '</div>',
                size:'medium',
                lb_accept:'Reingresar paciente a esta área'
            },function (cb) {
                if(cb==true){
                    let loading=sighMsjLoading();
                    sighAjaxPost(info,base_url+'Observacion/AjaxReingresoPacienteEnfermeria',function (response) {
                        sighAjaxPost(info,base_url+'Observacion/AjaxAgregarPacienteEnfermeria',function (response) {
                            loading.modal('hide');
                            if(response.accion=='1'){
                                sighMsjOk('REINGRESO DE PACIENTE CORRECTAMENTE');
                                CargarCamasEnfemeria();
                            }
                        });
                    })
                }
            })
        })
    }
    function AjaxPacienteAsignadoEnfermeria(info) {
        SendAjaxPost(info,'Observacion/AjaxObtenerPacienteEnfermeria',function (response) {
            sighMjsConfirm({
                title:'EL PACIENTE YA TIENE ASIGNADO UNA CAMA',
                message:'<div class="col-md-12">'+
                            '<div style="height:15px;width:100%;margin-top:0px" class="'+ObtenerColorClasificacion(response.ingreso_clasificacion)+'"></div>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h3 class="no-margin"><b>PACIENTE:</b> '+response.paciente_nombre+' '+response.paciente_ap+' '+response.paciente_am+'</h3>'+
                            '<h3 class="no-margin"><b>CAMA:</b> '+response.cama_nombre+'</h3>'+
                            '<h3 class="no-margin"><b>ESTADO ACTUAL DE LA CAMA:</b> '+response.cama_status+'</h3>'+
                        '</div>',
                size:'medium',
                lb_cancel:'Cancelar',
                lb_accept:'Forzar reingreso del paciente a esta cama'
            },function (cb) {
                if(cb==true){
                    sighMsjLoading();
                    sighAjaxPost(info,base_url+'Observacion/AjaxForzarReingresoPaciente',function (response) {
                        sighAjaxPost(info,base_url+'Observacion/AjaxAgregarPacienteEnfermeria',function (response) {
                            bootbox.hideAll();
                            if(response.accion=='1'){
                                sighMsjOk('REINGRESO DE PACIENTE CORRECTAMENTE');
                                CargarCamasEnfemeria();
                            }
                        })
                    })
                }
            })
        })
    }
    /*ELIMINAR PACIENTE DEL ÁREA DE OBSERVACIÓN PARA SU POSTERIÓR REINGRESO*/
    $('body').on('click','.enf-obs-del-paciente',function () {
        if(confirm('¿FORZAR ELIMINACIÓN DE PACIENTE DEL ÁREA DE ENFERMERÍA OBSERVACIÓN, PARA SU POSTERIOR REINGRESO A DICHA ÁREA?')){
            var ingreso_id=prompt('INGRESAR FOLIO DE INGRESO DEL PACIENTE:','');
            if(ingreso_id!='' && ingreso_id!=null){
                sighMsjLoading();
                sighAjaxPost({
                    ingreso_id:ingreso_id,
                },'Observacion/AjaxEliminarPacienteObs',function (response) {
                    bootbox.hideAll();
                    if(response.accion=='1'){
                        sighMsjOk('ACCIÓN REALIZADA CORRECTAMENTE');
                        CargarCamasEnfemeria();
                    }
                })
            }
        }
    });
    /*INDICADORES ESTADOS CAMAS OBS*/
    $('select[name=inputAreasObservacion]').change(function () {
        AjaxGestionCamas($(this).val());
    })
    if($('input[name=tipo]').val()!=undefined){
        if($('input[name=area]').val()!='Administrador'){
            AjaxGestionCamas($('input[name=area_id]').val());
        }else{
            AjaxGestionCamas('');
        }
    }
    function AjaxGestionCamas(area){
        sighMsjLoading();
        sighAjaxPost({
            area:area
        },base_url+"Observacion/Camas/AjaxCamasIndicadorEstados",function (response) {
            bootbox.hideAll();
            $('.Total_Camas').attr('data-area',area).attr('data-tipo','Total').find('h2').html(response.Total+' TOTAL DE CAMAS');
            $('.Total_Camas_Disponibles').attr('data-area',area).attr('data-tipo','Disponibles').find('h2').html(response.Disponibles+' Camas');
            $('.Total_Camas_Ocupadas').attr('data-area',area).attr('data-tipo','Ocupados').find('h2').html(response.Ocupados+' Camas');
            $('.Total_Camas_Mantenimiento').attr('data-area',area).attr('data-tipo','Mantenimiento').find('h2').html(response.Mantenimiento+' Camas');
            $('.Total_Camas_Limpieza').attr('data-area',area).attr('data-tipo','Limpieza').find('h2').html(response.Limpieza+' Camas');
        })
    }
    $('.Total_Camas,.Total_Camas_Disponibles, .Total_Camas_Ocupadas,.Total_Camas_Limpieza,.Total_Camas_Mantenimiento').click(function (e) {
        e.preventDefault();
        window.open(base_url+'Observacion/Camas/CamasDetalles?area='+$(this).attr('data-area')+'&tipo='+$(this).attr('data-tipo'),'_blank')
    })
});