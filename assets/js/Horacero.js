$(document).ready(function () {
    $('.agregar-horacero-paciente').on('click',function(e){
        e.preventDefault();
        sighMsjLoading();
        sighAjaxGet(base_url+"Horacero/GenerarFolio",function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                AbrirDocumento(base_url+'Horacero/GenerarTicket/'+response.max_id);
            }
        });
    });
    $('.agregar-horacero-paciente-movil').on('click',function(e){
        e.preventDefault();
        sighMsjLoading();
        sighAjaxGet(base_url+"Horacero/Movil/GenerarFolio",function (response) {
            bootbox.hideAll();
            let ok=sighMsjOk('FOLIO DE INGRESO GENERADO');
            setTimeout(function () {
                ok.modal('hide');
            },1000);
        },'No');
    });
    $('body').on('click','.select_filter',function (e) {
        if($(this).val()==='by_fecha'){
            $('.by_fecha').removeClass('hide');
            $('.by_hora').addClass('hide');
           
        }else if($(this).val()==='by_hora'){
            $('.by_hora').removeClass('hide');
            $('.by_fecha').addClass('hide');
        }else{
            $('.by_fecha').addClass('hide');
            $('.by_hora').addClass('hide');
        }
        $('input[name=filter_select]').val($(this).val());
    });
    $('.by_fecha, .by_hora').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+"Horacero/AjaxIndicador",function (response) {
            bootbox.hideAll();
            $('.table-filtros tbody').html(response.tr);
            $('.horacero-indicador-rs').html(+response.total);
            $('.horacero-indicador-export').removeClass('hide');
            InicializeFootable('.table-filtros');
        });
    });
    $('.horacero-indicador-export').click(function (e) {
        AbrirVista(base_url+'Inicio/Documentos/ReporteIndicadorHoracero?inputFecha='+$('input[name=inputFecha]').val()+'&inputTurno='+$('select[name=inputTurno]').val())
    });
    if($('input[name=FullScreen]').val()!==undefined){
        $('.accion-windows .mdi-navigation-fullscreen').click(function (e) {   
            launchFullScreen(document.documentElement);
        });
    }
    $('.accion-windows .mdi-navigation-fullscreen-exit').click(function (e) {  
//        $('body .accion-windows i').removeClass('mdi-navigation-fullscreen-exit').addClass('mdi-navigation-fullscreen');
//        if (document.exitFullscreen) {
//                document.exitFullscreen();
//        } else if (document.webkitExitFullscreen) {
//                document.webkitExitFullscreen();
//        } else if (document.mozCancelFullScreen) {
//                document.mozCancelFullScreen();
//        } else if (document.msExitFullscreen) {
//                document.msExitFullscreen();
//        }
    });
    /*_*/
    
    function launchFullScreen(element) {
        $('body .accion-windows').addClass('hide');
        if(element.requestFullScreen) {
            element.requestFullScreen();
        } else if(element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if(element.webkitRequestFullScreen) {
            element.webkitRequestFullScreen();
        }
       
    }
});