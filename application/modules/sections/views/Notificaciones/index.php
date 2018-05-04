<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">NOTIFICACIONES</span>
                    <a href="<?=  base_url()?>Sections/Notificaciones/Nuevo/0/?a=add" target="_blank" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="mdi-communication-chat i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable table-usuarios"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">TITULO</th>
                                        <th style="width: 40%">DESCRIPCIÓN</th>
                                        <th>FECHA & HORA</th>
                                        <th>ESTATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['notificacion_titulo']?></td>
                                        <td><?= mb_substr($value['notificacion_descripcion'], 0,100,'UTF-8')?></td>
                                        <td><?=$value['notificacion_fecha']?> <?=$value['notificacion_hora']?></td>
                                        <td><?=$value['notificacion_estatus']?></td>
                                        <td>
                                            <a href="<?= base_url()?>Sections/Notificaciones/Detalles?n=<?=$value['notificacion_id']?>">
                                                
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="5" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Notificaciones.js?'). md5(microtime())?>" type="text/javascript"></script>