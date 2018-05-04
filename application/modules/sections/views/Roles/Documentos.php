<?= modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-primary">
                        <h4 class="color-white no-margin">DOCUMENTOS REQUERIDOS PARA LA ASIGNACIÓN DE ESTE ROL</h4>
                        <a class="md-btn md-fab m-b red acciones-roles-documentos pull-right" data-rol="<?=$_GET['rol']?>" data-id="0" data-action="add" data-documento="">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-no-padding" data-filter="#filter" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th>DOCUMENTO</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($Documentos as $value) {?>
                                        <tr id="<?=$value['rol_id']?>" >
                                            <td><?=$value['documento_nombre']?> </td>
                                            <td class="text-center ">
                                                
                                                <i class="fa fa-pencil sigh-color i-20 pointer acciones-roles-documentos" data-rol="<?=$value['rol_id']?>" data-id="<?=$value['documento_id']?>" data-action="edit" data-documento="<?=$value['documento_nombre']?>"></i> &nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 pointer acciones-roles no-accion" data-id="<?=$value['rol_id']?>" data-accion="Eliminar" data-rol=""></i>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="3" class="text-center">
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
<script src="<?= base_url('assets/js/sections/Roles.js?'). md5(microtime())?>" type="text/javascript"></script>