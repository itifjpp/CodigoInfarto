
$(document).ready(function (e) {
    $('body').on('click','.btn-add-hospital',function (e) {
        e.preventDefault();
        var hospital_id=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        _msjConfirmOpen({
            title:'NUEVO HOSPITAL',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<input name="hospital_nombre" class="form-control" value="'+$(this).attr('data-nombre')+'" placeholder="NOMBRE DEL HOSPITAL">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<input name="hospital_direccion" class="form-control" value="'+$(this).attr('data-direccion')+'" placeholder="DIRECCIÓN DEL HOSPITAL">'+
                        '</div>'+
                    '</div>',
            size:'medium'
        },function (result) {
            if(result==true){
                var hospital_nombre=$('body input[name=hospital_nombre]').val();
                var hospital_direccion=$('input[name=hospital_direccion]').val();
                if(hospital_nombre!=''){
                    SendAjaxPost({
                        hospital_id:hospital_id,
                        accion:accion,
                        hospital_nombre:hospital_nombre,
                        hospital_direccion:hospital_direccion,
                        csrf_token:csrf_token
                    },'Um/Hospitales/AjaxHospitales',function (response) {
                        location.reload();
                    });
                }else{
                    msj_error_noti('NOMBRE DEL HOSPITAL REQUIERIDO');
                }
            }
        })
    });
    $('body select[name=status_hora]').val($('body select[name=status_hora]').attr('data-value'));
    $('body select[name=s4_daños]').val($('body select[name=s4_daños]').attr('data-value'));
    $('body select[name=s7_analisis_necesidades_pro]').val($('body select[name=s7_analisis_necesidades_pro]').attr('data-value'));
    $('body select[name=s9_red_fria]').val($('body select[name=s9_red_fria]').attr('data-value'));
    $('body select[name=s10_tomografia]').val($('body select[name=s10_tomografia]').attr('data-value'));
    $('body select[name=s10_resonador]').val($('body select[name=s10_resonador]').attr('data-value'));
    $('body select[name=s10_rayos_x]').val($('body select[name=s10_rayos_x]').attr('data-value'));
    $('body select[name=s10_hemocomponentes]').val($('body select[name=s10_hemocomponentes]').attr('data-value'));
    $('body select[name=s10_ventiladores]').val($('body select[name=s10_ventiladores]').attr('data-value'));
    $('body select[name=s10_desfibriladores]').val($('body select[name=s10_desfibriladores]').attr('data-value'));$('body select[name=status_hora]').val($('body select[name=status_hora]').attr('data-value'));
    $('body select[name=s11_elevadores]').val($('body select[name=s11_elevadores]').attr('data-value'));
    $('body select[name=s11_suministro_de_luz]').val($('body select[name=s11_suministro_de_luz]').attr('data-value'));
    $('body select[name=s11_planta_de_luz]').val($('body select[name=s11_planta_de_luz]').attr('data-value'));
    $('body select[name=s11_combustible_planta_de_luz]').val($('body select[name=s11_combustible_planta_de_luz]').attr('data-value'));
    $('body select[name=s11_tanque_termo_oxigeno]').val($('body select[name=s11_tanque_termo_oxigenostatus_hora]').attr('data-value'));
    $('body select[name=s11_generador_de_vapor]').val($('body select[name=s11_generador_de_vapor]').attr('data-value'));
    if($('input[name=accion]').val()=='edit'){
        $('input,select,button,textarea').attr('disabled',true);
    }
    $('.ReporteStatusHospitales').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Um/Hospitales/AjaxReportesAdd',function (response) {
            if(response.accion=='1'){
                location.href=base_url+'Um/Hospitales/Reportes?hos='+$('input[name=hospital_id]').val();
            }else {
                msj_error_noti('REPORTE DE STATUS DEL HOSPITAL CON LA FECHA Y HORA ESPECFICADA NO SE PUEDE REGISTRAR MAS DE DOS VECES.')
            }
            
        });
    });
    if($('input[name=ShoChartCamas]').val()!=undefined){
        var CamasTotales=[];
        var HospitalesCamas=[];
        
        $('.col-CamasTotales span').each(function () {
            CamasTotales.push($(this).attr('data-value'));
            HospitalesCamas.push($(this).attr('data-hospital')+' ('+$(this).attr('data-value')+' CAMAS)');
        });
        ShowChart(CamasTotales,HospitalesCamas,'ChartCamasTotales');
    }
    if($('input[name=ShowCharts]').val()!=undefined){
        var colCamas=$('.col-CamasTotales');
        LineChartJS([colCamas.attr('data-m'),colCamas.attr('data-t'),colCamas.attr('data-n')],'ChartCamasTotales','TOTAL DE CAMAS');
        
        var colAdmisionNDH=$('.col-NoDerechoHabientes');
        LineChartJS([colAdmisionNDH.attr('data-m'),colAdmisionNDH.attr('data-t'),colAdmisionNDH.attr('data-n')],'ChartNoDerechoHabientes','ADMISIÓN DE PACIENTE NO DH');
        
        var colDefuncionesSismo=$('.col-ReporteDefunciones');
        LineChartJS([colDefuncionesSismo.attr('data-m'),colDefuncionesSismo.attr('data-t'),colDefuncionesSismo.attr('data-n')],'ChartReporteDefunciones','RELACIONADAS CON EL SISMO');
        
        var colCamasOcupadas=$('.col-CamasOcupadas');
        LineChartJS([colCamasOcupadas.attr('data-m'),colCamasOcupadas.attr('data-t'),colCamasOcupadas.attr('data-n')],'ChartCamasOcupadas','CAMAS OCUPADAS');
        
        var colEgresos=$('.col-EgresosPacientes');
        LineChartJS([colEgresos.attr('data-m'),colEgresos.attr('data-t'),colEgresos.attr('data-n')],'ChartEgresosPacientes','EGRESOS');
     
    }
    if($('input[name=ShowChartsAll]').val()!=undefined){
        var Camas=[];
        $('.col-datas-charts .span-camas').each(function (e) {
            Camas.push({
                    label: $(this).attr('data-hospital'),
                    pointBackgroundColor:"#F35958",
                    pointBorderWidth:5,
                    pointBorderColor:"#F35958",
                    borderColor:'#256659',
                    fill:0,
                    data: [$(this).attr('data-m'),$(this).attr('data-t'),$(this).attr('data-n')],
            });
            
        });
        LineChartJSAll(Camas,'ChartCamasTotales');
        var NoDh=[];
        $('.col-datas-charts .span-no-dh').each(function (e) {
            NoDh.push({
                    label: $(this).attr('data-hospital'),
                    pointBackgroundColor:"#F35958",
                    pointBorderWidth:5,
                    pointBorderColor:"#F35958",
                    borderColor:'#256659',
                    fill:0,
                    data: [$(this).attr('data-m'),$(this).attr('data-t'),$(this).attr('data-n')],
            });
            
        });
        LineChartJSAll(NoDh,'ChartNoDh');
        var DefuncionesSismo=[];
        $('.col-datas-charts .span-defunciones-sismo').each(function (e) {
            DefuncionesSismo.push({
                    label: $(this).attr('data-hospital'),
                    pointBackgroundColor:"#F35958",
                    pointBorderWidth:5,
                    pointBorderColor:"#F35958",
                    borderColor:'#256659',
                    fill:0,
                    data: [$(this).attr('data-m'),$(this).attr('data-t'),$(this).attr('data-n')],
            });
            
        });
        LineChartJSAll(DefuncionesSismo,'ChartDefuncionesSismo');
        var CamasOcupadas=[];
        $('.col-datas-charts .span-camas-ocupadas').each(function (e) {
            CamasOcupadas.push({
                    label: $(this).attr('data-hospital'),
                    pointBackgroundColor:"#F35958",
                    pointBorderWidth:5,
                    pointBorderColor:"#F35958",
                    borderColor:'#256659',
                    fill:0,
                    data: [$(this).attr('data-m'),$(this).attr('data-t'),$(this).attr('data-n')],
            });
            
        });
        LineChartJSAll(CamasOcupadas,'ChartCamasOcupadas');
        var EgresosPacientes=[];
        $('.col-datas-charts .span-egresos-pacientes').each(function (e) {
            EgresosPacientes.push({
                    label: $(this).attr('data-hospital'),
                    pointBackgroundColor:"#F35958",
                    pointBorderWidth:5,
                    pointBorderColor:"#F35958",
                    borderColor:'#256659',
                    fill:0,
                    data: [$(this).attr('data-m'),$(this).attr('data-t'),$(this).attr('data-n')],
            });
            
        });
        LineChartJSAll(EgresosPacientes,'ChartEgresosPacientes');
    }
    function LineChartJSAll(info,div) {
        console.log(info)
        var data = {
            labels: ["EN LA MAÑANA","EN LA TARDE","EN LA NOCHE"],
            datasets: info
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
    function LineChartJS(info,div,title) {
        var data = {
            labels: ["EN LA MAÑANA","EN LA TARDE","EN LA NOCHE"],
            datasets: [
                {
                    label: title,
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
    function BarChartJS(info,div,title) {
        var canvas = document.getElementById(div);
        var data = {
            labels: ["EN LA MAÑANA", "EN LA TARDE", "EN LA NOCHE"],
            datasets: [
                {
                    label: title,
                    backgroundColor: "#256659",
                    borderColor: "#256659",
                    borderWidth: 2,
                    hoverBackgroundColor: "#14322D",
                    hoverBorderColor: "#14322D",
                    data: info
                }
            ]
        };
        var myBarChart = Chart.Bar(canvas,{
            data:data,
            options:{
                animation: {
                    duration:5000
                }
            }
        });
    }
    function ShowChart(data,label,canvasDiv) {
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: data, backgroundColor: [
                        "#E73E42",//Rojo
                        "#FF9C2A",//Naranja
                        "#FFF82A",//Amarillo
                        "#8EDE70",//Verde
                        "#5393E4" //Azul
                    ]
                }], labels: label
            }, options: {
                responsive: true,
                onClick: function (evt) {}
            }
        };
        var canvas = document.getElementById(canvasDiv).getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
    }  
})