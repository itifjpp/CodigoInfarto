<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pacientes
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Pacientes extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('Pacientes/index');
    }
    public function ObtenerPacienteFolio() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->post('triage_id')
        ));
        if(empty($sql)){
            $this->setOutput(array('accion'=>'2'));
        }else{
            $this->setOutput(array('accion'=>'1'));
        }
    }
    public function AjaxPaciente() {
        $inputSelect= $this->input->post('inputSelect');
        $inputSearch= $this->input->post('inputSearch');
        if($inputSelect=='POR_NUMERO'){
            $sql= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, CONCAT_WS(' ',pac.paciente_ap,pac.paciente_am,pac.paciente_nombre) AS paciente_nombre
                                            FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE pac.paciente_id=ing.paciente_id AND ingreso_id=".$inputSearch);
        }if($inputSelect=='POR_NOMBRE'){
            $sql=  $this->config_mdl->_query("SELECT ing.ingreso_id, CONCAT_WS(' ',pac.paciente_ap,pac.paciente_am,pac.paciente_nombre) AS paciente_nombre 
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac 
                WHERE pac.paciente_id=ing.paciente_id 
                HAVING paciente_nombre LIKE '%$inputSearch%' LIMIT 200");
        }if($inputSelect=='POR_NSS'){
            $sql= $this->config_mdl->_query("SELECT ing.ingreso_id, CONCAT_WS(' ',pac.paciente_ap,pac.paciente_am,pac.paciente_nombre) AS paciente_nombre FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE
                                            pac.paciente_id=ing.paciente_id  AND
                                            pac.paciente_nss='".$inputSearch."'");
        }
        if(!empty($sql)){
            foreach ($sql as $value) {
                $tr.='<tr>
                        <td>'.$value['ingreso_id'].'</td>
                        <td>'.$value['paciente_nombre'].'</td>
                        <td>
                            <i class="fa fa-print sigh-color i-20 tip pointer iconoPrintTicket" data-id="'.$value['ingreso_id'].'" data-original-title="Reimprimir Ticket del Paciente"></i>&nbsp;
                            <a href="'.base_url().'Sections/Pacientes/Paciente/'.$value['ingreso_id'].'" class="">
                                <i class="fa fa-history sigh-color i-20 tip" data-original-title="Historial del Paciente"></i>
                            </a>&nbsp;
                            <a href="'.base_url().'Sections/Documentos/Expediente/'.$value['ingreso_id'].'/?tipo=Consultorios" >
                                <i class="fa fa fa-folder-open-o sigh-color i-20 tip" data-original-title="Expediente del Paciente"></i>
                            </a>
                        </td>
                    <tr>';
            }
            
            $this->setOutput(array('accion'=>'1','tr'=>$tr));
        }else{
            $tr.='<tr>
                        <td colspan="3" class="text-center mayus-bold"><i class="fa fa-frown-o fa-3x" style="color:#256659"></i><br>No se encontro ningún registro</td>
                    <tr>';
            $this->setOutput(array('accion'=>'1','tr'=>$tr));
        }
    }
    public function Paciente($Paciente) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,pac.paciente_nombre, pac.paciente_ap, pac.paciente_am FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE
                                                    pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$Paciente)[0];

        $sql['Historial']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_accesos AS accesos, sigh_empleados AS emp, sigh_pacientes_ingresos AS ing
                            WHERE 
                            accesos.empleado_id=emp.empleado_id AND
                            accesos.ingreso_id=ing.ingreso_id AND
                            ing.ingreso_id=$Paciente ORDER BY accesos.acceso_id ASC");
        $sql['PacientesLog']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados, sigh_pacientes_log
                                WHERE sigh_empleados.empleado_id=sigh_pacientes_log.empleado_id AND
                                sigh_pacientes_log.ingreso_id=".$Paciente);
        $sql['PacientesCamas']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_camas_log_all,sigh_camas, sigh_empleados WHERE sigh_camas_log_all.empleado_id=sigh_empleados.empleado_id AND 
                                sigh_camas_log_all.cama_id=sigh_camas.cama_id AND
                                sigh_camas_log_all.ingreso_id=".$Paciente);
        $sql['PacientesEnfermera']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cambio_enfermera_log, sigh_empleados, sigh_camas WHERE
                                sigh_cambio_enfermera_log.empleado_cambio=sigh_empleados.empleado_id AND
                                sigh_camas.cama_id=sigh_cambio_enfermera_log.cambio_cama AND sigh_cambio_enfermera_log.ingreso_id=".$Paciente);
        $this->load->view('Pacientes/pacienteV2',$sql);
    }
    public function Choque($Paciente) {
        $sql['info']= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['choque']= $this->config_mdl->_get_data_condition('os_choque_v2',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['IngresoChoque']= $this->config_mdl->_query("SELECT * FROM os_accesos, os_choque_v2, os_triage, os_empleados WHERE 
            os_accesos.acceso_tipo='Hora Cero Choque' AND
            os_accesos.areas_id=os_choque_v2.choque_id AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_triage.triage_id=".$Paciente)[0];
        $sql['IngresoChoqueEnf']= $this->config_mdl->_query("SELECT * FROM os_accesos, os_choque_v2, os_triage, os_empleados WHERE 
            os_accesos.acceso_tipo='Ingreso Choque (Asignación Cama)' AND
            os_accesos.areas_id=os_choque_v2.choque_id AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_triage.triage_id=".$Paciente)[0];
        $sql['IngresoChoqueMed']= $this->config_mdl->_query("SELECT * FROM os_accesos, os_choque_v2, os_triage, os_empleados WHERE 
            os_accesos.acceso_tipo='Médico Choque' AND
            os_accesos.areas_id=os_choque_v2.choque_id AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_triage.triage_id=".$Paciente)[0];
        $sql['Cama']= $this->config_mdl->_get_data_condition('os_camas',array(
            'cama_id'=>$sql['choque']['cama_id']
        ))[0];
        $this->load->view('Pacientes/pacienteChoque',$sql);
    }
    public function SignosVitales($Paciente) {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage_signosvitales, os_empleados
                WHERE os_triage_signosvitales.empleado_id=os_empleados.empleado_id AND
                os_triage_signosvitales.triage_id=".$Paciente);
        $this->load->view('Pacientes/pacienteChoqueSV',$sql);
    }
    public function ObtenerEmpleadoTriage($triage,$campo) {
        return $this->config_mdl->_query("SELECT * FROM os_triage, os_empleados
            WHERE os_empleados.empleado_id=os_triage.$campo AND os_triage.triage_id=".$triage );
    }
    public function ObtenerCE($triage) {
        return $this->config_mdl->_query("SELECT * FROM os_consultorios_especialidad, os_empleados
            WHERE os_empleados.empleado_id=os_consultorios_especialidad.ce_crea AND os_consultorios_especialidad.triage_id=".$triage );
    }
    public function ObtenerOC($triage,$tipo) {
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_observacion
            WHERE os_empleados.empleado_id=os_observacion.$tipo AND os_observacion.triage_id=".$triage );
    }
    public function CambiarDestino() {
        $info= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ))[0];
        $data=array(
            'triage_consultorio'=>'0',
            'triage_observacion'=> 'Observación',
            'triage_consultorio_nombre'=> $this->input->post('destino')
        );
        if($this->input->post('destino')=='Observación'){
            $this->config_mdl->_delete_data('os_consultorios_especialidad',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_hf',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_cpr',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_cpr',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_llamada',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion',array(
                'observacion_modulo'=>'Choque',
                'triage_id'=> $this->input->post('triage_id')
            ));
            if($this->CalculaEdad($info['triage_fecha_nac'])->y<15){
                $observacion_area='3';
            }else{
                if($info['triage_paciente_sexo']=='MUJER'){
                    $observacion_area='4';
                }else{
                    $observacion_area='5';
                }
            }
            $this->config_mdl->_insert('os_observacion',array(
                'observacion_fe'=>  date('d/m/Y'),
                'observacion_he'=>date('H:i'),
                'triage_id'=>$this->input->post('triage_id'),
                'observacion_area'=>$observacion_area,
                'observacion_modulo'=>'Observación'
            ));
            
        }if($this->input->post('destino')=='Choque'){
            $this->config_mdl->_delete_data('os_consultorios_especialidad',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_hf',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_cpr',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_cpr',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_consultorios_especialidad_llamada',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion',array(
                'observacion_modulo'=>'Observación',
                'triage_id'=> $this->input->post('triage_id')
            ));
            $this->config_mdl->_insert('os_observacion',array(
                'observacion_fe'=>  date('d/m/Y'),
                'observacion_he'=>date('H:i'),
                'triage_id'=>$this->input->post('triage_id'),
                'observacion_area'=>'6',
                'observacion_modulo'=>'Choque'
            ));
        }if($this->input->post('destino')=='Filtro'){
            unset($data['triage_observacion']);
            $this->config_mdl->_delete_data('os_observacion',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion_cci',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion_ci',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion_cirugiasegura',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion_isq',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion_llamada',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_delete_data('os_observacion_solicitudtransfucion',array('triage_id'=> $this->input->post('triage_id')));
            $this->config_mdl->_insert('os_consultorios_especialidad',array(
                'triage_id'=>  $this->input->post('triage_id'),
                'ce_fe'=>date('d/m/Y'),
                'ce_he'=>  date('H:i'),
                'ce_status'=>'En Espera',
                'ce_via'=>'Triage'
            ));
        }
        $this->config_mdl->_update_data('os_triage',$data,array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Buscar() {
        $this->load->view('Pacientes/Buscar');
    }
    public function AjaxBuscar() {
        $sql=$this->config_mdl->sqlQuery("SELECT * FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$this->input->post('ingreso_id'));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1','paciente'=>$sql[0]));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxActualizarInfo() {
        $this->config_mdl->_update_data('os_triage',array(
            'triage_nombre'=> $this->input->post('triage_nombre'),
            'triage_nombre_ap'=> $this->input->post('triage_nombre_ap'),
            'triage_nombre_am'=> $this->input->post('triage_nombre_am')
        ),array(
            'triage_id'=> $this->input->post('triage_id_val')
        ));
        $this->config_mdl->_update_data('paciente_um',array(
            'pum_nss'=> $this->input->post('pum_nss'),
            'pum_nss_agregado'=> $this->input->post('pum_nss_agregado'),
        ),array(
            'triage_id'=> $this->input->post('triage_id_val')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarHistorial() {
        $this->setOutput(array('accion'=>'1'));
    }
    public function Expediente() {
        $this->load->view('Pacientes/Expediente');
    }
    public function AjaxExpediente() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1','area'=> $this->UMAE_AREA));
        }else{
            $this->setOutput(array('accion'=>'0'));
        }
    }
    public function Chat() {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT emp.empleado_id, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am,emp.empleado_socket_id 
                                                    FROM 
                                                            sigh_empleados AS emp, 
                                                            sigh_protocolos AS prot, 
                                                            sigh_protocolos_pacientes AS pp
                                                    WHERE 
                                                            emp.empleado_id=prot.empleado_id AND
                                                            prot.protocolo_id=pp.protocolo_id AND
                                                            emp.empleado_id=prot.empleado_id AND
                                                            pp.empleado_id=".$this->UMAE_USER)[0];
        $this->load->view('Pacientes/index_chat',$sql);
    }
}
