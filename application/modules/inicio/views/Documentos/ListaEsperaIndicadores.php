<?php ob_start(); ?>
<page backtop="50mm" backbottom="7mm" backleft="11mm" backright="11mm">
    <page_header>
        <style>
            .my_table, .my_table td, .my_table th {  
                border: none;
                text-align: left;
            }
        </style>
        <div style="width: 1000px;margin-top: 45px;margin-left: 40px;position: absolute;">
            <table style="width: 100%" class="my_table">
                <tr style="">
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS.</p>
                        
                    </td>
                    <td style="width: 10%;text-align: right;">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 30px;margin-bottom: 0px;text-align: center"></p>
                    </td>
                </tr>
            </table>
            <table style="margin-top: 30px;width: 100%">
                <tr>
                    <td style="width: 100%">
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: bold;text-align: center">Lista de Pacientes Ingresados a <?=$_GET['inputCons']?></h5>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <style>
        .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style>
    <table class="table" style="font-size: 9px">
        <thead>
            <tr>
                <th style="width: 15%">NOMBRE DEL PACIENTE</th>
                <th style="width: 11%">HORA DE INGRESO</th>
                <th style="width: 10%">CLASIFICACIÓN</th>
                <th style="width: 16%">CONSULTORIO DE ATENCIÓN</th>
                <th style="width: 15%">MÉDICO QUE ATENDIO</th>
                <th style="width: 18%">INGRESO/EGRESO CONSULTORIO</th>
                <th style="width: 14%">TIEMPO TRANSCURRIDO</th>
            </tr>
        </thead>
        <?php 
        $inputFilter= $this->input->get('inputFilter');
        $inputDateStart= $this->input->get('inputDateStart');
        $inputDateEnd= $this->input->get('inputDateEnd');
        $inputTurno= $this->input->get('inputTurno');
        $inputCons=$this->input->get('inputCons');
        if($inputFilter=='RANGO_DE_FECHAS'){
            $sql= $this->config_mdl->sqlQuery("
                SELECT
                    pac.paciente_nombre, pac.paciente_am, pac.paciente_ap, ing.ingreso_date_horacero, ing.ingreso_time_horacero,
                    ing.ingreso_clasificacion, ce.ce_asignado_consultorio, empleado_matricula, ce.ce_fe, ce.ce_he,ce.ce_fs,ce.ce_hs,
                    ing.ingreso_date_medico, ingreso_time_medico, ing.ingreso_date_enfermera, ingreso_time_enfermera
                        
                FROM
                    sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera, sigh_pacientes AS pac, sigh_consultorios_especialidad AS ce,
                    sigh_empleados AS emp
                WHERE
                    
                    ing.paciente_id=pac.paciente_id AND
                    ing.ingreso_id=ce.ingreso_id AND 
                    ce.ce_crea=emp.empleado_id AND
                    espera.ingreso_id=ing.ingreso_id AND
                    espera.lista_espera_date BETWEEN '$inputDateStart' AND '$inputDateEnd' AND
                    espera.lista_espera_estado='Ingresado' AND
                    espera.lista_espera_consultorio='".$inputCons."'");
        }else{

            if($inputTurno=='NOCHE'){
                $sql= $this->config_mdl->sqlQuery("
                            SELECT
                                pac.paciente_nombre, pac.paciente_am, pac.paciente_ap, ing.ingreso_date_horacero, ing.ingreso_time_horacero,
                                ing.ingreso_clasificacion, ce.ce_asignado_consultorio, empleado_matricula, ce.ce_fe, ce.ce_he,ce.ce_fs,ce.ce_hs,
                                ing.ingreso_date_medico, ingreso_time_medico, ing.ingreso_date_enfermera, ingreso_time_enfermera
                            FROM
                                sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera, sigh_pacientes AS pac, sigh_consultorios_especialidad AS ce,
                                sigh_empleados AS emp
                            WHERE

                                ing.paciente_id=pac.paciente_id AND
                                ing.ingreso_id=ce.ingreso_id AND 
                                ce.ce_crea=emp.empleado_id AND
                                espera.ingreso_id=ing.ingreso_id AND
                                espera.lista_espera_date='$inputDateStart' AND
                                espera.lista_espera_date BETWEEN '21:00' AND '23:59' AND
                                espera.lista_espera_estado='Ingresado' AND
                                espera.lista_espera_consultorio='".$inputCons."'");
                $sql1= $this->config_mdl->sqlQuery("
                            SELECT
                                pac.paciente_nombre, pac.paciente_am, pac.paciente_ap, ing.ingreso_date_horacero, ing.ingreso_time_horacero,
                                ing.ingreso_clasificacion, ce.ce_asignado_consultorio, empleado_matricula, ce.ce_fe, ce.ce_he,ce.ce_fs,ce.ce_hs,
                                ing.ingreso_date_medico, ingreso_time_medico, ing.ingreso_date_enfermera, ingreso_time_enfermera

                            FROM
                                sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera, sigh_pacientes AS pac, sigh_consultorios_especialidad AS ce,
                                sigh_empleados AS emp
                            WHERE

                                ing.paciente_id=pac.paciente_id AND
                                ing.ingreso_id=ce.ingreso_id AND 
                                ce.ce_crea=emp.empleado_id AND
                                espera.ingreso_id=ing.ingreso_id AND
                                espera.lista_espera_date=DATE_ADD('$inputDateStart',INTERVAL 1 DAY) AND
                                espera.lista_espera_date BETWEEN '00:00' AND '06:59' AND
                                espera.lista_espera_estado='Ingresado' AND
                                espera.lista_espera_consultorio='".$inputCons."'");
            }else{
                if($inputTurno=='MAÑANA'){
                    $inputTimeStart='07:00';
                    $inputTimeEnd='13:59';
                }else{
                    $inputTimeStart='14:00';
                    $inputTimeEnd='20:59';
                }
                $sql= $this->config_mdl->sqlQuery("
                           SELECT
                                pac.paciente_nombre, pac.paciente_am, pac.paciente_ap, ing.ingreso_date_horacero, ing.ingreso_time_horacero,
                                ing.ingreso_clasificacion, ce.ce_asignado_consultorio, empleado_matricula, ce.ce_fe, ce.ce_he,ce.ce_fs,ce.ce_hs,
                                ing.ingreso_date_medico, ingreso_time_medico, ing.ingreso_date_enfermera, ingreso_time_enfermera
                            FROM
                                sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera, sigh_pacientes AS pac, sigh_consultorios_especialidad AS ce,
                                sigh_empleados AS emp
                            WHERE

                                ing.paciente_id=pac.paciente_id AND
                                ing.ingreso_id=ce.ingreso_id AND 
                                ce.ce_crea=emp.empleado_id AND
                                espera.ingreso_id=ing.ingreso_id AND
                                espera.lista_espera_date='$inputDateStart' AND
                                espera.lista_espera_date BETWEEN '$inputTimeStart' AND '$inputTimeEnd' AND
                                espera.lista_espera_estado='Ingresado' AND
                                espera.lista_espera_consultorio='".$inputCons."'");

            }
        }
        foreach ($sql as $value) {
            if($value['ce_fs']!=''){
                $Diff= Modules::run("config/getTimeElapsed",array(
                    'Time1'=>$value['ingreso_date_enfermera'].' '.$value['ingreso_time_enfermera'],
                    'Time2'=>$value['ce_fs'].' '.$value['ce_hs']
                ));
            }
        ?>
        <tr>
            <td><?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_ap']?></td>
            <td><?=$value['ingreso_date_horacero']?> <?=$value['ingreso_time_horacero']?></td>
            <td><?=$value['ingreso_clasificacion']?></td>
            <td><?=$value['ce_asignado_consultorio']?></td>
            <td><?=$value['empleado_matricula']?></td>
            <td><?=$value['ce_fe']?> <?=$value['ce_he']?> /  <?=$value['ce_fs']?> <?=$value['ce_hs']?></td>
            <td>
                <?php if($value['ce_fs']!=''){?>
                <?=$Diff->d?> Dias <?=$Diff->h?> Hrs <?=$Diff->i?> Min
                <?php }?>
            </td>
        </tr>
        <?php }?>
        <?php 
        foreach ($sql1 as $value2) {
            if($value['ce_fs']!=''){
                $Diff= Modules::run("config/getTimeElapsed",array(
                    'Time1'=>$value2['ingreso_date_enfermera'].' '.$value2['ingreso_time_enfermera'],
                    'Time2'=>$value2['ce_fs'].' '.$value2['ce_hs']
                ));
            }
        ?>
        <tr>
            <td><?=$value2['paciente_nombre']?> <?=$value2['paciente_ap']?> <?=$value2['paciente_ap']?></td>
            <td><?=$value2['ingreso_date_horacero']?> <?=$value2['ingreso_time_horacero']?></td>
            <td><?=$value2['ingreso_clasificacion']?></td>
            <td><?=$value2['ce_asignado_consultorio']?></td>
            <td><?=$value2['empleado_matricula']?></td>
            <td><?=$value2['ce_fe']?> <?=$value2['ce_he']?> /  <?=$value2['ce_fs']?> <?=$value2['ce_hs']?></td>
            <td>
                <?php if($value2['ce_fs']!=''){?>
                <?=$Diff->d?> Dias <?=$Diff->h?> Hrs <?=$Diff->i?> Min
                <?php }?>
            </td>
        </tr>
        <?php }?>
    </table>
    <page_footer>
        <div style="text-align:right">
            Página [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('LISTA DE PACIENTES INGRESADOS AL ÁREA DE CONSULTORIOS');
    $pdf->Output('LISTA DE PACIENTES INGRESADOS AL ÁREA DE CONSULTORIOS.pdf');
?>