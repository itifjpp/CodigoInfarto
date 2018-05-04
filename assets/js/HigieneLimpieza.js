$(document).ready(function (e) {
    if($('input[name=LoadCamasLimpieza]').val()!=undefined){
        AjaxCamasLimpieza()
    }
    function AjaxCamasLimpieza() {
        SendAjaxPost({
            csrf_token:csrf_token
        },'Higienelimpieza/Camas/AjaxCamasLimpieza',function (response) {
            $('.row-camas-limpieza').html(response.Camas);
        })
    }
    $('body').on('click','.btnReporteRopaQuirurgica',function (e) {
        let inputDateStart=$('input[name=inputDateStart]').val();
        let inputDateEnd=$('input[name=inputDateEnd]').val();
        if(inputDateEnd!='' && inputDateStart!=''){
            diffBetweenDatesMomentJS(inputDateEnd,inputDateStart,function (diff) {
                console.log(diff)
                if(diff.months==0){
                    SendAjaxPost({
                        inputDateStart:inputDateStart,
                        inputDateEnd:inputDateEnd,
                    },'HigieneLimpieza/AjaxRopaQuirurgica',function (response) {
                       $('.col-ReporteRopaQuirurgica').removeClass('hide');
                       $('.msjReporteRopaQuirurgicaTotal').html(response.total)
                    })                    
                }else{
                    _msjActions('EL RANGO DE FECHAS NO PUEDE EXCEDER DE UN MES','error')
                }
            })

        }else{
            _msjActions('TODOS LOS CAMPOS SON REQUERIDOS','error');
        }
    });
    $('.btnReporteRopaQuirurgicaDPF').click(function (e) {
        let inputDateStart=$('input[name=inputDateStart]').val();
        let inputDateEnd=$('input[name=inputDateEnd]').val();
        AbrirDocumento(base_url+'Inicio/Documentos/PrestacionesRopaQuirurgica?start='+inputDateStart+'&end='+inputDateEnd);
    })
})