var total_salida=0
var total_sal_new=0;
$(document).ready(function (e){
    setInterval(function (e){
        Pace.ignore(function(){
            $.ajax({
                url: base_url+"Sections/Listas/last_lista_paciente_rx",
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if(data.last_lista_paciente==''){
                        $('.last_lista_no').addClass('hide')
                    }else{
                        $('.last_lista_no').removeClass('hide')
                    }
                    $('.rx_last_lista tbody tr').html(data.last_lista_paciente);
                    if(data.result_listas_ce==null){
                        $('.table-pacientes-rx-no').removeClass('hide')
                        $('.table-pacientes-rx').addClass('hide');
                    }else{
                        $('.table-pacientes-rx-no').addClass('hide')
                        $('.table-pacientes-rx').removeClass('hide');
                        $('.table-pacientes-rx').html(data.result_listas_ce);
                    }


                },error: function (e) {
                    console.log(e);
                }
            })
        })
    },1000);

});