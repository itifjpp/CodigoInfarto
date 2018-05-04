<?= modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px;margin-left: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Usuarios">Usuarios</a></li>
            <li><a href="<?= base_url()?>Sections/Usuarios/Usuario/<?=$_GET['user']?>/?a=edit">Agregar/Editar Usuario</a></li>
            <li><a href="">Actualizar Imagen de Perfil</a></li>
        </ol>
        <div class="row m-t-10">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">AGREGAR DOCUMENTOS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tools-image" style="padding: 0px 30px 0px 30px">
                                    <?php if(file_exists('assets/img/perfiles/'.$info[0]['empleado_perfil'])){?>
                                    <img src="<?=base_url()?>assets/img/perfiles/<?=$info[0]['empleado_perfil']!='' ? $info[0]['empleado_perfil'] :'default_.png'?>" class="width100 image-profile">
                                    <?php }else{?>
                                    <img src="<?=base_url()?>assets/img/perfiles/default_.png" class="width100 image-profile">
                                    <?php }?>

                                    <div class="tools-image-controls">
                                        <a href="#" title="TOMAR FOTO DE PERFIL" class="link-image-capture" data-url="Enseñanza" data-emp="<?=$info[0]['empleado_id']?>">
                                            <i class="material-icons">camera_alt</i>
                                        </a>
                                        <a href="#" title="SUBIR FOTO DE PERFIL" class="link-image-upload"> 
                                            <i class="material-icons">backup</i>
                                        </a> 
                                        <a href="#" title="RECORTAR FOTO DE PERFIL"  class="link-image-crop"> 
                                            <i class="material-icons">crop</i>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>" type="text/javascript"></script> 
