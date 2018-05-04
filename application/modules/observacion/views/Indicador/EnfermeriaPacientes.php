<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">GESTIÓN DE PACIENTES INGRESADOS Y/O EGRESADOS POR ENFERMEROS(AS)
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th >Paciente</th>
                                        <th >Fecha Ingreso</th>
                                        <th >Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr id="<?=$value['triage_id']?>">
                                        <td><?=$value['triage_id']?> </td>
                                        <td><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> </td>
                                        <td><?=$value['observacion_fac']?> <?=$value['observacion_hac']?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url()?>Sections/Pacientes/Paciente/<?=$value['triage_id']?>" target="_blank">
                                                <i class="fa fa-share-square-o icono-accion"></i>
                                            </a>
                                        </td>
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
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Enfermeriatriage.js?').md5(microtime())?>" type="text/javascript"></script>