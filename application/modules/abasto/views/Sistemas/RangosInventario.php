<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb">
            <li><a href="<?= base_url()?>Abasto/Sistemas">Sistemas</a></li>
            <li><a href="<?= base_url()?>Abasto/Sistemas/Elementos?sistema=<?=$_GET['sistema']?>">Elementos</a></li>
            <li><a href="<?= base_url()?>Abasto/Sistemas/Rangos?sistema=<?=$_GET['sistema']?>&elemento=<?=$_GET['elemento']?>">Rangos</a></li>
            <li>Inventario</li>
        </ol>
        <div class="box-inner col-md-12 col-centered" style="margin-top: 40px"> 
            
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;">
                        INVENTARIO DE RANGOS
                    </span>
                    
                    <a  class="md-btn md-fab m-b red waves-effect pull-right tip sistemas-rango-inventario" data-rango="<?=$_GET['rango']?>">
                        <i class="mdi-av-my-library-add i-24" ></i>
                    </a>
                    <a  class="md-btn md-fab m-b red waves-effect pull-right tip " style="margin-right: 10px" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/InventarioCodigos?rango=<?=$_GET['rango']?>','Codigos de barra')">
                        <i class="fa fa-barcode i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">  
                    <div class="row">
                        <div class="col-md-7" >
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="inventario_id" class="form-control" placeholder="Buscar Inventario..">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#inventario_id" >
                                <thead>
                                    <tr>
                                        <th>SISTEMA</th>
                                        <th>ELEMENTO</th>
                                        <th>RANGO</th>
                                        <th style="width: 15%">CODIGO DE INV</th>
                                        <th style="width: 15%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <td><?=$value['rango_titulo']?></td>
                                        <td><?=$value['inventario_id']?></td>
                                        <td>
                                            <i class="fa fa-barcode i-20 color-imss pointer"></i>&nbsp;
                                            <?php if($value['inventario_status'] == 'false') {?>
                                            &nbsp;
                                            <i class="fa fa-trash-o i-20 color-imss pointer abs-inventario-eliminar" data-id="<?=$value['inventario_id']?>"></i>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="5" id="footerCeldas" class="text-center">
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
<script src="<?= base_url('assets/js/Abasto/AbsSistemas.js?').md5(microtime())?>" type="text/javascript"></script>