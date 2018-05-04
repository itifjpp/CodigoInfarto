<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb" style="margin-top: -20px">
                <li><a style="text-transform: uppercase" href="#">Inicio</a></li>
                <li><a style="text-transform: uppercase" href="#">Inventario</a></li>
                <li><a style="text-transform: uppercase" href="#">Abastecer</a></li>
            </ol>  
            <div class="col-md-10 col-centered">
                <div class="box-inner padding">
                    <div class="panel panel-default " style="margin-top: -20px">
                        <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                        <div class="panel-heading p teal-900 back-imss">
                            <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                                <b>PROCEDIMIENTO INVENTARIO</b>&nbsp;
                            </span>
                        </div>
                        <div class="panel-body b-b b-light">
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><b>CANTIDAD</b> </label>
                                            <input class="form-control" name="cantidad" required="" type="number" placeholder="Cantidad">   
                                        </div>
                                    </div>
                                    <div class="col-sm-4 ">
                                        <label><b>RANGOS</b> </label>
                                        <div class="form-group">
                                            <select name="rango">
                                                <?php foreach ($RANGOS AS $value) {?>
                                                <option value="<?= $value['rango_id'] ?>;<?= $value['sistema_id'] ?>"> <?= $value['rango_titulo'] ?></option>
                                                <?php } ?>
                                            </select>   
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm"><br><br><br>
                                    <div class="col-md-2">
                                        <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="button" onclick="location.href=base_url+'Abasto/Catalogos/Rangos?catalogo=<?=$_GET['catalogo']?>&sistema=<?=$_GET['sistema']?>&elemento=<?=$_GET['elemento']?>'" style="margin-bottom: -10px">Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="hidden" name="csrf_token">
                                        <button class="addRango md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>
