<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jefa
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Jefa extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('JefaAsistentesMedicas');
    }
    /*SQL*/
    public function Ajax43029(){
        $inputTurno= $this->input->post('inputTurno');
        $inputFecha= $this->input->post('inputFecha');
        $Ingresos=0;
        $Egresos=0;
        if($inputTurno=='Noche'){
            $IngresosN1=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43029 AS doc WHERE doc.doc_turno='Noche A' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Ingreso'"));
            $IngresosN2=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43029 AS doc WHERE doc.doc_turno='Noche B' AND doc.doc_fecha= DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND doc.doc_tipo='Ingreso'"));
            
            $EgresosN1=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43029 AS doc WHERE doc.doc_turno='Noche A' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Egreso'"));
            $EgresosN2=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43029 AS doc WHERE doc.doc_turno='Noche B' AND doc.doc_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND doc.doc_tipo='Egreso'"));
            
            $Ingresos=$IngresosN1+$IngresosN2;
            $Egresos=$EgresosN1+$EgresosN2;
        }else{
            $Ingresos=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43029 AS doc WHERE doc.doc_turno='$inputTurno' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Ingreso'"));
            $Egresos=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43029 AS doc WHERE doc.doc_turno='$inputTurno' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Egreso'"));
        }
        $this->setOutput(array('Ingresos'=>$Ingresos,'Egresos'=>$Egresos));
    }

    public function Ajax43021(){
        $inputTurno= $this->input->post('inputTurno');
        $inputFecha= $this->input->post('inputFecha');
        $Ingresos=0;
        $Egresos=0;
        if($inputTurno=='Noche'){
            $IngresosN1=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43021 AS doc WHERE doc.doc_turno='Noche A' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Ingreso'"));
            $IngresosN2=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43021 AS doc WHERE doc.doc_turno='Noche B' AND doc.doc_fecha= DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND doc.doc_tipo='Ingreso'"));
            
            $EgresosN1=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43021 AS doc WHERE doc.doc_turno='Noche A' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Egreso'"));
            $EgresosN2=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43021 AS doc WHERE doc.doc_turno='Noche B' AND doc.doc_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND doc.doc_tipo='Egreso'"));
            
            $Ingresos=$IngresosN1+$IngresosN2;
            $Egresos=$EgresosN1+$EgresosN2;
        }else{
            $Ingresos=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43021 AS doc WHERE doc.doc_turno='$inputTurno' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Ingreso'"));
            $Egresos=count($this->config_mdl->sqlQuery("SELECT doc.doc_id FROM sigh_doc43021 AS doc WHERE doc.doc_turno='$inputTurno' AND doc.doc_fecha='$inputFecha' AND doc.doc_tipo='Egreso'"));
        }
        $this->setOutput(array('Ingresos'=>$Ingresos,'Egresos'=>$Egresos));
    }
}
