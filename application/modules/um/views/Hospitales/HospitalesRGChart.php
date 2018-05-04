<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                
                <div class="panel-body b-b b-light" style="padding: 0px;margin-top: -2px">
                    <div class="row">
                        <div class="col-md-12 col-datas-charts">
                        <?php
                        $sql1=$this->config_mdl->sqlGetData('um_hospitales');
                        
                        foreach ($sql1 as $value) {
                            $Hospital=$value['hospital_id'];
                            $Fecha=base64_decode($_GET['inputFecha']);
                            $sql2=$this->config_mdl->sqlQuery("SELECT * FROM um_hospitales_status WHERE 
                                                        um_hospitales_status.status_fecha='$Fecha' AND
                                                        um_hospitales_status.hospital_id=$Hospital");
                            $TCamasM=0;
                            $TCamasT=0;
                            $TCamasN=0;
                            $TNoDhM=0;
                            $TNoDhT=0;
                            $TNoDhN=0;
                            $TDefSismoM=0;
                            $TDefSismoT=0;
                            $TDefSismoN=0;
                            $TCOM=0;
                            $TCOT=0;
                            $TCON=0;
                            $TEgresosM=0;
                            $TEgresosT=0;
                            $TEgresosN=0;
                            foreach ($sql2 as $value_s1) {
                                if($value_s1['status_hora']=='08:00'){
                                    $TCamasM=$value_s1['s1_camas_hospitalacion'];
                                    $TNoDhM=$value_s1['s2_noderechohabiente'];
                                    $TDefSismoM=$value_s1['s3_defunciones_si_sismo'];
                                    $TCOM=$value_s1['s5_camas_ocupadas'];
                                    $TEgresosM=$value_s1['s6_egreso_total'];
                                }else if($value_s1['status_hora']=='15:00'){
                                    $TCamasT=$value_s1['s1_camas_hospitalacion'];
                                    $TNoDhT=$value_s1['s2_noderechohabiente'];
                                    $TDefSismoT=$value_s1['s3_defunciones_si_sismo'];
                                    $TCOT=$value_s1['s5_camas_ocupadas'];
                                    $TEgresosT=$value_s1['s6_egreso_total'];
                                }if($value_s1['status_hora']=='21:00'){
                                    $TCamasN=$value_s1['s1_camas_hospitalacion'];
                                    $TNoDhN=$value_s1['s2_noderechohabiente'];
                                    $TDefSismoN=$value_s1['s3_defunciones_si_sismo'];
                                    $TCON=$value_s1['s5_camas_ocupadas'];
                                    $TEgresosN=$value_s1['s6_egreso_total'];
                                }
                            }
                            echo '<span class="span-camas" data-hospital="'.$value['hospital_nombre'].'" data-m="'.$TCamasM.'" data-t="'.$TCamasT.'" data-n="'.$TCamasN.'"></span>';
                            echo '<span class="span-no-dh" data-hospital="'.$value['hospital_nombre'].'" data-m="'.$TNoDhM.'" data-t="'.$TNoDhT.'" data-n="'.$TNoDhN.'"></span>';
                            echo '<span class="span-defunciones-sismo" data-hospital="'.$value['hospital_nombre'].'" data-m="'.$TDefSismoM.'" data-t="'.$TDefSismoT.'" data-n="'.$TDefSismoN.'"></span>';
                            echo '<span class="span-camas-ocupadas" data-hospital="'.$value['hospital_nombre'].'" data-m="'.$TCOM.'" data-t="'.$TCOT.'" data-n="'.$TCON.'"></span>';
                            echo '<span class="span-egresos-pacientes" data-hospital="'.$value['hospital_nombre'].'" data-m="'.$TEgresosM.'" data-t="'.$TEgresosT.'" data-n="'.$TEgresosN.'"></span>';
                        }
                        ?>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>TOTAL DE CAMAS</h5>
                            </div>
                            <canvas id="ChartCamasTotales" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>ADMISIÓN DE PACIENTES RELACIONADOS AL SISMO NO DH</h5>
                            </div>
                            <canvas id="ChartNoDh" style="height: 250px"></canvas>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>DEFUNCIONES RELACIONADOS CON EL SISMO</h5>
                            </div>
                            <canvas id="ChartDefuncionesSismo" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>CAMAS OCUPADAS</h5>
                            </div>
                            <canvas id="ChartCamasOcupadas" style="height: 250px"></canvas>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>EGRESOS DE PACIENTES ESPECIFICANDO DESTINO</h5>
                            </div>
                            <canvas id="ChartEgresosPacientes" style="height: 150px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<input type="hidden" name="ShowChartsAll" value="Si">
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/UmHospitales.js?<?= md5(microtime())?>"></script>


