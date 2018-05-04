<?= modules::run('Sections/Menu/loadHeader'); ?>
<link href="<?= base_url()?>assets/libs/fancybox/jquery.fancybox.css" rel="stylesheet">
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -20px">
            <li><a href="<?=  base_url()?>Inicio">Inicio</a></li>
            <?php if(isset($_GET['via'])){?>
            <li><a href="<?= base_url()?>Sections/Noticias/Todas">Noticias</a></li>
            <?php }?>
            <li><a href="#">Detalles de la Normativa</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title no-padding" >
                        <img src="<?= base_url()?>assets/Normativas/<?=$info['normativa_portada']?>" alt="" style="width: 100%">
                    </div>
                    <div class="grid-body">
                        <div class="row" style="margin-top: -15px">
                            <div class="col-md-12">
                                <h3 class="text-uppercase text-justify no-margin"><b><?=$info['normativa_titulo']?></b></h3>
                            </div>
                            <div class="col-md-8">
                                <h5 class="text-uppercase text-justify"><b>INSTITUCIÓN:</b> <?=$info['normativa_institucion']?></h5>
                                <h5 class="text-uppercase text-justify"><b>ESPECIALIDAD:</b> <?=$info['normativa_especialidad']?></h5>
                                <h5 class="text-uppercase text-justify"><b>GRUPO ETÁREO:</b> <?=$info['normativa_grupo_etario']?></h5>
                                <h5 class="text-uppercase text-justify"><b>NIVEL DE ATENCIÓN:</b> <?=$info['normativa_nivel_atencion']?></h5>
                                <h5 class="text-uppercase text-justify"><b>CATEGORÍA:</b> <?=$info['normativa_categoria']?></h5>
                            </div>
                            <div class="col-md-4">
                                <?php if(file_exists('assets/Normativas/'.$info['normativa_file'])){ ?>
                                <a href="<?= base_url()?>assets/Normativas/<?=$info['normativa_file']?>" target="_blank">
                                    <i class="fa fa-file fa-5x"></i>
                                </a>
                                <?php }else{?>
                                <h5 class="text-center line-height">NO SE ANEXO NINGÚN ARCHIVO PARA ESTA NORMATIVA</h5>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <?php foreach ($Galeria as $value){?>
                            <div class="col-md-3">
                                <div class="img-hover">
                                    <img src="<?= base_url()?>assets/Noticias/<?=$value['img_url']?>" alt="" style="width: 100%">
                                    <div class="overlay">
                                        <a href="<?= base_url()?>assets/Noticias/<?=$value['img_url']?>" class="fancybox">
                                            <i class="fa fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/libs/fancybox/jquery.fancybox.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/sections/Noticias.js?'). md5(microtime())?>" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $(".fancybox").fancybox({
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        helpers : {
            title : {
                type : 'inside'
            }
        }
    });
});
</script>
