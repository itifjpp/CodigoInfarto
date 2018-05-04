<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="">
            <div class="grid simple">
                <div class="grid-title sigh-background-secundary">
                    <h4 class="no-margin color-white">AGREGAR CONTENIDO</h4>
                </div>
                <div class="grid-body">
                    <div class="row" >
                        <div class="col-md-12">
                            <table class="table footable table-bordered table-no-padding" id="SeleccionarContenido" data-page-size="4">
                                <thead>
                                    <tr>
                                        <th>CONTENIDO</th>
                                        <th>ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr >
                                        <td class="contentSeleccion"><?=$value['contenido_datos']?></td>
                                        <td>
                                            <label class="md-check">
                                                <input type="radio" name="SeleccionarContenido" value="<?=$value['contenido_id']?>">
                                                <i class="blue"></i>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php if(empty($Gestion)){?>
                                    <tr>
                                        <td colspan="2">NO SE ENCONTRARÓN CONTENIDOS PARA ESTA PLANTILLA</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr class="hide-if-no-paging text-center">
                                        <td colspan="4">
                                            <ul class="pagination"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <a href="" class="md-btn md-fab red md-fab-bottom-right pos-fix teal select-content">
                            <i class="material-icons i-24 color-white">check</i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="SeleccionarContenido" value="Si">
<input type="hidden" name="inputName" value="<?=$_GET['input']?>">
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Plantillas.js?').md5(microtime())?>" type="text/javascript"></script>