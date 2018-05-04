<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-9 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INDICADOR DE PRODUCTIVIDAD</h4>
                    </div>
                    <div class="grid-body">
                        <fieldset class="fieldset">
                            <legend class="legend">INDICADOR DE PRODUCTIVIDAD</legend>
                            <div class="row">
                                <form class="form-indicador-triage ">
                                    <div class="col-md-4" >
                                        <div class="input-group">
                                            <span class="input-group-addon sigh-background-secundary no-border">	
                                                <i class="fa fa-calendar-check-o"></i>
                                            </span>
                                            <input type="text" name="inputFecha" class="form-control dp-yyyy-mm-dd" required="" placeholder="SELECCIONAR FECHA">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="width100" name="inputTurno">
                                                <option value="Mañana">Mañana</option>
                                                <option value="Tarde">Tarde</option>
                                                <option value="Noche">Noche</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn sigh-background-secundary btn-block" >Buscar</button>
                                    </div>    
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info m-t-20" style="position: relative">
                                        <h4 class="no-margin">NÚMERO DE PACIENTES: <span class="triage-indicador-rs">0</span> PACIENTES </h4>
                                        <a href="#" class="triage-indicador-export hide" style="position: absolute;right: 10px;top: 5px">
                                            <i class="material-icons " style="font-size: 30px">picture_as_pdf</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/Medicotriage.js?md5').md5(microtime())?>" type="text/javascript"></script>