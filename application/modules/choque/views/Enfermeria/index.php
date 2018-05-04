<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row"> 
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">ENFERMERÍA CHOQUE</h4>
                        <a href="<?=  base_url()?>Choque/EnfermeriaCamas" style="position: absolute;top: 5px;right: 25px" class="btn sigh-background-primary tip" data-original-title="Gestión y Asignación de Camas">
                            <i class="fa fa-bed color-white i-24"></i>
                        </a>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group ">
                                    <span class="input-group-addon sigh-background-primary no-border">
                                        <i class="fa fa-search-plus"></i>
                                    </span>
                                    <input type="text" id="filter_medico_choque" class="form-control" placeholder="Buscar paciente...">
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#filter_medico_choque" style="font-size: 13px">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">TIPO PAC.</th>
                                            <th style="width: 30%">NOMBRE/PSEUDONIMO</th>
                                            <th>RFC</th>
                                            <th>INGRESO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td class="text-uppercase"><?=$value['ingreso_tipopaciente']?></td>
                                            <td class="text-uppercase"><?=$value['paciente_nombre']=='' ? $value['paciente_pseudonimo'] : $value['paciente_nombre'].' '.$value['paciente_ap'].' '.$value['paciente_am']?> </td>
                                            <td>
                                                <?=$value['paciente_nss_armado']!='' ? '<b style="color:#F44336">ARMADO:</b> '.$value['paciente_nss_armado'].'<br>': ''?>
                                                <?=$value['paciente_nss']!='' ? '<b>NSS:</b> '.$value['paciente_nss'].' '.$value['paciente_nss_agregado']: ''?>
                                            </td>
                                            <td><?=$value['ingreso_date_enfermera']?> <?=$value['ingreso_time_enfermera']?></td>
                                            <td class="text-center">
                                                <?php if($value['cama_id']==''){?>
                                                <a href="<?= base_url()?>Choque/EnfermeriaCamas?folio=<?=$value['triage_id']?>" >
                                                    <i class="fa fa-bed sigh-color i-20 tip" data-original-title="Asignar Cama"></i>
                                                </a>
                                                <i class="fa fa-share-square-o sigh-color i-20 tip pointer alta-paciente-choque-ne" data-original-title="Alta paciente por motivo no especificado" data-id="<?=$value['triage_id']?>"></i>
                                                <?php }else{?>
                                                <a href="<?= base_url()?>Choque/EnfermeriaCamas?folio=<?=$value['ingreso_id']?>">
                                                    <?= Modules::run('Choque/InformacionCama',array('cama_id'=>$value['cama_id']))?>
                                                </a>
                                                <?php }?>

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
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Choque.js?').md5(microtime())?>" type="text/javascript"></script>