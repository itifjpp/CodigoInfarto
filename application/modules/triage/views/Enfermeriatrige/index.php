<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">Procedimiento para la clasificación de pacientes</h4>
                        
                    </div>
                    <div class="grid-body">
                        <?php if(SiGH_ENFERMERIA_HORACERO=='Si'){?>
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="text-center m-t-20"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?></h3>
                                <h4 class="text-center"><?=$this->sigh->getInfo('hospital_nombre')?></h4>
                            </div>
                            <div class="col-md-4">
                                <a href="" class="btn sigh-background-secundary pull-right tip btn-horacero-enfermeria" style="width: 100px;height: 100px;padding: 15px">
                                    <i class="material-icons fa-5x color-white" >person_add</i>
                                </a>
                            </div>
                        </div>
                        <?php }?>
                        <div class="row m-t-20">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="number" id="input_search" minlength="0" class="form-control" placeholder="INGRESAR N° DE FOLIO PARA BUSCAR UN PACIENTE">
                                </div>
                            </div>
                            <div class="col-md-12" >
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="SiGH_ENFERMERIA_HORACERO" value="<?=SiGH_ENFERMERIA_HORACERO?>">
<input type="hidden" name="TriageArea" value="<?=$this->UMAE_AREA?>">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Enfermeriatriage.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js')?>" type="text/javascript"></script>