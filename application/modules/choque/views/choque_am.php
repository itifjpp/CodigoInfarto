<?= modules::run('Sections/Menu/index'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<style>hr.style-eight {border: 0;border-top: 2px dashed #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -13px;font-size: 1.2em;padding: 0 0.20em;background: white;font-weight:bold;}</style>
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-11 col-centered" style="margin-top: 10px">
            <div class="box-inner">
                <div class="panel panel-default">

                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                            <div class="row">
                                <div class="col-md-8">
                                    <b>PACIENTE:</b> <?=$info[0]['triage_nombre']=='' ? $info[0]['triage_nombre_pseudonimo']: $info[0]['triage_nombre_ap'].' '.$info[0]['triage_nombre_am'].' '.$info[0]['triage_nombre']?>
                                </div>
                                <div class="col-md-4 text-right">
                                    <b>DESTINO: CHOQUE</b>
                                </div>
                            </div>   
                        </span>
                    </div>
                    <form class="solicitud-am-choque">
                        <div class="panel-body b-b b-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mayus-bold">APELLIDO PATERNO</label>
                                            <input type="text" name="triage_nombre_ap" value="<?=$info[0]['triage_nombre_ap']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mayus-bold">APELLIDO MATERNO</label>
                                            <input type="text" name="triage_nombre_am" value="<?=$info[0]['triage_nombre_am']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label class="mayus-bold">NOMBRE/PSEUDONIMO</label>
                                            <input class="form-control" name="triage_nombre" value="<?=$info[0]['triage_nombre']=='' ? $info[0]['triage_nombre_pseudonimo']: $info[0]['triage_nombre']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mayus-bold">FECHA DE NACIMIENTO</label>
                                            <input type="text" name="triage_fecha_nac" value="<?=$info[0]['triage_fecha_nac']?>" class="form-control dd-mm-yyyy" > 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label class="mayus-bold">SEXO</label>
                                            <select class="form-control"  name="triage_paciente_sexo" data-value="<?=$info[0]['triage_paciente_sexo']?>">
                                                <option value="">Seleccionar</option>
                                                <option value="HOMBRE">HOMBRE</option>
                                                <option value="MUJER">MUJER</option>
                                            </select>
                                        </div>   
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mayus-bold">ESTADO CIVIL</label>
                                            <select class="form-control" name="triage_paciente_estadocivil" data-value="<?=$info[0]['triage_paciente_estadocivil']?>">
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="COMPROMETIDO(A)">COMPROMETIDO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option value="DIVORSIADO(A)">DIVORSIADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if($PINFO['pum_nss_armado']!=''){ ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>N.S.S ARMADO</label>
                                            <?php if($PINFO['pum_nss_armado']==''){?>
                                            <input type="text" name="" value="NO APLICA" class="form-control" readonly="">
                                            <?php }else{?>
                                            <input type="text" name="pum_nss_armado" value="<?=$PINFO['pum_nss_armado']?>" class="form-control" readonly="">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="mayus-bold"><b>CUENTA CON N.S.S</b></label><br>
                                                <label class="md-check">
                                                    <input type="radio" name="triage_paciente_afiliacion_bol" value="Si" data-value="<?=$PINFO['pum_nss']?>">
                                                    <i class="blue"></i>SI
                                                </label>&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="triage_paciente_afiliacion_bol" value="No" checked="" data-value="<?=$PINFO['pum_nss']?>">
                                                    <i class="blue"></i>NO
                                                </label>

                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-4 triage_paciente_afiliacion_bol hide">
                                        <div class="form-group">
                                            <label class="mayus-bold">N.S.S</label>
                                            <input type="text" name="pum_nss" value="<?=$PINFO['pum_nss']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 triage_paciente_afiliacion_bol hide">
                                        <div class="form-group">
                                            <label class="mayus-bold">N.S.S AGREGADO</label>
                                            <input type="text" name="pum_nss_agregado" value="<?=$PINFO['pum_nss_agregado']?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label><b>U.M.F DE ADSCRIPCIÓN</b></label>
                                            <input class="form-control" name="pum_umf" placeholder="" value="<?=$PINFO['pum_umf']?>"> 
                                        </div>                
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label><b>C.U.R.P</b></label>
                                            <input class="form-control" name="triage_paciente_curp" placeholder="" value="<?=$info[0]['triage_paciente_curp']?>"> 
                                        </div>                   
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>IDENTIFICACIÓN OFICIAL</b></label>
                                            <input class="form-control" name="pic_identificacion" placeholder="" value="<?=$PINFO['pic_identificacion']?>"> 
                                        </div>                   
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label><b>TELÉFONO</b></label>
                                            <input class="form-control" name="directorio_telefono" placeholder="" value="<?=$DirPaciente['directorio_telefono']?>">  
                                        </div>                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 14px;margin-top: -15px;margin-bottom: -35px;">
                                <div class="col-md-12 back-imss text-center">
                                    <h5><b>DATOS DEL DOMICILIO</b></h5>
                                </div>
                            </div>
                            <div class="panel-body b-b b-light">
                                <div class="card-body" style="padding-bottom: 0px">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Código Postal</label>
                                                <input class="form-control" name="directorio_cp" placeholder="" value="<?=$DirPaciente['directorio_cp']?>"> 
                                            </div>                   
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Calle y Número</label>
                                                <input class="form-control" name="directorio_cn" placeholder="" value="<?=$DirPaciente['directorio_cn']?>"> 
                                            </div>                   
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Colonia</label>
                                                <input class="form-control" name="directorio_colonia" placeholder="" value="<?=$DirPaciente['directorio_colonia']?>"> 
                                            </div>                   
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Municipio</label>
                                                <input class="form-control" name="directorio_municipio" placeholder="" value="<?=$DirPaciente['directorio_municipio']?>"> 
                                            </div>    

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Estado</label>
                                                <input class="form-control" name="directorio_estado" placeholder="" value="<?=$DirPaciente['directorio_estado']?>"> 
                                            </div>         

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Delegación IMSS</label>
                                                <input class="form-control" name="pum_delegacion" placeholder="" value="<?=$PINFO['pum_delegacion']?>"> 
                                            </div>     

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 14px;margin-top: -15px;margin-bottom: -35px;">
                                <div class="col-md-12 back-imss text-center">
                                    <h5><b>FAMILIAR RESPONSABLE</b></h5>
                                </div>
                            </div>
                            <div class="panel-body b-b b-light">
                                <div class="card-body" style="padding-bottom: 0px">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">En Caso necesario llamar a</label>
                                                <input class="form-control" name="pic_responsable_nombre" placeholder="" value="<?=$PINFO['pic_responsable_nombre']?>"> 
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Parentesco</label>
                                                <input class="form-control" name="pic_responsable_parentesco" placeholder="" value="<?=$PINFO['pic_responsable_parentesco']?>"> 
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Teléfono</label>
                                                <input class="form-control" name="pic_responsable_telefono" placeholder="" value="<?=$PINFO['pic_responsable_telefono']?>"> 
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 14px;margin-top: -15px;margin-bottom: -35px;">
                                <div class="col-md-12 back-imss text-center">
                                    <h5><b>MÉDICO Y ASISTENTE MÉDICA</b></h5>
                                </div>
                            </div>
                            <div class="panel-body b-b b-light">
                                <div class="card-body" style="padding-bottom: 0px">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Médico Tratante</label>
                                                <input class="form-control" name="pic_mt" required="" placeholder="" value="<?=$PINFO['pic_mt']?>"> 
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Asistente Médica</label>
                                                <input class="form-control" name="pic_am" required="" placeholder="" value="<?=$PINFO['pic_am']=='' ? $empleado[0]['empleado_nombre'].' '.$empleado[0]['empleado_apellidos'] : $PINFO['pic_am']?>"> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 14px;margin-top: -15px;margin-bottom: -35px;">
                                <div class="col-md-12 back-imss text-center">
                                    <h5><b>DATOS DEL ACCIDENTE</b></h5>
                                </div>
                            </div>
                            <div class="panel-body b-b b-light">
                                <div class="card-body" style="padding-bottom: 0px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label style="text-transform: uppercase;font-weight: bold">Lugar</label>
                                                        <select class="form-control" name="pia_lugar_accidente" data-value="<?=$PINFO['pia_lugar_accidente']?>">
                                                            <option value="">SELECCIONAR LUGAR DE ACCIDENTE</option>
                                                            <option value="C. RECREATIVO">C. RECREATIVO</option>
                                                            <option value="ESCUELA">ESCUELA</option>
                                                            <option value="TRABAJO">TRABAJO</option>
                                                            <option value="HOGAR">HOGAR</option>
                                                            <option value="TRAYECTO">TRAYECTO</option>
                                                            <option value="VIA PUBLICA">VIA PUBLICA</option>
                                                            <option value="UNIDAD IMSS">UNIDAD IMSS</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label style="text-transform: uppercase;font-weight: bold">Procedencia</label>
                                                        <input type="text" class="form-control" name="pia_lugar_procedencia" value="<?=$PINFO['pia_lugar_procedencia']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group" >
                                                                <label style="text-transform: uppercase;font-weight: bold">Fecha</label>
                                                                <input class="form-control d-m-y" name="pia_fecha_accidente" placeholder="" value="<?=$PINFO['pia_fecha_accidente']?>"> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="text-transform: uppercase;font-weight: bold">Hora</label>
                                                                <input class="form-control clockpicker" name="pia_hora_accidente" placeholder="" value="<?=$PINFO['pia_hora_accidente']?>"> 
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row lugar_trabajo omitir_st7 hide" style="padding: 14px;margin-top: -15px;margin-bottom: -35px;">
                                <div class="col-md-12 back-imss text-center">
                                    <h5><b>DATOS DEL TRABAJO</b></h5>
                                </div>
                            </div>
                            <div class="panel-body b-b b-light lugar_trabajo omitir_st7 hide">

                                <div class="card-body" style="padding-bottom: 0px">

                                    <div class="row">
                                        <div class="col-md-6 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Empresa</label>
                                                <input class="form-control" name="empresa_nombre" placeholder="" value="<?=$Empresa['empresa_nombre']?>"> 
                                            </div>
                                        </div> 
                                        <div class="col-md-6 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Modalidad</label>
                                                <input class="form-control" name="empresa_modalidad" placeholder="" value="<?=$Empresa['empresa_modalidad']?>"> 
                                            </div> 
                                        </div>
                                        <div class="col-md-6 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Registro Patronal</label>
                                                <input class="form-control" name="empresa_rp" placeholder="" value="<?=$Empresa['empresa_rp']?>"> 
                                            </div>

                                        </div>
                                        <div class="col-md-6 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Fecha de Último Movimiento</label>
                                                <input class="form-control dd-mm-yyyy" name="empresa_fum" placeholder="" value="<?=$Empresa['empresa_fum']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Teléfono (Lada)</label>
                                                <input class="form-control" name="directorio_telefono_2" placeholder="" value="<?=$DirEmpresa['directorio_telefono']?>"> 
                                            </div>
                                        </div>

                                        <div class="col-md-4 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Código Postal</label>
                                                <input class="form-control" name="directorio_cp_2" placeholder="" value="<?=$DirEmpresa['directorio_cp']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Calle y Número</label>
                                                <input class="form-control" name="directorio_cn_2" placeholder="" value="<?=$DirEmpresa['directorio_cn']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Colonia</label>
                                                <input class="form-control" name="directorio_colonia_2" placeholder="" value="<?=$DirEmpresa['directorio_colonia']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Municipio</label>
                                                <input class="form-control" name="directorio_municipio_2" placeholder="" value="<?=$DirEmpresa['directorio_municipio']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 lugar_trabajo omitir_st7 hide">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Estado</label>
                                                <input class="form-control" name="directorio_estado_2" placeholder="" value="<?=$DirEmpresa['directorio_estado']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Horario de Entrada</label>
                                                <input class="form-control clockpicker" name="empresa_he" placeholder="Entrada" value="<?=$Empresa['empresa_he']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Horario de Salida</label>
                                                <input class="form-control clockpicker" name="empresa_hs" placeholder="Salida" value="<?=$Empresa['empresa_hs']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Día de descanco P. al accidente</label>
                                                <input class="form-control" name="pia_dia_pa" placeholder="" value="<?=$PINFO['pia_dia_pa']?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-8">
                                <input type="hidden" name="url_tipo" value="Am">
                                <input type="hidden" name="csrf_token" >
                                <input type="hidden" name="triage_id" value="<?=$this->uri->segment(3)?>"> 
                                <input type="hidden" name="triage_solicitud_rx" value="<?=$info[0]['triage_solicitud_rx']?>">
                                <input type="hidden" name="asistentesmedicas_id" value="<?=$solicitud[0]['asistentesmedicas_id']?>">
                                <input type="hidden" name="info_vigencia_acceder" value="<?=$PINFO['info_vigencia_acceder']?>">
                                <button class="btn back-imss  btn-block " type="submit" >Guardar</button>                     
                            </div>
                            <br><br><br><br>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<input type="hidden" name="ConfigHojaInicialAsistentes" value="<?=CONFIG_AM_HOJAINICIAL?>">
<input type="hidden" name="CONFIG_AM_INTERACCION_LT" value="<?=CONFIG_AM_INTERACCION_LT?>">
<?= modules::run('Sections/Menu/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script> 
<script src="<?= base_url('assets/js/Choque.js?'). md5(microtime())?>" type="text/javascript"></script>
