$(document).ready(function() {
    $('.yyyy-mm-dd').datepicker({
        format:'yyyy-mm-dd',
        autoclose:true
    });
    var fecha_yyyy_mm_dd=function (){        
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        if(dd<10) {
            dd='0'+dd;
        } 
        if(mm<10) {
            mm='0'+mm;
        } 
        return yyyy+'-'+mm+'-'+dd;
    };   
    $('body input[name=FECHA_INICIO]').val(fecha_yyyy_mm_dd());
    $('body input[name=FECHA_FIN]').val(fecha_yyyy_mm_dd());
    if($('input[name=CargarGrafica]').val()!=undefined){
        Graficar({
            mensaje:'no',
                fi:fecha_yyyy_mm_dd(),
            ff:fecha_yyyy_mm_dd()
        });   
    }
    
    $('.graficar').click(function () {
        Graficar({
            mensaje:'si',
            fi:$('input[name=FECHA_INICIO]').val(),
            ff:$('input[name=FECHA_FIN]').val()
        });
    });
    function Graficar(info){
        $('.fechas').html(info.fi+' '+info.ff);
        $.ajax({
           url:base_url+"Sections/Landing/PacientesPorSexo",
            type: 'POST',
            dataType: 'json',
            data:{
                fi:info.fi,
                ff:info.ff,
                csrf_token:csrf_token
            }, beforeSend: function () {
                if(info.mensaje === 'si'){
                    msj_loading();
                };
            }, success: function (data) {
                graficaPorClasificacion({
                    TOTAL_AZUL:data.TOTAL_AZUL,
                    TOTAL_VERDE:data.TOTAL_VERDE,
                    TOTAL_AMARILLO:data.TOTAL_AMARILLO,
                    TOTAL_NARANJA:data.TOTAL_NARANJA,
                    TOTAL_ROJO:data.TOTAL_ROJO
                });
                $.ajax({
                    url: base_url+"Sections/Landing/AjaxCalcularTiempoPromedio",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        fi:info.fi,
                        ff:info.ff,
                        csrf_token:csrf_token
                    },beforeSend: function (xhr) {
                        $('.load-tiempo-transcurrido').removeClass('hide');
                    },success: function (data, textStatus, jqXHR) {
                        $('.load-tiempo-transcurrido').addClass('hide');
                        $('.result-tiempo-transcurrido').html(data.TiempoPromedio+' Minutos');
                        $('.result-tam-muestra').html(data.FechaDiferencia);
                    },error: function (e) {
                        console.log(e);
                    }
                })
                bootbox.hideAll();
            }, error: function (e) {
            }
        });
    };
    function graficaPorClasificacion(data){
        var click=0;
       $('.grafica1').removeClass('hidden');
        var datos1= {
            type: "pie",
            data: {
                datasets: [{
                    data: [
                        data.TOTAL_AZUL,
                        data.TOTAL_VERDE,
                        data.TOTAL_AMARILLO,
                        data.TOTAL_NARANJA,
                        data.TOTAL_ROJO
                    ], backgroundColor: [
                        "#5393E4",  //Azul
                        "#8EDE70",  //Verde
                        "#FFF82A",  //Amarillo
                        "#FF9C2A",  //Naranja
                        "#E73E42"   //Rojo
                    ],hoverBackgroundColor: [
                        "#5393E4",  //Azul
                        "#8EDE70",  //Verde
                        "#FFF82A",  //Amarillo
                        "#FF9C2A",  //Naranja
                        "#E73E42"   //Rojo
                    ]
                }], labels: [
                    "Azul",
                    "Verde",
                    "Amarillo",
                    "Naranja",
                    "Rojo"
                ]
            }, options: {
                responsive: true ,
                onClick: function (evt) {
                    click++;
                    if(click==1){
                        var activePoints = char.getElementsAtEvent(evt);
                        window.open(base_url+'Sections/Landing/GraficaColor?color='+activePoints[0]._view.label+'&inputFi='+$('input[name=FECHA_INICIO]').val()+'&inputFf='+$('input[name=FECHA_FIN]').val(),'_blank')
                    }
                    click=0;
                }
            }
        };
        $('#contenedorGraficaClasificacion').html('');
        $('#contenedorGraficaClasificacion').html('<canvas id="graficaPorClasificacion"> </canvas>');
        $('#AZUL').html(data.TOTAL_AZUL);
        $('#VERDE').html(data.TOTAL_VERDE);
        $('#AMARILLO').html(data.TOTAL_AMARILLO);
        $('#NARANJA').html(data.TOTAL_NARANJA);
        $('#ROJO').html(data.TOTAL_ROJO);
        var azul = parseInt(data.TOTAL_AZUL);
        var verde = parseInt(data.TOTAL_VERDE);
        var amarillo = parseInt(data.TOTAL_AMARILLO);
        var naranja = parseInt(data.TOTAL_NARANJA);
        var rojo = parseInt(data.TOTAL_ROJO);
        $('#total_c').html((azul + verde + amarillo + naranja + rojo)+' Pacientes');
        var canvas = document.getElementById('graficaPorClasificacion').getContext("2d");
        var char = new Chart(canvas, datos1); 
    };
    function msj_loading () {
        bootbox.dialog({
            title:'<h5 style="color:white">Espere por favor...</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<center><i class="fa fa-spinner fa-pulse fa-3x"></i></center>'+
                        '<div>'+
                    '</div>'
        });
        var y = window.top.outerHeight / 4 ;
        $('.modal-dialog').css({
            'margin-top':y+'px',
            'width':'30%'
        });
    };
    if($('input[name=CargarGraficaDetalles]').val()!=undefined){
        $.ajax({
            url:base_url+'Sections/Landing/AjaxGraficaColor',
            type: 'POST',
            dataType: 'json',
            data:{
                Clasificacion:$('input[name=color]').val(),
                inputFi:$('input[name=inputFi]').val(),
                inputFf:$('input[name=inputFf]').val(),
            },beforeSend: function (xhr) {
                $('.response-ajax-graficas').removeClass('hide');
            },success: function (data, textStatus, jqXHR) {
                $('.response-ajax-graficas').addClass('hide');
                ChartGraficaSexo({
                    Hombres:data.Hombres,
                    Mujeres:data.Mujeres
                });
                ChartGraficaEspontaneos({
                    Espontaneo:data.Espontaneo,
                    Referido:data.Referido
                })
            },error: function (e) {
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
                        "#2196F3",  //Verde 
                        "#FF4081"  //Verde Claro
                    ]
                }], labels: [
                    'Hombres ('+data.Hombres+')',
                    'Mujeres ('+data.Mujeres+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('GraficaSexo').getContext("2d");
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
                        "#795548",  //Verde 
                        "#607D8B"  //Verde Claro
                    ]
                }], labels: [
                    'Espontáneo ('+data.Espontaneo+')',
                    'Referido ('+data.Referido+')'
                ]
            }, options: {
                responsive: true
            }
        };
        var canvas = document.getElementById('GraficaEsponRefec').getContext("2d");
        var ChartCanvas = new Chart(canvas, datos1);
   };
});
                
                
                
                
                
                
                
                
                
              