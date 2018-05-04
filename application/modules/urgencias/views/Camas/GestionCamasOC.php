<?=Modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="UrlCols">
                <?php 
                    $sql=$this->config_mdl->sqlQuery("SELECT c.*,a.area_id, t.triage_paciente_sexo FROM os_camas AS c, os_areas AS a, os_triage AS t WHERE 
                                                        c.area_id=a.area_id AND a.area_modulo IN ('Observación','Choque') AND
                                                        c.cama_status='Ocupado' AND c.cama_dh=t.triage_id AND c.cama_fh_estatus!=''  AND c.cama_display<=>NULL");
                    
                    $sql2=$this->config_mdl->sqlQuery("SELECT c.*,a.area_id FROM os_camas AS c, os_areas AS a WHERE 
                                                        c.area_id=a.area_id AND a.area_modulo IN ('Observación','Choque') AND
                                                        c.cama_status='Disponible' AND c.cama_display<=>NULL");
                    $THombresMin=0;
                    $THombresMax=0;
                    $TMujeresMin=0;
                    $TMujeresMax=0;
                    $TPediatriaMin=0;
                    $TPediatriaMax=0;
                    $ChoqueMin=0;
                    $ChoqueMax=0;
                    foreach ($sql as $value) { 
                        $Tiempo= Modules::run('Config/CalcularTiempoTranscurrido',array(
                            'Tiempo1'=>$value['cama_fh_estatus'],
                            'Tiempo2'=> date('Y-m-d H:i') 
                        ));
                        if($value['area_id']==3){//PEDIATRIA
                            if($Tiempo->d>0 || $Tiempo->h>12){
                                $THombresMax=$THombresMax+1;
                            }else{
                                $THombresMin=$THombresMin+1;
                            }
                        }if($value['area_id']==4){//MUJERES
                            if($Tiempo->d>0 || $Tiempo->h>12){
                                $TMujeresMax=$TMujeresMax+1;
                            }else{
                                $TMujeresMin=$TMujeresMin+1;
                            }                        
                        }if($value['area_id']==5){//HOMBRES
                            if($Tiempo->d>0 || $Tiempo->h>12){
                                $TPediatriaMax=$TPediatriaMax+1;
                            }else{
                                $TPediatriaMin=$TPediatriaMin+1;
                            }
                        }if($value['area_id']==6){//CHOQUE
                            if($Tiempo->d>0 || $Tiempo->h>12){
                                $ChoqueMax=$ChoqueMax+1;
                            }else{
                                $ChoqueMin=$ChoqueMin+1;
                            }
                        }
                        
                        
                    }
                    echo '<span class="span-ocupados" data-type="HOMBRES" data-min="'.$THombresMin.'" data-max="'.$THombresMax.'"></span>';
                    echo '<span class="span-ocupados" data-type="MUJERES" data-min="'.$TMujeresMin.'" data-max="'.$TMujeresMax.'"></span>';
                    echo '<span class="span-ocupados" data-type="PEDIATRIA" data-min="'.$TPediatriaMin.'" data-max="'.$TPediatriaMax.'"></span>';
                    echo '<span class="span-ocupados" data-type="CHOQUE" data-min="'.$ChoqueMin.'" data-max="'.$ChoqueMax.'"></span>';
                    $THombres=0;
                    $TMujeres=0;
                    $TPediatria=0;
                    $TChoque=0;
                    
                    foreach ($sql2 as $value) {
                        if($value['area_id']==3){//PEDIATRIA
                            $THombres=$THombres+1;
                        }if($value['area_id']==4){//MUJERES
                            $TMujeres=$TMujeres+1;                   
                        }if($value['area_id']==5){//HOMBRES
                            $TPediatria=$TPediatria+1;
                        }if($value['area_id']==6){//CHOQUE
                            $TChoque=$TChoque+1;
                        }
                    }
                    echo '<span class="span-disponibles" data-h="'.$THombres.'" data-m="'.$TMujeres.'" data-p="'.$TPediatria.'" data-c="'.$TChoque.'"></span>';
                ?>
                </div>
                <div class="panel-body b-b b-light" style="padding: 0px">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>CAMAS POR ESTADO</h5>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <canvas id="ChartUrgGCEstados" data-o="<?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'Ocupado'))?>" data-d="<?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'Disponible'))?>" data-m="<?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'En Mantenimiento'))?>" data-l="<?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'En Limpieza'))?>" style="height: 100px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group md-whiteframe-z0" style="margin-right: 20px;margin-top: 30px">
                                <a href="" class="list-group-item" style="font-size: 15px">
                                    <span class="pull-right label back-imss"><?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'Disponible'))?></span>DISPONIBLES
                                </a>
                                <a href="" class="list-group-item" style="font-size: 15px">
                                    <span class="pull-right label back-imss"><?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'Ocupado'))?></span>OCUPADAS
                                </a>
                                <a href="" class="list-group-item" style="font-size: 15px">
                                    <span class="pull-right label back-imss"><?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'En Limpieza'))?></span>EN LIMPIEZA
                                </a>
                                <a href="" class="list-group-item" style="font-size: 15px">
                                    <span class="pull-right label back-imss"><?= Modules::run('Urgencias/getCamasPorStatus',array('status'=>'En Mantenimiento'))?></span>EN MANTENIMIENTO
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>CAMAS DISPONIBLES</h5>
                            </div>
                            <canvas id="ChartUrgGCDisponibles" style="height: 100px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>CAMAS OCUPADAS</h5>
                            </div>
                            <canvas id="ChartUrgGCOcupadas" style="height: 100px"></canvas>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="UrgGCOcupadas" value="Si">
<?=Modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgencias.js?<?= md5(microtime())?>"></script>

