<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">AGREGAR DOCUMENTOS</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-usuario-documentos" enctype="multipart/form-data">
                            <div class="form-group">
                                <select class="width100 documento_tipo" name="documento_tipo" required="">
                                    <?php foreach ($DocumentosRegistros as $value) {?>
                                    <option value="<?=$value['documento_nombre']?>"><?=$value['documento_nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            
                            <div class="form-group m-b-5">
                                <label>ANEXAR DOCUMENTOS</label>
                                <input type="file" name="documentos_anexos[]" multiple="" required="" class="form-control upload-archivo">
                            </div>
                            <div class="form-group no-margin">
                                <div class="checkbox check-success 	">
                                    <input id="checkbox2" class="documentos_ignore" name="documentos_ignore" type="checkbox" value="Ignorar">
                                    <label for="checkbox2">IGNORAR SUBIDA DE DOCUMENTO</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="empleado_tmp" value="<?=$_GET['tmp']?>">
                                <input type="hidden" name="documento_id" value="<?=$_GET['doc']?>">
                                <input type="hidden" name="documento_action" value="<?=$_GET['a']?>">
                                <button class="btn sigh-background-secundary pull-right">AGREGAR DOCUMENTOS</button>
                            </div>    
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url()?>assets/js/EducacionRegistro.js?<?= md5(microtime())?>" type="text/javascript"></script> 
<?php foreach ($Docs as $value) {?>
<script>
    $(document).ready(function() {
        $('.documento_tipo option[value="<?=$value['documento_tipo']?>"]').remove();
    });
</script>
<?php } ?>

