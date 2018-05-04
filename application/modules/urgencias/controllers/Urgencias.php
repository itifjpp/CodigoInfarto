<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Urgencias
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Urgencias extends Config{
    public function __construct() {
        parent::__construct();
        $this->VerificarSession();
    }
    public function Areas() {
        $this->load->view('pisos/Camas/GestionCamas');
    }
    public function GestionCamasOC() {
        $this->load->view('Camas/GestionCamasOC');
    }
    public function getCamasPorStatus($info) {
        $Status=$info['status'];
        return count($this->config_mdl->sqlQuery("SELECT c.*,a.area_id FROM os_camas AS c, os_areas AS a WHERE 
                                                        c.area_id=a.area_id AND a.area_modulo IN ('Observación','Choque') AND
                                                        c.cama_status='$Status' AND c.cama_display<=>NULL"));
    }
    public function GestionCamasPisos() {
        $this->load->view('Camas/GestionCamasPisos');
    }
    public function getCamasStatusPisos($info) {
        $Piso=$info['piso'];
        $Status=$info['status'];
        return count($this->config_mdl->sqlQuery("SELECT * FROM os_camas AS c, os_pisos_camas AS pc, os_pisos as p
                                                    WHERE c.cama_id=pc.cama_id AND pc.piso_id=p.piso_id AND 
                                                    p.piso_id=$Piso AND c.cama_status='$Status' AND c.cama_display<=>NULL"));
    }
    public function DxCIE10(){
        if($_GET['dxDateStart']){
            $dxDateStart=$_GET['dxDateStart'];
            $dxDateEnd=$_GET['dxDateEnd'];
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT cie.id10,cie.dec10, dx.dx_dx, COUNT(*) as Total FROM sigh_cie10 AS cie, sigh_pacientes_dx AS dx
                                            WHERE dx.dx_fecha BETWEEN '$dxDateStart' AND '$dxDateEnd' AND dx.cie10_n4=cie.id10 GROUP BY dx.cie10_n4 ORDER BY Total DESC LIMIT 10");
        }else{
            $dxDateStart= date('Y-m-d');
            $dxDateEnd=date('Y-m-d');
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT cie.id10,cie.dec10, dx.dx_dx, COUNT(*) as Total FROM sigh_cie10 AS cie, sigh_pacientes_dx AS dx
                                            WHERE dx.dx_fecha BETWEEN '$dxDateStart' AND '$dxDateEnd' AND dx.cie10_n4=cie.id10 GROUP BY dx.cie10_n4 ORDER BY Total DESC LIMIT 10");
        }
        
        
        $this->load->view('Dx/index',$sql);
    }
    public function TiempoAsignacionCamas() {
        $startDate=$_GET['acDateStart'];
        $endDate=$_GET['acDateEnd'];
        if(isset($_GET['acDateStart'])){
            $sql= $this->config_mdl->sqlQuery("SELECT * FROM os_observacion AS obs,doc_43051 AS doc WHERE
                                                obs.triage_id=doc.triage_id AND doc.ac_fecha BETWEEN '$startDate' AND '$endDate'");

            $Total=0;
            $sqlTotal= count($sql);
            foreach ($sql as $value) {
                $fechaObs=$value['observacion_fs'].' '.$value['observacion_hs'];
                $fechaDoc=$value['ac_fecha'];
                $Diff= $this->CalcularTiempoTranscurrido(array(
                    'Tiempo1'=>$fechaObs,
                    'Tiempo2'=>$fechaDoc
                ));
                $Day=$Diff->d*24*60;
                $Time=$Diff->h*60 + $Diff->i+$Day;
                $Total=$Time+$Total;
            }
            $sql['Tiempo']=$Total/$sqlTotal;
        }else{
            $sql['Tiempo']=0;
        } 
        $sql['Pacientes']=$sqlTotal;
        $this->load->view('Camas/TiempoAsignacionCama',$sql);
        
    }
}
 