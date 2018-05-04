<?php

/**
 * Description of Movil
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Movil extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('Movil');
    }
    public function GenerarFolio() {
        $data=array(
            'ingreso_tipopaciente'=>'Identificado',
            'ingreso_en'=> 'Hora Cero',
            'ingreso_en_status'=>'Ingreso',
            'ingreso_time_horacero'=>  date('Y-m-d'),
            'ingreso_date_horacero'=>  date('H:i'),
            'ingreso_horacero_id'=> 1,
            'ingreso_valida_nss'=>'No',
            'hospital_id'=> $this->sigh->getInfo('hospital_id')
        );
        $this->config_mdl->sqlInsert('sigh_pacientes_ingresos',$data);
        $last_id=  $this->config_mdl->sqlGetLastId('sigh_pacientes_ingresos','ingreso_id');
        $this->config_mdl->sqlInsert('sigh_pacientes_info_ing',array(
            'ingreso_id'=>$last_id
        ));
        
        $this->logAccesos(array('acceso_tipo'=>'Hora Cero','ingreso_id'=>$last_id,'areas_id'=>0));
        $this->setOutput(array('accion'=>'1','max_id'=>$last_id));
        file_put_contents("assets/AutoPrint.txt",$last_id);
        $this->setOutput(array(
            'accion'=>'1','max_id'=>$last_id
        ));
    }
    public function GenerarTicket($folio) {
        $sql['info']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=>  $folio
        ))[0];
        $this->load->view('horacero/MovilTicket',$sql);
    }
}
