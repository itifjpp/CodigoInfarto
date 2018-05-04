<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="<?= base_url()?>Encuestas">ENCUESTAS</a></li>
            <li><a href="#">ÁREAS</a></li>
        </ol> 
        <div class="row">
            <div class="col-md-7 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white semi-bold">AGREGAR QUE ÁREAS PUEDEN VISUALIZAR ESTA ENCUESTA</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="select2 width100" name="acceso_id">
                                        <?php foreach ($AreasAcceso as $ac){?>
                                        <option value="<?=$ac['areas_acceso_id']?>"><?=$ac['areas_acceso_nombre']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="encuesta_id" value="<?=$_GET['enc']?>">
                                    <button class="btn sigh-background-secundary btn-block btn-ensat-areas">AGREGAR ÁREA</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th>ÁREA DE ACCESO</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>

                                        <tr id="<?=$value['encuesta_id']?>">
                                            <td><?=$value['areas_acceso_nombre']?></td>
                                            <td class="text-center">
                                                <i class="fa fa-trash-o i-20 sigh-color pointer encuesta-area-eliminar" data-area="<?=$value['area_id']?>" data-encuesta="<?=$value['encuesta_id']?>"></i>&nbsp;
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="7" class="text-center">
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
<script src="<?= base_url('assets/js/Encuestas.js?').md5(microtime())?>" type="text/javascript"></script>