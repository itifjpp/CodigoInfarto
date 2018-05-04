<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Horacero
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Horacero extends Config{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('horacero/index');
    }
    public function GenerarTicket($folio) {
        $sql['info']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=>  $folio
        ))[0];
        $this->load->view('horacero/GenerarTicket',$sql);
    }
    public function Indicador() {
        $this->load->view('horacero/indicador');
    }
    
    //Datos
    public function GenerarFolio() {
        $data=array(
            'ingreso_tipopaciente'=>'Identificado',
            'ingreso_en'=> 'Hora Cero',
            'ingreso_en_status'=>'Ingreso',
            'ingreso_date_horacero'=>  date('Y-m-d'),
            'ingreso_time_horacero'=>  date('H:i'),
            'ingreso_horacero_id'=> $this->UMAE_USER,
            'ingreso_acceder'=>'No Validado',
            'ingreso_valida_nss'=>'No',
            'hospital_id'=> $this->sigh->getInfo('hospital_id'),
            
        );
        $this->config_mdl->sqlInsert('sigh_pacientes_ingresos',$data);
        $last_id=  $this->config_mdl->sqlGetLastId('sigh_pacientes_ingresos','ingreso_id');
        $this->config_mdl->sqlInsert('sigh_pacientes_info_ing',array(
            'ingreso_id'=>$last_id
        ));

        $this->logAccesos(array('acceso_tipo'=>'Hora Cero','ingreso_id'=>$last_id,'areas_id'=>$last_id));
        $this->setOutput(array('accion'=>'1','max_id'=>$last_id));
    }
    public function AjaxIndicador() {
        $UMAE_USER=$_SESSION['UMAE_USER'];
        $inputFecha= $this->input->post('inputFecha');
        if($this->input->post('inputTurno')=='Mañana'){
            $sql=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero='$inputFecha' AND ing.ingreso_time_horacero BETWEEN '07:00:00' AND '13:59:59'");
            $sql2=NULL;
        }if($this->input->post('inputTurno')=='Tarde'){
            $sql=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero='$inputFecha' AND ing.ingreso_time_horacero BETWEEN '14:00:00' AND '20:59:59'");
            $sql2=NULL;
        }if($this->input->post('inputTurno')=='Noche'){
            $sql=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero='$inputFecha' AND ing.ingreso_time_horacero BETWEEN '21:00:00' AND '23:25:59'");
            
            $sql2=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND ing.ingreso_time_horacero BETWEEN '00:00:00' AND '06:59:59'");
        }
        if(!empty($sql) || !empty($sql2)){
            foreach ($sql as $value) {
                $tr.=' <tr>
                            <td>'.$value['ingreso_id'].'</td>
                            <td>'.$value['ingreso_date_horacero'].'</td>
                            <td>'.$value['ingreso_time_horacero'].'</td>
                       </tr>';
            }
            foreach ($sql2 as $value) {
                $tr.=' <tr>
                            <td>'.$value['ingreso_id'].'</td>
                            <td>'.$value['ingreso_date_horacero'].'</td>
                            <td>'.$value['ingreso_time_horacero'].'</td>
                       </tr>';
            }
        }else{
            $tr.=' <tr>
                            <td colspan="3">NO HAY REGISTROS</td>
                       </tr>';
        }
        $total= count($sql)+ count($sql2);
        $this->setOutput(array('tr'=>$tr,'total'=>$total));
    }
}
