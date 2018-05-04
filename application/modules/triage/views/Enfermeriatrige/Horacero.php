<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Procedimiento para la clasificación de pacientes</span>
                    <?php if($this->ConfigEnfermeriaHC=='Si'){?>
                    <a href="" class="md-btn md-fab m-b green waves-effect pull-right tip btn-horacero-enfermeria" style="width: 100px;height: 100px;padding: 15px">
                        <i class="mdi-social-person-add fa-5x" ></i>
                    </a>
                    <?php }?>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-user-plus"></i>
                                </span>
                                <input type="text" id="input_search" class="form-control" placeholder="Ingresar N° de Folio">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table footable table-filtros table-bordered table-no-padding"  data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>N° DE FOLIO</th>
                                        <th >HORA ENFERMERIA</th>
                                        <th style="width: 30%">PACIENTE</th>
                                        <th >SEXO</th>
                                        <th >EDAD</th>
                                        <th>TIPO TRIGAE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr id="<?=$value['triage_id']?>">
                                        <td><?=$value['triage_id']?></td>
                                        <td ><?=$value['triage_fecha']?> <?=$value['triage_hora']?></td>
                                        <td ><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> </td>
                                        <td ><?=$value['triage_paciente_sexo']?> </td>
                                        <td >
                                            <?php 
                                            if($value['triage_fecha_nac']!=''){
                                                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['triage_fecha_nac']));
                                                echo $fecha->y.' Años';
                                            }else{
                                                echo 'S/E';
                                            }
                                            ?>
                                        </td>
                                        <td >
                                            <?php 
                                            if($value['triage_fecha_nac']!=''){
                                                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['triage_fecha_nac']));
                                                if($fecha->y<15){
                                                    echo 'PEDIATRICO';
                                                }if($fecha->y>15 && $fecha->y<60){
                                                    echo 'ADULTO';
                                                }if($fecha->y>60){
                                                    echo 'GERIATRICO';
                                                }
                                            }else{
                                                echo 'S/E';
                                            }
                                            ?>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Enfermeriatriage.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>