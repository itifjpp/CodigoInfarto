<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of AdmisionHospitalaria
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class AdmisionHospitalaria extends Config{
    public function AsignarCamas() {
        $this->load->view('AsignarCamas');
    }
    public function TotalCamasEstatusPisos($Piso,$Estado) {
        return count($this->config_mdl->_query("SELECT os_camas.cama_id FROM os_camas, os_areas, os_pisos, os_pisos_camas
                                            WHERE os_areas.area_id=os_camas.area_id AND os_pisos_camas.cama_id=os_camas.cama_id AND
                                            os_camas.cama_status='$Estado' AND
                                            os_pisos_camas.piso_id=os_pisos.piso_id AND os_pisos.piso_id=".$Piso));
        
    }
    public function TotalCamasEstatus($Estado) {
        return count($this->config_mdl->_query("SELECT os_camas.cama_id FROM os_camas, os_areas, os_pisos, os_pisos_camas
                                            WHERE os_areas.area_id=os_camas.area_id AND os_pisos_camas.cama_id=os_camas.cama_id AND
                                            os_camas.cama_status='$Estado' AND
                                            os_pisos_camas.piso_id=os_pisos.piso_id"));
        
    }
    public function AjaxVisorCamas() {
        $Pisos= $this->config_mdl->sqlQuery("SELECT * FROM os_pisos WHERE hospital_id=".$this->sigh->getInfo('hospital_id'));
        $Col='';
        foreach ($Pisos as $value) {
            $Camas= $this->config_mdl->sqlQuery("SELECT c.cama_id,c.cama_nombre,c.cama_status, a.area_nombre FROM os_camas AS c, os_areas AS a, os_pisos AS p, os_pisos_camas AS pc
                                            WHERE a.area_id=c.area_id AND pc.cama_id=c.cama_id AND
                                            pc.piso_id=p.piso_id AND p.piso_id=".$value['piso_id']);
            $Disponibles= $this->TotalCamasEstatusPisos($value['piso_id'], 'Disponible');
            $Limpieza= $this->TotalCamasEstatusPisos($value['piso_id'], 'En Limpieza');
            $Ocupado= $this->TotalCamasEstatusPisos($value['piso_id'], 'Ocupado');
            $Mantenimiento= $this->TotalCamasEstatusPisos($value['piso_id'], 'En Mantenimiento');
            $Col.=' <div class="panel panel-default">
                        <div class="panel-heading back-imss">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_'.$value['piso_id'].'"> 
                                    <div class="row">
                                        <div class="col-md-2" style="padding: 0px;">
                                            <span style="text-transform:uppercase">'.$value['piso_nombre'].'</span>
                                        </div>
                                        <div class="col-md-10" style="font-size:14px">
                                            <i class="fa fa-bed"></i> Total '. count($Camas).' Camas&nbsp;&nbsp;
                                            '.$Disponibles.' Disponibles&nbsp;&nbsp;
                                            '.$Ocupado.' Ocupadas&nbsp;&nbsp;
                                            '.$Limpieza.' Limpieza&nbsp;&nbsp;
                                            '.$Mantenimiento.' Mantenimiento&nbsp;&nbsp;
                                        </div>
                                        <div class="col-md-offset-2 col-md-10">
                                            
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_'.$value['piso_id'].'" class="panel-collapse collapse ">
                            <div class="panel-body" style=" padding: 18px;">
                                <div class="row">';
                                foreach ($Camas as $camas) { 
                                    $InfectadoColor='';
                                    $Accion='';
                                    $Paciente='&nbsp;';
                                    $Enfermera='&nbsp;';
                                    $sqlPaciente= $this->config_mdl->sqlGetDataCondition('doc_43051',array(
                                        'ac_estatus_doc'=>'Asignación',
                                        'ac_estatus'=>'Asignación',
                                        'cama_id'=> $camas['cama_id'],
                                    ),'ac_id,triage_id,empleado_id');
                                    if(!empty($sqlPaciente)){
                                        $Estado='<span class="label red">Asignado</span>';
                                    }else{
                                        $Estado='';
                                    }
                                    $Triage=$this->config_mdl->sqlGetDataCondition("os_triage",array(
                                        'triage_id'=>$sqlPaciente[0]['triage_id']
                                    ),'triage_id,triage_nombre,triage_nombre_ap,triage_nombre_am')[0];
                                    //$Triage=$this->config_mdl->sqlQuery("SELECT triage_id,triage_nombre,triage_nombre_ap,triage_nombre_am FROM os_triage WHERE triage_id=".$sqlPaciente[0]['triage_id'])[0];
                                    $TriageNombre=$Triage['triage_nombre'].' '.$Triage['triage_nombre_ap'].' '.$Triage['triage_nombre_am'];
                                    
                                    $Asigna=$this->config_mdl->sqlGetDataCondition("os_empleados",array(
                                        'empleado_id'=>$sqlPaciente[0]['empleado_id']
                                    ),'empleado_id,empleado_nombre,empleado_apellidos')[0];
                                    $EnfermeraNombre_=$Asigna['empleado_nombre'].' '.$Asigna['empleado_apellidos'];
                                    if(strlen($EnfermeraNombre_)>35){
                                        $EnfermeraNombre= mb_substr($EnfermeraNombre_, 0,35,'UTF-8');
                                    }else{
                                        $EnfermeraNombre=$EnfermeraNombre_;
                                    }
                                    $Accion1='<button md-ink-ripple="" class="md-btn md-fab m-b bg-white md-mini waves-effect tip btn-paciente-agregar no-padding" data-accion="Disponible" data-cama="'.$camas['cama_id'].'"  data-original-title="Agregar Paciente">
                                                        <i class="mdi-social-person-add i-20 text-color-imss" ></i>
                                                    </button>';
                                    $Accion2='<ul class="list-inline">
                                                        <li class="dropdown">
                                                            <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab md-mini red md-btn-circle waves-effect no-padding" aria-expanded="false" style="">
                                                                <i class="mdi-navigation-more-vert text-color-white" ></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                                                <li><a href="#" class="open-view-url" data-url="Inicio/Documentos/DOC43051/'.$sqlPaciente[0]['triage_id'].'" data-triage="'.$sqlPaciente[0]['triage_id'].'" data-cama="'.$camas['cama_id'].'"><i class="fa fa-file-pdf-o icono-accion"></i> Generar 43051</a></li>
                                                                <li><a href="#" class="open-view-url" data-url="Inicio/Documentos/ImprimirPulsera/'.$sqlPaciente[0]['triage_id'].'" data-triage="'.$sqlPaciente[0]['triage_id'].'" data-cama="'.$camas['cama_id'].'"> <i class="fa fa-print icono-accion"></i> Imprimir Pulsera <span class="label red pos-rlt m-r-xs"><b class="arrow left red pull-in" style="color:#F44336"></b>N</span></a></li>
                                                                <li><a href="#" class="liberar43051" data-triage="'.$sqlPaciente[0]['triage_id'].'" data-cama="'.$camas['cama_id'].'"><i class="fa fa-share-square-o icono-accion"></i> Liberar Cama</a></li>
                                                                <li><a href="#" class="eliminar43051" data-triage="'.$sqlPaciente[0]['triage_id'].'" data-cama="'.$camas['cama_id'].'"><i class="fa fa-trash-o icono-accion"></i> Eliminar 43051</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>';
                                    
                                    if($camas['cama_status']=='Disponible'){
                                        $CamaStatus='blue';
                                        if(empty($sqlPaciente)){
                                            $Accion=$Accion1;
                                        }else{
                                            $Accion=$Accion2;
                                            $Paciente='<b>PACIENTE: </b>'.$TriageNombre;
                                            $Enfermera='<b>ENF.: </b>'.$EnfermeraNombre;
                                        }
                                    }else if($camas['cama_status']=='En Limpieza' ){
                                        $CamaStatus='orange';
                                        if(empty($sqlPaciente)){
                                            $Accion=$Accion1;
                                        }else{
                                            $Accion=$Accion2;
                                            $Paciente='<b>PACIENTE: </b>'.$TriageNombre;
                                            $Enfermera='<b>ENF.: </b>'.$EnfermeraNombre;
                                        }
                                        
                                    
                                    }else if($camas['cama_status']=='En Mantenimiento'){
                                        $CamaStatus='red';
                                    }else if($camas['cama_status']=='Descompuesta'){
                                        $CamaStatus='orange';
                                    }else if($camas['cama_status']=='Ocupado'){
                                        $CamaStatus='green';
                                        if(empty($sqlPaciente)){
                                            $Accion=$Accion1;
                                        }else{
                                            $Accion=$Accion2;
                                            $Paciente='<b>PACIENTE: </b> '.$TriageNombre;
                                            $Enfermera='<b>ENF.: </b>'.$EnfermeraNombre;
                                        }
                                        
                                    }else if($value['cama_status']=='En Espera'){
                                        $CamaStatus='blue-grey-700';    
                                    }
                            $Col.=' <div class="col-md-3 " style="padding-right:5px ;padding-left:5px;padding-bottom:10px"> 
                                        <div class="card '.$CamaStatus.' color-white" style="border-radius:3px;margin:0px">
                                            <div class="row" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                                <div class="col-md-12" "><b style="text-transform:uppercase;font-size:10px;margin-left:-14px"><i class="fa fa-window-restore"></i> '.$camas['area_nombre'].'</b></div>
                                            </div>
                                            <div class="card-heading" style="margin-top:-10px">
                                                <h5 class="font-thin color-white text-nowrap-imss"  style="height:15px;font-size:15px!important;margin-left: -10px;margin-top: 0px;text-transform: uppercase">
                                                    <i class="fa fa-bed " ></i> <b>'.$camas['cama_nombre'].' | '.$camas['cama_status'].'</b>
                                                </h5>
                                                <hr class="hr-style1" style="margin:3px;">
                                            </div>
                                            <div class="card-tools" style="right:2px;top:2px">'.$Accion.'</div>
                                            <div style="position:relative">
                                                <div style="position: absolute;right: -1px;top:-3px">'.$Estado.'</div>
                                            </div>
                                            <div class="card-body" style="margin-top:-20px;margin-left:-11px;padding:0px 24px 3px;">
                                                <h3 style="font-size: 10px;margin: 0px 0px 9px;height:12px" class="text-nowrap-imss">'.$Paciente.'</h4>
                                                <p style="margin-top: -7px;font-size: 10px;margin-bottom: 5px;height:14px" class="text-nowrap-imss">'.$Enfermera.'</p>
                                            </div>
                                        </div>
                                    </div>';
                                }
            $Col.='             </div>
                            </div>
                        </div>
                    </div>';
        }
        $this->setOutput(array(
            'accion'=>'1',
            'Col'=>$Col
        ));
    }
    public function AjaxBuscarPaciente() {
        $sql= $this->config_mdl->sqlGetDataCondition('doc_43051',array(
            'triage_id'=> $this->input->post('triage_id'),
            'ac_estatus'=>'Asignación'
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AsignarCama() {
//        $sql['info']= $this->config_mdl->sqlGetDataCondition('os_triage',array(
//            'triage_id'=>$_GET['triage_id']
//        ))[0];
        $this->load->view('AsignarCama');
    }
    public function AjaxAsignarCama_v2() {
        $sqlEmpleado= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ),'empleado_id');
        if(!empty($sqlEmpleado)){
            $this->AccesosUsuarios(array('acceso_tipo'=>'Admisión Hospitalaria AC','triage_id'=>$this->input->post('triage_id'),'areas_id'=>0));
            $this->config_mdl->_insert('doc_43051',array(
                'ac_estatus'=>'Asignación',
                'ac_estatus_doc'=>'Asignación',
                'ac_fecha'=> date('Y-m-d H:i:s'),
                'cama_id'=> $this->input->post('cama_id'),
                'ac_ingreso_servicio'=> $this->input->post('ac_ingreso_servicio'),
                'ac_ingreso_medico'=> $this->input->post('ac_ingreso_medico'),
                'ac_ingreso_matricula'=> $this->input->post('ac_ingreso_matricula'),
                'ac_salida_servicio'=> $this->input->post('ac_salida_servicio'),
                'ac_salida_medico'=> $this->input->post('ac_ingreso_servicio'),
                'ac_salida_matricula'=> $this->input->post('ac_salida_matricula'),
                'ac_infectado'=> $this->input->post('ac_infectado'),
                'ac_cama_estatus'=> $this->input->post('ac_cama_estatus'),
                'cama_id'=> $this->input->post('cama_id'),
                'empleado_id'=> $sqlEmpleado[0]['empleado_id'],
                'triage_id'=> $this->input->post('triage_id')
            ));
            Modules::run('Triage/TriagePacienteDirectorio',array(
                'directorio_tipo'=>'Familiar',
                'directorio_cp'=> $this->input->post('directorio_cp'),
                'directorio_cn'=> $this->input->post('directorio_cn'),
                'directorio_colonia'=> $this->input->post('directorio_colonia'),
                'directorio_municipio'=> $this->input->post('directorio_municipio'),
                'directorio_estado'=> $this->input->post('directorio_estado'),
                'directorio_telefono'=> '',
                'triage_id'=>$this->input->post('triage_id')
            ));
            
            $this->setOutput(array('accion'=>'1'));
        
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxEliminar43051() {
        $this->config_mdl->_delete_data('doc_43051',array(
            'triage_id'=> $this->input->post('triage_id'),
            'cama_id'=> $this->input->post('cama_id'),
        ));
        
        $this->setOutputV2(array('accion'=>'1'));
    }
    public function AjaxLiberarCama43051() {
        $this->config_mdl->_update_data('doc_43051',array(
            'ac_estatus_doc'=>'Liberado'
        ),array(
            'ac_estatus_doc'=>'Asignación',
            'triage_id'=> $this->input->post('triage_id'),
            'cama_id'=> $this->input->post('cama_id'),
        ));
        $this->setOutputV2(array('accion'=>'1'));
    }
    public function PasesdeVisitas() {
        $this->load->view('Pases/PasesDeVisitas');
    }
    public function AjaxPacientePV() {
        $sql= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function PasesdeVisitasFamiliares() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition("um_poc_familiares",array(
            'triage_id'=>$_GET['folio']
        ));
        $sql['PaseVisita']= $this->config_mdl->sqlGetDataCondition('um_pases_visitas',array(
                'triage_id'=> $this->input->get_post('folio')
        ))[0];
        $sqlCheckPase= $this->config_mdl->sqlGetDataCondition('um_pases_visitas',array(
            'triage_id'=> $this->input->get_post('folio')
        ));
        $data=array(
            'pv_fecha'=> date('Y-m-d'),
            'pv_hora'=> date('H:i:s'),
            'pv_tipo'=>$_GET['tipo'],
            'pv_tipo_solicitud'=>'Pase de Visita Normal',
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=>$_GET['folio']
        );
        if(empty($sqlCheckPase)){
            $this->config_mdl->sqlInsert('um_pases_visitas',$data);
        }else{
            unset($data['pv_tipo_solicitud']);
            unset($data['pv_fecha']);
            unset($data['pv_hora']);
            $this->config_mdl->sqlUpdate('um_pases_visitas',$data,array(
                'triage_id'=>$_GET['folio']
            ));
        }
        $this->load->view('Pases/PasesdeVisitasFamiliares',$sql);
    }
    public function AgregarFamiliar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_poc_familiares',array(
            'familiar_id'=>$_GET['familiar']
        ))[0];
        $this->load->view('Pases/PasesdeVisitasFamiliaresAgregar',$sql);
    }
    public function AjaxAgregarFamiliar() {
        $data=array(
            'familiar_nombre'=> $this->input->post('familiar_nombre'),
            'familiar_nombre_ap'=> $this->input->post('familiar_nombre_ap'),
            'familiar_nombre_am'=> $this->input->post('familiar_nombre_am'),
            'familiar_parentesco'=> $this->input->post('familiar_parentesco'),
            'familiar_registro'=> date('Y-m-d H:i:s'),
            'triage_id'=> $this->input->post('triage_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('um_poc_familiares',$data);
        }else{
            unset($data['familiar_registro']);
            $this->config_mdl->_update_data('um_poc_familiares',$data,array(
                'familiar_id'=> $this->input->post('familiar_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarFamiliar() {
        $this->config_mdl->_delete_data('um_poc_familiares',array(
            'familiar_id'=> $this->input->post('familiar_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AgregarFamiliarFoto() {
        $this->load->view('Pases/PasesdeVisitasFamiliaresAgregarFoto');
    }
    public function AjaxGuardarPerfilFamiliar() {
        $data = $this->input->post('familiar_perfil');
        $data = str_replace('data:image/jpeg;base64,', '', $data);
        $url_save='assets/img/familiares/';
        $data = base64_decode($data);
        $familiar_perfil = $url_save.$this->input->post('familiar_id').'_'.$this->input->post('triage_id').'.jpeg';
        file_put_contents($familiar_perfil, $data);
        $data = base64_decode($data); 
        $source_img = imagecreatefromstring($data);
        $rotated_img = imagerotate($source_img, 90, 0); 
        $familiar_perfil = $url_save.$this->input->post('familiar_id').'_'.$this->input->post('triage_id').'.jpeg';
        imagejpeg($rotated_img, $familiar_perfil, 10);
        imagedestroy($source_img);
        $this->config_mdl->_update_data('um_poc_familiares',array(
            'familiar_perfil'=>$this->input->post('familiar_id').'_'.$this->input->post('triage_id').'.jpeg'
        ),array(
            'familiar_id'=> $this->input->post('familiar_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function ValidarPasedeVisita() {
        if($_GET['tipo']=='Pisos'){
            $sqlIngresoPisos= $this->config_mdl->sqlGetDataCondition('os_areas_pacientes',array(
                'triage_id'=>$_GET['folio']
            ));
            if(empty($sqlIngresoPisos)){
                $sql['Cama']= $this->config_mdl->sqlQuery("SELECT * FROM os_camas, doc_43051, os_areas WHERE
                                                            os_camas.area_id=os_areas.area_id AND
                                                            os_camas.cama_id=doc_43051.cama_id AND 
                                                            doc_43051.triage_id=".$_GET['folio'])[0];
            }else{
                $sql['Cama']=$this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE os_camas.area_id=os_areas.area_id AND
                                                    os_camas.cama_dh=".$_GET['folio'])[0];
            }
        }else{
            $sql['Cama']=$this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE os_camas.area_id=os_areas.area_id AND
                                                    os_camas.cama_dh=".$_GET['folio'])[0];
        }
        $this->load->view('Pases/PasesdeVisitasValidar',$sql);
    }
    public function AjaxValidarPase() {
        $this->config_mdl->sqlUpdate('um_pases_visitas',array(
            'pv_servicio'=> $this->input->post('pv_servicio'),
            'pv_cama'=> $this->input->post('pv_cama'),
            'pv_piso'=> $this->input->post('pv_piso'),
            'pv_horario'=> $this->input->post('pv_horario')
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminar43051All() {
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('doc_43051',array(
            'ac_estatus'=>'Asignación',
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sqlCheck)){
            $this->config_mdl->sqlDelete('doc_43051',array(
                'ac_estatus'=>'Asignación',
                'triage_id'=> $this->input->post('triage_id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
}
