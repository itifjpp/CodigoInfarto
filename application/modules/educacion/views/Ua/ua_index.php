<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row"> 
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white text-uppercase">Unidades Académicas</h4>
                        <a href="<?=  base_url()?>Educacion/Ua/Agregar?a=add&ua=0" class="md-btn md-fab m-b red pull-right tip ">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" id="ua_id" class="form-control" placeholder="BUSCAR UNIDAD ACADÉMICA...">
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#ua_id" >
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">UNIDAD ACADÉMICA </th>
                                            <th style="width: 20%">INCORPORACIÓN</th>
                                            <th style="width: 40%">DIRECCIÓN</th>
                                            <th style="width: 10%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Ua as $value) {?>
                                        <tr>
                                            <td><?=$value['ua_nombre']?></td>
                                            <td><?=$value['ua_incorporacion']?></td>
                                            <td><?=$value['ua_direccion']?></td>
                                            <td>
                                                <a href="<?= base_url()?>Educacion/Ua/Agregar?a=edut&ua=<?=$value['ua_id']?>">
                                                    <i class="fa fa-pencil sigh-color i-20"></i>
                                                </a>&nbsp;
                                                <a href="<?= base_url()?>Educacion/Ua/Carreras?ua=<?=$value['ua_id']?>">
                                                    <i class="fa fa-pencil-square-o sigh-color i-20 tip" data-original-title="Agregar Carreras"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 ua-eliminar pointer" data-id="<?=$value['ua_id']?>"></i>
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
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>