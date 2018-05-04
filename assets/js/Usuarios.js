$(document).ready(function() {
    $('select[name=empleado_sexo]').val($('select[name=empleado_sexo]').attr('data-value'));
    $('select[name=empleado_estado]').val($('select[name=empleado_estado]').attr('data-value'));
    $('select[name=empleado_turno]').val($('select[name=empleado_turno]').attr('data-value'));
    $('select[name=empleado_servicio]').val($('select[name=empleado_servicio]').attr('data-value'));
    $('select[name=empleado_categoria]').val($('select[name=empleado_categoria]').attr('data-value'));
    if($('input[name=empleado_pi]').attr('data-value')=='SI'){
        $('input[name=empleado_pi][value="SI"]').attr('checked',true);
    }
    $('select[name=hospital_id]').select2();
    $('select[name=hospital_id]').val($('select[name=hospital_id]').attr('data-value')).select2();
    if($('input[name=empleado_action]').val()!=undefined){
        if($('select[name=rol_id_edu]').attr('data-value')=='82' || $('select[name=rol_id_edu]').attr('data-value')=='85'){

        }else{
            $('#rol_id').val($('#rol_id').attr('data-value').split(',')).select2();
        }
    }
    if($('input[name=empleado_departamento]').val()!=undefined){
        $('#empleado_estado').val($('#empleado_estado').attr('data-value')).select2();
        $('#empleado_sexo').val($('#empleado_sexo').attr('data-value')).select2();
    }
    $('.form-add-users').submit(function (e){
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Usuarios/AjaxGuardarUsuario',function (response) {
            bootbox.hideAll();
            //console.log(response);
            location.href=base_url+'Sections/Usuarios';
        });
    });
    $('.users-agregar-edu').submit(function (e){
        var formData=$(this).serialize();
        e.preventDefault();
        if($('input[name=empleado_status]').val()=='Pre-registro'){
            sighMjsConfirm({
                title:'VALIDAR INFORMACIÓN',
                message:'<div class="col-md-12">'+
                            '<h4 class="no-margin line-height"><b>NOMBRE:</b> '+$('input[name=empleado_nombre]').val()+' '+$('input[name=empleado_ap]').val()+' '+$('input[name=empleado_am]').val()+'</h4>'+
                            '<h4 class="no-margin line-height"><b>MATRICULA:</b> '+$('input[name=empleado_matricula]').val()+'</h4>'+
                            '<h4 class="no-margin line-height"><b>FECHA DE REGISTRO:</b> '+$('input[name=empleado_registro]').val()+'</h4>'+
                        '</div>',
                size:'medium'
            },function (cb) {
                if(cb==true){
                    sighMsjLoading();
                    sighAjaxPost(formData,base_url+'Sections/Usuarios/AjaxGuardarUsuarioEdu',function (response) {
                        bootbox.hideAll();
                        location.href=base_url+'Sections/Usuarios';
                    });     
                }
            })
        }else{
            sighMsjLoading();
            sighAjaxPost(formData,base_url+'Sections/Usuarios/AjaxGuardarUsuarioEdu',function (response) {
                bootbox.hideAll();
                location.href=base_url+'Sections/Usuarios';
            });  
        }
    });
    $('body').on('click','.user-alumno-folder',function () {
        var empleado_id=$(this).attr('data-id');
        AbrirVista(base_url+'Sections/Usuarios/CarpetadeDocumentos?emp='+empleado_id,600,500);
    });
    $('body').on('click','.user-alumno-delete',function (e) {
        var empleado_id=$(this).attr('data-id');
        e.preventDefault();
        sighMjsConfirm({
            title:'ELIMINAR USUARIO',
            message:'<div class="col-md-12"><h5 class="no-margin line-height">¿ESTA SEGURO QUE DESEA ELIMINAR ESTE USUARIO Y TODOS LOS DATOS ASOCIADOS A ESTE?</h5></div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    empleado_id:empleado_id
                },base_url+'Sections/Usuarios/EliminarUsuario',function (response) {
                    bootbox.hideAll();
                    sighMsjOk('USUARIO ELIMINADO CORRECTAMENTE.');
                    setTimeout(function () {
                        location.reload();
                    },1000)
                })
            }
        });
    });
    $('select[name=rol_id_edu]').change(function () {
        if($(this).val()=='85'){
            $('.row-medico-interno').removeClass('hide');
            $('.row-medico-residente').addClass('hide');
        }else{
            $('.row-medico-interno').addClass('hide');
            $('.row-medico-residente').removeClass('hide');
        }    
    })
    $('.cbx_especialidad').click(function () {
        var input=$(this).attr('data-input');
        if($(this).is(":checked")){
            $('input[name='+input+']').removeAttr('readonly');
        }else{
            $('input[name="'+input+'"]').prop('readonly',true).val("");
            
        }
    });
    $('#cbx_cambiar_roles').click(function () {
        if($(this).is(":checked")){
            $('#rol_id').removeAttr('disabled');
        }else{
            $('#rol_id').attr('disabled',true);
            
        }
    })
    $('select[name=rol_id_edu]').val($('select[name=rol_id_edu]').attr('data-value')).select2();
    if($('select[name=rol_id_edu]').val()=='85'){
        
        $('.row-medico-interno').removeClass('hide');
        $('.row-medico-residente').addClass('hide');
    }else{
        $('.row-medico-interno').addClass('hide');
        $('.row-medico-residente').removeClass('hide');
    }

    $('select[name=empleado_estadocivil]').val($('select[name=empleado_estadocivil]').attr('data-value'));
    $('select[name=ropa_tipo]').val($('select[name=ropa_tipo]').attr('data-value'));
    $('select[name=eua_examen_ingles]').val($('select[name=eua_examen_ingles]').attr('data-value'));

    if($('input[name=especialidad_r1]').val()!=''){
        $('input[name=especialidad_r1]').removeAttr('readonly');
        $('#cbx_r1').attr('checked',true);
    }
    if($('input[name=especialidad_r2]').val()!=''){
        $('input[name=especialidad_r2]').removeAttr('readonly');
        $('#cbx_r2').attr('checked',true);
    }
    if($('input[name=especialidad_r3]').val()!=''){
        $('input[name=especialidad_r3]').removeAttr('readonly');
        $('#cbx_r3').attr('checked',true);
    }
    if($('input[name=especialidad_r4]').val()!=''){
        $('input[name=especialidad_r4]').removeAttr('readonly');
        $('#cbx_r4').attr('checked',true);
    }
    if($('input[name=especialidad_r5]').val()!=''){
        $('input[name=especialidad_r5]').removeAttr('readonly');
        $('#cbx_r5').attr('checked',true);
    }
    if($('input[name=empleado_action]').val()=='edit'){
        //$('input[name=empleado_matricula]').attr('disabled',true);
    }
    $('input[name=cbx_autoasignar_matricula]').click(function (evt) {
        if($(this).is(':checked')){
            $('input[name=empleado_matricula]').attr('readonly',true).removeAttr('required');
        }else{
            $('input[name=empleado_matricula]').removeAttr('readonly').attr('required',true);
        }
    });
    $('select[name=empleado_tipoplaza]').val($('select[name=empleado_tipoplaza]').attr('data-value'))
    $('input[name=empleado_matricula]').blur(function (e){
        if($(this).val()!='' && $('input[name=empleado_action]').val()=='add'){
            sighAjaxPost({
                'empleado_matricula':$(this).val()
            },base_url+"Sections/Usuarios/VerificarMatricula",function (response) {
                if(response.ACCION=='EXISTE'){
                    msj_error_noti('LA MATRICULA ESCRITA YA ESTA ASIGNADA A OTRO USUARIO')
                    $('button[type=submit]').attr('disabled',true);
                }if(response.ACCION=='NO_EXISTE'){
                    msj_success_noti('MATRICULA DISPONIBLE')
                    $('button[type=submit]').removeAttr('disabled');
                }
            })
        }
    })
    if($('select[name=FILTRO_TIPO]').val()!=undefined){
        ObtenerUsuario();
    }
    $('.input-buscar').click(function () {
        if($('select[name=FILTRO_TIPO]').val()!=''){
            ObtenerUsuario()
        }
    })
    function ObtenerUsuario() {
        sighMsjLoading();
        sighAjaxPost({
            FILTRO_TIPO:$('select[name=FILTRO_TIPO]').val(),
            FILTRO_VALUE:$('input[name=FILTRO_VALUE]').val(),
        },base_url+"Sections/Usuarios/"+$('input[name=AjaxLoadUserRol]').val(),function (response) {
            bootbox.hideAll();
            $('.table-usuarios tbody').html(response.tr);
            $('body .tip').tooltip();
            msj_success_noti(response.total_users+' USUARIOS REGISTRADOS');
            InicializeFootable('.table-usuarios');
        });
    }
    $('.guardar-info-perfil').submit(function (e) {
        e.preventDefault();
        if($('input[name=empleado_password]').val()==$('input[name=empleado_password_c]').val()){
            sighMsjLoading();
            sighAjaxPost($(this).serialize(),base_url+"Sections/Usuarios/AjaxMiPerfil",function() {
                bootbox.hideAll();
                setTimeout(function () {
                    location.reload();
                },2000);
            });
        }else{
            sighMsjError('LAS CONTRASEÑAS ESCRITAS NO COINCIDEN');
        }
    })
    $('.btn-cambiar-perfil').click(function (e) {
        AbrirDocumento(base_url+'Sections/Usuarios/CambiarPerfil');
    })
    $('input[name=empleado_sc]').click(function (e) {
        if($(this).is(':checked')==true){
            $('.empleado_sc').removeClass('hide');
            $('input[name=empleado_password]').attr('required',true);
        }else{
            $('input[name=empleado_password]').removeAttr('required').val('');
            $('input[name=empleado_password_c]').val('');
            $('.empleado_sc').addClass('hide');
        }
    })
    if($('input[name=empleado_sc]').attr('data-value')=='Si'){
        $('.empleado_sc').removeClass('hide');
        $('input[name=empleado_sc]').click();
    }
    $('input[name=show_hide_password]').click(function (e) {
        if($(this).is(':checked')){
            $('input[name=empleado_password]').attr('type','text');
            $('input[name=empleado_password_c]').attr('type','text');
        }else{
            $('input[name=empleado_password]').attr('type','password');
            $('input[name=empleado_password_c]').attr('type','password');
        }
    });
//    $('body input[name=empleado_id]').keyup(function (e) {
//        var input=$(this);
//        var empleado_matricula=$(this).val();
//        if(e.which==13 && empleado_matricula!==''){
//            SendAjaxPost({
//                empleado_matricula:empleado_matricula,
//            },'Sections/Usuarios/AjaxGetEmpleado',function (response) {
//                if(response.accion=='1'){
//                    location.href=base_url+'Sections/Usuarios/RopaQuirurgicaUsuario?em='+response.empleado;
//                }else{
//                    msj_error_noti("LA MATRICULA DEL USUARIO ESCANEADO NO EXISTE")
//                }
//            });
//            input.val("");
//        }
//    });
    if($('input[name=empleado_perfil]').val()!=''){
        $('body .html5imageupload').css({
            'background-image': 'url("'+base_url+'/assets/img/perfiles/'+$('input[name=empleado_perfil]').val()+'"',
            'background-size':'cover',
            'background-position':'center'
        })
    }
    $('body .btn-rq-accion').click(function (e) {
        e.preventDefault();
        var empleado_id=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        var hospital_id=$(this).attr('data-hospital');
        SendAjaxPost({
            empleado_id:empleado_id,
            hospital_id:hospital_id,
            accion:accion,
        },'Sections/Usuarios/AjaxRopaQuirurgicaUsuario',function (response) {
            location.href=base_url+'RopaQuirurgica';
        });
    });
    /*OBTENER UNIDADES ACADÉMICAS*/
    $('select[name=carrera_id],select[name=ua_id]').select2();
    
    $('select[name=ua_id]').change(function (e) {
        var ua_id=$(this).val();
        sighAjaxPost({
            ua_id:ua_id
        },base_url+'Educacion/Ua/AjaxGetUaCarreras',function (response) {
            $('select[name=carrera_id]').html(response.option).select();
        });
    });
    $('.btn-open-add-doc').click(function (e) {
        e.preventDefault();
        AbrirVista(base_url+'Educacion/Registro/AgregarDocumentos?doc=0&a=add&tmp='+$('input[name=empleado_id]').val()+'&tipo='+$('select[name=rol_id_edu]').val(),500,400)
    })
    $('body .form-usuario-documentos').submit(function (e) {
        e.preventDefault();
        var form=new FormData($(this)[0]);
        sighMsjLoading();
        sighAjaxPostFiles(form,base_url+'Educacion/Registro/AjaxAgregarDocumentos',function (response) {
            window.top.close();
            window.opener.AjaxLoadDocumentos();
            bootbox.hideAll();
        });
    });
    $('body').on('click','.empleado-aut-credencial',function (evt) {
        evt.preventDefault();
        var empleado_id=$(this).attr('data-id');
        sighMjsConfirm({
            title:'SOLICITAR AUTORIZACIÓN',
            message:'<div class="col-md-12">'+
                        '<h5 class="no-margin line-height">¿AUTORIZAR IMPRESIÓN DE CREDENCIAL DE ESTE USUARIO?</h5>'+
                    '</div>',
            size:'small',
        },function (cb) {
            if(cb==true){
                sighMsjLoading('Autorizando impresión...');
                sighAjaxPost({
                    empleado_id:empleado_id
                },base_url+'Sections/Usuarios/AjaxAutorizacionCredencial',function () {
                    location.reload();
                });
            }
        })
    })
    if($('input[name=empleado_alumno]')!=undefined){
        AjaxLoadDocumentos();
    }
    $('body').on('click','.preregistro-documento-eliminar',function(evt){
        var documento_id=$(this).attr('data-id');
        if(confirm('ELIMINAR DOCUMENTOS?')){
            sighAjaxPost({
                documento_id:documento_id
            },base_url+'Educacion/Registro/AjaxEliminarDocumento',function (response) {
                AjaxLoadDocumentos();
            });
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
    
    $('body').on('click','.link-image-crop',function (evt) {
        sighMjsConfirm({
            title:'SUBIR FOTO DE PERFIL',
            message:'<div class="col-md-12">'+
                        '<div class="center-content">'+
                            '<div id="retrievingfilename" class="html5imageupload" data-width="640" data-height="480" data-url="'+base_url+'config/uploadImageTmp?tipo=img/perfiles" style="width: 640px;height: 480px">'+
                                '<input type="file" name="thumb" style="height: 200px!important">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            size:'large'
        },function (cb) {
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    empleado_id:$('input[name=empleado_id]').val(),
                    empleado_perfil:$('#filename').val()
                },base_url+'Sections/Usuarios/AjaxImageProfile',function (response) {
                    bootbox.hideAll();
                    location.reload();
                })

            }
        });
        $('body #retrievingfilename').html5imageupload({
            onAfterProcessImage: function() {
                $('body #filename').val($(this.element).data('name'));
            },
            onAfterCancel: function() {
                $('body #filename').val('');
            }
        });
    });
    /*CÓDIGO POSTAL*/
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
    $('body textarea[name=ip_descripcion]').wysihtml5();
    $('.form-add-users-ip').submit(function (evt) {
        evt.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Usuarios/AjaxPrivateInformation',function (response) {
            sighMessenger({
                msj:'INFORMACIÓN GUARDADA',
                type:'success',
                position:'let bottom'
            });
        });
    });
    $('body').on('click','.btn-pi-add-anexo',function (evt) {
        evt.preventDefault();
        var empleado_id=$(this).attr('data-id');
        sighMjsConfirm({
            title:'AGREGAR UN ANEXO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<input type="text" class="form-control" name="anexo_titulo" placeholder="Agregar un título">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<input type="file" class="form-control" name="anexo_archivo">'+
                        '</div>'+
                    '</div>',
        },function (cb) {
            if(cb==true){
                var anexo_titulo=$('body input[name=anexo_titulo]').val();
                var anexo_archivo=$('body input[name=anexo_archivo]').val();
                if(anexo_archivo!='' && anexo_titulo!=''){
                    var formData=new FormData();
                    formData.append( 'anexo_archivo', $('body input[name=anexo_archivo]')[0].files[0] );
                    formData.append( 'anexo_titulo', anexo_titulo );
                    formData.append( 'empleado_id', empleado_id );
                    sighAjaxPostFiles(formData,base_url+'Sections/Usuarios/AjaxPiAnexo',function (response) {
                        msj_success_noti('ANEXO AGREGADO CORRECTAMENTE');
                        AjaxAnexosPi();
                    });
                }else{
                    sighMessenger({
                        msj:'CAMPOS REQUERIDOS',
                        type:'error',
                        position:'right bottom'
                    });
                }
            }
        });
    });
    if($('input[name=empelado_anexo_pi]').val()!=undefined){
        AjaxAnexosPi();
    }
    function AjaxAnexosPi() {
        sighAjaxPost({
            empleado_id:$('body input[name=empleado_id]').val(),
        },base_url+'Sections/Usuarios/AjaxGetPiAnexo',function (response) {
            $('body .row-anexos-pi').html(response.cols);
            $('.tip').tooltip();
        });
    }
    $('body').on('click','.remove-anexo-pi',function (evt) {
        var anexo_id=$(this).attr('data-id');
        var anexo_archivo=$(this).attr('data-archivo');
        sighAjaxPost({
            anexo_id:anexo_id,
            anexo_archivo:anexo_archivo,
        },base_url+'Sections/Usuarios/AjaxEliminarAnexoPi',function (response) {
            AjaxAnexosPi();
        })
    });
    $('body').on('click','.user-alumno-baja',function (evt) {
        var empleado_id=$(this).attr('data-id');
        if(confirm("¿DESEA DAR DE BAJA ESTE USUARIO?")){
            sighAjaxPost({
                empleado_id:empleado_id
            },base_url+'Sections/Usuarios/AjaxBajaUsuario',function (response) {
                msj_success_noti("USUARIO DADO DE BAJA CORRECTAMENTE.");
                ObtenerUsuario();
            });
        }
    });
    $('body').on('click','.link-asociar-registro-user',function (evt) {
        evt.preventDefault();
        var empleado_id=$(this).attr('data-id');
        var action_tipo=$(this).attr('data-tipo');
        sighMjsConfirm({
            title:'ASOCIAR REGISTRO',
            message:'<div class="col-md-12">'+
                        '<h5 class="no-margin line-height text-justify">ES POSIBLE QUE NO EXISTA ESTE TIPO DE INFORMACIÓN ASOCIADA A ESTE USUARIO Y ESO PUEDE SER CAUSA DE QUE LA INFORMACIÓN NO SE MUESTRE. ¿DESEA ASOCIAR ESTA INFORMACIÓN A ESTE USUARIO?</h5>'+
                    '</div>',
            size:'small'
        },function (cb) {
            if(cb==true){
                sighMsjLoading();
                sighAjaxPost({
                    empleado_id:empleado_id,
                    action_tipo:action_tipo,
                },base_url+'Sections/Usuarios/AjaxAsociarRegistros',function (response) {
                    msj_success_noti("Información Asociado Correctamente");
                    location.reload();
                });
            }
        })
    })
});
    function AjaxLoadDocumentos() {
        sighAjaxPost({
            empleado_tmp:$('input[name=empleado_id]').val()
        },base_url+'Educacion/Registro/AjaxGetDocumentos',function (response) {
            $('body .table-doc-usuario tbody').html(response.tr);
            InicializeFootable('.table-doc-usuario tbody');
            $('.tip').tooltip();
        })
    }