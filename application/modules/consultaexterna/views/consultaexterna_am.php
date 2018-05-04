<?= modules::run('Sections/Menu/index'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />

<style>hr.style-eight {border: 0;border-top: 2px dashed #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -13px;font-size: 1.2em;padding: 0 0.20em;background: white;font-weight:bold;}</style>
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-11 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default " style="margin-top: -10px">
                    <div class="hide triage-status-paciente" style="margin-top: -10px;height: 35px;">
                        <br>
                        <h5 class="text-center" style="margin-top: -8px;color: white"><b>BAJA</b></h5>
                    </div>
                    <?php if($info[0]['triage_paciente_sexo']=='MUJER'){?>
                    <div  style="background: pink;width: 100%;height: 10px;border-radius: 3px 3px 0px 0px"></div>
                    <?php }?>
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                            ASISTENTES MÉDICAS - CONSULTA EXTERNA
                        </span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="card-body">
                            <form class="solicitud-am-consultaexterna">
                                <div class="row" style="margin-top: -20px">
                                    <div class="col-md-12" style="margin-top: 0px">
                                        <div class="row" >
                                            <div class="col-md-4" >
                                                <div class="form-group" >
                                                    <label style="text-transform: uppercase;font-weight: bold">Hoja</label>
                                                    <input class="form-control" name="asistentesmedicas_hoja" value="<?=$solicitud[0]['asistentesmedicas_hoja']?>">   
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" >
                                                    <label style="text-transform: uppercase;font-weight: bold">Renglón </label>
                                                    <input class="form-control" name="asistentesmedicas_renglon" value="<?=$solicitud[0]['asistentesmedicas_renglon']?>">   
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Apellido Paterno </label>
                                            <input class="form-control" name="triage_nombre_ap" required=""  value="<?=$info[0]['triage_nombre_ap']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Apellido Materno </label>
                                            <input class="form-control" name="triage_nombre_am" required=""  value="<?=$info[0]['triage_nombre_am']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Nombre </label>
                                            <input class="form-control" name="triage_nombre" required="" placeholder="" value="<?=$info[0]['triage_nombre']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Fecha Nac</label>
                                            <input class="form-control dd-mm-yyyy" name="triage_fecha_nac" placeholder="06/10/2016" value="<?=$info[0]['triage_fecha_nac']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Sexo</label>
                                            <select class="form-control" required="" name="triage_paciente_sexo" data-value="<?=$info[0]['triage_paciente_sexo']?>">
                                                <option value="">Seleccionar</option>
                                                <option value="HOMBRE">HOMBRE</option>
                                                <option value="MUJER">MUJER</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Estado Civil</label>
                                            <select class="form-control width100 " name="triage_paciente_estadocivil" data-value="<?=$info[0]['triage_paciente_estadocivil']?>">
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="COMPROMETIDO(A)">COMPROMETIDO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option value="DIVORSIADO(A)">DIVORSIADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                            </select>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label style="text-transform: uppercase;font-weight: bold">N.S.S</label>
                                            <input class="form-control" name="pum_nss" placeholder="" value="<?=$PINFO['pum_nss']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label style="text-transform: uppercase;font-weight: bold">N.S.S Agregado</label>
                                            <input class="form-control" name="pum_nss_agregado" placeholder="" value="<?=$PINFO['pum_nss_agregado']?>">   
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">U.M.F de Adscripción</label>
                                            <input class="form-control" name="pum_umf" placeholder="" value="<?=$PINFO['pum_umf']?>"> 
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">C.U.R.P</label>
                                            <input class="form-control" name="triage_paciente_curp" placeholder="" value="<?=$info[0]['triage_paciente_curp']?>"> 
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Identificación</label>
                                            <input class="form-control" name="pic_identificacion" placeholder="" value="<?=$PINFO['pic_identificacion']?>"> 
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label style="text-transform: uppercase;font-weight: bold">Telefono</label>
                                            <input class="form-control" name="directorio_telefono" placeholder="" value="<?=$DirPaciente['directorio_telefono']?>"> 
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <hr class="style-eight" data-titulo="Domicilio">
                                            <div class="col-md-4">
                                                <div class="form-group" >
                                                    <label style="text-transform: uppercase;font-weight: bold">Código Postal</label>
                                                    <input class="form-control" name="directorio_cp" placeholder="" value="<?=$DirPaciente['directorio_cp']?>"> 
                                                </div>                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label style="text-transform: uppercase;font-weight: bold">Calle y Numero</label>
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
                                    <div class="col-md-12">
                                        <hr class="style-eight" data-titulo="Familiar Responsable">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label style="text-transform: uppercase;font-weight: bold">En Caso necesario llamar a:</label>
                                            <input class="form-control" name="pic_responsable_nombre" placeholder="" value="<?=$PINFO['pic_responsable_nombre']?>"> 
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Parentesco:</label>
                                            <input class="form-control" name="pic_responsable_parentesco" placeholder="" value="<?=$PINFO['pic_responsable_parentesco']?>"> 
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label style="text-transform: uppercase;font-weight: bold">Teléfono:</label>
                                            <input class="form-control" name="pic_responsable_telefono" placeholder="" value="<?=$PINFO['pic_responsable_telefono']?>"> 
                                        </div>  
                                    </div>
                                    <div class="col-md-12">
                                        <hr class="style-eight" data-titulo="Médico y Asistente Médica">
                                    </div>
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
                                    <div class="col-md-12">
                                        <hr class="style-eight" data-titulo="Datos de Accidente">
                                    </div>
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
                                                <div class="form-group">
                                                    <label style="text-transform: uppercase;font-weight: bold">Dia de descanco P. al accidente</label>
                                                    <input class="form-control" name="pia_dia_pa" placeholder="" value="<?=$PINFO['pia_dia_pa']?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" >
                                                    <label style="text-transform: uppercase;font-weight: bold">Fecha de accidente</label>
                                                    <input class="form-control d-m-y" name="pia_fecha_accidente" placeholder="" value="<?=$PINFO['pia_fecha_accidente']?>"> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label style="text-transform: uppercase;font-weight: bold">Hora de accidente</label>
                                                    <input class="form-control clockpicker" name="pia_hora_accidente" placeholder="" value="<?=$PINFO['pia_hora_accidente']?>"> 
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 lugar_trabajo hide">
                                        <hr class="style-eight" data-titulo="Datos del Trabajo">
                                    </div>
                                    <div class="col-md-12 lugar_trabajo hide">
                                        <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green btn-importador-st7 waves-effect pull-right tip " data-original-title="Importar nformación del paciente desde vigencia de verecho para la ST7" style="margin-top: -50px">
                                            <i class="fa fa-cloud-download i-24"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-12 lugar_trabajo hide hidden">
                                        <div class="form-group">
                                            <label>CUENTA CON ST7 EMITIDA POR OTRA UNIDAD</label>&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" name="asistentesmedicas_exectuar_st7" value="Si" data-value="<?=$solicitud[0]['asistentesmedicas_exectuar_st7']?>" class="has-value">
                                                <i class="blue"></i>Si
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" name="asistentesmedicas_exectuar_st7" checked="" value="No" data-value="<?=$solicitud[0]['asistentesmedicas_exectuar_st7']?>" class="has-value">
                                                <i class="blue"></i>No
                                            </label>
                                        </div>
                                    </div>
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
                                            <label style="text-transform: uppercase;font-weight: bold">Telefono (Lada)</label>
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
                                            <label style="text-transform: uppercase;font-weight: bold">Calle y Numero</label>
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
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8 lugar_trabajo omitir_st7 hide">
                                                <div class="form-group" >
                                                    <label style="text-transform: uppercase;font-weight: bold">Horario de Trabajo Entrada/Salida</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input class="form-control clockpicker" name="empresa_he" placeholder="Entrada" value="<?=$Empresa['empresa_he']?>"> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control clockpicker" name="empresa_hs" placeholder="Salida" value="<?=$Empresa['empresa_hs']?>"> 
                                                        </div>
                                                    </div>

                                                </div> 
                                            </div> 
                                        </div>

                                    </div>
                                    <div class="col-md-4 col-md-offset-8">
                                        <input type="hidden" name="url_tipo" value="Am">
                                        <input type="hidden" name="csrf_token" >
                                        <input type="hidden" name="triage_id" value="<?=$this->uri->segment(3)?>"> 
                                        <input type="hidden" name="triage_solicitud_rx" value="<?=$info[0]['triage_solicitud_rx']?>">
                                        <input type="hidden" name="asistentesmedicas_id" value="<?=$solicitud[0]['asistentesmedicas_id']?>">
                                        <button class="md-btn md-raised m-b btn-fw back-imss  btn-block waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
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
<input type="hidden" name="ConfigHojaInicialAsistentes" value="<?=CONFIG_AM_HOJAINICIAL?>">
<input type="hidden" name="CONFIG_AM_INTERACCION_LT" value="<?=CONFIG_AM_INTERACCION_LT?>">
<?= modules::run('Sections/Menu/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script> 
<script src="<?= base_url('assets/js/ConsultaExterna.js?'). md5(microtime())?>" type="text/javascript"></script>