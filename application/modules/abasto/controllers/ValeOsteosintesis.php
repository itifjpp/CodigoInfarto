<?php

/**
 * Description of ValeOsteosintesis
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class ValeOsteosintesis extends Config{
    public function index() {
        if($_GET['show']=='Sistemas'){
            $sql['Gestion']= $this->config_mdl->sqlGetData('abs_sistemas');
        }else if($_GET['show']=='Elementos'){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM abs_sistemas AS s
                                                        INNER JOIN abs_elementos e on s.sistema_id=e.sistema_id 
                                                        WHERE s.sistema_id=".$this->input->get('sistema'));
        }else if($_GET['show']=='Rangos'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas AS s
                                                    INNER JOIN abs_elementos e on s.sistema_id=e.sistema_id 
                                                    INNER JOIN abs_rangos r on r.elemento_id=e.elemento_id 
                                                    WHERE e.elemento_id=".$_GET['elemento']);
        }
        $this->load->view('ValesOsteosintesis/index',$sql);
    }
    public function AjaxSolicitud() {
        $sqlInventario= $this->config_mdl->sqlGetDataCondition('abs_inventario',array(
            'inventatop_tipo'=>'Agregado',
            'rango_id'=> $this->input->post('rango_id')
        ));
        $CantidadSolicitada= $this->input->post('cantidad_solicitada');
        $Existencia=count($sqlInventario);
        $NuevaSolicutud=0;
        $sqlSolicitud= $this->config_mdl->sqlGetDataCondition('abs_vale_solicitud',array(
            'rango_id'=> $this->input->post('rango_id'),
            'procedimiento_id'=> $this->input->post('procedimiento_id')
        ));
        if($CantidadSolicitada>$Existencia){
            $NuevaSolicutud=$CantidadSolicitada-$Existencia;
            for ($i = 0; $i < $NuevaSolicutud; $i++) {
                $this->config_mdl->sqlInsert('abs_inventario',array(
                    'entrega_id'=>0,
                    'inventario_fecha'=> date('Y-m-d H:i:s'),
                    'inventatop_tipo'=>'Solicitado',
                    'empleado_id'=> $this->UMAE_USER,
                    'inventario_status'=>'false',
                    'vale_servicio_id'=>0,
                    'procedimiento_id'=> $this->input->post('procedimiento_id'),
                    'procedimiento_status'=>'SIN ASIGNAR',
                    'rango_id'=> $this->input->post('rango_id')
                ));
            }
            $vale_cantidad=$CantidadSolicitada;
        }else{
            $vale_cantidad=$CantidadSolicitada+$sqlSolicitud[0]['vale_cantidad'];
            if($vale_cantidad>$Existencia){
                for ($i = 0; $i < $CantidadSolicitada; $i++) {
                    $this->config_mdl->sqlInsert('abs_inventario',array(
                        'entrega_id'=>0,
                        'inventario_fecha'=> date('Y-m-d H:i:s'),
                        'inventatop_tipo'=>'Solicitado',
                        'empleado_id'=> $this->UMAE_USER,
                        'inventario_status'=>'false',
                        'vale_servicio_id'=>0,
                        'procedimiento_id'=> $this->input->post('procedimiento_id'),
                        'procedimiento_status'=>'SIN ASIGNAR',
                        'rango_id'=> $this->input->post('rango_id')
                    ));
                }
            }
            $NuevaSolicutud=$CantidadSolicitada-$CantidadSolicitada;
        }
        
        if(empty($sqlSolicitud)){
            $this->config_mdl->sqlInsert('abs_vale_solicitud',array(
                'vale_fecha'=> date('Y-m-d H:i:s'),
                'rango_id'=> $this->input->post('rango_id'),
                'vale_cantidad'=> $this->input->post('cantidad_solicitada'),
                'procedimiento_id'=> $this->input->post('procedimiento_id')
            ));
        }else{
            $this->config_mdl->sqlUpdate('abs_vale_solicitud',array(
                'vale_cantidad'=> $vale_cantidad
            ),array(
                'procedimiento_id'=> $this->input->post('procedimiento_id'),
                'rango_id'=> $this->input->post('rango_id')
            ));
        }
        $this->setOutput(array('Cantidad a Solicitar'=>$NuevaSolicutud));
    }
    public function AjaxEliminarSolicitud() {
        $this->config_mdl->sqlDelete('abs_vale_solicitud',array(
            'procedimiento_id'=> $this->input->post('procedimiento_id'),
            'rango_id'=> $this->input->post('rango_id')
        ));
        $this->config_mdl->sqlDelete('abs_inventario',array(
            'inventatop_tipo'=>'Solicitado',
            'procedimiento_id'=> $this->input->post('procedimiento_id'),
            'rango_id'=> $this->input->post('rango_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxFinalizar() {
        $this->config_mdl->sqlUpdate('os_observacion_tratamientos',array(
            'tratamiento_vale_servicio'=>'Finalizado',
            'tratamiento_f_vs'=> date('Y-m-d'),
            'tratamiento_h_vs'=> date('H:i:s')
        ),array(
            'tratamiento_id'=> $this->input->post('tratamiento_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
