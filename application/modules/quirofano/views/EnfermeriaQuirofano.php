<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$this->UMAE_AREA?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-user-plus"></i></span>
                                <input type="text" class="form-control" name="triage_id_eq" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered footable">
                                <thead>
                                    <tr>
                                        <th>N.S.S</th>
                                        <th>NOMBRE</th>
                                        <th>INGRESO </th>
                                        <th>ESTATUS</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_paciente_afiliacion']?></td>
                                        <td><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                                        <td><?=$value['qp_iq_f']?> <?=$value['qp_iq_h']?></td>
                                        <td><?=$value['qp_status']?></td>
                                        <td>
                                            <a href="<?= base_url()?>Quirofano/Enfermeria/Paciente/<?=$value['triage_id']?>" target="_blank">
                                                <i class="fa fa-medkit icono-accion"></i>
                                            </a>
                                            <?php if($value['qp_status']=='Termina Anestesia Quirófano'){?>
                                            &nbsp;
                                            <i class="fa fa-share-square-o icono-accion qp-egreso-quirofano pointer" data-qp="<?=$value['qp_id']?>" data-sala="<?=$value['quirofano_id']?>" data-id="<?=$value['triage_id']?>"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </tanle>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Quirofano.js?'). md5(microtime())?>" type="text/javascript"></script>