<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top:-10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Educacion/Calendario">Calendario</a></li>
            <li><a href="#">Agregar/Editar Calendario</a></li>
        </ol>
        <div class="row m-t-5">
            <div class="col-md-9 col-centered">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">AGREGAR NUEVO CALENDARIO</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form class="createCalendar">
                                <div class="col-xs-12">
                                    <div class="form-group" style="margin-top: -10px">
                                        <label>TITULO</label>
                                        <input type="text" name="calendar_title" value="<?=$info['calendar_title']?>" required class="form-control" placeholder="AÑADIR UN TITULO">
                                    </div>
                                    <div class="form-group">
                                        <label>DESCRIPCIÓN</label>
                                        <textarea name="calendar_description" class="form-control" placeholder="AÑADIR UNA DESCRIPCIÓN" ><?=$info['calendar_description']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>ID CALENDARIO DE GOOGLE</label>
                                        <input type="text" name="calendar_id_google" value="<?=$info['calendar_id_google']?>"  class="form-control" placeholder="ID DE CALENDAR DE GOOGLE" >
                                    </div>


                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>ID DE CLIENTE DE GOOGLE</label>
                                        <input type="text" name="calendar_cliente_id" value="<?=$info['calendar_cliente_id']?>"  class="form-control" placeholder="ID DE CLIENTE DE GOOGLE" >
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>API KEY DE GOOGLE</label>
                                        <input type="text" name="calendar_api_key" value="<?=$info['calendar_api_key']?>"  class="form-control" placeholder="API KEY DE GOOGLE" >
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>SELECCIONAR HOSPITAL</label>
                                        <select name="hospital_id" class="width100" data-value="">
                                            <?php foreach ($Hospitales as $value){?>
                                            <option value="<?=$value['hospital_id']?>"><?=$value['hospital_clasificacion']?> <?=$value['hospital_tipo']?> <?=$value['hospital_nombre']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-offset-8 col-xs-4">
                                    <input type="hidden" name="calendar_action" value="<?=$_GET['action']?>">
                                    <input type="hidden" name="calendar_id" value="<?=$_GET['cal']?>">
                                    <button class="btn btn-block sigh-background-secundary  btn-create-event" type="submit">GUARDAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>