<?= modules::run('Sections/Menu/loadHeader'); ?>
<link href="<?= base_url()?>assets/libs/fancybox/jquery.fancybox.css" rel="stylesheet">
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -20px">
            <li><a href="<?=  base_url()?>Inicio">Inicio</a></li>
            <?php if(isset($_GET['via'])){?>
            <li><a href="<?= base_url()?>Sections/Noticias/Todas">Noticias</a></li>
            <?php }?>
            <li><a href="#">Detalles de la Noticia</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-8">
                <div class="grid simple">
                    <div class="grid-title no-padding" >
                        <img src="<?= base_url()?>assets/Noticias/<?=$info['noticia_portada']?>" alt="" style="width: 100%">
                    </div>
                    <div class="grid-body">
                        <h6 style="font-size: 10px;margin-top: -10px" class="text-right"><b>FECHA:</b> <?=$info['noticia_fecha']?> <?=$info['noticia_hora']?>&nbsp;&nbsp; <b>PUBLICADO POR:</b> <?=$Empleado['empleado_nombre']?> <?=$Empleado['empleado_ap']?> <?=$Empleado['empleado_am']?></h6>
                        <div class="row" style="margin-top: -15px">
                            <div class="col-md-12">
                                <h3 class="text-uppercase text-justify" style="line-height: 1.3;"><b><?=$info['noticia_titulo']?></b></h3>
                            </div>
                            <div class="col-md-12">
                                <h5 class="text-uppercase text-justify" style="line-height: 1.6;margin-top: 0px"><?=$info['noticia_descripcion_breve']?></h5>

                            </div>
                            <div class="col-md-12"><br><br>
                                <h5 class="text-uppercase text-justify" style="line-height: 1.6"><?=$info['noticia_descripcion']?></h5>
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
            <div class="col-md-4" style="margin-top: 0px">
                <div class="grid simple">
                    <div class="grid-body">
                        <div class="row" >
                            <div class="col-md-12 no-padding">
                                <h4 class="no-margin"><b>NOTICIAS RECIENTES</b></h4>
                                <hr class="no-margin">
                            </div>
                            <?php foreach ($Noticias as $value) {
                            if($value['noticia_id']!= $_GET['not']){    
                            ?>
                            <a href="<?= base_url()?>Sections/Noticias/Detalles?not=<?= $value['noticia_id']?>">
                                <div class="col-md-12 pointer" data-url="" style="margin-top: 10px;padding: 0px">
                                    <img src="<?= base_url()?>assets/Noticias/<?=$value['noticia_portada']?>" style="width: 100%;border-radius: 5px">
                                    <div class="noticia-img">
                                        <div class="description">
                                            <div class="text-nowrap-imss"><?=$value['noticia_titulo']?></div>
                                            <hr class="hr-style1">
                                            <h6 style="font-size: 10px;margin-bottom: 4px;margin-top: 0px"><b>FECHA Y HORA:</b> <?=$value['noticia_fecha_gen']?></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php 

                            }}?>
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
