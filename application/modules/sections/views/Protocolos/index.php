<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin text-uppercase">PROTOCOLOS</h4>
                        <a class="btn btn-circle red btn-60 btn-protocolo-add pull-right" data-id="0" data-nombre="" data-descripcion="" data-action="add">
                            <i class="material-icons color-white i-24" >library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <h6 class="inputSelectNombre hide" style="color: red;margin-top: -10px"><i class="fa fa-warning"></i> ESTA CONSULTA ESTA LIMITADA A: 100 REGISTROS</h6>
                                <table class="footable table table-bordered table-no-padding" id="tableResultSearch" data-filter="#search" data-page-size="20" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th data-sort-ignore="true" style="width: 5%">N°</th>
                                            <th data-sort-ignore="true" style="width: 20%">PROTOCOLO</th>
                                            <th data-sort-ignore="true" style="width: 70%">DESCRIPCIÓN</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($Gestion as $value) { $i++;?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$value['protocolo_nombre']?></td>
                                            <td><?=$value['protocolo_descripcion']?></td>
                                            <td>
                                                <i class="fa fa-pencil sigh-color i-20 btn-protocolo-add pointer" data-id="<?=$value['protocolo_id']?>" data-nombre="<?=$value['protocolo_nombre']?>" data-descripcion="<?=$value['protocolo_descripcion']?>" data-action="edit"></i>&nbsp;
                                                <a href="<?= base_url()?>Sections/Protocolos/AgregarPacientes?protocolo=<?=$value['protocolo_id']?>">
                                                    <i class="fa fa-users sigh-color i-20"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center">
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
<script src="<?= base_url('assets/js/sections/Protocolos.js?'). md5(microtime())?>" type="text/javascript"></script> 