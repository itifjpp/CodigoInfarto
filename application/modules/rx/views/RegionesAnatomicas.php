<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Regiones Anatómicas</span>
                    <a class="md-btn md-fab m-b red pull-right btn-rx-ra-add" data-id="0" data-region="" data-accion="add" href="#" style="position: absolute;top: 15px;right: 0px">
                        <i class="mdi-av-queue i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-no-padding table-bordered">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>REGIÓN ANATÓMICA</th>
                                        <th style="width: 15%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['ra_id']?></td>
                                        <td><?=$value['ra_nombre']?></td>
                                        <td>
                                            <i class="fa fa-pencil color-imss i-20 btn-rx-ra-add pointer" data-id="<?=$value['ra_id']?>" data-region="<?=$value['ra_nombre']?>" data-accion="edit"></i>&nbsp;
                                            <a href="<?= base_url()?>Rx/Estudios?ra=<?=$value['ra_id']?>">
                                                <i class="fa fa-clone color-imss i-20"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-trash-o color-imss pointer i-20 i-rx-ra-del" data-id="<?=$value['ra_id']?>"></i>
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
<?php echo modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Rx.js?<?= md5(microtime())?>"></script>

