<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        Productividad por usuarios:<br>
                        <b>Total:</b> <?=  count($Gestion)?>&nbsp;&nbsp;&nbsp;
                        <b>Usuario :</b> <?=$Gestion[0]['empleado_nombre']?> <?=$Gestion[0]['empleado_ap']?> <?=$Gestion[0]['empleado_am']?>&nbsp;&nbsp;&nbsp;
                        <b>Turno :</b> <?=$_GET['turno']?>&nbsp;&nbsp;&nbsp;
                        <b>Fecha :</b> <?=$_GET['fecha']?>
                        
                        <br>
                    </span>
                    
                </div>
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                    <thead>
                        <tr>
                            <th >N° Folio</th>
                            <th data-hide="phone">Paciente</th>
                            <th data-hide="phone">Fecha y Hora</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['empleado_id']?>">
                            <td><?=$value['triage_id']?></td>
                            <td><?=$value['triage_nombre']=='' ? 'Datos no capturados' : $value['triage_nombre'].' '.$value['triage_nombre_ap'].' '.$value['triage_nombre_am'] ?> </td>
                            <td><?=$value['acceso_fecha']?> <?=$value['acceso_hora']?></td>
                            <td>
                                <a href="<?=  base_url()?>inicio/pacientes/paciente?folio=<?=$value['triage_id']?>" target="_blank">
                                    <i class=" fa fa-share-square-o icono-accion tip" data-original-title="Seguimiento del paciente"></i>
                                </a>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/usuario.js')?>" type="text/javascript"></script>