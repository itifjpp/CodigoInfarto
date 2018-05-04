$(document).ready(function () {
    var RegExsp=new RegExp();
    $('body .add-quirofano').click(function () {
        Quirofano({
            title:'Agregar Quirófano',
            quirofano_id:0,
            quirofano_nombre:'',
            accion:'add'
        })    
    });
    $('body').on('click','.edit-quirofano',function () {
        Quirofano({
            title:'Agregar Quirófano',
            quirofano_id:$(this).attr('data-id'),
            quirofano_nombre:$(this).attr('data-quirofano'),
            accion:'edit'
        })    
    });
    function Quirofano(info) {
        bootbox.dialog({
            title:'<h5>'+info.title+'</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" name="quirofano_nombre" value="'+info.quirofano_nombre+'" placeholder="Nombre del Quirófano" class="form-control">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'small',
            buttons:{
                Cancelar:{
                    label:'Cancelar'
                },Guardar:{
                    label:'Guardar',
                    callback:function () {
                        var quirofano_nombre=$('body input[name=quirofano_nombre]').val();
                        if(quirofano_nombre!=''){
                            bootbox.hideAll();
                            $.ajax({
                                url: base_url+"Quirofano/AjaxAgregarQuirofano",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    quirofano_id:info.quirofano_id,
                                    quirofano_nombre:quirofano_nombre,
                                    accion:info.accion,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading()
                                },success: function (data, textStatus, jqXHR) {
                                    if(data.accion=='1'){
                                        msj_success_noti('Registro Guardado');
                                        ActionWindowsReload();
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    msj_error_serve()
                                }
                            })
                        }
                    }
                }
            }
        })
    }
    
    $('body').on('click','.del-quirofano',function (e) {
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"areas/quirofano/EliminarQuirofano/"+$(this).attr('data-id'),
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('Registro Eliminado');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            });
        }
    });
    /*MÉDICO QUIROFANO*/
    $('input[name=triage_id_medico]').focus();
    $('input[name=triage_id_medico]').keyup(function (e) {
        var triage_id=$(this).val();
        if(triage_id.length==11 && triage_id!=''){
            $(this).val('');
            $.ajax({
                url: base_url+"Quirofano/AjaxObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data:{
                    csrf_token:csrf_token,
                    triage_id:triage_id
                },beforeSend: function (xhr) {
                    msj_loading('Buscando estado del paciente...')
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        MsjNotificacion('ERROR | UMAE','N° DE PACIENTE NO ENCONTRADO EN ESTA ÁREA');
                    }if(data.accion=='2'){
                        
                    }if(data.accion=='3'){
                        
                    }if(data.accion=='4'){
                        
                    }if(data.accion=='5'){
                        if(confirm('¿DESEA DAR INGRESO ESTE PACIENTE A QUIRÓFANO?')){
                            var empleado_matricula=prompt('CONFIRMAR MATRICULA','');
                            if(empleado_matricula!=null && empleado_matricula!=''){
                                $.ajax({
                                    url: base_url+"Quirofano/Medico/AjaxAsociarMedico",
                                    type: 'POST',
                                    dataType: 'json',
                                    data:{
                                        empleado_matricula:empleado_matricula,
                                        triage_id:triage_id,
                                        csrf_token:csrf_token
                                    },beforeSend: function (xhr) {
                                        msj_loading('Validando matricula del médico y agregando paciete a quirófano')
                                    },success: function (data, textStatus, jqXHR) {
                                        bootbox.hideAll();
                                        if(data.accion=='1'){
                                            msj_success_noti('Paciente ingresaso a quirófano');
                                            location.reload();
                                        }if(data.accion=='2'){
                                            msj_error_noti('LA MATRICULA ESPECIFICADA NO EXISTE');
                                        }
                                    },error: function (jqXHR, textStatus, errorThrown) {
                                        msj_error_serve();
                                        bootbox.hideAll();
                                    }
                                })
                            }else{
                                msj_error_noti('Confirmación de matricula requerida');
                            }
                        }
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    })
    if($('input[name=LoadView]').val()!=undefined ){
        AjaxQuirofanos();
    }
    if($('input[name=LoadViewMedico]').val()!=undefined ){
        AjaxQuirofanosMedico();
    }
    function AjaxQuirofanos() {
        $.ajax({
            url: base_url+"Quirofano/Enfermeria/AjaxQuirofanos",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading('Obteniendo información de quirófanos...');
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.row-quirofanos').html(data.result_camas)
            },error: function (e) {
                msj_error_serve();
                bootbox.hideAll();
                console.log(e);
            }
        })
    }
    function AjaxQuirofanosMedico() {
        $.ajax({
            url: base_url+"Quirofano/Medico/AjaxQuirofanos",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading('Obteniendo información de quirófanos...');
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.row-quirofanos-medico').html(data.result_camas)
            },error: function (e) {
                msj_error_serve();
                bootbox.hideAll();
                console.log(e);
            }
        })
    }
    $('input[name=triage_id]').focus();
    $('input[name=triage_id]').keyup(function (e) {
        e.preventDefault();
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id!='' && triage_id.length==11){
            $.ajax({
                url: base_url+"Quirofano/Enfermeria/AjaxPaciente",
                type: 'POST',
                dataType: 'json',
                data:{
                    triage_id:triage_id,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='ASIGNADO'){
                        msj_success_noti('EL PACIENTE YA SE ENCUENTRA ASIGNADO A UN QUIRÓFANO')
                    }if(data.accion=='NO_EXISTE'){
                        $.ajax({
                            url: base_url+"Quirofano/Enfermeria/AjaxAgregarQuirofano",
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                triage_id:triage_id,
                                csrf_token: csrf_token
                            },beforeSend: function (xhr) {
                                msj_loading();
                            },success: function (data, textStatus, jqXHR) {
                                bootbox.hideAll();
                                if(data.accion=='1'){
                                    msj_success_noti('Paciente Agregado a Quirófano')
                                    ActionWindowsReload();
                                }
                            },error: function (error) {
                                msj_error_serve();
                                console.log(error);
                                bootbox.hideAll();
                            }
                        })
                    }
                },error: function (error) {
                    msj_error_serve();
                    console.log(error)
                    bootbox.hideAll();
                }
            })
            input.val('');
        }
    })
    /*-------------------------Enfermería Quirofano----------------------------*/
    $('input[name=triage_id_eq]').focus();
    $('input[name=triage_id_eq]').keyup(function () {
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id.length==11 && triage_id!=''){
            if(confirm("¿DESEA INGRESAR ESTE PACIENTE A QUIRÓFANO?")){
                $.ajax({
                    url: base_url+"Quirofano/Enfermeria/AjaxBuscarPaciente",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        triage_id:triage_id,
                        csrf_token:csrf_token
                    },beforeSend: function (xhr) {
                        msj_loading();
                    },success: function (data, textStatus, jqXHR) {
                        bootbox.hideAll();
                        if(data.accion=='0'){
                            msj_error_noti('EL N° DE PACIENTE NO EXISTE');
                        }if(data.accion=='1'){
                            msj_success_noti('PACIENTE INGRESADO A QUIRÓFANO');
                            ActionWindowsReload();
                            //window.open(base_url+'Quirofano/Enfermeria/Paciente/'+triage_id)
                        }if(data.accion=='2'){
                            msj_error_noti('EL PACIENTE YA SE ENCUENTRA EN QUIROFANO');
                        }
                    },error: function (jqXHR, textStatus, errorThrown) {
                        bootbox.hideAll();
                        msj_error_serve();
                    }
                })
                input.val('');
            }
        } 
    })
    /*INGRESO A SALA*/
    $('.qp-ingreso-sala').on('click',function (e) {
        var triage_id=$(this).attr('data-id'); 
       if(confirm('¿INGRESO A SALA?')){
            $.ajax({
                url: base_url+"Quirofano/Enfermeria/AjaxSalas",
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.option=='NO_HAY_SALAS'){
                        MsjNotificacion('NO HAY SALAS','<h4 class="text-center">NO HAY SALAS DISPONIBLES ACTUALMENTE</h4>');
                    }else{
                        bootbox.confirm({
                            title:'<h5>SELECCIONAR SALA</h5>',
                            message:'<div class="row">'+
                                        '<div class="col-md-12">'+
                                            '<div class="form-group">'+
                                                '<select name="quirofano_id" class="form-control">'+data.option+'</select>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<input type="text" class="form-control input-fecha" placeholder="Fecha de Ingreso">'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<input type="text" class="form-control input-hora" placeholder="Hora de Ingreso">'+
                                            '</div>'+
                                        '<div>'+
                                    '</div>',
                            size:'small',
                            buttons:{
                                confirm:{
                                    label:'Asignar Sala'
                                },cancel:{
                                    label:'Cancelar'
                                }
                            },callback:function (res) {
                                if(res==true){
                                    var quirofano_id=$('body select[name=quirofano_id]').val();
                                    var FechaValue=$('body .input-fecha').val();
                                    var HoraValue =$('body .input-hora').val();
                                    if(quirofano_id!='' && FechaValue!='' && HoraValue!=''){
                                        $.ajax({
                                            url: base_url+"Quirofano/Enfermeria/AjaxIngresoSala",
                                            type: 'POST',
                                            dataType: 'json',
                                            data:{
                                                triage_id:triage_id,
                                                quirofano_id:quirofano_id,
                                                FechaValue:FechaValue,
                                                HoraValue:HoraValue,
                                                csrf_token:csrf_token
                                            },beforeSend: function (xhr) {
                                                msj_loading();
                                            },success: function (data, textStatus, jqXHR) {
                                                if(data.accion=='1'){
                                                    msj_success_noti('EL PACIENTE A INGRESO A LA SALA');
                                                    ActionWindowsReload();
                                                }
                                            },error: function (jqXHR, textStatus, errorThrown) {
                                                msj_error_serve();
                                            }
                                        })
                                    }else{
                                        msj_error_noti('SELECCIONAR FECHA Y HORA');
                                    }
                                }
                            }
                        })
                        $('body .input-fecha').datepicker({
                            autoclose: true,
                            placement: 'bottom',
                            format: 'yyyy-mm-dd',
                            todayHighlight: true
                        })
                        $('body .input-hora').clockpicker({
                            placement: 'bottom',
                            autoclose: true
                        })
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    })
    
    $('.qp-inicia-anestesia').on('click',function (e) {
        var triage_id=$(this).attr('data-id');
        var qp_id=$(this).attr('data-qp');
        RealizarAccion('INICIAR ANESTESIA','ANESTESIA INICIADA',triage_id,qp_id,'qp_ia_f','qp_ia_h','Inicia Anestesia Quirófano');
    })
    $('.qp-inicia-procedimiento').on('click',function (e) {
        var triage_id=$(this).attr('data-id');
        var qp_id=$(this).attr('data-qp');
        RealizarAccion('INICIAR PROCEDIMIENTO','PROCEDIMIENTO INICIADO',triage_id,qp_id,'qp_ip_f','qp_ip_h','Inicia Procedimiento Quirófano');
    })
    $('.qp-termina-procedimiento').on('click',function (e) {
        var triage_id=$(this).attr('data-id');
        var qp_id=$(this).attr('data-qp');
        RealizarAccion('TERMINAR PROCEDIMIENTO','PROCEDIMIENTO TERMINADO',triage_id,qp_id,'qp_tp_f','qp_tp_h','Termina Procedimiento Quirófano');
    })
    $('.qp-egreso-sala').on('click',function (e) {
        var triage_id=$(this).attr('data-id');
        var qp_id=$(this).attr('data-qp');
        RealizarAccion('EGRESO DE SALA','EGRESADO DE SALA',triage_id,qp_id,'qp_es_f','qp_es_h','Egreso de Sala Quirófano');
    })
    $('.qp-termina-anestesia').on('click',function (e) {
        var triage_id=$(this).attr('data-id');
        var qp_id=$(this).attr('data-qp');
        RealizarAccion('TERMINAR ANESTESIA','ANESTESIA TERMINADA',triage_id,qp_id,'qp_ta_f','qp_ta_h','Termina Anestesia Quirófano');
    })
    function RealizarAccion(Pregunta,Respuesta,triage_id,qp_id,Fecha,Hora,Accion) {
        if(confirm("¿"+Pregunta+"?")){
            bootbox.confirm({
                title:'<h5>SELECCIONAR FECHA Y HORA</h5>',
                message:'<div class="row"><div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" class="form-control input-fecha" placeholder="Seleccionar fecha">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<input type="text" class="form-control input-hora" placeholder="Seleccionar Hora">'+
                            '</div>'+
                        '</div></div>',
                size:'small',
                callback:function (res) {
                    if(res==true){
                        var FechaValue=$('body .input-fecha').val();
                        var HoraValue =$('body .input-hora').val();
                        if(FechaValue!='' && HoraValue!=''){
                            $.ajax({
                                url: base_url+"Quirofano/Enfermeria/AjaxAccionesEnfermeria",
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    triage_id:triage_id,
                                    qp_id:qp_id,
                                    Fecha:Fecha,
                                    Hora:Hora,
                                    FechaValue:FechaValue,
                                    HoraValue:HoraValue,
                                    AccionTipo:Accion,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        msj_success_noti(Respuesta);
                                        if(Pregunta=='TERMINAR ANESTESIA'){
                                            ActionCloseWindowsReload()
                                        }else{
                                            ActionWindowsReload();
                                            window.opener.location.reload();
                                        }
                                        
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    msj_error_serve();
                                    bootbox.hideAll();
                                }
                            })         
                        }else{
                            msj_error_noti('SELECCIONAR FECHA Y HORA');
                        }
                    }
                }
                
            })
            $('body .input-fecha').datepicker({
                autoclose: true,
                placement: 'bottom',
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })
            $('body .input-hora').clockpicker({
                placement: 'bottom',
                autoclose: true
            })
        }
    }
    $('body').on('click','.qp-egreso-quirofano',function () {
        var triage_id=$(this).attr('data-id');
        var qp_id=$(this).attr('data-qp');
        var quirofano_id=$(this).attr('data-sala');
        if(confirm("¿EGRESAR PACIENTE DE QUIRÓFANO?")){
            bootbox.confirm({
                title:'<h5>ESPECIFICAR DESTINO</h5>',
                message:'<div class="row"><div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="text" class="form-control qp_alta" placeholder="Especificar Destino">'+
                            '</div>'+
                        '</div></div>',
                size:'small',
                callback:function (res) {
                    if(res==true){
                        var qp_alta=$('body .qp_alta').val();
                        if(qp_alta!=''){
                            $.ajax({
                                url: base_url+"Quirofano/Enfermeria/AjaxEgresoPaciente",
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    triage_id:triage_id,
                                    qp_id:qp_id,
                                    qp_alta:qp_alta,
                                    quirofano_id:quirofano_id,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data, textStatus, jqXHR) {
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        msj_success_noti('PACIENTE EGRESADO DE QUIRÓFANO');
                                        ActionWindowsReload()
                                        
                                    }
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    msj_error_serve();
                                    bootbox.hideAll();
                                }
                            })         
                        }else{
                            msj_error_noti('ESPECIFICAR DESTINO');
                        }
                    }
                }
                
            })
            $('body .input-fecha').datepicker({
                autoclose: true,
                placement: 'bottom',
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })
            $('body .input-hora').clockpicker({
                placement: 'bottom',
                autoclose: true
            })
        }
    })
    
    $('body').on('click','.alta-paciente',function (e){
        var triage_id=$(this).data('triage');
        var quirofano_id=$(this).data('quirofano');
        if(confirm('¿DAR DE ALTA PACIENTE DE SALA DEL QUIRÓFANO?')){
            $.ajax({
                url: base_url+"Quirofano/Enfermeria/AjaxAltaPaciente",
                type: 'POST',
                dataType: 'json',
                data:{
                    quirofano_id:quirofano_id,
                    triage_id:triage_id,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        AjaxQuirofanos();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        };
    })
    $('body').on('click','.finalizar-mantenimiento',function(e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTE QUIRÓFANO?')){
           $.ajax({
                url: base_url+"Quirofano/Enfermeria/AjaxFinalizarLimpiezaMantenimiento",
                type: 'POST',
                dataType: 'json',
                data:{id:el,csrf_token:csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando cambios');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        AjaxQuirofanos()
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
           })
        }
    })
    $('body').on('click','.quirofano-alta-paciente',function (e) {
        e.preventDefault();
        var triage_id=$(this).attr('data-id');
        if(confirm('¿ALTA PACIENTE DE QUIRÓFANO?')){
            $.ajax({
                url: base_url+"Quirofano/Enfermeria/AjaxAltaPacienteQuirofano",
                type: 'POST',
                dataType: 'json',
                data:{
                    triage_id:triage_id,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('Alta Paciente de Quirófano');
                        ActionWindowsReload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    })
    $('input[name=existencia_id]').focus();
    $('input[name=existencia_id]').keyup(function () {
        var input=$(this);
        var existencia_id=$(this).val();
        var triage_id=input.attr('data-triage');
        var quirofano_id=input.attr('data-quirofano');
        if(existencia_id!='' && existencia_id.length==11){
            $.ajax({
                url: base_url+"Quirofano/Medico/AjaxReportarConsumo",
                type: 'POST',
                dataType: 'json',
                data:{
                    existencia_id:existencia_id,
                    triage_id:triage_id,
                    quirofano_id:quirofano_id,
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        msj_success_noti('DATOS GUARDADOS');
                        ActionWindowsReload();
                    }if(data.accion=='2'){
                        msj_error_noti('EL CODIGO NO EXISTE');
                    }if(data.accion=='3'){
                        msj_error_noti('EL CODIGO YA ESTA REGISTRADO');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
            input.val('');
        }
    })
})
