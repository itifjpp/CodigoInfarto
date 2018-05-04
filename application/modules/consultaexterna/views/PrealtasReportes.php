<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>REPORTES DE PRE-ALTAS</strong>
                    </span>
                    <a  href="#" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ReportesPrealtas?getFecha=<?=$_GET['getFecha']?>&getValidacion=<?=$_GET['getValidacion']?>')" class="md-btn md-fab m-b red waves-effect pull-right" data-placement="left">
                        <i class="fa fa-cloud-download i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form method="GET" action="<?= base_url()?>Consultaexterna/ReportesPrealtas">
                            <div class="col-md-5">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss border-back-imss">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" value="<?=$_GET['getFecha']?>" class="form-control dp-yyyy-mm-dd" name="getFecha" placeholder="Buscar...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="getValidacion" data-value="<?=$_GET['getValidacion']?>">
                                    <option value="">PREALTAS</option>
                                    <option value="ALTA EFECTIVA">ALTA EFECTIVA</option>
                                    <option value="ALTA CANCELADA">ALTA CANCELADA</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-block">Buscar</button>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-no-padding footable" data-filter="#filter" data-page-size="10" data-limit-navigation="4">
                                <thead>
                                    <tr>
                                        <th>N° DE FOLIO</th>
                                        <th>PACIENTE</th>
                                        <th>FECHA DE PRE-ALTA</th>
                                        <th>CAMA</th>
                                        <th>SERVICIO</th>
                                        <th>ESTADO VALIDACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_id']?></td>
                                        <td><?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> <?=$value['triage_nombre']?></td>
                                        <td><?=$value['prealta_fecha']?> <?=$value['prealta_hora']?></td>
                                        <td><?=$value['cama_nombre']?></td>
                                        <td><?=$value['area_nombre']?></td>
                                        <td><?=$value['prealta_confirm']=='' ? 'PRE-ALTA':$value['prealta_confirm']?></td>
                                        
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="6" class="text-center">
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
<script src="<?= base_url('assets/js/ConsultaExterna.js?').md5(microtime())?>" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $('select[name=getValidacion]').val($('select[name=getValidacion]').attr('data-value'))
})
</script>