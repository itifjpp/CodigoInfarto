<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered" >
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss" style="padding: 10px">
                    <span style="font-size: 15px;font-weight: 500">ASIGNAR CAMA AL PACIENTE</span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="form-asignacion-cama">
                        <div class="row-sm">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_ingreso_servicio" value="<?=$sqlAH['ac_ingreso_servicio']?>" placeholder="SERVICIO ORDENO INGRESO" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_ingreso_matricula" value="<?=$sqlAH['ac_ingreso_matricula']?>" placeholder="MATRICULA ORDENO INGRESO" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_ingreso_medico" value="<?=$sqlAH['ac_ingreso_medico']?>" placeholder="MÉDICO ORDENO INGRESO" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_salida_servicio" value="<?=$sqlAH['ac_salida_servicio']?>" placeholder="SERVICIO ORDENO SALIDA" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_salida_matricula" value="<?=$info['ac_salida_matricula']?>" placeholder="MATRICULA ORDENO SALIDA" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_salida_medico" value="<?=$info['ac_salida_medico']?>" placeholder="MÉDICO ORDENO SALIDA" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select name="ac_infectado" class="form-control">
                                        <option>Seleccionar si el paciente esta infectado</option>
                                        <option value="Si">Si</option>
                                        <option value="No" selected="">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row-sm">
                            <div class="col-sm-12">
                                <div style="padding: 8px" class="back-imss" >
                                    <b>DIRECCIÓN DEL RESPONSABLE</b>
                                </div>
                            </div>
                        </div>
                        <div class="row-sm">
                            <div class="col-sm-4"><br>
                                <div class="form-group">
                                    <input type="text" name="directorio_cp" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                            <div class="col-sm-4"><br>
                                <div class="form-group">
                                    <input type="text" name="directorio_cn" class="form-control" placeholder="Calle y Numero">
                                </div>
                            </div>
                            <div class="col-sm-4"><br>
                                <div class="form-group" id="the-basics">
                                    <input type="text" name="directorio_colonia" class="form-control" autocomplete="off" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="directorio_municipio" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="directorio_estado" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="hidden" name="cama_id" value="<?=$_GET['cama']?>">
                                    <input type="hidden" name="triage_id" value="<?=$_GET['triage_id']?>">
                                    <input type="hidden" name="empleado_matricula" value="<?=$_GET['empleado_matricula']?>">
                                    <input type="hidden" name="ac_cama_estatus" value="<?=$_GET['cama_estatus']?>">
                                    <input type="hidden" name="csrf_token">
                                    <button class="btn back-imss btn-block" >Guardar</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?').md5(microtime())?>" type="text/javascript"></script>