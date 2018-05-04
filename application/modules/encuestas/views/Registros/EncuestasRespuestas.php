<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">AGREGAR/EDITAR ENCUESTA</h4>
            </div>
            <div class="grid-body">
                <form class="form-encuesta-respuesta">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group m-b-10">
                                <label>NOMBRE DE LA PREGUNTA</label>
                                <select name="respuesta_nombre" data-value="<?=$info['respuesta_nombre']?>" class="width100">
                                    <option value="Excelente">Excelente</option>
                                    <option value="Muy Bien">Muy Bien</option>
                                    <option value="Bien">Bien</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Malo">Malo</option>
                                    <option value="Muy Malo">Muy Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group m-b-10">
                                <label>VALOR</label>
                                <input type="number" name="respuesta_valor"  value="<?=$info['respuesta_valor']?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>ELEGIR IMAGEN</label>
                                <div class="radio radio-success">
                                    <input id="icono1" type="radio" name="respuesta_icon" value="EMO_1.png" data-value="<?=$info['respuesta_icon']?>" checked="">
                                    <label for="icono1">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_1.png" style="width: 20px">
                                    </label>
                                    <input id="icono2" type="radio" name="respuesta_icon" value="EMO_2.png">
                                    <label for="icono2">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_2.png" style="width: 20px">
                                    </label>
                                    <input id="icono3" type="radio" name="respuesta_icon" value="EMO_3.png">
                                    <label for="icono3">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_3.png" style="width: 20px">
                                    </label>
                                    <input id="icono4" type="radio" name="respuesta_icon" value="EMO_4.png">
                                    <label for="icono4">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_4.png" style="width: 20px">
                                    </label>
                                    <input id="icono5" type="radio" name="respuesta_icon" value="EMO_5.png">
                                    <label for="icono5">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_5.png" style="width: 20px">
                                    </label>
                                    <input id="icono6" type="radio" name="respuesta_icon" value="EMO_6.png">
                                    <label for="icono6">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_6.png" style="width: 20px">
                                    </label>
                                    <input id="icono7" type="radio" name="respuesta_icon" value="EMO_7.png">
                                    <label for="icono7">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_7.png" style="width: 20px">
                                    </label>
                                    <input id="icono8" type="radio" name="respuesta_icon" value="EMO_8.png">
                                    <label for="icono8">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_8.png" style="width: 20px">
                                    </label>
                                    <input id="icono9" type="radio" name="respuesta_icon" value="EMO_9.png" >
                                    <label for="icono9">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_9.png" style="width: 20px">
                                    </label>
                                    <input id="icono10" type="radio" name="respuesta_icon" value="EMO_10.png">
                                    <label for="icono10">
                                        <img src="<?= base_url()?>assets/img/emoji/EMO_10.png" style="width: 20px">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group no-margin">
                                <input type="hidden" name="encuesta_id" value="<?=$_GET['encuesta']?>">
                                <input type="hidden" name="respuesta_id" value="<?=$_GET['respuesta']?>">
                                <input type="hidden" name="respuesta_action" value="<?=$_GET['action']?>">
                                <button type="submit" class="btn sigh-background-secundary pull-right">GUARDAR</button>
                            </div>
                        </div>
                    </div>    
                </form>
                
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/Encuestas.js?').md5(microtime())?>" type="text/javascript"></script>