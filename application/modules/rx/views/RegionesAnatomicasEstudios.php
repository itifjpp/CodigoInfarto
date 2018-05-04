<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px;color:#2196F3">
            <li><a href="<?= base_url()?>Rx/RegionesAnatomicas">REGIONES ANATÓMICAS</a></li>
            <li><a href="#">ESTUDIOS</a></li>
        </ol>
        <div class="box-inner col-md-9 col-centered" style="margin-top: 50px">
            <div class="panel panel-default " >
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">ESTUDIOS</span>
                    <a class="md-btn md-fab m-b red pull-right btn-rx-ra-estudios-add" data-id="0" data-ra="<?=$_GET['ra']?>" data-estudio="" data-accion="add" href="#" style="position: absolute;top: 15px;right: 0px">
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
                                        <th>ESTUDIO</th>
                                        <th style="width: 15%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['estudio_id']?></td>
                                        <td><?=$value['ra_nombre']?></td>
                                        <td><?=$value['estudio_nombre']?></td>
                                        <td>
                                            <i class="fa fa-pencil color-imss i-20 btn-rx-ra-estudios-add pointer" data-id="<?=$value['estudio_id']?>" data-ra="<?=$value['ra_id']?>" data-estudio="<?=$value['estudio_nombre']?>" data-accion="edit"></i>&nbsp;
                                            <i class="fa fa-trash-o color-imss pointer i-20 i-rx-ra-estudio-del" data-id="<?=$value['estudio_id']?>"></i>
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

