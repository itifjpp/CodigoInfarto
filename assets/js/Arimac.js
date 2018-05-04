$(document).ready(function(){
    $('input[name=triage_id]').focus();
    $('input[name=triage_id]').keyup(function(event){
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id.length==11 && triage_id!=''){
            $.ajax({
                url:base_url+'Arimac/AjaxBuscarPaciente',
                type:'POST',
                dataType:'json',
                data:{
                    triage_id:triage_id,
                    csrf_token:csrf_token
                },beforeSend:function(){
                    msj_loading();
                },success:function(data){
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        window.open(base_url+'Arimac/Paciente/'+triage_id,'_blank')
                    }
                },error:function(e){
                    bootbox.hideAll();
                    MsjError();
                }
            })
            input.val('');
        }
    });
    $('.form-expediente').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:base_url+'Arimac/AjaxExpediente',
            type:'POST',
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(e){
                msj_loading();
            },success:function(data){
                bootbox.hideAll();
                AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ExpedienteAmarilloBack/'+$('input[name=triage_id_val]').val(),'back',100);
                AbrirDocumento(base_url+'Inicio/Documentos/ExpedienteAmarillo/'+$('input[name=triage_id_val]').val());
                
            },error:function(e){
                bootbox.hideAll;
                MsjError();
            }
        });
    });
    $('input[name=triage_id_vigencia]').focus();
    $('input[name=triage_id_vigencia]').keyup(function (e) {
        var triage_id=$(this).val();
        var input=$(this);
        if(triage_id.length===11 && triage_id!==''){
            SendAjaxPost({
                triage_id:triage_id,
                csrf_token:csrf_token
            },'Arimac/Vigencias/AjaxCheckPaciente',function (response) {
                if(response.accion=='1'){
                    location.href=base_url+'Arimac/Vigencias/Paciente?folio='+triage_id;
                }else{
                    msj_error_noti(response.msj)
                }
            });
            input.val("");
        }
    });
    $('.btn-vigencia-arimac').click(function () {
        var triage_id=$(this).attr('data-id');
        SendAjaxGet('Arimac/Vigencias/AjaxAutorizacionTipos',function (response) {
            _msjConfirmOpen({
                title:'VIGENCIAS ARIMAC',
                message:'<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<div class="input-group">'+
                                    '<span class="input-group-addon" style="border: 0px;background: transparent;">ESTADO DE VIGENCIA.&nbsp;&nbsp;&nbsp;&nbsp;</span>'+
                                    '<select class="form-control" name="info_vigencia_arimac">'+
                                        '<option value="Si">AUTORIZAR VIGENCIA</option>'+
                                        '<option value="No">NO AUTORIZAR VIGENCIA</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="input-group">'+
                                    '<span class="input-group-addon" style="border: 0px;background: transparent;">TIPO DE AUTORIZACIÓN.</span>'+
                                        '<select class="form-control" name="info_vigencia_autorizacion_tipo">'+response.option+'</select>'+
                                '</div>'+
                            '</div>'+
                        '</div>',
                size:'medium'
            },function (result) {
                if(result===true){
                    SendAjaxPost({
                        triage_id:triage_id,
                        info_vigencia_arimac:$('body select[name=info_vigencia_arimac]').val(),
                        info_vigencia_autorizacion_tipo:$('body select[name=info_vigencia_autorizacion_tipo]').val(),
                        csrf_token:csrf_token
                    },'Arimac/Vigencias/AjaxAutorizacionVigencia',function (response) {
                        location.reload();
                    });
                }
            });
            $('input[name=info_vigencia_expire]').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })
        })
    })
});