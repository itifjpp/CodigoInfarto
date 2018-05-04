$(document).ready(function (){
    document.title='SiGH | Iniciar Sesión';
    if($('input[name=PrimerUso]').val()!=undefined){
        
    }
    $('.btn-no-login').click(function (){
        $('.row-login').removeClass('hide');
        $('.row-no-login').addClass('hide');
    })
    var show_hide_pass=0;
    $('.show-hide-matricula').click(function (){
        show_hide_pass=show_hide_pass+1;
        if(show_hide_pass==1){
            $('input[name=empleado_matricula]').attr('type','text');
            $(this).removeClass('fa-unlock').addClass('fa-unlock-alt');
        }else{
            $('input[name=empleado_matricula]').attr('type','password');
            $(this).addClass('fa-unlock').removeClass('fa-unlock-alt');
            show_hide_pass=0;
        }
    })
    $('.tip').tooltip();
    let info_login=[];
    $('.login-form').submit(function (e){
        var el=$(this);
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost({
            empleado_area:$('#empleado_area').val(),
            empleado_matricula:$('input[name=empleado_matricula]').val()
        },base_url+"sections/login/loginV2",function (response) {
            bootbox.hideAll();
            switch (response.ACCESS_LOGIN){
                
                    case 'AREA_NO_ENCONTRADA':
                        msj_error_noti('EL AREA ESCRITA NO EXISTE');
                        break;
                    case 'MATRICULA_NO_ENCONTRADA':
                        sighMsjError('EL N° DE EMPLEADO NO EXISTE','small','Si');
                        //msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                        break;
                    case 'AREA_NO_ROL':
                        sighMsjError('NO TIENE PERMISOS PARA INGRESAR A ESTA ÁREA','small','Si');
                        break;
                    case 'ACCESS':
                        location.href=base_url+'inicio';
                        break;  
                    case 'ACCESS_SC':
                        info_login=response;
                        SolicitarPassword()
                        break;
                }
        });
    });
    $('.row-login-autorizate').submit(function (e) {
        e.preventDefault();
        msj_success_noti('VALIDANDO USUARIO...');
        sighAjaxPost($(this).serialize(),base_url+'Sections/Login/AjaxValidarAcceso',function (response) {
            bootbox.hideAll();
            if(response.action=='1'){
                sighMjsConfirm({
                    title:'SELECCIONAR HOSPITAL',
                    message:'<div class="col-md-12"><select name="hospital_id" class="width100">'+response.option+'</select><div>'
                },function (cb) {
                    if(cb==true){
                        sighAjaxPost({
                            equipo_ip:$('input[name=equipo_ip]').val(),
                            equipo_descripcion:'SIN ESPECIFICAR',
                            equipo_accion:'add',
                            hospital_id:$('body select[name=hospital_id]').val()
                        },base_url+'Sections/Hospitales/AjaxEquipos',function (response) {
                            location.reload();
                        })
                    }
                });
                $('body .modal-header h5').removeClass('color-white');
                $('body .modal-footer .sigh-background-secundary').addClass('btn-success');
            }else{
                 msj_error_noti('EL ID DE USUARIO Y/O LA MATRICULA NO SON VALIDOS');
            }
        })
    })
    function SolicitarPassword() {
        let info=info_login;
        bootbox.dialog({
            title:'<h5 class="no-margin color-white text-left">INGRESAR CONTRASEÑA</h5>',
            message:'<div class="row">'+
                        '<div class="col-xs-4" style="padding-right:4px">'+
                            '<img src="'+base_url+'assets/img/perfiles/'+info.perfil+'" style="width:75px;height:75px;border-radius:5px">'+
                        '</div>'+
                        '<div class="col-xs-8" style="padding-left:0px">'+
                            '<h6 class="no-margin line-height"><b>'+info.nombre+'</b> INGRESA TU CONTRASEÑA PARA CONTINUAR</h6>'+
                            '<div class="input-group transparent">'+
                                '<span class="input-group-addon">'+
                                    '<i class="fa fa-unlock-alt"></i>'+
                                '</span>'+
                                '<input type="password" id="empleado_password" class="form-control" placeholder="Ingresar Contraseña">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-xs-12 text-center msj-loading hide" style="margin-top:10px"><i class="fa fa-spinner fa-pulse fa-2x" style="color:#F44336"> </i></div>'+
                    '</div>',
            size:'small'
        });
        $('body #empleado_password').focus();
        var y = window.top.outerHeight / 4 ;
        $('.modal-dialog').css({
            'margin-top':y+'px'
        })
    }
    $(document).on('keypress','#empleado_password',function (e) {
        var empleado_password=$(this).val();
        if(e.which==13 && empleado_password!=''){
            console.log(info_login);
            $('body .msj-loading').removeClass('hide');
            SendAjaxPost({
                empleado_matricula: $('input[name=empleado_matricula]').val(),
                empleado_password:  $('body #empleado_password').val(),
                empleado_area:      $('body #empleado_area').val(),
            },'Sections/Login/AjaxSolicitarPassword',function (response) {
                $('body .msj-loading').addClass('hide');
                if(response.accion=='1'){
                    location.href=base_url+'inicio';
                }else{
                    SolicitarPassword();
                    msj_error_noti('CONTRASEÑA INCORRECTA');
                }
            },'No')
        }
    })
    $('.form-PrimerUso').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Login/AjaxPrimerUso',function (response) {
            $('.form-PrimerUso').addClass('hide');
            $('.col-finish').removeClass('hide');
        });
    });
});