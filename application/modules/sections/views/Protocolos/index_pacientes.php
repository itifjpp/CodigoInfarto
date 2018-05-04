<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin text-uppercase">PACIENTES AGREGADOS A ESTE PROTOCOLO</h4>
                        <a href="<?= base_url()?>Sections/Protocolos/BuscarPacientes?protocolo=<?=$_GET['protocolo']?>" class="btn btn-circle red btn-60 pull-right">
                            <i class="material-icons color-white i-24" >library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        
                        <div class="row">

                            <div class="col-md-12">
                                <h6 class="inputSelectNombre hide" style="color: red;margin-top: -10px"><i class="fa fa-warning"></i> ESTA CONSULTA ESTA LIMITADA A: 100 REGISTROS</h6>
                                <table class="footable table table-bordered table-no-padding" id="tableResultSearch" data-filter="#search" data-page-size="20" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th data-sort-ignore="true" style="width: 5%">N°</th>
                                            <th data-sort-ignore="true" style="width: 60%">PACIENTE</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($Gestion as $value) { $i++;?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                            <td>
                                                <a href="<?= base_url()?>Sections/Protocolos/Chat?emp=<?=$value['empleado_id']?>&prot=<?=$value['protocolo_id']?>">
                                                    <i class="fa fa-commenting-o sigh-color i-20"></i>
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