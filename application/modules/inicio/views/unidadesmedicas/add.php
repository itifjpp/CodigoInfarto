<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            
            <div class="card"  >
                <div class="card-heading back-imss">
                    <h2>UNIDAD MÉDICA</h2>
                </div>
                <div class="card-body">
                    <form class="unidadmedica-registro">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo de Unidad Médica</label>
                                    <select name="unidadmedica_tipo" data-value="<?=$info[0]['unidadmedica_tipo']?>" class="md-input">
                                        <option value="UMF">UMF</option>
                                        <option value="HGZ">HGZ</option>
                                        <option value="HGR">HGR</option>
                                        <option value="UMAE">UMAE</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Titulo Titular</label>
                                    <input type="text" name="unidadmedica_num" value="<?=$info[0]['unidadmedica_num']?>" required="" class="md-input">
                                </div>
                                <div class="form-group">
                                    <label>Domicilio de Unidad</label>
                                    <input type="text" required="" name="unidadmedica_domicilio" value="<?=$info[0]['unidadmedica_domicilio']?>"  class="md-input">
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre de Unidad.</label>
                                    <input type="text" required="" name="unidadmedica_nombre" value="<?=$info[0]['unidadmedica_nombre']?>" class="md-input">
                                </div>
                                <div class="form-group">
                                    <label>Nombre del Titular Unidad</label>
                                    <input type="text" required="" name="unidadmedica_titular" value="<?=$info[0]['unidadmedica_titular']?>" class="md-input">
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="select2 md-input" name="unidadmedica_estado" data-value="<?=$info[0]['unidadmedica_estado']?>" style="width: 100%">
                                        <option value="">Seleccionar</option>
                                        <option value="Aguascalientes">Aguascalientes</option>
                                        <option value="Baja California">Baja California</option>
                                        <option value="Baja California Sur">Baja California Sur</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Chiapas">Chiapas</option>
                                        <option value="Chihuahua">Chihuahua</option>
                                        <option value="Coahuila">Coahuila</option>
                                        <option value="Colima">Colima</option>
                                        <option value="Distrito Federal">Distrito Federal</option>
                                        <option value="Durango">Durango</option>
                                        <option value="Estado de México" selected="">Estado de México</option>
                                        <option value="Guanajuato">Guanajuato</option>
                                        <option value="Guerrero">Guerrero</option>
                                        <option value="Hidalgo">Hidalgo</option>
                                        <option value="Jalisco">Jalisco</option>
                                        <option value="Michoacán">Michoacán</option>
                                        <option value="Morelos">Morelos</option>
                                        <option value="Nayarit">Nayarit</option>
                                        <option value="Nuevo León">Nuevo León</option>
                                        <option value="Oaxaca">Oaxaca</option>
                                        <option value="Puebla">Puebla</option>
                                        <option value="Querétaro">Querétaro</option>
                                        <option value="Quintana Roo">Quintana Roo</option>
                                        <option value="San Luis Potosí">San Luis Potosí</option>
                                        <option value="Sinaloa">Sinaloa</option>
                                        <option value="Sonora">Sonora</option>
                                        <option value="Tabasco">Tabasco</option>
                                        <option value="Tamaulipas">Tamaulipas</option>
                                        <option value="Tlaxcala">Tlaxcala</option>
                                        <option value="Veracruz">Veracruz</option>
                                        <option value="Yucatán">Yucatán</option>
                                        <option value="Zacatecas">Zacatecas</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No. De Unidad.</label>
                                    <input type="text" name="unidadmedica_num" value="<?=$info[0]['unidadmedica_num']?>" required="" class="md-input">
                                </div>
                                <div class="form-group">
                                    <label>Nivel</label>
                                    <select name="unidadmedica_nivel" data-value="<?=$info[0]['unidadmedica_nivel']?>" class="md-input">
                                        <option value="2° Nivel">2° Nivel</option>
                                        <option value="3° Nivel">3° Nivel</option>
                                    </select>
                                </div>
                                <input type="hidden" name="unidadmedica_id" value="<?=$this->uri->segment(4)?>">
                                <input type="hidden" name="csrf_token">
                                <button  type="submit" class="btn-save md-btn md-raised m-b btn-fw back-imss waves-effect pull-right btn-block" style="margin-top: 25px">Guardar</button>
                            </div>
                            
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/os/inicio/unidadmedica.js')?>" type="text/javascript"></script>