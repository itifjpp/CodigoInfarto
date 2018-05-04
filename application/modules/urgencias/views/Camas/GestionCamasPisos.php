<?=Modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px;">
                <div class="UrlColsPisos">
                <?php 
                    $sql=$this->config_mdl->sqlQuery("SELECT * FROM os_pisos");
                    foreach ($sql as $value) { 
                        $CamasDisponibles= Modules::run('Urgencias/getCamasStatusPisos',array(
                            'piso'=>$value['piso_id'],
                            'status'=>'Disponible'
                        ));
                        $CamasOcupados= Modules::run('Urgencias/getCamasStatusPisos',array(
                            'piso'=>$value['piso_id'],
                            'status'=>'Ocupado'
                        ));
                        $CamasLimpieza= Modules::run('Urgencias/getCamasStatusPisos',array(
                            'piso'=>$value['piso_id'],
                            'status'=>'En Limpieza'
                        ));
                        $CamasMantenimiento= Modules::run('Urgencias/getCamasStatusPisos',array(
                            'piso'=>$value['piso_id'],
                            'status'=>'En Mantenimiento'
                        ));
                        
                        echo '<span data-piso="'.$value['piso_nombre'].'" data-d="'.$CamasDisponibles.'" data-o="'.$CamasOcupados.'" data-l="'.$CamasLimpieza.'" data-m="'.$CamasMantenimiento.'"></span>';
                    }
                ?>
                </div>
                <div class="panel-body b-b b-light" style="padding: 0px">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>CAMAS POR ESTADO EN PISOS</h5>
                            </div>
                            <div class="COL-HTML-CHART"></div>
                            
                        </div>
                        
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="UrgGCPisos" value="Si">
<?=Modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgencias.js?<?= md5(microtime())?>"></script>

