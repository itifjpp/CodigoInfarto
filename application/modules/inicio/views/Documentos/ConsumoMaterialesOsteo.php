<?php ob_start(); ?>
<page backtop="145mm" backbottom="40mm" backleft="19.5mm" backright="19.5mm">
    <page_header>
        <img src="assets/doc/RCO3.png" style="width: 100%;position: absolute">
        <?php
            $sqlPaciente=$this->config_mdl->sqlQuery("SELECT t.triage_nombre,t.triage_en, t.triage_nombre_ap, t.triage_nombre_am, pin.pum_nss, pin.pum_nss_agregado FROM os_triage AS t, paciente_info AS pin WHERE 
                pin.triage_id=t.triage_id AND t.triage_id=".$info['triage_id'])[0];
            
            $sqlPersonal=$this->config_mdl->sqlGetDataCondition('os_empleados',array(
                'empleado_id'=>$info['personal_id']
            ),'empleado_nombre,empleado_apellidos,empleado_matricula')[0];
            
            $sqlInstrumentista=$this->config_mdl->sqlGetDataCondition('os_empleados',array(
                'empleado_id'=>$info['instrumentista_id']
            ),'empleado_nombre,empleado_apellidos,empleado_matricula')[0];
            
            $sqlCirujano=$this->config_mdl->sqlGetDataCondition('os_empleados',array(
                'empleado_id'=>$info['cirujano_id']
            ),'empleado_nombre,empleado_apellidos,empleado_matricula')[0];
        ?>
        <div style="position: absolute;font-size: 10px;margin-top: 280px;margin-left: 80px;width: 285px;">
            <?=$sqlPaciente['triage_nombre_ap']?> <?=$sqlPaciente['triage_nombre']?> <?=$sqlPaciente['triage_nombre']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 320px;margin-left: 80px;width: 234px;">
            <?=$info['rc_diagnostico']?>
        </div>
        <div style="position: absolute;font-size: 10px;margin-top: 320px;margin-left: 320px;width: 120px;text-align: center">
        <?php 
        if($sqlPaciente['triage_en']=='Pisos'){ 
            $sqlCama=$this->config_mdl->sqlQuery("SELECT os_camas.cama_nombre FROM os_camas, os_areas_pacientes WHERE os_camas.cama_id=os_areas_pacientes.cama_id AND
                                                    os_areas_pacientes.triage_id=".$info['triage_id'])[0];
            echo $sqlCama['cama_nombre'];
            
        }if($sqlPaciente['triage_en']=='Observación'){ 
            $sqlCama=$this->config_mdl->sqlQuery("SELECT os_camas.cama_nombre FROM os_camas, os_observacion WHERE os_camas.cama_id=os_observacion.observacion_cama AND
                                                    os_observacion.triage_id=".$info['triage_id'])[0];
            echo $sqlCama['cama_nombre'];
            
        }if($sqlPaciente['triage_en']=='Choque'){ 
            $sqlCama=$this->config_mdl->sqlQuery("SELECT os_camas.cama_nombre FROM os_camas, os_choque_v2 WHERE os_camas.cama_id=os_choque_v2.cama_id AND
                                                    os_choque_v2.triage_id=".$info['triage_id'])[0];
            echo $sqlCama['cama_nombre'];
            
        }
        ?>
        </div>
        <div style="position: absolute;font-size: 10px;margin-top: 320px;margin-left: 445px;width:230px;text-align: center">
            <?=$info['rc_fecha_cirugia']?>
        </div>
        
        <div style="position: absolute;font-size: 10px;margin-top: 280px;margin-left: 390px;">
            <?=$sqlPaciente['pum_nss']?> <?=$sqlPaciente['pum_nss_agregado']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 370px;margin-left: 80px;width: 190px;text-align: center">
            <?=$sqlPersonal['empleado_apellidos']?> <?=$sqlPersonal['empleado_nombre']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 370px;margin-left: 284px;width: 186px;text-align: center">
            <?=$sqlPersonal['empleado_matricula']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 432px;margin-left: 80px;width: 190px;text-align: center">
            <?=$sqlInstrumentista['empleado_apellidos']?> <?=$sqlPersonal['empleado_nombre']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 432px;margin-left: 284px;width: 186px;text-align: center">
            <?=$sqlInstrumentista['empleado_matricula']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 490px;margin-left: 80px;width: 190px;text-align: center">
            <?=$sqlCirujano['empleado_apellidos']?> <?=$sqlPersonal['empleado_nombre']?>
        </div>
        
        <div style="position: absolute;font-size: 8px;margin-top: 490px;margin-left: 284px;width: 186px;text-align: center">
            <?=$sqlCirujano['empleado_matricula']?>
        </div>
        
    </page_header>
    <div style="position: absolute;margin-top: 10px">
        <style>
            table {border-collapse: collapse;}
            table, th, td {border: 1px solid black;}
        </style>
        <table style="width:100% ">
            <tbody>
                <?php foreach ($Materiales as $value){?>
                <tr>
                    <td style="width: 25%;font-size: 10px"><?=$value['sistema_titulo']?></td>
                    <td style="width: 25%;font-size: 10px"><?=$value['elemento_titulo']?></td>
                    <td style="width: 25%;font-size: 10px"><?=$value['rango_titulo']?></td>
                    <td style="width: 15%;font-size: 10px"><?=$value['inventario_id']?></td>
                    <td style="width: 10%;font-size: 10px">

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('SOLICITUD Y CONSUMO DE MATERIALES DE OSTEOSINTESIS');
    $pdf->Output('SOLICITUD Y CONSUMO DE MATERIALES DE OSTEOSINTESIS.pdf');
?>