$(document).ready(function (e) {
    $('.btn-buscar').click(function (e) {
        var inputFecha1=$('input[name=inputFecha1]').val();
        var inputFecha2=$('input[name=inputFecha2]').val();
        SendAjaxPost({
            inputFecha1:inputFecha1,
            inputFecha2:inputFecha2,
            csrf_token:csrf_token
        },'Sections/Reportes/AjaxUrgenciasTriage',function (response) {
            console.log(response);
            if(response.accion=='1'){
                $('.col-result').removeClass('hide').find('h5').html('TOTAL DE REGISTROS ENCONTRADOS:'+response.Total+' REGISTROS');
                $('.link-download-report').attr('href',base_url+'Sections/Reportes/ExportReportUrgenciasTriage?inputFecha1='+inputFecha1+'&inputFecha2='+inputFecha2)
            }if(response.accion=='2'){
                msj_error_noti('LOS RANGOS DE BUSQUEDA NO PUEDEN SUPERAR MAS DE UN MES, POR FAVOR VUELVA A INTENTARLO');
            }
        });
    })
})