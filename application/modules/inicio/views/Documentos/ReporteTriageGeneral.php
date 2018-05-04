<?php ob_start(); ?>
<page backtop="70mm" backbottom="7mm" backleft="11mm" backright="11mm">
    <page_header>
        <style>
            .my_table, .my_table td, .my_table th {  
                border: none;
                text-align: left;
            }
        </style>
        <div style="width: 680px;margin-top: 45px;margin-left: 40px;position: absolute;">
            <table style="width: 100%" class="my_table">
                <tr style="">
                    <td style="width: 50%;">
                        <img src="assets/img/LOGO_ISSSTE.png" style="width: 370px;margin-top: -15px">
                    </td>
                    <td style="width: 5%"></td>
                    <td style="width: 35%;padding: 0px">
                        <tr>
                            <td style="border-left:1px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>;border-right: 1px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>;border-bottom: 1px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <div style="background: <?=$this->sigh->getInfo('hospital_back_secundary')?>;width: 262px;padding: 5px;color: white">
                                <?php 
                                if($_GET['inputFiltro']=='Fechas'){
                                    echo str_replace('-','',$_GET['inputFechaI']).'-',str_replace('-','',$_GET['inputFechaF']).'/RF'; 
                                }else{
                                   echo str_replace('-','',$_GET['inputFechaI']).'/T'. substr($_GET['inputTurno'], 0,1); 
                                }
                                ?>
                                </div>
                                <h4 style="text-align: center;margin-top: 5px;">ISSSTE HOSPITAL REGIONAL</h4>
                                <h5 style="text-align: center;margin-top: -15px;font-weight: 100">"GENERAL IGNACIO ZARAGOZA"</h5>
                                <h5 style="text-align: center;margin-top: -5px;font-weight: bold">REPORTE TRIAGE</h5>
                                <?php if($_GET['inputFiltro']=='Fechas'){?>
                                <h5 style="text-align: left;margin-top: -5px;font-weight: 100"><b>&nbsp;&nbsp;FECHA INICIO:</b> <?=$_GET['inputFechaI']?></h5>
                                <h5 style="text-align: left;margin-top: -10px;margin-bottom: 5px;font-weight: 100"><b>&nbsp;&nbsp;FECHA TERMINO:</b> <?=$_GET['inputFechaF']?></h5>
                                <?php }else{?>
                                <h5 style="text-align: left;margin-top: -5px;font-weight: 100"><b>&nbsp;&nbsp;FECHA:</b> <?=$_GET['inputFechaI']?></h5>
                                <h5 style="text-align: left;margin-top: -10px;margin-bottom: 5px;font-weight: 100"><b>&nbsp;&nbsp;TURNO:</b> <?=$_GET['inputTurno']?></h5>
                                <?php }?>
                            </td>
                        </tr>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <table style="width: 100%">
        <tr>
            <td style="width: 30%">
                <h6 style="text-align: center;line-height: 1.6">TOTAL DE PACIENTES INGRESOS ENFERMERÍA</h6>
                <h1 style="text-align: center;font-weight: 100;margin-top: 0px;text-transform: uppercase"><?= trim($_GET['enfermera'], ' Pacientes')?></h1>
                <h6 style="text-align: center;line-height: 1.6">TOTAL DE PACIENTES CLASIFICADOS MÉDICO</h6>
                <h1 style="text-align: center;font-weight: 100;margin-top: 0px;text-transform: uppercase"><?=trim($_GET['medico'],' Pacientes')?></h1>
            </td>
            <td style="width: 2%;">
                <div style="width: 20px;background:<?=$this->sigh->getInfo('hospital_back_secundary')?>;height: 350px "></div>
            </td>
            <td style="width: 68%;">
                <img src="assets/graficas/<?=$_GET['img']?>" style="width: 620px;margin-left: -80px;margin-right: -70px">
                <h5 style="margin-top: 5px;text-align: center;font-weight: 100;margin-bottom: 5px;">&nbsp;&nbsp;&nbsp;DERECHOHABIENTES: <?=$_GET['sidh']?></h5>
                <h5 style="margin-top: 0px;text-align: center;font-weight: 100">NO DERECHOHABIENTES: <?=$_GET['nodh']?></h5>
            </td>
        </tr>
    </table>
    <?php 
        $inputFiltro= $this->input->get_post('inputFiltro');
        $inputTurno= $this->input->get_post('inputTurno');
        $inputFi= $this->input->get_post('inputFechaI');
        $inputFf= $this->input->get_post('inputFechaF');
        
        if($inputFiltro=='Fechas'){
            $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_medico
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico BETWEEN '$inputFi' AND '$inputFf'");
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
                $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_enfermera
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico='$inputFi' AND
                                                        ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'");
                
                $sql2= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_enfermera
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico=DATE_ADD('$inputFi', INTERVAL 1 DAY) AND
                                                        ing.ingreso_time_medico BETWEEN '00:00' AND '06:59:59'");
                
            }else{
                $sql2=NULL;
                $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_enfermera
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico='$inputFi' AND
                                                        ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'");
            }
        }
    
    
    ?>
    <style>
        .table, .table td  {    border: 1px solid #ddd;text-align: left;}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style><br><br><br>
    <table style="width: 100%" class="table">
        <thead>
            <tr style="background: <?=$this->sigh->getInfo('hospital_back_primary')?>;color: white">
                <th style="width: 5%">N°</th>
                <th style="width: 20%">NOMBRE</th>
                <th style="width: 20%">A.PATERNO</th>
                <th style="width: 20%">A.MATERNO</th>
                <th style="width: 15%">EDAD</th>
                <th style="width: 20%">CLASIFICACIÓN</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=0;
            foreach ($sql as $value) {
            $i++;
            $Edad= Modules::run('config/CalcularEdad_',$value['paciente_fn']);    
            ?>
            <tr>
                <td style="font-weight: 100;font-size: 12px;width: 5%"><?=$i?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['paciente_nombre']?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['paciente_ap']?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['paciente_am']?></td>
                <td style="font-weight: 100;font-size: 12px;width: 15%"><?=$Edad->y==0 ? $Edad->m.' MESES' : $Edad->y.' AÑOS '?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['ingreso_clasificacion']?></td>
            </tr>
            <?php }?>
            <?php 
            foreach ($sql2 as $value) {
            $i++;
            $Edad= Modules::run('config/CalcularEdad_',$value['paciente_fn']);    
            ?>
            <tr>
                <td style="width: 5%"><?=$i?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['paciente_nombre']?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['paciente_ap']?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['paciente_am']?></td>
                <td style="font-weight: 100;font-size: 12px;width: 15%"><?=$Edad->y==0 ? $Edad->m.' MESES' : $Edad->y.' AÑOS '?></td>
                <td style="font-weight: 100;font-size: 12px;width: 20%"><?=$value['ingreso_clasificacion']?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <page_footer>
        <div style="text-align:right">
            Página [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE ENFERMERÍA Y MÉDICO TRIAGE');
    $pdf->Output('REPORTE ENFERMERÍA Y MÉDICO TRIAGE.pdf');
?>