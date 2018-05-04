<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">AGREGAR DOCUMENTOS</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-usuario-documentos" enctype="multipart/form-data">
                            <?php if($_GET['tipo']=='85'){?>
                            <div class="form-group">
                                <select class="select2 width100" name="documento_tipo">
                                    <option value="">SELECCIONAR DOCUMENTO...</option>
                                    <option value="ORDEN DE PRESENTACIÓN">ORDEN DE PRESENTACIÓN</option>
                                    <option value="4 FOTOS TAMAÑO INFANTIL A COLOR">4 FOTOS TAMAÑO INFANTIL A COLOR</option>
                                    <option value="ACTA DE NACIMIENTO">ACTA DE NACIMIENTO</option>
                                    <option value="HOJA DE ALTA INFOSAT">HOJA DE ALTA INFOSAT</option>
                                    <option value="CURP">CURP</option>
                                    <option value="OFICIO DE DESIGNACIÓN DE PLAZA ESCUELA">OFICIO DE DESIGNACIÓN DE PLAZA ESCUELA</option>
                                    <option value="CALIFICACIONES">CALIFICACIONES</option>
                                    <option value="CURRICULUM VITAE">CURRICULUM VITAE</option>
                                    <option value="CARTILLA">CARTILLA</option>
                                    <option value="IFE">IFE</option>
                                </select>
                            </div>
                            <?php }else{?>
                            <div class="form-group">
                                <select class="select2 width100" name="documento_tipo" >
                                    <option value="">SELECCIONAR DOCUMENTO...</option>
                                    <option value="OFICIO DE PRESENTACIÓN">OFICIO DE PRESENTACIÓN</option>
                                    <option value="6 FOTOS TAMAÑO INFANTIL A COLOR">6 FOTOS TAMAÑO INFANTIL A COLOR</option>
                                    <option value="ACTA DE NACIMIENTO">ACTA DE NACIMIENTO</option>
                                    <option value="CONSTANCIA DE INFOSAT">CONSTANCIA DE INFOSAT</option>
                                    <option value="CURP">CURP</option>
                                    <option value="CONSTANCIA DE NO INHABILITACIÓN">CONSTANCIA DE NO INHABILITACIÓN</option>
                                    <option value="CONSTANCIA DE ENARM">CONSTANCIA DE ENARM</option>
                                    <option value="CONSTANCIA DE SERVICIO SOCIAL">CONSTANCIA DE SERVICIO SOCIAL</option>
                                    <option value="ACTA DE EXAMEN PROFESIONAL">ACTA DE EXAMEN PROFESIONAL</option>
                                    <option value="CALIFICACIONES">CALIFICACIONES</option>
                                    <option value="TITULO PROFESIONAL">TITULO PROFESIONAL</option>
                                    <option value="CEDULA PROFESIONAL">CEDULA PROFESIONAL</option>
                                    <option value="CONSTANCIA DE INTERNADO">CONSTANCIA DE INTERNADO</option>
                                    <option value="CURRICULUM VITAE">CURRICULUM VITAE</option>
                                    <option value="COPIA CREDENCIAL IFE">COPIA CREDENCIAL IFE</option>
                                </select>
                            </div>
                            <?php }?>
                            <div class="form-group">
                                <label>ANEXAR DOCUMENTOS</label>
                                <input type="file" name="documentos_anexos[]" multiple="" class="form-control upload-archivo">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="temp" value="<?=$_GET['tmp']?>">
                                <input type="hidden" name="documento_id" value="<?=$_GET['doc']?>">
                                <input type="hidden" name="documento_action" value="<?=$_GET['a']?>">
                                <button class="btn sigh-background-secundary pull-right">AGREGAR DOCUMENTOS</button>
                            </div>    
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>" type="text/javascript"></script> 
