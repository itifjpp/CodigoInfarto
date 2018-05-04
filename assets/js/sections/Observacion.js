var AjaxState=null;
$(document).ready(function () {
    setTimeout(function() {
        $('.row-loading').addClass('hide');
        $('.row-load').removeClass('hide');
    },1000)
    var ObservacionTipo=$('input[name=ObservacionTipo]').val();
    if(ObservacionTipo=='Pediatria'){
        AjaxCamas(3);
        setInterval(function (e) {
            AjaxCamas(3);
        },60000);
    }if(ObservacionTipo=='AdultosHombres'){
        AjaxCamas(5);
        setInterval(function (e) {
            AjaxCamas(5);
        },60000);
    }if(ObservacionTipo=='AdultosMujeres'){
        AjaxCamas(4);
        setInterval(function (e) {
            AjaxCamas(4);
        },60000);
    }if(ObservacionTipo=='MedicoObservacion'){
        AjaxMedicoObservacion();
        setInterval(function () {
            AjaxMedicoObservacion();
        },60000)
        
    }if(ObservacionTipo=='ProcedimientoQuirurgico'){
        AjaxMedicoObservacion();
        setInterval(function () {
            AjaxProcedimientoQuirurgico();
        },60000);
    }
    setInterval(function () {
        //$('.fecha-actual').html('<b>FECHA Y HORA: </b>'+fecha_dd_mm_yyyy()+' '+ObtenerHoraActual())
    },1000);
    
    function AjaxCamas(area) {
        $.ajax({
            url: base_url+"Sections/Observacion/AjaxCamas",
            type: 'POST',
            dataType: 'json',
            data:{
               area: area ,
               csrf_token:csrf_token
            },success: function (data, textStatus, jqXHR) {
                //$('.ultima-actualizacion').html('<b>ÚLTIMA ACTUALIZACIÓN: </b>'+ObtenerHoraActual());
                $('.cols-camas').html(data.col_md_3);
                if(data.page_reload=='1'){
                    msj_error_noti('ACTUALIZACIÓN POR CAMBIOS');
                    setTimeout(function () {
                        location.reload();
                    },2000)
                }
            },error: function (e) {
                console.log(e)
            }
        })
    }
    function AjaxMedicoObservacion() {
        Pace.ignore(function () {
            $.ajax({
                url: base_url+"Sections/Observacion/AjaxMedicoObservacion",
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    //$('.ultima-actualizacion').html('<b>ÚLTIMA ACTUALIZACIÓN: </b>'+ObtenerHoraActual());
                    $('.cols-camas').html(data.col_md_3);
                    if(data.page_reload=='1'){
                        msj_error_noti('ACTUALIZACIÓN POR CAMBIOS');
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },error: function (e) {
                    console.log('ERROR AL PROCESAR LA PETICIÓN AL SERVIDOR..'+e.responseText)
                }
            })
        })  
    }
    function AjaxProcedimientoQuirurgico() {
        Pace.ignore(function () {
            $.ajax({
                url: base_url+"Sections/Observacion/AjaxProcedimientoQuirurgico",
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    $('.ultima-actualizacion').html('<b>ÚLTIMA ACTUALIZACIÓN: </b>'+ObtenerHoraActual());
                    $('.cols-camas').html(data.col_md_3);

                    if(data.page_reload=='1'){
                        msj_error_noti('ACTUALIZACIÓN POR CAMBIOS');
                        setTimeout(function () {
                            location.reload();
                        },2000)
                    }
                },error: function (e) {
                    console.log('ERROR AL PROCESAR LA PETICIÓN AL SERVIDOR..'+e.responseText)
                }
            })
        })    
    }
})