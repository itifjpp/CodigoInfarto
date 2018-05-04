<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accesos
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Registros extends Config{
    public function index() {
        $this->load->view('Registros/index');
    }
    public function AjaxRegistros() {
        if($this->input->post('acceso_fecha')==''){
            $acceso_fecha= date('d/m/Y');
        }else{
            $acceso_fecha= $this->input->post('acceso_fecha');
        }
        $sql= $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage
            WHERE os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.acceso_fecha='$acceso_fecha' ORDER BY acceso_id DESC");
        if(!empty($sql)){
            foreach ($sql as $value) {
                $tr.='  <tr>
                            <td>'.$value['acceso_id'].'</td>
                            <td>'.$value['acceso_tipo'].'</td>
                            <td>'.$value['acceso_fecha'].' '.$value['acceso_hora'].'</td>
                            <td>'.$value['acceso_turno'].'</td>
                            <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                        </tr>';
            }
        }else{
            $tr.='  <tr>
                        <td colspan="5">NO SE ECONTRARÓN REGISTROS PARA ESTA FECHA</td>
                    </tr>';
        }
        $this->setOutput(array('tr'=>$tr));
    }
}
