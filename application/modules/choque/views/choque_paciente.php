<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INGRESO DE PACIENTE A CHOQUE</h4>
                        <a href="<?=  base_url()?>Choque" class="md-btn md-fab m-b red pull-left" style="margin-top: -18px;margin-left: -60px">
                            <i class="fa fa-arrow-left i-24 color-white" style="vertical-align: -5px"></i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <form class="form-choque-nuevo-pac">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <select class="width100" id="triage_tipo_paciente" name="ingreso_tipopaciente">
                                            <option value="">SELECCIONAR...</option>
                                            <option value="Identificado" selected="">IDENTIFICADO</option>
                                            <option value="No Identificado">NO IDENTIFICADO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group form-identificado">
                                        <label>CUENTA CON  N.S.S/R.F:C</label>&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="paciente_nss_bol" value="Si" checked="" class="has-value">
                                            <i class="blue"></i>Si
                                        </label>&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="paciente_nss_bol" value="No"  class="has-value">
                                            <i class="blue"></i>No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-identificado-nss" >
                                        <input name="paciente_nss" type="text" placeholder="INGRESAR NSS/RFC" class="form-control">
                                        <span class="input-group-addon hide back-imss border-back-imss search-nss-pac-choque pointer">BUSCAR</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-identificado-nss " >
                                        <input name="paciente_nss_agregado" type="text" placeholder="NSS AGREGADO" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-loading-nss-choque hide">
                                    <center><i class="fa fa-spinner fa-pulse"></i><h6>BUSCANDO NSS PACIENTE...</h6></center>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group form-identificado">
                                        <label>PROCEDENCIA ESPONTANEA</label>&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="info_procedencia_esp" value="Si" checked="">
                                            <i class="blue"></i>Si
                                        </label>&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="info_procedencia_esp" value="No" class="has-value">
                                            <i class="blue"></i>No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group form-espontaneo form-no-identificado ">
                                        <input name="info_procedencia_esp_lugar" type="text" placeholder="LUGAR DE PROCEDENCIA" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-no-espontanea hide">
                                        <select name="info_procedencia_hospital" class="width100">
                                            <option value="">SELECCIONAR...</option>
                                            <option value="UMF">UMF</option>
                                            <option value="HGZ">HGZ</option>
                                            <option value="CMF">CMF</option>
                                            <option value="OTRA UNIDAD MÉDICA DE LA INSTITUCIÓN">OTRA UNIDAD MÉDICA DE LA INSTITUCIÓN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-no-espontanea hide">
                                        <input name="info_procedencia_hospital_num" type="text" placeholder="NOMBRE/NUMERO DEL HOSPITAL" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12"></div>
                                <div class="col-xs-4">
                                    <div class="form-group form-identificado">
                                        <input name="paciente_ap" type="text" placeholder="APELLIDO PATERNO" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group form-identificado">
                                        <input name="paciente_am" type="text" placeholder="APELLIDO MATERNO" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group form-identificado">
                                        <input name="paciente_nombre" type="text" placeholder="NOMBRE DEL PACIENTE" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group form-no-identificado  hide">
                                        <input name="paciente_nombre_pseudonimo" type="text" placeholder="PSEUDONIMO DEL PACIENTE" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-no-paciente">
                                        <select class="width100" name="paciente_sexo" required="">
                                            <option value="">SELECCIONAR SEXO</option>
                                            <option value="HOMBRE">HOMBRE</option>
                                            <option value="MUJER">MUJER</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group form-no-identificado hide">
                                        <input name="paciente_fna" type="text" placeholder="AÑO DE NAC. EJEMPLO:2015" class="form-control ">
                                    </div>
                                    <div class="form-group form-identificado ">
                                        <input type="text" name="paciente_fn" class="form-control dp-yyyy-mm-dd" placeholder="FECHA DE NACIMIENTO">
                                    </div>
                                </div>
                                <div class="col-xs-offset-8 col-xs-4">

                                    <input type="hidden" name="paciente_curp">
                                    <input type="hidden" name="info_umf">
                                    <input type="hidden" name="info_delegacion">
                                    <input type="hidden" name="inputGetInfoChoque" value="Si">
                                    <button class="btn sigh-background-secundary btn-block">GUARDAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Choque.js?'). md5(microtime())?>" type="text/javascript"></script>