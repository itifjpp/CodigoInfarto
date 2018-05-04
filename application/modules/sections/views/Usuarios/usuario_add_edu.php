<?= modules::run('Sections/Menu/loadHeader'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Usuarios">Usuarios</a></li>
            <li><a href="#">Agregar/Editar Usuario</a></li>
        </ol> 
        <div class="row m-t-10" >
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">AGREGAR USUARIO</h4>
                    </div>
                    <div class="grid-body">
                        <form class="users-agregar-edu">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN GENERAL</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">NOMBRE</label>
                                                <input type="text" class="form-control t-uc" name="empleado_nombre" required="" value="<?=$info[0]['empleado_nombre']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">A. PATERNO</label>
                                                        <input type="text" class="form-control t-uc" name="empleado_ap" value="<?=$info[0]['empleado_ap']?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">A. MATERNO</label>
                                                        <input type="text" class="form-control t-uc" name="empleado_am" value="<?=$info[0]['empleado_am']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">SEXO</label>
                                                <select name="empleado_sexo"  class="width100 " data-value="<?=$info[0]['empleado_sexo']?>">
                                                    <option value="M">HOMBRE</option>
                                                    <option value="F">MUJER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">FECHA DE NACIMIENTO</label>
                                                <input type="text" class="form-control d-m-y" name="empleado_fn" value="<?=$info[0]['empleado_fn']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">CURP</label>
                                                <input type="text" class="form-control t-uc" name="empleado_curp" value="<?=$info[0]['empleado_curp']?>">
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
                                                <input type="text" class="form-control t-uc" name="empleado_lugar_nac" value="<?=$info[0]['empleado_lugar_nac']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-5">
                                                <label class="">NACIONALIDAD</label>
                                                <input type="text" class="form-control t-uc" name="empleado_nacionalidad" value="<?=$info[0]['empleado_nacionalidad']?>">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label>RFC</label>
                                                <input type="text" name="empleado_rfc" autocomplete="empleado_rfc" value="<?=$info[0]['empleado_rfc']?>" placeholder="RFC" class="form-control t-uc">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label>N° DE SEGURO</label>
                                                <input type="text" name="empleado_nss"  autocomplete="empleado_nss" value="<?=$info[0]['empleado_nss']?>" placeholder="N° DE SEGURO" class="form-control t-uc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold">FOTO DE PERFIL</h5>
                                    </div>
                                    <?php if(file_exists('assets/img/perfiles/'.$info[0]['empleado_perfil']) && $info[0]['empleado_perfil']!='default_.png'){ ?>
                                    <button type="button" class="md-btn md-fab m-b red " onclick="AbrirVista(base_url+'Sections/Usuarios/RecortarImagenCredencial?user=<?=$info[0]['empleado_id']?>')" style="position: absolute;right: 0px;top: -10px">
                                        <i class="material-icons i-24 color-white">crop</i>
                                    </button>
                                    <?php }?>
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
                                            <a href="#" title="TOMAR FOTO DE PERFIL" class="link-image-capture" data-url="Enseñanza" data-emp="<?=$info[0]['empleado_id']?>">
                                                <i class="material-icons">camera_alt</i>
                                            </a>

                                        </div>
                                    </div>
                                    <input type="hidden" name="uploadImageTmp" id="filename"  class="form-control">
                                    <input type="hidden" name="empleado_perfil" value="<?=$info[0]['empleado_perfil']?>" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN DE INGRESO</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label class="">SELECCIONAR ROL</label>
                                        <input type="hidden" name="empleado_rol" value="<?=$info[0]['empleado_roles']?>">
                                        <select class="select2 width100" name="rol_id_edu" data-value="<?=$info[0]['empleado_roles']?>">
                                            <option value="82">Médico Residente</option>
                                            <option value="85">Médico Interno</option>
                                        </select> 
                                    </div>   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">N° O MATRICULA DE EMPLEADO:</label>
                                        <input type="text" class="form-control" name="empleado_matricula" required="" value="<?=$info[0]['empleado_matricula']=='' ? $info[0]['empleado_id']:$info[0]['empleado_matricula']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">FECHA DE INGRESO A LA UNIDAD</label>
                                        <input type="text" name="empleado_ingreso" value="<?=$info[0]['empleado_ingreso']?>" class="form-control dp-yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold " style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN DE CONTACTO</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CÓDIGO POSTAL</label>
                                        <input type="text" name="directorio_cp" value="<?=$Directorio[0]['directorio_cp']?>" class="form-control" placeholder="CÓDIGO POSTAL...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CALLE Y NÚMERO</label>
                                        <input type="text" name="directorio_calle" value="<?=$Directorio[0]['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>COLONIA</label>
                                        <input type="text" name="directorio_colonia" value="<?=$Directorio[0]['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MUNICIPIO</label>
                                        <input type="text" name="directorio_municipio" value="<?=$Directorio[0]['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ESTADO</label>
                                        <input type="text" name="directorio_estado" value="<?=$Directorio[0]['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>TELÉFONO</label>
                                                <input type="text" class="form-control" name="directorio_telefono" value="<?=$Directorio[0]['directorio_telefono']?>" placeholder="TELÉFONO">
                                            </div>
                                            <div class="col-md-6">
                                                <label>EMAIL</label>
                                                <input type="text" class="form-control" name="directorio_email" value="<?=$Directorio[0]['directorio_email']?>" placeholder="EMAIL">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php if(empty($Directorio)){?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <h5 class="no-margin">NO HAY INFORMACIÓN CONTACTO ASOCIADO A ESTE USUARIO
                                            <a href="#" class="btn btn-danger btn-mini link-asociar-registro-user" data-id="<?=$info[0]['empleado_id']?>" data-tipo="Contacto Usuario">ASOCIAR REGISTRO</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold " style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">TALLA Y TIPO DE ROPA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">SACO</label>
                                        <input type="text" class="form-control" name="ropa_saco" value="<?=$Ropa[0]['ropa_saco']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label class="">TIPO DE ROPA</label>
                                                <select class="width100" name="ropa_tipo" data-value="<?=$Ropa[0]['ropa_tipo']?>">
                                                    <option value="PANTALÓN">PANTALÓN</option>
                                                    <option value="FALDA">FALDA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label class="">TALLA</label>
                                                <input type="text" name="ropa_talla" value="<?=$Ropa[0]['ropa_talla']?>" class="form-control">
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">CALZADO</label>
                                        <input type="text" class="form-control" name="ropa_calzado" value="<?=$Ropa[0]['ropa_calzado']?>">
                                    </div>
                                </div>
                                <?php if(empty($Ropa)){?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <h5 class="no-margin">NO HAY INFORMACIÓN ASOCIADO A ESTE USUARIO
                                            <a href="#" class="btn btn-danger btn-mini link-asociar-registro-user" data-id="<?=$info[0]['empleado_id']?>" data-tipo="Ropa">ASOCIAR REGISTRO</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">FAMILIARES MÁS CERCANOS A QUIEN AVISAR EN CASO DE EMERGENCIA</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">NOMBRE</label>
                                        <input type="text" class="form-control t-uc" name="familiar_nombre" value="<?=$Familiar[0]['familiar_nombre']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">APELLIDOS</label>
                                        <input type="text" class="form-control t-uc" name="familiar_apellidos" value="<?=$Familiar[0]['familiar_apellidos']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">PARENTESCO</label>
                                        <input type="text" class="form-control t-uc" name="familiar_parentesco" value="<?=$Familiar[0]['familiar_parentesco']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CÓDIGO POSTAL</label>
                                        <input type="text" name="directorio_cp2" value="<?=$Directorio2[0]['directorio_cp']?>" class="form-control" placeholder="CÓDIGO POSTAL...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CALLE Y NÚMERO</label>
                                        <input type="text" name="directorio_calle2" value="<?=$Directorio2[0]['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>COLONIA</label>
                                        <input type="text" name="directorio_colonia2" value="<?=$Directorio2[0]['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MUNICIPIO O DELEGCIÓN</label>
                                        <input type="text" name="directorio_municipio2" value="<?=$Directorio2[0]['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ESTADO</label>
                                        <input type="text" name="directorio_estado2" value="<?=$Directorio2[0]['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>TELÉFONO</label>
                                        <input type="text" class="form-control" name="directorio_telefono2" value="<?=$Directorio2[0]['directorio_telefono']?>" placeholder="TELÉFONO">
                                    </div>
                                </div>
                                <?php if(empty($Familiar)){?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <h5 class="no-margin">NO HAY INFORMACIÓN ASOCIADO A ESTE USUARIO
                                            <a href="#" class="btn btn-danger btn-mini link-asociar-registro-user" data-id="<?=$info[0]['empleado_id']?>" data-tipo="Familiar">ASOCIAR REGISTRO</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(empty($Directorio2)){?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <h5 class="no-margin">NO HAY INFORMACIÓN ASOCIADO A ESTE USUARIO
                                            <a href="#" class="btn btn-danger btn-mini link-asociar-registro-user" data-id="<?=$info[0]['empleado_id']?>" data-tipo="Contacto Familiar">ASOCIAR REGISTRO</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN REFERENTE A LA UNIDAD ACADÉMICA</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>UNIDAD ACADÉMICA</label>
                                        <input type="text" name="eua_universidad" class="form-control t-uc" value="<?=$Eua[0]['eua_universidad']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ESPECIALIDAD</label>
                                        <input type="text" name="eua_especialidad" class="form-control t-uc" value="<?=$Eua[0]['eua_especialidad']?>">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PROMEDIO G. DE LA CARRERA</label>
                                        <input type="text" name="eua_promedio" value="<?=$Eua[0]['eua_promedio']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>VIGENCIA</label>
                                        <input type="text" name="eua_vigencia" value="<?=$Eua[0]['eua_vigencia']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 row-medico-residente hide">
                                    <div class="form-group">
                                        <label>ACREDITACIÓN EXAMEN DE INGLES</label>
                                        <select class="width100" name="eua_examen_ingles" data-value="<?=$Eua[0]['eua_examen_ingles']?>">
                                            <option value="">SELECCIONAR...</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2  row-medico-residente hide">
                                    <div class="form-group">
                                        <label>CALIFICACIÓN</label>
                                        <input type="text" name="eua_examen_ingles_cal" value="<?=$Eua[0]['eua_examen_ingles_cal']?>" class="form-control" placeholder="CALIFICACIÓN">
                                    </div>
                                </div>
                                <?php if(empty($Eua)){?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <h5 class="no-margin">NO HAY INFORMACIÓN ASOCIADO A ESTE USUARIO
                                            <a href="#" class="btn btn-danger btn-mini link-asociar-registro-user" data-id="<?=$info[0]['empleado_id']?>" data-tipo="Información Académica">ASOCIAR REGISTRO</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row row-medico-residente hide">
                                
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label>ESPECIALIDAD</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group no-margin">
                                        <div class="checkbox check-success m-t-5">
                                            <input id="cbx_r1" class="cbx_especialidad" data-input="especialidad_r1" type="checkbox" value="R1">
                                            <label for="cbx_r1">R1</label>
                                        </div>  
                                        <input type="text" name="especialidad_r1" value="<?=$EspecialidadR['especialidad_r1']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group no-margin">
                                        <div class="checkbox check-success m-t-5">
                                            <input id="cbx_r2" class="cbx_especialidad" data-input="especialidad_r2" type="checkbox" value="R2">
                                            <label for="cbx_r2">R2</label>
                                        </div>  
                                        <input type="text" name="especialidad_r2" value="<?=$EspecialidadR['especialidad_r2']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group no-margin">
                                        <div class="checkbox check-success m-t-5">
                                            <input id="cbx_r3" class="cbx_especialidad" data-input="especialidad_r3" type="checkbox" value="R3">
                                            <label for="cbx_r3">R3</label>
                                        </div>  
                                        <input type="text" name="especialidad_r3" value="<?=$EspecialidadR['especialidad_r3']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group no-margin">
                                        <div class="checkbox check-success m-t-5">
                                            <input id="cbx_r4" class="cbx_especialidad" data-input="especialidad_r4" type="checkbox" value="R4">
                                            <label for="cbx_r4">R4</label>
                                        </div>  
                                        <input type="text" name="especialidad_r4" value="<?=$EspecialidadR['especialidad_r4']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group no-margin">
                                        <label>NIVEL DE RESIDENCIA ACTUAL</label>
                                        <select class="width100" name="empleado_categoria" data-value="<?=$info[0]['empleado_categoria']?>">
                                            <option value="">SELECCIONAR...</option>
                                            <option value="R1">R1</option>
                                            <option value="R2">R2</option>
                                            <option value="R3">R3</option>
                                            <option value="R4">R4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php if($InfoDigital['digital_date']==''){?>
                                <div class="col-md-12 m-t-20">
                                    <div class="alert alert-error">
                                        <h5 class="no-margin line-height text-center bold" style="color: #F44336">ESTE USUARIO NO TIENE CAPTURADO SUS DATOS BIOMETRICOS PARA LA IMPRESIÓN DE CREDENCIAL.</h5>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-10">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">DOCUMENTOS QUE DEBE PRESENTAR EN ESE ORDEN (COPIAS FOTOSTATICAS CLARAS Y LEGIBLES)</h5>
                                    </div>
                                </div>
                                <div class="col-md-12" style="position: relative">
                                    <button type="button" class="md-btn md-fab m-b red btn-open-add-doc" style="position: absolute;right: 0px;top: -50px">
                                        <i class="material-icons i-24 color-white">library_add</i>
                                    </button>
                                    <table class="table footable table-bordered table-no-padding table-doc-usuario " data-page-size="6">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%">N°</th>
                                                <th style="width: 40%">DOCUMENTO</th>
                                                <th style="width: 40%">ANEXOS</th>
                                                <th style="width: 10%">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr class="no-padding">
                                                <td colspan="4" class="text-center ">
                                                    <ul class="pagination"></ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group row-medico-interno">
                                        <label>TENIENDO COMO LIMITE EL DÍA</label>
                                        <input type="text" name="eua_limite_doc" value="<?=$Eua['eua_limite_doc']?>" placeholder="TENIENDO COMO LIMITE EL DÍA..." class="form-control dp-yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-offset-4 col-md-4 ">
                                    <?php 
                                    $Universidadess='';
                                    $Especialidades='';
                                    foreach ($UniversidadesGet as $value_ua) {
                                        if($value_ua['eua_universidad']!=''){
                                            $Universidadess.=$value_ua['eua_universidad'].';';
                                        }
                                    }
                                    foreach ($EspecialidadesGet as $value_esp) {
                                        if($value_esp['eua_especialidad']!=''){
                                            $Especialidades.=$value_esp['eua_especialidad'].';';
                                        }
                                    }
                                    ?>
                                    <input type="hidden" name="eua_universidad_get" value="<?=$Universidadess?>">
                                    <input type="hidden" name="eua_especialidad_get" value="<?=$Especialidades?>">
                                    <input type="hidden" name="empleado_action"  value="<?=$_GET['a']?>">
                                    <input type="hidden" name="empleado_alumno" value="Alumno">
                                    <input type="hidden"name="empleado_id" value="<?=$this->uri->segment(4)?>">
                                    <input type="hidden" name="empleado_status" value="<?=$info[0]['empleado_status']?>">
                                    <input type="hidden" name="empleado_registro" value="<?=$info[0]['empleado_registro']?>">
                                    <button  type="submit" class="btn-save btn sigh-background-secundary btn-block m-t-15" ><?=$info[0]['empleado_registro']=='Pre-registro'? 'VALIDAR INFORMACIÓN':'GUARDAR INFORMACIÓN'?></button>
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
<script src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>" type="text/javascript"></script> 
<script>
$(document).ready(function(evt) {
     if($('input[name=eua_universidad_get]').val()!=''){
        var eua_universidad_get=$('input[name=eua_universidad_get]').val().split(';');
        $('input[name=eua_universidad]').shieldAutoComplete({
        dataSource: {
            data: eua_universidad_get
        },minLength: 1
        });
    }
    if($('input[name=eua_especialidad_get]').val()!=''){
        var eua_especialidad_get=$('input[name=eua_especialidad_get]').val().split(';');
        $('input[name=eua_especialidad]').shieldAutoComplete({
        dataSource: {
            data: eua_especialidad_get
        },minLength: 1
        });
    }
    $('input[name=eua_universidad]').removeClass('sui-input');
    $('input[name=eua_especialidad').removeClass('sui-input');
})
</script>
