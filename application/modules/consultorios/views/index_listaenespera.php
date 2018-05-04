<?= Modules::run('Sections/Menu/loadHeader')?>
<div class="page-content">
    <div class="content">
        <div class="row ">
            <div class=" col-xs-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary" >
                        <a href="<?=  base_url()?>Consultorios" class="btn sigh-background-primary pull-left" style="margin-top: 15px;margin-left: -40px">
                            <i class="fa fa-arrow-left i-24 color-white"></i>
                        </a>
                        <h4 class="no-margin color-white">LISTA DE ESPERA PARA INGRESO A CONSULTORIOS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row no-margin">
                            <div class="col-xs-6" style="padding-left: 0px">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-primary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" name="inputSearch" class="form-control" placeholder="BUSCAR PACIENTE...">
                                </div>
                            </div>
                            <div class="col-xs-2"></div>
                            <div class="col-xs-1 sigh-background-primary">
                                <h4 class="color-white text-center bold h4-le-total">0</h4>
                            </div>
                            <div class="col-xs-1 bg-yellow">
                                <h4 class="color-white text-center bold h4-turno-amarillo">0/0</h4>
                            </div>
                            <div class="col-xs-1 bg-green">
                                <h4 class="color-white text-center bold h4-turno-verde">0/0</h4>
                            </div>
                            <div class="col-xs-1 bg-blue">
                                <h4 class="color-white text-center bold h4-turno-azul">0/0</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 m-t-10">
                                <table class="table table-bordered table-hover table-no-padding lista-pacientes-espera footable table-striped" data-page-size="25">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%" colspan="2">FOLIO INGRESO</th>
                                            <th style="width: 20%">PACIENTE</th>
                                            <th>SEXO</th>
                                            <th>EDAD</th>
                                            <th>ENFERMERA/MEDICO TRIAGE</th>
                                            <th>CLASIFICACIÓN</th>
                                            <th>T. TRANSCURRIDO</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9" class="text-center">
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

<input type="hidden" name="AjaxPacientesEnEspera" value="Si"> 
<?= Modules::run('Sections/Menu/loadFooter')?>
<script src="<?=  base_url()?>assets/js/Consultorios.js?<?= md5(microtime())?>" type="text/javascript"></script> 

