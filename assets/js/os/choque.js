$(document).ready(function (){
    $('body').on('click','.alta-paciente',function (e){
        var triage_id=$(this).data('triage');
        var observacion_cama=$(this).data('cama');
        var observacion_alta=$(this).data('alta');
        if(confirm('¿DAR DE ALTA PACIENTE?')){
            $.ajax({
                url: base_url+"areas/choque/alta_paciente",
                type: 'POST',
                dataType: 'json',
                data:{
                    'observacion_alta':observacion_alta,
                    'triage_id':triage_id,
                    'observacion_cama':observacion_cama,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        };
    })
    function setting_modal(width){
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        if(width==undefined){
            $('.modal-dialog').css({
                'margin-top':'130px'
            })
        }else{
            $('.modal-dialog').css({
                'margin-top':'130px','width':width+'%'
            })
        }
        
        $('.modal-header').css('background','#02344A').css('padding','7px')
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    }
    $('body').on('click','.observacion-asociar-medico',function (e){
        var triage_id=$(this).data('id');
        if (confirm("¿ASOCIAR MÉDICO?")){
            var matricula=prompt('CONFIRMAR MATRICULA','');
            if(matricula!='' && matricula!=null){
                $.ajax({
                    url: base_url+"areas/choque/asociar_medico",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        'csrf_token':csrf_token,
                        'triage_id':triage_id,
                        'matricula':matricula
                    },beforeSend: function (xhr) {
                        msj_loading()
                    },success: function (data, textStatus, jqXHR) {
                        bootbox.hideAll();
                        if(data.accion=='1'){
                            msj_success_noti('Médico asociado correctamente');
                            location.reload()                       
                        }
                    },error:function (){
                        bootbox.hideAll();
                        msj_error_noti();
                    }
                })
            }
        }
    })
    $('body').on('click','.destino-paciente',function (e){
            var triage_id=$(this).data('id');
            bootbox.dialog({
            title: '<h5>SELECCIONAR DESTINO</h5>',
            message:'<div class="row ">'+
                        '<div class="col-sm-12">'+
                            '<input type="radio" name="observacion_alta_value" value="Alta a domicilio" id="domicilio"><label for="domicilio">Alta a domicilio</label><br>'+
                            '<input type="radio" name="observacion_alta_value" value="Alta e ingreso quirófano" id="quirofano"><label for="quirofano">Alta e ingreso quirófano</label><br>'+
                            '<input type="radio" name="observacion_alta_value" value="Alta e ingreso a hospitalización" id="hospitalizacion"><label for="hospitalizacion">Alta e ingreso a hospitalización</label> '+
                        '</div>'+
                    '</div>',
            buttons: {
                main: {
                    label: "Aceptar",
                    className: "btn-fw green-700",
                    callback:function(){
                        var observacion_alta=$('body input[name=observacion_alta]').val();
                        $.ajax({
                            url: base_url+"areas/choque/destino_paciente",
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                'observacion_alta':observacion_alta,
                                'triage_id':triage_id,
                                'csrf_token':csrf_token
                            },beforeSend: function (xhr) {
                                msj_loading()
                            },success: function (data, textStatus, jqXHR) {
                                bootbox.hideAll();
                                if(data.accion=='1'){
                                    location.reload();
                                }
                            },error: function (jqXHR, textStatus, errorThrown) {
                                msj_error_serve();
                                bootbox.hideAll();
                            }
                        })

                    }
                }
            }
            ,onEscape : function() {}
        });
        setting_modal(25);
        $('body').on('click','input[name=observacion_alta_value]',function (e){
            $('input[name=observacion_alta]').val($(this).val())
        })    
    })
    if($('input[name=accion_rol]').val()=='Enfermeria'){
        $.ajax({
            url: base_url+"areas/choque/CargarCamas",
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading('Obteniendo información de camas')
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.result_camas=='NO_HAY_CAMAS'){
                    $('.NO_HAY_CAMAS').removeClass('hide')
                }else{
                    $('.result_camas').html(data.result_camas);
                }
                
            },error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    }
    
    $('body').on('click','.btn-paciente-agregar',function (){
        var cama=$(this).data('cama');
        var triage_id=prompt("N° Paciente","");
        if(triage_id.length==11 && triage_id!=null){ 
            $.ajax({
                url: base_url+"areas/choque/obtener_paciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':triage_id,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading()
                },success: function (data, textStatus, jqXHR) { 
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        var matricula=prompt('CONFIRMAR MATRICULA','');
                        if(matricula!='' && matricula!=null){
                            $.ajax({
                                url: base_url+"areas/choque/llamar_paciente",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    'triage_id':triage_id,
                                    'csrf_token':csrf_token,
                                    'matricula':matricula,
                                    'cama':cama
                                },beforeSend: function (xhr) {
                                    msj_loading();
                                },success: function (data) {
                                    bootbox.hideAll();
                                    if(data.accion=='1'){
                                        location.reload();
                                    }
                                },error: function (e) {
                                    bootbox.hideAll();
                                    msj_error_serve();
                                }
                            })
                        }else{
                            msj_error_noti('Confirmación de matricula requerida');
                        }
                    }if(data.accion=='2'){
                        msj_success_noti('EL N° PACIENTE NO SE ENCUENTRA REGISTRADO O NO SE ENCUENTRA EN ESTA ETAPA') 
                    }if(data.accion=='3'){
                        msj_success_noti('EL N° PACIENTE YA SE ENCUENTRA REGISTRADO O SE HA DADO DE ALTA') 
                    }
                    if(data.accion=='4'){
                        msj_success_noti('EL N° PACIENTE NO CORRESPONDE A ESTA AREA') 
                    }
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            }) 
        }
    
    })
})