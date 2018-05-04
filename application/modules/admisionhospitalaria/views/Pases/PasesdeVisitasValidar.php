<?= modules::run('Sections/Menu/HeaderBasico'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered " style="margin-top: 10px">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">VALIDAR DATOS DEL PASE DE VISITA</span>
                    </div>
                    <?php 
                        if($_GET['tipo']=='Pisos'){
                            $sqlIngresoPisos= $this->config_mdl->sqlGetDataCondition('os_areas_pacientes',array(
                                'triage_id'=>$_GET['folio']
                            ));
                            if(empty($sqlIngresoPisos)){
                                $Pisos= $this->config_mdl->_query("SELECT * FROM doc_43051 , os_camas, os_pisos, os_pisos_camas, os_areas WHERE
                                                                                os_areas.area_id=os_camas.area_id AND
                                                                                doc_43051.cama_id=os_camas.cama_id AND
                                                                                os_pisos.piso_id=os_pisos_camas.piso_id AND
                                                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                                                doc_43051.triage_id=".$_GET['folio'])[0];
                            }else{
                                $Pisos= $this->config_mdl->_query("SELECT * FROM os_areas_pacientes , os_camas, os_pisos, os_pisos_camas, os_areas WHERE
                                                                                os_areas.area_id=os_camas.area_id AND
                                                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                                                os_pisos.piso_id=os_pisos_camas.piso_id AND
                                                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                                                os_areas_pacientes.triage_id=".$_GET['folio'])[0];
                            }
                        }
                        ?>
                    <div class="panel-body b-b b-light">
                        <form class="form-validar-pase-visita">
                            <div class="row">
                                <?php if($_GET['tipo']=='Pisos'){ ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="mayus-bold">PISO</label>
                                        <input type="text" name="pv_piso" value="<?=$Pisos['piso_nombre']?>" class="form-control">
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="mayus-bold">SERVICIO</label>
                                        <input type="text" name="pv_servicio" value="<?=$Cama['area_nombre']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="mayus-bold">CAMA</label>
                                        <input type="text" name="pv_cama" value="<?=$Cama['cama_nombre']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="mayus-bold">HORARIO DE VISITA</label>
                                        <input type="text" name="pv_horario" value="<?=$Cama['area_horario_visita']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                    <input type="hidden" name="tipo" value="<?=$_GET['tipo']?>">
                                    <input type="hidden" name="csrf_token">
                                    <button class="btn back-imss pull-right">GUARDAR E IMPRIMIR</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>