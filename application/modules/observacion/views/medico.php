<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">   
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">MÉDICO OBSERVACIÓN</h4>
                    </div>
                    <div class="grid-body">
                        <div class="" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group m-b ">
                                        <span class="input-group-addon sigh-background-secundary no-border" >
                                            <i class="fa fa-user-plus"></i>
                                        </span>
                                        <input type="number" class="form-control" name="ingreso_id" placeholder="INGRESAR N° DE FOLIO">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-no-padding footable m-t-10">
                                        <thead>
                                            <tr>
                                                <th style="width: 14%">N° DE INGRESO</th>
                                                <th style="width: 24%">PACIENTE</th>
                                                <th style="width: 10%">SEXO</th>
                                                <th style="width: 13%">CLASIFICACION</th>
                                                <th style="width: 14%">INGRESO</th>
                                                <th>INTERCONSULTA</th>
                                                <th style="width: 12%">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($Observacion as $value) {?>
                                            <tr>
                                                <td><?=$value['ingreso_id']?></td>
                                                <td><?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?></td>
                                                <td><?=$value['paciente_sexo']?></td>
                                                <td><?=$value['ingreso_clasificacion']?></td>
                                                <td><?=$value['observacion_date_medico_i']?> <?=$value['observacion_time_medico_i']?></td>
                                                <td>
                                                    <?php if($value['observacion_medico_status']=='Interconsulta'){
                                                        echo '<br>';
                                                        $sqlInterconsulta=$this->config_mdl->sqlGetDataCondition('sigh_doc430200',array(
                                                            'ingreso_id'=>$value['ingreso_id'],
                                                            'doc_modulo'=>'Observación',
                                                        ));
                                                        $Total= count($sqlInterconsulta);
                                                        $Evaluados=0;
                                                        foreach ($sqlInterconsulta as $value_st) {
                                                        ?>
                                                                <?php 
                                                                if($value_st['doc_estatus']=='En Espera'){
                                                                ?>
                                                                <p>
                                                                    <span class="label label-warning pointer text-nowrap" onclick="AbrirDocumento(base_url+'Inicio/Documentos/DOC430200/<?=$value_st['doc_id']?>')"><?=$value_st['doc_servicio_solicitado']?></span>
                                                                </p>
                                                                <?php   
                                                                }else{
                                                                    $Evaluados++;
                                                                ?>
                                                                <p>
                                                                <a href="#" onclick="AbrirVista(base_url+'Sections/Documentos/InterconsultasDetalles?inter=<?=$value_st['doc_id']?>')" >
                                                                    <span class="label label-success"><?=$value_st['doc_servicio_solicitado']?></span>
                                                                </a>
                                                                </p>
                                                                <?php
                                                                }

                                                            }
                                                    }?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url()?>Sections/Documentos/Expediente/<?=$value['ingreso_id']?>/?tipo=Observación">
                                                        <i class="fa fa-folder-open sigh-color i-20 tip" data-original-title="Ver Expediente del Paciente"></i>
                                                    </a>&nbsp;
                                                    <i class="fa fa-drivers-license-o i-20 sigh-color tip interconsulta-paciente pointer" data-ce="<?=$value['ce_id']?>" data-consultorio="<?=$value['ingreso_consultorio']?>;<?=$value['ingreso_consultorio_nombre']?>" data-id="<?=$value['ingreso_id']?>" data-original-title="Solicitar Interconsulta"></i>&nbsp;
                                                    <?php //if($value['observacion_medico_status']=='Ingreso'){ ?>
                                                    <i class="fa fa-share-square-o sigh-color i-20 tip obs-medico-alta pointer" data-id="<?=$value['ingreso_id']?>" data-original-title="Alta Paciente"></i>
                                                    <?php //}?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="hide-if-no-paging">
                                                <td colspan="7" class="text-center">
                                                    <ul class="pagination"></ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <input type="hidden" name="observacion_alta">
                            <input type="hidden" name="accion_area_acceso" value="Observación">
                            <input type="hidden" name="accion_rol" value="Médico">
                            <input type="hidden" name="especialidad_nombre" value="<?=$info['empleado_servicio']?>">
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Observacion.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>