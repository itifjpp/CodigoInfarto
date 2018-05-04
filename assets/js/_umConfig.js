/*EVITAR ESCRIBIR LOS CA*/
jQuery('body input[type=text],input[type=text] .md-input').keypress(function(tecla) {
    if(tecla.charCode == 60 || tecla.charCode == 62){
        msj_error_noti('CARACTER NO PERMITIDO');
        return false;
    } 
});
jQuery('body .md-input, input.form-control').keypress(function(tecla) {
    if(tecla.charCode == 60 || tecla.charCode == 62){
        msj_error_noti('CARACTER NO PERMITIDO');
        return false;
    } 
});
jQuery('body textarea').keypress(function(tecla) {
    if(tecla.charCode == 60 || tecla.charCode == 62) {
        msj_error_noti('CARACTER NO PERMITIDO');
        return false;
    }
});
var ObtenerColorClasificacion=function (Color) {
    if(Color=='Rojo'){
        return 'red';
    }if(Color=='Naranja'){
        return 'orange';
    }if(Color=='Amarillo'){
        return 'yellow-A700';
    }if(Color=='Verde'){
        return 'green';
    }if(Color=='Azul'){
        return 'indigo';
    }
}
var _msjLoading=function (msj){
   bootbox.dialog({
        title: '<h6>&nbsp;&nbsp;&nbsp;Espere por favor...</h6>',
        message:'<div class="row ">'+
                    '<div class="col-sm-12">'+
                        '<h6 class="text-center" style="line-height:2"><i class="fa fa-spinner fa-pulse fa-5x"></i></h6>'+
                        '<h6 class="text-center" style="line-height:2">'+(msj==undefined ? '': msj)+'</h6>'+
                    '</div>'+
                '</div>'
        ,closeButton:false
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px',
        'width':'30%'
    });
};
var _msjError=function (){
   bootbox.dialog({
        title: '<h5>ERROR AL PROCESAR LA PETICIÓN</h5>',
        message:'<div class="row ">'+
                    '<div class="col-sm-12" style=";margin-top:-30px">'+
                        '<h6 class="text-center" style="line-height:2;font-size:50px;color:#F44336"><i class="fa fa-frown-o "></i>  Oops!</h6>'+
                        '<h6 class="text-center" style="line-height:1.4;margin-top:0px;color:#F44336">LO SENTIMOS A OCURRIDO UN ERROR AL PROCESAR LA PETICIÓN. VUELVA A INTENTARLO</h6>'+
                    '</div>'+
                '</div>'
        ,onEscape : function() {}
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px',
        'width':'30%'
    });
};
var _msjActions=function (msj,type){
    let msj_color='';
    let msj_icon='';
    if(type=='ok'){
        msj_color='#099A8C';
        msj_icon='fa-check';
    }else{
        msj_color='#F44336';
        msj_icon='fa-exclamation-triangle';
    }
   bootbox.dialog({
        message:'<div class="row ">'+
                    '<div class="col-sm-12" style=";margin-top:-30px">'+
                        
                        '<p class="text-center" style="margin:0px;font-size:60px;color:'+msj_color+'"><i class="fa '+msj_icon+'"></i></p>'+
                        '<h6 class="text-center" style="line-height:1.4;margin:-5px 0px;color:'+msj_color+'">'+msj+'</h6>'+
                    '</div>'+
                '</div>',
        size:'small',
        buttons:{
            Cancelar:{
                label:'ACEPTAR',
                className:'back-imss',
                callback:function () {}
            }
        }
        ,onEscape : function() {}
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
    $('.modal-footer').css({
        'padding':'8px',
    });
};
var _msjConfirm=function (info,result) {
    bootbox.confirm({
        title:'<div  class="row"><div class="col-md-11" style="margin-top: -22px;margin-bottom: -8px;"><h5 class="text-nowrap-imss">'+um_clasificacion+' | '+um_nombre+'</h5></div></div>',
        message:'<div class="row" style="margin-top: -20px;">'+
                    '<div class="col-md-12">'+info.message+'</div>'+
                '</div>',
        buttons:{
            cancel:{
                label:'Cancelar',
                className:'back-imss'
            },confirm:{
                label:'Aceptar',
                className:'btn-imss-cancel'
            }
        },
        size:info.size,
        callback:result
    });
    var y = window.top.outerHeight / 4 ;
    $('.modal-dialog').css({
        'margin-top':y+'px'
    });
}
var AbrirDocumento=function(url){
    coordx= screen.width ? (screen.width-200)/2 : 0; 
    coordy= screen.height ? (screen.height-150)/2 : 0; 
    window.open(url,'Documento','width=800,height=600,top=30,right='+coordx+',left='+coordy);
}
var AbrirVista=function(url,width=800,height=600){
    var y = window.top.outerHeight / 2 + window.top.screenY - ( height / 1.5);
    var x = window.top.outerWidth / 2 + window.top.screenX - ( width / 2)
    window.open(url,'Documento','width='+width+',height='+height+',top='+y+',left='+x);
}
var AbrirDocumentoMultiple=function(url,nombre,left){
    coordx= screen.width ? (screen.width-200)/2 : 0; 
    coordy= screen.height ? (screen.height-150)/2 : 0; 
    window.open(url,nombre,'width=800,height=600,top=30,right='+coordx+',left='+(left==undefined ? coordy : left));
}
$('body').on('click','.open-doc',function (e) {
    var url=$(this).attr('data-url');
    var name=$(this).attr('data-name');
    var left=$(this).attr('data-left');
    AbrirDocumentoMultiple(base_url+url,name,left);
})
$(document).on('click','.notifications-msj',function () {
    msj_error_noti("NO DISPONIBLE");
});
$(document).on('click','.open-view-url',function (e) {
    e.preventDefault();
    AbrirDocumento(base_url+$(this).attr('data-url'));
})