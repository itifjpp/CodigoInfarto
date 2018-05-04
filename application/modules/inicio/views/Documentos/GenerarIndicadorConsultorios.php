<?php ob_start(); ?>
<page backtop="35mm" backbottom="20mm" backleft="12mm" backright="12mm">
    <page_header>
        
        <div style="width: 680px;margin-top: 25px;margin-left: 40px;position: absolute;">
            <table style="width: 100%" class="my_table">
                <tr style="">
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 55px;margin-top: -5px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 16px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                    </td>
                    <td style="width: 10%;text-align: right;">
                        <qrcode value="<?= sha1(date('Y-m-d H:i:s'))?>" ec="Q" style="width: 55px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 30px;margin-bottom: 0px;text-align: center;text-transform: uppercase">INDICADOR DE PACIENTES INGRESADOS EN CONSULTORIOS</p>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <style>
        .table, .table td  {    border: 1px solid #ddd;text-align: left;}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style>
    <div style="position: absolute;top: 30px">
        <table class="table">
            <thead>
                <tr style="background: <?=$this->sigh->getInfo('hospital_back_primary')?>;color: white">
                    <th style="width: 25%;font-size: 11px">N° DE EMPLEADO</th>
                    <th style="width: 40%;font-size: 11px">NOMBRE DEL MÉDICO</th>
                    <th style="width: 35%;font-size: 11px">TOTAL DE PACIENTES ATENDIDOS</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $TotalGeneral=0;
                foreach ($sql1 as $value) {?>
                <tr id="" >
                    <td style="font-size: 9px;"><?=$value['empleado_matricula']?></td>
                    <td style="font-size: 9px;"><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                    <td style="font-size: 9px;">
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
                        $TotalGeneral=$TotalGeneral+$Total;
                        ?>
                        <?=$Total?> PACIENTES ATENTENDIDOS
                    </td>
                </tr>

                <?php }?>
                <?php foreach ($sql2 as $value) {?>
                <?php

                ?>
                <tr id="" >
                    <td style="font-size: 9px;"><?=$value['empleado_matricula']?></td>
                    <td style="font-size: 9px;"><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                    <td style="font-size: 9px;">
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
                        $TotalGeneral=$TotalGeneral+$Total;
                        ?>
                        <?=$Total?> PACIENTES ATENTENDIDOS
                    </td>
                </tr>

                <?php }?>
                <tr>
                    <td colspan="2" rowspan="2" style="border-left: transparent;border-bottom: transparent"></td>
                    <td style="font-size: 9px;text-align: right"><b>TOTAL: </b> <?= $TotalGeneral?> PACIENTES ATENDIDOS</td>
                </tr>
            </tbody>
        </table>
    </div>
    <page_footer>
        <div style="text-align: center;line-height: 1.4;font-size: 10px">
            __________________________________________<br>
            NOMBRE Y FIRMA
        </div>
        <h6 style="text-align: center;">Página [[page_cu]]/[[page_nb]]</h6>
    </page_footer>
    
        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','en','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->setTitle('INDICADOR DE PACIENTES INGRESADOS A CONSULTORIOS');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('INDICADOR DE PACIENTES INGRESADOS A CONSULTORIOS.pdf');
?> 