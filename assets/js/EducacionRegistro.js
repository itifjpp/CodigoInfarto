$(document).ready(function (e) {
    $('.users-agregar-edu').submit(function (e){
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Educacion/Registro/AjaxGuardarUsuario',function (response) {
            bootbox.hideAll();
            var img_logo=$('body .img-logo').attr('src');
            bootbox.dialog({
                title:'<h5 class="color-white no-margin text-left semi-bold">PRE REGISTRO COMPLETADO</h5>',
                message:'<div class="row">'+
                            '<div class="col-md-2">'+
                                '<img src="'+img_logo+'" style="width:100px">'+
                            '</div>'+
                            '<div class="col-md-10">'+
                                '<h5 class="line-height m-t-15  m-l-20 text-justify">'+
                                    '<b>GRACIAS POR TU REGISTRO</b>, PARA FINALIZAR EL PROCESO DIRÍGETE A LA COORDINACIÓN DE ENSEÑANZA E INVESTIGACIÓN.'+
                                '</h5>'+
                                '<h5 class="line-height m-t-15  m-l-20 text-justify">'+
                                   '<span style="color:red"><b>NOTA:</b></span> SU N° DE REGISTRO ES <b>'+response.empleado_id+'</b> EN CASO DE QUE SU PRE REGISTRO QUEDE PENDIENTE PARA CONTINUAR DEBERA PROPORCIONAR ESTE N° PARA DARLE CONTINUIDAD'+
                                '</h5>'+
                                '<button class="btn  pull-right sigh-background-secundary btn-terminar-preregistro">TERMINAR</button>'+
                            '</div>'+
                        '</div>',
                size:'medium'
            })
            $('body').on('click','.btn-terminar-preregistro',function (e) {
                location.href=base_url+'Registro';
            })
            var y = window.top.outerHeight / 4 ;
            $('.modal-dialog').css({
                'margin-top':y+'px'
            });
            
        });
    });
    
    $('body').on('click','.link-image-crop',function (evt) {
        sighImageCrop();
    });
   
    $('body').on('click','.preregistro-documento-eliminar',function(evt){
        var documento_id=$(this).attr('data-id');
        if(confirm('ELIMINAR DOCUMENTOS?')){
            sighAjaxPost({
                documento_id:documento_id
            },base_url+'Educacion/Registro/AjaxEliminarDocumento',function (response) {
                AjaxLoadDocumentos();
            })
        }
    });
    $('body').on('click','.preregistro-documento-nuevo',function (evt) {
        var documento_id=$(this).attr('data-id');
        sighMjsConfirm({
            title:'SUBIR UN NUEVO DOCUMENTO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<input type="file" name="anexo_nombre" class="form-control upload-archivo">'+
                        '</div>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var formData = new FormData();
                if($('body input[name=anexo_nombre]').val()!=''){
                    formData.append('anexo_nombre', $('body input[name=anexo_nombre]')[0].files[0]);
                    formData.append('documento_id', documento_id);
                    sighAjaxPostFiles(formData,base_url+'Educacion/Registro/AjaxAnexoAdd',function () {
                        AjaxLoadDocumentos();
                    })
                }else{
                    sighMsjError('SELECCIONAR UN ARCHIVO')
                }
                
            }
        });
        $('body .upload-archivo').fileinput({
                language: 'es'
        });
        $('body .fileinput-upload').hide();
    });
    var empleado_fn=0;
    $('input[name=empleado_fn]').on('change',function () {
        empleado_fn=empleado_fn+1;
        if($(this).val()!=''){
            let pacienteFecha=$('input[name=empleado_fn]').val().split('/');
            var empleado_fn_=$('input[name=empleado_fn]').val();
            if(empleado_fn==1){
                diffBetweenDatesMomentJS(getFechaHora(),pacienteFecha[2]+'-'+pacienteFecha[1]+'-'+pacienteFecha[0],function (result) {
                    //$('.paciente_fn').text(result.years+' Años '+result.months+' Meses');
                    $('input[name=empleado_fn]').val('');
                    if(result.years<18){
                        sighMsjError('FECHA DE NACIMIENTO NO VALIDA');
                    }else{
                        $('input[name=empleado_fn]').val(empleado_fn_)
                    }
                });
                
            }
            empleado_fn=0;
        }
    })
    if($('input[name=empleado_action]').val()=='edit'){
        $('input[name=tipo_registro]').prop('disabled',true);
        $('input[name=tipo_registro][value="ConcluirPreregistro"]').prop('checked',true);
        //----$('select[name=rol_id_edu]').val($('select[name=rol_id_edu]').attr('data-value'));
        $('select[name=empleado_estadocivil]').val($('select[name=empleado_estadocivil]').attr('data-value'));
        $('select[name=ropa_tipo]').val($('select[name=ropa_tipo]').attr('data-value'));
        $('select[name=eua_examen_ingles]').val($('select[name=eua_examen_ingles]').attr('data-value'));
        $('select[name=empleado_categoria]').val($('select[name=empleado_categoria]').attr('data-value'));
        if($('input[name=especialidad_r1]').val()!=''){
            //$('input[name=especialidad_r1]').removeAttr('readonly');
            $('#cbx_r1').attr('checked',true);
        }
        if($('input[name=especialidad_r2]').val()!=''){
            //$('input[name=especialidad_r2]').removeAttr('readonly');
            $('#cbx_r2').attr('checked',true);
        }
        if($('input[name=especialidad_r3]').val()!=''){
            //$('input[name=especialidad_r3]').removeAttr('readonly');
            $('#cbx_r3').attr('checked',true);
        }
        if($('input[name=especialidad_r4]').val()!=''){
            //$('input[name=especialidad_r4]').removeAttr('readonly');
            $('#cbx_r4').attr('checked',true);
        }
        if($('input[name=especialidad_r5]').val()!=''){
            //$('input[name=especialidad_r5]').removeAttr('readonly');
            $('#cbx_r5').attr('checked',true);
        }
        $('input[name=eua_vigencia][value="'+$('input[name=eua_vigencia]').attr('data-value')+'"]').prop('checked',true)
        AjaxLoadDocumentos();
//        setTimeout(function (evt) {
//            $('select[name=rol_id_edu]').trigger('change');
//        },1000);
    }
    $('input[name=tipo_registro]').click(function (evt) {
        if($(this).val()=='ConcluirPreregistro'){
            sighMjsConfirm({
                title:'INGRESAR N° DE REGISTRO',
                message:'<div class="col-md-12">'+
                            '<div class="form-group no-margin">'+
                                '<input type="text" name="empleado_tmp_id" class="form-control" placeholder="INGRESAR N° DE REGISTRO">'+
                            '</div>'+
                        '</div>',
                size:'small'
            },function (cb) {
                if(cb==true){
                    var empleado_tmp=$('body input[name=empleado_tmp_id]').val();
                    if(empleado_tmp!=''){
                        sighMsjLoading('VALIDANDO N° DE REGISTRO...');
                        sighAjaxPost({
                            empleado_tmp:empleado_tmp
                        },base_url+'Educacion/Registro/AjaxValidarNRT',function (response) {
                            bootbox.hideAll();
                            if(response.action=='1'){
                                if(response.rol_asignate=='Si'){
                                    location.href=base_url+'Registro?emp='+empleado_tmp+'&action=edit';
                                    $('input[name=tipo_registro]').prop('disabled',true);
                                }else{
                                    
                                    AjaxAlta(empleado_tmp);
                                }
                                
                            }else{
                                sighMsjError('EL N° DE REGISTRO INGRESADO NO EXISTE');
                                $('input[name=tipo_registro]').removeAttr('checked');
                            }
                        })
                    }else{
                        sighMsjError('INGRESAR N° DE REGISTRO');
                        $('input[name=tipo_registro]').removeAttr('checked');
                    }
                }else{
                    $('input[name=tipo_registro]').removeAttr('checked');
                }
            });
        }else{
            AbrirVista(base_url+'Educacion/Registro/BuscarEmpleado',700,500);
        }
    });
    function AjaxAlta(empleado_tmp) {
        sighMjsConfirm({
            title:'SiGH | ERROR',
            message:'<div class="col-md-12">'+
                        '<h5 class="line-height no-margin">LO SENTIMOS EL N° DE REGISTRO INGRESADO EXISTE, PERO AL USUARIO ACTUAL NO TIENE ASIGNADO NINGÚN ROL. POR FAVOR SELECCIONE UN ROL DE LA LISTA Y HAGA CLICK EN ACEPTAR PARA CONTINUAR</h5>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<div class="form-group m-t-10">'+
                            '<div class="input-group">'+
                                '<span class="input-group-addon no-margin sigh-background-primary">'+
                                    '<i class="fa fa-unlock"></i>'+
                                '</span>'+
                                '<select class="width100" name="rol_noasigando">'+
                                    '<option value="82">MÉDICO RESIDENTE</option>'+
                                    '<option value="85">MÉDICO INTERNO</option>'+
                                '</select>'+
                            '<div>'+
                        '</div>'+
                    '</div>',
            size:'medium'
        },function (cb) {
            var rol_noasigando=$('body select[name=rol_noasigando]').val();
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    empleado_id:empleado_tmp,
                    rol_id:rol_noasigando
                },base_url+'Educacion/Registro/AjaxAsignarRol',function (response) {
                    bootbox.hideAll();
                    location.href=base_url+'Registro?emp='+empleado_tmp+'&action=edit';
                    $('input[name=tipo_registro]').prop('disabled',true);
                });
            }
        })
    }
    if($('input[name=empleado_action]').val()=='edit'){
        if($('input[name=rol_id]').val()=='85'){
            $('.h-title').removeAttr('style');
            $('.col-start-preregistro').removeClass('col-md-8').addClass('col-md-12');
            $('.col-selec-rol').removeClass('col-md-12').addClass('col-md-6');
            $('.row-start').removeClass('hide');
            $('.row-medico-interno').removeClass('hide');
            $('.row-medico-residente').addClass('hide');
        }else if($('input[name=rol_id]').val()=='82'){
            $('.h-title').removeAttr('style');
            $('.col-start-preregistro').removeClass('col-md-8').addClass('col-md-12');
            $('.col-selec-rol').removeClass('col-md-12').addClass('col-md-6')
            $('.row-start').removeClass('hide');
            $('.row-medico-interno').addClass('hide');
            $('.row-medico-residente').removeClass('hide');
        }else{
            $('.row-start').addClass('hide');
        }
    }
    $('.cbx_especialidad').click(function () {
        var input=$(this).attr('data-input');
        if($(this).is(":checked")){
            //$('input[name='+input+']').removeAttr('readonly');
        }else{
            //$('input[name="'+input+'"]').prop('readonly',true).val("");
            
        }
    });
    $('#cbx_cambiar_roles').click(function () {
        if($(this).is(":checked")){
            $('#rol_id').removeAttr('disabled');
        }else{
            $('#rol_id').attr('disabled',true);
            
        }
    })
    $('.btn-open-add-doc').click(function (e) {
        e.preventDefault();
        AbrirVista(base_url+'Educacion/Registro/AgregarDocumentos?doc=0&a=add&tmp='+$('input[name=empleado_id]').val()+'&tipo='+$('input[name=rol_id]').val(),500,400);     
    })
    $('body .form-usuario-documentos').submit(function (e) {
        e.preventDefault();
        var form=new FormData($(this)[0]);
        sighMsjLoading();
        sighAjaxPostFiles(form,base_url+'Educacion/Registro/AjaxAgregarDocumentos',function (response) {
            window.top.close();
            window.opener.AjaxLoadDocumentos();
            bootbox.hideAll();
        })
    });
    $('body').on('click','.documentos_ignore',function (evt) {
        if($(this).is(':checked')){
            $('.upload-archivo').removeAttr('required');
        }else{
            $('.upload-archivo').attr('required',true);
        }
    });
    
    $('body select[name=eua_documentos_interno]').select2();
    $('body .btn-refresch').click(function (e) {
        sighMjsConfirm({
            title:'ACTUALIZAR PÁGINA',
            message:'<div class="col-md-12"><h5 class="line-height">AL ACTUALIZAR ESTAR PÁGINA SE PERDERAN TODOS LOS DATOS REGISTRADOS ¿ESTÁ SEGURO QUE QUIERE CONTINUAR?</h5></div>'
        },function (cb) {
            if(cb==true){
                location.reload();
            }
        });
    });
    $('input[name=directorio_cp]').blur(function (e){
        AjaxDir1($(this).val());
    });
    $('body input[name=directorio_cp2]').blur(function (e){
        AjaxDir2($(this).val());
    });
    $('input[name=directorio_cp]').keypress(function (evt){
        if(evt.which==13){
            evt.preventDefault();
            AjaxDir1($(this).val());
        }
    });
    $('body input[name=directorio_cp2]').keypress(function (evt){
        if(evt.which==13){
            evt.preventDefault();
            AjaxDir2($(this).val());
        }
    });
    function AjaxDir1(input) {
        if(input!=''){
            BuscarCodigoPostal({
                'cp':input,
                'input1':'directorio_municipio',
                'input2':'directorio_estado',
                'input3':'directorio_colonia'
            });
        }
    }
    function AjaxDir2(input) {
        if(input!=''){
            BuscarCodigoPostal({
                'cp':input,
                'input1':'directorio_municipio2',
                'input2':'directorio_estado2',
                'input3':'directorio_colonia2'
            });
        }
    }
    function BuscarCodigoPostal(input) {
        $.ajax({
                url: base_url+"Asistentesmedicas/BuscarCodigoPostal",
                type: 'POST',
                dataType: 'json',
                data:{
                    'cp':input.cp,
                },success: function (data, textStatus, jqXHR) {
                    $('input[name='+input.input1+']').val(data.result_cp.Municipio);
                    $('input[name='+input.input2+']').val(data.result_cp.Estado);
                    if(data.result_cp.Colonia.length>0){
                        var Colonia=data.result_cp.Colonia.split(';');
                        $('input[name='+input.input3+']').shieldAutoComplete({
                            dataSource: {
                                data: Colonia
                            },minLength: 1
                        });
                        $('input[name='+input.input3+']').removeClass('sui-input');
                    }
                },error: function (e) {
                    console.log(e);
                }
            });
    }
    //--------------------------------------------------------------------------
    $('input[name=input_obtener_n_registro]').click(function (evt) {
        if($(this).val()=='Nuevo'){
            $('.row-n-empleado-si').addClass('hide');
            $('.row-n-empleado-si-rs').addClass('hide');
            $('.row-n-empleado-no').removeClass('hide');
        }else{
            $('.row-n-empleado-si').removeClass('hide');
            $('.row-n-empleado-no').addClass('hide');
        }
    });
    $('.btn-n-empleado-si').on('click',function (evt) {
        evt.preventDefault();
        sighMsjLoading();
        sighAjaxPost({
            empleado_matricula:$('input[name=empleado_matricula]').val()
        },base_url+'Educacion/Registro/AjaxBuscarEmpleadoPorNumero',function (response) {
            bootbox.hideAll();
            $('.row-n-empleado-si-rs').removeClass('hide');
            $('.row-n-empleado-si-rs table tbody').html(response.tr);
        });
    });
    $('body').on('click','.btn-n-empleado-si-next',function (evt) {
        if(confirm("TENGA ENCUENTA QUE AL HACER CLICK EN CONTINUAR ESTA DE ACUERDO QUE NO TENIA NINGUNA INFORMACIÓN Y/O DOCUMENTO CAPTURADO O DE LO CONTRARIO SE ELIMINARÁ, SI TIENE ALGUNA DUDA ANTES DE CONTINUAR. PONGASE EN CONTACTO CON EL ADMINISTRADOR.")){
            $('.row-n-empleado-si-rs table input[name=empleado_id]:checked').each(function () {
                var input_radio=$(this);
                if(input_radio.length>0){
                    sighAjaxPost({
                        empleado_id:input_radio.val(),
                        empleado_matricula:$('input[name=empleado_matricula]').val()
                    },base_url+'Educacion/Registro/AjaxEliminarUsuariosExtras',function (response) {
                        ElegirRolUsuario(input_radio.val())
                    });
                }
            });
        }
    });
    function ElegirRolUsuario(empleado_id){
        sighMjsConfirm({
            title:'SELECCIONAR ROL',
            message:'<div class="col-xs-12">'+
                        '<select class="width100" name="rol_id">'+
                            '<option value="82">MÉDICO RESIDENTE</option>'+
                            '<option value="85">MÉDICO INTERNO</option>'+
                        '</select>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                var rol_id=$('body select[name=rol_id]').val();
                sighAjaxPost({
                    empleado_id:empleado_id,
                    rol_id:rol_id
                },base_url+'Educacion/Registro/AjaxAsignarRolUsuario',function () {
                    window.top.close();
                    window.opener.location.href=base_url+'Registro?emp='+empleado_id+'&action=edit';
                });
            }
        });
    }
    $('body').on('click','.btn-n-empleado-no-next',function (evt) {
        sighAjaxGet(base_url+'Educacion/Registro/AjaxNoNumEmpleado',function (response) {
            sighMjsConfirm({
                title:'N° DE REGISTRO',
                message:'<div class="col-xs-12">'+
                            '<h5 class="line-height text-justify">'+
                                '<span style="color:red"><b>NOTA:</b></span> SU N° DE REGISTRO ES <b>'+response.LastId+'</b> EN CASO DE QUE SU PRE REGISTRO QUEDE PENDIENTE PARA CONTINUAR DEBERA PROPORCIONAR ESTE N° PARA DARLE CONTINUIDAD'+
                             '</h5>'+
                        '</div>',
                size:'small'
            },function (cb) {
                if(cb==true){
                    ElegirRolUsuario(response.LastId)
                }
            }); 
        });
    });
});
    function AjaxLoadDocumentos() {
        sighAjaxPost({
            empleado_tmp:$('input[name=empleado_id]').val()
        },base_url+'Educacion/Registro/AjaxGetDocumentos',function (response) {
            $('body .table-doc-usuario tbody').html(response.tr);
            InicializeFootable('.table-doc-usuario tbody');
            $('.tip').tooltip();
        });
        
    }
