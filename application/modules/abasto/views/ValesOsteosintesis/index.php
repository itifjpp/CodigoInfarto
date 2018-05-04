<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 no-padding">
            <ol class="breadcrumb">
                <li><a href="<?= base_url()?>Sections/Documentos/TratamientoQuirurgico/<?=$_GET['folio']?>" class="finalizar-tratamiento-url">Tratamiento Quirúrgicos</a></li>
                <li><a href="<?= base_url()?>Abasto/ValeOsteosintesis?tratamiento=<?=$_GET['tratamiento']?>&folio=<?=$_GET['folio']?>&show=Sistemas">Sistemas</a></li>
                <?php if($_GET['show']=='Elementos' || $_GET['show']=='Rangos'){?>
                <li>
                    <a href="<?= base_url()?>Abasto/ValeOsteosintesis?tratamiento=<?=$_GET['tratamiento']?>&folio=<?=$_GET['folio']?>&show=Elementos&sistema=<?=$_GET['sistema']?>">Elementos</a>
                </li>
                <?php }?>
                <?php if($_GET['show']=='Rangos'){?>
                <li>
                    <a href="<?= base_url()?>Abasto/ValeOsteosintesis?tratamiento=<?=$_GET['tratamiento']?>&folio=<?=$_GET['folio']?>&show=Rangos&sistema=<?=$_GET['sistema']?>&elemento=<?=$_GET['elemento']?>">Rangos</a>
                </li>
                <?php }?>
            </ol>
        </div>
        <div class="box-inner col-md-10 col-centered" style="margin-top: 50px"> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong class="mayus-bold"><?=$_GET['show']?></strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">  
                    <div class="row">
                        <div class="col-md-7">
                            <div class="input-with-icon">
                                <i class="fa fa-search"></i>
                                <input type="text" id="filter" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <table class="table table-hover table-bordered footable table-no-padding " data-page-size="4" data-filter="#filter">
                                <thead>
                                    <tr>
                                        <th>SISTEMA</th>
                                        <?php if($_GET['show']=='Elementos' || $_GET['show']=='Rangos'){ ?>
                                        <th>ELEMENTO</th>
                                        <?php }?>
                                        <?php if($_GET['show']=='Rangos'){ ?>
                                        <th>RANGO</th>
                                        <?php }?>
                                        <th style="width: 10%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <?php if($_GET['show']=='Elementos' || $_GET['show']=='Rangos'){ ?>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <?php }?>
                                        <?php if($_GET['show']=='Rangos'){ ?>
                                        <td><?=$value['rango_titulo']?></td>
                                        <?php }?>
                                        <td class="text-center">
                                            <?php if($_GET['show']=='Sistemas'){ ?>
                                            <a href="<?= base_url()?>Abasto/ValeOsteosintesis?tratamiento=<?=$_GET['tratamiento']?>&folio=<?=$_GET['folio']?>&show=Elementos&sistema=<?=$value['sistema_id']?>">
                                                <i class="fa fa-window-restore i-20 color-imss tip" data-original-title="Elementos"></i>
                                            </a>
                                            <?php }else if($_GET['show']=='Elementos'){?>
                                            <a href="<?= base_url()?>Abasto/ValeOsteosintesis?tratamiento=<?=$_GET['tratamiento']?>&folio=<?=$_GET['folio']?>&show=Rangos&sistema=<?=$value['sistema_id']?>&elemento=<?=$value['elemento_id']?>">
                                                <i class="fa fa-window-restore i-20 color-imss tip" data-original-title="Rangos"></i>
                                            </a>
                                            <?php }else if($_GET['show']=='Rangos'){?>
                                            <i class="mdi-av-my-library-add i-20 color-imss pointer agregar-solicitud-rangos" data-rango="<?=$value['rango_id']?>" data-procedimiento="<?=$_GET['tratamiento']?>"></i>
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
                    </div>
                </div>
            </div>
            <div class="panel panel-default <?=$_GET['show']=='Rangos' ? '':'hide'?>">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong class="mayus-bold">VALE DE SERVICIO</strong><br>
                    </span>
                    <div style="position: relative;">
                        <a href="#" class="md-btn md-fab m-b red waves-effect pull-right tip" data-original-title="Ver Solicitud de Vale de Servicio" style="position: absolute;top: -39px;right: 60px">
                            <i class="mdi-content-content-paste i-24" ></i>
                        </a>
                        <a href="#" class="md-btn md-fab m-b red waves-effect pull-right tip btn-finalizar-vs" data-tratamiento="<?=$_GET['tratamiento']?>" data-original-title="Guardar y Terminar Solicitud de Vale de Servicio" style="position: absolute;top: -39px;right: 0px">
                            <i class="fa fa-floppy-o i-24" ></i>
                        </a>
                    </div>
                    
                </div>
                <div class="panel-body b-b b-light">  
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 10px">
                            <table class="table table-hover table-bordered footable table-no-padding " data-page-size="20" >
                                <thead>
                                    <tr>
                                        <th>RANGO</th>
                                        <th>CANTIDAD SOLICITADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Rango=$_GET['rango'];
                                    $Procedimiento=$_GET['tratamiento'];
                                    $sqlSolicitudes=$this->config_mdl->sqlQuery("SELECT * FROM abs_rangos r 
                                                                                INNER JOIN abs_vale_solicitud vs
                                                                                ON(r.rango_id=vs.rango_id AND vs.procedimiento_id=$Procedimiento )");
                                    foreach ($sqlSolicitudes as $vs) {
                                    ?>
                                    <tr>
                                        <td><?=$vs['rango_titulo']?></td>
                                        <td><?=$vs['vale_cantidad']?></td>
                                        <td class="text-center">
                                            <i class="fa fa-trash-o i-20 color-imss eliminar-vs-solicitud pointer" data-id="<?=$vs['vale_id']?>" data-rango="<?=$vs['rango_id']?>" data-procedimiento="<?=$vs['procedimiento_id']?>"></i>
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
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Abasto/AbsValeOsteosintesis.js?').md5(microtime())?>" type="text/javascript"></script>