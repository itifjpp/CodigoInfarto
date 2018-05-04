<?php echo modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">HISTORIAL DEL PACIENTE: <?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></h4>
                        <a href="<?=  base_url()?>Sections/Documentos/Expediente/<?=$info['ingreso_id']?>/?tipo=Consultorios&url=Enfermería"  target="_blank" >
                            <button class="btn btn-danger pull-right" style="margin-top: -5px">
                                VER EXPEDIENTE <i class="fa fa-share-square-o"></i>
                            </button>
                        </a>
                    </div>
                    <div class="grid-body">
                        <table class="table table-bordered footable " data-page-size="5" data-limit-navigation="7">
                            <thead>
                                <tr class="sigh-background-secundary">
                                    <th colspan="4" class="text-center"><b>HISTORIAL GENERAL</b></th>
                                </tr>
                                <tr>
                                    <th>TIPO DE ACCIÓN</th>
                                    <th>FECHA</th>
                                    <th>EMPLEADO</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($Historial as $value) {?>
                                <tr>
                                    <td><?=$value['acceso_tipo']?></td>
                                    <td><?=$value['acceso_fecha']?> <?=$value['acceso_hora']?></td>
                                    <td><?=$value['empleado_nombre']?> <?=$value['empleado_am']?> <?=$value['empleado_am']?> (<?=$value['empleado_matricula']?>)</td>
                                    <td>
                                        <?php if($value['acceso_tipo']=='Hora Cero'){?>
                                        <i class="fa fa-print sigh-color i-20 tip pointer" onclick="AbrirDocumento(base_url+'Horacero/GenerarTicket/<?=$value['ingreso_id']?>')" data-original-title="Imprimir Ticket"></i>
                                        <?php }?>
                                        <?php if($value['acceso_tipo']=='Triage Enfermería'){?>
                                        
                                        <?php }?>
                                        <?php if($value['acceso_tipo']=='Triage Médico'){?>
                                        <i class="fa fa-print sigh-color i-20 tip pointer" onclick="AbrirDocumento(base_url+'Inicio/Documentos/Clasificacion/<?=$value['ingreso_id']?>')" data-original-title="Imprimir Hoja de Clasificación"></i>
                                        <?php }?>
                                        <?php if($value['acceso_tipo']=='Asistente Médica'){?>
                                        <i class="fa fa-print sigh-color i-20 tip pointer" onclick="AbrirDocumento(base_url+'Inicio/Documentos/HojaFrontal/<?=$value['ingreso_id']?>')" data-original-title="Imprimir Hoja Frontal Emitido por A.M"></i>
                                        <?php }?>
                                        <?php if($value['acceso_tipo']=='Consultorios Especialidad'){?>
                                        <i class="fa fa-print sigh-color i-20 tip pointer" onclick="AbrirDocumento(base_url+'Inicio/Documentos/HojaFrontalCE/<?=$value['ingreso_id']?>')" data-original-title="Imprimir Hoja Frontal Emitido por Consultorios u Observación"></i>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <ul class="pagination"></ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <table class="table table-bordered footable" data-page-size="5" data-limit-navigation="7">
                            <thead>
                                <tr class="teal">
                                    <th colspan="4" class="text-center"><b>CAMBIO DE REGISTROS DE NOMBRE & NSS</b></th>
                                </tr>
                                <tr>
                                    <th><b>NOMBRE DEL PACIENTE</b></th>
                                    <th><b>N.S.S </b></th>
                                    <th><b>EMPLEADO</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($PacientesLog as $value) {?>
                                <tr>
                                    <td>
                                        <?=explode('->',$value['log_nombre_paciente'])[0]?><br>
                                        <i class="fa fa-arrow-right"></i> <?=explode('->',$value['log_nombre_paciente'])[1]?>
                                    </td>
                                    <td>
                                        <?=explode('->',$value['log_nss'])[0]?><br>
                                        <i class="fa fa-arrow-right"></i><?=explode('->',$value['log_nss'])[0]?>
                                    </td>
                                    <td style="width: 35%">
                                        <?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?> (<?=$value['empleado_matricula']?>)<br>
                                        <?=$value['log_fecha']?>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <ul class="pagination"></ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <table class="table table-bordered footable" data-page-size="5" data-limit-navigation="7">
                            <thead>
                                <tr class="teal">
                                    <th colspan="5" class="text-center"><b>HISTORIAL DEL PACIENTE EN CAMAS</b></th>
                                </tr>
                                <tr class="">
                                    <th><b>FECHA</b></th>
                                    <th><b>CAMA</b></th>
                                    <th><b>TIPO DE ACCIÓN</b></th>
                                    <th><b>ÁREA</b></th>
                                    <th><b>EMPLEADO</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($PacientesCamas as $value) {?>
                                <tr>
                                    <td><?=$value['cama_log_fecha']?><?=$value['cama_log_hora']?></td>
                                    <td><?=$value['cama_nombre']?></td>
                                    <td><?=$value['cama_log_tipo']?></td>
                                    <td><?=$value['cama_log_modulo']?></td>
                                    <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?> (<?=$value['empleado_matricula']?>)</td>
                                    
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <ul class="pagination"></ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <table class="table table-bordered  footable" data-page-size="5" data-limit-navigation="7">
                            <thead>
                                <tr class="teal">
                                    <th colspan="4" class="text-center"><b>HISTORIAL DEL PACIENTE EN CAMAS-CAMBIOS ENFERMERA</b></th>
                                </tr>
                                <tr>
                                    <th><b>ÁREA</b></th>
                                    <th><b>CAMA</b></th>
                                    <th><b>ENFERMERO(A)</b></th>
                                    <th><b>REALIZO CAMBIO</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($PacientesEnfermera as $value) {?>
                                <tr>
                                    <td><?=$value['cambio_modulo']?></td>
                                    <td><?=$value['cama_nombre']?></td>
                                    <td>
                                        <?php $sqlEnfOld=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                                            'empleado_id'=>$value['empleado_old']
                                        ),'empleado_nombre, empleado_ap,empleado_am,empleado_matricula')[0]?>
                                        ANTERIOR: <?=$sqlEnfOld['empleado_nombre']?> <?=$sqlEnfOld['empleado_ap']?> <?=$sqlEnfOld['empleado_am']?><br>
                                        <?php $sqlEnfNew=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                                            'empleado_id'=>$value['empleado_new']
                                        ),'empleado_nombre, empleado_ap,empleado_am,empleado_matricula')[0]?>
                                        NUEVO: <?=$sqlEnfNew['empleado_nombre']?> <?=$sqlEnfNew['empleado_ap']?> <?=$sqlEnfNew['empleado_am']?>
                                    </td>
                                    <td>
                                        <?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?>
                                        <br>
                                        <?=$value['cambio_fecha']?><?=$value['cambio_hora']?>
                                    </td>
                                    
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-center">
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
<?php echo modules::run('Sections/Menu/laodFooter'); ?>
<script src="<?= base_url('assets/js/sections/Pacientes.js?'). md5(microtime())?>" type="text/javascript"></script>
