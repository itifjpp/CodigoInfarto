$(document).ready(function () {
    
        $('body').on('blur','input[name=paciente_rfc]',function (evt) {
            var paciente_rfc=$(this).val();
            if(paciente_rfc!=''){
                if(SiGH_VALIDACIONPACIENTE=='POR RFC' && $('input[name=paciente_id]').val()==''){
                    sighMessenger({
                        position:'right top',
                        msj:'VALIDANDO RFC DEL PACIENTE...'
                    });
                    sighAjaxPost({
                        paciente_rfc:paciente_rfc
                    },base_url+'Triage/AjaxValidarRfcExistence',function (response) {
                        if(response.action=='EXISTENCE'){
                            sighMessenger({
                                position:'right top',
                                msj:'RFC ENCONTRADO EN LA BASE DE DATOS, ASOCIANDO PACIENTE...'
                            });
                            $('input[name=paciente_nombre]').val(response.info.paciente_nombre);
                            $('input[name=paciente_ap]').val(response.info.paciente_ap);
                            $('input[name=paciente_am]').val(response.info.paciente_am);
                            $('select[name=paciente_sexo]').val(response.info.paciente_sexo);
                            $('input[name=paciente_fn]').val(response.info.paciente_fn);
                            $('input[name=paciente_derechohabiente][value="'+response.info.paciente_derechohabiente+'"]').attr('checked',true);
                            $('input[name=ingreso_validar_indentificador]').val('Si');
                            $('input[name=paciente_id]').val(response.info.paciente_id);
                            $('input[name=ingreso_pv]').val("Subsecuente");
                        }else{
                            sighMessenger({
                                position:'right top',
                                type:'error',
                                msj:'RFC NO ENCONTRADO EN LA BASE DE DATOS'
                            });
                            $('input[name=paciente_nombre]').val("");
                            $('input[name=paciente_ap]').val("");
                            $('input[name=paciente_am]').val("");
                            $('select[name=paciente_sexo]').val("");
                            $('input[name=paciente_fn]').val("");
                            $('input[name=paciente_derechohabiente]').removeAttr('checked');
                            $('input[name=ingreso_validar_indentificador]').val('No');
                            $('input[name=paciente_id]').val("");
                            $('input[name=ingreso_pv]').val("Primera vez");
                        }
                    });
                }
            }    
        });
    
    
    $('#input_search').focus();
    let TriageArea=$('input[name=TriageArea]').val();
    $('#input_search').keyup(function (e){
        var input=$(this);
        var ingreso_id=$(this).val();
        if(e.which==13 && ingreso_id!=''){ 
            sighMsjLoading();
            sighAjaxGet(base_url_server+'TriagePaciente/'+input.val()+'/'+TriageArea,function (response) {
                bootbox.hideAll();
                if(response.msj=='FOLIO ENCONTRADO'){
                    location.href=base_url+'Triage/Paciente/'+ingreso_id;
                }else{
                    sighMsjError('EL N° DE FOLIO INGRESADO NO EXISTE');
                }
            });
            input.val('');
        }
    });
    if($('input[name=paciente_derechohabiente]').attr('data-value')!=''){
        $('input[name=paciente_derechohabiente][value="'+$('input[name=paciente_derechohabiente]').attr('data-value')+'"]').attr('checked',true);
    }
    $('input[name=info_procedencia_esp]').click(function (e){
        if($(this).val()=='Si'){
            $('input[name=info_procedencia_esp_lugar]').prop('type','text').attr('required',true);
            $('.col-no-espontaneo').addClass('hide');
            $('select[name=info_procedencia_hospital]').val("").removeAttr('required');
            $('input[name=info_procedencia_hospital_num]').removeAttr('required').val('');
        }else{
            $('input[name=info_procedencia_esp_lugar]').prop('type','hidden').removeAttr('required').val('');
            $('.col-no-espontaneo').removeClass('hide');
             $('select[name=info_procedencia_hospital]').attr('required',true);
            $('input[name=info_procedencia_hospital_num]').attr('required',true);
        }
    })
    if($('input[name=info_procedencia_esp]').attr('data-value')=='Si'){
        $('.col-no-espontaneo').addClass('hide');
        $('input[name=info_procedencia_esp][value="Si"]').prop("checked",true);
        $('input[name=info_procedencia_esp_lugar]').prop('type','text').attr('required');
        $('select[name=info_procedencia_hospital]').val("").removeAttr('required');
        $('input[name=info_procedencia_hospital_num]').removeAttr('required').val('');
        
    }else{
        $("select[name=info_procedencia_hospital]").val($('select[name=info_procedencia_hospital]').attr('data-value'));
        $('input[name=info_procedencia_hospital_num]').attr('required',true);
    }
    $('.guardar-triage-enfermeria').submit(function (e) {
        e.preventDefault();
        if(!$('input[name=paciente_derechohabiente]').is(':checked')){
            sighMessenger({
                msj:'SELECCIONAR SI EL PACIENTE ES DERECHOHABIENTE SI O NO',
                position:'right bottom',
                type:'error'
            })
            return ;
        }
        var form=$(this).serialize();
        var inputSv=0;
        var inputSvTitle='';
        $('.sv').each(function () {
            if($(this).val()==''){
                inputSv=inputSv+1;
                inputSvTitle+='<li>'+$(this).attr('data-title')+'</li>';
            }
        })
        if(inputSv==0){
            AjaxGuardar(form);
        }else{
            _msjConfirm({
                message:'<div class="col-md-12"><h5 style="line-height:1.6">SIGNOS VITALES INCOMPLETOS ¿DESEA GUARDAR Y CONTINUAR?</h5></div>'+
                        '<div class="col-md-12"><ol>'+inputSvTitle+'</ol></div>',
                size:'small'
            },function (result) {
                if(result==true){
                    AjaxGuardar(form);
                }
            })
        }

    });
    function AjaxGuardar(form) {
        let loading=sighMsjLoading();
        sighAjaxPost(form,base_url+"Triage/EnfemeriatriageGuardar",function (response) {
            loading.modal('hide');
//            socket.emit('UpdateAnalisisIngresos',{
//                action:1
//            });
            if($('input[name=via]').val()!=''){
                AbrirDocumento(base_url+'Horacero/GenerarTicket/'+$('input[name=ingreso_id]').val());
                history.go(-1);
            }else{
                location.href=base_url+'Triage/Enfermeriatriage';
            }
        });
    }
    /*Indicador*/
    $('select[name=TipoBusqueda]').change(function () {
        if($(this).val()=='POR_FECHA'){
            $('.row-por-fecha').removeClass('hide');
            $('.row-por-hora').addClass('hide');
        }if($(this).val()=='POR_HORA'){
            $('.row-por-hora').removeClass('hide');
            $('.row-por-fecha').addClass('hide');
        }if($(this).val()==''){
            $('.row-por-hora').addClass('hide');
            $('.row-por-fecha').addClass('hide');
        }
    })
    $('input[name=paciente_fn]').on('change',function () {
        if($(this).val()!=''){
            let pacienteFecha=$('input[name=paciente_fn]').val().split('/');
            diffBetweenDatesMomentJS(getFechaHora(),pacienteFecha[2]+'-'+pacienteFecha[1]+'-'+pacienteFecha[0],function (result) {
                $('.paciente_fn').text(result.years+' Años '+result.months+' Meses')
            });
        }
    })
    $('select[name=paciente_sexo]').change(function (e) {
        if($('input[name=paciente_fn]').val()!=''){
            let pacienteFecha=$('input[name=paciente_fn]').val().split('/');
            diffBetweenDatesMomentJS(getFechaHora(),pacienteFecha[2]+'-'+pacienteFecha[1]+'-'+pacienteFecha[0],function (result) {
                $('.paciente_fn').text(result.years+' Años '+result.months+' Meses')
            });
        }
        if($(this).val()=='MUJER'){
            $('.triage_paciente_sexo').removeClass('hide');
            $('.paciente-sexo-mujer').removeClass('hide');
            $('input[name=info_indicio_embarazo][value="No"]').prop('checked',true);
            $('.info_indicio_embarazo').text('');
            $('.paciente_sexo').html('Mujer | ').removeClass('hide');
        }else if($(this).val()=='HOMBRE'){
            $('.info_indicio_embarazo').text('');
            $('.paciente-sexo-mujer').addClass('hide');
            $('.paciente-embarazo').html('').removeClass('hide');
            $('.triage_paciente_sexo').addClass('hide');
            $('input[name=info_indicio_embarazo][value="No"]').prop('checked',true);
            $('.paciente_sexo').html('Hombre | ').removeClass('hide');
        }else{
            $('.info_indicio_embarazo').text('');
            $('.paciente-sexo-mujer').addClass('hide');
            $('.paciente-sexo').html('');
            $('.triage_paciente_sexo').removeClass('hide');
            $('input[name=info_indicio_embarazo][value="No"]').prop('checked',true);
            $('.paciente-embarazo').html('').removeClass('hide');
        }
    });
    $('input[name=info_indicio_embarazo]').click(function () {
        if($(this).val()=='Si'){
            $('.info_indicio_embarazo').text(' | INDICIO EMBARAZO');
            $('.paciente-embarazo').html('EMBARAZO').removeClass('hide');
        }else{
            $('.info_indicio_embarazo').text('');
            $('.paciente-embarazo').html('EMBARAZO').addClass('hide');
        }
    });
    $('input[name=paciente_fn]').mask('99/99/9999');
    $('select[name=paciente_sexo]').val($('select[name=paciente_sexo]').attr('data-value'));
    /*SI EL MODULO ENFERMERIA TRIAGE HORA CERO ESTA HABILITADO*/
    $('.btn-horacero-enfermeria').click(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxGet(base_url+"Horacero/GenerarFolio",function (response) {
            location.href=base_url+'Triage/Paciente/'+response.max_id+'/?via=EnfermeriaHoraCero'
        });
    });
});

