$(document).ready(function (e) {
    $('body textarea[name=noticia_descripcion]').wysihtml5();
    $('.form-add-noticia').submit(function (e) {
        e.preventDefault();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Noticias/AjaxAgregar',function (response) {
            msj_success_noti('DATOS GUARDADOS'); 
            location.href=base_url+'Sections/Noticias';
        });
    });
    $('.form-add-noticia-img').submit(function (e) {
        e.preventDefault();
        msj_success_noti('Guardando imagen')
        sighAjaxPost($(this).serialize(),base_url+'Sections/Noticias/AjaxImagenesAgregar',function (response) {
            window.top.close();
            window.opener.location.reload();
        },'No')
    });
    $(document).on('click','.delete-noticia-img',function (e) {
        let img_id=$(this).attr('data-id');
        let img_url=$(this).attr('data-img');
        sighAjaxPost({
            img_id:img_id,
            img_url:img_url,
        },base_url+'Sections/Noticias/AjxEliminarImg',function (response) {
            location.reload();
        });
    });
    $(document).on('click','.publicar-noticia',function (e) {
        let noticia_id=$(this).attr('data-id');
        let noticia_status=$(this).attr('data-accion');
        sighAjaxPost({
            noticia_id:noticia_id,
            noticia_status:noticia_status,
        },base_url+'Sections/Noticias/AjaxPublicarNoticia',function (response) {
            msj_success_noti('ESTA NOTICIA HA SIDO PUBLICADA');
            if(noticia_status=='Publicado'){
                AjaxGetNotifications();
            }
            setTimeout(function () {
                location.reload();
            },2000);
        });
    });
    $(document).on('click','.delete-noticia',function (e) {
        let noticia_id=$(this).attr('data-id');
        sighAjaxPost({
            noticia_id:noticia_id,
        },base_url+'Sections/Noticias/AjxEliminarNoticia',function (response) {
            location.reload();
        });
    });
    if($('input[name=noticia_portada]').val()!=undefined){
        $('.html5imageupload').css({
            'background':"url("+base_url+"assets/Noticias/"+$('input[name=noticia_portada]').val()+")",
            'background-size':'cover'
        })
    };
    if($('input[name=LoadNoticias]').val()!=undefined){
        AjaxCargarNoticias();
        
    }
    function AjaxCargarNoticias() {
        SendAjaxGet('Sections/Noticias/AjaxCargarNoticias',function (response) {
            $('.row-noticias').html(response.col);
        })
    }
    $(document).on('click','.open-doc-click',function (response) {
        AbrirDocumentoMultiple(base_url+$(this).attr('data-url'),'TEST');
    })
})
