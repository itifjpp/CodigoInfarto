<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<link href="<?= base_url()?>assetsv2/plugins/webcam/wc.css?time=<?= date('YmdHis')?>" type="text/css" rel="stylesheet">
<div class="row " 5>
    <div class="col-md-12 no-padding">
        <div class="app">
            <center>
                <a href="#" id="start-camera" class="btn btn-primary text-uppercase  m-t-50">Haz clic aquí, Tomar una foto del perfil</a>
            </center>
            <video id="camera-stream"></video>
            <img id="snap">
            <p id="error-message"></p>
           <div class="controls">
                <a href="#" id="delete-photo" title="Eliminar Foto" class="disabled">
                    <i class="material-icons">delete</i>
                </a>
               <a href="#" id="take-photo" class="hide" title="Tomar Foto">
                    <i class="material-icons">timer</i>
                </a>
                <a href="#" id="start-capture-in-time" title="Tomar Foto">
                    <i class="material-icons">camera_alt</i>
                </a>
                <a href="#" id="download-photo" title="Descargar Foto" class="disabled">
                    <i class="material-icons">check</i>
                </a> 
            </div>
            <div class="text-center" style="position: absolute;top: calc(40%);left: calc(45%)">
                <h5 style="color: white;font-size: 70px;font-weight: bold;text-align: center" class="time-start-capture hide">5</h5>
                
            </div>
            <canvas></canvas>
        </div>
        <input type="hidden" name="capture_url" value="<?=$_GET['url']?>">
        <input type="hidden" name="empleado_id" value="<?=$_GET['emp']?>">
    </div>
</div>

<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url()?>assetsv2/plugins/webcam/wc.js?time=<?= md5(microtime())?>" type="text/javascript"></script> 
<script>
$(document).ready(function() {
    var tiempo_capture=5;
    $('#start-capture-in-time').click(function(evt) {
        evt.preventDefault();
        //$('#take-photo').removeClass('hide');
        $('#start-capture-in-time').addClass('hide');
        $('.time-start-capture').removeClass('hide');
        var interval=setInterval(function() {
            tiempo_capture--;
            $('.time-start-capture').text(tiempo_capture)
            if(tiempo_capture==0){
                clearInterval(interval);
                $('#take-photo').trigger('click');
                setTimeout(function() {
                    $('#download-photo').trigger('click');
                },1000);
                
            }
        },1000);
    });
    $('#download-photo').click(function(evt) {
        evt.preventDefault();
        var capture_url=$('input[name=capture_url]').val();
        var img_base64=$(this).attr('href');
        sighMsjLoading();
        sighSaveImagebase64({
            img_base64:img_base64,
            img_save:'img/perfiles/'
        },function(response) {
           
            if(capture_url=='Preregistro'){
                bootbox.hideAll();
                window.opener.$('body .image-profile').attr('src',base_url+'assets/img/perfiles/'+response.image_create);
                window.opener.$('body input[name=empleado_perfil]').val(response.image_create);
                window.opener.$('body .image-profile-info').addClass('hide');
                window.top.close();
            }if(capture_url=='Enseñanza' || capture_url=='Administrador'){
                sighAjaxPost({
                    empleado_id:$('input[name=empleado_id]').val(),
                    empleado_perfil:response.image_create
                },base_url+'Sections/Usuarios/AjaxImageProfile',function (response) {
                    bootbox.hideAll();
                    window.top.close();
                    window.opener.location.reload();
                });
            }
            
        });
    });
});
</script>