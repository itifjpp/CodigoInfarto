$(document).ready(function (e){
//    setTimeout(function() {
//        $('.row-loading').addClass('hide');
//        $('.row-load').removeClass('hide');
//    },1000)
//    setInterval(function (e){
//        AjaxInterconsultas();
//    },60000);
//    AjaxInterconsultas();
//    setInterval(function () {
//        $('.fecha-actual').html('<b>FECHA Y HORA: </b>'+fecha_dd_mm_yyyy()+' '+ObtenerHoraActual())
//    },1000);
//    function AjaxInterconsultas(area) {
//        Pace.ignore(function () {
//            $.ajax({
//                url: base_url+"Sections/Listas/AjaxInterconsultas",
//                type: 'POST',
//                data:{
//                   area: area ,
//                   csrf_token:csrf_token
//                },dataType: 'json',
//                success: function (data, textStatus, jqXHR) {
//                    $('.ultima-actualizacion').html('<b>ÚLTIMA ACTUALIZACIÓN: </b>'+ObtenerHoraActual());
//                    $('.cols-interconsultas').html(data.col_md_3);
//                    if(data.page_reload=='1'){
//                        msj_error_noti('ACTUALIZACIÓN POR CAMBIOS');
//                        setTimeout(function () {
//                            location.reload();
//                        },2000)
//
//                    }
//                },error: function (e) {
//                    console.log('ERROR AL PROCESAR LA PETICIÓN AL SERVIDOR..'+e.responseText)
//                }
//            })
//        })
//    }
    if($('input[name=ListaEsperaConsultorios]').val()!=undefined){
        sighMsjLoading();
        AjaxListaEsperaConsultorios_start();
        AjaxListaEsperaConsultorios();
    }
    var AjaxListaEsperaConsultorios_=0;
    function AjaxListaEsperaConsultorios() {
        
        setInterval(function () {
            if(AjaxListaEsperaConsultorios_==0){
                AjaxListaEsperaConsultorios_=AjaxListaEsperaConsultorios_+1;
                sighAjaxGet(base_url+'Sections/Listas/AjaxListaEsperaConsultorios',function (response) {
                    $('.row-ListaEsperaConsultorios').html(response.cols);
                    bootbox.hideAll();
                    AjaxListaEsperaConsultorios_=0;
                });
            }
            
        },60000);
        
    }
    function AjaxListaEsperaConsultorios_start() {
        sighAjaxGet(base_url+'Sections/Listas/AjaxListaEsperaConsultorios',function (response) {
            $('.row-ListaEsperaConsultorios').html(response.cols);
            bootbox.hideAll();
        });
        
    }
    /*INTERCONSULTAS*/
    if($('input[name=ListaInterconsultas]').val()!=undefined){
        sighMsjLoading();
        AjaxListaInterconsultas_start();
        AjaxListaInterconsultas();
    }
    var AjaxListaInterconsultas_=0;
    function AjaxListaInterconsultas() {
        
        setInterval(function () {
            if(AjaxListaInterconsultas_==0){
                AjaxListaInterconsultas_=AjaxListaInterconsultas_+1;
                sighAjaxGet(base_url+'Sections/Listas/AjaxInterconsultas',function (response) {
                    $('.row-ListaInterconsultas').html(response.cols);
                    bootbox.hideAll();
                    AjaxListaInterconsultas_=0;
                });
            }
            
        },60000);
        
    }
    function AjaxListaInterconsultas_start() {
        sighAjaxGet(base_url+'Sections/Listas/AjaxInterconsultas',function (response) {
            $('.row-ListaInterconsultas').html(response.cols);
            bootbox.hideAll();
        });
        
    }
    if($('input[name=AjaxPacientesEnEspera]').val()!=undefined){
        AjaxPacientesEnEspera();
    }
    function AjaxPacientesEnEspera() {
        sighMsjLoading('Actualizando lista de espera de pacientes...');
        sighAjaxGet(base_url+'Sections/Listas/AjaxPacientesEnEspera',function (response) {
            bootbox.hideAll();
            $('.lista-pacientes-espera tbody').html(response.tr);
            $('.h4-le-total').html(response.le_total);
            $('.h4-turno-amarillo').text(response.le_turno_amarillo);
            $('.h4-turno-verde').text(response.le_turno_verde);
            $('.h4-turno-azul').text(response.le_turno_azul);
            InicializeFootable('.lista-pacientes-espera');
        });
    }
    socket.on('UpdateWaitingList',function (data) {
        AjaxPacientesEnEspera(); 
    });
});