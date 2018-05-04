<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        INDICADOR <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;
                        <?=$_GET['section']?> <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;
                        CONSULTAS USUARIOS <i class="fa fa-arrow-right"></i> PACIENTES<br>
                        
                    </span>
                </div>
                <input type="hidden" name="fecha" value="<?=$_GET['fecha']?>">
                <input type="hidden" name="turno" value="<?=$_GET['turno']?>">
                <input type="hidden" name="tipo" value="<?=$_GET['tipo']?>">
                <input type="hidden" name="usuarios_productiviad">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <b>USUARIO: </b><?=$Gestion[0]['empleado_nombre']?> <?=$Gestion[0]['empleado_ap']?> <?=$Gestion[0]['empleado_am']?> &nbsp;&nbsp;
                            <b>MATRICULA:</b> <?=$Gestion[0]['empleado_matricula']?>&nbsp;&nbsp;
                            <b>TOTAL PACIENTES: </b><?= count($Gestion)?> Pacientes
                        </div>
                        <div class="col-md-12">
                            <br>
                            <table class="table table-bordered table-hover footable" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Fecha y Hora</th>
                                        <th>Folio Paciente</th>
                                        <th>Nombre Paciente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td>
                                            <?=$value['acceso_tipo']?>
                                            <?=$_GET['tipo']=='Consultorios' ? '<br>'.$_GET['section'] :'' ?>
                                        </td>
                                        <td><?=$value['acceso_fecha']?> <?=$value['acceso_hora']?></td>
                                        <td><?=$value['triage_id']?></td>
                                        <td><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js"></script>