<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">USUARIOS INVOLUCRADOS EN LA ATENCIÓN DE PACIENTES DE: <b><?=$_GET['consultorio']?></b></span>
                </div>
                <input type="hidden" name="usuarios_consultorios">
                <input type="hidden" name="consultorio" value="<?=$_GET['consultorio']?>">
                <input type="hidden" name="fecha" value="<?=$_GET['fecha']?>">
                <input type="hidden" name="turno" value="<?=$_GET['turno']?>">
                
                <table class="table table-bordered table-hover footable table-consultorios-users" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                    <thead>
                        <tr>
                            <th >Matrícula</th>
                            <th data-hide="phone" >Nombre</th>
                            <th data-hide="phone">Total Consulta</th>
                            <th data-hide="phone">Total ST7</th>
                            <th data-hide="phone">Total Incapacidad</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Urgencias.js"></script>