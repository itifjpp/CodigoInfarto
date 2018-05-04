<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Lista de Pacientes en Consultorios de Especialidad & Filtro</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-user-plus"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="<?= base_url()?>Inicio/Documentos/ListaPacientesAsignados" target="_blank">
                                    <button class="btn btn-primary btn-block">Pacientes Asignados</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="<?= base_url()?>Inicio/Documentos/ListaPacientesEnEspera" target="_blank">
                                    <button class="btn btn-primary btn-block">Pacientes No Asignados</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover footable "  data-filter="#filter" data-page-size="20" data-limit-navigation="7">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Nombre</th>
                                <th>Ingreso</th>
                                <th>Tiempo Consultorio</th>
                                <th>Consultorio Asignado</th>
                                <th data-hide="all">Alta</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $value) {?>
                            <?php $t_c=Modules::run('Config/CalcularTiempoTranscurrido',array('Tiempo1'=> str_replace('/', '-', $value['ce_fe']).' '.$value['ce_he'],'Tiempo2'=>date('d-m-Y').' '.date('H:i')));?>
                            <tr id="<?=$value['triage_id']?>" >
                                <td style="font-size: 10px" class="<?=($t_c->h>7 || $t_c->d>0 ? 'red' : '')?>">
                                    <?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> 
                                </td>
                                <td class="<?=($t_c->h>7 || $t_c->d>0 ? 'red' : '')?>"><?=$value['ce_fe']?> <?=$value['ce_he']?></td>
                                <td class="<?=($t_c->h>7 || $t_c->d>0 ? 'red' : '')?>"><?=$t_c->d?> Días <?=$t_c->h?> Horas <?=$t_c->i?> Minutos</td>
                                <td class="<?=($t_c->h>7 || $t_c->d>0 ? 'red' : '')?>"><?=$value['ce_asignado_consultorio']?></td>
                                <td class="<?=($t_c->h>7 || $t_c->d>0 ? 'red' : '')?>"><?=$value['ce_hf']==''? 'Sin Especificar' : $value['ce_hf'] ?></td>
                                <td class="text-center">
                                    <i class="fa fa-user-times icono-accion pointer tip alta-paciente" data-id="<?=$value['triage_id']?>" data-original-title="Alta Paciente"></i>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                        <tfoot class="hide-if-no-paging">
                        <tr>
                            <td colspan="7" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url()?>assets/js/sections/Listas.js?<?= md5(microtime())?>" type="text/javascript"></script> 