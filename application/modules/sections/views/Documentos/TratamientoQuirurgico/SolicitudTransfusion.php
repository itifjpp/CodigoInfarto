<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered" style="margin-top: -20px">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center" style="">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>Solicitud al Servicio de Transfusión</b>
                    </span>
                </div>
                <style> .wysiwyg-text-align-center {text-align: center;}</style>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 20px 0px;">
                        <form class="solicitud-transfucion">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="md-check">
                                            <input type="checkbox" name="solicitudtransfucion_sangre" data-value="<?=$st[0]['solicitudtransfucion_sangre']?>" value="Sangre" class="has-value">
                                            <i class="indigo"></i><b>SANGRE</b>
                                        </label>&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="md-check">
                                            <input type="checkbox" name="solicitudtransfucion_plasma" data-value="<?=$st[0]['solicitudtransfucion_plasma']?>" value="Plasma" class="has-value">
                                            <i class="indigo"></i><b>PLASMA</b>
                                        </label>   
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="md-check">
                                            <input type="checkbox" name="solicitudtransfucion_suspensionconcentrada" data-value="<?=$st[0]['solicitudtransfucion_suspensionconcentrada']?>" value="Suspensión concentrada de G.R" class="has-value">
                                            <i class="indigo"></i><b> SUSPENSIÓN DE G.R</b>
                                        </label>&nbsp;&nbsp; 
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-right: 0px">
                                    <div class="form-group">
                                        <label class="md-check">
                                            <input type="checkbox" name="solicitudtransfucion_otros" data-value="<?=$st[0]['solicitudtransfucion_otros']?>" value="Otros" class="has-value">
                                            <i class="indigo"></i><b>OTROS</b>
                                        </label>&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input name="solicitudtransfucion_otros_val" class="form-control" placeholder="Otros" style="margin-top: -7px">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="md-check">
                                            <input type="checkbox" name="solicitudtransfucion_ordinaria" data-value="<?=$st[0]['solicitudtransfucion_ordinaria']?>" value="Ordinaria" class="has-value">
                                            <i class="indigo"></i><b>ORDINARIA</b>
                                        </label>&nbsp;&nbsp;   
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="md-check">
                                            <input type="checkbox" name="solicitudtransfucion_urgente" data-value="<?=$st[0]['solicitudtransfucion_urgente']?>" value="Urgente volumen solicitido" class="has-value">
                                            <i class="indigo"></i><b>URGENTE</b>
                                        </label>&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input name="solicitudtransfucion_urgente_vol" class="form-control" placeholder="Volumen solicitido" style="margin-top: -7px">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>OPERACIÓN DEL DIA</b></label>
                                                <input name="solicitudtransfucion_operacion_dia" value="<?=$st[0]['solicitudtransfucion_operacion_dia']?>" class="form-control dd-mm-yyyy"> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>A LAS</b></label>
                                                <input name="solicitudtransfucion_operacion_hora" value="<?=$st[0]['solicitudtransfucion_operacion_hora']?>" class="form-control clockpicker"> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><b>TENER DISPONIBLE</b> <i class="fa fa-question-circle-o icono-accion tip" data-placement="right" data-original-title="Para aplicación inmediata o en quirófano"></i></label>
                                                <input name="solicitudtransfucion_disponible" value="<?=$st[0]['solicitudtransfucion_disponible']?>" class="form-control"> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>RESERVA</b></label>
                                                <input name="solicitudtransfucion_reserva" value="<?=$st[0]['solicitudtransfucion_reserva']?>" class="form-control"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=""><b>GRUPO SANGUINEO A.B.O</b></label>
                                                <input name="solicitudtransfucion_gs_abo" value="<?=$st[0]['solicitudtransfucion_gs_abo']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class=""><b>GRUPO SANGUINEO RH° (D)</b></label>
                                                <input name="solicitudtransfucion_gs_rhd" value="<?=$st[0]['solicitudtransfucion_gs_rhd']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group"><br>
                                                <label class="md-check">
                                                    <input type="checkbox" name="solicitudtransfucion_gs_ignora" data-value="<?=$st[0]['solicitudtransfucion_gs_ignora']?>" value="Se ignora" class="has-value">
                                                    <i class="indigo"></i><b>SE IGNORA</b>
                                                </label>&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=""><b>DIAGNOSTICO</b></label>
                                                <input name="solicitudtransfucion_diagnostico" value="<?=$st[0]['solicitudtransfucion_diagnostico']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class=""><b>HB</b></label>
                                                <input name="solicitudtransfucion_hb" value="<?=$st[0]['solicitudtransfucion_hb']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class=""><b>HT</b></label>
                                                <input name="solicitudtransfucion_ht" value="<?=$st[0]['solicitudtransfucion_ht']?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=""><b>¿TRANSFUCIONES PREVIAS?</b></label>
                                                <input name="solicitudtransfucion_transfuciones_previas" value="<?=$st[0]['solicitudtransfucion_transfuciones_previas']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class=""><b>¿REACCIONES </b><i class="fa fa-question-circle-o tip icono-accion" data-original-title="Reacciones Postransfuncionales"></i></label>
                                                <input name="solicitudtransfucion_reacciones_postransfuncionales" value="<?=$st[0]['solicitudtransfucion_reacciones_postransfuncionales']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class=""><b>FECHA DE ÚLTIMA</b></label>
                                                <input name="solicitudtransfucion_fecha_ultima" value="<?=$st[0]['solicitudtransfucion_fecha_ultima']?>" class="form-control dd-mm-yyyy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=""><b>¿EMBARAZOS PREVIOS?</b></label>
                                                <input name="solicitudtransfucion_embarazo_previo" value="<?=$st[0]['solicitudtransfucion_embarazo_previo']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">¿Productos con enfermedad hemolítica?</b></label>
                                                <input name="solicitudtransfucion_pfh" value="<?=$st[0]['solicitudtransfucion_pfh']?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Nombre de la Unidad</b></label>
                                                <input name="" value="UMAE | Dr. Victorio de la Fuente Narváez" readonly="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Solicita</b></label>
                                                <input name="" value="<?=$empleado[0]['empleado_nombre']?> <?=$empleado[0]['empleado_apellidos']?>" readonly="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Recibio Solicitud</b></label>
                                                <input name="solicitudtransfucion_recibio_nombre" value="<?=$st[0]['solicitudtransfucion_recibio_nombre']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Servicio</b></label>
                                                <input name="" value="Observación & Urgencias" class="form-control" readonly="">
                                            </div>
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Fecha</b></label>
                                                <input name="solicitudtransfucion_solicita_f" value="<?=$st[0]['solicitudtransfucion_solicita_f']?>" class="form-control dd-mm-yyyy" >
                                            </div>
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Fecha</b></label>
                                                <input name="solicitudtransfucion_recibio_f" value="<?=$st[0]['solicitudtransfucion_recibio_f']?>" class="form-control dd-mm-yyyy">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">N° Cama</b></label>
                                                <input  value="<?=$observacion[0]['observacion_cama_nombre']?>" class="form-control" readonly="">
                                            </div>
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Hora</b></label>
                                                <input name="solicitudtransfucion_solicita_h" value="<?=$st[0]['solicitudtransfucion_solicita_h']?>" class="form-control clockpicker" >
                                            </div>
                                            <div class="form-group">
                                                <label class=""><b style="text-transform: uppercase">Hora</b></label>
                                                <input name="solicitudtransfucion_recibio_h" value="<?=$st[0]['solicitudtransfucion_recibio_h']?>" class="form-control clockpicker" >
                                            </div>
                                            <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                            <input type="hidden" name="tratamiento_id" value="<?=$this->uri->segment(4)?>">
                                            <input type="hidden" name="csrf_token">
                                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                        </div>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/TratamientoQuirurgico.js?'). md5(microtime())?>" type="text/javascript"></script>