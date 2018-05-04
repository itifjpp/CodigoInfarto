<?php echo modules::run('Sections/Menu/loadHeaderBasico'); ?>
<div class="row m-t-20" style="margin-left: -80px;margin-right: -80px;">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin semi-bold color-white">SOLICITAR ESTUDIOS</h4>
                <a class="md-btn md-fab m-b red pull-right btn-rx-estudio-especial tip" data-placement="left" data-original-title="Solicitar Estudio Especial" data-id="0" data-region="" data-accion="add" href="#" style="position: absolute;top: 15px;right: 10px">
                     <i class="material-icons i-24 color-white">playlist_add_check</i>
                </a>
            </div>
            <div class="grid-body">
                <div class="row">
                     <form class="add-estudio-especial hide">
                        <div class="col-xs-5">
                            <div class="input-group">
                               <span class="input-group-addon sigh-background-secundary no-border">
                                    <i class="material-icons i-20">perm_identity</i>
                                </span>
                                <select class="form-control" name="ra_id_es" required="">
                                    <option value="">SELECCIONAR R. ANATÓMICA</option>
                                    <?php foreach ($Regiones as $reg){?>
                                    <option value="<?=$reg['ra_id']?>"><?=$reg['ra_nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="input-group">
                                <span class="input-group-addon sigh-background-secundary no-border">
                                    <i class="material-icons i-20">contacts</i>
                                </span>
                                <input type="text" name="estudio_nombre" required="" class="form-control" placeholder="NOMBRE DEL ESTUDIO">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <input type="hidden" name="solicitud_id" value="<?=$_GET['sol']?>">
                            <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                            <input type="hidden" name="csrf_token">
                            <button class="btn sigh-background-secundary btn-block">AGREGAR</button>
                        </div>
                    </form>
                    <form class="form-agregar-estudio">
                        <div class="col-xs-5">
                            <div class="input-group">
                               <span class="input-group-addon sigh-background-secundary no-border">
                                    <i class="material-icons i-20">perm_identity</i>
                                </span>
                                <select class="form-control" name="ra_id" required="">
                                    <option value="">SELECCIONAR R. ANATÓMICA</option>
                                    <?php foreach ($Regiones as $reg){?>
                                    <option value="<?=$reg['ra_id']?>"><?=$reg['ra_nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="input-group">
                                <span class="input-group-addon sigh-background-secundary no-border">
                                    <i class="material-icons i-20">contacts</i>
                                </span>
                                <select class="select2 width100" name="estudio_id" required="">
                                    <option value="">SELECCIONAR ESTUDIO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <input type="hidden" name="solicitud_id" value="<?=$_GET['sol']?>">
                            <input type="hidden" name="csrf_token">
                            <button class="btn sigh-background-secundary btn-block">AGREGAR</button>
                        </div>
                    </form>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-xs-12">
                        <table class="table table-striped table-no-padding table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 18%">FECHA & HORA</th>
                                    <th style="width: 30%">REGIÓN ANATÓMICA</th>
                                    <th style="">ESTUDIO</th>
                                    <th style="width: 15%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gestion as $value) {?>
                                <tr>
                                    <td><?=$value['se_fecha']?> <?=$value['se_hora']?></td>
                                    <td><?=$value['ra_nombre']?></td>
                                    <td><?=$value['estudio_nombre']?></td>
                                    <td>
                                        <i class="fa fa-trash-o color-imss pointer i-20 icon-rx-se-remove" data-id="<?=$value['se_id']?>"></i>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input name="inputVia" type="hidden" value="<?=$_GET['via']?>">
                <a href="" class="md-btn md-fab md-fab-bottom-right pos-fix blue btn-windows-close-estudio tip" data-solicitud="<?=$_GET['sol']?>" data-folio="<?=$_GET['folio']?>" style="width: 80px;height: 80px" data-placement="left" data-original-title="Cerrar">
                    <i class="material-icons i-24 color-white" style="vertical-align: -65%;font-size: 40px ">check</i>
                </a>
            </div>

        </div>
    </div>
</div>
<?php echo modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?=  base_url()?>assets/js/Rx.js?<?= md5(microtime())?>"></script>

