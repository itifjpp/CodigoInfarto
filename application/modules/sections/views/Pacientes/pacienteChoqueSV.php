<?=Modules::run('Sections/Menu/HeaderBasico')?> 
<div class="box-row">
    <style>hr.style-eight {border: 0;border-top: 4px double #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);font-weight: bold;display: inline-block;position: relative;top: -0.7em;font-size: 1.2em;padding: 0 0.20em;background: white;}</style>
    <div class="box-cell">
        <div class="box-inner padding col-md-9 col-centered"> 
            <div class="panel panel-default " style="margin-top: 20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>SIGNOS VITALES</strong><br>
                    </span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#filter_medico_choque" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>T.A</th>
                                        <th>TEMP</th>
                                        <th>F.C</th>
                                        <th>F.R</th>
                                        <th>Fecha</th>
                                        <th>Enfermera</th>
                                        <th class="hide">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td ><?=$value['triage_tension_arterial']?></td>
                                        <td><?=$value['triage_temperatura']?> °C</td>
                                        <td><?=$value['triage_frecuencia_cardiaco']?> X Min</td>
                                        <td><?=$value['triage_frecuencia_respiratoria']?> X Min</td>
                                        <td><?=$value['sv_fecha']?> <?=$value['sv_hora']?></td>
                                        <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                        <td class="hide">
                                            <i class="fa fa-pencil icono-accion pointer" style="opacity: 0.4"></i>&nbsp;
                                            <i class="fa fa-trash-o icono-accion pointer" style="opacity: 0.4"></i>&nbsp;
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="8" class="text-center">
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
<?=Modules::run('Sections/Menu/FooterBasico')?> 