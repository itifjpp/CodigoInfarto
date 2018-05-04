<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="<?= base_url()?>Encuestas">ENCUESTAS</a></li>
            <li><a href="#">NUEVA ENCUESTA</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR/EDITAR ENCUESTA</h4>
                    </div>
                    <div class="grid-body">
                        <form class="form-encuesta">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-b-10">
                                        <label>NOMBRE DE LA ENCUESTA</label>
                                        <input type="text" name="encuesta_nombre" value="<?=$info['encuesta_nombre']?>" class="form-control">
                                    </div>
                                    <div class="form-group m-b-10">
                                        <label>ÁREA</label>
                                        <input type="text" name="encuesta_area" value="<?=$info['encuesta_area']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-10">
                                        <label>ENCUESTA PARA</label>
                                        <select class="width100" name="encuesta_para" data-value="<?=$info['encuesta_para']?>">
                                            <option value="PACIENTES">PACIENTES</option>
                                            <option value="PERSONAL">PERSONAL</option>
                                            <option value="NORMATIVAS">NORMATIVAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-10">
                                        <label>TIPO DE RESPUESTAS</label>
                                        <select class="width100" name="encuesta_tipo" data-value="<?=$info['encuesta_tipo']?>">
                                            <option value="SATISFACCIÓN">SATISFACCIÓN</option>
                                            <option value="EVALUACIÓN">EVALUACIÓN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ID EXTERNO</label>
                                        <input type="text" name="encuesta_external" value="<?=$info['encuesta_external']?>" class="form-control" placeholder="ID EXTERNO">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b-10">
                                        <label>IP DEL EQUIPO</label>
                                        <select name="equipo_id" data-value="<?=$info['equipo_id']?>" class="width100">
                                            <option value="0">NO APLICA</option>
                                            <?php foreach ($Equipos as $value) {?>
                                            <option value="<?=$value['equipo_id']?>"><?=$value['equipo_ip']?> - <?=$value['equipo_descripcion']?></option>
                                            <?php }?>
                                            <
                                        </select>
                                    </div>
                                    <div class="form-group no-margin">
                                        <input type="hidden" name="encuesta_id" value="<?=$_GET['encuesta']?>">
                                        <input type="hidden" name="encuesta_action" value="<?=$_GET['action']?>">
                                        <button type="submit" class="btn sigh-background-secundary pull-right">GUARDAR</button>
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

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Encuestas.js?').md5(microtime())?>" type="text/javascript"></script>