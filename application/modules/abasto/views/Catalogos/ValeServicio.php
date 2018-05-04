<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-10 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">VALE DE SERVICIO</b></span>
                    </div>
                    <div class="panel-body b-b b-light"> 
                        <div class="row" style="padding: 14px;margin-top: 5px;">
                            <div class="col-md-12 back-imss text-center">
                                <h5><b>SOLICITUD QX</b></h5>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>NOMBRE DEL SERVICIO</b></label>
                                    <input type="text" value="<?=$servicio['ci_servicio']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>PRIORIDAD</b></label>
                                    <input type="text" value="<?=$servicio['ci_prioridad']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>DIAGNOSTICO</b></label>
                                    <input type="text" value="<?=$servicio['ci_diagnostico']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>OPERACIÓN PLANEADA</b></label>
                                    <input type="text" value="<?=$servicio['ci_operacion_planeada']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>SERVICIO</b></label>
                                    <input type="text" value="<?=$servicio['ci_operacion_eu']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>TIPO DE ANESTECIA</b></label>
                                    <input type="text" value="<?=$servicio['ci_ap']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>####</b></label>
                                    <input type="text" value="<?=$servicio['ci_njs']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>MÉDICO QUE PROGRAMA</b></label>
                                    <input type="text" value="<?=$servicio['ci_nmc']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>MATRICULA</b></label>
                                    <input type="text" value="<?=$servicio['ci_mmc']?>" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 14px;margin-top: 5px;">
                            <div class="col-md-12 back-imss text-center">
                                <h5><b>DATOS DEL PACIENTE</b></h5>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><b>NOMBRE DEL PACIENTE</b></label>
                                    <input type="text" name="" value="<?= $info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>NSS</b></label>
                                    <input type="text" name="" value="<?= $info['pum_nss'] ?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>NSS AGREGADO</b></label>
                                    <input type="text" name="" value="<?= $info['pum_nss_agregado'] ?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>SEXO</b></label>
                                    <input type="text" name="" value="<?= $info['triage_paciente_sexo'] ?>" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>EDAD</b></label>
                                    <input type="text" name="" value="<?= $edadC?> Años" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>
                       <div class="row" style="padding: 14px;margin-top: 5px;">
                            <div class="col-md-12 back-imss text-center">
                                <h5><b>DATOS DEL MÉDICO</b></h5>
                            </div>
                       </div><br>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><b>NOMBRE DEL MÉDICO</b></label>
                                    <input type="text" name="nombre_medico" value="<?=$medico['empleado_apellidos']?> <?=$medico['empleado_nombre']?>" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 14px;margin-top: 5px;">
                            <div class="col-md-12 back-imss text-center">
                                <h5><b>DATOS DEL PROCEDIMIENTO</b></h5>
                            </div>
                        </div>
                        <div class="row"><br>
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss "><i class="fa fa-search"></i></span>
                                    <input type="text" required="" class="form-control" name="procedimiento_c" placeholder="Ingresar N° del procedimiento">
                                </div>
                            </div>
                        </div>
                        
                        <?php if($_GET['procedimiento_codigo'] != 0) {?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><b>NOMBRE DEL PROCEDIMIENTO</b></label>
                                    <input type="text" name="nombre_procedimiento" value="<?=$procedimiento['procedimiento_nombre']?>" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_GET['servicio'] != 0) {?>
                        
                        <form class="guardar-vale-servicio">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row" style="padding: 14px;margin-top: 5px;">
                                        <div class="col-md-12 back-imss text-center">
                                            <h5><b>PROCEDIMIENTO</b></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b>NO. SALA</b></label>
                                                <input class="form-control" type="number" name="vale_no_sala" required="" placeholder="" value="<?= $vale_servicio['vale_no_sala'] ?>">   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group" >
                                                <label style="font-size: 11px;"><b>FECHA DE INGRESO A SALA</b></label>
                                                <input class="form-control dd-mm-yyyy" name="vale_fecha_ingreso" required="" placeholder="__/__/____" value="<?= $vale_servicio['vale_fecha_ingreso'] ?>">   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group" >
                                                <label style="font-size: 11px;"><b>HORA DE INGRESO A SALA</b></label>
                                                <input class="form-control clockpicker" name="vale_hora_ingreso" required="" placeholder="00:00" value="<?= $vale_servicio['vale_hora_ingreso'] ?>">   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b>FECHA DE EGRESO A SALA</b></label>
                                                <input class="form-control dd-mm-yyyy" name="vale_fecha_egreso" required="" placeholder="__/__/____" value="<?= $vale_servicio['vale_fecha_egreso'] ?>">   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b>HORA DE EGRESO A SALA</b></label>
                                                <input class="form-control clockpicker" name="vale_hora_egreso" required="" placeholder="00:00" value="<?= $vale_servicio['vale_hora_egreso'] ?>">   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b>HORA DE INICIO DEL PROCEDIMIENTO</b></label>
                                                <input class="form-control clockpicker" name="procedimiento_hora_inicio" required="" placeholder="00:00" value="<?= $vale_servicio['procedimiento_hora_inicio'] ?>">   
                                            </div>   
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b> HORA DE INICIO DE ANESTECIA</b></label>   
                                                <input class="form-control clockpicker" name="anestecia_hora_inicio" required="" placeholder="00:00" value="<?= $vale_servicio['anestecia_hora_inicio'] ?>">   
                                            </div>   
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b>HORA DE TERMINO DEL PROCEDIMIENTO</b></label>   
                                                <input class="form-control clockpicker" name="procedimiento_hora_fin" required="" placeholder="00:00" value="<?= $vale_servicio['procedimiento_hora_fin'] ?>">   
                                            </div>   
                                        </div>  
                                        <div class="col-md-4">
                                            <div class="md-form-group">
                                                <label style="font-size: 11px;"><b>HORA DE TERMINO DE ANESTECIA</b></label><br>
                                                <input class="form-control clockpicker" name="anestecia_hora_fin" required="" placeholder="00:00" value="<?= $vale_servicio['anestecia_hora_fin'] ?>">   
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 14px;">
                                        <div class="col-md-12 back-imss text-center">
                                            <h5><b>CONSUMOS</b></h5>
                                        </div>
                                    </div>
                                    <div class="row"><br>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label><b>INSUMOS</b></label>
                                                    <div class="input-group m-b">
                                                        <span class="input-group-addon back-imss no-border" ></span>
                                                        <input type="text" class="form-control" name="rango_id" placeholder="BUSCAR INSUMOS">
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="tablainsumos">
                                                    <table class="table table-hover table-bordered footable table-insumos" style="font-size: 8px;">
                                                        <thead>
                                                            <tr>
                                                                <th>IMAGEN</th>
                                                                <th>FOLIO</th>
                                                                <th>ACCIÓN</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label><b>INSTRUMENTAL</b></label>
                                                    <div class="input-group m-b">
                                                        <span class="input-group-addon back-imss no-border" ></span>
                                                        <input type="text" class="form-control" name="cantidad_id_inst" placeholder="BUSCAR INSTRUMENTAL">
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="tablainstrumental">
                                                    <table class="table table-hover table-bordered footable table-instrumental" style="font-size: 8px;">
                                                        <thead>
                                                            <tr>
                                                                <th>FOLIO</th>
                                                                <th>ACCIÓN</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label><b>EQUIPAMIENTO</b></label>
                                                    <div class="input-group m-b">
                                                        <span class="input-group-addon back-imss no-border" ></span>
                                                        <input type="text" class="form-control" name="cantidad_id_equi" placeholder="BUSCAR EQUIPAMIENTO">
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="tablaequipamiento">
                                                    <table class="table table-hover table-bordered footable table-equipamiento" style="font-size: 8px;">
                                                        <thead>
                                                            <tr>
                                                                <th>FOLIO</th>
                                                                <th>ACCIÓN</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 14px;margin-top: 5px;">
                                <div class="col-md-12 back-imss text-center">
                                    <h5><b>EVIDENCIAS</b></h5>
                                </div>
                            </div>
                            <div class="row"><br>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if($_GET['accion']=='edit') {?>
                                            <center><div class="form-group">
                                                <label class=" pointer ver-documentos"> <i class="fa fa-archive"></i> Ver documentos/Anexos</label>
                                                </div></center>
                                            <?php } ?>
                                            <div class="form-group">
                                                <input type="file" name="vale_evidencias[]" id="vale_evidencias" class="form-control upload-archivo" multiple="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"><br><br>
                                <div class="col-md-6 col-md-offset-6">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" id="consumos_filtrar">
                                    <input name="vale_servicio_id" type="hidden" value="<?= $_GET['vale_servicio_id']?>">
                                    <?php if ($_GET['paciente'] != 0) { ?>
                                    <input name="triage_id" type="hidden" value="<?= $_GET['paciente']?>">
                                    <?php } if($_GET['procedimiento_codigo'] != 0) {?>
                                    <input name="procedimiento_codigo" type="hidden" value="<?= $_GET['procedimiento_codigo']?>">
                                    <?php } if($_GET['servicio'] != 0) {?>
                                    <input name="servicio" type="hidden" value="<?= $_GET['servicio']?>">
                                    <?php } ?>
                                    <input name="accion" type="hidden" value="<?= $_GET['accion']?>">
                                    <button type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" style="margin-bottom: -10px">GUARDAR</button>                     
                                </div><br><br><br>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                    <input id="servicio" type="hidden" value="<?= $_GET['servicio']?>">
                    <input id="procedimiento_codigo" type="hidden" value="<?= $_GET['procedimiento_codigo']?>">
                    <input id="vale_servicio_id" type="hidden" value="<?= $_GET['vale_servicio_id']?>">
                    <input id="accion" type="hidden" value="<?= $_GET['accion']?>">
                    <input id="triage_id" type="hidden" value="<?= $_GET['paciente']?>">
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>