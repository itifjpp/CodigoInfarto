<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row ">
            <div class="col-md-8 col-centered">
                <ol class="breadcrumb" style="margin-top: -20px;margin-left: -11px">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="<?=  base_url()?>Sections/Normativas">Normativas</a></li>
                    <li><a href="#">Agregar Nueva Normativa</a></li>
                </ol>
                <div class="grid simple m-t-5">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR NUEVA NORMATIVA</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form class="form-add-normativa" enctype="multipart/form-data">
                                <div class="col-md-12 col-xs-12">
                                    <div id="retrievingfilename" class="html5imageupload" data-width="600" data-height="300" data-url="<?=  base_url()?>config/uploadImageTmp?tipo=Normativas" style="width: 100%">
                                        <input type="file" name="thumb" style="height: 200px!important">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mayus-bold">TÍTULO</label>
                                        <input type="text" name="normativa_titulo" value="<?=$info['normativa_titulo']?>" class="form-control" required="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mayus-bold">INSTITUCIÓN</label>
                                        <input type="text" name="normativa_institucion" value="<?=$info['normativa_institucion']?>" class="form-control" required="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mayus-bold">ESPECIALIDAD</label>
                                        <select class="form-control" name="normativa_especialidad" data-value="<?=$info['normativa_especialidad']?>">
                                            <option value="">SELECCIONAR ROL</option>
                                            <?php foreach ($Roles as $value){?>
                                            <option value="<?=$value['rol_id']?>"><?=$value['rol_nombre']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mayus-bold">GRUPO ETARIO</label>
                                        <input type="text" name="normativa_grupo_etario" value="<?=$info['normativa_grupo_etario']?>" class="form-control" required="" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="col-md-12"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="mayus-bold">NIVEL DE ATENCIÓN</label>
                                        <input type="text" name="normativa_nivel_atencion" value="<?=$info['normativa_nivel_atencion']?>" class="form-control" required="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="mayus-bold">FECHA DE PUBLICACIÓN</label>
                                        <input type="text" name="normativa_fecha_publicacion" value="<?=$info['normativa_fecha_publicacion']?>" class="form-control dp-yyyy-mm-dd" required="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="mayus-bold">CATEGORÍA</label>
                                        <input type="text" name="normativa_categoria" value="<?=$info['normativa_categoria']?>" class="form-control" required="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" >
                                        <?php 
                                        $sql=$this->config_mdl->sqlGetDataCondition('sigh_normativas_areas',array(
                                            'normativa_id'=>$_GET['norma']
                                        ));
                                        $Areas_="";
                                        foreach ($sql as $value) {
                                            $Areas_.=$value['area_id'].',';
                                        }
                                        ?>
                                        <label class="mayus-bold" style="position: relative">SELECCIONAR ÁREA
                                        <div class="checkbox check-success" style="position: absolute;right:0px;top: 0px">
                                            <input id="checkbox2" type="checkbox" value="1" class="">
                                            <label for="checkbox2">TODAS LAS ÁREAS</label>
                                        </div>
                                        </label>
                                        <select name="areas_id[]" class="select2 width100 areas_id" id="areas_id" multiple="" data-value="<?= trim($Areas_, ',')?>">
                                            <?php foreach ($Areas as $value) {?>
                                            <option value="<?=$value['areas_acceso_id']?>"><?=$value['areas_acceso_nombre']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <?php if($info['normativa_file']!=''){?>
                                    <div class="form-group">
                                        <label class="pointer" onclick="AbrirDocumento(base_url+'assets/Normativas/<?=$info['normativa_file']?>')"><i class="fa fa-file"></i> 1 ARCHIVO ANEXO</label>
                                    </div>
                                    <?php }?>
                                    <div class="form-group">
                                        <label class="mayus-bold">SELECCIONAR ARCHIVO (*PDF)</label>
                                        <input type="file" name="normativa_file" class="form-control upload-archivo" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="normativa_portada" id="filename" value="<?=$info['normativa_portada']?>" class="form-control">
                                        <input type="hidden" name="normativa_id" value="<?=$_GET['norma']?>">
                                        <input type="hidden" name="normativa_action" value="<?=$_GET['a']?>">
                                        <button class="btn sigh-background-secundary btn-block">GUARDAR</button>
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
<script src="<?= base_url('assets/js/sections/Normativas.js?'). md5(microtime())?>" type="text/javascript"></script>