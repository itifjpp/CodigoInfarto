<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>PROCURACIÓN DE ORGANOS | BUSQUEDA ACTIVA</strong><br>
                    </span>
                    
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="filter_medico_choque" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#filter_medico_choque" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">NOMBRE/PSEUDONIMO</th>
                                        <th>N.S.S</th>
                                        <th>SEXO</th>
                                        <th>INGRESO</th>
                                        <th>ESTATUS</th>
                                        <th style="width:13%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td style="font-size: 10px"><?=$value['triage_nombre']=='' ? $value['triage_nombre_pseudonimo'] : $value['triage_nombre'].' '.$value['triage_nombre_ap'].' '.$value['triage_nombre_am']?> </td>
                                        <td>
                                            <?=$value['triage_paciente_afiliacion_armado']!='' ? '<b style="color:#F44336">ARMADO:</b> '.$value['triage_paciente_afiliacion_armado'].'<br>': ''?>
                                            <?=$value['triage_paciente_afiliacion']!='' ? '<b>NSS:</b> '.$value['triage_paciente_afiliacion']: ''?>
                                        </td>
                                        <td><?=$value['triage_paciente_sexo']?></td>
                                        <td><?=$value['triage_horacero_f']?> <?=$value['triage_horacero_h']?></td>
                                        <td>
                                            <?=$value['po_estatus']?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url()?>ProcuracionOrganos/PosibleDonador?folio=<?=$value['triage_id']?>" target="_blank">
                                                <i class="fa fa-share-square-o icono-accion"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/ProcuracionOrganos.js?').md5(microtime())?>" type="text/javascript"></script>