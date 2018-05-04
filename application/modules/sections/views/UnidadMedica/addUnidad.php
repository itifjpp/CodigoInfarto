<?= modules::run('Sections/Menu/index'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />

<style>hr.style-eight {border: 0;border-top: 2px dashed #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -13px;font-size: 1.2em;padding: 0 0.20em;background: white;font-weight:bold;}</style>
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-11 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default " style="margin-top: -10px">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                            <div class="row" >
                                <div class=" col-md-offset-4col-md-4 text-right" style="margin-top: -8px">
                                    <center>AGREGAR NUEVA UNIDAD</center>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="form-unidad-medica" action="" method="POST">
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Nombre de Unidad</label>
                                                <input class="form-control" autofocus name="unidad_nombre" placeholder="Nombre de Unidad" value="<?=$Unidad['unidad_nombre']?>">   
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">No. de Unidad </label>
                                                <input class="form-control" type="text" name="unidad_numero" placeholder="No de Unidad" value="<?=$Unidad['numero_unidad_atencion']?>">   
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Nivel de Unidad</label>
                                                <input class="form-control" name="unidad_nivel" placeholder="Nivel de Unidad" value="<?=$Unidad['unidad_nivel']?>">   
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Altitud</label>
                                                <input class="form-control" name="altitud" placeholder="Altitud" value="<?=$Unidad['unidad_altitud']?>">   
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Latitud</label>
                                                <input class="form-control" name="latitud" placeholder="Latitud" value="<?=$Unidad['unidad_latitud']?>">   
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Estado</label>
                                                <input class="form-control" name="estado" placeholder="Estado" value="<?=$Unidad['unidad_estado']?>">   
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Tipo de Unidad</label>
                                                <select name="unidad_tipo" class="width100" data-value="<?=$Unidad['unidad_tipo']?>">
                                                    <option value="UMF">UMF</option>
                                                    <option value="HGZ">HGZ</option>
                                                    <option value="UMAE">UMAE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Especialidad</label>
                                                <select id="multi" data-value="<?=$Especialidades?>" name="especialidad[]" class="select2" style="width:100%" multiple>
                                                    <?php foreach ($Especialidad as $Esp){ ?>
                                                    <option value="<?= $Esp['id_especialidad']?>" ><?= $Esp['unidad_especialidad']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" name="csrf_token" >                                        
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input name="id_unidad_especialidad" type="hidden" value="<?=$Especialidades?>">
                                        <input name="id_unidad_editar" type="hidden" value="<?=$Unidad['id_unidad_atencion']?>">
                                        <button type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" style="margin-bottom: -10px">Guardar</button>                     
                                    </div>
                                        <div class="col-md-3">
                                        <button class="md-btn md-raised m-b btn-fw waves-effect pull-right" style="margin-bottom: -10px"><a href="javascript:self.close();">Cancelar</a></button>                     
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/sections/UnidadMedica.js?'). md5(microtime())?>" type="text/javascript"></script> 