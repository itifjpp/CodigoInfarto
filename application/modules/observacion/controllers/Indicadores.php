<?php
/**
 * Description of Indicadores
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Indicadores extends Config{
    
    public function Enfermeria() {
        $this->load->view('Indicador/Enfermeria');
    }
    public function AjaxEnfermeria() {
        $inputDateStart= $this->input->post('inputDateStart');
        $inputDateEnd= $this->input->post('inputDateEnd');
        $inputMatricula= $this->input->post('inputMatricula');
        $sqlEmp= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $inputMatricula
        ));
        if(!empty($sqlEmp)){
            $sqlIngresos= $this->config_mdl->sqlQuery("SELECT obs.observacion_id FROM sigh_observacion AS obs WHERE
                    obs.observacion_fe BETWEEN '$inputDateStart' AND '$inputDateEnd' AND obs.observacion_crea=".$sqlEmp[0]['empleado_id']);
            
            $sqlEgresos= $this->config_mdl->sqlQuery("SELECT obs.observacion_id FROM sigh_observacion AS obs WHERE
                    obs.observacion_fs BETWEEN '$inputDateStart' AND '$inputDateEnd' AND obs.observacion_crea=".$sqlEmp[0]['empleado_id']);
            $this->setOutput(array(
                'action'=>1,
                'TOTAl_INGRESO'=> count($sqlIngresos),
                'TOTAL_EGRESO'=> count($sqlEgresos)
            ));
        }else{
            $this->setOutput(array(
                'action'=>2
            ));
        }


    }
    public function EnfemeriaEmpleados() {
        if($this->input->get_post('TIPO_BUSQUEDA')=='POR_FECHA'){
            if($this->input->get_post('TIPO')=='Ingreso Enfermería Observación'){
                $sql['Gestion']=$this->FiltroEnfemeriaEmpleadosFecha(array(
                    'FechaInicio'=> $this->input->get_post('POR_FECHA_FI'),
                    'FechaFin'=> $this->input->get_post('POR_FECHA_FF'),
                    'tipo'=>'Ingreso Enfermería Observación'
                ));
            }else{
                $sql['Gestion']=$this->FiltroEnfemeriaEmpleadosFecha(array(
                    'FechaInicio'=> $this->input->get_post('POR_FECHA_FI'),
                    'FechaFin'=> $this->input->get_post('POR_FECHA_FF'),
                    'tipo'=>'Egreso Enfermería Observación'
                ));
            }
        }else{
            if($this->input->get_post('TIPO')=='Ingreso Enfermería Observación'){
                $sql['Gestion']=$this->FiltroEnfemeriaEmpleadosHora(array(
                    'FechaInicio'=> $this->input->get_post('POR_HORA_FI'),
                    'HoraInicio'=> $this->input->get_post('POR_HORA_HI'),
                    'HoraFin'=> $this->input->get_post('POR_HORA_HF'),
                    'tipo'=>'Ingreso Enfermería Observación'
                ));
            }else{
                $sql['Gestion']=$this->FiltroEnfemeriaEmpleadosHora(array(
                    'FechaInicio'=> $this->input->get_post('POR_HORA_FI'),
                    'HoraInicio'=> $this->input->get_post('POR_HORA_HI'),
                    'HoraFin'=> $this->input->get_post('POR_HORA_HF'),
                    'tipo'=>'Egreso Enfermería Observación'
                ));
            }
        }
        $this->load->view('Indicador/EnfermeriaEmpleados',$sql);
    }
    public function EnfermeriaPacientes() {
        if($this->input->get_post('TIPO_BUSQUEDA')=='POR_FECHA'){
            $sql['Gestion']=$this->FiltroEnfemeriaPacientesFecha(array(
                'FechaInicio'=> $this->input->get_post('POR_FECHA_FI'),
                'FechaFin'=> $this->input->get_post('POR_FECHA_FF'),
                'tipo'=> $this->input->get_post('TIPO'),
                'empleado'=> $this->input->get_post('EMPLEADO')
            ));
        }else{
            $sql['Gestion']=$this->FiltroEnfemeriaPacientesHora(array(
                'FechaInicio'=> $this->input->get_post('POR_HORA_FI'),
                'HoraInicio'=> $this->input->get_post('POR_HORA_HI'),
                'HoraFin'=> $this->input->get_post('POR_HORA_HF'),
                'tipo'=> $this->input->get_post('TIPO'),
                'empleado'=> $this->input->get_post('EMPLEADO')
            ));
        }
        $this->load->view('Indicador/EnfermeriaPacientes',$sql);
    }
    //MODULES SQL
    public function FiltroEnfemeriaFecha($data) {
        $FECHA_I=$data['FechaInicio'];
        $FECHA_F=$data['FechaFin'];
        $TIPO=$data['tipo'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_observacion, os_empleados
                                            WHERE
                                            os_accesos.acceso_tipo='$TIPO' AND
                                            os_accesos.acceso_fecha BETWEEN '$FECHA_I' AND '$FECHA_F' AND
                                            os_accesos.triage_id=os_triage.triage_id AND
                                            os_accesos.areas_id=os_observacion.observacion_id AND
                                            os_observacion.observacion_crea=os_empleados.empleado_id");
    }
    public function FiltroEnfemeriaHora($data) {
        $FECHA=$data['FechaInicio'];
        $HORA_I=$data['HoraInicio'];
        $HORA_F=$data['HoraFin'];
        $TIPO=$data['tipo'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_observacion, os_empleados
                                            WHERE
                                            os_accesos.acceso_tipo='$TIPO' AND
                                            os_accesos.acceso_fecha='$FECHA' AND
                                            os_accesos.acceso_hora BETWEEN '$HORA_I' AND '$HORA_F' AND
                                            os_accesos.triage_id=os_triage.triage_id AND
                                            os_accesos.areas_id=os_observacion.observacion_id AND
                                            os_observacion.observacion_crea=os_empleados.empleado_id");
    }
    public function FiltroEnfemeriaEmpleadosFecha($data) {
        $FECHA_I=$data['FechaInicio'];
        $FECHA_F=$data['FechaFin'];
        $TIPO=$data['tipo'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_observacion, os_empleados
                                            WHERE
                                            os_accesos.acceso_tipo='$TIPO' AND
                                            os_accesos.acceso_fecha BETWEEN '$FECHA_I' AND '$FECHA_F' AND
                                            os_accesos.triage_id=os_triage.triage_id AND
                                            os_accesos.areas_id=os_observacion.observacion_id AND
                                            os_observacion.observacion_crea=os_empleados.empleado_id GROUP BY os_empleados.empleado_id");
    }
    public function FiltroEnfemeriaEmpleadosHora($data) {
        $FECHA=$data['FechaInicio'];
        $HORA_I=$data['HoraInicio'];
        $HORA_F=$data['HoraFin'];
        $TIPO=$data['tipo'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_observacion, os_empleados
                                            WHERE
                                            os_accesos.acceso_tipo='$TIPO' AND
                                            os_accesos.acceso_fecha='$FECHA' AND
                                            os_accesos.acceso_hora BETWEEN '$HORA_I' AND '$HORA_F' AND
                                            os_accesos.triage_id=os_triage.triage_id AND
                                            os_accesos.areas_id=os_observacion.observacion_id AND
                                            os_observacion.observacion_crea=os_empleados.empleado_id GROUP BY os_empleados.empleado_id");
    }
    public function FiltroEnfemeriaPacientesFecha($data) {
        $FECHA_I=$data['FechaInicio'];
        $FECHA_F=$data['FechaFin'];
        $TIPO=$data['tipo'];
        $EMPLEADO=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_observacion, os_empleados
                                            WHERE
                                            os_accesos.acceso_tipo='$TIPO' AND
                                            os_accesos.acceso_fecha BETWEEN '$FECHA_I' AND '$FECHA_F' AND
                                            os_accesos.triage_id=os_triage.triage_id AND
                                            os_accesos.areas_id=os_observacion.observacion_id AND
                                            os_observacion.observacion_crea=os_empleados.empleado_id AND os_empleados.empleado_id=$EMPLEADO");
    }
    public function FiltroEnfemeriaPacientesHora($data) {
        $FECHA=$data['FechaInicio'];
        $HORA_I=$data['HoraInicio'];
        $HORA_F=$data['HoraFin'];
        $TIPO=$data['tipo'];
        $EMPLEADO=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_observacion, os_empleados
                                            WHERE
                                            os_accesos.acceso_tipo='$TIPO' AND
                                            os_accesos.acceso_fecha='$FECHA' AND
                                            os_accesos.acceso_hora BETWEEN '$HORA_I' AND '$HORA_F' AND
                                            os_accesos.triage_id=os_triage.triage_id AND
                                            os_accesos.areas_id=os_observacion.observacion_id AND
                                            os_observacion.observacion_crea=os_empleados.empleado_id AND os_empleados.empleado_id=$EMPLEADO");
    }
}
