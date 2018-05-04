<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered" style="margin-top: 10px"> 
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="#">Inicio</a></li>
                <li><a style="text-transform: uppercase" href="#">RELACIONES DE SALIDAS DE MATERIALES</a></li>
            </ol>  
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>RELACIÓN DE SALIDAS DE ALMACEN DE MATERIALES DE OSTEOSINTESIS</strong><br>
                    </span>
                    <a href="<?= base_url()?>Abasto/Inventario/NuevaRelaciondeSalida?temp=<?= date('YmdHis')?>" class="md-btn md-fab m-b red waves-effect pull-right tip ">
                        <i class="mdi-av-my-library-add i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="filter" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#filter" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">FECHA & HORA</th>
                                        <th style="width: 30%">USUARIO QUE GENERÓ SALIDA</th>
                                        <th style="width: 20%">TOTAL MATERIALES</th>
                                        <th>ESTADO</th>
                                        <th style="width: 10%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['rc_fecha']?> <?=$value['rc_hora']?></td>
                                        <td><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                                        <td>
                                            <?php 
                                            $sql=$this->config_mdl->sqlGetDataCondition('abs_reporte_consumo_in',array(
                                                'rc_id'=>$value['rc_id']
                                            ));
                                            echo count($sql).' MATERIALES';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($value['rc_status']=='En Espera'){?>
                                            <span class="label red">EN ESPERA DE REPORTE</span>
                                            <?php }if($value['rc_status']=='En Espera de Devolucion'){?>
                                            <a href="<?= base_url()?>Abasto/Inventario/DevolucionMateriales?rc=<?=$value['rc_id']?>">
                                                <span class="label amber">EN ESPERA DE DEVOLUCIÓN</span>
                                            </a>
                                            <?php }if($value['rc_status']=='Reporte Completado'){?>
                                            <span class="label green">FINALIZADO</span>
                                            <?php }?>
                                        <td>
                                            <i class="fa fa-file-pdf-o color-imss i-20 pointer" onclick="AbrirDocumento(base_url+'Inicio/Documentos/GenerarRelaciondeSalida?rc=<?=$value['rc_id']?>')"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>