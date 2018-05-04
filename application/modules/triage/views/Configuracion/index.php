<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row" >   
            <div class="col-md-10 col-centered">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">CONFIGURACIÓN HORA CERO, ENFERMERIA & MÉDICO TRIAGE</h4>

                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h5 class="m-b-5 m-t-5 semi-bold">CONFIGURACIÓN HORA CERO & TRIAGE ENFERMERIA</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="md-check mayus-bold">
                                    <input type="radio" class="save-config-um" name="ConfigEnfermeriaHC" data-id="1" value="No" data-value="<?=$this->ConfigEnfermeriaHC?>">
                                    <i class="blue"></i>Enfermería Triage
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="md-check mayus-bold">
                                    <input type="radio" class="save-config-um" name="ConfigEnfermeriaHC" data-id="1" value="Si" checked="" >
                                    <i class="blue"></i>Enfermería Triage & HC
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h5 class="m-b-5 m-t-10 semi-bold">CONFIGURACIÓN TRIAGE ENFERMERIA</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="md-check mayus-bold">
                                    <input type="radio" class="save-config-um" name="ConfigSolicitarOD" data-id="2" value="Si" data-value="<?=$this->ConfigSolicitarOD?>">
                                    <i class="blue"></i>Solicitar Oximetría & Dextrostix
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="md-check mayus-bold">
                                    <input type="radio" class="save-config-um" name="ConfigSolicitarOD" data-id="2" value="No" checked="" >
                                    <i class="blue"></i>No Solicitar Oximetría & Dextrostix
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h5 class="m-b-5 m-t-20 semi-bold">CONFIGURACIÓN TRIAGE MÉDICO</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigDestinosMT" data-id="3" value="Si" checked="" data-value="<?=$this->ConfigDestinosMT?>">
                                        <i class="blue"></i>Habilitar Destinos Triage Médico
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigDestinosMT" data-id="3" value="No" >
                                        <i class="blue"></i>No Habilitar Destinos Triage Médico
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigDestinosOAC" data-id="4" checked="" value="Si" data-value="<?=$this->ConfigDestinosOAC?>">
                                        <i class="blue"></i>Habilitar Destino Ortopedia-Admisión Continua
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="ConfigDestinosOAC" data-id="4" value="No" >
                                        <i class="blue"></i>No Habilitar Destino Ortopedia-Admisión Continua
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="ConfigExcepcionCMT" data-id="5" data-value="<?=$this->ConfigExcepcionCMT?>" value="Si" >
                                        <i class="blue"></i>Habilitar Excepcion Hoja Clasificación
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold destino">
                                        <input type="radio" class="save-config-um" name="ConfigExcepcionCMT" data-id="5" value="No" >
                                        <i class="blue"></i>No Habilitar Excepcion Hoja Clasificación
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                    <h5 class="m-b-5 m-t-20 semi-bold">CONFIGURACIÓN DE CLASIFICACIÓN MÉDICO TRIAGE</h5>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding">
                                    <thead>
                                        <tr>
                                            <th style="width: 22%">COLOR CLASIFICACIÓN</th>
                                            <th style="width: 20%">DESCRIPCIÓN</th>
                                            <th style="width: 30%">TIEMPO</th>
                                            <th>TIEMPO MIN/MAX</th>
                                            <th style="width: 10%">ACCIÓN</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Clasificacion as $value) {?>
                                        <tr>
                                            <td>
                                                <span class="label <?=$value['clasificacion_class']?>"><?=$value['clasificacion_color']?></span>
                                            </td>
                                            <td><?=$value['clasificacion_descripcion']?></td>
                                            <td><?=$value['clasificacion_tiempo']?></td>
                                            <td><?=$value['clasificacion_min']?> - <?=$value['clasificacion_max']?></td>
                                            <td class="text-center">
                                                <i class="fa fa-pencil sigh-color i-20 pointer setting-clasi-edit" data-id="<?=$value['clasificacion_id']?>" data-tiempo="<?=$value['clasificacion_tiempo']?>" data-max="<?=$value['clasificacion_min']?>" data-min="<?=$value['clasificacion_max']?>"></i>
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
<script src="<?= base_url('assets/js/sections/Configuracion.js?'). md5(microtime())?>" type="text/javascript"></script>