<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">   
            <div class="col-md-8 col-centered">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">CONFIGURACIÓN ASISTENTES MÉDICAS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="SiGH_ASISTENTESMEDICAS_HI" data-id="9" data-value="<?=SiGH_ASISTENTESMEDICAS_HI?>" value="Si" >
                                        <i class="blue"></i>Imprimir Hoja Inicial (AM)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="SiGH_ASISTENTESMEDICAS_HI" data-id="9" value="No" >
                                        <i class="blue"></i>NO Imprimir Hoja Inicial (AM)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="SiGH_ASISTENTESMEDICAS_ILT" data-id="12" value="Si" >
                                        <i class="blue"></i>Habilitar Interación Lugar Trabajo
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="SiGH_ASISTENTESMEDICAS_ILT" data-id="12" data-value="<?=SiGH_ASISTENTESMEDICAS_ILT?>" value="No" >
                                        <i class="blue"></i>Inhabilitar Interación Lugar Trabajo
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h5 class="m-b-5 m-t-5 semi-bold">VALIDACIÓN DE LA IDENTIFICACIÓN DEL PACIENTES</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="SiGH_VALIDACIONPACIENTE" data-id="14" value="POR RFC" >
                                        <i class="blue"></i>VALIDACIÓN POR RFC
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="SiGH_VALIDACIONPACIENTE" data-id="14" data-value="<?=SiGH_VALIDACIONPACIENTE?>" value="POR NSS" >
                                        <i class="blue"></i>VALIDACIÓN POR NSS
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>    
            </div> 
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Configuracion.js?'). md5(microtime())?>" type="text/javascript"></script>