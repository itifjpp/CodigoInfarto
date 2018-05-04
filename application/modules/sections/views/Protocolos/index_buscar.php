<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin text-uppercase">BUSCAR PACIENTES</h4>
                        <a href="<?= base_url()?>Sections/Protocolos/Pacientes?protocolo=<?=$_GET['protocolo']?>" class="btn btn-circle red btn-60 pull-left" style="position: absolute;left: -25px;">
                            <i class="fa fa-arrow-left color-white i-24" ></i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-primary no-border">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="empleado_nombre" class="form-control">
                                </div>
                                
                            </div>
                            <div class="col-md-2">
                                <button class="btn sigh-background-primary btn-block btn-buscar">BUSCAR</button>
                            </div>
                        </div>
                        <div class="row m-t-10">

                            <div class="col-md-12">
                                <h6 class="inputSelectNombre hide" style="color: red;margin-top: -10px"><i class="fa fa-warning"></i> ESTA CONSULTA ESTA LIMITADA A: 100 REGISTROS</h6>
                                <table class="footable table table-bordered table-no-padding" id="tableResultSearch" data-filter="#search" data-page-size="10" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th data-sort-ignore="true" style="width: 70%">NOMBRE DEL PACIENTE</th>
                                            <th data-sort-ignore="true" style="width: 70%">ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center">
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
<input name="protocolo_id" value="<?=$_GET['protocolo']?>" type="hidden">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Protocolos.js?'). md5(microtime())?>" type="text/javascript"></script> 