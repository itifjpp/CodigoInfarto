<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <?php if($_GET['inputFilter']=='Fechas'){?>
                        <h4 class="no-margin color-white text-uppercase width100">INDICADORES SERVICIO DE <b><?=$_GET['Servicio']?></b> DE FECHA <b><?=$_GET['inputDateStart']?></b> A <b><?=$_GET['inputDateEnd']?></b></h4>
                        <?php }else{?>
                        <h4 class="no-margin color-white text-uppercase width100">INDICADORES SERVICIO DE <b><?=$_GET['Servicio']?></b> DE FECHA <b><?=$_GET['inputDateStart']?></b> TURNO <b><?=$_GET['inputTurno']?></b></h4>
                        <?php }?>
                        <a class="btn sigh-background-primary pull-right tip" href="#" onclick="AbrirVista(base_url+'Inicio/Documentos/GenerarIndicadorConsultorios?inputFilter=<?=$_GET['inputFilter']?>&inputTurno=<?=$_GET['inputTurno']?>&inputDateStart=<?=$_GET['inputDateStart']?>&inputDateEnd=<?=$_GET['inputDateEnd']?>&Servicio=<?=$_GET['Servicio']?>')" style="position: absolute;right: 25px;top:5px">
                            <i class="material-icons i-24 color-white">cloud_download</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-no-padding table-bordered table-striped footable">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">N° DE EMPLEADO</th>
                                            <th style="width: 35%">MEDICO QUE ATENDIO</th>
                                            <th style="width: 35%">TOTAL DE PACIENTE ATENDIDOS</th>
                                            <th style="width: 20%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sql1 as $value) {
                                            
                                        ?>
                                        <tr>
                                            <td><?=$value['empleado_matricula']?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                            <td>
                                        <?php 
                                                $inputFilter= $this->input->get_post('inputFilter');
                                                $inputTurno= $this->input->get_post('inputTurno');
                                                $inputDateStart= $this->input->get_post('inputDateStart');
                                                $inputDateEnd= $this->input->get_post('inputDateEnd');
                                                $inputServicio= $this->input->get_post('Servicio');
                                                if($inputFilter=='Fechas'){
                                                    $sql1_Total= $this->config_mdl->sqlQuery(" SELECT 
                                                                                                    COUNT(ce.ce_id) AS total
                                                                                                FROM 
                                                                                                        sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                        sigh_empleados AS emp
                                                                                                WHERE
                                                                                                        emp.empleado_id=ce.ce_crea AND
                                                                                                        ing.ingreso_id=ce.ingreso_id AND
                                                                                                        ing.paciente_id=pac.paciente_id AND
                                                                                                        ce.ce_status='Salida' AND 
                                                                                                        ce.ce_fs BETWEEN '$inputDateStart' AND '$inputDateEnd' AND
                                                                                                        ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                
                                                    $Total=$sql1_Total[0]['total'];
                                                }else{
                                                    if($inputTurno=='Mañana'){
                                                        $inputHora1='07:00';
                                                        $inputHora2='13:59';
                                                    }if($inputTurno=='Tarde'){
                                                        $inputHora1='14:00';
                                                        $inputHora2='20:59';
                                                    }if($inputTurno=='Noche'){
                                                        $inputHora1='21:00';
                                                        $inputHora2='23:59';
                                                    }
                                                    if($inputTurno=='Noche'){
                                                        $sql1_Total= $this->config_mdl->sqlQuery(" SELECT 
                                                                                                        COUNT(ce.ce_id) AS total
                                                                                                    FROM 
                                                                                                            sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                            sigh_empleados AS emp
                                                                                                    WHERE
                                                                                                            emp.empleado_id=ce.ce_crea AND
                                                                                                            ing.ingreso_id=ce.ingreso_id AND
                                                                                                            ing.paciente_id=pac.paciente_id AND
                                                                                                            ce.ce_status='Salida' AND
                                                                                                            ce.ce_fs='$inputDateStart' AND
                                                                                                            ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                                                            ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                        $sql2_Total= $this->config_mdl->sqlQuery(" SELECT 
                                                                                                        COUNT(ce.ce_id) AS total
                                                                                                    FROM 
                                                                                                            sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                            sigh_empleados AS emp
                                                                                                    WHERE
                                                                                                            emp.empleado_id=ce.ce_crea AND
                                                                                                            ing.ingreso_id=ce.ingreso_id AND
                                                                                                            ing.paciente_id=pac.paciente_id AND
                                                                                                            ce.ce_status='Salida' AND
                                                                                                            ce.ce_fs=DATE_ADD('$inputDateStart', INTERVAL 1 DAY) AND
                                                                                                            ce.ce_hs BETWEEN '00:00' AND '06:59' AND
                                                                                                            ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                    
                                                        $Total=$sql1_Total[0]['total']+$sql2_Total[0]['total'];
                                                    }else{
                                                        $sql1_Total= $this->config_mdl->sqlQuery("
                                                                                                SELECT 
                                                                                                    COUNT(ce.ce_id) AS total
                                                                                                FROM 
                                                                                                        sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                        sigh_empleados AS emp
                                                                                                WHERE
                                                                                                        emp.empleado_id=ce.ce_crea AND
                                                                                                        ing.ingreso_id=ce.ingreso_id AND
                                                                                                        ing.paciente_id=pac.paciente_id AND
                                                                                                        ce.ce_status='Salida' AND
                                                                                                        ce.ce_fs='$inputDateStart' AND
                                                                                                        ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                                                        ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                    
                                                         $Total=$sql1_Total[0]['total'];
                                                    }
                                                }
                                                
                                                ?>
                                                <?=$Total?> PACIENTES ATENTENDIDOS
                                            </td>
                                            <td></td>
                                        </tr>
                                        <?php }
                                        
                                        ?>
                                        <?php foreach ($sql2 as $value) {
                                           
                                        ?>
                                        <tr>
                                            <td><?=$value['empleado_matricula']?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                            <td>
                                        <?php 
                                                $inputFilter= $this->input->get_post('inputFilter');
                                                $inputTurno= $this->input->get_post('inputTurno');
                                                $inputDateStart= $this->input->get_post('inputDateStart');
                                                $inputDateEnd= $this->input->get_post('inputDateEnd');
                                                $inputServicio= $this->input->get_post('Servicio');
                                                if($inputFilter=='Fechas'){
                                                    $sql1_Total= $this->config_mdl->sqlQuery(" SELECT 
                                                                                                    COUNT(ce.ce_id) AS total
                                                                                                FROM 
                                                                                                        sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                        sigh_empleados AS emp
                                                                                                WHERE
                                                                                                        emp.empleado_id=ce.ce_crea AND
                                                                                                        ing.ingreso_id=ce.ingreso_id AND
                                                                                                        ing.paciente_id=pac.paciente_id AND
                                                                                                        ce.ce_status='Salida' AND 
                                                                                                        ce.ce_fs BETWEEN '$inputDateStart' AND '$inputDateEnd' AND
                                                                                                        ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                
                                                    $Total=$sql1_Total[0]['total'];
                                                }else{
                                                    if($inputTurno=='Mañana'){
                                                        $inputHora1='07:00';
                                                        $inputHora2='13:59';
                                                    }if($inputTurno=='Tarde'){
                                                        $inputHora1='14:00';
                                                        $inputHora2='20:59';
                                                    }if($inputTurno=='Noche'){
                                                        $inputHora1='21:00';
                                                        $inputHora2='23:59';
                                                    }
                                                    if($inputTurno=='Noche'){
                                                        $sql1_Total= $this->config_mdl->sqlQuery(" SELECT 
                                                                                                        COUNT(ce.ce_id) AS total
                                                                                                    FROM 
                                                                                                            sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                            sigh_empleados AS emp
                                                                                                    WHERE
                                                                                                            emp.empleado_id=ce.ce_crea AND
                                                                                                            ing.ingreso_id=ce.ingreso_id AND
                                                                                                            ing.paciente_id=pac.paciente_id AND
                                                                                                            ce.ce_status='Salida' AND
                                                                                                            ce.ce_fs='$inputDateStart' AND
                                                                                                            ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                                                            ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                        $sql2_Total= $this->config_mdl->sqlQuery(" SELECT 
                                                                                                        COUNT(ce.ce_id) AS total
                                                                                                    FROM 
                                                                                                            sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                            sigh_empleados AS emp
                                                                                                    WHERE
                                                                                                            emp.empleado_id=ce.ce_crea AND
                                                                                                            ing.ingreso_id=ce.ingreso_id AND
                                                                                                            ing.paciente_id=pac.paciente_id AND
                                                                                                            ce.ce_status='Salida' AND
                                                                                                            ce.ce_fs=DATE_ADD('$inputDateStart', INTERVAL 1 DAY) AND
                                                                                                            ce.ce_hs BETWEEN '00:00' AND '06:59' AND
                                                                                                            ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                    
                                                        $Total=$sql1_Total[0]['total']+$sql2_Total[0]['total'];
                                                    }else{
                                                        $sql1_Total= $this->config_mdl->sqlQuery("
                                                                                                SELECT 
                                                                                                    COUNT(ce.ce_id) AS total
                                                                                                FROM 
                                                                                                        sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                                                        sigh_empleados AS emp
                                                                                                WHERE
                                                                                                        emp.empleado_id=ce.ce_crea AND
                                                                                                        ing.ingreso_id=ce.ingreso_id AND
                                                                                                        ing.paciente_id=pac.paciente_id AND
                                                                                                        ce.ce_status='Salida' AND
                                                                                                        ce.ce_fs='$inputDateStart' AND
                                                                                                        ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                                                        ce.ce_asignado_consultorio='$inputServicio' AND emp.empleado_id=".$value['empleado_id']);
                                                    
                                                         $Total=$sql1_Total[0]['total'];
                                                    }
                                                }
                                                
                                                ?>
                                                <?=$Total?> PACIENTES ATENTENDIDOS
                                            </td>
                                            <td></td>
                                        </tr>   
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="hide-if-no-paging">
                                            <td colspan="6" class="text-center">
                                                <ul class="pagination"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

<?=modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>