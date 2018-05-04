<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class UnidadMedica extends Config{
    
    
    
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('unidadMedica/Zonificacion');
    }
    
    public function AddUnidad() {
        $sql['Especialidad']= $this->config_mdl->_get_data('um_especialidades_unidad');
        $this->load->view("UnidadMedica/addUnidad", $sql);
    }
    
    public function ajaxGuardarUnidad(){
        
        $this->config_mdl->_insert('um_unidad_tipo',array(
            'unidad_tipo'=> $this->input->post('unidad_tipo')
        ));
        $this->config_mdl->_insert('um_unidad_direccion',array(
            'unidad_altitud'=> $this->input->post('altitud'),
            'unidad_latitud'=> $this->input->post('latitud')
        ));

        $sql_max_direccion= $this->config_mdl->_get_last_id('um_unidad_direccion','id_unidad_direccion');
        $sql_max_tipo= $this->config_mdl->_get_last_id('um_unidad_tipo','id_unidad_tipo');

        $this->config_mdl->_insert('um_unidad_atencion_medica',array(
            'numero_unidad_atencion'=> $this->input->post('unidad_numero'),
            'unidad_nivel'=> $this->input->post('unidad_nivel'),
            'id_unidad_direccion'=> $sql_max_direccion,
            'id_unidad_tipo'=>$sql_max_tipo,
            'unidad_nombre'=> $this->input->post('unidad_nombre'),
            'unidad_estado'=> $this->input->post('estado'),
            'unidad_estado_actual'=>'1'
        ));
        $sql_max_unidad= $this->config_mdl->_get_last_id('um_unidad_atencion_medica','id_unidad_atencion');
        
        foreach ($this->input->post('especialidad') as $value) {
            $this->config_mdl->_insert('um_unidad_especialidad', array(
                'id_unidad_medica'=> $sql_max_unidad,
                'id_especialidad_unidad'=>$value
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function ajaxEliminarUnidad(){
        
        
        $this->config_mdl->_delete_data('um_unidad_atencion_medica',array(
            'id_unidad_atencion'=> $_POST['id_unidad_atencion']
        ));
        $this->config_mdl->_delete_data('um_unidad_direccion',array(
            'id_unidad_direccion'=> $_POST['id_unidad_direccion']
        ));
        $this->config_mdl->_delete_data('um_unidad_tipo',array(
            'id_unidad_tipo'=> $_POST['id_unidad_tipo']
        ));

        $this->setOutput(array('accion'=>'1'));
    }
    public function EditarUnidad(){
        $sql['Especialidad']= $this->config_mdl->_get_data('um_especialidades_unidad');
        
        $id = $_GET['id'];
        $Especialidad = '';
        $sql['Unidad']=$this->config_mdl->_query("SELECT *FROM um_unidad_atencion_medica, um_unidad_direccion, um_unidad_tipo 
                                                    WHERE um_unidad_atencion_medica.id_unidad_direccion=
                                                    um_unidad_direccion.id_unidad_direccion AND 
                                                    um_unidad_atencion_medica.id_unidad_tipo = um_unidad_tipo.id_unidad_tipo 
                                                    AND um_unidad_atencion_medica.id_unidad_atencion = '$id'")[0];
        
        $Especialidades= $this->config_mdl->_query("SELECT * FROM  um_unidad_especialidad WHERE um_unidad_especialidad.id_unidad_medica=$id");
        foreach ($Especialidades as $value) {
            $Especialidad.=$value['id_especialidad_unidad'].',';
        }
        $sql['Especialidades']= trim($Especialidad, ',');
        $this->load->view("UnidadMedica/addUnidad", $sql);
    }

    public function Editar(){
        error_reporting(1);
        
        $this->config_mdl->_update_data('um_unidad_atencion_medica',
            array(
                'numero_unidad_atencion'=> $this->input->post('unidad_numero'),
                'unidad_nivel'=> $this->input->post('unidad_nivel'),
                'unidad_nombre'=> $this->input->post('unidad_nombre'),
                'unidad_estado'=> $this->input->post('estado'),
            ),array(
            'id_unidad_atencion'=> $this->input->post('id_unidad_editar')
        ));
        
        $this->config_mdl->_delete_data('um_unidad_especialidad',array(
                'id_unidad_medica'=> $this->input->post('id_unidad_editar')
            ));
        
        foreach ($this->input->post('especialidad') as $value) {
            $this->config_mdl->_insert('um_unidad_especialidad', array(
                'id_unidad_medica'=> $this->input->post('id_unidad_editar'),
                'id_especialidad_unidad'=>$value
            ));
        }
        
        $sql= $this->config_mdl->_get_data_condition('um_unidad_atencion_medica',array(
            'id_unidad_atencion'=> $this->input->post('id_unidad_editar')))[0];
        
        if(empty($sql)) {
            $this->setOutput(array('accion'=>'2'));
        }else {
            $this->config_mdl->_update_data('um_unidad_direccion',
                array(
                    'unidad_altitud'=> $this->input->post('altitud'),
                    'unidad_latitud'=> $this->input->post('latitud')
                ),array(
                    'id_unidad_direccion'=> $sql['id_unidad_direccion']
                ));

            $this->config_mdl->_update_data('um_unidad_tipo',
                array(
                    'unidad_tipo'=> $this->input->post('unidad_tipo')
                ),array(
                'id_unidad_tipo'=> $sql['id_unidad_tipo']
            ));
            $this->setOutput(array('accion'=>'1'));
        }
    }
    
    public function FiltrarUnidadesDependientes(){
        $id = $_GET['id'];
        
        $sql['UNIDAD_PADRE']=$this->config_mdl->_query("SELECT *FROM um_unidad_atencion_medica 
                                                WHERE um_unidad_atencion_medica.id_unidad_atencion = '$id'")[0];
        
        $sql['UNIDADES_DEPENDIENTES']=$this->config_mdl->_query("SELECT *FROM um_zonificacion, um_unidad_atencion_medica 
                                                WHERE um_zonificacion.id_unidad_dependiente = um_unidad_atencion_medica.id_unidad_atencion
                                                AND um_zonificacion.id_unidad_padre = '$id' ORDER BY cast(um_unidad_atencion_medica.numero_unidad_atencion as unsigned) ASC");
        
        $this->load->view("UnidadMedica/UnidadYdependencias", $sql);
    }
    
    public function asignarUnidad(){
        $this->config_mdl->_insert('um_zonificacion',array(
            'id_unidad_dependiente'=> $_REQUEST['id_unidad_dependiente'],
            'id_unidad_padre'=> $_REQUEST['id_unidad_padre']
        ));
        $this->config_mdl->_update_data('um_unidad_atencion_medica',
            array(
                'unidad_estado_actual'=>'2',
            ),array(
            'id_unidad_atencion'=> $_REQUEST['id_unidad_dependiente']
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function quitarUnidad(){
        $this->config_mdl->_delete_data('um_zonificacion',array(
            'id_zonificacion'=> $_POST['idZonificaion']
        ));
        
        $this->config_mdl->_update_data('um_unidad_atencion_medica',
            array(
                'unidad_estado_actual'=>'1',
            ),array(
            'id_unidad_atencion'=> $_REQUEST['id_unidad_UMF']
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxFiltrar_unidades(){
        $tipo_unidad = $_POST['tipo_unidad'];
        
        $sql = $this->config_mdl->_query("SELECT *, unidad_nombre, numero_unidad_atencion, unidad_nivel, unidad_altitud as alt, unidad_latitud as lat, unidad_tipo
                                                FROM um_unidad_atencion_medica, um_unidad_direccion, um_unidad_tipo 
                                                WHERE um_unidad_atencion_medica.id_unidad_direccion = um_unidad_direccion.id_unidad_direccion 
                                                AND um_unidad_atencion_medica.id_unidad_tipo = um_unidad_tipo.id_unidad_tipo 
                                                AND um_unidad_tipo.unidad_tipo = '$tipo_unidad' ORDER BY cast(um_unidad_atencion_medica.numero_unidad_atencion as unsigned) ASC");
        if(!empty($sql)){
            foreach ($sql as $value) {
                $dato2 = $this->config_mdl->_get_data_condition('um_unidad_direccion',array('id_unidad_direccion'=>$value['id_unidad_direccion']))[0];
                $dato = $this->config_mdl->_get_data_condition('um_unidad_tipo',array('id_unidad_tipo'=>$value['id_unidad_tipo']))[0];
                
                if($tipo_unidad != 'UMF'){
                    $TOTAL_UNIDADES = $this->config_mdl->_query("SELECT COUNT(um_zonificacion.id_zonificacion) AS total_unidades 
                                                            FROM um_zonificacion, um_unidad_atencion_medica
                                                            WHERE um_zonificacion.id_unidad_dependiente = um_unidad_atencion_medica.id_unidad_atencion
                                                            AND um_zonificacion.id_unidad_padre = ".$value['id_unidad_atencion'])[0];
                    
                    $ver_UM_asignadas = '&nbsp;<a href="'.base_url().'sections/unidadMedica/FiltrarUnidadesDependientes/?id='.$value['id_unidad_atencion'].'&tipo_unidad='.$tipo_unidad.'" target="_blank">
                                                        <i class="fa fa-share editar" title="Ver detalles"></i>
                                                    </a>';
                    
                    $unidad_totales = '<td>'.$TOTAL_UNIDADES['total_unidades'].'</td>';
                }else{
                    $ver_UM_asignadas = '';
                }
                
                $tr.=' <tr>
                            <td>'.$value['unidad_nombre'].'</td>
                            <td>'.$value['numero_unidad_atencion'].'</td>
                            <td>'.$value['unidad_nivel'].'</td>
                            <td>'.$value['unidad_estado'].'</td>
                            <td>'.$dato2['unidad_altitud'].'</td>
                            <td>'.$dato2['unidad_latitud'].'</td>
                            <td>'.$dato['unidad_tipo'].'</td>
                            '.$unidad_totales.'
                            <td>
                                <a href="'.base_url().'sections/unidadMedica/EditarUnidad/?id='.$value['id_unidad_atencion'].'" target="_blank">
                                    <i class="fa fa-pencil editar " data-original-title="Editar datos"></i>
                                </a>&nbsp;
                                <i class="eliminar_unidad fa fa-trash-o pointer" data-idunidad="'.$value['id_unidad_atencion'].'" data-iddireccion="'.$value['id_unidad_direccion'].'" data-idtipo="'.$value['id_unidad_tipo'].'" data-original-title="Eliminar unidad"></i>
                                '.$ver_UM_asignadas.'    
                            </td>
                       </tr>';
            }
        }else{
            $tr.=' <tr>
                        <td colspan="3">NO HAY REGISTROS</td>
                   </tr>';
        }
       $this->setOutput(array('tr'=>$tr));
    }
    
    public function FiltrarUnidadesDisponibles(){
        if($_REQUEST['tipo_unidad'] == 'UMAE'){
            $nuevo_tipo = 'HGZ';
        }else{
            $nuevo_tipo = 'UMF';
        }
        $sql['TOTAL_UNIDADES_DISPONIBLES']=$this->config_mdl->_query("SELECT COUNT(um_unidad_atencion_medica.id_unidad_atencion) AS disponibles 
                                                        FROM um_unidad_atencion_medica, um_unidad_tipo 
                                                        WHERE um_unidad_atencion_medica.id_unidad_tipo = um_unidad_tipo.id_unidad_tipo 
                                                        AND um_unidad_tipo.unidad_tipo = '$nuevo_tipo' 
                                                        AND um_unidad_atencion_medica.unidad_estado_actual = '1'")[0];
        
        $sql['UNIDADES_DISPONIBLES']=$this->config_mdl->_query("SELECT *FROM um_unidad_atencion_medica , um_unidad_tipo
                                                WHERE um_unidad_tipo.id_unidad_tipo = um_unidad_atencion_medica.id_unidad_tipo 
                                                AND um_unidad_tipo.unidad_tipo = '$nuevo_tipo' 
                                                AND um_unidad_atencion_medica.unidad_estado_actual = '1' ORDER BY cast(um_unidad_atencion_medica.numero_unidad_atencion as unsigned) ASC");
        
        $this->load->view("UnidadMedica/UnidadesDisponibles", $sql);
    }
    public function AjaxGoogleMaps() {
        
        $UNIDAD = $this->config_mdl->_query("SELECT *FROM um_unidad_atencion_medica, um_unidad_direccion WHERE 
                                            um_unidad_atencion_medica.id_unidad_direccion = um_unidad_direccion.id_unidad_direccion
                                            AND um_unidad_atencion_medica.id_unidad_atencion = 34")[0];
        
        if (isset($UNIDAD)){
            $this->setOutput(array('accion'=>$UNIDAD));
        }else{
            $this->setOutput(array('accion'=>$UNIDAD));
        }
    }
}
