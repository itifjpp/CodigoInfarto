<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Hospitales">Hospitales</a></li>
            <li><a href="#">Agregar Hospital</a></li>
        </ol> 
        <div class="grid simple col-md-10 col-centered" style="margin-top: 10px!important">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">AGREGAR NUEVO HOSPITAL</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <form class="form-add-hospital" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mayus-bold">NOMBRE DEL HOSPITAL</label>
                                <input type="text" name="hospital_nombre" value="<?=$info['hospital_nombre']?>" class="form-control" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mayus-bold">TIPO DE HOSPITAL</label>
                                <input type="text" name="hospital_tipo" value="<?=$info['hospital_tipo']?>" class="form-control" required="" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mayus-bold">CLASIFICACIÓN</label>
                                <input type="text" name="hospital_clasificacion" value="<?=$info['hospital_clasificacion']?>" class="form-control" required="" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mayus-bold">SIGLAS</label>
                                <input type="text" name="hospital_siglas" value="<?=$info['hospital_siglas']?>" class="form-control" required="" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mayus-bold">SIGLAS DESCRIPCIÓN</label>
                                <input type="text" name="hospital_siglas_des" value="<?=$info['hospital_siglas_des']?>" class="form-control" required="" >
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="mayus-bold">DIRECCIÓN</label>
                                <textarea name="hospital_direccion" rows="1" placeholder="Dirección..." class="form-control"><?=$info['hospital_direccion']?></textarea>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mayus-bold">ACERCA DE</label>
                                <textarea name="hospital_acerca_de" rows="3" placeholder="Acerca de..." class="form-control"><?=$info['hospital_acerca_de']?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="mayus-bold">MISIÓN</label>
                                <textarea name="hospital_mision" rows="4" placeholder="Misión..." class="form-control"><?=$info['hospital_mision']?></textarea>
                            </div> 
                            <div class="form-group">
                                <label class="mayus-bold">VISIÓN</label>
                                <textarea name="hospital_vision" rows="4" placeholder="Visión..." class="form-control"><?=$info['hospital_vision']?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>SELECCIONAR IMAGEN PARA EL LOGO DEL SISTEMA</label>
                                        <input type="file" name="hospital_logo" class="form-control upload-archivo" <?=$_GET['a']=='add'? 'required':''?>>
                                    </div>        
                                </div>
                                <div class="col-md-4 text-right">
                                    <img src="<?= base_url()?>assets/img/<?=$info['hospital_logo']?>" style="width: 70px">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>SELECCIONAR IMAGEN PARA EL LOGO DE DOCUMENTOS</label>
                                        <input type="file" name="hospital_img_doc" class="form-control upload-archivo" <?=$_GET['a']=='add'? 'required':''?>>
                                    </div>        
                                </div>
                                <div class="col-md-4 text-right">
                                    <img src="<?= base_url()?>assets/img/<?=$info['hospital_img_doc']?>" style="width: 70px;">
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>COLOR BACKGROUND PRIMARIO</label>
                                <input type="color" name="hospital_back_primary" value="<?=$info['hospital_back_primary']?>" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>COLOR BACKGROUND SECUNDARIO</label>
                                <input type="color" name="hospital_back_secundary" value="<?=$info['hospital_back_secundary']?>" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>COLOR PRINCIAL</label>
                                <input type="color"  name="hospital_color" value="<?=$info['hospital_color']?>" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="hospital_logo" value="<?=$info['hospital_logo']?>" id="filename">
                                <input type="hidden" name="csrf_token">
                                <input type="hidden" name="hospital_id" value="<?=$_GET['hospital']?>">
                                <input type="hidden" name="hospital_accion" value="<?=$_GET['a']?>">
                                <button class="btn sigh-background-secundary pull-right">GUARDAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Hospitales.js?'). md5(microtime())?>" type="text/javascript"></script>