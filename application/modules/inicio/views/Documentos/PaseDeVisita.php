<?php ob_start(); ?>
<page  >
    <div style="position: relative;margin: 5px">
        <div style="position: absolute;left: 0px;top: 5px">
            <img src="assets/img/imss2.png" style="width: 30px;">
        </div>
        <div style="position: absolute;left: 30px;font-size: 10px;top: 5px;width: 200px;">
            <h5 style="font-size: 12px;margin-top: 0px"><?=$this->sigh->getInfo('hospital_tipo')?></h5>
            <h5 style="font-size: 7px;margin-top: -14px;"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h5>
            <h5 style="font-size: 7px;margin-top: -14px;">Coordinación de Asistentes Médica</h5>
        </div>
        <div style="position: absolute;left: 0px;top: 50px;width: 218px;text-transform: uppercase">
            <?php $Paciente=$this->uri->segment(4);?>
            <h4 style="font-size: 14px;padding: 0px;margin-top: 0px"><b>PACIENTE:</b> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?> </h4>
            <?php 
            if($_GET['tipo']=='Pisos'){
                $sqlIngresoPisos= $this->config_mdl->sqlGetDataCondition('os_areas_pacientes',array(
                    'triage_id'=>$Paciente
                ));
                if(empty($sqlIngresoPisos)){
                    $Pisos= $this->config_mdl->_query("SELECT * FROM doc_43051 , os_camas, os_pisos, os_pisos_camas, os_areas WHERE
                                                                    os_areas.area_id=os_camas.area_id AND
                                                                    doc_43051.cama_id=os_camas.cama_id AND
                                                                    os_pisos.piso_id=os_pisos_camas.piso_id AND
                                                                    os_pisos_camas.cama_id=os_camas.cama_id AND
                                                                    doc_43051.triage_id=".$Paciente)[0];
                }else{
                    $Pisos= $this->config_mdl->_query("SELECT * FROM os_areas_pacientes , os_camas, os_pisos, os_pisos_camas, os_areas WHERE
                                                                    os_areas.area_id=os_camas.area_id AND
                                                                    os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                                    os_pisos.piso_id=os_pisos_camas.piso_id AND
                                                                    os_pisos_camas.cama_id=os_camas.cama_id AND
                                                                    os_areas_pacientes.triage_id=".$Paciente)[0];
                }
                
            ?>
            <h4 style="font-size: 10px;padding: 0px;margin-top: -10px"><b>PISO:</b> <span style="font-weight: normal"><?=$Pisos['piso_nombre']?></span></h4>
            <?php }?>
            
            <h4 style="font-size: 10px;padding: 0px;margin-top: -12px"><b>CAMA:</b> <span style="font-weight: normal"><?=$Cama['cama_nombre']?></span></h4>
            <h4 style="font-size: 10px;padding: 0px;margin-top: -12px"><b>SERVICIO:</b> <span style="font-weight: normal"><?=$Cama['area_nombre']?></span></h4>
            <h4 style="font-size: 10px;padding: 0px;margin-top: -12px"><b>HORARIO:</b> <span style="font-weight: normal"><?=$Cama['area_horario_visita']?></span></h4>
            <h4 style="font-size: 10px;padding: 0px;margin-top: -12px"><b>ELABORO:</b> 
                <span style="font-weight: normal">
                <?php 
                $sqlEmpleado=$this->config_mdl->sqlGetDataCondition('os_empleados',array(
                    'empleado_id'=>$this->UMAE_USER
                ))[0];
                echo $sqlEmpleado['empleado_nombre'].' '.$sqlEmpleado['empleado_ap'].' '.$sqlEmpleado['empleado_am'];
                ?>
                </span>
            </h4>
            
        </div>
        <div style="position: absolute;left: 0px;top: 164px;width: 218px">
            <h4 style="font-size: 10px;padding: 0px;margin-top: 0px"><b>VISITA(S):</b></h4>
            <div style="font-size: 8px;margin-top: -20px;margin-left: -15px">
                <ol>
                    <?php foreach ($Familiares as $value) {?>
                    <li><?=$value['familiar_nombre']?> <?=$value['familiar_nombre_ap']?> <?=$value['familiar_nombre_am']?> (<?=$value['familiar_parentesco']?>)</li>
                    <?php }?>
                </ol>
            </div>
        </div>
        <div style="position: absolute;left: 0px;top: 213px;width: 230px;">
            <h4 style="font-size: 7px;margin-top: 0px;margin-bottom: 0px;text-align: right"><b>FECHA Y HORA:</b> <?= date('Y-m-d H:i')?></h4>
        </div>
        <div style="position: absolute;left: 236px;rotate:90;top: 5px">
            <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 50px;width: 215px" ></barcode>
        </div>
    </div>
    
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','en',true,'UTF-8',0);
    $pdf->pdf->SetDisplayMode('fullpage');
    $pdf->pdf->SetTitle('IMPRIMIR PASE DE VISITA A PISOS');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('IMPRIMIR PASE DE VISITA A PISOS.pdf');
?>