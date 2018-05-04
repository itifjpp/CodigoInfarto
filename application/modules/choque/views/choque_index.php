<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple " >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white semi-bold no-margin">LISTA DE INGRESO DE PACIENTES EN CHOQUE</h4>

                    </div>
                    <div class="grid-body">

                        <div class="row">
                            <div class="col-md-offset-2 col-md-5 text-center">
                                <h2 class="m-t-30 semi-bold"><?=$this->sigh->getInfo('hospital_clasificacion')?> - <?=$this->sigh->getInfo('hospital_tipo')?></h2> 
                                <h4><?=$this->sigh->getInfo('hospital_nombre')?></h4> 
                            </div>
                            <div class="col-md-3">
                                <center>
                                    <style>
                                        .agregar-horacero-pacientess i{ color: white;}.agregar-horacero-pacientess i:hover{color: white;}
                                    </style>
                                    <a href="<?= base_url()?>Choque/NuevoPaciente" class="agregar-horacero-pacientess btn sigh-background-secundary waves-effect " style="width: 100px;height: 100px;padding: 20px;text-align: center">
                                        <i class="material-icons fa-4x">person_add</i>
                                    </a>
                                </center>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12 m-t-10">
                                <table class="table table-bordered footable table-choque-index table-no-padding" data-pagination="10" style="font-size: 13px">
                                    <thead class="back-imss">
                                        <tr>
                                            <th>TIPO PAC.</th>
                                            <th style="width: 27%">NOMBRE/PSEUDONIMO</th>
                                            <th>N.S.S / RFC</th>
                                            <th>SEXO</th>
                                            <th>INGRESO</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6">
                                                <center>
                                                    <i class="fa fa-spinner fa-pulse fa-3x"></i>
                                                    <h5>CARGANDO LISTA DE PACIENTES...</h5>
                                                </center>
                                            </td>
                                        </tr>
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
</div>
<input type="hidden" name="LoadAjaxPacientes" value="Si">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Choque.js?').md5(microtime())?>" type="text/javascript"></script>