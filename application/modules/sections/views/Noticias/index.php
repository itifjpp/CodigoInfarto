<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white ">GESTIÓN DE NOTICIAS</h4>
                        <a href="<?= base_url()?>Sections/Noticias/Agregar?noticia=0&a=add" class="md-btn md-fab m-b red waves-effect pull-right">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">FECHA & HORA</th>
                                            <th style="width: 25%">TÍTULO</th>
                                            <th style="width: 45%">DESCRIPCIÓN BREVE</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value){?>
                                        <tr>
                                            <td><?=$value['noticia_fecha']?> <?=$value['noticia_hora']?></td>
                                            <td><?=$value['noticia_titulo']?><br>

                                                <?php if($value['noticia_status']=='En Espera'){?>
                                                <span class="label red">EN ESPERA DE VALIDACIÓN</span>
                                                <?php }else{?>
                                                <span class="label blue">ESTA NOTICIA HA SIDO PUBLICADA</span>
                                                <?php }?>
                                            </td>                                        
                                            <td><?=$value['noticia_descripcion_breve']?></td>
                                            <td>
                                                <a href="<?= base_url()?>Sections/Noticias/Agregar?noticia=<?=$value['noticia_id']?>&a=edit">
                                                    <i class="fa fa-pencil sigh-color-secundary i-20"></i>
                                                </a>
                                                &nbsp;
                                                <a href="<?= base_url()?>Sections/Noticias/Imagenes?noticia=<?=$value['noticia_id']?>">
                                                    <i class="fa fa-image sigh-color-secundary i-20 pointer tip" data-original-title="Agregar Imagenes"></i>
                                                </a>&nbsp;
                                                <?php if($this->UMAE_AREA=='Administrador'){?>
                                                <?php if($value['noticia_status']=='En Espera'){ ?>
                                                <i class="fa fa-share-square-o sigh-color-secundary i-20 pointer tip publicar-noticia" data-accion="Publicado" data-id="<?=$value['noticia_id']?>" data-original-title="Publicar Noticia"></i>&nbsp;
                                                <?php }else{?>
                                                <i class="fa fa fa-times sigh-color-secundary i-20 pointer tip publicar-noticia" data-accion="En Espera" data-id="<?=$value['noticia_id']?>" data-original-title="No Publicar Noticia"></i>&nbsp;
                                                <?php }?>
                                                <?php }?>
                                                <i class="fa fa-trash-o sigh-color-secundary i-20 pointer delete-noticia" data-id="<?=$value['noticia_id']?>"></i>
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