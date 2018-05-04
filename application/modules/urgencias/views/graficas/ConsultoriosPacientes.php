<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        Productividad por usuarios:<br>
                        <b>Total:</b> <?=  count($Gestion)?>&nbsp;&nbsp;&nbsp;
                        <b>Usuario :</b> <?=$Gestion[0]['empleado_nombre']?> <?=$Gestion[0]['empleado_ap']?> <?=$Gestion[0]['empleado_am']?>&nbsp;&nbsp;&nbsp;
                        <b>Turno :</b> <?=Modules::run('Urgencias/Graficasfunctions/ObtenerTurno',array('turno'=>$this->input->get_post('turno')))?>&nbsp;&nbsp;&nbsp;
                        <b>Fecha :</b> <?=$_GET['fecha']?>
                        
                        <br>
                    </span>
                </div>
                <table class="table table-bordered table-hover footable " data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                    <thead>
                        <tr>
                            <th >Folio</th>
                            <th data-hide="phone" >Paciente</th>
                            <th data-hide="phone">Hora Cero</th>
                            <th data-hide="phone">Hora Consultorio</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $value):?>
                        <tr>
                            <td><?=$value['triage_id']?></td>
                            <td><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                            <td><?=$value['triage_horacero_f']?> <?=$value['triage_horacero_h']?></td>
                            <td><?=$value['ce_fe']?> <?=$value['ce_he']?></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-share-square-o icono-accion" style="opacity: 0.4"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
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
<script src="<?=  base_url()?>assets/js/Urgencias.js"></script>