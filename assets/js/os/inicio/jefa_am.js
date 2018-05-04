$(document).ready(function (e){
    $('.btn-turnos').click(function (){
        var turno=$('select[name=productividad_turno]').val();
        var fecha=$('input[name=productividad_fecha]').val();
        $.ajax({
            url: base_url+"inicio/JefaAMProductividad",
            type: 'POST',
            dataType: 'json',
            data: {
                'turno':turno,
                'fecha':fecha,
                'csrf_token':csrf_token
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data) {
                bootbox.hideAll();
                $('.row-productividad').removeClass('hide');
                var TOTAL_REGISTROS=data.TOTAL_CPR + data.TOTAL_NEUROCIRUGIA + data.TOTAL_CIRURIAGENERAL + data.TOTAL_MAXILOFACIAL+ data.TOTAL_CIRUGIAMAXILOFACIAL+data.TOTAL_FILTRO;
                $('.TOTAL_REGISTROS_FILTRO_INGRESO').html('Total de ingresos : '+TOTAL_REGISTROS+' Registros');
                $('.TOTAL_REGISTROS_OBSERVACION_INGRESO').html('Total de ingresos : '+data.TOTAL_OBSERVACION+' Registros');
                $('.TOTAL_REGISTROS_FILTRO_EGRESO').html('Total de egresos : '+data.TOTAL_FILTRO_EGRESO+' Registros');
                $('.TOTAL_REGISTROS_OBSERVACION_EGRESO').html('Total de egresos : '+data.TOTAL_OBSERVACION_EGRESO+' Registros');
                $('.btn-generar-luchaga-filtro-ingreso').attr('data-turno',turno).attr('data-fecha',fecha).attr('data-tipo','Ingreso');
                $('.btn-generar-luchaga-observacion-ingreso').attr('data-turno',turno).attr('data-fecha',fecha).attr('data-tipo','Ingreso');
                $('.btn-generar-luchaga-filtro-egreso').attr('data-turno',turno).attr('data-fecha',fecha).attr('data-tipo','Egreso');
                $('.btn-generar-luchaga-observacion-egreso').attr('data-turno',turno).attr('data-fecha',fecha).attr('data-tipo','Egreso');
                $('.btn-ingresos-registros').attr('data-turno',turno).attr('data-fecha',fecha).attr('data-tipo','Ingreso');
                $('.btn-egresos-registros').attr('data-turno',turno).attr('data-fecha',fecha).attr('data-tipo','Egreso');
                $.plot('#grafica_turnos',[
                    {label:'Consultorio CPR ('+data.TOTAL_CPR+')', data: data.TOTAL_CPR}, 
                    {label:'Consultorio Neurocirugía ('+data.TOTAL_NEUROCIRUGIA+')', data: data.TOTAL_NEUROCIRUGIA},
                    {label:'Consultorio Cirugía General ('+data.TOTAL_CIRURIAGENERAL+')',data:data.TOTAL_CIRURIAGENERAL}, 
                    {label:'Consultorio Maxilofacial ('+data.TOTAL_MAXILOFACIAL+')',data:data.TOTAL_MAXILOFACIAL}, 
                    {label:'Filtro ('+data.TOTAL_FILTRO+')',data:data.TOTAL_FILTRO},
                    {label:'Consultorio Cirugía Maxilofacial ('+data.TOTAL_CIRUGIAMAXILOFACIAL+')',data:data.TOTAL_CIRUGIAMAXILOFACIAL},
                    {label:'Observación ('+data.TOTAL_OBSERVACION+')',data:data.TOTAL_OBSERVACION}
                ],
                    {
                        series: { 
                            pie: { 
                                show: true, 
                                innerRadius: 0.6, 
                                stroke: { 
                                    width: 3 
                                },label: { 
                                    show: true, 
                                    threshold: 0.05 
                                } 
                            } 
                        },colors: ['#F92718','#FF9800','#FFC107','#00C853','#2196F3'],
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
    $('.btn-generar-luchaga-filtro-egreso, .btn-generar-luchaga-filtro-ingreso').click(function (e){
        window.open(base_url+'inicio/documentos/FormatoLechugaJAMFiltro?fecha='+$(this).attr('data-fecha')+'&turno='+$(this).attr('data-turno')+'&tipo='+$(this).attr('data-tipo'),'_blank');
    });
    $('.btn-generar-luchaga-observacion-ingreso,.btn-generar-luchaga-observacion-egreso').click(function (e){
        window.open(base_url+'inicio/documentos/FormatoLechugaJAMObservacion?fecha='+$(this).attr('data-fecha')+'&turno='+$(this).attr('data-turno')+'&tipo='+$(this).attr('data-tipo'),'_blank');
    })
    $('.btn-ingresos-registros,.btn-egresos-registros').click(function (e){
        window.open(base_url+'inicio/documentos/FormatoIngreso_Egreso?fecha='+$(this).attr('data-fecha')+'&turno='+$(this).attr('data-turno')+'&tipo='+$(this).attr('data-tipo'),'_blank');
    })
})