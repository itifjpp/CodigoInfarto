<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px;color:#2196F3">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Educacion/Cursos">Cursos</a></li>
            <li><a href="#">Nuevo Curso</a></li>
        </ol>
        <div class="row m-t-20"> 
            <div class="col-md-7 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR NUEVO CURSOS</h4>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-12">
                                <form class="agregar-curso">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>NOMBRE DEL CURSO</label>
                                                <input type="text" name="curso_nombre" required="" class="form-control" value="<?=$info['curso_nombre']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>DESCRIPCIÓN DEL CURSO</label>
                                                <input type="text" name="curso_descripcion" class="form-control" value="<?=$info['curso_descripcion']?>">
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>FECHA Y HORA DE INICIO</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="curso_inicio_fecha" value="<?=$info['curso_inicio_fecha']?>" required="" class="form-control dp-yyyy-mm-dd" placeholder="FECHA">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="curso_inicio_hora" value="<?=$info['curso_inicio_hora']?>" required=""  class="form-control clockpicker-bottom" placeholder="HORA">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>FECHA Y HORA DE TÉRMINO</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="curso_termino_fecha" value="<?=$info['curso_termino_fecha']?>" required="" class="form-control dp-yyyy-mm-dd" placeholder="FECHA">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="curso_termino_hora" value="<?=$info['curso_termino_hora']?>" required="" class="form-control clockpicker-bottom" placeholder="HORA">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="curso_id" value="<?=$this->uri->segment(3)?>">
                                                <input type="hidden" name="curso_action" value="<?=$_GET['a']?>">
                                                <button class="btn sigh-background-secundary btn-block">Guardar</button>
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
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>