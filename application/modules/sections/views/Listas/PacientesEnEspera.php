<?= Modules::run('Sections/Menu/loadHeaderBasico')?>

<div class="row m-t-60" style="margin-left: -100px;margin-right: -100px">
    <div class=" col-xs-12">
        <div class="grid simple">
            <div class="grid-title ">
                <div class="row">
                    <div class="col-xs-12 col-centered text-center">
                        <h2 class="no-margin semi-bold"><?=$this->sigh->getInfo('hospital_siglas_des')?></h2>
                        <h2 class="m-t-5"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></h2>
                    </div>
                </div>
            </div>
            <div class="grid-body">
                <div class="row no-margin">
                    <div class="col-xs-8" style="padding-left: 0px">
                        <h2 class="m-t-5 m-b-5 semi-bold text-left">REZAGO DE PACIENTES EN ESPERA PARA INGRESO A CE</h2>
                    </div>
                    <div class="col-xs-1 sigh-background-primary">
                        <h4 class="color-white text-center bold h4-le-total">0</h4>
                    </div>
                    <div class="col-xs-1 bg-yellow">
                        <h4 class="color-white text-center bold h4-turno-amarillo">0/0</h4>
                    </div>
                    <div class="col-xs-1 bg-green">
                        <h4 class="color-white text-center bold h4-turno-verde">0/0</h4>
                    </div>
                    <div class="col-xs-1 bg-blue">
                        <h4 class="color-white text-center bold h4-turno-azul">0/0</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 m-t-10">
                        <table class="table table-bordered table-hover table-no-padding lista-pacientes-espera footable table-striped" data-page-size="25">
                            <thead>
                                <tr>
                                    <th style="width: 10%" colspan="2">FOLIO INGRESO</th>
                                    <th style="width: 20%">PACIENTE</th>
                                    <th>SEXO</th>
                                    <th>EDAD</th>
                                    <th>ENFERMERA TRIAGE</th>
                                    <th>MEDICO TRIAGE</th>
                                    <th>CLASIFICACIÓN</th>
                                    <th>T. TRANSCURRIDO</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <ul class="pagination"></ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <a href="#" class="md-btn md-fab md-fab-top-right pos-fix teal sigh-background-primary" onclick="AbrirVista(base_url+'Inicio/Documentos/ReporteRezagoPacientes')">
                    <i class="material-icons i-24">cloud_download</i>
                </a>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="AjaxPacientesEnEspera" value="Si"> 
<?= Modules::run('Sections/Menu/loadFooterBasico')?>
<script src="<?= base_url()?>assetsv2/plugins/artyom.js-master/build/artyom.window.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/sections/Listas.js?<?= md5(microtime())?>" type="text/javascript"></script> 

