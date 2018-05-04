<?= modules::run('Sections/Menu/index'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />

<style>hr.style-eight {border: 0;border-top: 2px dashed #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -13px;font-size: 1.2em;padding: 0 0.20em;background: white;font-weight:bold;}</style>
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-11 col-centered">
            <div class="box-inner padding">
                <form class="solicitud-paciente">
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
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 style="margin-top: -2px">
                                            <b>PACIENTE: <?=$info[0]['triage_nombre_ap']?> <?=$info[0]['triage_nombre_am']?> <?=$info[0]['triage_nombre']?></b>
                                        </h3>
                                        <h4 style="margin-top: -5px">
                                            <b>EDAD: </b>
                                            <?php 
                                            if($info[0]['triage_fecha_nac']!=''){
                                                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info[0]['triage_fecha_nac']));
                                                echo $fecha->y.' Años';
                                            }else{
                                                echo 'S/E';
                                            }
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <h3 style="margin-top: -2px">
                                            <b>DESTINO: <?=$info[0]['triage_consultorio_nombre']?></b>
                                        </h3>
                                        <h4 style="margin-top: -5px">
                                            <?php 
                                            if($info[0]['triage_fecha_nac']!=''){
                                                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info[0]['triage_fecha_nac']));
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
                                            ?> | <?=$info[0]['triage_paciente_sexo']?>
                                        </h4>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="panel-body b-b b-light">
                            <div class="card-body" style="padding-bottom: 0px">
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
                                        <div  class="row">
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
                                                    <label style="text-transform: uppercase;font-weight: bold">Fecha de Nacimiento</label>
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
                                                    <label style="text-transform: uppercase;font-weight: bold">Teléfono</label>
                                                    <input class="form-control" name="directorio_telefono" placeholder="" value="<?=$DirPaciente['directorio_telefono']?>"> 
                                                </div> 
                                            </div>
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
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8">
                            <input type="hidden" name="url_tipo" value="Am">
                            <input type="hidden" name="csrf_token" >
                            <input type="hidden" name="triage_id" value="<?=$this->uri->segment(4)?>"> 
                            <input type="hidden" name="triage_solicitud_rx" value="<?=$info[0]['triage_solicitud_rx']?>">
                            <input type="hidden" name="asistentesmedicas_id" value="<?=$solicitud[0]['asistentesmedicas_id']?>">
                            <input type="hidden" value="Asistente Médica Ortopedia" name="AsistenteMedicaTipo">
                            <button class="btn back-imss  btn-block " type="submit" >Guardar</button>                     
                        </div>
                        <br><br><br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script> 