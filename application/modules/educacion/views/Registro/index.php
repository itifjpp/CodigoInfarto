<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<link href="<?= base_url()?>assetsv2/plugins/webcam/wc.css" type="text/css" rel="stylesheet">
<div class="row m-t-5" >
    <div class="col-md-8 col-centered col-start-preregistro">
        <div class="grid simple">
            <div class="grid-body" style="padding: 8px 26px 8px 26px">
                <div class="row">
                    <div class="col-md-1 col-xs-2 no-padding">
                        <img class="img-logo" src="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" style="width: 100px">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-9 col-xs-8">
                        <h2 class="text-center semi-bold m-t-5 h-title" style="font-size: 22px"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></h2>
                        <h3 class="text-center no-margin h-title semi-bold" style="font-size: 19px">Coordinación de Enseñanza e Investigación</h3>
                        <h3 class="no-margin text-center h-title semi-bold" style="font-size: 19px">Pre Registro</h3>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="grid-body">
                <form class="users-agregar-edu">
                    <div class="row">
                        <div class="col-md-12">
                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">REALIZAR REGISTRO COMO</h5>
                            </div>
                            <div class="radio radio-success">
                                <input id="yes" type="radio" name="tipo_registro" value="NuevoRegistro">
                                <label for="yes">OBTENER UN N° DE REGISTRO</label>
                                <input id="no" type="radio" name="tipo_registro" value="ConcluirPreregistro" >
                                <label for="no">CONCLUIR REGISTRO</label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-8 col-xs-8">
                            <div class="row">
                                <div class="col-md-12 m-t-10">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN GENERAL</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group m-b-5">
                                        <label class="">NOMBRE</label>
                                        <input type="text" class="form-control t-uc" name="empleado_nombre" required="" value="<?=$info[0]['empleado_nombre']?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group m-b-5">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <label class="">A. PATERNO</label>
                                                <input type="text" class="form-control t-uc" name="empleado_ap" value="<?=$info[0]['empleado_ap']?>">
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <label class="">A. MATERNO</label>
                                                <input type="text" class="form-control t-uc" name="empleado_am" value="<?=$info[0]['empleado_am']?>">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                        <label class="">FECHA DE NACIMIENTO</label>
                                        <input type="text" class="form-control d-m-y" name="empleado_fn" value="<?=$info[0]['empleado_fn']?>" placeholder="__/__/____">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group m-b-5">
                                        <label class="">CURP</label>
                                        <input type="text" class="form-control t-uc" name="empleado_curp" value="<?=$info[0]['empleado_curp']?>">
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
                                        <input type="text" class="form-control t-uc" required="" name="empleado_lugar_nac" value="<?=$info[0]['empleado_lugar_nac']?>" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group m-b-5">
                                        <label class="">NACIONALIDAD</label>
                                        <input type="text" class="form-control t-uc" required="" name="empleado_nacionalidad" value="<?=$info[0]['empleado_nacionalidad']?>">
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
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group m-t-10" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold">FOTO DE PERFIL</h5>
                            </div>
                            <div class="tools-image">
                                <?php if(!file_exists('assets/img/perfiles/'.$info[0]['empleado_perfil']) || $info[0]['empleado_perfil']==''){?>
                                <img src="<?= base_url()?>assets/img/perfiles/default_.png" class="width100 image-profile" style="margin-top: 10px;padding: 0px 30px 0px 30px">
                                <h5 class="text-center line-height image-profile-info">
                                    <i class="fa fa-times fa-3x" style="color:red"></i> 
                                    <br>AÚN NO SE HA TOMADO LA FOTO DE PERFIL PARA LA CREDENCIAL

                                </h5>
                                <?php }else{?>
                                <img src="<?=base_url()?>assets/img/perfiles/<?=$info[0]['empleado_perfil']?>" class="width100 image-profile m-t-30">

                                <?php }?>
                                
                                <div class="tools-image-controls" style="margin-top: 30px">
                                    <a href="#" title="TOMAR FOTO DE PERFIL" class="link-image-capture" data-url="Preregistro" data-emp="0">
                                        <i class="material-icons">camera_alt</i>
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" name="empleado_perfil" value="<?=$info[0]['empleado_perfil']?>" class="form-control">
                        </div>
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-12">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold " style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN DE CONTACTO</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CÓDIGO POSTAL</label>
                                <input type="text" name="directorio_cp" required="" value="<?=$Directorio['directorio_cp']?>" class="form-control" placeholder="CÓDIGO POSTAL...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CALLE Y NÚMERO</label>
                                <input type="text" name="directorio_calle" required value="<?=$Directorio['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>COLONIA</label>
                                <input type="text" name="directorio_colonia" required value="<?=$Directorio['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MUNICIPIO</label>
                                <input type="text" name="directorio_municipio" required value="<?=$Directorio['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ESTADO</label>
                                <input type="text" name="directorio_estado" required value="<?=$Directorio['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>TELÉFONO</label>
                                        <input type="text" class="form-control t-uc" required name="directorio_telefono" value="<?=$Directorio['directorio_telefono']?>" placeholder="TELÉFONO">
                                    </div>
                                    <div class="col-md-6">
                                        <label>EMAIL</label>
                                        <input type="text" class="form-control" required name="directorio_email" value="<?=$Directorio['directorio_email']?>" placeholder="EMAIL">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-12">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold " style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">TALLA Y TIPO DE ROPA</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">SACO</label>
                                <input type="text" class="form-control" name="ropa_saco" value="<?=$Ropa['ropa_saco']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="">TIPO DE ROPA</label>
                                        <select class="width100" name="ropa_tipo" data-value="<?=$Ropa['ropa_tipo']?>">
                                            <option value="PANTALÓN">PANTALÓN</option>
                                            <option value="FALDA">FALDA</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="">TALLA </label>
                                        <input type="text" name="ropa_talla" value="<?=$Ropa['ropa_talla']?>" class="form-control">
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">CALZADO</label>
                                <input type="text" class="form-control t-uc" name="ropa_calzado" value="<?=$Ropa['ropa_calzado']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-12">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">FAMILIARES MÁS CERCANOS A QUIEN AVISAR EN CASO DE EMERGENCIA</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">NOMBRE</label>
                                <input type="text" class="form-control t-uc" required="" name="familiar_nombre" value="<?=$Familiar['familiar_nombre']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">APELLIDOS</label>
                                <input type="text" class="form-control t-uc" required="" name="familiar_apellidos" value="<?=$Familiar['familiar_apellidos']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">PARENTESCO</label>
                                <input type="text" class="form-control t-uc" required="" name="familiar_parentesco" value="<?=$Familiar['familiar_parentesco']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CÓDIGO POSTAL</label>
                                <input type="text" name="directorio_cp2" value="<?=$Directorio2['directorio_cp']?>" class="form-control" placeholder="CÓDIGO POSTAL...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CALLE Y NÚMERO</label>
                                <input type="text" name="directorio_calle2" value="<?=$Directorio2['directorio_calle']?>" class="form-control t-uc" placeholder="CALLE Y NÚMERO...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>COLONIA</label>
                                <input type="text" name="directorio_colonia2" value="<?=$Directorio2['directorio_colonia']?>" class="form-control t-uc" placeholder="COLONIA...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MUNICIPIO O DELEGACIÓN</label>
                                <input type="text" name="directorio_municipio2" value="<?=$Directorio2['directorio_municipio']?>" class="form-control t-uc" placeholder="MUNICIPIO O DELEGACIÓN...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ESTADO</label>
                                <input type="text" name="directorio_estado2" value="<?=$Directorio2['directorio_estado']?>" class="form-control t-uc" placeholder="ESTADO...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>TELÉFONO</label>
                                <input type="text" class="form-control" required="" name="directorio_telefono2" value="<?=$Directorio2['directorio_telefono']?>" placeholder="TELÉFONO">
                            </div>
                        </div>
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-12">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">INFORMACIÓN REFERENTE A LA UNIDAD ACADÉMICA</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>UNIDAD ACADÉMICA</label>
                                <input type="text" name="eua_universidad" autocomplete="off" class="form-control t-uc" value="<?=$Eua['eua_universidad']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ESPECIALIDAD</label>
                                <input type="text" name="eua_especialidad" autocomplete="off" class="form-control t-uc" value="<?=$Eua['eua_especialidad']?>">
                            </div>
                        </div>

                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>PROMEDIO G. DE LA CARRERA</label>
                                <input type="text" name="eua_promedio" value="<?=$Eua['eua_promedio']?>" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row-medico-interno hide">
                                <label>VIGENCIA</label>
                                <div class="radio radio-success m-t-10">
                                    <input id="eua_vigencia_a" type="radio" name="eua_vigencia" value="A" data-value="<?=$Eua['eua_vigencia']?>"  checked="checked">
                                    <label for="eua_vigencia_a">A</label>
                                    <input id="eua_vigencia_b" type="radio" name="eua_vigencia" value="B" data-value="<?=$Eua['eua_vigencia']?>">
                                    <label for="eua_vigencia_b">B</label>
                                </div>
                            </div>
                            <div class="form-group row-medico-residente hide">
                                <label>FECHA DE INGRESO AL ISSSTE</label>
                                <input type="text" name="empleado_ingreso" value="<?=$info[0]['empleado_ingreso']=='' ? date('Y-m-d'):$info[0]['empleado_ingreso']?>" class="form-control dp-yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-3 row-medico-residente hide">
                            <div class="form-group">
                                <label>ACREDITACIÓN EXAMEN DE INGLES</label>
                                <select class="width100" name="eua_examen_ingles" data-value="<?=$Eua['eua_examen_ingles']?>">
                                    <option value="">SELECCIONAR...</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  row-medico-residente hide">
                            <div class="form-group">
                                <label>CALIFICACIÓN</label>
                                <input type="text" name="eua_examen_ingles_cal" value="<?=$Eua['eua_examen_ingles_cal']?>" class="form-control" placeholder="CALIFICACIÓN">
                            </div>
                        </div>
                    </div>
                    <div class="row row-medico-residente hide row-start ">

                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label>ESPECIALIDAD</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="form-group no-margin">
                                <div class="checkbox check-success m-t-5">
                                    <input id="cbx_r1" class="cbx_especialidad" data-input="especialidad_r1" type="checkbox" value="R1">
                                    <label for="cbx_r1">R1</label>
                                </div>  
                                <input type="text" name="especialidad_r1" value="<?=$EspecialidadR['especialidad_r1']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="form-group no-margin">
                                <div class="checkbox check-success m-t-5">
                                    <input id="cbx_r2" class="cbx_especialidad" data-input="especialidad_r2" type="checkbox" value="R2">
                                    <label for="cbx_r2">R2</label>
                                </div>  
                                <input type="text" name="especialidad_r2" value="<?=$EspecialidadR['especialidad_r2']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="form-group no-margin">
                                <div class="checkbox check-success m-t-5">
                                    <input id="cbx_r3" class="cbx_especialidad" data-input="especialidad_r3" type="checkbox" value="R3">
                                    <label for="cbx_r3">R3</label>
                                </div>  
                                <input type="text" name="especialidad_r3" value="<?=$EspecialidadR['especialidad_r3']?>" readonly="" class="form-control input-sm" placeholder="Calificación">
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
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
                                    <option value="">SELECCIONAR</option>
                                    <option value="R1">R1</option>
                                    <option value="R2">R2</option>
                                    <option value="R3">R3</option>
                                    <option value="R4">R4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row-start hide">
                        <div class="col-md-12 m-t-10">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">DOCUMENTOS QUE DEBE PRESENTAR EN ESE ORDEN (COPIAS FOTOSTATICAS CLARAS Y LEGIBLES)</h5>
                            </div>
                        </div>
                        <div class="col-md-12" style="position: relative">
                            <button type="button" class="md-btn md-fab m-b red btn-open-add-doc" style="position: absolute;right: 0px;top: -50px">
                                <i class="material-icons i-24 color-white">library_add</i>
                            </button>
                            <table class="table table-bordered table-no-padding table-doc-usuario footable" data-page-size="10">
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
                    <div class="row row-start hide">
                        <div class="col-md-3 col-md-offset-6">
                            <button type="button" class="btn btn-danger btn-block" onclick="location.href=base_url+'Registro'">CANCELAR</button>
                        </div>
                        <div class="col-md-3">
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
                            <input type="hidden" name="empleado_id" value="<?= !isset($_GET['emp']) ? rand(): $info[0]['empleado_id']?>">
                            <input type="hidden" name="empleado_action" value="<?= isset($_GET['action']) ? $_GET['action']: 'add'?>">
                            <input type="hidden" name="rol_id" value="<?=$MiRol['rol_id']?>">
                            <button type="submit" class="btn-save btn sigh-background-secundary btn-block" >Guardar</button>
                        </div>
                    </div>
                </form>    
            </div>
        </div>
    </div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url()?>assets/js/EducacionRegistro.js?<?= md5(microtime())?>" type="text/javascript"></script> 
<script>
$(document).ready(function() {
    $('input[name=empleado_fn]').mask('99/99/9999');
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