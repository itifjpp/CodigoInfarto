<?= Modules::run('Sections/Menu/loadHeaderBasico')?>

<div class="row m-t-10" >
    <div class=" col-md-12">
        <div class="grid simple">
            <div class="grid-title">
                <div class="row">
                    <div class="col-xs-1">
                        <img src="<?= base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" style="width: 100%">
                    </div>
                    <div class="col-xs-9 text-center">
                        <h3 class="no-margin semi-bold"><?=$this->sigh->getInfo('hospital_siglas_des')?></h3>
                        <h3 class="no-margin"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></h3>
                    </div>
                </div>
            </div>
            <div class="grid-body">
                <div class="row row-ListaEsperaConsultorios" style="margin-top: -20px">
                    <div class="col-md-12">
                        <h5 class="text-center no-margin"><i class="fa fa-spinner fa-pulse fa-2x"></i></h5>
                        <h4 class="text-center">Obteniendo lista de pacientes en espera de ingreso a consultorios...</h4>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="ListaEsperaConsultorios" value="Si">
<?= Modules::run('Sections/Menu/loadFooterBasico')?>
<script src="<?=  base_url()?>assets/js/sections/Listas.js?<?= md5(microtime())?>" type="text/javascript"></script> 