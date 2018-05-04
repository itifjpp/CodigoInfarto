<?= modules::run('Sections/Menu/loadHeader'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <?php if(SIGH_VALIDAR_VIGENCIA=='Si'){ ?>
                    <?php if($info['ingreso_acceder']=='Si Validado'){?>
                    <?php if($info['paciente_vigenciaacceder']=='NO'){?>
                        <?php if($info['paciente_vigenciaarimac']!=''){?>
                        <div class="grid-title orange text-center" >
                            <h4 class="text-center color-white no-margin semi-bold line-height" style="margin-top: -4px!important">
                                ESTADO: PACIENTE NO VIGENTE POR ACCEDER
                            </h4>
                            <h5 class="text-center color-white no-margin line-height semi-bold">PACIENTE CON DERECHO A SERVICIO MÉDICO AUTORIZADO POR ARIMAC</h5>
                            <h5 class="text-center color-white no-margin line-height semi-bold">MOTIVO DE AUTORIZACIÓN: <?=$info['info_vigencia_autorizacion_tipo']?></h5>
                        </div>
                        <?php }else{?>
                        <div class="grid-title red text-center">
                            <h5 class="text-center color-white no-margin semi-bold" style="margin-top: -4px!important">
                                PACIENTE NO VIGENTE POR ACCEDER. ENVIAR A ARIMAC
                            </h5>
                        </div>
                        <?php }?>
                    <?php }?>
                    <?php if($info['paciente_vigenciaacceder']=='SI'){?>
                    <div class="grid-title blue text-center" >
                        <h5 class="text-center color-white no-margin semi-bold line-height" style="margin-top: -4px!important">
                            PACIENTE CON VIGENCIA A SERVICIO MÉDICO
                        </h5>
                    </div>
                    <?php }?>
                    
                    <?php }else{?>
                    <div class="grid-title orange text-center" >
                        <h5 class="text-center color-white no-margin semi-bold line-height" style="margin-top: -4px!important">
                            PACIENTE NO VALIDADO POR ACCEDER
                        </h5>
                    </div>
                    <?php }?>
                    <?php }?>
                    <div class="grid-title sigh-background-secundary" style="border-top: transparent">
                        <div class="row <?=$_GET['via']=='Choque' ? '':'hide'?>">
                            <div class="col-md-12 text-left">
                                <h4 class="color-white no-margin text-left">PACIENTE NO IDENTIFICADO INGRESADO POR CHOQUE</h4>
                            </div>
                        </div>
                        <div class="row <?=$_GET['via']=='Choque' ? 'hide':''?>">
                            <div style="position: relative">
                                <div class="<?= Modules::run('Config/ColorClasificacion',array('color'=>$info['ingreso_clasificacion']))?>" style="height: 85px;width: 18px;position: absolute;top: -14px;left: 0px;"></div>
                            </div>
                            <div class="col-md-6" style="padding-left: 30px;">
                                <h3 class="color-white no-margin semi-bold text-uppercase text-nowrap-user" style="height: 30px!important">
                                    <?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?>
                                </h3>
                                <h4 class="color-white">
                                    <?php 
                                    if($info['paciente_fn']!=''){
                                        $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                        echo $fecha->y.' AÑOS';
                                    }else{
                                        echo 'S/E';
                                    }
                                    ?>
                                    | 
                                    <?php 
                                    if($info['paciente_fn']!=''){
                                        $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                        if($fecha->y<15){
                                            echo 'PEDIATRICO';
                                        }if($fecha->y>15 && $fecha->y<60){
                                            echo 'ADULTO';
                                        }if($fecha->y>60){
                                            echo 'GERIATRICO';
                                        }
                                    }else{
                                        echo 'S/E';
                                    }
                                    ?> | <?=$info['paciente_sexo']?>
                                </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="color-white text-uppercase no-margin text-nowrap-user" style="height: 30px!important">
                                    <?php if(isset($_GET['via'])){?>
                                    <i class="fa fa-user-md color-sig"></i> <?=$info['ingreso_destino_triage']?>-<?=$info['ingreso_consultorio_nombre']?>
                                    <?php }?>
                                    
                                </h3>
                                <h4 class="color-white no-margin">
                                    
                                </h4>
                            </div>
                        </div>
                    </div>
                    <form class="solicitud-paciente">
                        <div class="grid-body">
                            <div class="row <?=SiGH_VALIDACIONPACIENTE=='POR RFC' ?'hide':''?>">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">NÚMERO DE SEGURO SOCIAL DEL PACIENTE</h5>
                                    </div>
                                </div>
                                
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="text-uppercase">N.S.S</label>
                                                <input type="text" class="form-control" name="paciente_nss" placeholder="" value="<?=$info['paciente_nss']?>">   
                                            </div>
                                            <div class="col-md-6">
                                                <label class="text-uppercase">N.S.S Agregado</label>
                                                <input type="text" class="form-control" name="paciente_nss_agregado" placeholder="" value="<?=$info['paciente_nss_agregado']?>">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-25">
                                        <button type="button" class="btn btn-block sigh-background-secundary btn-valida-nss" <?=$info['ingreso_valida_nss']=='No' ? '': 'disabled'?>>
                                            <i class="fa fa-search"></i> BUSCAR EXPEDIENTE
                                        </button>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?=$info['paciente_nss_armado']=='' ? 'hide':''?>">
                                        <label>N.S.S ARMADO</label>
                                        <input type="text" class="form-control" name="paciente_nss_armado" readonly="" value="<?=$info['paciente_nss_armado']?>">
                                    </div>
                                </div>
                                <div class="col-md-12 hide col-if-exist-info-pac">
                                    <div class="alert alert-info">
                                        <h5 class="no-margin">Información localizada, validar con el paciente y/o familiar la información.</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row <?=SiGH_VALIDACIONPACIENTE=='POR NSS' ?'hide':''?>">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">RFC(REGISTRO FEDERAL DE CONTRIBUYENTES)</h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="paciente_rfc" value="<?=$info['paciente_rfc']?>" readonly="" class="form-control" placeholder="RFC(REGISTRO FEDERAL DE CONTRIBUYENTES)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">INFORMACIÓN BÁSICA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Apellido Paterno </label>
                                        <input type="text" class="form-control t-uc" name="paciente_ap" required=""  value="<?=$info['paciente_ap']?>">   
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Apellido Materno </label>
                                        <input type="text" class="form-control t-uc" name="paciente_am" required=""  value="<?=$info['paciente_am']?>">   
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Nombre </label>
                                        <input type="text" class="form-control t-uc" name="paciente_nombre" required="" placeholder="" value="<?=$info['paciente_nombre']?>">   
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Fecha de Nacimiento</label>
                                        <input type="text" class="form-control dd-mm-yyyy" name="paciente_fn"  value="<?=$info['paciente_fn']?>">   
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Sexo</label>
                                        <select class="width100" required="" name="paciente_sexo" data-value="<?=$info['paciente_sexo']?>">
                                            <option value="">SELECCIONAR...</option>
                                            <option value="HOMBRE">HOMBRE</option>
                                            <option value="MUJER">MUJER</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Estado Civil</label>
                                        <select class="width100 " name="paciente_estadocivil" data-value="<?=$info['paciente_estadocivil']?>">
                                            <option value="SOLTERO(A)">SOLTERO(A)</option>
                                            <option value="COMPROMETIDO(A)">COMPROMETIDO(A)</option>
                                            <option value="CASADO(A)">CASADO(A)</option>
                                            <option value="DIVORSIADO(A)">DIVORSIADO(A)</option>
                                            <option value="VIUDO(A)">VIUDO(A)</option>
                                        </select>
                                    </div>  
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">C.U.R.P</label>
                                        <input type="text" class="form-control t-uc" name="paciente_curp" placeholder="" value="<?=$info['paciente_curp']?>"> 
                                    </div>  
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">DOMICILIO DEL PACIENTE</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Código Postal</label>
                                        <input type="text" class="form-control" name="directorio_cp" placeholder="" value="<?=$DirPaciente['directorio_cp']?>"> 
                                    </div>                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Calle y Número</label>
                                        <input type="text" class="form-control t-uc" name="directorio_cn" placeholder="" value="<?=$DirPaciente['directorio_cn']?>"> 
                                    </div>                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Colonia</label>
                                        <input type="text" class="form-control t-uc" name="directorio_colonia" autocomplete="off" placeholder="" value="<?=$DirPaciente['directorio_colonia']?>"> 
                                    </div>                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Municipio</label>
                                        <input type="text" class="form-control t-uc" name="directorio_municipio" placeholder="" value="<?=$DirPaciente['directorio_municipio']?>"> 
                                    </div>    

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Estado</label>
                                        <input type="text" class="form-control t-uc" name="directorio_estado" placeholder="" value="<?=$DirPaciente['directorio_estado']?>"> 
                                    </div>         

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Teléfono</label>
                                        <input type="text" class="form-control" name="directorio_telefono" placeholder="" value="<?=$DirPaciente['directorio_telefono']?>"> 
                                    </div> 
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">UNIDAD MÉDICA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">U.M.F O C.M.F de Adscripción</label>
                                        <input type="text" class="form-control t-uc" name="paciente_umf" placeholder="" value="<?=$info['paciente_umf']?>"> 
                                    </div>  
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Delegación</label>
                                        <input type="text" class="form-control t-uc" name="paciente_delegacion" placeholder="" value="<?=$info['paciente_delegacion']?>"> 
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">FAMILIAR RESPONSABLE A QUIEN AVISAR EN CASO DE EMERGENCIA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">NOMBRE COMPLETO DEL FAMILIAR</label>
                                        <input type="text" class="form-control t-uc" name="info_responsable_nombre" placeholder="" value="<?=$info['info_responsable_nombre']?>"> 
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">PARENTESCO</label>
                                        <input type="text" class="form-control t-uc" name="info_responsable_parentesco" placeholder="" value="<?=$info['info_responsable_parentesco']?>"> 
                                    </div>  
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Teléfono</label>
                                        <input type="text" class="form-control" name="info_responsable_telefono" placeholder="" value="<?=$info['info_responsable_telefono']?>"> 
                                    </div>  
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">MÉDICO TRATANTE Y ASISTENTE MÉDICA</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">Médico Tratante</label>
                                        <input type="text" class="form-control t-uc" name="info_mt" required="" placeholder="" value="<?=$info['info_mt']?>"> 
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Asistente Médica</label>
                                        <input type="text" class="form-control t-uc" name="info_am" required="" readonly="" placeholder="" value="<?=$empleado[0]['empleado_nombre'].' '.$empleado[0]['empleado_ap'] .' '.$empleado[0]['empleado_am']?>"> 
                                    </div> 
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">ANTECEDENTES PREVIO A LA ATENCIÓN</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Lugar</label>
                                        <select class="width100" name="info_lugar_accidente" data-value="<?=$info['info_lugar_accidente']?>">
                                            <option value="">LUGAR DE ACCIDENTE</option>
                                            <option value="C. RECREATIVO">C. RECREATIVO</option>
                                            <option value="ESCUELA">ESCUELA</option>
                                            <option value="TRABAJO">TRABAJO</option>
                                            <option value="HOGAR">HOGAR</option>
                                            <option value="TRAYECTO">TRAYECTO</option>
                                            <option value="VIA PUBLICA">VIA PUBLICA</option>
                                            <option value="UNIDAD MÉDICA DE LA INSTITUCIÓN">UNIDAD MÉDICA DE LA INSTITUCIÓN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Procedencia</label>
                                        <input type="text" class="form-control t-uc" name="info_lugar_procedencia" value="<?=$info['info_lugar_procedencia']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Identificación</label>
                                        <input type="text" class="form-control t-uc" name="info_identificacion" value="<?=$info['info_identificacion']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label class="text-uppercase">Fecha</label>
                                                <input type="text" class="form-control d-m-y" name="info_fecha_accidente" placeholder="" value="<?=$info['info_fecha_accidente']?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-uppercase">Hora</label>
                                                <input type="text" class="form-control clockpicker" name="info_hora_accidente" placeholder="" value="<?=$info['info_hora_accidente']?>"> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Día de descanso P. al accidente</label>
                                        <input type="text" class="form-control t-uc" name="info_dia_pa" placeholder="" value="<?=$info['info_dia_pa']?>"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row row-st7 hide">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">INFORMACIÓN ACERCA DE LA EMPRESA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Empresa</label>
                                        <input type="text" class="form-control t-uc" name="empresa_nombre" placeholder="" value="<?=$Empresa['empresa_nombre']?>"> 
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Modalidad</label>
                                        <input type="text" class="form-control t-uc" name="empresa_modalidad" placeholder="" value="<?=$Empresa['empresa_modalidad']?>"> 
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Registro Patronal</label>
                                        <input type="text" class="form-control t-uc" name="empresa_rp" placeholder="" value="<?=$Empresa['empresa_rp']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Fecha de Último Movimiento</label>
                                        <input type="text" class="form-control dd-mm-yyyy" name="empresa_fum" placeholder="" value="<?=$Empresa['empresa_fum']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Horario de Entrada</label>
                                        <input type="text" class="form-control clockpicker" name="empresa_he" placeholder="ENTRADA" value="<?=$Empresa['empresa_he']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Horario de Salida</label>
                                        <input type="text" class="form-control clockpicker" name="empresa_hs" placeholder="SALIDA" value="<?=$Empresa['empresa_hs']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-st7 hide">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h5 class="semi-bold">DOMICILIO DE LA EMPRESA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Código Postal</label>
                                        <input type="text" class="form-control t-uc" name="directorio_cp_2" placeholder="" value="<?=$DirEmpresa['directorio_cp']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Calle y Número</label>
                                        <input type="text" class="form-control t-uc" name="directorio_cn_2" placeholder="" value="<?=$DirEmpresa['directorio_cn']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Colonia</label>
                                        <input type="text" class="form-control t-uc" name="directorio_colonia_2" autocomplete="off" placeholder="" value="<?=$DirEmpresa['directorio_colonia']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="text-uppercase">Municipio</label>
                                        <input type="text" class="form-control t-uc" name="directorio_municipio_2" placeholder="" value="<?=$DirEmpresa['directorio_municipio']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Estado</label>
                                        <input type="text" class="form-control t-uc" name="directorio_estado_2" placeholder="" value="<?=$DirEmpresa['directorio_estado']?>"> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">Teléfono</label>
                                        <input type="text" class="form-control" name="directorio_telefono_2" placeholder="" value="<?=$DirEmpresa['directorio_telefono']?>"> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <button type="button" <?php if($_GET['via']=='Choque'){?> onclick="location.href=base_url+'Choque'" <?php }else{?> onclick="location.href=base_url+'Asistentesmedicas'" <?php }?> class="btn btn-danger btn-block">Cancelar</button>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="hidden" name="url_tipo" value="Am">
                                    <input type="hidden" name="ingreso_id" value="<?=$this->uri->segment(3)?>"> 
                                    <input type="hidden" value="Asistente Médica" name="AsistenteMedicaTipo">
                                    <input type="hidden" name="paciente_vigenciaacceder" value="<?=$info['paciente_vigenciaacceder']?>">
                                    <input type="hidden" name="paciente_vigenciaarimac" value="<?=$info['paciente_vigenciaarimac']?>">
                                    <input type="hidden" name="ingreso_acceder" value="<?=$info['ingreso_acceder']?>">
                                    <input type="hidden" name="ingreso_am_date" value="<?=$info['ingreso_am_date']?>">
                                    <input type="hidden" name="ingreso_consultorio_nombre" value="<?=$info['ingreso_consultorio_nombre']?>">
                                    <input type="hidden" name="paciente_id" value="<?=$info['paciente_id']?>">
                                    <input type="hidden" name="paciente_via" value="<?=$_GET['via']?>">
                                    <input type="hidden" name="ingreso_valida_nss" value="<?=$info['ingreso_valida_nss']?>">
                                    <input type="hidden" name="ingreso_pv" value="<?=$info['ingreso_pv']?>">
                                    <button class="btn sigh-background-secundary btn-block " type="submit" >Guardar</button>                     
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= Modules::run('Sections/Menu/loadFooter');?> 
<input type="hidden" name="ConfigHojaInicialAsistentes" value="<?=CONFIG_AM_HOJAINICIAL?>">
<input type="hidden" name="CONFIG_AM_INTERACCION_LT" value="<?=CONFIG_AM_INTERACCION_LT?>">
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script>