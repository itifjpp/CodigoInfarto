$(document).ready(function () {
    if($('input[name=loadCamasEnfermeria]').val()!=undefined){
        AjaxLoadCamas();
    }
    $('body').on('click','.cortaestancia-actualizarcamas',function () {
        AjaxLoadCamas();
    })
    function AjaxLoadCamas() {
        sighMsjLoading();
        sighAjaxGet(base_url+'Cortaestancia/AjaxLoadCamas',function (response) {
            bootbox.hideAll();
            $('.row-cols-camas').html(response.cols);
        });
    }
    $('body').on('click','.btn-paciente-agregar',function (evt) {
        var cama_id=$(this).attr('data-cama');
        sighMjsConfirm({
            title:'INGRESAR N° DE FOLIO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group no-margin">'+
                            '<input type="number" name="ingreso_id" placeholder="INGRESAR N° DE FOLIO" class="form-control">'+
                        '</div>'+
                    '</div>',
            lb_accept:'INGRESAR',
            size:'small'
        },function (cb) {
            if(cb==true){
                sighMsjLoading('VALIDANDO N° DE FOLIO INGRESADO...');
                var ingreso_id=$('body input[name=ingreso_id]').val();
                sighAjaxPost({
                    ingreso_id:ingreso_id
                },base_url+'Cortaestancia/AjaxValidarFolio',function (response) {
                    bootbox.hideAll();
                    if(response.action=='N° DE INGRESO ENCONTRADO'){
                        sighAjaxPost({
                            cama_id:cama_id,
                            ingreso_id:ingreso_id,
                        },base_url+'Cortaestancia/AjaxValidarIngreso',function (response) {
                            if(response.action=='NO EXISTE EN CORTAESTANCIA'){
                                sighMsjLoading('INGRESANDO PACIENTE AL ÁREA DE CORTA ESTANCIA....');
                                sighAjaxPost({
                                    cama_id:cama_id,
                                    ingreso_id:ingreso_id,
                                },base_url+'Cortaestancia/AjaxIngresoByEnfermeria',function (response) {
                                    bootbox.hideAll();
                                    msj_success_noti('PACIENTE INGRESADO CORRECTAMENTE');
                                    AjaxLoadCamas();
                                });
                            }else if(response.action=='PACIENTE INGRESADO'){
                                sighMsjError("EL PACIENTE ACTUALMENTE SE ENCUENTRA EN EL ÁREA DE CORTA ESTANCIA");
                            }else if(response.action=='PACIENTE EGRESADO'){
                                sighMjsConfirm({
                                    title:'PACIENTE DADO DE ALTA',
                                    message:'<div class="col-md-12">'+
                                                '<h5 class="no-margin line-height text-justify">EL PACIENTE YA FUE DADO DE ALTA DEL ÁREA DE CORTA ESTANCIA. ¿DESEA REINGRESAR ESTE PACIENTE NUEVAMENTE?</h5>'+
                                            '</div>',
                                    size:'small'
                                },function (cb) {
                                    if(cb==true){
                                        sighMsjLoading('Reingresando paciente. Espere por favor...');
                                        sighAjaxPost({
                                            ingreso_id:ingreso_id
                                        },base_url+'Cortaestancia/AjaxEliminarPacienteDeCe',function (response) {
                                            bootbox.hideAll();
                                            sighMsjLoading('INGRESANDO PACIENTE AL ÁREA DE CORTA ESTANCIA....');
                                            sighAjaxPost({
                                                cama_id:cama_id,
                                                ingreso_id:ingreso_id,
                                            },base_url+'Cortaestancia/AjaxIngresoByEnfermeria',function (response) {
                                                bootbox.hideAll();
                                                msj_success_noti('PACIENTE INGRESADO CORRECTAMENTE');
                                                AjaxLoadCamas();
                                            });
                                        })
                                    }
                                })
                            }else{
                                sighMsjError("ERROR NO ESPECIFICADO");
                            }
                        });
                    }else{
                        sighMsjError('EL N° DE FOLIO INGRESADO NO EXISTE');
                    }
                });
            }
        });
    });
    $('body').on('click','.cortaestancia-tarjeta',function (evt) {
        evt.preventDefault();
        var ti_enfermedades_=$(this).attr('data-enfermedades');
        var ti_alergias_=$(this).attr('data-alergias');
        var ingreso_id=$(this).attr('data-ingreso');
        sighMjsConfirm({
            title:'Tarjeta de Identificación',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<label>Enfermedades Cronicodegenerativas</label>'+
                            '<textarea class="form-control" name="ti_enfermedades" maxlength="50" rows="1">'+ti_enfermedades_+'</textarea>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label>Alergias</label>'+
                            '<textarea class="form-control" name="ti_alergias" maxlength="85" rows="2">'+ti_alergias_+'</textarea>'+
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
                        OpenLoadView(base_url+'Inicio/Documentos/TarjetaDeIdentificacion/'+ingreso_id+'?via=Cortaestancia','TI',function () {
                            AjaxLoadCamas();
                        });
                    }
                });
            }
        });
    });
    $('body').on('click','.cortaestancia-cambiarcama',function (evt) {
        evt.preventDefault();
        var ingreso_id=$(this).attr('data-id');
        var area_id=$(this).attr('data-area');
        var cama_id_old=$(this).attr('data-cama');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR DE CAMA AL PACCIENTE?')){
            sighMsjLoading();
            sighAjaxPost({
                area_id:area_id
            },base_url+"Areas/AjaxObtenerCamas",function (response) {
                bootbox.hideAll();
                sighMjsConfirm({
                    title:'Cambiar Cama',
                    message:'<div class="col-md-12">'+
                                '<div class="form-group no-margin">'+
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
                        },base_url+"Cortaestancia/AjaxCambiarCama",function (response) {
                            bootbox.hideAll();
                            AjaxLoadCamas();
                        });
                    }
                });
            }); 
        }
    });
    $('body').on('click','.cortaestancia-end-mantenimiento',function(e){
        e.preventDefault();
        var cama_id=$(this).attr('data-id');
        if(confirm('¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?')){
            sighMsjLoading();
            sighAjaxPost({
                cama_id:cama_id
            },base_url+"Areas/AjaxEndMantenimiento",function (response) {
                bootbox.hideAll();
                AjaxLoadCamas();
            });
        }
    });
    $('body').on('click','.cortaestancia-cambiarenfermera',function () {
        var ingreso_id=$(this).attr('data-id');
        if(confirm('¿ESTA SEGURO QUE DESEA CAMBIAR DE ENFERMER@?')){
            sighMjsConfirm({
                title:'INGRESAR N° DE EMPLEADO',
                message:'<div class="col-md-12">'+
                            '<div class="form-group no-margin">'+
                                '<input type="text" name="empleado_matricula" class="form-control" placeholder="INGRESAR MATRICULA">'+
                            '</div>'+
                        '</div>',
                size:'small'
            },function (cb) {
                if(cb==true){
                    var empleado_matricula=$('body input[name=empleado_matricula]').val();
                    if(empleado_matricula!=''){
                        sighMsjLoading();
                        sighAjaxPost({
                            ingreso_id:ingreso_id,
                            empleado_matricula:empleado_matricula,
                        },base_url+"Cortaestancia/AjaxCambiarEnfermera",function (response) {
                            bootbox.hideAll();
                            if(response.accion=='1'){
                                msj_success_noti('CAMBIOS GUARDADOS..')
                                AjaxLoadCamas();
                            }if(response.accion=='2'){
                                sighMsjError('LA MATRICULA ESCRITA NO EXISTE');
                            }
                        });
                    }else{
                        sighMsjError("INGRESA N° DE EMPLEADO")
                    }
                }
            });
        }
    });
    $('body').on('click','.cortaestancia-imprimirpulsera',function (e) {
        e.preventDefault();
        var ingreso_id=$(this).attr('data-id');
        AbrirVista(base_url+'Inicio/Documentos/ImprimirPulsera/'+ingreso_id);
    });
    $('body').on('click','.cortaestancia-altapaciente',function (evt){
        evt.preventDefault();
        var ingreso_id=$(this).data('ingreso');
        var cama_id=$(this).data('cama');
        if(confirm('¿DAR DE ALTA PACIENTE?')){
            sighMjsConfirm({
                title:'SELECCIONAR DESTINO',
                message:'<div class="col-sm-12">'+
                            '<select class="width100" name="cortaestancia_alta">'+
                                '<option value="ALTA A DOMICILIO">ALTA A DOMICILIO</option>'+
                                '<option value="ALTA E INGRESO A QUIRÓFANO">ALTA E INGRESO A QUIRÓFANO</option>'+
                                '<option value="ALTA E INGRESO A HOSPITALIZACIÓN">ALTA E INGRESO A HOSPITALIZACIÓN</option>'+
                                '<option value="ALTA E INGRESO A UCI">ALTA E INGRESO A UCI</option>'+
                                '<option value="ALTA E INGRESO A CHOQUE">ALTA E INGRESO A CHOQUE</option>'+
                                '<option value="ALTA DESCONOCIDO">ALTA DESCONOCIDO</option>'+
                            '</select>'+
                        '</div>',
                size:'small'
            },function (cb) {
                if(cb==true){
                    sighMsjLoading();
                    sighAjaxPost({
                        cortaestancia_alta:$('body select[name=cortaestancia_alta]').val(),
                        cama_id:cama_id,
                        ingreso_id:ingreso_id
                    },base_url+'Cortaestancia/AjaxAltaPaciente',function (response) {
                        bootbox.hideAll();
                        AjaxLoadCamas();
                    });
                }
            });
        };
    });
});