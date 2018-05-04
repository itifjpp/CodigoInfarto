<?= modules::run('Sections/Menu/loadHeader'); ?> 
<link href="<?= base_url()?>assetsv2/plugins/webcam/wc.css" type="text/css" rel="stylesheet">
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold">PERFIL DE USUARIO</h4>
                    </div>
                    <div class="grid-body">
                        <form class="guardar-info-perfil">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                                <h5 class="m-b-5 m-t-5 semi-bold">INFORMACIÓN GENERAL</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">NOMBRE:</label>
                                                <input type="text" class="form-control t-uc" name="empleado_nombre" required="" value="<?=$info[0]['empleado_nombre']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">A. PATERNO:</label>
                                                        <input type="text" class="form-control t-uc" name="empleado_ap" value="<?=$info[0]['empleado_ap']?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">A. MATERNO:</label>
                                                        <input type="text" class="form-control t-uc" name="empleado_am" value="<?=$info[0]['empleado_am']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">SEXO:</label>
                                                <select name="empleado_sexo"  class="width100 " data-value="<?=$info[0]['empleado_sexo']?>">
                                                    <option value="M">HOMBRE</option>
                                                    <option value="F">MUJER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">FECHA DE NACIMIENTO:</label>
                                                <input type="text" class="form-control d-m-y" name="empleado_fn" value="<?=$info[0]['empleado_fn']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">CURP</label>
                                                <input type="text" class="form-control" name="empleado_curp" autocomplete="empleado_curp" value="<?=$info[0]['empleado_curp']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">ESTADO CIVIL</label>
                                                <select class="width100 " name="empleado_estadocivil" data-value="<?=$info[0]['empleado_estadocivil']?>">
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
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">LUGAR DE NACIMIENTO</label>
                                                <input type="text" class="form-control" name="empleado_lugar_nac" autocomplete="empleado_lugar_nac" value="<?=$info[0]['empleado_lugar_nac']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">NACIONALIDAD</label>
                                                <input type="text" class="form-control" name="empleado_nacionalidad" autocomplete="empleado_nacionalidad" value="<?=$info[0]['empleado_nacionalidad']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">RFC</label>
                                                <input type="text" class="form-control" name="empleado_rfc" autocomplete="empleado_rfc" value="<?=$info[0]['empleado_rfc']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">N° DE SEGURO</label>
                                                <input type="text" class="form-control" name="empleado_nss" autocomplete="empleado_nss" value="<?=$info[0]['empleado_nss']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold">FOTO DE PERFIL</h5>
                                    </div>
                                    <div class="tools-image">
                                        <img src="<?= base_url()?>assets/img/perfiles/<?=$info[0]['empleado_perfil']?>" class="width100" style="margin-top: 10px;">

                                        <div class="tools-image-controls">
                                            <a href="#" title="TOMAR FOTO DE PERFIL" class="link-image-capture" data-url="Administrador" data-emp="<?=$info[0]['empleado_id']?>">
                                                <i class="material-icons">camera_alt</i>
                                            </a>
                                        </div>
                                    </div>   
                                    <input type="hidden" name="empleado_perfil" class="form-control" value="<?=$info[0]['empleado_perfil']?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-10">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold " style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN DE CONTACTO</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CÓDIGO POSTAL</label>
                                        <input type="text" name="directorio_cp" value="<?=$Directorio['directorio_cp']?>" class="form-control t-uc" placeholder="CÓDIGO POSTAL...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CALLE Y NÚMERO</label>
                                        <input type="text" name="directorio_calle" value="<?=$Directorio['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>COLONIA</label>
                                        <input type="text" name="directorio_colonia" value="<?=$Directorio['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>MUNICIPIO O DELEGACIÓN</label>
                                        <input type="text" name="directorio_municipio" autocomplete="directorio_municipio" value="<?=$Directorio['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>ESTADO</label>
                                        <input type="text" name="directorio_estado" autocomplete="directorio_estado" value="<?=$Directorio['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>TELEFONO</label>
                                                <input type="text" class="form-control" name="directorio_telefono" value="<?=$Directorio['directorio_telefono']?>" placeholder="TELEFONO">
                                            </div>
                                            <div class="col-md-6">
                                                <label>EMAIL</label>
                                                <input type="text" class="form-control" name="directorio_email" value="<?=$Directorio['directorio_email']?>" placeholder="EMAIL">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-t-10" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">FAMILIARES MÁS CERCANOS A QUIEN AVISAR EN CASO DE EMERGENCIA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label class="">NOMBRE</label>
                                        <input type="text" class="form-control t-uc" name="familiar_nombre" autocomplete="familiar_nombre" value="<?=$Familiar['familiar_nombre']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label class="">APELLIDOS</label>
                                        <input type="text" class="form-control t-uc" name="familiar_apellidos" autocomplete="familiar_apellidos" value="<?=$Familiar['familiar_apellidos']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label class="">PARENTESCO</label>
                                        <input type="text" class="form-control t-uc" name="familiar_parentesco" autocomplete="familiar_parentesco" value="<?=$Familiar['familiar_parentesco']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CÓDIGO POSTAL</label>
                                        <input type="text" name="directorio_cp2" autocomplete="directorio_cp2" value="<?=$Directorio2['directorio_cp']?>" class="form-control" placeholder="CÓDIGO POSTAL...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CALLE Y NÚMERO</label>
                                        <input type="text" name="directorio_calle2" autocomplete="directorio_calle2" value="<?=$Directorio2['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>COLONIA</label>
                                        <input type="text" name="directorio_colonia2" autocomplete="directorio_colonia2" value="<?=$Directorio2['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>MUNICIPIO O DELEGACIÓN</label>
                                        <input type="text" name="directorio_municipio2" autocomplete="directorio_municipio2" value="<?=$Directorio2['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO O DELEGACIÓN...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>ESTADO</label>
                                        <input type="text" name="directorio_estado2" autocomplete="directorio_estado2" value="<?=$Directorio2['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>TELÉFONO</label>
                                        <input type="text" class="form-control" autocomplete="directorio_telefono2" name="directorio_telefono2" value="<?=$Directorio2['directorio_telefono']?>" placeholder="TELÉFONO">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-10">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold">INFORMACIÓN REFERENTE AL TRABAJO</h5>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">N° O MATRICULA DE EMPLEADO:</label>
                                        <input type="text" class="form-control" name="empleado_matricula" readonly="" value="<?=$info[0]['empleado_matricula']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">TURNO:</label>
                                        <select name="empleado_turno" class="width100" data-value="<?=$info[0]['empleado_turno']?>">
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                            <option value="Nocturno">Nocturno</option>
                                            <option value="Jornada Acumulada">Jornada Acumulada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-b-5">
                                        <label class="">CATEGORÍA:</label>
                                        <input type="text" class="form-control" name="empleado_departamento" value="<?=$info[0]['empleado_departamento']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">DEPARTAMENTO</label>
                                        <input type="text" class="form-control t-uc" name="empleado_departamento" autocomplete="off" value="<?=$info[0]['empleado_departamento']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">ESPECIALIDAD:</label>
                                        <select name="empleado_servicio" class="width100" data-value="<?=$info[0]['empleado_servicio']?>">
                                            <option value="">No Aplica</option>
                                            <?php foreach ($Especialidades as $value) {?>
                                            <option value="<?=$value['especialidad_nombre']?>"><?=$value['especialidad_nombre']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">CÉDULA PROFECIONAL:</label>
                                        <input type="text" class="form-control" name="empleado_cedula" value="<?=$info[0]['empleado_cedula']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">FECHA DE INGRESO EN LA UM</label>
                                        <input type="text" class="form-control dp-yyyy-mm-dd" name="empleado_ingreso" value="<?=$info[0]['empleado_ingreso']?>" placeholder="REGISTRO EN LA UNIDAD MÉDICA">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">TIPO DE PLAZA</label>
                                        <select name="empleado_tipoplaza" data-value="<?=$info[0]['empleado_tipoplaza']?>">
                                            <option value="CONFIANZA">CONFIANZA</option>
                                            <option value="BASE">BASE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-t-10" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold">INFORMACIÓN DE ACCESO AL SISTEMA</h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group text-justify">
                                        <h5 class="semi-bold no-margin m-b-10"><i class="fa fa-unlock-alt sigh-color i-16"></i> ROLES ASIGNADOS</h5>
                                        <h5 class="line-height">
                                        <?php $Rol=''; foreach ($Roles as $value) {
                                            $Rol.=$value['rol_nombre'].', ';
                                        }?>
                                        <?= trim($Rol, ', ')?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <div class="checkbox check-success text-uppercase semi-bold">
                                            <input id="empleado_sc" type="checkbox" name="empleado_sc" value="Si" data-value="<?=$info[0]['empleado_sc']?>">
                                            <label for="empleado_sc">Solicitar Contraseña al Inicio de Sesión</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 empleado_sc hide">
                                    <div class="form-group no-margin">
                                        <div class="input-group transparent">
                                            <span class="input-group-addon">
                                                <i class="fa fa-unlock-alt"></i>
                                            </span>
                                            <input type="password" name="empleado_password" value="<?= base64_decode($info[0]['empleado_base64'])?>" class="form-control" placeholder="INGRESAR CONTRASEÑA">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 empleado_sc hide">
                                    <div class="form-group no-margin">
                                        <div class="input-group transparent">
                                            <span class="input-group-addon">
                                                <i class="fa fa-unlock-alt"></i>
                                            </span>
                                            <input type="password" name="empleado_password_c" value="<?= base64_decode($info[0]['empleado_base64'])?>" class="form-control" placeholder="CONFIRMAR CONTRASEÑA">
                                        </div>
                                    </div>
                                    <div class="form-group pull-right" style="margin-top: 5px;">
                                        <div class="checkbox check-danger">
                                            <input id="show_hide_password" name="show_hide_password" type="checkbox" >
                                            <label for="show_hide_password">Mostrar/Ocultar Contraseña</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-offset-8 col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="empleado_perfil" value="<?=$info[0]['empleado_perfil']?>" id="filename">
                                        <input type="hidden" name="empleado_id" value="<?=$info[0]['empleado_id']?>">
                                        <button class="btn sigh-background-secundary btn-block">Guardar</button>
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

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>"></script>