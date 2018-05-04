<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">GESTIÓN DE HOSPITALES</h4>
                <a href="<?= base_url()?>Sections/Hospitales/Agregar?hospital=0&a=add" class="md-btn md-fab m-b red waves-effect pull-right">
                    <i class="material-icons i-24 color-white">library_add</i>
                </a>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                            <thead>
                                <tr>
                                    <th style="width: 10%">CLASIFICACIÓN</th>
                                    <th style="width: 25%">TIPO</th>
                                    <th style="width: 30%">HOSPITAL</th>
                                    <th>NIVEL</th>
                                    <th style="width: 20%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ws=0; foreach ($Hospitales as $value){ if($value['hospital_ws']=='Publicado'){$ws++; }?>
                                <tr>
                                    <td><?=$value['hospital_clasificacion']?></td>           
                                    <td><?=$value['hospital_tipo']?></td>           
                                    <td><?=$value['hospital_nombre']?></td>
                                    <td><?=$value['hospital_nivel']?></td>
                                    <td>
                                        <a href="<?= base_url()?>Sections/Hospitales/Equipos?hos=<?=$value['hospital_id']?>">
                                            <i class="fa fa-desktop i-20 sigh-color tip" data-original-title="Agregar Equipos"></i>
                                        </a>&nbsp;
                                        
                                        <?php if($value['hospital_ws']=='Publicado'){ ?>
                                        <a href="<?= base_url()?>Sections/Hospitales/ws?hos=<?=$value['hospital_id']?>">
                                            <i class="fa fa-cog i-20 sigh-color tip" data-original-title="Configuración del Sitio"></i>
                                        </a>&nbsp;
                                        <a href="<?=$value['hospital_ws_url']?>" target="_blank">
                                            <i class="fa fa-external-link i-20 sigh-color tip" data-original-title="Vista Previa del Sitio"></i>
                                        </a>&nbsp;
                                        <i class="fa fa-window-close-o i-20 sigh-color tip pointer ws-publicar" data-action="No Publicado" data-hospital="<?=$value['hospital_id']?>" data-original-title="No Publicar este Hospital"></i>&nbsp;
                                        <?php }else{if($ws==0){?>
                                            <i class="fa fa-check-square-o i-20 sigh-color tip pointer ws-publicar" data-action="Publicado" data-hospital="<?=$value['hospital_id']?>" data-original-title="Publicar este Hospital"></i>&nbsp;
                                        <?php }}?>
                                        
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