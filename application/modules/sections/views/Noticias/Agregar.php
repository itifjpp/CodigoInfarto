<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Noticias">Noticias</a></li>
            <li><a href="#">Agregar Nueva Noticia</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR NUEVA NOTICIA</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form class="form-add-noticia">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="mayus-bold">TÍTULO</label>
                                                <input type="text" name="noticia_titulo" value="<?=$info['noticia_titulo']?>" class="form-control" required="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mayus-bold">FECHA</label>
                                                <input type="text" name="noticia_fecha" value="<?=$info['noticia_fecha']?>" class="form-control dp-yyyy-mm-dd" required="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mayus-bold">HORA</label>
                                                <input type="text" name="noticia_hora" value="<?=$info['noticia_hora']?>" class="form-control clockpicker-bottom" required="" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="noticia_descripcion_breve" rows="3" placeholder="DESCRIPCIÓN BREVE..." class="form-control"><?=$info['noticia_descripcion_breve']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div id="retrievingfilename" class="html5imageupload" data-width="600" data-height="300" data-url="<?=  base_url()?>config/uploadImageTmp?tipo=Noticias" style="width: 100%;">
                                        <input type="file" name="thumb" style="height: 200px!important">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="noticia_descripcion" rows="20" class="form-control" placeholder="DESCRIPCIÓN GENERAL"><?=$info['noticia_descripcion']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 hide">
                                    <div class="form-group">
                                        <label>GRUPO DE USUARIOS</label>
                                        <div class="radio radio-success">
                                            <input id="noticia_tipo_todos" type="radio" name="optionyes" value="Todos" data-value="<?=$info['noticia_usuarios']?>">
                                            <label for="noticia_tipo_todos">Todos</label>
                                            <input id="noticia_tipo_roles" type="radio" name="optionyes" value="Por Roles" checked="checked">
                                            <label for="noticia_tipo_roles">Por Roles</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="noticia_portada" id="filename" value="<?=$info['noticia_portada']?>" class="form-control" />
                                        <input type="hidden" name="noticia_id" value="<?=$_GET['noticia']?>">
                                        <input type="hidden" name="noticia_accion" value="<?=$_GET['a']?>">
                                        <button class="btn sigh-background-secundary pull-right">GUARDAR NOTICIA</button>
                                    </div>
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
<script src="<?= base_url('assets/js/sections/Noticias.js?'). md5(microtime())?>" type="text/javascript"></script>