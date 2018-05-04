<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -20px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Noticias">Noticias</a></li>
            <li><a href="#">Agregar Imagenes</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR IMAGENES DE ANEXO A LA NOTICIA</h4>
                        <a href="#" onclick="AbrirVista(base_url+'Sections/Noticias/ImagenesAgregar?noticia=<?=$_GET['noticia']?>',700,600)" class="md-btn md-fab m-b red waves-effect pull-right">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th>IMAGEN</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value){?>
                                        <tr>
                                            <td><?=$value['img_url']?> </td>
                                            <td>
                                                <i class="fa fa-trash-o color-imss i-20 pointer delete-noticia-img" data-img="<?=$value['img_url']?>" data-id="<?=$value['img_id']?>"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <ul class="pagination"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>   
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Noticias.js?'). md5(microtime())?>" type="text/javascript"></script>