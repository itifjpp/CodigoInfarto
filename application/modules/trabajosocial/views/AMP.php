<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>NOTIFICACIONES AL MINISTERIO PUBLICO</strong><br>
                    </span>
                    
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="triage_id" id="triage_id" class="form-control" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#triage_id" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>NOMBRE DEL PACIENTE</th>
                                        <th>N.S.S</th>
                                        <th>FECHA Y HORA</th>
                                        <th>ESTATUS</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_nombre']=='' ? $value['triage_nombre_pseudonimo'] : $value['triage_nombre'].' '.$value['triage_nombre_ap'].' '.$value['triage_nombre_am']?> </td>
                                        <td>
                                            <?=$value['triage_paciente_afiliacion']?>
                                        </td>
                                        <td><?=$value['mp_fecha']?> <?=$value['mp_hora']?></td>
                                        <td>
                                            <?php if($value['mp_estatus']=='Enviado'){?>
                                            <span class="label orange">Enviado</span>
                                            <?php }else{?>
                                            <span class="label green">Recibido</span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($value['mp_estatus']=='Enviado'){ ?>
                                            <i class="fa fa-pencil-square-o icono-accion pointer tip marcar-como-recibido" data-id="<?=$value['mp_id']?>" data-triage="<?=$value['triage_id']?>" data-original-title="Marcar como Recibido"></i>
                                            <?php }else{?>
                                            <i class="fa fa-file-pdf-o icono-accion tip pointer" data-original-title="Generar Documento de Aviso al Ministerio Público" onclick="AbrirDocumento(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/<?=$value['triage_id']?>')"></i>
                                            &nbsp;
                                            <i class="fa fa-check-square-o icono-accion pointer tip marcar-como-terminado" data-id="<?=$value['mp_id']?>" data-original-title="Marcar como Terminado"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="5" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/TrabajoSocial.js?').md5(microtime())?>" type="text/javascript"></script>