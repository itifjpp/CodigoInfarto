<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>MÉDICO CHOQUE</strong><br>
                    </span>
                    
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="filter_medico_choque" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable table-no-padding table-choque-medicos" data-filter="#filter_medico_choque" data-page-size="10" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">TIPO PAC.</th>
                                        <th style="width: 20%">NOMBRE/PSEUDONIMO</th>
                                        <th>N.S.S</th>
                                        <th>SEXO</th>
                                        <th>INGRESO</th>
                                        <th style="width:10%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            <i class="fa fa-spinner fa-pulse fa-4x"></i>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td class="text-center" colspan="6">
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
<input type="hidden" name="AjaxChoqueMedico" value="Si">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Choque.js?').md5(microtime())?>" type="text/javascript"></script>