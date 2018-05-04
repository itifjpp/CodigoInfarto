<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#"><?=$_SESSION['UMAE_AREA']?></a></li>
                <li><a href="#">Reportes</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">
                        <div class="row">
                            <div class="col-md-6" style="font-size: 15px;text-transform: uppercase">
                                <?=$_SESSION['UMAE_AREA']?><br>
                                Total de Pacintes: <?=  count($Gestion)?> Pacientes
                            </div>
                        </div>
                    </span>
                </div>
                <div class="panel-body  show-hide-grafica-panel" >
                    <div class="" style="margin-bottom: 10px">
                        <div class="row">
                            <div class="col-md-2" style='padding-right: 0px'>
                                <select class="width100 select_filter" data-value="<?=$_GET['filter_select']?>">
                                    <option>Buscar por</option>
                                    <option value="by_fecha">Fechas</option>
                                    <option value="by_hora">Hora</option>
                                </select>
                            </div>
                            <form action="<?=  base_url()?>observacion/reportes" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="ff" value="<?=$_GET['ff']?>" placeholder="AL " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>">
                                    <button class="btn btn-primary">Buscar</button>
                                </div>
                            </form>

                            <form action="<?=  base_url()?>observacion/reportes" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="hi" value="<?=$_GET['hi']?>" placeholder="DE " class="clockpicker form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="hf" value="<?=$_GET['hf']?>" placeholder="A" class="clockpicker form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>">
                                    <button class="btn btn-primary">Buscar</button>
                                </div>
                            </form>
                            
                            <div class="col-md-4 pull-right hide">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control" id="filter" placeholder="Filtro General">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table m-b-none table-filtros table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                        <thead>
                            <tr>
                                <th data-sort-ignore="true">Ingreso</th>
                                <th data-sort-ignore="true">Salida</th>
                                <th data-hide="phone" data-sort-ignore="true" style="width: 20%">Nombre</th>
                                <th data-hide="phone" data-sort-ignore="true">Cama</th>
                                <th data-hide="phone" data-sort-ignore="true">Alta a</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_filas=  count($Gestion);
                            $total_minutos=0;
                            ?>
                            <?php foreach ($Gestion as $value) {?>
                            <?php 
                                if($value['triage_color']=='Rojo'){
                                    $background='red';
                                    $color='white';
                                }else if($value['triage_color']=='Naranja'){
                                    $background='orange';
                                    $color='white';
                                }else if($value['triage_color']=='Amarillo'){
                                    $background='yellow-A700';
                                    $color='white';
                                }else if($value['triage_color']=='Verde'){
                                    $background='green';
                                    $color='white';
                                }else if($value['triage_color']=='Azul'){
                                    $background='indigo';
                                    $color='white';
                                }else{
                                    $background='';
                                    $color='';
                                }
                            ?>
                            <tr id="<?=$value['triage_id']?>">
                                <td><?=$value['observacion_fl']?> <?=$value['observacion_hl']?></td>
                                <td><?=$value['observacion_fs']?> <?=$value['observacion_hs']?></td>
                                <td class="<?=$background?>" style="color: <?=$color?>">
                                    <?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?>             
                                </td>
                                <td><?=$value['observacion_cama_nombre']?></td>
                                <td><?=$value['observacion_alta']?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot class="hide-if-no-paging">
                        <tr>
                            <td colspan="7" class="text-center">
                                <ul class="pagination"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" name="total_minutos" value="<?=  ceil($total_minutos/$total_filas)?>"> 
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>