<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
              
            <div class="col-md-12" style="margin-top: -10px">
                <ol class="breadcrumb" style="margin-top: -20px;color:#2196F3">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="<?= base_url()?>Urgencias/Graficas">Indicadores</a></li>
                    <li><a href="#">Consultorios</a></li>
                </ol> 
                <div class="card" style="margin-top: -20px">
                    <div class="lt p text-center">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5>
                                    <strong>INDICADORES | CONSULTORIOS</strong>
                                </h5>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <select class="select2 width100" name="productividad_turno">
                                    <option>SELECCIONAR TURNO</option>
                                    <option value="Mañana" selected="">TURNO MAÑANA</option>
                                    <option value="Tarde">TURNO TARDE</option>
                                    <option value="Noche">TURNO NOCHE</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="productividad_tipo" value="<?=$this->uri->segment(4)?>">
                                <input type="text" name="productividad_fecha" placeholder="Seleccionar Fecha" value="<?=  date('d/m/Y')?>" class="form-control dd-mm-yyyy">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-block btn-indicador">BUSCAR</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($Consultorios as $value) { ?>
            <div class="col-md-4">
                <a href="#" class="indicador_consultorios_res  indicador-consultorios-<?=$value['consultorio_id']?>" data-id="<?=$value['consultorio_id']?>" data-consultorio="<?=$value['consultorio_nombre']?>">
                    <div class="card">
                        <div class="lt p text-center">
                            <h4>0 Pacientes</h4>
                            <hr style="margin-top: -6px;margin-bottom: -6px">
                            <h3 style="font-size: 17px"><?=$value['consultorio_nombre']?></h3>
                        </div>
                    </div>
                </a>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>

