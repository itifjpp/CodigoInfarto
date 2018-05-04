<?php

/**
 * Description of Hospitales
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Hospitales extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('um_hospitales',array(
            'empleado_id'=> $this->UMAE_USER
        )); 
        $this->load->view('Hospitales/Hospitales',$sql);
    }
    public function AjaxHospitales() {
       
        $data=array(
            'hospital_nombre'=> $this->input->post('hospital_nombre'),
            'hospital_direccion'=> $this->input->post('hospital_direccion'),
            'empleado_id'=> $this->UMAE_USER
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('um_hospitales',$data);
        }else{
            $this->config_mdl->sqlUpdate('um_hospitales',$data,array(
                'hospital_id'=> $this->input->post('hospital_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function Reportes() {
        $Hospital=$_GET['hos'];
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('um_hospitales_status',array(
            'hospital_id'=>$Hospital
        ));
        $this->load->view('Hospitales/HospitalesStatus',$sql);
    }
    public function ReportesAdd() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_hospitales_status',array(
            'status_id'=>$_GET['st']
        ))[0];
        $this->load->view('Hospitales/HospitalesStatusAdd',$sql);
    }
    public function AjaxReportesAdd() {
        $data=array(
            's1_camas_hospitalacion'=> $this->input->post('s1_camas_hospitalacion'),
            's1_camas_adultos'=> $this->input->post('s1_camas_adultos'),
            's1_camas_adultos_quemados'=> $this->input->post('s1_camas_adultos_quemados'),
            's1_camas_pediatria'=> $this->input->post('s1_camas_pediatria'),
            's1_cunas'=> $this->input->post('s1_cunas'),
            's1_cunas_quemados'=> $this->input->post('s1_cunas_quemados'),
            's1_camas_terapia_intensiva'=> $this->input->post('s1_camas_terapia_intensiva'),
            's1_espacios_urgencias'=> $this->input->post('s1_espacios_urgencias'),
            's2_total_derechohabiente'=> $this->input->post('s2_total_derechohabiente'),
            's2_derechohabiente'=> $this->input->post('s2_derechohabiente'),
            's2_noderechohabiente'=> $this->input->post('s2_noderechohabiente'),
            's3_defunciones_no_sismo'=> $this->input->post('s3_defunciones_no_sismo'),
            's3_defunciones_si_sismo'=> $this->input->post('s3_defunciones_si_sismo'),
            's4_daños'=> $this->input->post('s4_daños'),
            's4_daños_comentarios'=> $this->input->post('s4_daños_comentarios'),
            's5_camas_ocupadas'=> $this->input->post('s5_camas_ocupadas'),
            's6_paquetas_globulares'=> $this->input->post('s6_paquetas_globulares'),
            's6_plasmas'=> $this->input->post('s6_plasmas'),
            's6_envios'=> $this->input->post('s6_envios'),
            's6_recibidos'=> $this->input->post('s6_recibidos'),
            's6_comentarios'=> $this->input->post('s6_comentarios'),
            's7_analisis_necesidades_pro'=> $this->input->post('s7_analisis_necesidades_pro'),
            's7_analisis_necesidades'=> $this->input->post('s7_analisis_necesidades'),
            's6_egreso_total'=> $this->input->post('s6_egreso_total'),
            's6_egreso_hospitalizacion'=> $this->input->post('s6_egreso_hospitalizacion'),
            's6_egreso_traslado'=> $this->input->post('s6_egreso_traslado'),
            's6_egreso_defuncion'=> $this->input->post('s6_egreso_defuncion'),
            's6_egreso_domicilio'=> $this->input->post('s6_egreso_domicilio'),
            's6_egreso_comentarios'=> $this->input->post('s6_egreso_comentarios'),
            's9_abasto_porcentaje'=> $this->input->post('s9_abasto_porcentaje'),
            's9_abasto_dias'=> $this->input->post('s9_abasto_dias'),
            's9_abasto_comentarios'=> $this->input->post('s9_abasto_comentarios'),
            's9_ventiladores'=> $this->input->post('s9_ventiladores'),
            's9_sala_quirofanos'=> $this->input->post('s9_sala_quirofanos'),
            's9_red_fria'=> $this->input->post('s9_red_fria'),
            's10_tomografia'=> $this->input->post('s10_tomografia'),
            's10_resonador'=> $this->input->post('s10_resonador'),
            's10_rayos_x'=> $this->input->post('s10_rayos_x'),
            's10_hemocomponentes'=> $this->input->post('s10_hemocomponentes'),
            's10_ventiladores'=> $this->input->post('s10_ventiladores'),
            's10_desfibriladores'=> $this->input->post('s10_desfibriladores'),
            's11_elevadores'=> $this->input->post('s11_elevadores'),
            's11_suministro_de_luz'=> $this->input->post('s11_suministro_de_luz'),
            's11_planta_de_luz'=> $this->input->post('s11_planta_de_luz'),
            's11_combustible_planta_de_luz'=> $this->input->post('s11_combustible_planta_de_luz'),
            's11_tanque_termo_oxigeno'=> $this->input->post('s11_tanque_termo_oxigeno'),
            's11_generador_de_vapor'=> $this->input->post('s11_generador_de_vapor'),
            'status_fecha'=> $this->input->post('status_fecha'),
            'status_hora'=> $this->input->post('status_hora'),
            'status_turno'=> $this->ObtenerTurno(),
            'hospital_id'=> $this->input->post('hospital_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('um_hospitales_status',$data);
        }else{
            $this->config_mdl->sqlUpdate('um_hospitales_status',$data,array(
                'status_id'=> $this->input->post('status_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function ReporteGeneral() {
        if(isset($_GET['inputFecha'])){
            $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('um_hospitales_status',array(
                'status_fecha'=>$_GET['inputFecha'],
                'status_hora'=>$_GET['inputHora'],
            ));
            
        }else{
            $sql['Gestion']=NULL;
        }
        $this->load->view('Hospitales/HospitalesRG',$sql);
    }
    public function Graficas() {

        $sqlAll_Mañana= $this->sqlAll('2017-09-21', '08:00', $_GET['hos']);
        $sqlAll_Tarde= $this->sqlAll('2017-09-21', '15:00', $_GET['hos']);
        $sqlAll_Noche= $this->sqlAll('2017-09-21', '21:00', $_GET['hos']);
        
        $TotalCamas_Mañana=$sqlAll_Mañana['s1_camas_hospitalacion'];
        $TotalCamas_Tarde=$sqlAll_Tarde['s1_camas_hospitalacion'];
        $TotalCamas_Noche=$sqlAll_Noche['s1_camas_hospitalacion'];
        $TotalAdmisionDH_M=$sqlAll_Mañana['s2_noderechohabiente'];
        $TotalAdmisionDH_T=$sqlAll_Tarde['s2_noderechohabiente'];
        $TotalAdmisionDH_N=$sqlAll_Noche['s2_noderechohabiente'];
        $DefuncionesConElSismo_M=$sqlAll_Mañana['s3_defunciones_si_sismo'];
        $DefuncionesConElSismo_T= $sqlAll_Tarde['s3_defunciones_si_sismo'];
        $DefuncionesConElSismo_N= $sqlAll_Noche['s3_defunciones_si_sismo'];
        $CamasOcupadas_M=$sqlAll_Mañana['s5_camas_ocupadas'];
        $CamasOcupadas_T=$sqlAll_Tarde['s5_camas_ocupadas'];
        $CamasOcupadas_N=$sqlAll_Noche['s5_camas_ocupadas'];
        $data=array(
            'TotalCamas_Mañana'=>$TotalCamas_Mañana,
            'TotalCamas_Tarde'=>$TotalCamas_Tarde,
            'TotalCamas_Noche'=>$TotalCamas_Noche,
            'TotalAdmisionDH_M'=>$TotalAdmisionDH_M,
            'TotalAdmisionDH_T'=>$TotalAdmisionDH_T,
            'TotalAdmisionDH_N'=>$TotalAdmisionDH_N,
            'DefuncionesConElSismo_M'=>$DefuncionesConElSismo_M,
            'DefuncionesConElSismo_T'=>$DefuncionesConElSismo_T,
            'DefuncionesConElSismo_N'=>$DefuncionesConElSismo_N,
            'CamasOcupadas_M'=>$CamasOcupadas_M,
            'CamasOcupadas_T'=>$CamasOcupadas_T,
            'CamasOcupadas_N'=>$CamasOcupadas_N,
            'Egresos_M'=>$sqlAll_Mañana['s6_egreso_total'],
            'Egresos_T'=>$sqlAll_Tarde['s6_egreso_total'],
            'Egresos_N'=>$sqlAll_Noche['s6_egreso_total'],
        );
        $this->load->view('Hospitales/HospitalesRChart',$data);
    }
    public function sqlAll($Fecha,$Turno,$Hos) {
        '<option value="Naucalpan de Juárez;San Rafael Chamapa (Tabiquera 1);Poetas Mexiquenses ( Tabiquera 10 )">Naucalpan de Juárez</option>';
        
        
        
        return $this->config_mdl->sqlQuery("SELECT * FROM um_hospitales_status WHERE  
                                            um_hospitales_status.status_turno='$Turno' AND
                                            um_hospitales_status.hospital_id=$Hos")[0];
        
    }
    public function ReporteGeneralCharts() {
        $this->load->view('Hospitales/HospitalesRGChart');
    }
}
