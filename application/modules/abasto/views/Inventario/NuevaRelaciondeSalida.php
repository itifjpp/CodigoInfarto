<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered" style="margin-top: 10px"> 
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="#">INICIO</a></li>
                <li><a style="text-transform: uppercase" href="#">RELACIONES DE SALIDA</a></li>
                <li><a style="text-transform: uppercase" href="#">GENERAR NUEVO REPORTE</a></li>
            </ol>  
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <a href="<?= base_url()?>Abasto/Inventario/RelaciondeSalidas" class="md-btn md-fab m-b red waves-effect" style="position: absolute;left: -30px">
                        <i class="fa fa fa-arrow-left i-24" ></i>
                    </a>
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>NUEVA RELACIÓN DE SALIDA DE MATERIALES DE OSTEOSINTESIS</strong><br>
                    </span>
                    <a href="#" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/GenerarRelaciondeSalida?rc=<?=$LastId?>','RELACION DE CONSUMOS')" class="md-btn md-fab m-b red waves-effect tip " style="position: absolute;right: 0px;top: 50px" data-original-title="Generar Documento de Relación de Salidad">
                        <i class="fa fa-cloud-download i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="hidden" name="rc_id" value="<?=$LastId?>">
                                <input type="text" name="inventario_id" class="form-control" placeholder="INGRESAR CODIGO DEL MATERIAL...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#sistema_id" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">SISTEMA</th>
                                        <th style="width: 30%">ELEMENTO</th>
                                        <th style="width: 25%">RANGO</th>
                                        <th style="width: 10%">FOLIO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <td><?=$value['rango_titulo']?></td>
                                        <td><?=$value['inventario_id']?></td>
                                        <td class="text-center">
                                            <i class="fa fa-trash-o color-imss i-20 pointer eliminar-rc-in" data-inventario="<?=$value['inventario_id']?>"></i>
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
<script src="<?= base_url('assets/js/Abasto/AbsInventario.js?').md5(microtime())?>" type="text/javascript"></script>