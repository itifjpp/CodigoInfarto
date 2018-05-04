<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <?php if($_GET['TIPO_INDICADOR']=='ST7'){?>
                        PACIENTES QUE CUENTAN CON ST7 (<?= count($Gestion)?> Pacientes)
                        <?php }else{?>
                        PACIENTES QUE CUENTAN CON HOJA DE REFERENCIA/CONTRAREFERENCIA (<?= count($Gestion)?> Pacientes)
                        <?php }?>
                    </span>
                    <?php if($_GET['TIPO']=='ST7 TERMINADA'){?>
                    <a href="#" onclick="AbrirDocumento(base_url+'Inicio/Documentos/AsistentesMedicas?TIPO_BUSQUEDA=<?=$_GET['TIPO_BUSQUEDA']?>&POR_FECHA_FECHA_I=<?=$_GET['POR_FECHA_FECHA_I']?>&POR_FECHA_FECHA_F=<?=$_GET['POR_FECHA_FECHA_F']?>&POR_HORA_FECHA=<?=$_GET['POR_HORA_FECHA']?>&POR_HORA_HORA_I=<?=$_GET['POR_HORA_HORA_I']?>&POR_HORA_HORA_F=<?=$_GET['POR_HORA_HORA_F']?>&TIPO_INDICADOR=<?=$_GET['TIPO_INDICADOR']?>')" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Generar Reporte">
                        <i class="fa fa-file-pdf-o i-24"></i>
                    </a>
                    <?php }?>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search-plus"></i>
                                </span>
                                <input type="text" id="filter" class="form-control" placeholder="Buscar paciente...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable" data-page-size="20" data-pagination-limit="7" data-filter="#filter">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">Nombre del Paciente</th>
                                        <th>N.S.S</th>
                                        <th>Fecha & Hora</th>
                                        <?php if($_GET['TIPO']=='NO ESPONTÁNEA' || $_GET['TIPO']=='ESPONTÁNEA'){?>
                                        <th>PROCEDENCIA</th>
                                        <?php }else{?>
                                        <th>TIPO</th>
                                        <?php }?>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                                        <td><?=$value['pum_nss']?> <?=$value['pum_nss_agregado']?></td>
                                        <td><?=$value['asistentesmedicas_fecha'].' '.$value['asistentesmedicas_hora']?></td>
                                        <td>
                                        <?php if($_GET['TIPO']=='NO ESPONTÁNEA' || $_GET['TIPO']=='ESPONTÁNEA'){?>
                                        <?=$value['pia_procedencia_espontanea']=='Si' ? $value['pia_procedencia_espontanea_lugar'] : $value['pia_procedencia_hospital'].' '.$value['pia_procedencia_hospital_num']?>
                                        <?php }else{?>
                                        <?=$_GET['TIPO']?>
                                        <?php }?>
                                        </td>
                                        <td>
                                            <?php if($value['pia_lugar_accidente']=="TRABAJO"){?>
                                            <i class="fa fa-file-pdf-o icono-accion tip pointer" onclick="AbrirDocumento('<?= base_url()?>Inicio/Documentos/ST7/<?=$value['triage_id']?>')" data-original-title="Generar ST7"></i>
                                            
                                            <?php }?>
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
                        <hr>
                        <input type="hidden" name="INDICADOR_AM" value="INDICADOR">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/Asistentemedica.js?').md5(microtime())?>" type="text/javascript"></script>