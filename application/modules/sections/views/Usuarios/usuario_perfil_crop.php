<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<link href="<?= base_url()?>assetsv2/plugins/cropperjs-master/dist/cropper.css" rel="stylesheet">

<div class="row m-t-10">
    <div class="col-md-12">
        <div class="image-content">
            <img id="image-crop-user" src="<?= base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" class="width100">
        </div>
        <button type="button" class="md-btn md-fab m-b red btn-crop-end-image" style="position: absolute;right: 0px;top: -10px">
            <i class="material-icons i-24 color-white">check</i>
        </button>
        <input type="hidden" name="empleado_id" value="<?=$_GET['user']?>">
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>" type="text/javascript"></script> 
<script src="<?= base_url()?>assetsv2/plugins/cropperjs-master/dist/cropper.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var image = document.getElementById('image-crop-user');
    var cropper = new Cropper(image, {
        aspectRatio: 9 / 9,
        dragMode: 'move',
        cropBoxMovable: false,
        cropBoxResizable: false,
        crop: function(e) {
            
        }
    });
    $('body .btn-crop-end-image').on('click',function(e) {
        var image = new Image();
        var result = document.getElementById('result');
        image.src = cropper.getCroppedCanvas().toDataURL('image/png');
        //result.appendChild(image);
        sighMsjLoading();
        sighAjaxPost({
            empleado_id:$('input[name=empleado_id]').val(),
            empleado_image_credencial:cropper.getCroppedCanvas().toDataURL('image/png')
        },base_url+'Sections/Usuarios/AjaxRecortarImagenCredencial',function(response) {
            window.top.close();
            window.opener.location.reload();
        })
        
    })
})

</script>
