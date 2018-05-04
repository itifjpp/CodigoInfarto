$(document).ready(function (e){
    $('body').on('click','.salida-paciente-ce',function (e){
        e.preventDefault();
        var el=$(this);
        if(confirm('¿REPORTAR SALIDA DEL PACIENTE?')){
                $.ajax({
                url: base_url+"Consultoriosespecialidad/AjaxReportarSalida",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'triage_id':el.attr('data-id')
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (e) {
                    msj_error_serve();
                    ReportarError(window.location.pathname,e.responseText);
                    bootbox.hideAll();
                }
            })
        }
    })    
   
    $('body').on('click','.salida-paciente-observacion',function (e){
        e.preventDefault();
        var el=$(this);
        if(confirm('¿REPORTAR SALIDA DEL PACIENTE DE CONSULTORIOS A OBSERVACIÓN?')){
                $.ajax({
                url: base_url+"Consultoriosespecialidad/AjaxSalidaObservacion",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'triage_id':el.attr('data-id')
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        ActionWindowsReload();
                    }
                },error: function (e) {
                    msj_error_serve();
                    ReportarError(window.location.pathname,e.responseText);
                    bootbox.hideAll();
                }
            })
        }
    })   
    $('body').on('click','.reenviar-otro-consultorio',function (e){
        var id=$(this).attr('data-id');
        var cons=$(this).data('consultorio');
        if(confirm('¿ENVIAR A OTRO CONSULTORIO?')){
            $.ajax({
                url: base_url+"Consultoriosespecialidad/AjaxObtenerConsultorios",
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    bootbox.dialog({
                        title: '<h5>SELECCIONAR DESTINO</h5>',
                        message:'<div class="row ">'+
                                    '<div class="col-sm-12">'+
                                        '<div class="form-group">'+
                                            '<select id="select_destino" class="form-control" style="width:100%">'+data.option+'</select>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<textarea class="form-control" name="doc_diagnostico" rows="4" placeholder="Diagnostico"></textarea>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>',
                        buttons: {
                            Cancelar:{
                               label:'Cancelar',
                               callback:function () {}
                            },Aceptar: {
                                label: "Aceptar",
                                className: "btn-fw green-700",
                                callback:function(){
                                    var select_destino=$('body #select_destino').val().split(';');
                                    var doc_diagnostico=$('body textarea[name=doc_diagnostico]').val();
                                    if(doc_diagnostico!=''){
                                        $.ajax({
                                            url: base_url+"consultoriosespecialidad/AjaxCambiarConsultorio",
                                            type: 'POST',
                                            dataType: 'json',
                                            data: {
                                                'csrf_token':csrf_token,
                                                'triage_consultorio':select_destino[0],
                                                'triage_consultorio_nombre':select_destino[1],
                                                doc_diagnostico:doc_diagnostico,
                                                'triage_id':id
                                            },beforeSend: function (xhr) {
                                                msj_loading();
                                            },success: function (data, textStatus, jqXHR) {
                                                bootbox.hideAll();
                                                ActionWindowsReload();
                                                AbrirDocumentoMultiple(base_url+'Inicio/Documentos/DOC430200/'+id);
                                            },error: function (e) {
                                                bootbox.hideAll();
                                                msj_error_serve();
                                                ReportarError(window.location.pathname,e.responseText);
                                            }
                                        })
                                    }else{
                                        msj_error_noti('DIAGNOSTICO REQUERIDO');
                                    }
                                }
                            }
                        }
                        ,onEscape : function() {}
                    });
                    $("#select_destino option[value='"+cons+"']").remove();
                },error: function (e) {
                    bootbox.hideAll();
                    msj_error_serve();
                    ReportarError(window.location.pathname,e.responseText);
                }
            });
        }
    })
    
    $('#filter_ce').focus();
    $('#filter_ce').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"Consultoriosespecialidad/AjaxObtenerPaciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    if(data.accion=='RESULT' && input.val()!=''){
                       bootbox.confirm({
                            title: "<h5>DESEA AGREGAR ESTE PACIENTE A LA LISTA?</h5>",
                            message: "FOLIO:"+data.paciente+"<br>PACIENTE: "+data.nombre,
                            buttons: {
                                confirm: {
                                    label: 'Si',
                                    className: 'btn-success'
                                },
                                cancel: {
                                    label: 'No',
                                    className: 'btn-primary'
                                }
                            },
                            callback: function (result) {
                                if(result==true){
                                    $.ajax({
                                    url: base_url+"consultoriosespecialidad/add_usuario_ce",
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'id':data.paciente,
                                        'csrf_token':csrf_token
                                    },beforeSend: function (xhr) {
                                        msj_loading();
                                    },success: function (data, textStatus, jqXHR) { 
                                        bootbox.hideAll()
                                        location.reload();
                                    },error: function (e) {
                                        msj_error_serve();
                                        console.log(e)
                                    }
                                })
                                }
                            }
                        });
                        
                    }if(data.accion=='NO_RESULT' && input.val()!=''){
                        AgregarAConsultorio(data)
                    }if(data.accion=='ASIGNADO' && input.val()!=''){
                        console.log(data)
                        PacienteAsignado(data.paciente,data.medico)
                    }if(data.accion=='NO_AM' && input.val()!=''){
                        MsjNotificacion('ERROR DATOS INCOMPLETOS','DATOS DEL PACIENTE NO CAPTURADOS POR ASISTENTE MÉDICA');
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
    function PacienteAsignado(data,medico) {
        var color_clasificacion='';
        if(data.triage_color=='Rojo'){
            color_clasificacion='red';
        }if(data.triage_color=='Naranja'){
            color_clasificacion='orange';
        }if(data.triage_color=='Amarillo'){
            color_clasificacion='yellow-A700';
        }if(data.triage_color=='Verde'){
            color_clasificacion='green';
        }if(data.triage_color=='Azul'){
            color_clasificacion='indigo';
        }
        var fecha_egreso='';
        if(data.ce_fs=='' || data.ce_fs==null){
            fecha_egreso='En Espera';
        }else{
            fecha_egreso=data.ce_fs+' '+data.ce_hs;
        }
        bootbox.confirm({
            title:'<h5><b> '+(data.ce_status!='Salida' ? "EL PACIENTE YA SE ENCUENTRA ASIGNADO AUN CONSULTORIO " : "EL PACIENTE YA ESTA DADO DE ALTA" )+'</b></h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div style="height:10px;width:100%;margin-top:10px" class="'+color_clasificacion+'"></div>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h3 style="line-height: 1.4;margin-top:0px"><b>PACIENTE: </b> '+data.triage_nombre+'</h3>'+
                            '<h3 style="line-height: 1.4;margin-top:-10px"><b>MÉDICO: </b> '+medico.empleado_nombre+' '+medico.empleado_apellidos+'</h3>'+
                            '<h3 style="line-height: 1.4;margin-top:-10px"><b>CONSULTORIO: </b> '+data.triage_consultorio_nombre+'</h3>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<h5 style="line-height: 1.4"><b><i class="fa fa-clock-o"></i> INGRESO: </b> '+data.ce_fe+' '+data.ce_he+'</h5>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<h5 style="line-height: 1.4"><b><i class="fa fa-clock-o"></i> EGRESO: </b> '+fecha_egreso+'</h5>'+
                        '</div>'+
                    '</div>',
            //size:'small',
            buttons:{
                confirm:{
                    label:'Ver Expediente'
                },cancel:{
                    label:'Cancelar'
                }
            },callback:function (res) {
                if(res==true){
                    window.open(base_url+'Sections/Documentos/Expediente/'+data.triage_id+'/?tipo=Consultorios','_blank')
                }
            }
        })
    }
    function AgregarAConsultorio(data_p) {
        bootbox.confirm({
            title: "<h5>EL PACIENTE NO SE ENCUENTRA EN ESTA ÁREA</h5>",
            message: "<b>FOLIO:</b> "+data_p.paciente.triage_id+"<br><b>PACIENTE:</b> "+data_p.paciente.triage_nombre+"<br>"+"<br><b>¿DESEA AGREGAR EL PACIENTE A ESTA AREA?</b>",
            buttons: {
                confirm: {
                    label: 'Si',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-primary'
                }
            },callback: function (result) {
                if(result==true){
                    bootbox.hideAll();
                    $.ajax({
                        url: base_url+"consultoriosespecialidad/AgregarPacienteConsultorio",
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            'triage_id':data_p.paciente.triage_id,
                            'csrf_token':csrf_token
                        },beforeSend: function (xhr) {
                            msj_loading('Agregando paciente al área de consultorios de especialidad');
                        },success: function (data, textStatus, jqXHR) {
                            if(data.accion=='1'){
                                bootbox.hideAll();
                                $.ajax({
                                    url: base_url+"consultoriosespecialidad/add_usuario_ce",
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'id':data_p.paciente.triage_id,
                                        'csrf_token':csrf_token
                                    },beforeSend: function (xhr) {
                                        msj_loading('Agregando paciente a la lista de consultorios de especialidad');
                                    },success: function (data, textStatus, jqXHR) { 
                                        bootbox.hideAll()
                                        location.reload();
                                    },error: function (e) {
                                        msj_error_serve();
                                        console.log(e)
                                    }
                                })
                            }
                        },error: function (jqXHR, textStatus, errorThrown) {
                            msj_error_serve();
                            bootbox.hideAll();
                        }
                    })
                }
            }
        });
    }
    $('body').on('click','.abandono-consultorio',function (e) {
        if(confirm('¿DAR DE ALTA PACIENTE, POR NO PRESENTARSE A CONSULTORIO?')){
            $.ajax({
                url: base_url+"Consultoriosespecialidad/AjaxAltaPorAusencia",
                type: 'POST',
                data:{
                    triage_id:$(this).attr('data-id'),
                    csrf_token:csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('ALTA DE CONSULTORIO POR AUSENCIA');
                        ActionWindowsReload();
                    }
                },error: function (e) {
                    msj_error_serve(e)
                }
            })
        }
    })
})