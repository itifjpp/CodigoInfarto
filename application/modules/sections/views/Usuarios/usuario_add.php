<?= Modules::run('Sections/Menu/loadHeader'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px;margin-left: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Usuarios">Usuarios</a></li>
            <li><a href="#">Agregar/Editar Usuario</a></li>
        </ol>
        <div class="row m-t-10">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">AGREGAR USUARIO</h4>
                    </div>
                    <div class="grid-body">
                        <form class="form-add-users">
                            <div class="row">
                                <div class="col-md-8 col-xs-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN GENERAL</h5>
                                            </div>
                                        </div>    
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <label class="">NOMBRE</label>
                                                <input type="text" class="form-control t-uc" required="" name="empleado_nombre" autocomplete="empleado_nombre" value="<?=$info[0]['empleado_nombre']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label class="">A. PATERNO</label>
                                                        <input type="text" class="form-control t-uc" required="" name="empleado_ap" autocomplete="empleado_ap" value="<?=$info[0]['empleado_ap']?>">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label class="">A. MATERNO</label>
                                                        <input type="text" class="form-control t-uc" required="" name="empleado_am" autocomplete="empleado_am" value="<?=$info[0]['empleado_am']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <label class="">SEXO</label>
                                                <select name="empleado_sexo"  class="width100 " data-value="<?=$info[0]['empleado_sexo']?>">
                                                    <option value="M">HOMBRE</option>
                                                    <option value="F">MUJER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <label class="">FECHA DE NACIMIENTO:</label>
                                                <input type="text" class="form-control d-m-y" required="" name="empleado_fn" autocomplete="empleado_fn" value="<?=$info[0]['empleado_fn']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <label class="">CURP</label>
                                                <input type="text" class="form-control t-uc" name="empleado_curp" autocomplete="empleado_curp" value="<?=$info[0]['empleado_curp']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
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
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <label class="">LUGAR DE NACIMIENTO</label>
                                                <input type="text" class="form-control t-uc" name="empleado_lugar_nac" autocomplete="empleado_lugar_nac" value="<?=$info[0]['empleado_lugar_nac']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group m-b-5">
                                                <label class="">NACIONALIDAD</label>
                                                <input type="text" class="form-control t-uc" name="empleado_nacionalidad" autocomplete="empleado_nacionalidad" value="<?=$info[0]['empleado_nacionalidad']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label>RFC</label>
                                                <input type="text" name="empleado_rfc" required="" autocomplete="empleado_rfc" value="<?=$info[0]['empleado_rfc']?>" placeholder="RFC" class="form-control t-uc">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label>N° DE SEGURO</label>
                                                <input type="text" name="empleado_nss" autocomplete="empleado_nss" value="<?=$info[0]['empleado_nss']?>" placeholder="N° DE SEGURO" class="form-control t-uc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <div class="row">
                                        <div class="col-md-12 m-b-5">
                                            <div class="form-group m-b-5" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">FOTO DE PERFIL PARA LA CREDENCIAL</h5>
                                            </div>
                                            <?php if(file_exists('assets/img/perfiles/'.$info[0]['empleado_perfil']) && $info[0]['empleado_perfil']!='default_.png'){ ?>
                                            <button type="button" class="md-btn md-fab m-b red " onclick="AbrirVista(base_url+'Sections/Usuarios/RecortarImagenCredencial?user=<?=$info[0]['empleado_id']?>')" style="position: absolute;right: 0px;top: -10px">
                                                <i class="material-icons i-24 color-white">crop</i>
                                            </button>
                                            <?php }?>
                                        </div>   
                                        <div class="col-md-12">                                            
                                            <div class="tools-image" style="padding: 0px 30px 0px 30px">
                                                <?php if(!file_exists('assets/img/perfiles/'.$info[0]['empleado_image_credencial']) || $info[0]['empleado_image_credencial']==''){?>
                                                <img src="<?= base_url()?>assets/img/perfiles/default_.png" class="width100" style="margin-top: 10px;padding: 0px 20px 0px 20px">
                                                <h5 class="text-center line-height">
                                                    <i class="fa fa-times fa-3x" style="color:red"></i> 
                                                    <?php if($info[0]['empleado_perfil']!='' && $info[0]['empleado_perfil']!='default_.png'){ ?>
                                                    <br>YA EXISTE UNA FOTOGRAFIA PERO AÚN NO SE HA TOMADO LA FOTO DE PERFIL PARA LA CREDENCIAL
                                                    <?php }else{?>
                                                    <br>AÚN NO SE HA TOMADO LA FOTO DE PERFIL PARA LA CREDENCIAL
                                                    <?php }?>
                                                    
                                                </h5>
                                                <?php }else{?>
                                                <img src="<?=base_url()?>assets/img/perfiles/<?=$info[0]['empleado_image_credencial']?>" class="width100 image-profile">

                                                <?php }?>

                                                <div class="tools-image-controls">
                                                    <a href="#" title="TOMAR FOTO DE PERFIL" class="link-image-capture" data-url="Administrador" data-emp="<?=$info[0]['empleado_id']?>">
                                                        <i class="material-icons">camera_alt</i>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-5">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold " style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN DE CONTACTO</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CÓDIGO POSTAL</label>
                                        <input type="text" name="directorio_cp" required="" value="<?=$Directorio[0]['directorio_cp']?>" autocomplete="directorio_cp" class="form-control" placeholder="CÓDIGO POSTAL...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CALLE Y NÚMERO</label>
                                        <input type="text" name="directorio_calle" required="" value="<?=$Directorio[0]['directorio_calle']?>" autocomplete="directorio_calle" class="form-control t-uc" placeholder="CALLE...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>COLONIA</label>
                                        <input type="text" name="directorio_colonia" required="" value="<?=$Directorio[0]['directorio_colonia']?>" autocomplete="directorio_colonia" class="form-control t-uc" placeholder="COLONIA...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>MUNICIPIO</label>
                                        <input type="text" name="directorio_municipio" required="" value="<?=$Directorio[0]['directorio_municipio']?>" autocomplete="directorio_municipio" class="form-control t-uc" placeholder="MUNICIPIO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>ESTADO</label>
                                        <input type="text" name="directorio_estado" required="" value="<?=$Directorio[0]['directorio_estado']?>" autocomplete="directorio_estado" class="form-control t-uc" placeholder="ESTADO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>TELEFONO</label>
                                                <input type="text" class="form-control" required="" name="directorio_telefono" value="<?=$Directorio[0]['directorio_telefono']?>" autocomplete="directorio_telefono" placeholder="TELEFONO">
                                            </div>
                                            <div class="col-md-6">
                                                <label>EMAIL</label>
                                                <input type="text" class="form-control" required="" name="directorio_email" value="<?=$Directorio[0]['directorio_email']?>" autocomplete="directorio_email" placeholder="EMAIL">
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
                                        <input type="text" class="form-control t-uc" name="familiar_nombre" autocomplete="familiar_nombre" value="<?=$Familiar[0]['familiar_nombre']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label class="">APELLIDOS</label>
                                        <input type="text" class="form-control t-uc" name="familiar_apellidos" autocomplete="familiar_apellidos" value="<?=$Familiar[0]['familiar_apellidos']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label class="">PARENTESCO</label>
                                        <input type="text" class="form-control t-uc" name="familiar_parentesco" autocomplete="familiar_parentesco" value="<?=$Familiar[0]['familiar_parentesco']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CÓDIGO POSTAL</label>
                                        <input type="text" name="directorio_cp2" autocomplete="directorio_cp2" value="<?=$Directorio2[0]['directorio_cp']?>" class="form-control" placeholder="CÓDIGO POSTAL...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>CALLE Y NÚMERO</label>
                                        <input type="text" name="directorio_calle2" autocomplete="directorio_calle2" value="<?=$Directorio2[0]['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>COLONIA</label>
                                        <input type="text" name="directorio_colonia2" autocomplete="directorio_colonia2" value="<?=$Directorio2[0]['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>MUNICIPIO O DELEGACIÓN</label>
                                        <input type="text" name="directorio_municipio2" autocomplete="directorio_municipio2" value="<?=$Directorio2[0]['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO O DELEGACIÓN...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>ESTADO</label>
                                        <input type="text" name="directorio_estado2" autocomplete="directorio_estado2" value="<?=$Directorio2[0]['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-5">
                                        <label>TELÉFONO</label>
                                        <input type="text" class="form-control" autocomplete="directorio_telefono2" name="directorio_telefono2" value="<?=$Directorio2[0]['directorio_telefono']?>" placeholder="TELÉFONO">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-10">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN REFERENTE AL TRABAJO</h5>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">N° DE EMPLEADO</label>
                                        <?php if($_GET['a']=='add'){?>
                                        <div class="checkbox check-success tip" data-original-title="AUTOASIGNAR N° O MATRICULA DE EMPLEADO" style="position: absolute;right: 0px;top: 0px">
                                            <input id="cbx_autoasignar_matricula"  name="cbx_autoasignar_matricula" type="checkbox" value="SI" >
                                            <label for="cbx_autoasignar_matricula"></label>
                                        </div>
                                        <?php }?>
                                        <input type="text" class="form-control" <?=$_GET['a']=='add'? 'required':'readonly'?> name="empleado_matricula" autocomplete="off" value="<?=$info[0]['empleado_matricula']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">TURNO</label>
                                        <select name="empleado_turno" class="width100" data-value="<?=$info[0]['empleado_turno']?>">
                                            <option value="Matutino">No Aplica</option>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                            <option value="Nocturno">Nocturno</option>
                                            <option value="Jornada Acumulada">Jornada Acumulada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-b-5">
                                        <label class="">CATEGORIA</label>
                                        <input type="text" class="form-control" name="empleado_categoria" autocomplete="off" value="<?=$info[0]['empleado_categoria']?>">
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
                                        <label class="">ESPECIALIDAD</label>
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
                                        <label class="">CÉDULA PROFECIONAL</label>
                                        <input type="text" class="form-control" name="empleado_cedula" autocomplete="off" value="<?=$info[0]['empleado_cedula']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">FECHA DE INGRESO EN LA UM</label>
                                        <input type="text" class="form-control dp-yyyy-mm-dd" name="empleado_ingreso" value="<?=$info[0]['empleado_ingreso']?>" placeholder="INGRESO A LA UNIDAD MÉDICA">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group m-b-5">
                                        <label class="">TIPO DE PLAZA</label>
                                        <select name="empleado_tipoplaza" data-value="<?=$info[0]['empleado_tipoplaza']?>" class="width100">
                                            <option value="SIN ESPECIFICAR">SIN ESPECIFICAR</option>
                                            <option value="CONFIANZA">CONFIANZA</option>
                                            <option value="BASE">BASE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-10">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN REFERENTE AL ACCESO AL SISTEMA</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox check-success 	">
                                        <input id="empleado_pi" type="checkbox" value="SI" name="empleado_pi" data-value="<?=$info[0]['empleado_pi']?>">
                                        <label for="empleado_pi">PERMISOS PARA VER/AGREGAR INFORMACIÓN CONFIDENCIAL</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label class="">SELECCIONAR ROL
                                            <div class="checkbox check-success pull-right">
                                                <input id="cbx_cambiar_roles" name="empleado_cambiarroles" type="checkbox" value="CAMBIAR ROLES">
                                                <label for="cbx_cambiar_roles">CAMBIAR ROLES</label>
                                            </div>
                                        </label>
                                          
                                        <select class="select2 width100" multiple="" name="rol_id[]" id="rol_id" required="" <?=$_GET['a']=='edit'? 'disabled':''?> data-value="<?=$MisRoles?>" style="width: 100%">
                                        <?php foreach ($roles as $value) {?>
                                            <option value="<?=$value['rol_id']?>"><?=$value['rol_nombre']?></option>
                                        <?php }?>
                                        </select> 
                                    </div>   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <input type="hidden" name="empleado_perfil" value="<?=$info[0]['empleado_perfil']?>">
                                    <input type="hidden" name="empleado_action"  value="<?=$_GET['a']?>">
                                    <input type="hidden" name="empleado_id" value="<?=$this->uri->segment(4)?>">
                                    <button  type="submit" class="btn-save btn sigh-background-secundary btn-block" >Guardar</button>
                                    <?php 
                                    $str_categorias='';
                                    foreach ($Categorias as $value) {
                                        if($value['empleado_categoria']!=''){
                                            $str_categorias.=$value['empleado_categoria'].';';
                                        }
                                    }
                                    ?>
 
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
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Usuarios.js?'). md5(microtime())?>" type="text/javascript"></script> 
<script>
$(document).ready(function(evt) {
   var str_categorias='<?= rtrim($str_categorias, ';')?>';
   if(str_categorias!=''){
        var str_categorias_=str_categorias.split(';');
        $('input[name=empleado_categoria]').shieldAutoComplete({
        dataSource: {
            data: str_categorias_
            },minLength: 1
        });
   }
   $('input[name=empleado_categoria]').removeClass('sui-input');
});
    
</script>
