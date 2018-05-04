<?=Modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INDICADOR DE PRODUCTIVIDAD</h4>           
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form class="form-obs-enfermeria">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon no-border sigh-background-secundary">
                                                <i class="fa fa-calendar-o"></i>
                                            </span>
                                            <input type="text" name="inputDateStart" required="" placeholder="FECHA DE INICIO" class="form-control dp-yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon no-border sigh-background-secundary">
                                                <i class="fa fa-calendar-o"></i>
                                            </span>
                                            <input type="text" name="inputDateEnd" required="" placeholder="FECHA DE TERMINO" class="form-control dp-yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon no-border sigh-background-secundary">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" name="inputMatricula" required="" placeholder="MATRICULA DEL USUARIO" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-block sigh-background-secundary">BUSCAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row obs-enfermeria-result">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <a href="#" class="obs-enfermeria-ingreso" data-tipo="Ingresos">
                                <div class="col-md-6 text-center">
                                    <h2>0 Pacientes</h2>
                                    <h5>TOTAl INGRESOS ENFERMERÍA OBSERVACIÓN</h5>
                                </div>
                            </a>
                            <a href="#" class="obs-enfermeria-egreso" data-tipo="Egresos">
                                <div class="col-md-6 text-center" style="border-left: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h2>0 Pacientes</h2>
                                    <h5>TOTAl EGRESOS ENFERMERÍA OBSERVACIÓN</h5>
                                </div>
                            </a>
                        </div>  
                    </div>
                </div>       
            </div>
        </div>
    </div>
</div>
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Observacion.js?'). md5(microtime())?>" type="text/javascript"></script>