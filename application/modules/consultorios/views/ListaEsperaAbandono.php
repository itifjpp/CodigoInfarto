<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">LISTA DE PACIENTES CON ABANDONO DEL SERVICIO</h4>
                    </div>
                    <div class="grid-body">
                        
                        <div class="row ">
                            <form method="GET" action="<?= base_url()?>Consultorios/ListaEsperaAbandono">
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon no-border sigh-background-secundary" >
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control dp-yyyy-mm-dd" name="inputDateStart" value="<?=$_GET['inputDateStart']?>" placeholder="FECHA DE INICIO">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon no-border sigh-background-secundary" >
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control dp-yyyy-mm-dd" name="inputDateEnd" value="<?=$_GET['inputDateEnd']?>" placeholder="FECHA DE TÉRMINO">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <button class="btn sigh-background-secundary btn-block">BUSCAR</button>
                                </div>
                                <div class="col-xs-offset-1 col-xs-3">
                                    <div class="alert alert-info">
                                        <h4 class="no-margin text-right pointer" <?php if(isset($_GET['inputDateStart'])){?> onclick="OpenLoadView(base_url+'Inicio/Documentos/ListaEsperaAbandono?inpuDateStart=<?=$_GET['inputDateStart']?>&inputDateEnd=<?=$_GET['inputDateEnd']?>')" <?php } ?>>
                                            <?= count($Gestion)?> PACIENTES <i class="material-icons sigh-color i-24 text-right">picture_as_pdf</i>
                                        </h4>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#filter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 12%">N° DE FOLIO</th>
                                            <th style="width: 22%;">PACIENTE</th>
                                            <th style="width: 11%">CLASIFICACIÓN</th>
                                            <th style="width: 16%" >INGRESO</th>
                                            <th style="width: 16%">ÚLTIMA LLAMADA</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr id="<?=$value['ingreso_id']?>" >
                                            <td><?=$value['ingreso_id']?></td>
                                            <td style="font-size: 12px">
                                                <?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?>
                                            </td>
                                            <td><?=$value['ingreso_clasificacion']?></td>
                                            <td><?=$value['ingreso_date_horacero']?> <?=$value['ingreso_time_horacero']?></td>
                                            <td><?=$value['lista_espera_date']?> <?=$value['lista_espera_time']?></td>
                                            <td >
                                                <a href="<?= base_url()?>Sections/Documentos/Expediente/<?=$value['ingreso_id']?>?tipo=Consultorios&url=Enfermería">
                                                    <i class="fa fa-folder-open-o sigh-color i-20 tip" data-original-title="Expediente"></i>
                                                </a>
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
