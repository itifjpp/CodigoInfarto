<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin semi-bold">SOLICITUDES DE RX</h4>
                        <a class="md-btn md-fab m-b sigh-background-primary pull-right btn-rx-nueva-solicitud" data-id="0" data-dx="" data-ingreso="<?=$_GET['folio']?>" data-accion="add" href="#" style="position: absolute;top: 15px;right: 0px">
                            <i class="material-icons i-24 color-white">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-no-padding table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 16%">FECHA & HORA</th>
                                            <th style="width: 45%">DX PRESUNCIONAL</th>
                                            <th style="width: 25%">MÉDICO SOLICITANTE</th>
                                            <th style="width: 14%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['solicitud_fecha']?> <?=$value['solicitud_hora']?></td>
                                            <td>
                                                <?=$value['solicitud_dx_presuncional']?>
                                                <?php
                                                $sqlEstudio=$this->config_mdl->sqlGetDataCondition('sigh_rx_solicitudes_estudios',array(
                                                    'solicitud_id'=>$value['solicitud_id']
                                                ));
                                                ?>
                                            </td>
                                            <td>
                                                <?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?><br>
                                                <?php 
                                                if(count($sqlEstudio)>0){
                                                ?>
                                                <span class="label blue"><?=count($sqlEstudio)?> ESTUDIOS SOLICITADOS</span>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <i class="fa fa-pencil sigh-color i-20 pointer btn-rx-nueva-solicitud" data-id="<?=$value['solicitud_id']?>" data-dx="<?=$value['solicitud_dx_presuncional']?>" data-ingreso="<?=$_GET['folio']?>" data-accion="edit"></i>&nbsp;
                                                <a href="#" onclick="AbrirVista(base_url+'Rx/AgregarEstudios?sol=<?=$value['solicitud_id']?>&folio=<?=$_GET['folio']?>&via=Expediente',900,500)">
                                                    <i class="fa fa-clone sigh-color i-20"></i>
                                                </a>&nbsp;
                                                <?php if(count($sqlEstudio)>0){?>
                                                <i class="fa fa-file-pdf-o i-20 sigh-color pointer tip" data-original-title="Generar Hoja de Solicitud de Estudios de Rx" onclick="AbrirVista(base_url+'Inicio/Documentos/SolicitudRx?sol=<?=$value['solicitud_id']?>&folio=<?=$_GET['folio']?>')"></i>
                                                &nbsp;
                                                <?php }?>
                                                <i class="fa fa-trash-o sigh-color pointer i-20 no-accion" data-id="<?=$value['solicitud_id']?>"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Rx.js?<?= md5(microtime())?>"></script>

