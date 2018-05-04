$('body .select2').select2();
$('body .tip').tooltip();
var sighMsjInformation=function (info){
    let box=bootbox.dialog({
        title: '<h5 class="color-white no-margin text-left">'+info.title+'</h5>',
        message:'<div class="row ">'+info.message+'</div>',
        size:info.size,
        buttons:{
            accept:{
                label:'Aceptar',
                className:'btn-success'
            }
        },onEscape : function() {}
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
    return  box;
};
var sighMsjLoading=function (msj='Esto puede tadar un momento...'){
    let box=bootbox.dialog({
        title: '<h5 class="color-white no-margin text-left">Espere por favor...</h5>',
        message:'<div class="row ">'+
                    '<div class="col-sm-12">'+
                        '<h6 class="text-center" style="line-height:2"><i class="fa fa-spinner fa-pulse fa-5x sigh-color" ></i></h6>'+
                        '<h6 class="text-center no-margin sigh-color" style="line-height:2; ">'+msj+'</h6>'+
                    '</div>'+
                '</div>',
        size:'small'
        ,onEscape : function() {}
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
    return  box;
};
var sighMsjError=function (msj='LO SENTIMOS A OCURRIDO UN ERROR AL PROCESAR LA PETICIÓN. VUELVA A INTENTARLO',size='small'){
   let box= bootbox.dialog({
        title: '<h5 class="color-white no-margin text-left">SiGH - ERROR</h5>',
        message:'<div class="row ">'+
                    '<div class="col-sm-12" style=";margin-top:-10px">'+
                        '<h6 class="text-center no-margin" style="color:#F44336;"><i class="material-icons i-medium">error_outline</i></h6>'+
                        '<h6 class="text-center no-margin" style="line-height:1.4;margin-top:-10px;color:#F44336">'+msj+'</h6>'+
                    '</div>'+
                '</div>',
        size:size
        ,onEscape : function() {}
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
    return box;
};
var sighMsjOk=function (msj='OPERACIÓN REALIZADA CORRECTAMENTE'){
   let box=bootbox.dialog({
        title: '<h5 class="color-white no-margin text-left semi-bold">SiGH</h5>',
        message:'<div class="row ">'+
                    '<div class="col-sm-12" style=";margin-top:-10px">'+
                        '<h6 class="text-center m-t-5 m-b-10"><i class="fa fa-check-square-o fa-4x" style="color:#099A8C"></i></h6>'+
                        '<h6 class="text-center no-margin line-height">'+msj+'</h6>'+
                    '</div>'+
                '</div>',
        size:'small',
        closeButton:true,
        onEscape : function() {}
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
    return box;
};
var sighMjsConfirm=function (info,result) {
    let box= bootbox.confirm({
        title:'<h5 class="no-margin color-white text-left semi-bold">'+info.title+'</h5>',
        message:'<div class="row" style="margin-top: 0px;">'+info.message+'</div>',
        buttons:{
            cancel:{
                label:info.lb_cancel==undefined ? 'Cancelar' : info.lb_cancel,
                className:'sigh-background-secundary'
            },confirm:{
                label:info.lb_accept==undefined ? 'Aceptar' : info.lb_accept,
                className:'btn-danger'
            }
        },
        size:info.size,
        callback:result
    });

    var y = window.top.outerHeight / 6 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
    return box;
}
var sighAjaxGet=function (Url,Response) {
    $.ajax({
        url: Url,
        dataType: 'json',
        beforeSend: function (xhr) {  
        },success: function (result, textStatus, jqXHR) {
            Response(result);
        },error: function (e) {
            console.log(e);
                sighMsjError(e,',large');
            
            
        }
    });
}
var sighAjaxGetv2=function (Url,Response,cbError) {
    $.ajax({
        url: Url,
        dataType: 'json',
        beforeSend: function (xhr) {  
        },success: function (result, textStatus, jqXHR) {
            Response(result);
        },error: function (e) {
            if(cbError!=undefined){
                cbError(e);
            }else{
                console.log(e);
                sighMsjError(e,',large');
            }
            
            
        }
    });
}
var sighAjaxPost=function (Data,Url,Response) {
    $.ajax({
        url:Url,
        dataType: 'json',
        type: 'POST',
        data:Data,
        beforeSend: function (xhr) {},
        success: function (result, textStatus, jqXHR) {
            Response(result);
        },error: function (e) {
            sighMsjError(e.responseText,'large');
            console.log(e)
        }
        
    });
}
var sighAjaxPostFiles=function (Data,Url,Response) {
    $.ajax({
        url:Url,
        dataType: 'json',
        type: 'POST',
        data:Data,
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {},
        success: function (result, textStatus, jqXHR) {
            Response(result);
        },error: function (e) {
            sighMsjError(e.responseText,'large');
            console.log(e)
        }
        
    });
}
$(document).on('click','.profile-cambiar-area',function (e) {
    e.preventDefault();
    sighMsjLoading();
    sighAjaxGet(base_url+'Sections/Login/getAreas',function (response) {
        bootbox.hideAll();
        sighMjsConfirm({
            title:'CAMBIAR ÁREA DE ACCESO',
            message:'<div class="col-md-12"><select class="select2 width100" id="area_acceso_id" name="area_acceso_id">'+response.option+'</select></div>',
            size:'small'
        },function (res) {
            if(res==true){
                let area_acceso_id=$('body #area_acceso_id').val();
                if(area_acceso_id!=''){
                    sighAjaxPost({
                        areas_acceso_id:area_acceso_id
                    },base_url+'Sections/Login/AjaxCambiarArea',function (response) {
                        if(response.ACCESS_LOGIN=='ACCESS'){
                            location.href=base_url+'Inicio'
                        }else{
                            sighMsjError('NO TIENE PERMISOS PARA INGRESAR A ESTA ÁREA','small','Si');
                        }
                    })
                }else{
                    sighMsjError('SELECCIONAR EL NOMBRE DEL ÁREA DE ACCESO A LA QUE SE DESEA CAMBIAR','small')
                }
            }
        });
    });
})
$('.clockpicker-bottom').clockpicker({
    placement: 'bottom',
    autoclose: true
});
$('.clockpicker-top').clockpicker({
    placement: 'top',
    autoclose: true
});
var sighMessenger=function (data) {
    var extraClasses='';
    if(data.position=='right top'){
        extraClasses='messenger-fixed messenger-on-top messenger-on-right';
    }if(data.position=='right bottom'){
        extraClasses='messenger-fixed messenger-on-bottom messenger-on-right';
    }if(data.position=='left top'){
        extraClasses='messenger-fixed messenger-on-top messenger-on-left';
    }if(data.position=='let bottom'){
        extraClasses='messenger-fixed messenger-on-bottom messenger-on-left';
    }
    Messenger.options = {
        extraClasses: extraClasses,
        theme: 'flat'
    };
    if(data.type=='error'){
        Messenger().post({
            message: data.msj,
            type: data.type,
            showCloseButton: true
        }); 
    }else{
        Messenger().post({
            message: data.msj,
            showCloseButton: true
        }); 
    }
}
$('body').on('keyup','.t-uc',function () {
    this.value = this.value.toUpperCase();
});
$('body').on('keyup','.t-cap',function () {
    this.value = this.value.replace(/(^|\s)\S/g, l => l.toUpperCase());
});
$('body').on('click','.link-image-capture',function (evt) {
    var type_url=$(this).attr('data-url');
    var emp=$(this).attr('data-emp');
    AbrirVista(base_url+'Sections/Usuarios/TomarFoto?url='+type_url+'&emp='+emp,600,480); 
});
var sighImageCrop=function () {
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
            $('input[name=empleado_perfil]').val($('#filename').val());
            $('body .image-profile').attr('src',base_url+'assets/img/perfiles/'+$('#filename').val());
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
}
var sighSaveImagebase64=function (info,cb) {
    sighAjaxPost(info,base_url+'Sections/Usuarios/AjaxSaveImage64',function (response) {
        cb(response);
    });
};
var OpenLoadView=function(url,nombre,cb){
    coordx= screen.width ? (screen.width-200)/2 : 0; 
    coordy= screen.height ? (screen.height-150)/2 : 0; 
    var window_is_load=window.open(url,nombre,'width=800,height=600,top=30,right='+coordx+',left='+coordy);
    $(window_is_load).load(function (e) {
        cb();
    });
}
$('body').on('click','.link-open-view',function (evt) {
    var link=$(this).attr('data-href');
    coordx= screen.width ? (screen.width-200)/2 : 0; 
    coordy= screen.height ? (screen.height-150)/2 : 0; 
    window.open(link,"DOC-"+Math.random(),'width=800,height=600,top=30,right='+coordx+',left='+coordy);
});
var checkConnectionServer=function () {}