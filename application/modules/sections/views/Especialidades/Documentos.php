<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">DOCUMENTOS PARA EL EXPEDIENTE</h4>
                        <a class="md-btn md-fab m-b red waves-effect pull-right tip documentos-add" data-id="0" data-documento="" data-action="add" data-original-title="Indicadores">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon sigh-background-secundary no-border" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                                </div>
                            </div>

                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-no-padding"data-filter="#filter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%;">DOCUMENTO</th>
                                            <th>TIPO DE DOCUMENTO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['doc_nombre']?></td>
                                            <td><?=$value['doc_tipo']?></td>
                                            <td>
                                                <i class="fa fa-pencil sigh-color i-20 pointer documentos-add" data-id="<?=$value['doc_id']?>" data-documento="<?=$value['doc_nombre']?>" data-action="edit"></i>&nbsp;
                                                <i class="fa fa-trash-o pointer sigh-color i-20 pc-doc-del" data-id="<?=$value['doc_id']?>"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
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
<script src="<?= base_url('assets/js/sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>