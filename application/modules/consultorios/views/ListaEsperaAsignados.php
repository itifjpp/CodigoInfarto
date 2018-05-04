<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">LISTA DE PACIENTES ASIGNADOS A CONSULTORIOS</h4>
                    </div>
                    <div class="grid-body">
                        
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon no-border sigh-background-secundary" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filter" placeholder="BUSCAR...">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-5">
                                <div class="alert alert-info pull-right">
                                    <h4 class="no-margin">
                                        <b><?= count($Gestion)?></b> Pacientes Asignados&nbsp;&nbsp;&nbsp; <i class="material-icons i-24 sigh-color pointer" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ListaEsperaConsultorios?tipo=Asignados','Lista de Espera Asignados')">picture_as_pdf</i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#filter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">N° DE FOLIO</th>
                                            <th style="width: 18%;">PACIENTE</th>
                                            <th style="width: 10%">SEXO</th>
                                            <th style="width: 10%">CLASIFICACIÓN</th>
                                            <th style="width: 15%" >T. TRANSCURRIDO</th>
                                            <th style="width: 20%">C. ASIGNADO</th>
                                            <th style="width: 10%">M. INGRESO</th>
                                            <th style="width: 12%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <?php 
                                        if($value['lista_espera_date']!=''){
                                            $Diff= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                'Tiempo1'=>$value['lista_espera_fecha'].' '.$value['lista_espera_time'],
                                                'Tiempo2'=> date('Y-m-d H:i')
                                            )); 
                                        }
                                        ?>
                                        <tr id="<?=$value['ingreso_id']?>" >
                                            <td><?=$value['ingreso_id']?></td>
                                            <td style="font-size: 12px">
                                                <?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?>
                                            </td>
                                            
                                            <td><?=$value['paciente_sexo']?></td>
                                            <td><?=$value['ingreso_clasificacion']?></td>
                                            <td ><?=$Diff->d?> Días <?=$Diff->h?> Hrs <?=$Diff->i?> Min</td>
                                            <td >
                                                <div style="position: relative">
                                                    <span class="label label-success tip" style="position: absolute;top: -10px;right: -10px" data-original-title="<?=$value['lista_espera_eventos']?> Eventos"><?=$value['lista_espera_eventos']?></span>
                                                </div>
                                                <div style="position: relative">
                                                    <span class="label label-success pointer ver-detalles-medico" data-matricula="<?=$value['empleado_matricula']?>" data-nombre="<?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?>" data-perfil="<?=$value['empleado_perfil']=='' ?'defautl_.png':$value['empleado_perfil']?>" style="position: absolute;top: -10px;right: 20px"><i class="fa fa-user"></i></span>
                                                </div>
                                                <?=$value['lista_espera_consultorio']?>
                                            </td>
                                            <td><?=$value['empleado_matricula']?></td>
                                            <td >
                                                <a href="#" class="hide">
                                                    <i class="fa fa-clock-o sigh-color i-20"></i>
                                                </a>&nbsp;
                                                <a href="<?= base_url()?>Sections/Documentos/Expediente/<?=$value['ingreso_id']?>?tipo=Consultorios&url=Enfermería">
                                                    <i class="fa fa-folder-open-o sigh-color i-20 tip" data-original-title="Expediente"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-times sigh-color i-20 pointer tip lista-espera-quitar" data-id="<?=$value['lista_espera_id']?>" data-ingreso="<?=$value['ingreso_id']?>" data-original-title="Eliminar de la Lista de Ingresados"></i>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="8" class="text-center">
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
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Consultorios.js?<?= date('YmdHis')?>" type="text/javascript"></script>
