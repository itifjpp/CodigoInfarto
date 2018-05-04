jQuery(document).ready(function (e) {
    $('.agregar-curso').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+"Educacion/AjaxAgregarCurso",function (response) {
            msj_success_noti('REGISTRO GUARDADO');
            location.href=base_url+'Educacion/Cursos';
        });
    });
    if($('input[name=CursoID]').val()!=undefined){
        sighMsjLoading();
        AjaxUsuariosInCursos();
        
    }
    function AjaxUsuariosInCursos() {
        sighAjaxPost({
            CursoID:$('input[name=CursoID]').val()
        },base_url+'Educacion/AjaxUsuariosInCursos',function (response) {
            $('.table-users-in-cursos tbody').html(response.tr);
            bootbox.hideAll();
            InicializeFootable('.table-users-in-cursos');
            $('.tip').tooltip();
            sighMessenger({
                msj:response.InCursos+' USUARIOS EN ESTE CURSO.',
                position:'right bottom',
                type:'success'
            });
        })
    }
    
    $('.createEventCalendar').submit(function (e) {
        
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Educacion/Calendario/AjaxEvent',function (response) {
            location.href=base_url+'Educacion/Calendario/Events?calendar='+$('input[name=calendar_id]').val();
        })
    })
    $('.createCalendar').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Educacion/Calendario/AjaxCalendar',function (response) {
            bootbox.hideAll();
            location.href=base_url+'Educacion/Calendario'
        });
    });
    $('body').on('click','.event-google-delete',function (e) {
        e.preventDefault();
        var event_id=$(this).attr('data-id');
        if(confirm("¿DESEA ELIMINAR ESTE EVENTO?")){
            sighMsjLoading();
            sighAjaxPost({
                event_id:event_id
            },base_url+'Educacion/Calendario/AjaxDeleteEvent',function () {
                bootbox.hideAll();
                sighMsjOk('EL EVENTO PUEDE TARDAR UNOS CUANTOS MINUTOS EN SER ELIMINADO DE LA LISTA Y DEL CALENDARIO...');
            });
        }
    });
    $('input[name=empleado_matricula]').focus();
    setTimeout(function () {
        $('body input[name=empleado_matricula]').focus();
    },1000);
    
    $('body').on('keypress','input[name=empleado_matricula]',function (evt) {
        var input=$(this);
        
        var input_matricula=$('body input[name=empleado_matricula]').val();
        var curso_id=$('body input[name=CursoID]').val();
        
        if(evt.which==13){
            if(input_matricula!=''){
                var input_matricula_quit="";
                if($('select[name=typeScan]').val()=='ESCANEO NORMAL'){
                    input_matricula_quit=input_matricula;
                }else{
                    input_matricula_quit=input_matricula.substr(5);;
                }
                sighAjaxPost({
                    curso_id:curso_id,
                    empleado_matricula:input_matricula_quit
                },base_url+'Educacion/AjaxCursoUsuario',function (response) {
                    if(response.action==1){
                        sighMessenger({
                            msj:'USUARIO AGREGADO AL CURSO',
                            position:'right bottom',
                            type:'success'
                        });
                        AjaxUsuariosInCursos();
                    }if(response.action==2){
                        sighMessenger({
                            msj:'EN N° INGRESADO NO EXISTE',
                            position:'right bottom',
                            type:'error'
                        });
                        $('body input[name=empleado_matricula]').focus();
                    }if(response.action==3){
                        sighMessenger({
                            msj:'EN N° DEL USUARIO INGRESADO YA ESTA ASOCIADO A ESTE CURSO',
                            position:'right bottom',
                            type:'error'
                        })
                        $('body input[name=empleado_matricula]').focus();
                    }
                });
            }else{
                sighMsjError('INGRESAR N° DE EMPLEADO');
                setTimeout(function () {
                    bootbox.hideAll();
                    $('body input[name=empleado_matricula]').focus();
                },2000);
            }   
            input.val('');
        }
    });
    $('body').on('click','.elimiar-curso-usuario',function () {
        var ce_id=$(this).attr('data-id');
        sighAjaxPost({
            ce_id:ce_id
        },base_url+"Educacion/AjaxEliminarUsuarioCurso",function (response) {
            msj_success_noti('REGISTRO ELIMINADO');
            AjaxUsuariosInCursos();
        })
    });
    /*UNIDAD ACADÉMICA*/
    $('.ua-agregar').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Educacion/Ua/AjaxAgregar',function (response) {
            location.href=base_url+'Educacion/Ua';
        });
    });
    $('body').on('click','.ua-eliminar',function () {
        var ua_id=$(this).attr('data-id');
        if(confirm("¿DESEA ELIMINAR ESTA UNIDAD ACADÉMICA Y TODOS LOS DATOS ASOCIADOS A ELLO?")){
            sighMsjLoading();
            sighAjaxPost({
                ua_id:ua_id,
            },base_url+'Educacion/Ua/AjaxEliminarUa',function (response) {
                bootbox.hideAll();
                location.reload();
            });
        }
        
    })
    $('.ua-carrera-agregar').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Educacion/Ua/AjaxAgregarCarrera',function (response) {
            window.opener.location.reload();
            window.top.close();
        });
    });
    $('body').on('click','.ua-carrera-eliminar',function () {
        var carrera_id=$(this).attr('data-id');
        sighMsjLoading();
        sighAjaxPost({
            carrera_id:carrera_id,
        },base_url+'Educacion/Ua/EjaxEliminarCarrera',function (response) {
            bootbox.hideAll();
            location.reload();
        });
    });
    $('input[name=empleado_num_emp]').keypress(function (evt) {
        var empleado_matricula=$(this).val();
        var input=$(this);
        var credencial_tipo=$('select[name=credencial_tipo]').val();
       if(evt.which==13){
            sighAjaxPost({
                empleado_matricula:empleado_matricula,
                credencial_tipo:credencial_tipo
            },base_url+'Educacion/AjaxCredencializacion',function (response) {
               if(response.action==1){
                   msj_success_noti("Registro de impresión registrado");
               }else if(response.action==2){
                    msj_error_noti("El n° de empleado no existe");
               }else if(response.action==3){
                    msj_error_noti("Este usuario ya fue registrado");
               }
            });
            input.val("");
       }
    });
    
})