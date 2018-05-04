<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Usuarios extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        if($this->UMAE_AREA=='Enseñanza'){
            $this->load->view('Usuarios/index_edu');
        }else{
            $this->load->view('Usuarios/index_admin');
        }
        
    }
    public function Usuario($usuario) {
        $sql['info']=   $this->config_mdl->sqlGetDataCondition('sigh_empleados',array('empleado_id'=>$usuario));
        $sql['roles']=  $this->config_mdl->sqlGetData('sigh_roles');
        $sql['Especialidades']=  $this->config_mdl->sqlGetData('sigh_especialidades');
        $sql['Ua']= $this->config_mdl->sqlGetData('sigh_ua');
        $sql['Directorio']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$usuario,
            'directorio_tipo'=>'Empleado'
        ));
        $sql['Directorio2']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$usuario,
            'directorio_tipo'=>'Familiar'
        ));
        $sql['Ropa']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
            'empleado_id'=>$usuario,
        ));
        $sql['Familiar']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=>$usuario,
        ));
        $sql['Eua']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
            'empleado_id'=>$usuario,
        ));
        $sql['EspecialidadR']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_especialidad',array(
            'empleado_id'=>$usuario,
        ))[0];
        $MisRoles='';
        $RolesAsig= $this->config_mdl->sqlGetDataCondition('sigh_empleados_roles',array(
            'empleado_id'=>$usuario
        ),'rol_id');
        foreach ($RolesAsig as $value) {
            $MisRoles.=$value['rol_id'].',';
        }
        $sql['Categorias']= $this->config_mdl->sqlQuery("SELECT emp.empleado_categoria FROM sigh_empleados AS emp GROUP BY emp.empleado_categoria");
        $sql['MisRoles']= rtrim($MisRoles,',');
        $sql['InfoDigital']= $this->config_mdl->sqlQuery("SELECT digital_date FROM sigh_empleados_digital AS dg WHERE dg.empleado_id=".$usuario)[0];
        if($this->UMAE_AREA=='Administrador'){
            $this->load->view('Usuarios/usuario_add',$sql);
        }else{
            $sql['UniversidadesGet']= $this->config_mdl->sqlQuery("SELECT ua.eua_universidad FROM sigh_empleados_ua AS ua WHERE ua.eua_universidad!='' GROUP BY ua.eua_universidad");
            $sql['EspecialidadesGet']= $this->config_mdl->sqlQuery("SELECT ua.eua_especialidad FROM sigh_empleados_ua AS ua WHERE ua.eua_especialidad!='' GROUP BY ua.eua_especialidad");
            $this->load->view('Usuarios/usuario_add_edu',$sql);
        }
        
    }
    public function VerificarMatricula() {
        $sql=  $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=>  $this->input->post('empleado_matricula')
        ));
        if(empty($sql)){
            $this->setOutput(array('ACCION'=>'NO_EXISTE'));
        }else{
            $this->setOutput(array('ACCION'=>'EXISTE'));
        }
    }
    public function TomarFoto() {
        $this->load->view('Usuarios/usuario_perfil_capture');
    }
    public function SubirFoto() {
        $this->load->view('Usuarios/usuario_perfil_upload');
    }
    public function AjaxGuardarUsuario() {
        
        foreach ($this->input->post('rol_id') as $rol_select) {
            $roles.=$rol_select.',';
        }
        $data=array(
            'empleado_matricula'=>$this->input->post('empleado_matricula'),
            'empleado_nombre'=>$this->input->post('empleado_nombre'),
            'empleado_ap'=>$this->input->post('empleado_ap'),
            'empleado_am'=>$this->input->post('empleado_am'),
            'empleado_fn'=>$this->input->post('empleado_fn'),
            'empleado_sexo'=>$this->input->post('empleado_sexo'),
            'empleado_curp'=>$this->input->post('empleado_curp'),
            'empleado_rfc'=> $this->input->post('empleado_rfc'),
            'empleado_nss'=> $this->input->post('empleado_nss'),
            'empleado_estadocivil'=>$this->input->post('empleado_estadocivil'),
            'empleado_lugar_nac'=>$this->input->post('empleado_lugar_nac'),
            'empleado_nacionalidad'=>$this->input->post('empleado_nacionalidad'),
            'empleado_turno'=>$this->input->post('empleado_turno'),
            'empleado_categoria'=>$this->input->post('empleado_categoria'),
            'empleado_departamento'=>$this->input->post('empleado_departamento'),
            'empleado_especialidad'=>$this->input->post('empleado_especialidad'),
            'empleado_servicio'=>$this->input->post('empleado_servicio'),
            'empleado_cedula'=> $this->input->post('empleado_cedula'),
            'empleado_registro'=> date('Y-m-d H:i'),
            'empleado_ingreso'=> $this->input->post('empleado_ingreso'),
            'empleado_tipoplaza'=> $this->input->post('empleado_tipoplaza'),
            'empleado_perfil'=> 'default.png',
            'empleado_pi'=> $this->input->post('empleado_pi'),
            'empleado_roles'=>  trim($roles, ','),
            'empleado_sc'=>'No',
           
        );
        if($this->input->post('empleado_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_empleados',$data);
            $sql_max=  $this->config_mdl->sqlGetLastId('sigh_empleados','empleado_id');
            if($this->input->post('cbx_autoasignar_matricula')=='SI'){
                $sqlPerson=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$sql_max
                ),'empleado_id')[0];
                $this->config_mdl->sqlUpdate('sigh_empleados',array(
                    'empleado_matricula'=> $sqlPerson['empleado_id']
                ),array(
                    'empleado_id'=>$sql_max
                ));    
            }
            
            foreach ($this->input->post('rol_id') as $rol_select) {
                $this->config_mdl->sqlInsert('sigh_empleados_roles',array(
                    'empleado_id'=>$sql_max,
                    'rol_id'=>$rol_select
                ));
            }
        }else{
            unset($data['empleado_matricula']);
            unset($data['empleado_sc']);
            unset($data['empleado_perfil']);
            unset($data['empleado_registro']);
            $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
                'empleado_id'=>$this->input->post('empleado_id')
            ));
            if($this->input->post('empleado_cambiarroles')=='CAMBIAR ROLES'){
                $this->config_mdl->sqlDelete('sigh_empleados_roles',array(
                    'empleado_id'=>$this->input->post('empleado_id')
                ));
                foreach ($this->input->post('rol_id') as $rol_select) {
                    $this->config_mdl->sqlInsert('sigh_empleados_roles',array(
                        'empleado_id'=>$this->input->post('empleado_id'),
                        'rol_id'=>$rol_select
                    ));
                }           
            }

            $sql_max= $this->input->post('empleado_id');
        }
        $dirEmpleado=array(
            'directorio_tipo'=>'Empleado',
            'directorio_calle'=> $this->input->post('directorio_calle'),
            'directorio_colonia'=> $this->input->post('directorio_colonia'),
            'directorio_municipio'=> $this->input->post('directorio_municipio'),
            'directorio_estado'=> $this->input->post('directorio_estado'),
            'directorio_cp'=> $this->input->post('directorio_cp'),
            'directorio_telefono'=> $this->input->post('directorio_telefono'),
            'directorio_email'=> $this->input->post('directorio_email'),
            'empleado_id'=> $sql_max,
        );
        $dirFamiliar=array(
            'directorio_tipo'=>'Familiar',
            'directorio_calle'=> $this->input->post('directorio_calle2'),
            'directorio_colonia'=> $this->input->post('directorio_colonia2'),
            'directorio_municipio'=> $this->input->post('directorio_municipio2'),
            'directorio_estado'=> $this->input->post('directorio_estado2'),
            'directorio_cp'=> $this->input->post('directorio_cp2'),
            'directorio_telefono'=> $this->input->post('directorio_telefono2'),
            'empleado_id'=> $sql_max,
        );
        $dataFamiliar=array(
            'familiar_nombre'=> $this->input->post('familiar_nombre'),
            'familiar_apellidos'=> $this->input->post('familiar_apellidos'),
            'familiar_parentesco'=> $this->input->post('familiar_parentesco'),
            'empleado_id'=>$sql_max
        );
        $sqlDirEmp= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=> $sql_max,
            'directorio_tipo'=>'Empleado'
        ));
        $sqlDirFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=> $sql_max,
            'directorio_tipo'=>'Familiar'
        ));
        $sqlFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=> $sql_max,
        ));
        if(empty($sqlDirEmp)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',$dirEmpleado);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_directorio',$dirEmpleado,array(
                'directorio_tipo'=>'Empleado',
                'empleado_id'=>$sql_max
            ));
        }
        if(empty($sqlDirFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',$dirFamiliar);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_directorio',$dirFamiliar,array(
                'directorio_tipo'=>'Familiar',
                'empleado_id'=>$sql_max
            ));
        }
        if(empty($sqlFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_familiar',$dataFamiliar);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_familiar',$dataFamiliar,array(
                'empleado_id'=>$sql_max
            ));
        }
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados_digital',array(
            'empleado_id'=>$sql_max
        ));
        if(empty($sqlCheck)){
            $this->config_mdl->sqlInsert('sigh_empleados_digital',array(
                'empleado_id'=>$sql_max,
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function FotoDePerfil() {
        $this->load->view('Usuarios/usuario_fotodeperfil');
    }
    public function AjaxGuardarUsuarioEdu() {
        
        $data=array(
            'empleado_matricula'=>       $this->input->post('empleado_matricula'),
            'empleado_nombre'=>          $this->input->post('empleado_nombre'),
            'empleado_ap'=>       $this->input->post('empleado_ap'),
            'empleado_am'=>       $this->input->post('empleado_am'),
            'empleado_fn'=>       $this->input->post('empleado_fn'),
            'empleado_sexo'=>            $this->input->post('empleado_sexo'),
            'empleado_estadocivil'=>       $this->input->post('empleado_estadocivil'),
            'empleado_departamento'=>    $this->input->post('empleado_departamento'),
            'empleado_curp'=>        $this->input->post('empleado_curp'),
            'empleado_cedula'=>          $this->input->post('empleado_cedula'),
            'empleado_turno'=>           $this->input->post('empleado_turno'),
            'empleado_roles'=> $this->input->post('rol_id_edu'),
            'empleado_nacionalidad'=> $this->input->post('empleado_nacionalidad'),
            'empleado_lugar_nac'=> $this->input->post('empleado_lugar_nac'),
            'empleado_tmp'=> $this->input->post('empleado_id'),
            'empleado_status'=>'Validado',
            'empleado_sc'=>'No',
            'empleado_ingreso'=> $this->input->post('empleado_ingreso'),
            'empleado_categoria'=> $this->input->post('empleado_categoria'),
           
        );
        $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $dirEmpleado=array(
            'directorio_tipo'=>'Empleado',
            'directorio_calle'=> $this->input->post('directorio_calle'),
            'directorio_colonia'=> $this->input->post('directorio_colonia'),
            'directorio_municipio'=> $this->input->post('directorio_municipio'),
            'directorio_estado'=> $this->input->post('directorio_estado'),
            'directorio_cp'=> $this->input->post('directorio_cp'),
            'directorio_telefono'=> $this->input->post('directorio_telefono'),
            'directorio_email'=> $this->input->post('directorio_email'),
            'empleado_id'=> $this->input->post('empleado_id'),
        );
        $dirFamiliar=array(
            'directorio_tipo'=>'Familiar',
            'directorio_calle'=> $this->input->post('directorio_calle2'),
            'directorio_colonia'=> $this->input->post('directorio_colonia2'),
            'directorio_municipio'=> $this->input->post('directorio_municipio2'),
            'directorio_estado'=> $this->input->post('directorio_estado2'),
            'directorio_cp'=> $this->input->post('directorio_cp2'),
            'directorio_telefono'=> $this->input->post('directorio_telefono2'),
            'empleado_id'=> $this->input->post('empleado_id'),
        );
        $dataFamiliar=array(
            'familiar_nombre'=> $this->input->post('familiar_nombre'),
            'familiar_apellidos'=> $this->input->post('familiar_apellidos'),
            'familiar_parentesco'=> $this->input->post('familiar_parentesco'),
            'empleado_id'=>$this->input->post('empleado_id')
        );
        $dataRopa=array(
            'ropa_saco'=> $this->input->post('ropa_saco'),
            'ropa_tipo'=> $this->input->post('ropa_tipo'),
            'ropa_calzado'=> $this->input->post('ropa_calzado'),
            'empleado_id'=> $this->input->post('empleado_id')
        );
        $dataEspecialidad=array(
            'especialidad_r1'=> $this->input->post('especialidad_r1'),
            'especialidad_r2'=> $this->input->post('especialidad_r2'),
            'especialidad_r3'=> $this->input->post('especialidad_r3'),
            'especialidad_r4'=> $this->input->post('especialidad_r4'),
            'especialidad_r5'=> $this->input->post('especialidad_r5'),
            'empleado_id'=> $this->input->post('empleado_id')
        );
        $this->config_mdl->sqlUpdate('sigh_empleados_especialidad',$dataEspecialidad,array(
            'empleado_id'=>$this->input->post('empleado_id')
        ));
        $dataUa=array(
            'eua_universidad'=> $this->input->post('eua_universidad'),
            'eua_especialidad'=> $this->input->post('eua_especialidad'),
            'eua_promedio'=> $this->input->post('eua_promedio'),
            'eua_vigencia'=> $this->input->post('eua_vigencia'),
            'eua_examen_ingles'=> $this->input->post('eua_examen_ingles'),
            'eua_examen_ingles_cal'=> $this->input->post('eua_examen_ingles_cal'),
            'eua_limite_doc'=> $this->input->post('eua_limite_doc'),
            'empleado_id'=> $this->input->post('empleado_id')
        );
        //**//
        $this->config_mdl->sqlUpdate('sigh_empleados_directorio',$dirEmpleado,array(
            'directorio_tipo'=>'Empleado',
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados_directorio',$dirFamiliar,array(
            'directorio_tipo'=>'Familiar',
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados_familiar',$dataFamiliar,array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados_ropa',$dataRopa,array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados_ua',$dataUa,array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados_roles',array(
            'rol_id'=> $this->input->post('rol_id_edu')
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
       $this->setOutput(array('accion'=>'1'));

    }
    public function RecortarImagenCredencial() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$_GET['user']
        ))[0];
        $this->load->view('Usuarios/usuario_perfil_crop',$sql);
    }
    public function AjaxRecortarImagenCredencial() {
        $empleado_perfil= 'IMAGE_CREDENCIAL_'.$this->input->post('empleado_id').'.png';
        $img = str_replace('data:image/png;base64,', '', $this->input->post('empleado_image_credencial'));
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents('assets/img/perfiles/'.$empleado_perfil, $data);
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_image_credencial'=>$empleado_perfil
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->setOutput(array('action'=>'1','image'=>'assets/img/perfiles/'.$empleado_perfil)) ;
    }
    public function AgregarDocumentos() {
        $sql['Docs']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
            'empleado_id'=>$_GET['tmp']
        ));
        $this->load->view('Registro/usuario_documentos',$sql);
    }
    public function AjaxAgregarDocumentos() {
        $data=array(
            'documento_tipo'=> $this->input->post('documento_tipo'),
            'empleado_id'=> $this->input->post('empleado_tmp')
        );
        if($this->input->post('documento_action')==''){
            $this->config_mdl->sqlInsert('sigh_empleados_documentos',$data);
            $DocumentoID= $this->config_mdl->sqlGetLastId('sigh_empleados_documentos','documento_id');
        }else{
            $DocumentoID= $this->input->post('documento_id');
        }
        for ($index = 0; $index < count($_FILES['documentos_anexos']['name']); $index++) {
            $anexo_tmp=$_FILES['documentos_anexos']['tmp_name'][$index];
            $anexo_tipo= end(explode('.', $_FILES['documentos_anexos']['name'][$index]));
            $anexo_nombre=date('YmdHis').'_'.$this->input->post('empleado_tmp').'_'.rand().'.'.$anexo_tipo;
            copy($anexo_tmp, 'assets/usuarios_anexos/'.$anexo_nombre);
            $this->config_mdl->sqlInsert('sigh_empelados_documentos_anexo',array(
                'anexo_tipo'=>$anexo_tipo,
                'anexo_nombre'=>$anexo_nombre,
                'documento_id'=>$DocumentoID
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxObtenerUsuarioEducacion() {
        if($this->input->get_post('FILTRO_TIPO')==''){
            $sql= $this->config_mdl->sqlQuery("SELECT emp.* ,roles.rol_id FROM sigh_empleados AS emp, sigh_empleados_roles AS roles WHERE emp.empleado_nombre!='' AND emp.empleado_id=roles.empleado_id AND roles.rol_id IN (82,85) AND emp.empleado_registrotipo='Preregistro' GROUP BY emp.empleado_id");
        }else{
            $sql= $this->config_mdl->sqlQuery("SELECT emp.* ,roles.rol_id FROM sigh_empleados AS emp, sigh_empleados_roles AS roles
                    WHERE emp.empleado_nombre!='' AND emp.".$this->input->get_post('FILTRO_TIPO')." LIKE '%".$this->input->get_post('FILTRO_VALUE')."%' AND emp.empleado_id=roles.empleado_id AND roles.rol_id IN (82,85) AND emp.empleado_registrotipo='Preregistro' GROUP BY emp.empleado_id");

        }
        if(!empty($sql)){
            $tr='';
            foreach ($sql as $value) {
                $sqlUa= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
                    'empleado_id'=>$value['empleado_id']
                ),'eua_especialidad')[0];
                $label_status='';
                $sqlDigital= $this->config_mdl->sqlQuery("SELECT digital_date FROM sigh_empleados_digital AS emp WHERE emp.empleado_id=".$value['empleado_id']);
                $label_icon='';
                $estado_informacion=0;
                if($value['empleado_status']=='Pre-registro' ){
                    $estado_informacion++;
                    $label_status.='<h6 class="color-white text-left m-t-5 m-b-10 line-height">* Información sin validar</h6>';
                    $label_icon='<i class="fa fa-check sigh-color i-20 tip" data-original-title="Validar Información"></i> Validar Información';
                    $label_folder='<a href="#"><i class="fa fa-folder-open-o sigh-color i-20 tip no-action" data-original-title=""></i> Carpeta de Documentos</a>';
                }else{
                    $label_icon='<i class="fa fa-pencil sigh-color i-20 tip" data-original-title="Editar"></i> Editar Información';
                    $label_folder='<a href="'. base_url().'Sections/Usuarios/CarpetadeDocumentos?emp='.$value['empleado_id'].'"><i class="fa fa-folder-open-o sigh-color i-20 pointer tip" data-id="'.$value['empleado_id'].'"></i> Carpeta de Documentos</a> ';
                }
                
                if($value['empleado_perfil']=='' || $value['empleado_perfil']=='default_.png'){
                    $label_status.='<h6 class="color-white text-left m-t-5 m-b-10 line-height">* Foto de perfil no capturado (Necesario para la impresión de la credencial)</h6>';
                    $estado_informacion++;
                }
                if(empty($sqlDigital)){
                    $estado_informacion++;
                    $label_status.='<h6 class="color-white text-left m-t-5 m-b-10 line-height">* Datos biometricos no capturados (Necesario para la impresión de la credencial)</h6>';
                }
                if($value['empleado_id']==$value['empleado_matricula'] || $value['empleado_matricula']==''){
                    $estado_informacion++;
                    $label_status.='<h6 class="color-white text-left m-t-5 m-b-10 line-height">* N° de empleado no capturado (Necesario para la impresión de la credencial)</h6>';
                }
                if($value['empleado_categoria']==''){
                    $estado_informacion++;
                    $label_status.='<h6 class="color-white text-left m-t-5 m-b-10 line-height">* No se ha especificado una categoría</h6>';
                }
                if($sqlUa['eua_especialidad']==''){
                    $estado_informacion++;
                    $label_status.='<h6 class="color-white text-left m-t-5 m-b-10 line-height">* No se ha especificado una especialidad (Necesario para la impresión de la credencial solo residentes)</h6>';
                }
                if($value['empleado_activo']!='Baja'){
                    if($estado_informacion>0){
                        $estado_informacion_lb="<span class='label label-important pointer tip' data-html='true' data-original-title='$label_status'>Información faltante...</span>";
                    }else{
                        $estado_informacion_lb='<span class="label label-success">OK</span>';
                    }
                }else{
                    $estado_informacion_lb="Baja de usuario";
                }
                if($value['empleado_activo']=='Baja'){
                    $tr_bg='bg-red color-white';
                }else{
                     $tr_bg='';
                }
                $tr.='<tr class="'.$tr_bg.'">
                        <td>'.$value['empleado_id'].'</td>
                        <td>'.($value['empleado_matricula']==''? 'NO ASIGNADO':$value['empleado_matricula']).'</td>
                        <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                        <td>'.$sqlUa['eua_especialidad'].'</td>
                        <td>'.$value['empleado_categoria'].'</td>
                        <td>'.$estado_informacion_lb.'</td>
                        <td>
                            <div class="dropdown '.($value['empleado_activo']=='Baja' ? 'hide':'').'" >
                                <button class="btn sigh-background-primary dropdown-toggle btn-small btn-block" type="button" data-toggle="dropdown">Acciones...
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li>'.$label_folder.' </li>
                                    <li>
                                        <a href="'. base_url().'Sections/Usuarios/PrivateInformation?emp='.$value['empleado_id'].'"><i class="fa fa-lock sigh-color i-20 tip"></i> Información Privada</a>
                                    </li>
                                    <li class="disabled">
                                        <a href="#"><i class="fa fa-envelope-o sigh-color i-20"></i> Enviar Email</a>
                                    <li>
                                    <li>
                                        <a href="'.base_url().'Sections/Usuarios/Usuario/'.$value['empleado_id'].'/?a=edit">'.$label_icon.' </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-alumno-baja" data-id="'.$value['empleado_id'].'"><i class="fa fa-user-times sigh-color i-20"></i> Baja de Usuario</a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-alumno-delete" data-id="'.$value['empleado_id'].'">
                                            <i class="fa fa-trash-o sigh-color pointer i-20 "></i> Eliminar Usuario
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>';
            }
        }else{
           $tr.='<tr>
                    <td colspan="5">EL CRITERIO DE BUSQUEDA NO ARROJADO NINGÚN REGISTRO</td>
                </td>';
        }
        $this->setOutput(array('tr'=>$tr,'total_users'=> count($sql)));
    }
    public function AjaxAutorizacionCredencial() {
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_aut_credencial'=>'Si',
            'empleado_aut_credencial_date'=> date('Y-m-d H:i:s')
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->setOutput(array('action'=>1));
    } 
    public function AjaxObtenerUsuarioAdmin() {
        if($this->input->get_post('FILTRO_TIPO')==''){
            $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados ORDER BY empleado_id DESC LIMIT 200 ");
        }else{
            $sql= $this->config_mdl->GetDataLike('sigh_empleados',array(
                 $this->input->get_post('FILTRO_TIPO')=> $this->input->get_post('FILTRO_VALUE')
            ));
        }
        if(!empty($sql)){
            $tr='';
            foreach ($sql as $value) {
               
                $sqlRoles= $this->config_mdl->sqlQuery("SELECT rol.rol_nombre FROM sigh_roles AS rol, sigh_empleados_roles AS roles
                                                    WHERE rol.rol_id=roles.rol_id AND roles.empleado_id=".$value['empleado_id']);
                $roles='';
                $label_icon_ic='<a href="'. base_url().'Sections/Usuarios/PrivateInformation?emp='.$value['empleado_id'].'"><i class="fa fa-lock sigh-color i-20 tip" data-original-title="Información de caracter personal del usuario" ></i></a>&nbsp;';
                foreach ($sqlRoles as $rol) {
                   $roles.=$rol['rol_nombre'].', ';
                }
                //if($value['empleado_registrotipo']=='Preregistro'){
                   if($value['empleado_roles']=='82' || $value['empleado_roles']=='85'){
                       $sqlUa= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
                           'empleado_id'=>$value['empleado_id']
                       ),'eua_especialidad')[0];
                       $label_status='';
                       $label_icon='';
                       if($value['empleado_status']=='Pre-registro'){
                           $label_status='<div style="position:relative"><span class="label label-danger" style="position:absolute;right:-10px;top:0px">SIN VALIDAR</span></div>';
                           $label_icon='<i class="fa fa-check sigh-color i-20 tip" data-original-title="Validar Información"></i>';
                           $label_folder='<i class="fa fa-folder-open-o sigh-color i-20 tip no-action" data-original-title="Carpeta de documentos del usuario"></i>&nbsp;';
                       }else{
                           $label_status='';
                           $label_icon='<i class="fa fa-pencil sigh-color i-20 tip" data-original-title="Editar"></i>';
                           $label_folder='<a href="'. base_url().'Sections/Usuarios/CarpetadeDocumentos?emp='.$value['empleado_id'].'"><i class="fa fa-folder-open-o sigh-color i-20 pointer tip" data-id="'.$value['empleado_id'].'" data-original-title="Carpeta de documentos del usuario"></i></a>&nbsp;';
                       }
                       $tr.='<tr>
                                <td>'.$value['empleado_id'].'</td>
                                <td>'.($value['empleado_matricula']==''? 'NO ASIGNADO':$value['empleado_matricula']).'</td>
                                <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                                <td>'.$sqlUa['eua_especialidad'].' '.$label_status.'</td>
                                <td>
                                    '.$label_folder.' '.$label_icon_ic.' 
                                    <a href="'.base_url().'Sections/Usuarios/Usuario/'.$value['empleado_id'].'/?a=edit">'.$label_icon.'</a>&nbsp;
                                    <i class="fa fa-trash-o sigh-color pointer i-20 user-alumno-delete" data-id="'.$value['empleado_id'].'"></i>
                                </td>
                            </tr>';
                   //}
                }else{
                    $tr.='<tr>
                            <td>'.$value['empleado_id'].'</td>
                            <td>'.($value['empleado_matricula']==''? 'NO ASIGNADO':$value['empleado_matricula']).'</td>
                            <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                            <td><div class="text-nowrap-roles tip" data-original-title="'. rtrim($roles, ', ').'" data-placement="left">'. rtrim($roles, ', ').'</div></td>
                            <td>
                                '.$label_icon_ic.' 
                                <a href="'.base_url().'Sections/Usuarios/Usuario/'.$value['empleado_id'].'/?a=edit">
                                    <i class="fa fa-pencil sigh-color i-20 "></i>
                                </a>&nbsp;
                                <i class="fa fa-trash-o sigh-color pointer i-20 user-alumno-delete" data-id="'.$value['empleado_id'].'"></i>
                            </td>
                        </tr>';
                }
               
           }
       }else{
           $tr.='<tr>
                    <td colspan="5">EL CRITERIO DE BUSQUEDA NO ARROJADO NINGÚN REGISTRO</td>
                </td>';
       }
       $this->setOutput(array('tr'=>$tr));
   }
    public function EliminarUsuario() {
       $info= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ))[0];
       $this->config_mdl->sqlDelete('sigh_empleados_directorio',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $sqlDoc=$this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       foreach ($sqlDoc as $value) {
           $sqlAnexo= $this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos_anexo',array(
               'documento_id'=>$value['documento_id']
           ));
           foreach ($sqlAnexo as $anexo) {
               unlink('assets/usuarios_anexos/'.$anexo['anexo_nombre']);
           }
           $this->config_mdl->sqlDelete('sigh_empleados_documentos_anexo',array(
               'documento_id'=>$value['documento_id']
           ));
       }
       $this->config_mdl->sqlDelete('sigh_empleados_documentos',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->config_mdl->sqlDelete('sigh_empleados_especialidad',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->config_mdl->sqlDelete('sigh_empleados_familiar',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->config_mdl->sqlDelete('sigh_empleados_roles',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->config_mdl->sqlDelete('sigh_empleados_ropa',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->config_mdl->sqlDelete('sigh_empleados_ua',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       if($info['empleado_perfil']!='default_.png'){
           unlink('assets/img/perfiles'.$info['empleado_perfil']);
       }
       $this->config_mdl->sqlDelete('sigh_empleados',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->config_mdl->sqlDelete('sigh_empleados_digital',array(
           'empleado_id'=> $this->input->post('empleado_id')
       ));
       $this->setOutput(array('action'=>1));
       
   }
   public function CarpetadeDocumentos() {
       $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_id'=> $this->input->get('emp')
       ))[0];
       $this->load->view('Usuarios/usuario_carpeta',$sql);
   }
    public function MiPerfil() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_id'=> $this->UMAE_USER
        ));
        $sql['Especialidades']=  $this->config_mdl->sqlGetData('sigh_especialidades');
        $sql['Roles']= $this->config_mdl->sqlQuery("SELECT rol.rol_nombre FROM sigh_empleados AS emp, sigh_roles AS rol, sigh_empleados_roles AS emp_rol
            WHERE
            emp_rol.empleado_id=emp.empleado_id AND
            emp_rol.rol_id=rol.rol_id AND
            emp.empleado_id=".$this->UMAE_USER);
        $sql['Directorio']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$this->UMAE_USER,
            'directorio_tipo'=>'Empleado'
        ))[0];
        $sql['Directorio2']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$this->UMAE_USER,
            'directorio_tipo'=>'Familiar'
        ))[0];
        $sql['Familiar']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=>$this->UMAE_USER,
        ))[0];
        $this->load->view('Sections/Usuarios/MiPerfil',$sql);
    }
    public function AjaxSaveImage64() {
        $image64=date('YmdHis').'-'.rand().'.png';
        $img = str_replace('data:image/png;base64,', '', $this->input->post('img_base64'));
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents('assets/'.$this->input->post('img_save').''.$image64, $data);
        $this->setOutput(array('action'=>1,'image_create'=>$image64));
    }
    public function AjaxImageProfile() {
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_perfil'=> $this->input->post('empleado_perfil')
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxMiPerfil() {
        if(isset($_POST['empleado_sc'])){
            $empleado_sc='Si';
        }else{
            $empleado_sc='No';
        }
        $data=array(
            'empleado_nombre'=> $this->input->post('empleado_nombre'),
            'empleado_sexo'=> $this->input->post('empleado_sexo'),
            'empleado_ap'=> $this->input->post('empleado_ap'),
            'empleado_am'=> $this->input->post('empleado_am'),
            'empleado_fn'=> $this->input->post('empleado_fn'),
            'empleado_curp'=> $this->input->post('empleado_rfc'),
            'empleado_rfc'=> $this->input->post('empleado_curp'),
            'empleado_nss'=> $this->input->post('empleado_nss'),
            'empleado_estadocivil'=> $this->input->post('empleado_estadocivil'),
            'empleado_lugar_nac'=> $this->input->post('empleado_lugar_nac'),
            'empleado_nacionalidad'=> $this->input->post('empleado_nacionalidad'),
            'empleado_categoria'=> $this->input->post('empleado_categoria'),
            'empleado_departamento'=> $this->input->post('empleado_departamento'),
            'empleado_servicio'=>    $this->input->post('empleado_servicio'),
            'empleado_cedula'=>  $this->input->post('empleado_cedula'),
            'empleado_turno'=> $this->input->post('empleado_turno'),
            'empleado_ingreso'=> $this->input->post('empleado_ingreso'),
            'empleado_tipoplaza'=> $this->input->post('empleado_tipoplaza'),
            'empleado_sc'=> $empleado_sc,
            'empleado_password'=> sha1($this->input->post('empleado_password')),
            'empleado_base64'=> base64_encode($this->input->post('empleado_password')) ,
        );
        $dirEmpleado=array(
            'directorio_tipo'=>'Empleado',
            'directorio_calle'=> $this->input->post('directorio_calle'),
            'directorio_colonia'=> $this->input->post('directorio_colonia'),
            'directorio_municipio'=> $this->input->post('directorio_municipio'),
            'directorio_estado'=> $this->input->post('directorio_estado'),
            'directorio_cp'=> $this->input->post('directorio_cp'),
            'directorio_telefono'=> $this->input->post('directorio_telefono'),
            'directorio_email'=> $this->input->post('directorio_email'),
            'empleado_id'=> $this->UMAE_USER,
        );
       $dirFamiliar=array(
            'directorio_tipo'=>'Familiar',
            'directorio_calle'=> $this->input->post('directorio_calle2'),
            'directorio_colonia'=> $this->input->post('directorio_colonia2'),
            'directorio_municipio'=> $this->input->post('directorio_municipio2'),
            'directorio_estado'=> $this->input->post('directorio_estado2'),
            'directorio_cp'=> $this->input->post('directorio_cp2'),
            'directorio_telefono'=> $this->input->post('directorio_telefono2'),
            'empleado_id'=> $this->UMAE_USER,
        );
        $dataFamiliar=array(
            'familiar_nombre'=> $this->input->post('familiar_nombre'),
            'familiar_apellidos'=> $this->input->post('familiar_apellidos'),
            'familiar_parentesco'=> $this->input->post('familiar_parentesco'),
            'empleado_id'=>$this->UMAE_USER
        );
        $sqlDirEmp= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=> $this->UMAE_USER,
            'directorio_tipo'=>'Empleado'
        ));
        $sqlDirFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=> $this->UMAE_USER,
            'directorio_tipo'=>'Familiar'
        ));
        $sqlFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=> $this->UMAE_USER,
        ));
        if(empty($sqlDirEmp)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',$dirEmpleado);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_directorio',$dirEmpleado,array(
                'directorio_tipo'=>'Empleado',
                'empleado_id'=>$this->UMAE_USER
            ));
        }
        if(empty($sqlDirFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',$dirFamiliar);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_directorio',$dirFamiliar,array(
                'directorio_tipo'=>'Familiar',
                'empleado_id'=>$this->UMAE_USER
            ));
        }
        if(empty($sqlFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_familiar',$dataFamiliar);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_familiar',$dataFamiliar,array(
                'empleado_id'=>$this->UMAE_USER
            ));
        }
        $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
           'empleado_id'=> $this->UMAE_USER
        ));
       
        $this->setOutput(array('accion'=>'1'));
    }
   public function AjaxBuscarEmpleado() {
       $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_matricula'=> $this->input->post('empleado_matricula')
       ),'empleado_id,empleado_nombre,empleado_ap,empleado_am,empleado_nivel_acceso');
       if(!empty($sql)){
           $this->setOutput(array('accion'=>'1',
               'empleado_id'=>$sql[0]['empleado_id'],
               'empleado_nombre'=>$sql[0]['empleado_nombre'],
               'empleado_ap'=>$sql[0]['empleado_ap'],
               'empleado_am'=>$sql[0]['empleado_am'],
               'empleado_nivel_acceso'=>$sql[0]['empleado_nivel_acceso']
            ));
       }else{
           $this->setOutput(array('accion'=>'2'));
       }
   }
   public function AjaxGetEmpleado() {
       $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_matricula'=> $this->input->post('empleado_matricula')
       ));
       if(!empty($sql)){
           $this->setOutput(array('accion'=>'1','empleado'=> base64_encode( $sql[0]['empleado_id']))); 
       }else{
           $this->setOutput(array('accion'=>'2'));
       }
   }
   public function RopaQuirurgica() {
       $this->load->view('Usuarios/RopaQuirurgica');
   }
   public function RopaQuirurgicaUsuario() {
       $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_id'=> base64_decode($this->input->get_post('em'))
       ))[0];
       $sql['RopaQuirurgica']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
           'empleado_id'=>  base64_decode($this->input->get_post('em')),
           'rq_status'=>'En Proceso'
       ));
       $this->load->view('Usuarios/RopaQuirurgicaUsuario',$sql);
   }
    public function AjaxRopaQuirurgicaUsuario() {
        if($this->input->post('accion')=='Recibir'){
            $this->config_mdl->sqlInsert('sigh_empleados_ropa',array(
                'rq_r_fecha'=> date('Y-m-d H:i:s'),
                'hospital_id'=> $this->input->post('hospital_id'),
               'empleado_id'=> $this->input->post('empleado_id'),
                'rq_status'=>'En Proceso'
           ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_ropa',array(
                'rq_e_fecha'=> date('Y-m-d H:i:s'),
                'hospital_id'=> $this->input->post('hospital_id'),
                'empleado_id'=> $this->input->post('empleado_id'),
                'rq_status'=>'Finalizado'
            ),array(
                'rq_status'=>'En Proceso',
                'empleado_id'=> $this->input->post('empleado_id'),
            ));
            $this->setOutput(array('accion'=>'1'));
        }
    }
    public function AjaxGetNotifications() {
        $Total= $this->config_mdl->sqlQuery("SELECT COUNT(not_user.nu_id) AS total FROM sigh_notificaciones_usuarios AS not_user WHERE not_user.nu_status='Nuevo' AND not_user.empleado_id=".$this->UMAE_USER);
        $this->setOutput(array('notification_total'=>$Total[0]['total']));
    }
    public function AjaxViewNotifications() {
        
        $Notificaciones= $this->config_mdl->sqlQuery("SELECT * FROM sigh_notificaciones AS noti, sigh_notificaciones_usuarios AS not_user WHERE noti.notificacion_id=not_user.notificacion_id AND
                                                not_user.empleado_id=$this->UMAE_USER ORDER BY noti.notificacion_id DESC ");
        $msj='';
        $msj_total=0;
        $this->config_mdl->sqlUpdate('sigh_notificaciones_usuarios',array(
            'nu_status'=>'Visto'
        ),array(
            'empleado_id'=> $this->UMAE_USER
        ));
        foreach ($Notificaciones as $value) {
            $msj_total++;
            $Tt= $this->CalcularTiempoTranscurrido(array(
                'Tiempo1'=> date('Y-m-d H:i'),
                'Tiempo2'=>$value['notificacion_fecha'].' '.$value['notificacion_hora']
            ));
           
            if($Tt->d==0){
                if($Tt->h==0 && $Tt->i==0){
                    $Hace='Hace un momento...';
                }else{
                    $Hace='Hace '.$Tt->h.' Hrs '.$Tt->i.' Minutos';
                }
                if($msj_total<=3){
                    $msj.='<div class="alert alert-success ">
                                <h5 class="no-margin semi-bold">'.$value['notificacion_titulo'].'</h5>
                                <h6 class="line-height text-nowrap" style="height:14px">'.$value['notificacion_descripcion'].'</h6>
                                <h6 class="text-left no-margin">'.$Hace.'</h6>
                            </div>';
                    continue;
                }
 
            }
        }
        
        $this->setOutput(array('action'=>1,'notification_msj'=>$msj));
    }
    public function PrivateInformation() { 
        $sql['user']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$_GET['emp']
        ))[0];
        $sql['userLocal']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $this->UMAE_USER
        ),'empleado_pi')[0];
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ip',array(
            'empleado_id'=>$_GET['emp']
        ))[0];
        $this->load->view('Usuarios/usuario_pi',$sql);
    }
    public function AjaxPrivateInformation() {
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ip',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $data=array(
            'ip_descripcion'=> $this->input->post('ip_descripcion'),
            'empleado_id'=> $this->input->post('empleado_id'),
            'empleado_view'=> $this->UMAE_USER
        );
        if(empty($sqlCheck)){
            $this->config_mdl->sqlInsert('sigh_empleados_ip',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_empleados_ip',$data,array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxPiAnexo() {
        $anexo_archivo=date('YmdHis').'.'.end(explode('.', $_FILES['anexo_archivo']['name']));
        copy($_FILES['anexo_archivo']['tmp_name'], 'assets/usuarios_pi/'.$anexo_archivo);
        $this->config_mdl->sqlInsert('sigh_empleados_ip_anexos',array(
            'anexo_titulo'=> $this->input->post('anexo_titulo'),
            'anexo_tipo'=>end(explode('.', $_FILES['anexo_archivo']['name'])),
            'anexo_archivo'=>$anexo_archivo,
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxGetPiAnexo() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ip_anexos',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $cols='';
        foreach ($sql as $value) {
            $cols.='<div class="col-xs-2">
                        <a href="'. base_url().'assets/usuarios_pi/'.$value['anexo_archivo'].'" target="_blank">
                            <h6 class="text-nowrap no-margin text-uppercase tip" data-original-title="'.$value['anexo_titulo'].'">
                                <i class="material-icons i-20 sigh-color"  style="vertical-align: -5px">note_add</i> '.$value['anexo_titulo'].'
                            </h6>
                        </a>
                        <center>
                            <i class="fa fa-trash-o text-center i-20 sigh-color pointer tip remove-anexo-pi" data-archivo="'.$value['anexo_archivo'].'" data-id="'.$value['anexo_id'].'" data-original-title="Elimiar Anexo"></i>
                        </center>
                    </div>';
        }
        $this->setOutput(array('cols'=>$cols));
    }
    public function AjaxEliminarAnexoPi() {
        unlink('assets/usuarios_pi/'.$this->input->post('anexo_archivo'));
        $this->config_mdl->sqlDelete('sigh_empleados_ip_anexos',array(
            'anexo_id'=> $this->input->post('anexo_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function BuscarUsuario() {
        if(isset($_GET['inputSearch'])){
            if($_GET['inputFilter']=='POR NOMBRE'){
                
                $sql['Result']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados AS emp WHERE CONCAT_WS(' ',emp.empleado_nombre, emp.empleado_ap, emp.empleado_am) LIKE '%".$_GET['inputSearch']."%' LIMIT 200");
            }else{
                $sql['Result']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_matricula'=>$_GET['inputSearch']
                ));
            }
        }
        $this->load->view('Usuarios/BuscarUsuario',$sql);
    }
    public function GuardarFirmaDigital() {
        $this->load->view('Usuarios/GuardarFirmaDigital');
    }
    public function SaveDigitalPerson(){
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados AS emp WHERE emp.empleado_perfil!=''");
        foreach ($sql as $value) {
            if(file_exists("assets/img/perfiles/".$value['empleado_perfil'])){
                $digital_profile= base64_encode(file_get_contents("assets/img/perfiles/".$value['empleado_perfil']));
                
            }else{
                $digital_profile='';
            }
            $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados_digital',array(
                'empleado_id'=>$value['empleado_id']
            ));
            if(empty($sqlCheck)){
                $this->config_mdl->sqlInsert('sigh_empleados_digital',array(
                    'empleado_id'=>$value['empleado_id'],
                    'digital_profile'=>$digital_profile
                ));
            }else{
                $this->config_mdl->sqlUpdate('sigh_empleados_digital',array(
                    'digital_profile'=>$digital_profile
                ),array(
                    'empleado_id'=>$value['empleado_id'],
                ));
            }
        }
    }
    public function AjaxBajaUsuario() {
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_activo'=>'Baja'
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxAsociarRegistros() {
        if($this->input->post('action_tipo')=='Contacto Usuario'){
            $sql=$this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
                'directorio_tipo'=>'Empleado',
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            if(empty($sql)){
                $this->config_mdl->sqlInsert('sigh_empleados_directorio',array(
                    'directorio_tipo'=>'Empleado',
                    'empleado_id'=> $this->input->post('empleado_id')
                ));
            }
        }else if($this->input->post('action_tipo')=='Ropa'){
            $sql=$this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            if(empty($sql)){
                $this->config_mdl->sqlInsert('sigh_empleados_ropa',array(
                    'empleado_id'=> $this->input->post('empleado_id')
                ));
            }
        }else if($this->input->post('action_tipo')=='Familiar'){
            $sql=$this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            if(empty($sql)){
                $this->config_mdl->sqlInsert('sigh_empleados_familiar',array(
                    'empleado_id'=> $this->input->post('empleado_id')
                ));
            }
        }else if($this->input->post('action_tipo')=='Contacto Familiar'){
            $sql=$this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
                'directorio_tipo'=>'Familiar',
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            if(empty($sql)){
                $this->config_mdl->sqlInsert('sigh_empleados_directorio',array(
                    'directorio_tipo'=>'Familiar',
                    'empleado_id'=> $this->input->post('empleado_id')
                ));
            }
        }else if($this->input->post('action_tipo')=='Información Académica'){
            $sql=$this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            if(empty($sql)){
                $this->config_mdl->sqlInsert('sigh_empleados_ua',array(
                    'empleado_id'=> $this->input->post('empleado_id')
                ));
            }
        }
        $this->setOutput(array('action'=>1));
    }
}
