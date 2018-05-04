<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple " >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase">Contenido</h4>
                        <a class="btn sigh-background-primary waves-effect pull-right" onclick="AbrirVista(base_url+'Sections/Plantillas/AgregarContenido?con=0&a=add&plantilla=<?=$this->uri->segment(4)?>')" style="margin-top: -10px;margin-right: -10px">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">

                        <div class="" >
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 0px">
                                <table class="table footable table-bordered table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>PLANTILLA</th>
                                            <th style="width: 60%">CONTENIDO</th>
                                            <th style="width: 10%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($Gestion as $value) {$i++;?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$value['plantilla_nombre']?></td>
                                            <td><?=$value['contenido_datos']?></td>
                                            <td>
                                                <i class="fa fa-pencil sigh-color i-20 pointer" onclick="AbrirVista(base_url+'Sections/Plantillas/AgregarContenido?con=<?=$value['contenido_id']?>&a=edit&plantilla=<?=$this->uri->segment(4)?>')"></i>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 pointer eliminar-contenido" data-id="<?=$value['contenido_id']?>"></i>&nbsp;&nbsp;

                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="5" class="text-center">
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
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Plantillas.js?').md5(microtime())?>" type="text/javascript"></script>