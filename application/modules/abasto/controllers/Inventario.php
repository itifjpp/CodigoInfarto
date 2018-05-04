<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inventario
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Inventario extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_get_data('abs_catalogos');
        $this->load->view('Inventario/CatalogosIndex',$sql);
    }
    public function Sistemas() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas");
        $this->load->view('Inventario/SistemasIndex',$sql);
    }
    public function Elementos() {
        $sql['sistema']= $this->config_mdl->_get_data_condition('abs_sistemas',array(
            'sistema_id'=>$_GET['sistema']
        ))[0];
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas, abs_elementos WHERE 
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_sistemas.sistema_id=".$_GET['sistema']);
        $this->load->view('Inventario/ElementosIndex',$sql);
    }
     public function Rangos() {
        $sql['sistema']= $this->config_mdl->_get_data_condition('abs_sistemas',array(
            'sistema_id'=>$_GET['sistema']
        ))[0];
        $sql['elemento']= $this->config_mdl->_get_data_condition('abs_elementos',array(
            'elemento_id'=>$_GET['elemento']
        ))[0];
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROMabs_sistemas, abs_elementos, abs_rangos WHERE
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_elementos.elemento_id=abs_rangos.elemento_id AND
            abs_elementos.elemento_id=".$_GET['elemento']);
        $this->load->view('Inventario/RangosIndex',$sql);
    }
    public function AjaxAgregarExistencia() {
        for ($i = 0; $i < $this->input->post('existencia_id'); $i++) {
            $this->config_mdl->_insert('abs_rangos_existencia',array(
                'existencia_status'=>'Disponible',
                'rango_id'=> $this->input->post('rango_id'),
                'elemento_id'=> $this->input->post('elemento_id'),
                'sistema_id'=> $this->input->post('sistema_id'),
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function Exitencia() {
        $sql['sistema']= $this->config_mdl->_get_data_condition('abs_sistemas',array(
            'sistema_id'=>$_GET['sistema']
        ))[0];
        $sql['elemento']= $this->config_mdl->_get_data_condition('abs_elementos',array(
            'elemento_id'=>$_GET['elemento']
        ))[0];
        $sql['rango']= $this->config_mdl->_get_data_condition('abs_rangos',array(
            'rango_id'=>$_GET['rango']
        ))[0];
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas, abs_elementos, abs_rangos, abs_rangos_existencia WHERE
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_elementos.elemento_id=abs_rangos.elemento_id AND
            abs_rangos_existencia.rango_id=abs_rangos.rango_id AND
            abs_rangos.rango_id=".$_GET['rango']);
        $this->load->view('Inventario/RangosExistencia',$sql);
    }
    public function GenerarCodigo($Existencia) {
        $sql['info']= $this->config_mdl->_get_data_condition('abs_rangos_existencia',array(
            'existencia_id'=>$Existencia
        ))[0];
        $this->load->view('Inventario/GenerarCodigo',$sql);
    }
    public function RelaciondeSalidas() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM os_empleados AS em, abs_reporte_consumo AS rc WHERE
                                                        em.empleado_id=rc.arsenal_id ORDER BY rc.rc_id DESC");
        $this->load->view('Inventario/RelaciondeSalidas',$sql);
    }
    public function NuevaRelaciondeSalida() {
        $sql= $this->config_mdl->sqlGetDataCondition('abs_reporte_consumo',array(
            'rc_temp'=>$_GET['temp']
        ));
        if(empty($sql)){
            $this->config_mdl->sqlInsert('abs_reporte_consumo',array(
                'rc_fecha'=> date('Y-m-d'),
                'rc_hora'=> date('H:i:i'),
                'rc_temp'=>$_GET['temp'],
                'rc_status'=>'En Espera',
                'arsenal_id'=> $this->UMAE_USER
            ));
            $sqlLastId= $this->config_mdl->sqlGetLastId('abs_reporte_consumo','rc_id');
        }else{
            $sqlLastId=$sql[0]['rc_id'];
        }
        $sql['LastId']=$sqlLastId;
        $sql['Gestion']= $this->config_mdl->sqlQuery('SELECT sis.sistema_titulo, ele.elemento_titulo, ran.rango_titulo, inv.inventario_id FROM abs_sistemas AS sis, abs_elementos AS ele, abs_rangos AS ran, abs_inventario AS inv,
                                                        abs_reporte_consumo AS rc, abs_reporte_consumo_in rc_in
                                                        WHERE
                                                        sis.sistema_id=ele.sistema_id AND ele.elemento_id=ran.elemento_id AND
                                                        ran.rango_id=inv.rango_id AND 
                                                        inv.inventario_id=rc_in.inventario_id AND 
                                                        rc.rc_id=rc_in.rc_id AND rc.rc_id='.$sqlLastId);
        $this->load->view('Inventario/NuevaRelaciondeSalida',$sql);
    }
    public function AjaxCheckExistencia() {
        $sql= $this->config_mdl->sqlGetDataCondition('abs_inventario',array(
            'inventario_id'=> $this->input->post('inventario_id')
        ));
        if(!empty($sql)){
            if($sql[0]['inventario_status']=='Disponible'){
                $this->config_mdl->sqlInsert('abs_reporte_consumo_in',array(
                    'consumo_status'=>'Sin Ocupar',
                    'inventario_id'=> $this->input->post('inventario_id'),
                    'rc_id'=> $this->input->post('rc_id')
                ));
                $this->config_mdl->sqlUpdate('abs_inventario',array(
                    'inventario_status'=> 'Asignado'
                ),array(
                    'inventario_id'=> $this->input->post('inventario_id')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'3'));
            }
            
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxEliminaRCIN() {
        $this->config_mdl->sqlUpdate('abs_inventario',array(
            'inventario_status'=> 'Disponible'
        ),array(
            'inventario_id'=> $this->input->post('inventario_id')
        ));
        $this->config_mdl->sqlDelete('abs_reporte_consumo_in',array(
           'inventario_id'=> $this->input->post('inventario_id') 
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function DevolucionMateriales() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT sis.sistema_titulo, ele.elemento_titulo, ran.rango_titulo, inv.inventario_id FROM abs_sistemas AS sis, abs_elementos AS ele, abs_rangos AS ran, abs_inventario AS inv,
                                                        abs_reporte_consumo AS rc, abs_reporte_consumo_in rc_in
                                                        WHERE
                                                        sis.sistema_id=ele.sistema_id AND ele.elemento_id=ran.elemento_id AND
                                                        ran.rango_id=inv.rango_id AND 
                                                        inv.inventario_id=rc_in.inventario_id AND 
                                                        rc_in.consumo_status='Devolución' AND
                                                        rc.rc_id=rc_in.rc_id AND rc.rc_id=".$_GET['rc']);
        $sql['Dev']= $this->config_mdl->sqlQuery("SELECT sis.sistema_titulo, ele.elemento_titulo, ran.rango_titulo, inv.inventario_id FROM abs_sistemas AS sis, abs_elementos AS ele, abs_rangos AS ran, abs_inventario AS inv,
                                                        abs_reporte_consumo AS rc, abs_reporte_consumo_in rc_in
                                                        WHERE
                                                        sis.sistema_id=ele.sistema_id AND ele.elemento_id=ran.elemento_id AND
                                                        ran.rango_id=inv.rango_id AND 
                                                        inv.inventario_id=rc_in.inventario_id AND 
                                                        rc_in.consumo_status in('Sin Ocupar','Devolución') AND
                                                        rc.rc_id=rc_in.rc_id AND rc.rc_id=".$_GET['rc']);
        $this->load->view('Inventario/DevolucionMateriales',$sql);
    }
    public function AjaxCheckDevolucion() {
        $sqlInv= $this->config_mdl->sqlGetDataCondition('abs_inventario',array(
            'inventario_id'=> $this->input->post('inventario_id')
        ));
        $sql= $this->config_mdl->sqlGetDataCondition('abs_reporte_consumo_in',array(
            'inventario_id'=> $this->input->post('inventario_id')
        ));
        if(!empty($sqlInv)){
            if(!empty($sql)){
                if($sql[0]['consumo_status']=='Sin Ocupar'){
                    $this->setOutput(array('accion'=>'1'));
                    $this->config_mdl->sqlUpdate('abs_reporte_consumo_in',array(
                        'consumo_status'=>'Devolución'
                    ),array(
                        'inventario_id'=> $this->input->post('inventario_id')
                    ));
                    $this->config_mdl->sqlUpdate('abs_inventario',array(
                        'inventario_status'=>'Disponible'
                    ),array(
                        'inventario_id'=> $this->input->post('inventario_id')
                    ));
                    $this->setOutput(array('accion'=>'1'));
                }else{
                    $this->setOutput(array('accion'=>'4'));
                }
            }else{
                $this->setOutput(array('accion'=>'3'));
            }
            
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
}
