<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Multimedia</span>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="" >
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 0px">
                            <table class="table footable table-bordered table-hover" data-page-size="10">
                                <thead>
                                    <tr>
                                        
                                        <th>FECHA & HORA</th>
                                        <th>TITULO</th>
                                        <th>TIPO</th>
                                        <th>ESTATUS</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['multimedia_fecha']?> <?=$value['multimedia_hora']?></td>
                                        <td><?=$value['multimedia_titulo']?></td>
                                        <td><?=$value['multimedia_tipo']?></td>
                                        <td><?=$value['multimedia_status']?></td>
                                        <td>
                                            <?php if($value['multimedia_status']=='No Publicado'){?>
                                            <i class="fa fa-share-square-o icono-accion tip pointer accion-publicar" data-accion="Publicado" data-id="<?=$value['multimedia_id']?>" data-original-title="Publicar Multimedia"></i>&nbsp;
                                            
                                            <a href="<?= base_url()?>Sections/Multimedia/Agregar?m=<?=$value['multimedia_id']?>&a=edit">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>
                                            
                                            <?php }else{?>
                                            <i class="fa fa-times icono-accion tip pointer accion-publicar" data-accion="No Publicado" data-id="<?=$value['multimedia_id']?>" data-original-title="No Publicar Multimedia"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Multimedia.js')?>" type="text/javascript"></script>