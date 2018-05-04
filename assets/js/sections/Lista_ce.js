$(document).ready(function (e){
    var continuePeticionToServer=0;
    var continueResponsiveVoice=0;
    setInterval(function (e){
        if(continuePeticionToServer==0){
             AjaxPacientesEnConsultorios('No');
        }
    },60000);
    AjaxPacientesEnConsultorios('No');

    socket.on('UpdateWaitingList',function (data) {
         AjaxPacientesEnConsultorios('Si');
    });

    function AjaxPacientesEnConsultorios(rvContent) {
        sighAjaxGet(base_url+"Sections/Listas/AjaxPacientesEnConsultorios",function (response) {
            $('body .lb-ultima-actualizacion').html(response.ULTIMA_ACTUALIZACION);
            if(response.ArtyomPaciente!='' && rvContent=='Si'){
                continueResponsiveVoice=1;
                responsiveVoice.speak(response.ArtyomPaciente,"Spanish Latin American Female",{
                    onstart: function () {
                        console.log('Primer llamado del paciente en pantalla');
                    }, onend: function () {
                        console.log('Finalizando primer llamado del paciente en pantalla')
                        responsiveVoice.speak(response.ArtyomPaciente,"Spanish Latin American Female",{
                            onstart: function () {
                                console.log('Segundo llamado del paciente en pantalla')
                            }, onend: function () {
                                console.log('Finalizando segundo llamado del paciente en pantalla');
                                continueResponsiveVoice=0;
                            }
                        });
                    }
                });
            }
            if(response.ListaPacientesLast==''){
                $('.last_lista_no').addClass('hide')
            }else{

                $('.last_lista_no').removeClass('hide')
            }
            if(response.TOTAL_LISTA==0){
                $('.row-no-list-patients').removeClass('hide');
                $('.row-list-last-patient').addClass('hide');
            }else{
                $('.row-no-list-patients').addClass('hide');
                $('.row-list-last-patient').removeClass('hide').html(response.ListaPacientesLast);
            }
            if(response.ListaPacientesAll==null){
                $('.table-pacientes-especialidad-no').removeClass('hide')
                $('.table-pacientes-especialidad').addClass('hide');
            }else{
                $('.table-pacientes-especialidad-no').addClass('hide')
                $('.table-pacientes-especialidad').removeClass('hide');
                $('.table-pacientes-especialidad').html(response.ListaPacientesAll);
            }
            if(response.ListaAccion=='1'){
                location.reload();
            }
        });
    }
    socket.on('CallPatientOnScreen',function(data) {
        if(continueResponsiveVoice==0){
            responsiveVoice.speak(data.ArtyomPaciente,"Spanish Latin American Female",{
                onstart: function () {
                    console.log('Llamado del paciente en pantalla manualmente...');
                    continuePeticionToServer=1; 
                }, onend: function () {
                    continuePeticionToServer=0;
                    socket.emit('CallPatientOnScreenReady',{
                        action:1
                    });
                    console.log('Finalizando llamado del paciente en pantalla manualmente...');
                }
            });
        }
    });
});