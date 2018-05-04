$(document).ready(function(e){
    
    $('select[name=triage_color]').val($('select[name=triage_color]').data('value'));
    $('select[name=filter_by]').val($('select[name=filter_by]').data('value'));
    $('body .select_filter').val($('.select_filter').data('value'));
    if($('input[name=filter_select]').val()==''){
        $('select[name=triage_color]').val('Todos')
    }
    $('body').on('click','.tr-solicitud-paciente',function (e){
        window.open(base_url+'inicio/documentos/Clasificacion/'+$(this).data('id'), '_blank');
    })
    $('body').on('click','.table-solicitud-rx tbody tr',function (e){
        $(this).find('input[type=checkbox]').attr('checked',true);
        
    })
    
    var total_minutos=$('input[name=total_minutos]').val();
    $('.total_minutos').html(total_minutos+' Minutos');
    $('.select_filter').change(function (e){
        $('input[name=filter_select]').val($(this).val())
        if($(this).val()=='by_fecha'){
            $('.by_fecha, .by_hora, .by_like').addClass('hide')
            $('.by_fecha').removeClass('hide');
        }else if($(this).val()=='by_hora'){
            $('.by_fecha, .by_hora, .by_like').addClass('hide')
            $('.by_hora').removeClass('hide');
        }else if($(this).val()=='by_like'){
            $('.by_fecha, .by_hora, .by_like').addClass('hide')
            $('.by_like').removeClass('hide');
        }else{
            $('.by_fecha, .by_hora, .by_like').addClass('hide')
        }
    })
    $('#input_search,#input_search_am').focus()
    $('#input_search').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"triage/obtener_etapa",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    console.log(data)
                    if(data.estado=='1' && input.val()!=''){
                        window.open(base_url+'triage/paso1?t='+input.val()+'&a=edit','_blank');
                    }if(data.estado=='2' && input.val()!=''){
                        window.open(base_url+'triage/paso2?t='+input.val()+'&a=edit','_blank');
                        
                    }if(data.estado=='3' && input.val()!=''){
                        if(data.etapa=='0'){
                            msj_success_noti('PACIENTE NO REGISTRADO POR ENFERMERIA') ;
                        }if(data.etapa=='1'){
                            msj_success_noti('LA PAPELETA DE ESTE PACIENTE YA SE ENCUENTRA REGISTRADO') ;
                        }if(data.etapa=='2'){
                            msj_success_noti('EL N° PACIENTE NO SE ENCUENTRA REGISTRADO O NO SE ENCUENTRA EN ESTA ETAPA') 
                        }
                        
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
            
            
        }
    })
    $('#input_search_am').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"asistentesmedicas/obtener_etapa",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    if(data.accion=='1' && data.alta!='Alta de Unidad' && input.val()!=''){
                        window.open(base_url+'asistentesmedicas/solicitud_paciente?t='+input.val()+'&a=edit','_blank');
                    }if(data.accion=='1' && data.alta=='Alta de Unidad' && input.val()!=''){
                        msj_error_noti('PACIENTE DADO DE ALTA DE LA UNIDAD')
                    }
                    if(data.accion=='2' && input.val()!=''){
                        msj_success_noti('EL N° PACIENTE NO SE ENCUENTRA REGISTRADO O NO SE ENCUENTRA EN ESTA ETAPA') 
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
            
            
        }
    })
    
    if($('input[name=accion]').val()=='edit'){
        $('input[name=triage_fecha]').removeClass('tag-fecha');
        $('input[name=triage_hora]').removeClass('tag-hora');
    }  else{
        $('body .triage_fecha').val(fecha_dd_mm_yyyy());
        $('body .triage_hora').val(hora_actual());
    }  


    $('.agregar-paso1').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"triage/inser_paso1",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (data, textStatus, jqXHR) {
                msj_success_noti('Guardando registro...')
            },success: function (data, textStatus, jqXHR) {
                msj_success_noti('Registro Guardado');
                if(data.accion=='1'){
                    window.opener.location.reload();
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    });
   
    $('.btn-submit-paso2').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"triage/getConsultorios",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                var total_puntos=0;
                $.each($('input[type=radio]:checked'),function (i,e){
                    total_puntos=total_puntos+parseInt($(this).val());
                })
                if(total_puntos>=21){
                    GuardarEtapa2();
                }else{
                    select_consultorio(data.option);
                }
            },error: function (e) {
                bootbox.hideAll();
                console.log(e)
            }
        });

    })
    function select_consultorio(option){
        bootbox.dialog({
            title: '<h5>Destino</h5>',
            message:'<div class="row ">'+
                        '<div class="col-sm-12">'+
                            '<label>Solicitar RX</label>&nbsp;&nbsp;&nbsp;'+
                            '<label class="ui-checks ui-checks-lg tip" data-original-title="">'+
                                '<input type="radio"  id="solicitar_rx_si" name="solicitar_rx" value="Si" class="has-value">'+
                                '<i></i>Si'+
                            '</label>&nbsp;&nbsp;'+
                            '<label class="ui-checks ui-checks-lg tip" data-original-title="">'+
                                '<input type="radio" checked="" id="solicitar_rx_no" name="solicitar_rx" value="No" class="has-value">'+
                                '<i></i>No'+
                            '</label>'+
                            '<br>'+
                            '<label>Seleccionar Destino</label>'+
                            '<select id="select_destino" style="width:100%">'+option+'</select>'+
                        '</div>'+
                    '</div>',
            buttons: {
                main: {
                    label: "Aceptar",
                    className: "btn-fw green-700",
                    callback:function(e){
                        
                        var select_destino=$('body #select_destino').val().split(';')
                        $('input[name=triage_consultorio]').val(select_destino[0]);
                        $('input[name=triage_consultorio_nombre]').val(select_destino[1]);
                        var form=$('body .agregar-paso2').serialize();    
                        $.ajax({
                            url: base_url+"triage/inser_paso2",
                            type: 'POST',
                            dataType: 'json',
                            data:form,
                            beforeSend: function (data, textStatus, jqXHR) {
                                msj_loading();
                            },success: function (data, textStatus, jqXHR) {
                                bootbox.hideAll();
                                if($('input[name=triage_solicitud_rx]').val()=='Si'){
                                    window.open(base_url+'triage/solicitar_rx?t='+data.triage_id+'&url=triage_medico', '_blank');
                                }else{
                                    window.open(base_url+'inicio/documentos/Clasificacion/'+data.triage_id, '_blank');
                                }
                                if(data.accion=='1'){
                                    window.opener.location.reload();
                                    window.top.close();
                                }
                                
                            },error: function (jqXHR, textStatus, errorThrown) {
                                bootbox.hideAll();
                                msj_error_serve()
                            }
                        })
                    }
                }
            }
            ,onEscape : function() {}
        });
        //fa fa-times

        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.modal-dialog').css({
            'margin-top':'130px',
            'width':'25%'
        })
        $('.modal-header').css('background','#02344A').css('padding','7px')
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
        $('body').on('click','input[name=solicitar_rx]',function (e){
            $('input[name=triage_solicitud_rx]').val($(this).val())
        })
    }
    $('.eliminar-triage').on('click',function(e){
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO?')){
            $.ajax({
                url: base_url+"triage/eliminar_triage",
                type: 'POST',
                dataType: 'json',
                data:{
                    'id':el,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro eliminado');
                        $('#'+el).remove();
                    }
                },error:function(e){
                    msj_error_serve();
                }
            })
        }
    })
    $('input[name=triage_preg1_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Pérdida súbita del estado de alerta','Si el paciente tiene o no el antecedente inmediato previo o situación clínica de ausencia abrupta de respuesta a los'+
            'estímulos del medio ambiente, lo que motiva su atención en el servicio.');
        }
    })
    $('input[name=triage_preg2_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Apnea','Si el paciente presenta o no ausencia de movimientos respiratorios al examinar su habitus exterior.');
        }
    })
    $('input[name=triage_preg3_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Ausencia de pulso','Si el paciente'+
                'presenta o no ausencia del latido intermitente de las arterias, que normalmente se puede percibir en varias'+
                'partes del cuerpo y especialmente en la muñeca de la mano.')
        }
    })
    $('input[name=triage_preg4_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Intubación de vía respiratoria','Si el paciente'+
                'se encuentra o no con intubación de la vía respiratoria orotraqueal, o con la presencia de cualquier dispositivo'+
                'cilíndrico hueco en la vía respiratoria superior, cuya finalidad es asegurar la permeabilidad de las mismas y'+
                'lograr una ventilación pulmonar eficaz.')
        }
    })
    $('input[name=triage_preg5_s1]').click(function(e){
        if($(this).val()=='31'){
            msj_evaluacion($(this),'Angor o equivalente','Si el paciente'+
                'presenta o no un cuadro caracterizado por dolor torácico'+
                'anterior de tipo opresivo habitualmente irradiado al'+
                'brazo izquierdo y al cuello, potencialmente acompañado'+
                'de palidez, sudoración fría, náusea, disnea, sensación'+
                'de ahogo y de urgencia urinaria o deseos de defecar;'+
                'producto todo de isquemia miocárdica.')
        }
    })
    
    function msj_evaluacion(el,title,msj){
        bootbox.dialog({
            title: '<h4>'+title+'</h4>',
            message:'<div class="row ">'+
                        '<div class="col-sm-12">'+
                            '<h5 style="line-height:2">'+msj+'</h5>'+
                        '</div>'+
                    '</div>',
            buttons: {
                cancelar: {
                    label: "Cancelar",
                    className: "btn-fw blue ",
                    callback:function(){
                        el.attr('checked',false);
                    }
                },main: {
                    label: "Aceptar",
                    className: "btn-fw green-700",
                    callback:function(e){
                        GuardarEtapa2()
                    }
                }
            }
            ,onEscape : function() {}
        });
        //fa fa-times

        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.modal-dialog').css({
            'margin-top':'130px',
            //'width':'30%'
        })
        $('.modal-header').css('background','#02344A').css('padding','7px')
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
        
    }
    function GuardarEtapa2(){
        bootbox.dialog({
            title: '<h5>Enviar a</h5>',
            message:'<div class="row ">'+
                        '<div class="col-sm-12">'+
                            '<label class="ui-checks ui-checks-lg ">'+
                                '<input type="radio"  name="enviar_a" value="Choque" class="has-value">'+
                                '<i></i>Choque'+
                            '</label>&nbsp;&nbsp;'+
                            '<label class="ui-checks ui-checks-lg">'+
                                '<input type="radio" name="enviar_a" value="Observación" class="has-value">'+
                                '<i></i>Observación'+
                            '</label>'+
                        '</div>'+
                    '</div>',
            buttons: {
                main: {
                    label: "Aceptar",
                    className: "btn-fw green-700",
                    callback:function(e){
                        var form=$('body .agregar-paso2').serialize();    
                        $.ajax({
                            url: base_url+"triage/inser_paso2",
                            type: 'POST',
                            dataType: 'json',
                            data:form,
                            beforeSend: function (data, textStatus, jqXHR) {
                                msj_loading();
                            },success: function (data, textStatus, jqXHR) {
                                bootbox.hideAll();
                                window.open(base_url+'inicio/documentos/Clasificacion/'+data.triage_id, '_blank');
                                if(data.accion=='1'){
                                    window.opener.location.reload();
                                    window.top.close();
                                }

                            },error: function (jqXHR, textStatus, errorThrown) {
                                bootbox.hideAll();
                                msj_error_serve()
                            }
                        })
                    }
                }
            }
        })
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.modal-dialog').css({
            'margin-top':'130px',
            'width':'30%'
        })
        $('.modal-header').css('background','#02344A').css('padding','7px')
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
        $('body').on('click','input[name=enviar_a]',function (){
            $('input[name=triage_enviar_a]').val($(this).val());
        })   
    }
    $('input[name=triage_procedencia_espontanea]').click(function (e){
        if($(this).val()=='Si'){
            $('input[name=triage_procedencia]').prop('type','text').attr('required',true);
            $('.col-no-espontaneo').addClass('hidden');
            $('input[name=triage_hostital_nombre_numero]').removeAttr('required');
        }else{
            $('input[name=triage_procedencia]').prop('type','hidden').removeAttr('required');
            $('.col-no-espontaneo').removeClass('hidden');
            $('input[name=triage_hostital_nombre_numero]').attr('required',true);
        }
    })
    if($('input[name=triage_procedencia]').val()=='' && $('input[name=accion]').val()=='edit'){
        //$('input[name=triage_procedencia]').prop('type','hidden');
        //$('.prosedencia_no').attr('checked',true);
        //$('.col-no-espontaneo').removeClass('hidden');
    }
    $('body').on('click','.enviar-asistentes-medicas',function (e){
        var triage_id=$(this).data('id');
        if(confirm('Enviar al área de asistentes médicas')){
            $.ajax({
                url: base_url+"asistentesmedicas/agregar_solicitud",
                type: 'POST',
                dataType: 'json',
                data: {
                    'triage_id':triage_id,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion==''){
                        msj_success_noti('Solicitud enviada');
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    bootbox.hideAll();
                    msj_error_serve();
                }
            })
        }
    })
    $('.guardar-solicitud-rx').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"triage/guardar_solicitud_rx",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    window.open(base_url+'inicio/documentos/Clasificacion_RX/'+$('body input[name=triage_id]').val(), '_blank');
                    
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
                bootbox.hideAll();
            }
        })
    })
    var click_btn=0;
    $('.btn-toogle-graficas').click(function (){
        var el=$(this);
        click_btn=click_btn+1;
        $('.toogle-graficas').toggle()
        if(click_btn==1){
            el.css({
               'margin-top':'300px!important' 
            });
            el.text('Ocultar grafica');
            
        }else{
            el.text('Mostrar grafica');
            click_btn=0;
        }
        
    })
    var show_hide_grafica=0;
    $('body .show-hide-grafica').click(function (e){
        var el=$(this);
        show_hide_grafica=show_hide_grafica+1;
        $('.show-hide-grafica-panel').toggle()
        if(show_hide_grafica==1){
            el.data('original-title','Ocultar Gráfica');
            el.find('i').removeClass('fa-arrow-down').addClass('fa-arrow-up')
        }else{
            el.data('original-title','Ver Gráfica');
            el.find('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
            show_hide_grafica=0;
        }
        
    })
    $('.agregar-horacero-paciente').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"triage/insert_horaceropaciente",
            dataType: 'json',
            beforeSend: function (data, textStatus, jqXHR) {
                msj_loading('Guardando registro...')
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
//                    JsBarcode(".code128", data.max_id,{
//                        displayValue: true,
//                        height: 50,
//                        width: 3
//                    });
                    window.open(base_url+'triage/generar_ticket?paciente_num='+data.max_id, '_blank');
                    //location.href=base_url+'triage/horacero?search='+data.max_id;
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                msj_error_serve()
            }
        })
    });
})