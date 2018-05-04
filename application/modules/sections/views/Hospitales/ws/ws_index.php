<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="grid simple col-md-9 col-centered">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">CONFIGURACIÓN DEL SITIO WEB</h4>
                <a href="<?= base_url()?>Sections/Hospitales/ws_add?hospital=<?=$_GET['hos']?>&a=add&id=0" class="md-btn md-fab m-b red waves-effect pull-right">
                    <i class="material-icons i-24 color-white">library_add</i>
                </a>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered footable "  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                            <thead>
                                <tr>
                                    <th style="width: 30%">URL DEL SITIO WEB</th>
                                    <th>NIVEL</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gestion as $value){?>
                                <tr>
                                    <td><?=$value['ws_url']?></td>
                                    <td><?=$value['ws_bd_ip']?></td>            
                                    <td>
                                        <a href="">
                                            <i class="fa fa-picture-o i-20 sigh-color tip" data-original-title="Agregar Sliders"></i>
                                        </a>&nbsp;
                                        <a href="">
                                            <i class="fa fa-picture-o i-20 sigh-color tip" data-original-title="Agregar Galería"></i>
                                        </a>&nbsp;
                                        <a href="<?=$value['ws_url']?>" target="_blank">
                                            <i class="fa fa-external-link i-20 sigh-color tip" data-original-title="Vista Previa"></i>
                                        </a>&nbsp;
                                        <i class="fa fa-check-square-o i-20 sigh-color tip pointer ws-publicar" data-hospital="<?=$value['hospital_id']?>" data-id="<?=$value['ws_id']?>" data-original-title="Publicar esta Página"></i>&nbsp;
                                        <a href="<?= base_url()?>Sections/Hospitales/Agregar?hospital=<?=$value['hospital_id']?>&a=edit">
                                            <i class="fa fa-pencil i-20 sigh-color"></i>
                                        </a>
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

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Hospitales.js?'). md5(microtime())?>" type="text/javascript"></script>