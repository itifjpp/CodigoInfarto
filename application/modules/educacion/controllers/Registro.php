<?php

/**
 * Description of Registro
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Registro extends Config{
    public function index() {
        $sql['UniversidadesGet']= $this->config_mdl->sqlQuery("SELECT ua.eua_universidad FROM sigh_empleados_ua AS ua WHERE ua.eua_universidad!='' GROUP BY ua.eua_universidad");
        $sql['EspecialidadesGet']= $this->config_mdl->sqlQuery("SELECT ua.eua_especialidad FROM sigh_empleados_ua AS ua WHERE ua.eua_especialidad!='' GROUP BY ua.eua_especialidad");
        $usuario=$_GET['emp'];
        $sql['info']=   $this->config_mdl->sqlGetDataCondition('sigh_empleados',array('empleado_id'=>$usuario));
        $sql['roles']=  $this->config_mdl->sqlGetData('sigh_roles');
        $sql['MiRol']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados_roles WHERE rol_id IN(85,82) AND empleado_id='$usuario'")[0];
        $sql['Especialidades']=  $this->config_mdl->sqlGetData('sigh_especialidades');
        $sql['Ua']= $this->config_mdl->sqlGetData('sigh_ua');
        $sql['Directorio']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$usuario,
            'directorio_tipo'=>'Empleado'
        ))[0];
        $sql['Directorio2']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$usuario,
            'directorio_tipo'=>'Familiar'
        ))[0];
        $sql['Ropa']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
            'empleado_id'=>$usuario,
        ))[0];
        $sql['Familiar']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=>$usuario,
        ))[0];
        $sql['Eua']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
            'empleado_id'=>$usuario,
        ))[0];
        $sql['EspecialidadR']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_especialidad',array(
            'empleado_id'=>$usuario,
        ))[0];
        $this->load->view('Registro/index',$sql);
    }
    public function AjaxValidarNRT() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $this->input->post('empleado_tmp')
        ));
        if(!empty($sql)){
            $sqlRol= $this->config_mdl->sqlGetDataCondition('sigh_empleados_roles',array(
                'empleado_id'=> $this->input->post('empleado_tmp')
            ));
            if(empty($sqlRol)){
                $rol='No';
            }else{
                $rol='Si';
            }
            $this->setOutput(array(
                'emp'=>$sql[0]['empleado_id'],
                'tmp'=>$this->input->post('empleado_tmp'),
                'rol_asignate'=>$rol,
                'action'=>'1'
            ));
            
        }else{
            $this->setOutput(array(
                'action'=>'2'
            ));
        }
    }
    public function AjaxAsignarRol() {
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_status'=>'Pre-registro',
            'empleado_roles'=> $this->input->post('rol_id')
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $sqlDirEmpleado= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'directorio_tipo'=>'Empleado',
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlDirEmpleado)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',array(
                'directorio_tipo'=>'Empleado',
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $sqlDirFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'directorio_tipo'=>'Familiar',
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlDirFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',array(
                'directorio_tipo'=>'Familiar',
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $sqlFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_familiar',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        
        $sqlRopa= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlRopa)){
            $this->config_mdl->sqlInsert('sigh_empleados_ropa',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        
        $sqlUa= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlUa)){
            $this->config_mdl->sqlInsert('sigh_empleados_ua',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $sqlEspecialidad= $this->config_mdl->sqlGetDataCondition('sigh_empleados_especialidad',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlEspecialidad)){
            $this->config_mdl->sqlInsert('sigh_empleados_especialidad',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $this->config_mdl->sqlInsert('sigh_empleados_roles',array(
            'empleado_id'=> $this->input->post('empleado_id'),
            'rol_id'=> $this->input->post('rol_id')
        ));
        $sqlDigital= $this->config_mdl->sqlGetDataCondition('sigh_empleados_digital',array(
            'empleado_id'=>$this->input->post('empleado_id')
        ));
        if(empty($sqlDigital)){
            $this->config_mdl->sqlInsert('sigh_empleados_digital',array(
                'empleado_id'=>$this->input->post('empleado_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxBuscarPorNum() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(empty($sql)){
            $this->config_mdl->sqlInsert('sigh_empleados',array(
                'empleado_status'=>'Pre-registro',
                'empleado_matricula'=> $this->input->post('empleado_matricula'),
                'empleado_registro'=> date('Y-m-d H:i'),
                'empleado_registrotipo'=>'Preregistro'
            ));
            $Last= $this->config_mdl->sqlGetLastId('sigh_empleados','empleado_id');
            $this->setOutput(array('action'=>'NO_EXISTE','empleado_id'=>$Last));
        }else{
            if(count($sql)==1){
                $sqlRol= $this->config_mdl->sqlGetDataCondition('sigh_empleados_roles',array(
                    'empleado_id'=>$sql[0]['empleado_id']
                ));
                if(empty($sqlRol)){
                    $this->setOutput(array(
                        'action'=>'NO_ROL',
                        'empleado_id'=>$sql[0]['empleado_id']
                    ));
                }else{
                    $this->setOutput(array(
                        'action'=>'SI_ROL',
                        'empleado_id'=>$sql[0]['empleado_id']
                    ));
                }
            }else{
                $tr='';
                foreach ($sql as $value) {
                    $tr.=   '<tr>
                                <td>'.$value['empleado_id'].'</td>
                                <td>'.$value['empleado_matricula'].'</td>
                                <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                                <td>
                                    <label class="md-check">
                                        <input type="radio" name="empleado_id" value="'.$value['empleado_id'].'" class="has-value">
                                        <i class="indigo"></i>
                                    </label>
                                </td>
                            </tr>';
                }
                $this->setOutput(array(
                    'action'=>'MULTIPLE_USUARIOS',
                    'tr'=>$tr
                ));
            }
        }
    }
    public function AgregarDocumentos() {
        $sql['Docs']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
            'empleado_id'=>$_GET['tmp']
        ));
        $sql['DocumentosRegistros']= $this->config_mdl->sqlGetDataCondition('sigh_roles_documentos',array(
            'rol_id'=>$_GET['tipo']
        ));
        $this->load->view('Registro/usuario_documentos',$sql);
    }
    public function AjaxAgregarDocumentos() {
        $data=array(
            'documento_tipo'=> $this->input->post('documento_tipo'),
            'documento_ignore'=> $this->input->post('documentos_ignore'),
            'empleado_id'=> $this->input->post('empleado_tmp')
        );
        if($this->input->post('documento_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_empleados_documentos',$data);
            $DocumentoID= $this->config_mdl->sqlGetLastId('sigh_empleados_documentos','documento_id');
        }else{
            $DocumentoID= $this->input->post('documento_id');
        }
        if(!isset($_POST['documentos_ignore'])){
            for ($index = 0; $index < count($_FILES['documentos_anexos']['name']); $index++) {
                $anexo_tmp=$_FILES['documentos_anexos']['tmp_name'][$index];
                $anexo_tipo= end(explode('.', $_FILES['documentos_anexos']['name'][$index]));
                $anexo_nombre=date('YmdHis').'_'.$this->input->post('empleado_tmp').'_'.rand().'.'.$anexo_tipo;
                copy($anexo_tmp, 'assets/usuarios_anexos/'.$anexo_nombre);
                $this->config_mdl->sqlInsert('sigh_empleados_documentos_anexo',array(
                    'anexo_tipo'=>$anexo_tipo,
                    'anexo_nombre'=>$anexo_nombre,
                    'documento_id'=>$DocumentoID
                ));
            }
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxGetDocumentos() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
            'empleado_id'=> $this->input->post('empleado_tmp')
        ));
        $tr='';
        $i;
        foreach ($sql as $value) {
            if($value['documento_ignore']==''){
                $sqlAnexos= $this->config_mdl->config_mdl->sqlGetDataCondition('sigh_empleados_documentos_anexo',array(
                    'documento_id'=>$value['documento_id']
                ));
                $link='';
                $i_link=0;
                foreach ($sqlAnexos as $value_ane) {
                    $i_link++;
                    if(file_exists('assets/usuarios_anexos/'.$value_ane['anexo_nombre'])){
                        $label_color='label-success';
                        $label_msj='<i class="fa fa-share-square-o "></i> Anexo '.$i_link;
                    }else{
                        $label_color='label-important';
                        $label_msj='<i class="fa fa-warning"></i> ESTE ARCHIVO NO EXISTE';
                    }
                    
                    
                    $link.='<span class="label '.$label_color.' m-r-5 pointer open-doc" data-url="assets/usuarios_anexos/'.$value_ane['anexo_nombre'].'">'.$label_msj.'</span>';
                }
                $i++;
            }else{
                $link='NO SE ANEXO NINGÚN DOCUMENTO';
            }
            $tr.=   '<tr>
                        <td>'.$i.'</td>
                        <td>'.$value['documento_tipo'].'</td>
                        <td>'.$link.'</td>
                        <td>
                            <i class="fa fa-cloud-upload sigh-color i-20 pointer tip preregistro-documento-nuevo" data-original-title="Subir un nuevo documento" data-id="'.$value['documento_id'].'"></i>&nbsp;
                            <i class="fa fa-trash-o sigh-color i-20 pointer preregistro-documento-eliminar tip" data-original-title="Eliminar Documento"  data-id="'.$value['documento_id'].'"></i>
                        </td
                    <tr>';
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function AjaxEliminarDocumento() {
        $sql=$this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos_anexo',array(
            'documento_id'=> $this->input->post('documento_id'),
            
        ));
        foreach ($sql as $value) {
            unlink('assets/usuarios_anexos/'.$value['anexo_nombre']);
            $this->config_mdl->sqlDelete('sigh_empleados_documentos_anexo',array(
                'anexo_id'=> $value['anexo_id'],
            ));
        } 
        $this->config_mdl->sqlDelete('sigh_empleados_documentos',array(
            'documento_id'=> $this->input->post('documento_id'),
            
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxAnexoAdd() {
        $anexo_tmp=$_FILES['anexo_nombre']['tmp_name'];
        $anexo_tipo= end(explode('.', $_FILES['anexo_nombre']['name']));
        $anexo_nombre=date('YmdHis').'_'.$this->input->post('empleado_tmp').'_'.rand().'.'.$anexo_tipo;
        copy($anexo_tmp, 'assets/usuarios_anexos/'.$anexo_nombre);
        $this->config_mdl->sqlInsert('sigh_empleados_documentos_anexo',array(
            'anexo_tipo'=>$anexo_tipo,
            'anexo_nombre'=>$anexo_nombre,
            'documento_id'=> $this->input->post('documento_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxGuardarUsuario() {
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
            'empleado_rfc'=>        $this->input->post('empleado_rfc'),
            'empleado_nss'=>        $this->input->post('empleado_nss'),
            'empleado_cedula'=>          $this->input->post('empleado_cedula'),
            'empleado_perfil'=> ($this->input->post('empleado_perfil')=='' ? 'default_.png':$this->input->post('empleado_perfil')),
            'empleado_turno'=>           $this->input->post('empleado_turno'),
            'empleado_roles'=> $this->input->post('rol_id'),
            'empleado_nacionalidad'=> $this->input->post('empleado_nacionalidad'),
            'empleado_lugar_nac'=> $this->input->post('empleado_lugar_nac'),
            'empleado_tmp'=> $this->input->post('empleado_tmp'),
            'empleado_status'=>'Pre-registro',
            'empleado_registro'=> date('Y-m-d H:i'),
            'empleado_registrotipo'=>'Preregistro',
            'empleado_ingreso'=> $this->input->post('empleado_ingreso'),
            'empleado_tipoplaza'=>'NO APLICA',
            'empleado_sc'=>'No',
            'empleado_categoria'=> $this->input->post('empleado_categoria'),
        );
        unset($data['empleado_registro']);
        unset($data['empleado_ingreso']);
        unset($data['empleado_status']);

        $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados_documentos',array(
            'empleado_id'=>$this->input->post('empleado_id')
        ),array(
            'empleado_id'=>$this->input->post('empleado_id')
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
            'ropa_talla'=> $this->input->post('ropa_talla'),
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
        $this->config_mdl->sqlUpdate('sigh_empleados_especialidad',$dataEspecialidad,array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
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
        $this->setOutput(array('action'=>'1','empleado_id'=>$this->input->post('empleado_id')));
    }
    public function SubirFoto() {
        $this->load->view('Registro/usuario_perfil_upload');
    }
    public function UpdateTmp() {
        $sql=$this->config_mdl->sqlQuery("SELECT emp.empleado_id,emp.empleado_tmp FROM sigh_empleados AS emp");
        foreach ($sql as $value) {
            $this->config_mdl->sqlUpdate('sigh_empleados_documentos',array(
                'empleado_id'=>$value['empleado_id']
            ),array(
                'empleado_id'=>$value['empleado_tmp']
            ));
            $this->config_mdl->sqlUpdate('sigh_empleados',array(
                'empleado_tmp'=>$value['empleado_id']
            ),array(
                'empleado_id'=>$value['empleado_id']
            ));
        }
    }
    public function AddRolEmpleados() {
        $sql= $this->config_mdl->sqlGetData('sigh_empleados');
        foreach ($sql as $value) {
            
            if($value['empleado_categoria']=='MEDICO INTERNO'){
                $this->config_mdl->sqlUpdate('sigh_empleados',array(
                    'empleado_roles'=>85
                ),array(
                    'empleado_id'=>$value['empleado_id']
                ));
                $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados_roles',array(
                    'empleado_id'=>$value['empleado_id'],
                    'rol_id'=>85
                ));
                
                if(empty($sqlCheck)){
                    $sqlCheck= $this->config_mdl->sqlInsert('sigh_empleados_roles',array(
                        'empleado_id'=>$value['empleado_id'],
                        'rol_id'=>85
                    ));
                }
            }if($value['empleado_categoria']=='R1' || $value['empleado_categoria']=='R2' || $value['empleado_categoria']=='R3' || $value['empleado_categoria']=='R4'){
                $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados_roles',array(
                    'empleado_id'=>$value['empleado_id'],
                    'rol_id'=>82
                ));
                $this->config_mdl->sqlUpdate('sigh_empleados',array(
                    'empleado_roles'=>85
                ),array(
                    'empleado_id'=>$value['empleado_id']
                ));
                if(empty($sqlCheck)){
                    $sqlCheck= $this->config_mdl->sqlInsert('sigh_empleados_roles',array(
                        'empleado_id'=>$value['empleado_id'],
                        'rol_id'=>82
                    ));
                }
            }
            echo $value['empleado_nombre'].'<br>';
        }
    }
    //ELIMINAR MAS DE UN USUARIO PERTENECIENTE AL MISMO N° DE EMPLEADO
    public function AjaxEliminarUsuariosExtras() {
        $sql= $this->config_mdl->sqlGetDataCondition("sigh_empleados",array(
           'empleado_matricula'=> $this->input->post('empleado_matricula') 
        ));
        foreach ($sql as $value) {
            if($value['empleado_id']!= $this->input->post('empleado_id')){
                $this->config_mdl->sqlDelete('sigh_empleados_directorio',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                $sqlDoc=$this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
                    'empleado_id'=> $value['empleado_id']
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
                    'empleado_id'=> $value['empleado_id']
                ));
                $this->config_mdl->sqlDelete('sigh_empleados_especialidad',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                $this->config_mdl->sqlDelete('sigh_empleados_familiar',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                $this->config_mdl->sqlDelete('sigh_empleados_roles',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                $this->config_mdl->sqlDelete('sigh_empleados_ropa',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                $this->config_mdl->sqlDelete('sigh_empleados_ua',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                if($info['empleado_perfil']!='default_.png'){
                    unlink('assets/img/perfiles'.$info['empleado_perfil']);
                }
                $this->config_mdl->sqlDelete('sigh_empleados',array(
                    'empleado_id'=> $value['empleado_id']
                ));
                $this->config_mdl->sqlDelete('sigh_empleados_digital',array(
                    'empleado_id'=> $value['empleado_id']
                ));
            }
        }
        
        $this->setOutput(array('action'=>1));
    }
    public function BuscarEmpleado() {
        $this->load->view('Registro/buscar_usuario');
    }
    public function AjaxBuscarEmpleadoPorNumero() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        $tr='';
        foreach ($sql as $value) {
            $tr.=   '<tr>
                        <td>'.$value['empleado_id'].'</td>
                        <td>'.$value['empleado_matricula'].'</td>
                        <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                        <td>
                            <label class="md-check">
                                <input type="radio" name="empleado_id" value="'.$value['empleado_id'].'" class="has-value">
                                <i class="indigo"></i>
                            </label>
                        </td>
                    </tr>';
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function AjaxAsignarRolUsuario() {
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_status'=>'Pre-registro',
            'empleado_roles'=> $this->input->post('rol_id')
        ),array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        $sqlDirEmpleado= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'directorio_tipo'=>'Empleado',
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlDirEmpleado)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',array(
                'directorio_tipo'=>'Empleado',
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $sqlDirFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'directorio_tipo'=>'Familiar',
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlDirFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_directorio',array(
                'directorio_tipo'=>'Familiar',
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $sqlFamiliar= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlFamiliar)){
            $this->config_mdl->sqlInsert('sigh_empleados_familiar',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        
        $sqlRopa= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlRopa)){
            $this->config_mdl->sqlInsert('sigh_empleados_ropa',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        
        $sqlUa= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlUa)){
            $this->config_mdl->sqlInsert('sigh_empleados_ua',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $sqlEspecialidad= $this->config_mdl->sqlGetDataCondition('sigh_empleados_especialidad',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sqlEspecialidad)){
            $this->config_mdl->sqlInsert('sigh_empleados_especialidad',array(
                'empleado_id'=> $this->input->post('empleado_id')
            ));
        }
        $this->config_mdl->sqlInsert('sigh_empleados_roles',array(
            'empleado_id'=> $this->input->post('empleado_id'),
            'rol_id'=> $this->input->post('rol_id')
        ));
        $sqlDigital= $this->config_mdl->sqlGetDataCondition('sigh_empleados_digital',array(
            'empleado_id'=>$this->input->post('empleado_id')
        ));
        if(empty($sqlDigital)){
            $this->config_mdl->sqlInsert('sigh_empleados_digital',array(
                'empleado_id'=>$this->input->post('empleado_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxNoNumEmpleado() {
        $this->config_mdl->sqlInsert('sigh_empleados',array(
            'empleado_status'=>'Pre-registro',
            'empleado_matricula'=> '',
            'empleado_registro'=> date('Y-m-d H:i'),
            'empleado_registrotipo'=>'Preregistro'
        ));
        $Last= $this->config_mdl->sqlGetLastId('sigh_empleados','empleado_id');
        $this->setOutput(array('action'=>1,'LastId'=>$Last));
    }
}
