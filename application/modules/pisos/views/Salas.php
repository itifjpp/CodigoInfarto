<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b>Gestión de salas para el piso :</b> <?=$info['piso_nombre']?></span>
                        <a href="#" target="_blank" md-ink-ripple="" data-piso="<?=$this->uri->segment(3)?>" data-accion="add" data-sala="" data-id="0" class="md-btn btn-add-sala md-fab m-b green waves-effect pull-right">
                            <i class="fa fa-plus i-24"></i>
                        </a>
                    </div>
                    <div class="panel-body b-b b-light">
                        
                        <table class="table table-bordered table-hover footable"  data-filter="#filter" data-page-size="15">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Sala</th>
                                    <th>Total Camas Asignadas</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['sala_id']?>" >
                                    <td><?=$value['sala_id']?> </td>
                                    <td><?=$value['sala_nombre']?></td>
                                    <td><?= Modules::run('Pisos/TotaCamasAsignadas',array('sala_id'=>$value['sala_id']))?> Camas</td>
                                    <td class="text-center ">
                                        <a href="<?=  base_url()?>Pisos/AsignarCamas/<?=$value['sala_id']?>/?piso_id=<?=$this->uri->segment(3)?>" target="_blank">
                                            <i class="fa fa-plus-circle icono-accion tip" data-original-title="Asignar Camas"></i>
                                        </a>&nbsp;
                                        <i class="fa fa-pencil icono-accion pointer btn-add-sala" data-piso="<?=$this->uri->segment(3)?>" data-accion="edit" data-sala="<?=$value['sala_nombre']?>" data-id="<?=$value['sala_id']?>"></i>&nbsp;
                                        <i class="fa fa-trash-o icono-accion pointer" style="opacity: 0.4"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Pisos.js?'). md5(microtime())?>" type="text/javascript"></script>