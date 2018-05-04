$(document).ready(function(){
    $('.btn-turnos').click(function (){
        var turno=$('select[name=productividad_turno]').val();
        var fecha=$('input[name=productividad_fecha]').val();
        $.ajax({
            url: base_url+"Urgencias/Graficas/AjaxBuscarProductividad",
            type: 'POST',
            dataType: 'json',
            data: {
                'turno':turno,
                'fecha':fecha,
                'csrf_token':csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.row-productividad').removeClass('hide');
                $('.TOTAl_HORACERO').attr('data-tipo','Hora Cero').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAl_HORACERO);
                $('.TOTAL_TRIAGE_E').attr('data-tipo','Triage Enfermería').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_TRIAGE_E);
                $('.TOTAL_TRIAGE_M').attr('data-tipo','Triage Médico').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_TRIAGE_M);
                $('.TOTAL_AM').attr('data-tipo','Asistente Médica').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_AM);
                $('.TOTAL_RX').attr('data-tipo','RX').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_RX);
                $('.TOTAL_CE').attr('data-tipo','Consultorios Especialidad').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_CE);
                $('.TOTAL_CHOQUE').attr('data-tipo','Ingreso Choque').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_CHOQUE);
                $('.TOTAL_OBSERVACION_E').attr('data-tipo','Enfermería Observación').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_OBSERVACION_E);
                $('.TOTAL_OBSERVACION_M').attr('data-tipo','Médico Observación').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_OBSERVACION_M);
                $('.TOTAL_CE_CA').attr('data-tipo','Cirugía Ambulatoria').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_CE_CA);
                $('.TOTAL_EGRESOS_AM').attr('data-tipo','Egreso Paciente Asistente Médica').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_EGRESOS_AM);
                $.plot('#grafica_turnos',[
                        {label:'Hora Cero', data: data.TOTAl_HORACERO}, 
                        {label:'Triage Enfermería', data: data.TOTAL_TRIAGE_E}, 
                        {label:'Triage Médico', data: data.TOTAL_TRIAGE_M}, 
                        {label:'Asistente Médica', data: data.TOTAL_AM}, 
                        {label:'RX', data: data.TOTAL_RX},
                        {label:'Consultorios Especialidad', data: data.TOTAL_CE},
                        {label:'Choque', data: data.TOTAL_CHOQUE},
                        {label:'Enfermería Observación', data: data.TOTAL_OBSERVACION_E},
                        {label:'Médico Observación', data: data.TOTAL_OBSERVACION_M},
                        {label:'Cirugía Ambulatoria', data: data.TOTAL_CE_CA},
                        {label:'Egresos Pacietes A.M', data: data.TOTAL_EGRESOS_AM}
                    ],{
                        series: { 
                            pie: { 
                                show: true, 
                                innerRadius: 0.6, 
                                stroke: { width: 3 }, 
                                label: { show: true, threshold: 0.05 } 
                            } 
                        },colors: ['#F44336','#E91E63','#9C27B0','#673AB7','#2196F3','#009688','#4CAF50','#FF9800','#795548','#76FF03','#CDDC39'],
                        grid: { 
                            hoverable: true, 
                            clickable: true, 
                            borderWidth: 0, 
                            color: '#212121' 
                        },
                        tooltip: true,
                        tooltipOpts: { 
                            content: '%s: %p.0%' 
                        }
                    }
                );
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('body').on('click','.TOTAl_HORACERO, .TOTAL_TRIAGE_E, .TOTAL_TRIAGE_M, .TOTAL_AM, .TOTAL_RX, .TOTAL_CHOQUE, .TOTAL_OBSERVACION_E, .TOTAL_OBSERVACION_M, .TOTAL_CE_CA, .TOTAL_EGRESOS_AM',function () {
        window.open(base_url+'urgencias/graficas/ProductividadUsuarios?turno='+$(this).attr('data-turno')+'&fecha='+$(this).attr('data-fecha')+'&tipo='+$(this).attr('data-tipo'),'_blank');
    })
    $('body').on('click','.TOTAL_CE',function () {
        window.open(base_url+'Urgencias/Graficas/Consultorios?turno='+$(this).attr('data-turno')+'&fecha='+$(this).attr('data-fecha')+'&tipo='+$(this).attr('data-tipo'),'_blank');
    })
    if($('input[name=usuarios_productiviad]').val()!=undefined){
        $.ajax({
            url: base_url+"urgencias/graficas/AjaxProductividadUsuarios",
            type: 'POST',
            dataType: 'json',
            data:{
                'turno':$('body input[name=turno]').val(),
                'fecha':$('body input[name=fecha]').val(),
                'tipo':$('body input[name=tipo]').val(),
                'csrf_token':csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.table-usuarios-productividad tbody').html(data.tr)
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                msj_error_serve()
            }
        })
    }
    if($('input[name=usuarios_consultorios]').val()!=undefined){
        $.ajax({
            url: base_url+"urgencias/graficas/AjaxConsultoriosUsuarios",
            type: 'POST',
            dataType: 'json',
            data:{
                'turno':$('body input[name=turno]').val(),
                'fecha':$('body input[name=fecha]').val(),
                'consultorio':$('body input[name=consultorio]').val(),
                'csrf_token':csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                $('.table-consultorios-users tbody').html(data.tr)
            },error: function (e) {
                bootbox.hideAll();
                msj_error_serve(e)
            }
        })
    }
    /*GRAFICA URGENCIAS VERSION 2*/
    $('.btn-turnos-v2').click(function (){
        
        var turno=$('select[name=productividad_turno]').val();
        var tipo=$('select[name=productividad_tipo]').val();
        var fecha=$('input[name=productividad_fecha]').val();
        //$('select[name=productividad_tipo] option[value="'+tipo+'"]').remove();
        $.ajax({
            url: base_url+"Urgencias/Graficas/AjaxBuscarProductividadV2",
            type: 'POST',
            dataType: 'json',
            data: {
                'turno':turno,
                'fecha':fecha,
                 tipo:tipo,
                'csrf_token':csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(tipo=='Hora Cero'){
                    $('.TOTAl_HORACERO').attr('data-tipo','Hora Cero').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAl_HORACERO);
                }if(tipo=='Triage Enfermería'){
                   $('.TOTAL_TRIAGE_E').attr('data-tipo','Triage Enfermería').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_TRIAGE_E);
                }if(tipo=='Triage Médico'){
                    $('.TOTAL_TRIAGE_M').attr('data-tipo','Triage Médico').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_TRIAGE_M);
                }if(tipo=='Asistente Médica'){
                    $('.TOTAL_AM').attr('data-tipo','Asistente Médica').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_AM);
                }if(tipo=='RX'){
                    $('.TOTAL_RX').attr('data-tipo','RX').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_RX);
                }if(tipo=='Consultorios Especialidad'){
                    $('.TOTAL_CE').attr('data-tipo','Consultorios Especialidad').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_CE);
                }if(tipo=='Choque'){
                    $('.TOTAL_CHOQUE').attr('data-tipo','Ingreso Choque').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_CHOQUE);
                }if(tipo=='Enfermería Observación'){
                    $('.TOTAL_OBSERVACION_E').attr('data-tipo','Enfermería Observación').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_OBSERVACION_E);
                }if(tipo=='Médico Observación'){
                    $('.TOTAL_OBSERVACION_M').attr('data-tipo','Médico Observación').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_OBSERVACION_M);
                }if(tipo=='Cirugía Ambulatoria'){
                    $('.TOTAL_CE_CA').attr('data-tipo','Cirugía Ambulatoria').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_CE_CA);
                }if(tipo=='Egresos Pacietes A.M'){
                  $('.TOTAL_EGRESOS_AM').attr('data-tipo','Egreso Paciente Asistente Médica').attr('data-turno',turno).attr('data-fecha',fecha).find('h1').html(data.TOTAL_EGRESOS_AM);
                }
                
                
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    if($('input[name=UrgGCOcupadas]').val()!=undefined){
        var GCDisponibles=[];
        $('.UrlCols .span-ocupados').each(function () {
            GCDisponibles.push({
                label: $(this).attr('data-type'),
                pointBackgroundColor:"#F35958",
                pointBorderWidth:5,
                pointBorderColor:"#F35958",
                borderColor:'#256659',
                fill:0,
                data: [$(this).attr('data-min'),$(this).attr('data-max')],
            });   
        });
        LineChartJSCOcupadas(GCDisponibles,'CharUrgGCOcupadas');
        
        var GCOcupadas=[];
        var colDisponibles =$('.UrlCols .span-disponibles');
        LineChartJSCDisponibles([
            colDisponibles.attr('data-h'),colDisponibles.attr('data-m'),colDisponibles.attr('data-p'),colDisponibles.attr('data-c')
        ],[
            "HOMBRES","MUJERES","PEDIATRÍA","CHOQUE"
        ],'CAMAS DISPONIBLES','ChartUrgGCDisponibles');
        var DataChartEstados=$('#ChartUrgGCEstados');
        
        LineChartJSCDisponibles([
            DataChartEstados.attr('data-d'),DataChartEstados.attr('data-o'),DataChartEstados.attr('data-l'),DataChartEstados.attr('data-m')
        ],[
            "DISPONIBLES","OCUPADOS","EN LIMPIEZA","EN MANTENIMIENTO"
        ],'TOTAL DE CAMAS','ChartUrgGCEstados');
    }
    function LineChartJSCOcupadas(info,div) {
        console.log(info)
        var data = {
            labels: ["MENOR A 12 HRS","MAYOR A 12 HRS"],
            datasets: info
        };
        var myBarChart = Chart.Line("ChartUrgGCOcupadas",{
            data:data,
            options:{
                animation: {
                    duration:5000
                }
            }
        });
    }
    function LineChartJSCDisponibles(info,labels,label,div) {
        var data = {
            labels: labels,
            datasets: [
                {
                    label: label,
                    pointBackgroundColor:"#F35958",
                    pointBorderWidth:5,
                    pointBorderColor:"#F35958",
                    borderColor:'#256659',
                    fill:0,
                    data: info
                }
            ]
        };
        var myBarChart = Chart.Line(div,{
            data:data,
            options:{
                animation: {
                    duration:5000
                }
            }
        });
    }
    if($('input[name=UrgGCPisos]').val()!=undefined){
        var Datos=[];
        $('.UrlColsPisos span').each(function () {
            Datos.push({
                label: $(this).attr('data-piso'),
                pointBackgroundColor:"#F35958",
                pointBorderWidth:5,
                pointBorderColor:"#F35958",
                borderColor:'#256659',
                fill:0,
                data: [$(this).attr('data-d'),$(this).attr('data-o'),$(this).attr('data-l'),$(this).attr('data-m')],
            });   
        });
        LineChartJSPisosEstados([
                "DISPONIBLES","OCUPADOS","EN LIMPIEZA","EN MANTENIMIENTO"
        ],Datos,'ChartUrgGCEstadosPisos');
    }
    function LineChartJSPisosEstados(labels,info,div) {
        var data = {
            labels: labels,
            datasets: info
        };
        $('.COL-HTML-CHART').html('');
        $('.COL-HTML-CHART').html('<canvas id="'+div+'" style="height: 100px"></canvas>');
        var myBarChart = Chart.Line(div,{
            data:data,
            options:{
                animation: {
                    duration:5000
                }
            }
        });
    }
    $(document).on('submit','.form-add-dp',function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Urgencias/DistribucionPersonal/AjaxAgregar',function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                 window.top.close();
                 window.opener.location.reload();
                msj_success_noti('REGISTRO GUARDADO')
            }if(response.accion=='2'){
                msj_error_noti('LA MATRICULA ESPECIFICADA NO EXISTE EN LA BASE DE DATOS')
            }if(response.accion=='3'){
                msj_error_noti('EL REGISTRO DE LA DP PARA ESTA FECHA Y TURNO YA ESTA REGISTRADO')
            }
        })
    });
    $('.search-matricula-dp').click(function () {
        let empleado_matricula=$('input[name=empleado_matricula]').val();
        if(empleado_matricula!=''){
            sighMsjLoading();
            sighAjaxPost({
                empleado_matricula:empleado_matricula,
            },base_url+'Urgencias/DistribucionPersonal/AjaxBuscarEmpleado',function (response) {
                bootbox.hideAll();
                if(response.accion=='1'){
                    $('input[name=empleado_nombre]').val(response.sql.empleado_nombre);
                    $('input[name=empleado_ap]').val(response.sql.empleado_ap);
                    $('input[name=empleado_am]').val(response.sql.empleado_am);
                    $('input[name=empleado_id]').val(response.sql.empleado_id);
                }else{
                    msj_error_noti('LA MATRICULA ESCRITA NO EXISTE EN LA BASE DE DATOS');
                }
            })
        }
    });
    $('.add-personal-dp').click(function (e) {
        let empleado_id=$('input[name=empleado_id]').val();
        let dp_area=$('input[name=dp_area]').val();
        let dp_tipo=$('select[name=dp_tipo]').val();
        let distribucion_id=$('input[name=distribucion_id]').val();
        if(dp_area!='' && dp_tipo!=''){
            sighMsjLoading();
            sighAjaxPost({
                empleado_id:empleado_id,
                dp_area:dp_area,
                dp_tipo:dp_tipo,
                distribucion_id:distribucion_id
            },base_url+'Urgencias/DistribucionPersonal/AjaxAgregarPersonal',function (response) {
                bootbox.hideAll();
                if(response.accion=='1'){
                    location.reload();
                }else{
                    msj_error_noti('EL USUARIO YA FUE AGREGADO AL REGISTRO DE DP PARA ESTA FECHA Y TURNO')
                }
            });
        }else{
            msj_error_noti('TODOS LOS CAMPOS SON REQUERIDOS');
        }
    });
    $(document).on('click','.delete-dp',function () {
        var dp_id=$(this).attr('data-id');
        sighAjaxPost({
            dp_id:dp_id,
        },base_url+'Urgencias/DistribucionPersonal/AjaxEliminarPersonal',function (response) {
            location.reload();
        })
    });
    $('.select2').select2();
});