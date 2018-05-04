<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">INDICADORES DE PRODUCTIVIDAD</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row" >
                            <div class="col-md-3 text-center text-uppercase" >
                                <a href="<?= base_url()?>Urgencias/Graficas/Indicador/Triage">
                                    <i class="fa fa-heartbeat fa-4x" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>"></i>
                                    <h3 class="semi-bold">Triage</h3>
                                </a>
                            </div>
                            <div class="col-md-3 text-center text-uppercase" style="border-left: 2px solid #256659">
                                <a href="<?= base_url()?>Urgencias/Graficas/Indicador/Consultorios">
                                    <i class="fa fa-trello fa-4x" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>"></i>
                                    <h3 class="semi-bold">Consultorios</h3>
                                </a>
                            </div>
                            <div class="col-md-3 text-center text-uppercase" style="border-left:2px solid">
                                <a href="<?= base_url()?>Urgencias/Graficas/Indicador/Observacion">
                                    <i class="fa fa-user-md fa-4x" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>"></i>
                                    <h3 class="semi-bold">Observación</h3>
                                </a>
                            </div>
                            <div class="col-md-3 text-center text-uppercase" style="border-left: 2px solid #256659;opacity: 0.5">
                                <a href="#">
                                    <i class="fa fa-hospital-o fa-4x" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>"></i>
                                    <h3 class="semi-bold">Pisos</h3>
                                </a>
                            </div>

                        </div>   
                        <div class="row">
                            <hr>
                            <div class="col-md-3 text-center text-uppercase" style="margin-top: 10px;opacity: 0.5">
                                <a href="#">
                                    <i class="fa fa-ambulance fa-4x" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>"></i>
                                    <h3 style="margin-top: 5px"><b>Choque</b></h3>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>    
            </div>
            
            
        </div>
    </div>
</div>
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Urgencias.js?<?= md5(microtime())?>"></script>

