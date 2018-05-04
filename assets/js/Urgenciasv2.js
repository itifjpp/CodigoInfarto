$(document).ready(function () {    
    /*Graficación nueva versión*/
    $('input[name=inputFiltro]').click(function (e) {
        if($(this).val()=='Turnos'){
            $('.por-turnos').removeClass('hide');
            $('.por-fechas').addClass('hide');
        }else{
            $('.por-turnos').removeClass('hide');
            $('.por-turnos').addClass('hide');
            $('.por-fechas').removeClass('hide');
        }
    })
    $('.btn-graficas-triage').click(function (e) {
        e.preventDefault();
        $('.btn-graficas-triage').attr('disabled','true');
        var inputFiltro=$('input[name=inputFiltro]:checked').val();
        var inputTurno=$('select[name=inputTurno]').val();
        var inputFechaI=$('input[name=inputFechaI]').val();
        var inputFechaF=$('input[name=inputFechaF]').val();
        var TotalHc;
        var TotalTe;
        var TotalTm;
        var TotalAm;
        var Url1='';
        var Url2='';
        if(inputFiltro=='Fechas'){
            Url1='AjaxIndicadorTriage';
            Url2='AjaxIndicadorTriageClasificacion';
        }else{
            Url1='AjaxIndicadorTriageTurnos';
            Url2='AjaxIndicadorTriageClasificacionTurnos';
        }
        AjaxIndicadorTriage({
            inputFiltro:inputFiltro,
            inputTurno:inputTurno,
            inputFechaI:inputFechaI,
            inputFechaF:inputFechaF,
            inputTipo:'Hora Cero',
            inputUrl:Url1,
        },'.col-horacero .loading',function (response) {
            $('.col-horacero .loading').addClass('hide');
            $('.col-horacero .load').html(response.TotalIndicador+' Pacientes');
            TotalHc=response.TotalIndicador;
            AjaxIndicadorTriage({
                inputFiltro:inputFiltro,
                inputTurno:inputTurno,
                inputFechaI:inputFechaI,
                inputFechaF:inputFechaF,
                inputTipo:'Triage Enfermería',
                inputUrl:Url1,
            },'.col-triage-enfermeria .loading',function (response) {
                $('.col-triage-enfermeria .loading').addClass('hide');
                $('.col-triage-enfermeria .load').html(response.TotalIndicador+' Pacientes');
                TotalTe=response.TotalIndicador;
                AjaxIndicadorTriage({
                    inputFiltro:inputFiltro,
                    inputTurno:inputTurno,
                    inputFechaI:inputFechaI,
                    inputFechaF:inputFechaF,
                    inputTipo:'Triage Médico',
                    inputUrl:Url1,
                },'.col-triage-medico .loading',function (response) {
                    $('.col-triage-medico .loading').addClass('hide');
                    $('.col-triage-medico .load').html(response.TotalIndicador+' Pacientes');
                    TotalTm=response.TotalIndicador;
                    AjaxIndicadorTriage({
                        inputFiltro:inputFiltro,
                        inputTurno:inputTurno,
                        inputFechaI:inputFechaI,
                        inputFechaF:inputFechaF,
                        inputTipo:'Asistente Médica',
                        inputUrl:Url1
                    },'.col-asistente-medica .loading',function (response) {
                        $('.col-asistente-medica .loading').addClass('hide');
                        $('.col-asistente-medica .load').html(response.TotalIndicador+' Pacientes');
                        TotalAm=response.TotalIndicador;
                        $('.col-total-derechohabientes .loading').removeClass('hide');
                        $('.col-total-noderechohabientes .loading').removeClass('hide');
                        sighAjaxPost({
                            inputFiltro:inputFiltro,
                            inputTurno:inputTurno,
                            inputFechaI:inputFechaI,
                            inputFechaF:inputFechaF,
                            inputTipo:'Derechohabientes'
                        },base_url+'Urgencias/Graficas/'+Url1,function (response) {
                            $('.col-total-derechohabientes .loading').addClass('hide');
                            $('.col-total-noderechohabientes .loading').addClass('hide');
                        
                            $('.col-total-derechohabientes .load').html(response.TotalDerechoHabientes+' Pacientes');
                            $('.col-total-noderechohabientes .load').html(response.TotalNoDerechoHabientes+' Pacientes');
                            $.ajax({
                                url: base_url+"Urgencias/Graficas/"+Url2,
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    inputTurno:inputTurno,
                                    inputFechaI:inputFechaI,
                                    inputFechaF:inputFechaF
                                },beforeSend: function (xhr) {
                                    $('.col-grafica-clasificacion').removeClass('hide');
                                },success: function (data, textStatus, jqXHR) {
                                    $('.col-grafica-clasificacion').addClass('hide');
                                    $('.btn-graficas-triage').removeAttr('disabled');
                                    $('.GraficaIndicadorTriage').html('<hr><canvas id="GraficaIndicadorTriage" style="height: 200px"></canvas>');
                                    GraficaIndicadorTriage({
                                        Rojo:data.Rojo,
                                        Naranja:data.Naranja,
                                        Amarillo:data.Amarillo,
                                        Verde:data.Verde,
                                        Azul:data.Azul
                                    });
                                    var url_download_triage=base_url+'Sections/Reportes/DownloadExcelTriage?inputFiltro='+inputFiltro+'&inputTurno='+inputTurno+'&inputFi='+inputFechaI+'&inputFf='+inputFechaF;
                                    $('body .btn-indicador-triage-download').removeClass('hide').attr('data-url',url_download_triage)
                                    $('.btnExportChartToPDF').removeClass('hide');
                                },error: function (jqXHR, textStatus, errorThrown) {
                                    msj_error_serve()
                                }
                            });
                        });
                    });
                });
                
            });    
        });
        
    });
    $('body').on('click','.btn-indicador-triage-download',function () {
        window.location.href=$(this).attr('data-url');
    })
    function GraficaIndicadorTriage(info) {
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        info.Rojo,
                        info.Naranja,
                        info.Amarillo,
                        info.Verde,
                        info.Azul
                    ], backgroundColor: [
                        "#E73E42",//Rojo
                        "#FF9C2A",//Naranja
                        "#FFF82A",//Amarillo
                        "#8EDE70",//Verde
                        "#5393E4" //Azul
                    ]
                }], labels: [
                    'Rojo ('+info.Rojo+')',
                    'Naranja ('+info.Naranja+')',
                    'Amarillo ('+info.Amarillo+')',
                    'Verde ('+info.Verde+')',
                    'Azul ('+info.Azul+')'
                ]
            }, options: {
                responsive: true,
                onClick: function (evt) {
                    var activePoints = ChartCanvas.getElementsAtEvent(evt);
                    var Color=activePoints[0]._view.label.split(' ');
                    var inputFiltro=$('input[name=inputFiltro]:checked').val();
                    var inputTurno=$('select[name=inputTurno]').val();
                    var inputFechaI=$('input[name=inputFechaI]').val();
                    var inputFechaF=$('input[name=inputFechaF]').val();
                    window.open(base_url+'Urgencias/Graficas/GraficasTriage?Color='+Color[0]+'&inputFiltro='+inputFiltro+'&inputFi='+inputFechaI+'&inputTurno='+inputTurno+'&inputFf='+inputFechaF,'DetallesTriage')
                }
            }
        };
        var canvas = document.getElementById('GraficaIndicadorTriage').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
    }
    function AjaxIndicadorTriage(info,beforeSend,response) {
        $.ajax({
            url: base_url+"Urgencias/Graficas/"+info.inputUrl,
            type: 'POST',
            dataType: 'json',
            data:info,
            beforeSend: function (xhr) {
                $(beforeSend).removeClass('hide');
            },success: function (data, textStatus, jqXHR) {
                response(data);
            },error: function (e) {
                msj_error_serve();
                console.log(e)
            }
        })
    }
    function ChartGraficaSexo(data){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        data.Hombres,
                        data.Mujeres
                    ], backgroundColor: [
                        "#42A5F5",
                        "#F06292"
                        
                    ]
                }], labels: [
                    'Hombres ('+data.Hombres+')',
                    'Mujeres ('+data.Mujeres+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('TriageGraficaSexo').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
   function ChartGraficaEspontaneos(data){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        data.Espontaneo,
                        data.Referido
                    ], backgroundColor: [
                        "#7E57C2",  //Verde 
                        "#5C6BC0"  //Verde Claro
                    ]
                }], labels: [
                    'Espontáneo ('+data.Espontaneo+')',
                    'Referido ('+data.Referido+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('TriageGraficaEsponRefec').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
   if($('input[name=GraficasTriage]').val()!=undefined){
        var TriageFi=$('input[name=TriageFi]').val();
        var TriageFf=$('input[name=TriageFf]').val();
        var TriageColor=$('input[name=TriageColor]').val();
        var TriageTurno=$('input[name=TriageTurno]').val();
        var TriageFiltro=$('input[name=TriageFiltro]').val();
        $('.col-graficas-tipos-triage').removeClass('hide');
        sighMsjLoading();
        sighAjaxPost({
            Color:TriageColor,
            inputFechaI:TriageFi,
            inputFechaF:TriageFf,
            inputFiltro:TriageFiltro,
            inputTurno:TriageTurno,
        },base_url+'Urgencias/Graficas/AjaxIndicadorTriageClasificacion_',function (response) {
            bootbox.hideAll();
            $('.col-graficas-tipos-triage').addClass('hide');
            $('.row-graficas-espontaneo-referido').removeClass('hide');
            ChartGraficaSexo({
                Hombres:response.Hombres,
                Mujeres:response.Mujeres
            });
            ChartGraficaEspontaneos({
                Espontaneo:response.Espontaneo,
                Referido:response.Referido
            });
        });
   }

    $('.col-especialidades-graficas tr').click(function (e) {
        var inputFechaI=$('input[name=inputFechaI]').val();
        var inputFechaF=$('input[name=inputFechaF]').val();
        var inputFiltro=$('input[name=inputFiltro]:checked').val();
        var inputTurno=$('select[name=inputTurno]').val();
        var UrlAjax='';
        if(inputFiltro=='Fechas'){
            UrlAjax='AjaxGraficasConsultorios';
        }else{
            UrlAjax='AjaxGraficasConsultoriosTurnos'
        }
        var Col=$(this);
        var Servicio=Col.attr('data-id');
        sighMsjLoading();
        sighAjaxPost({
            inputServicio:Servicio,
            inputFechaI:inputFechaI,
            inputFechaF:inputFechaF,
            inputFiltro:inputFiltro,
            inputTurno:inputTurno,
        },base_url+'Urgencias/Graficas/'+UrlAjax,function (response) {
            bootbox.hideAll();
            Col.attr('data-value',response.TotalServicio)
            Col.find('.load').html(response.TotalServicio+' Pacientes')
        })   
    });
    var Datos=[];
    var DatosLabel=[];
    $('.btn-graficar-ic').click(function (e) {
        Datos=[];
        DatosLabel=[];
        $('.col-especialidades-graficas tr').each(function () {
            Datos.push($(this).attr('data-value'));
            DatosLabel.push($(this).attr('data-especialidad')+'('+$(this).attr('data-value')+')');
        });
        $('.GraficaIndicadorConsultorios').html('<canvas id="GraficaIndicadorConsultorios" style="height:250px"></canvas>');
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: Datos
                    , backgroundColor: [
                        "#795548"  //Verde
                    ]
                }
            ], labels: DatosLabel
            }, options: {
                responsive: true,
                onClick: function (evt) {
                    var activePoints = ChartCanvas.getElementsAtEvent(evt);
                    var Servicio=activePoints[0]._view.label.split('(');
                    var inputFechaI=$('input[name=inputFechaI]').val();
                    var inputFechaF=$('input[name=inputFechaF]').val();
                    var inputFiltro=$('input[name=inputFiltro]:checked').val();
                    var inputTurno=$('select[name=inputTurno]').val();
                    window.open(base_url+'Urgencias/Graficas/GraficasConsultorios?Servicio='+Servicio[0]+'&inputFiltro='+inputFiltro+'&inputTurno='+inputTurno+'&inputFi='+inputFechaI+'&inputFf='+inputFechaF,'DetallesConsultorios')
                }
            }
        };
        var canvas = document.getElementById('GraficaIndicadorConsultorios').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
    });
    if($('input[name=GraficasConsultorios]').val()!=undefined){
        var TriageFi=$('input[name=TriageFi]').val();
        var TriageFf=$('input[name=TriageFf]').val();
        var TriageFiltro=$('input[name=TriageFiltro]').val();
        var TriageTurno=$('input[name=TriageTurno]').val();
        var TriageServicio=$('input[name=TriageServicio]').val();
        var info={
            inputServicio:TriageServicio,
            inputFechaI:TriageFi,
            TriageFiltro:TriageFiltro,
            TriageTurno:TriageTurno,
            inputFechaF:TriageFf,
        };
        sighMsjLoading();
        sighAjaxPost(info,base_url+'Urgencias/Graficas/AjaxGraficasConsultorios_ST7',function (response) {
            ChartGraficaST7({
                ConST7:response.ConST7,
                SinST7:response.SinST7
            });
            sighAjaxPost(info,base_url+'Urgencias/Graficas/AjaxGraficasConsultorios_Incapacidad',function (response) {
                ChartGraficaIncapacidad({
                    ConIncapacidad:response.ConIncapacidad,
                    SinIncapacidad:response.SinIncapacidad
                });
                bootbox.hideAll();
            });
        });
    }
    function ChartGraficaST7(info){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        info.ConST7,
                        info.SinST7
                    ], backgroundColor: [
                        "#795548",  //Verde 
                        "#607D8B"  //Verde Claro
                    ]
                }], labels: [
                    'Con ST7 ('+info.ConST7+')',
                    'Sin ST7 ('+info.SinST7+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('TriageGraficaST7').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
   function ChartGraficaIncapacidad(info){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        info.ConIncapacidad,
                        info.SinIncapacidad
                    ], backgroundColor: [
                        "#795548",  //Verde 
                        "#607D8B"  //Verde Claro
                    ]
                }], labels: [
                    'Con Incapacidad ('+info.ConIncapacidad+')',
                    'Sin Incapacidad ('+info.SinIncapacidad+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('TriageGraficaIncapacidad').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
   $('.btn-graficas-observacion').click(function (e) {
        var inputFechaI=$('input[name=inputFechaI]').val();
        var inputFechaF=$('input[name=inputFechaF]').val();
        var inputFiltro=$('input[name=inputFiltro]:checked').val();
        var inputTurno=$('select[name=inputTurno]').val();
        var ObsIngreso;
        var ObsEgresos;
        AjaxIndicadorObservacion({
            inputFechaI:inputFechaI,
            inputFechaF:inputFechaF,
            inputFiltro:inputFiltro,
            inputTurno:inputTurno,
            inputTipo:'Ingreso',
        },'.col-obs-ingresos .loading',function (response) {
            $('.col-obs-ingresos .loading').addClass('hide');
            $('.col-obs-ingresos .load').html(response.TotalIndicador+' Pacientes');
            ObsIngreso=response.TotalIndicador;
            AjaxIndicadorObservacion({
                inputFechaI:inputFechaI,
                inputFechaF:inputFechaF,
                inputFiltro:inputFiltro,
                inputTurno:inputTurno,
                inputTipo:'Egresos'
            },'.col-obs-egresos .loading',function (response) {
                $('.col-obs-egresos .loading').addClass('hide');
                $('.col-obs-egresos .load').html(response.TotalIndicador+' Pacientes');
                ObsEgresos=response.TotalIndicador;
                $('.TriageGraficaObservacion').html('<canvas id="TriageGraficaObservacion" style="height:250px"></canvas>')
                ChartGraficaObservacion({
                    Ingresos:ObsIngreso,
                    Egresos:ObsEgresos
                })
            });
        });
    })
    function AjaxIndicadorObservacion(info,beforeSend,response) {
        $(beforeSend).removeClass('hide');
        sighAjaxPost(info,base_url+"Urgencias/Graficas/AjaxIndicadorObservacion",function (responses) {
            response(responses);
        })
    }
    function ChartGraficaObservacion(info){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        info.Ingresos,
                        info.Egresos
                    ], backgroundColor: [
                        "#795548",  //Verde 
                        "#607D8B"  //Verde Claro
                    ]
                }], labels: [
                    'Ingresos ('+info.Ingresos+')',
                    'Egresos ('+info.Egresos+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('TriageGraficaObservacion').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
   $('.btn-graficas-pisos').click(function (e) {
        var inputFechaI=$('input[name=inputFechaI]').val();
        var inputFechaF=$('input[name=inputFechaF]').val();
        var inputFiltro=$('input[name=inputFiltro]:checked').val();
        var inputTurno=$('select[name=inputTurno]').val();
        var PisosIngreso;
        var PisosEgresos;
        AjaxIndicadorPisos({
            inputFechaI:inputFechaI,
            inputFechaF:inputFechaF,
            inputFiltro:inputFiltro,
            inputTurno:inputTurno,
            inputTipo:'Ingreso',
            csrf_token:csrf_token
        },'.col-pisos-ingresos .loading',function (response) {
            $('.col-pisos-ingresos .loading').addClass('hide');
            $('.col-pisos-ingresos .load').html(response.TotalIndicador+' Pacientes');
            PisosIngreso=response.TotalIndicador;
            AjaxIndicadorPisos({
                inputFechaI:inputFechaI,
                inputFechaF:inputFechaF,
                inputFiltro:inputFiltro,
                inputTurno:inputTurno,
                inputTipo:'Egresos',
                csrf_token:csrf_token
            },'.col-pisos-egresos .loading',function (response) {
                $('.col-pisos-egresos .loading').addClass('hide');
                $('.col-pisos-egresos .load').html(response.TotalIndicador+' Pacientes');
                PisosEgresos=response.TotalIndicador;
                $('.TriageGraficaPisos').html('<canvas id="TriageGraficaPisos" style="height:250px"></canvas>')
                ChartGraficaPisos({
                    Ingresos:PisosIngreso,
                    Egresos:PisosEgresos
                })
            });
        });
    });
    function AjaxIndicadorPisos(info,beforeSend,response) {
        $.ajax({
            url: base_url+"Urgencias/Graficas/AjaxIndicadorPisos",
            type: 'POST',
            dataType: 'json',
            data:info,
            beforeSend: function (xhr) {
                $(beforeSend).removeClass('hide');
            },success: function (data, textStatus, jqXHR) {
                response(data);
            },error: function (e) {
                msj_error_serve();
                console.log(e)
            }
        })
    }
    function ChartGraficaPisos(info){
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        info.Ingresos,
                        info.Egresos
                    ], backgroundColor: [
                        "#795548",  //Verde 
                        "#607D8B"  //Verde Claro
                    ]
                }], labels: [
                    'Ingresos ('+info.Ingresos+')',
                    'Egresos ('+info.Egresos+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('TriageGraficaPisos').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
    };
    if($('input[name=AjaxGraficaAnalisis]').val()!=undefined){
        AjaxAnalisisIngresos($('input[name=AjaxGraficaAnalisis]').val());
    }
    function AjaxAnalisisIngresos(inputFecha) {
        sighMsjLoading();
        sighAjaxPost({
            inputTipo:'Enfermera',
            inputFecha:inputFecha
        },base_url+'Urgencias/Graficas/AjaxAnalisisDeIngresos',function (enfermera) {
            sighAjaxPost({
                inputTipo:'Medico',
                inputFecha:inputFecha
            },base_url+'Urgencias/Graficas/AjaxAnalisisDeIngresos',function (medico) {
                bootbox.hideAll();
                $('.col-load-grafica').html('<canvas id="ColGraficaAnalisisIngresos" style="height:300px"></canvas>');
                var config = {
                type: 'line',
                data: {
                    labels: [
                        '00:00-00:59', 
                        '01:00-00:59', 
                        '02:00-02:59', 
                        '03:00-03:59', 
                        '04:00-04:59', 
                        '05:00-05:59', 
                        '06:00-06:59', 
                        '07:00-07:59', 
                        '08:00-08:59', 
                        '09:00-09:59', 
                        '10:00-10:59', 
                        '11:00-11:59', 
                        '12:00-12:59', 
                        '13:00-13:59', 
                        '14:00-14:59', 
                        '15:00-15:59', 
                        '16:00-16:59', 
                        '17:00-17:59', 
                        '18:00-18:59', 
                        '19:00-19:59', 
                        '20:00-20:59', 
                        '21:00-21:59', 
                        '22:00-22:59', 
                        '23:00-23:59'
                    ],
                    datasets: [{
                        label: 'Enfermera Triage',
                        //backgroundColor:'rgba(226, 95, 95, 0.5)',
                        //backgroundColor: "#A5DFDF",
                        borderWidth: 2,
                        borderColor: "#2793DB",
                        data: [
                                enfermera.sql0,
                                enfermera.sql1,
                                enfermera.sql2,
                                enfermera.sql3,
                                enfermera.sql4,
                                enfermera.sql5,
                                enfermera.sql6,
                                enfermera.sql7,
                                enfermera.sql8,
                                enfermera.sql9,
                                enfermera.sql10,
                                enfermera.sql11,
                                enfermera.sql12,
                                enfermera.sql13,
                                enfermera.sql14,
                                enfermera.sql15,
                                enfermera.sql16,
                                enfermera.sql17,
                                enfermera.sql18,
                                enfermera.sql19,
                                enfermera.sql20,
                                enfermera.sql21,
                                enfermera.sql22,
                                enfermera.sql23
                            ],
                            fill: false
                        },{
                        label: 'Médico Triage',
                        //backgroundColor:'rgba(165, 223, 223, 0.5)',
                        //backgroundColor: "#A5DFDF",
                        borderWidth: 2,
                        borderColor: "#E25F5F",
                        data: [
                                medico.sql0,
                                medico.sql1,
                                medico.sql2,
                                medico.sql3,
                                medico.sql4,
                                medico.sql5,
                                medico.sql6,
                                medico.sql7,
                                medico.sql8,
                                medico.sql9,
                                medico.sql10,
                                medico.sql11,
                                medico.sql12,
                                medico.sql13,
                                medico.sql14,
                                medico.sql15,
                                medico.sql16,
                                medico.sql17,
                                medico.sql18,
                                medico.sql19,
                                medico.sql20,
                                medico.sql21,
                                medico.sql22,
                                medico.sql23
                            ],
                            fill: false
                        }]
                    },options: {
                        responsive: true,
                        title: {
                                display: false,
                                text: 'Chart.js Line Chart'
                        },tooltips: {
                                mode: 'index',
                                intersect: false
                        },hover: {
                                mode: 'nearest',
                                intersect: true
                        }
                    }
                };
                var ctx = document.getElementById('ColGraficaAnalisisIngresos').getContext('2d');
                window.myLine = new Chart(ctx, config);
            })
            
            
        });
    }
    
    $('.btn-change-date-chart').on('click',function (evt) {
        sighMjsConfirm({
            title:'CAMBIAR FECHA',
            message:'<div class="col-md-12">'+
                        '<input type="text" name="inputFechaChange" class="form-control input-datepicker">'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var inputFechaChange=$('body input[name=inputFechaChange]').val();
                if(inputFechaChange!=''){
                    AjaxAnalisisIngresos(inputFechaChange);
                }
            }
        });
        ShowDatePicker();
    });
    socket.on('UpdateAnalisisIngresos',function(response) {
        if(response.action==1){
            AjaxAnalisisIngresos($('input[name=AjaxGraficaAnalisis]').val());
        }
    });
    $(".btnExportChartToPDF").click(function() {
        var canvas = document.getElementById("GraficaIndicadorTriage");
        var img = canvas.toDataURL("image/png");
        sighMsjLoading('Generando documento...');
        sighAjaxPost({
            img_name:'GRAFICAS',
            img_data:img,
            img_url_save:'graficas',
            img_type:'png'
        },base_url+'Config/writeImg',function(response) {
            bootbox.hideAll();
            var ingresos_enfermera=$('.col-triage-enfermeria h4 span').text().trim();
            var ingresos_medico=$('.col-triage-medico h4 span').text().trim();
            var ingresos_sidh=$('.col-total-derechohabientes h4 span').text().trim();
            var ingresos_nodh=$('.col-total-noderechohabientes h4 span').text().trim();
            var inputFiltro=$('input[name=inputFiltro]:checked').val();
            var inputTurno=$('select[name=inputTurno]').val();
            var inputFechaI=$('input[name=inputFechaI]').val();
            var inputFechaF=$('input[name=inputFechaF]').val();
            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ReporteTriageGeneral?img='+response.img_url+'&enfermera='+ingresos_enfermera+'&medico='+ingresos_medico+'&sidh='+ingresos_sidh+'&nodh='+ingresos_nodh+'&inputFiltro='+inputFiltro+'&inputTurno='+inputTurno+'&inputFechaI='+inputFechaI+'&inputFechaF='+inputFechaF,'REPORTE')
        });
    });
    $('body').on('click','.btn-graficas-consultorios',function (evt) {
        //sighMsjLoading('Esto puede tardar, por favor espere...');
        var inputFilter=$('input[name=inputFiltro]:checked').val();
        var inputTurno=$('select[name=inputTurno]').val();
        var inputDateStart=$('input[name=inputDateStart]').val();
        var inputDateEnd=$('input[name=inputDateEnd]').val();
        if(inputFilter=='Fechas'){
            diffBetweenDatesMomentJS(inputDateEnd,inputDateStart, function (cb) {
                console.log(cb)
                if(cb.months<=1 ){
                    sighAjaxPost({
                        inputFilter:inputFilter,
                        inputTurno:inputTurno,
                        inputDateStart:inputDateStart,
                        inputDateEnd:inputDateEnd
                    },base_url+'Urgencias/Graficas/AjaxIndicadorConsultorios',function (response) {
                        $('.row-consultorios-indicador').html(response.cols);
                        bootbox.hideAll();
                    })   
                }else{
                    msj_error_noti('EL RANGO DE FECHAS DE BUSQUEDA NO PUEDE PASAR DE 1 MES');
                }
            });    
        }else{
            sighAjaxPost({
                inputFilter:inputFilter,
                inputTurno:inputTurno,
                inputDateStart:inputDateStart,
                inputDateEnd:inputDateEnd
            },base_url+'Urgencias/Graficas/AjaxIndicadorConsultorios',function (response) {
                $('.row-consultorios-indicador').html(response.cols);
                bootbox.hideAll();
            });  
        }
    });
});