<?= modules::run('Sections/Menu/index'); ?> 
<style>
    .opacity-element{
        opacity: 0.4;
    }
</style>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$this->UMAE_AREA?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <h5 style="line-height: 1.6">
                                        <b>PACIENTE: </b><?=$info['triage_nombre']?> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?><br>
                                        <b>N.S.S: </b><?=$info['triage_paciente_afiliacion']?><br>
                                        <b>SEXO: </b><?=$info['triage_paciente_sexo']?><br>
                                        <b>LUGAR DEL ACCIDENTE: </b><?=$info['triage_paciente_accidente_lugar']?><br>
                                        <b>PROCEDENCIA: </b><?=$info['triage_procedencia']?><br>
                                        <b>PROCEDENCIA ACCIDENTE: </b><?=$info['triage_paciente_accidente_procedencia']?>
                                    </h5>
                                    <hr>
                                    <h5><b>INGRESO A QUIROFANO : </b><?= str_replace('-', '/', $quirofono['qp_iq_f'])?> <?=$quirofono['qp_iq_h']?></h5><br><br>
                                    <?php if($quirofono['qp_as_f']!=''){?>
                                    <h2 class="text-center" style="margin-bottom: -18px"><?=$sala['quirofano_nombre']?></h2>
                                    <hr>
                                    <h4 class="text-center" style="margin-top: -10px"><b>SALA ASIGNADA</b></h4>
                                    <?php }?>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-list md-whiteframe-z0 bg-white m-b">
                                        <div class="md-list-item">
                                            <div class="md-list-item-left circle green pointer <?=$quirofono['qp_as_f']=='' ? 'qp-ingreso-sala opacity-element' : ''?> " data-id="<?=$info['triage_id']?>">
                                                <i class="fa fa-trello i-24"></i>
                                            </div>
                                            <div class="md-list-item-content">
                                                <h3 class="text-md">INGRESO A SALA</h3>
                                                <small class="font-thin"><?=$quirofono['qp_as_f']=='' ? '<i class="fa fa-hourglass-end"></i>' : '<i class="fa fa-clock-o"></i> '.$quirofono['qp_as_f'].' '.$quirofono['qp_as_h']?> </small>
                                            </div>
                                        </div>
                                        <div class="md-list-item">
                                            <div class="md-list-item-left circle orange-800 pointer <?=$quirofono['qp_ia_f']=='' ? 'qp-inicia-anestesia opacity-element' : ''?> " data-qp="<?=$quirofono['qp_id']?>" data-id="<?=$info['triage_id']?>">
                                                <i class="fa fa-heartbeat i-24"></i>
                                            </div>
                                            <div class="md-list-item-content">
                                                <h3 class="text-md">INICIA ANESTESIA</h3>
                                                <small class="font-thin"><?=$quirofono['qp_ia_f']=='' ? '<i class="fa fa-hourglass-end"></i>' : '<i class="fa fa-clock-o"></i> '.$quirofono['qp_ia_f'].' '.$quirofono['qp_ia_h']?> </small>
                                            </div>
                                        </div>
                                        <div class="md-list-item">
                                            <div class="md-list-item-left circle red pointer <?=$quirofono['qp_ip_f']=='' ? 'qp-inicia-procedimiento opacity-element' : ''?> " data-qp="<?=$quirofono['qp_id']?>" data-id="<?=$info['triage_id']?>">
                                                <i class="fa fa-clock-o i-24"></i>
                                            </div>
                                            <div class="md-list-item-content">
                                                <h3 class="text-md">INICIA PROCEDIMIENTO</h3>
                                                <small class="font-thin"><?=$quirofono['qp_ip_f']=='' ? '<i class="fa fa-hourglass-end"></i>' : '<i class="fa fa-clock-o"></i> '.$quirofono['qp_ip_f'].' '.$quirofono['qp_ip_h']?></small>
                                            </div>
                                        </div>
                                        <div class="md-list-item">
                                            <div class="md-list-item-left circle back-imss pointer <?=$quirofono['qp_tp_f']=='' ? 'qp-termina-procedimiento opacity-element' : ''?> " data-qp="<?=$quirofono['qp_id']?>" data-id="<?=$info['triage_id']?>">
                                                <i class="fa fa-stop i-24"></i>
                                            </div>
                                            <div class="md-list-item-content">
                                                <h3 class="text-md">TERMINA PROCEDIMIENTO</h3>
                                                <small class="font-thin"><?=$quirofono['qp_tp_f']=='' ? '<i class="fa fa-hourglass-end"></i>' : '<i class="fa fa-clock-o"></i> '.$quirofono['qp_tp_f'].' '.$quirofono['qp_tp_h']?></small>
                                            </div>
                                        </div>
                                        <div class="md-list-item">
                                            <div class="md-list-item-left circle green pointer <?=$quirofono['qp_es_f']=='' ? 'qp-egreso-sala opacity-element' : ''?> " data-qp="<?=$quirofono['qp_id']?>" data-id="<?=$info['triage_id']?>">
                                                <i class="fa fa-sign-out i-24"></i>
                                            </div>
                                            <div class="md-list-item-content">
                                                <h3 class="text-md">EGRESA SALA</h3>
                                                <small class="font-thin"><?=$quirofono['qp_es_f']=='' ? '<i class="fa fa-hourglass-end"></i>' : '<i class="fa fa-clock-o"></i> '.$quirofono['qp_es_f'].' '.$quirofono['qp_es_h']?></small>
                                            </div>
                                        </div>
                                        <div class="md-list-item">
                                            <div class="md-list-item-left circle green pointer <?=$quirofono['qp_ta_f']=='' ? 'qp-termina-anestesia opacity-element' : ''?> " data-qp="<?=$quirofono['qp_id']?>" data-id="<?=$info['triage_id']?>">
                                                <i class="fa fa-heart-o i-24"></i>
                                            </div>
                                            <div class="md-list-item-content">
                                                <h3 class="text-md">TERMINA ANESTESIA</h3>
                                                <small class="font-thin"><?=$quirofono['qp_ta_f']=='' ? '<i class="fa fa-hourglass-end"></i>' : '<i class="fa fa-clock-o"></i> '.$quirofono['qp_ta_f'].' '.$quirofono['qp_ta_h']?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Quirofano.js?'). md5(microtime())?>" type="text/javascript"></script>