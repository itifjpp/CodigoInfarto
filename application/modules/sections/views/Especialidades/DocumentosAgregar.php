<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-6 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">   
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">AGREGAR NUEVO DOCUMENTO</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row ">
                        <form class="form-doc-consultorios">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mayus-bold">Tipo de Documento</label>
                                    <select name="doc_tipo" class="form-control">
                                        <option value="NOTAS FORMATO 4 30 128">NOTAS FORMATO 4 30 128</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">Nombre del documento</label>
                                    <input type="text" name="doc_nombre" class="form-control" value="<?=$info['doc_nombre']?>" required="">
                                </div>
                                
                                <div class="form-group">
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="doc_id" value="<?=$_GET['doc']?>">
                                    <button class="btn back-imss-all btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>