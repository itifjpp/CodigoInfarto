<?php

/**
 * Description of Interconsultas
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Interconsultas extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am , ing.ingreso_clasificacion, 
            doc.doc_estatus, doc.doc_fecha, doc.doc_hora, doc.doc_fecha_r, doc.doc_hora_r, doc.doc_estatus,
            emp.empleado_nombre, emp.empleado_ap, emp.empleado_am,doc.doc_servicio_solicitado
            FROM sigh_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc, sigh_empleados AS emp WHERE ing.paciente_id=pac.paciente_id AND ing.ingreso_id=doc.ingreso_id AND emp.empleado_id=doc.empleado_envia");
        $this->load->view('Interconsultas/index',$sql);
    }
}
