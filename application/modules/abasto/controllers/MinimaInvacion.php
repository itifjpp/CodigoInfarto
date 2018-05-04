<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**Abasto/MinimaInvacion/CatalogoPrincipalConsumo --> categoria
 * Description of Materiales
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class MinimaInvacion extends Config{ 
    
    public function CatalogoPrincipalConsumo(){
        $this->load->view('Catalogos/CatalogoPrincipalConsumo');
    }
    
    public function Procedimiento() {
        $select['RANGOS']= $this->config_mdl->_get_data('abs_rangos');
        $this->load->view('Catalogos/ProcedimientoInventario', $select);
    }
    
    public function addInventario() {
        
        $this->config_mdl->_insert('abs_entrega', array(
            'entrega_fecha'=> date('d/m/Y'),
            'sistema_id'=> $this->input->post('sistema_id')
        ));
        $sql_max_tipo= $this->config_mdl->_get_last_id('abs_entrega','entrega_id');
        $cantidad = $this->input->post('cantidad');
        for( $i= 0; $i < $cantidad; $i++) {
                $this->config_mdl->_insert('abs_inventario',array(
                'rango_id'=> $this->input->post('rango'),
                'entrega_id'=> $sql_max_tipo,
                'inventario_status'=>'false',
                'vale_servicio_id'=>0,
                'procedimiento_status'=>'SIN ASIGNAR'
            ));  
        }
        $sql = $this->config_mdl->_query("SELECT abs_rangos.rango_titulo,abs_sistemas.sistema_proveedor,abs_inventario.inventario_id
                                          FROM abs_entrega, abs_sistemas, abs_inventario, abs_rangos
                                          WHERE abs_sistemas.sistema_id = abs_entrega.sistema_id
                                          AND abs_inventario.entrega_id = abs_entrega.entrega_id 
                                          AND abs_rangos.rango_id = abs_inventario.rango_id
                                          AND abs_inventario.inventario_status = 'false' 
                                          ORDER BY abs_inventario.inventario_id DESC 
                                          LIMIT $cantidad");
        if(!empty($sql)){
            foreach ($sql as $value) {
                $tr.=' <tr>
                        <td>'.$value['inventario_id'].'</td>
                        <td>'.$value['rango_titulo'].'</td>
                        <td>'.$value['sistema_proveedor'].'</td>
                        <td><center>
                            <a href="'.base_url().'abasto/Catalogos/ImprimirCodigoInsumo?codigo='.$value['inventario_id'].'" target="_blank"><i class="fa fa-file-pdf-o"></i></a></center></td>
                   </tr>';
            }
            $this->setOutput(array('accion'=>'1', 'data'=>$tr));
        }else {
            $this->setOutput(array('accion'=>'2'));
        }
    }
    
    public function RangosInventario() {
        $sql['sistema']= $this->config_mdl->_get_data_condition('abs_sistemas',array(
            'sistema_id'=>$_GET['sistema']
        ))[0];
        $sql['elemento']= $this->config_mdl->_get_data_condition('abs_elementos',array(
            'elemento_id'=>$_GET['elemento']
        ))[0];
        
        $sql['INVENTARIO']= $this->config_mdl->_query("SELECT *FROM abs_entrega, abs_sistemas, abs_inventario, abs_rangos
                                                          WHERE abs_sistemas.sistema_id = abs_entrega.sistema_id
                                                          AND abs_inventario.entrega_id = abs_entrega.entrega_id 
                                                          AND abs_rangos.rango_id = abs_inventario.rango_id
                                                          AND abs_rangos.rango_id = ".$_GET['rango_id']."
                                                          ORDER BY abs_inventario.inventario_id");
        $this->load->view('Catalogos/RangosInventario', $sql);
    }
    
    public function ImprimirCodigoInsumo() {
        $this->load->view("Catalogos/ImprimirCodigoInsumo");
    }
    
    public function Procedimientos() {
        $select['PROCEDIMIENTOS'] = $this->config_mdl->_query("SELECT *FROM abs_vale_servicio, abs_procedimiento, os_triage, os_observacion_ci
                                                               WHERE abs_procedimiento.procedimiento_codigo = abs_vale_servicio.procedimiento_codigo
                                                               AND os_triage.triage_id = abs_vale_servicio.triage_id
                                                               AND os_observacion_ci.triage_id = os_triage.triage_id 
                                                               ORDER BY abs_vale_servicio.vale_id DESC");
        $this->load->view('Catalogos/ProcedimientoQuirofano', $select);
    }
    
    public function ProcedimientoQuirofano() {
        $this->load->view('Catalogos/ProgramarProcedimientoQX');
    }
    
    public function ProcedimientoAutorizar() {
        $this->load->view("Catalogos/ProcedimientoAutorizar");
    }
    
    public function GuardarAutorizacionProce() {
        if($this->input->post('opcionRadio') == 'autorizar'){
            $this->config_mdl->_insert('abs_autorizacion_procedimiento',array(
                'fecha_autorizacion'=>$this->input->post('fecha_autorizada'),
                'hora_autorizacion'=>$this->input->post('hora_autorizada'),
                'sala_autorizacion'=>$this->input->post('no_sala_autorizada'),
                'vale_servicio_id'=>$this->input->post('vale_servicio_id')
            ));
            $this->config_mdl->_update_data('abs_vale_servicio',array(
                    'cirugia_status'=> 1
                ),array(
                    'vale_id'=> $this->input->post('vale_servicio_id')
            ));
        }else {
            $this->config_mdl->_update_data('abs_vale_servicio',array(
                    'cirugia_status'=> 2
                ),array(
                    'vale_id'=> $this->input->post('vale_servicio_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxFiltrarConsumos(){
        if($this->input->post('vale_servicio_id')!='') {
            $sql = $this->config_mdl->_query("SELECT *FROM abs_inventario, abs_entrega, abs_rangos
                                              WHERE abs_inventario.entrega_id = abs_entrega.entrega_id 
                                              AND abs_inventario.rango_id = abs_rangos.rango_id
                                              AND abs_inventario.inventario_status = 'true'
                                              AND abs_inventario.vale_servicio_id = ".$this->input->post('vale_servicio_id')."
                                              AND abs_inventario.procedimiento_status = 'ASIGNADA'");

            $sql2 = $this->config_mdl->_query("SELECT *FROM abs_instrumental_procedimiento, abs_vale_servicio
                                               WHERE abs_instrumental_procedimiento.vale_servicio_id = abs_vale_servicio.vale_id 
                                               AND abs_vale_servicio.vale_id =".$this->input->post('vale_servicio_id'));

            $sql3 = $this->config_mdl->_query("SELECT *FROM abs_equipamiento_procedimiento, abs_vale_servicio
                                               WHERE abs_equipamiento_procedimiento.vale_servicio_id = abs_vale_servicio.vale_id 
                                               AND abs_vale_servicio.vale_id =".$this->input->post('vale_servicio_id'));
        }else {
            $sql = $this->config_mdl->_query("SELECT *FROM abs_inventario, abs_entrega, abs_rangos
                                              WHERE abs_inventario.entrega_id = abs_entrega.entrega_id 
                                              AND abs_inventario.rango_id = abs_rangos.rango_id
                                              AND abs_inventario.inventario_status = 'true'
                                              AND abs_inventario.vale_servicio_id = 0
                                              AND abs_inventario.procedimiento_status = 'SIN ASIGNAR'");
            
            $sql2 = $this->config_mdl->_query("SELECT *FROM abs_instrumental_procedimiento
                                               WHERE abs_instrumental_procedimiento.vale_servicio_id = 0");
            
            $sql3 = $this->config_mdl->_query("SELECT *FROM abs_equipamiento_procedimiento
                                               WHERE abs_equipamiento_procedimiento.vale_servicio_id = 0");
        }
        if(!empty($sql)){
            foreach ($sql as $value) {
                $insumos.=' <tr>
                        <td style="padding: 0px;"><img src="'.base_url().'assets/materiales/'.$value['rango_img'].'" alt="Smiley face" width="81" height="42"></td>
                        <td>'.$value['inventario_id'].'</td>
                        <td><i class="eliminar_consumo fa fa-trash-o pointer fa-2x" data-idtipo="insumo" data-consumo="'.$value['inventario_id'].'" data-idConsumo="'.$value['inventario_id'].'" data-original-title="Eliminar insumo"></i></td>
                   </tr>';
            }
        }else{
            $insumos.='';
        }

        if(!empty($sql2)){
            foreach ($sql2 as $value2) {
                $instrumental.=' <tr>
                        <td>'.$value2['cantidad_id'].'</td>
                        <td><i class="eliminar_consumo fa fa-trash-o pointer fa-2x" data-idtipo="instrumental" data-consumo="'.$value2['instrumental_procedimiento_id'].'" data-idConsumo="'.$value2['instrumental_procedimiento_id'].'" data-original-title="Eliminar instrumental"></i></td>
                   </tr>';
            }
        }else{
            $instrumental.='';
        }
        
        if(!empty($sql3)){
            foreach ($sql3 as $value3) {
                $equipamiento.=' <tr>
                        <td>'.$value3['cantidad_id'].'</td>
                        <td><i class="eliminar_consumo fa fa-trash-o pointer fa-2x" data-idtipo="equipamiento" data-consumo="'.$value3['equipamiento_id'].'" data-idConsumo="'.$value3['equipamiento_procedimiento_id'].'" data-original-title="Eliminar equipamiento"></i></td>
                   </tr>';
            }
        }else{
            $equipamiento.='';
        }
        
        $this->setOutput(array('insumos'=>$insumos, 'instrumental'=>$instrumental, 'equipamiento'=> $equipamiento));
    }
    
    public function AjaxBuscarConsumo(){
        $vale_servicio_id = $this->input->post('vale_servicio_id');
        if($vale_servicio_id == '') {
            $i = 0;
        }else {
            $i = $vale_servicio_id;
        }
        
        if($this->input->post('tipo')=='insumo') {
            $rango= $this->config_mdl->_query("SELECT *FROM abs_inventario, abs_rangos
                                               WHERE abs_inventario.rango_id = abs_rangos.rango_id
                                               AND abs_inventario.inventario_id = ".$this->input->post('rango_id'))[0];
            if(!empty($rango)) {
                if($rango['inventario_status'] == 'false') {
                    if($vale_servicio_id == '') {
                        $this->config_mdl->_update_data('abs_inventario',array(
                            'inventario_status'=> 'true'
                        ),array(
                            'inventario_id'=> $this->input->post('rango_id')
                        ));
                    }else {
                        $this->config_mdl->_update_data('abs_inventario',array(
                            'inventario_status'=> 'true',
                            'vale_servicio_id'=> $vale_servicio_id,
                            'procedimiento_status'=>'ASIGNADA'
                        ),array(
                            'inventario_id'=> $this->input->post('rango_id')
                        ));
                    }
                    $this->setOutput(array('accion'=>'1'));
                }else {
                    $this->setOutput(array('accion'=>'3'));
                }
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else if($this->input->post('tipo')=='instrumental') {
            $instrumental= $this->config_mdl->_query("SELECT *FROM abs_cantidad
                                                          WHERE abs_cantidad.cantidad_tipo = 'instrumental' 
                                                          AND abs_cantidad.cantidad_id = ".$this->input->post('cantidad_id_inst'))[0];
            if(!empty($instrumental)) {
                
                $this->config_mdl->_insert('abs_instrumental_procedimiento',array(
                    'instrumental_id'=> $instrumental['tipo_inst_equi_id'],
                    'vale_servicio_id'=>$i,
                    'cantidad_id'=> $this->input->post('cantidad_id_inst')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else {
                $this->setOutput(array('accion'=>'2'));
            }
        }else if($this->input->post('tipo')=='equipamiento') {
            $equipamiento= $this->config_mdl->_query("SELECT *FROM abs_cantidad
                                                      WHERE abs_cantidad.cantidad_tipo = 'equipamiento' 
                                                      AND abs_cantidad.cantidad_id = ".$this->input->post('cantidad_id_equi'))[0];
            if(!empty($equipamiento)) {
                $this->config_mdl->_insert('abs_equipamiento_procedimiento',array(
                    'equipamiento_id'=> $equipamiento['tipo_inst_equi_id'],
                    'vale_servicio_id'=>$i,
                    'cantidad_id'=> $this->input->post('cantidad_id_equi')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else {
                $this->setOutput(array('accion'=>'2'));
            }
        }
    }
    
    public function ValeServicio() {
        if(isset($_GET['paciente'])){
            $sql['info'] = $this->config_mdl->_query("SELECT os_triage.triage_id, os_triage.triage_nombre, os_triage.triage_nombre_ap,
                                                      os_triage.triage_nombre_am, os_triage.triage_paciente_sexo,
                                                      paciente_info.pum_nss, paciente_info.pum_nss_agregado
                                                      FROM os_triage, paciente_info
                                                      WHERE os_triage.triage_id=paciente_info.triage_id 
                                                      AND os_triage.triage_id =".$_GET['paciente'])[0];
            
            
            $fechanac = $this->config_mdl->_query("SELECT os_triage.triage_fecha_nac FROM 
                                                   os_triage WHERE os_triage.triage_id =".$_GET['paciente'])[0];
            $edad = $this->CalcularEdad($fechanac['triage_fecha_nac']);
            $sql['edadC'] = $edad->y;
            
            $sql['servicio']= $this->config_mdl->_query("SELECT *FROM os_observacion_ci 
                                                         WHERE os_observacion_ci.triage_id =".$_GET['paciente'])[0];
            
            $medico= $this->config_mdl->_query("SELECT *FROM os_observacion_ci 
                                                         WHERE os_observacion_ci.triage_id =".$_GET['paciente'])[0];
            $matricula = $medico['ci_mmc'];
            
            $sql['medico'] = $this->config_mdl->_query("SELECT os_empleados.empleado_apellidos, os_empleados.empleado_nombre 
                                                           FROM os_empleados 
                                                           WHERE os_empleados.empleado_matricula =".$matricula)[0];
            
        }else{
            $sql['info'] = '';
            $sql['servicio'] ='';
            $sql['medico'] ='';
        }
        if(isset($_GET['procedimiento_codigo'])){
            $sql['procedimiento']= $this->config_mdl->_query("SELECT *FROM abs_procedimiento 
                                                              WHERE abs_procedimiento.procedimiento_codigo ='".$_GET['procedimiento_codigo']."'")[0];
        }else{
            $sql['procedimiento'] ='';
        }
        //Para cuando solo sea editar, cargara los datos
        if(isset($_GET['vale_servicio_id'])){
            $sql['vale_servicio'] = $this->config_mdl->_query("SELECT *FROM abs_vale_servicio, abs_procedimiento 
                                                               WHERE abs_vale_servicio.procedimiento_codigo = abs_procedimiento.procedimiento_codigo
                                                               AND abs_vale_servicio.vale_id =".$_GET['vale_servicio_id'])[0];
            
        }else{
            $sql['vale_servicio'] ='';
        }
        $this->load->view('Catalogos/ValeServicio',$sql);
    }
    
    public function GuardarValeServicio() {
        $procedimiento_codigo = $this->input->post("procedimiento_codigo");
        if($this->input->post('accion') == 'add'){
            
            $this->config_mdl->_insert('abs_vale_servicio', array(
                'triage_id'=> $this->input->post('triage_id'),
                'procedimiento_codigo'=> "$procedimiento_codigo",
                'vale_no_sala'=>$this->input->post('vale_no_sala'),
                'vale_fecha_ingreso'=>$this->input->post('vale_fecha_ingreso'),
                'vale_hora_ingreso'=> $this->input->post('vale_hora_ingreso'),
                'vale_fecha_egreso'=> $this->input->post('vale_fecha_egreso'),
                'vale_hora_egreso'=> $this->input->post('vale_hora_egreso'),
                'procedimiento_hora_inicio'=> $this->input->post('procedimiento_hora_inicio'),
                'anestecia_hora_inicio'=> $this->input->post('anestecia_hora_inicio'),
                'procedimiento_hora_fin'=> $this->input->post('procedimiento_hora_fin'),
                'anestecia_hora_fin'=> $this->input->post('anestecia_hora_fin'),
                'vale_hora_registro'=> date('d/m/Y'),
                'vale_ip'=>$_SERVER['REMOTE_ADDR'],
                'servicio_id'=>$this->input->post('servicio'),
                'cirugia_status'=>0
            ));
            $lastID= $this->config_mdl->_get_last_id('abs_vale_servicio','vale_id');
            for ($i = 0; $i < count($_FILES['vale_evidencias']['name']); $i++) {
                $ext= md5(rand()).'.'.end(explode('.',$_FILES['vale_evidencias']['name'][$i]));
                if(copy($_FILES['vale_evidencias']['tmp_name'][$i],'assets/evidencias_procedimiento/'.$ext)){
                    $this->config_mdl->_insert('abs_evidencias',array(
                        'vale_servicio_id'=>$lastID,
                        'evidencia'=>$ext
                    ));
                }
            }
            
            $this->config_mdl->_update_data('abs_inventario',array(
                    'vale_servicio_id'=> $lastID
                ),array(
                    'inventario_status'=> 'true',
                    'procedimiento_status'=>'SIN ASIGNAR'
            ));
            $this->config_mdl->_update_data('abs_inventario',array(
                    'procedimiento_status'=>'ASIGNADA'
                ),array(
                    'vale_servicio_id'=> $lastID
            ));
            
            $this->config_mdl->_update_data('abs_equipamiento_procedimiento',array(
                    'vale_servicio_id'=>$lastID
                ),array(
                    'vale_servicio_id'=>0
            ));
            $this->config_mdl->_update_data('abs_instrumental_procedimiento',array(
                    'vale_servicio_id'=>$lastID
                ),array(
                    'vale_servicio_id'=>0
            ));
            $this->setOutput(array('accion'=>'1'));
            
        } else {
            $this->config_mdl->_update_data('abs_vale_servicio',array(
                'triage_id'=> $this->input->post('triage_id'),
                'procedimiento_codigo'=> "$procedimiento_codigo",
                'vale_no_sala'=>$this->input->post('vale_no_sala'),
                'vale_fecha_ingreso'=>$this->input->post('vale_fecha_ingreso'),
                'vale_hora_ingreso'=> $this->input->post('vale_hora_ingreso'),
                'vale_fecha_egreso'=> $this->input->post('vale_fecha_egreso'),
                'vale_hora_egreso'=> $this->input->post('vale_hora_egreso'),
                'procedimiento_hora_inicio'=> $this->input->post('procedimiento_hora_inicio'),
                'anestecia_hora_inicio'=> $this->input->post('anestecia_hora_inicio'),
                'procedimiento_hora_fin'=> $this->input->post('procedimiento_hora_fin'),
                'anestecia_hora_fin'=> $this->input->post('anestecia_hora_fin'),
                'vale_hora_registro'=> date('d/m/Y'),
                'vale_ip'=>$_SERVER['REMOTE_ADDR'],
                'servicio_id'=>$this->input->post('servicio')
            ),array(
                'vale_id'=> $this->input->post('vale_servicio_id')
            ));
            $archivos = count($_FILES['vale_evidencias']['name']);
            if($archivos > 0){
                for ($i = 0; $i < $archivos; $i++) {
                    $ext= md5(rand()).'.'.end(explode('.',$_FILES['vale_evidencias']['name'][$i]));
                    if(copy($_FILES['vale_evidencias']['tmp_name'][$i],'assets/evidencias_procedimiento/'.$ext)){
                        $this->config_mdl->_insert('abs_evidencias',array(
                            'vale_servicio_id'=>$this->input->post('vale_servicio_id'),
                            'evidencia'=>$ext
                        ));
                    }
                }
            }
            $this->setOutput(array('accion'=>'2'));
        }
    }
    
    public function DescartarConsumo() {
        if($this->input->post('tipo_consumo') == 'insumo') {
            $update = $this->config_mdl->_update_data('abs_inventario',array(
                'inventario_status'=>'false'
            ),array(
                'inventario_id'=>$this->input->post('idpConsumo')
            ));
            if(isset($update)){
                $this->setOutput(array('accion'=>'1')); 
            }else {
                $this->setOutput(array('accion'=>'2'));
            }
        }else if($this->input->post('tipo_consumo') == 'instrumental') {
            $this->config_mdl->_delete_data('abs_instrumental_procedimiento',array(
                'instrumental_procedimiento_id'=> $this->input->post('idpConsumo')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else if($this->input->post('tipo_consumo') == 'equipamiento'){
            $this->config_mdl->_delete_data('abs_equipamiento_procedimiento',array(
                'equipamiento_procedimiento_id'=> $this->input->post('idpConsumo')
            ));
            $this->setOutput(array('accion'=>'1'));
        }
    }
    
    public function VerDocumentos() {
        $tr = '';
        $sql = $this->config_mdl->_query("SELECT *FROM abs_evidencias
                                          WHERE abs_evidencias.vale_servicio_id =".$this->input->post('vale_servicio_id'));
        
        if(!empty($sql)){
            foreach ($sql as $value) {
                $tr.=' <tr>
                        <td>'.$value['evidencia'].'</td>
                        <td>
                            <a href="'.base_url().'assets/evidencias_procedimiento/'.$value['evidencia'].'" target="_blank"><i class="fa fa-link"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;<i class="fa fa-trash fa-fw eliminar-evidencia pointer" data-evidencia_nombre="'.$value['evidencia'].'" data-evidencia_id="'.$value['evidencias_id'].'" title="Ver detalles"></i>
                        </td>
                   </tr>';
            }
            $this->setOutput(array('accion'=>$tr));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    
    public function CalcularEdad($fechanac) {
        $fecha_hac=  new DateTime(str_replace('/', '-', $fechanac));
        $hoy=  new DateTime(date('d-m-Y')); 
        return $hoy->diff($fecha_hac); 
    }
    
    public function AjaxBuscarPaciente() {
        
        $sql= $this->config_mdl->_query("SELECT *FROM os_observacion_ci 
                                         WHERE os_observacion_ci.triage_id =".$this->input->post('triage_id'))[0];
        
        
        $action = $this->input->post('action');
        if(!empty($sql)){
            $servicio = $sql['ci_id'];
            $this->setOutput(array('accion'=>'1', 'action'=>$action, 'servicio'=>$servicio,'paciente'=>$this->input->post('triage_id')));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }

    public function AjaxBuscarProcedimiento() {
        $codigo = $this->input->post('procedimiento');
        $sql= $this->config_mdl->_query("SELECT *FROM abs_procedimiento 
                                         WHERE abs_procedimiento.procedimiento_codigo = '$codigo'")[0];

        $action = $this->input->post('action');
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1', 'action'=>$action, 'procedCodigo'=>$codigo));
        }else {
            $this->setOutput(array('accion'=>'2'));
        }
    }
    
    public function ConsumoTotalInst() {
        $sql['CATEGORIA'] = $this->config_mdl->_query("SELECT *FROM abs_categoria
                                                       WHERE abs_categoria.categoria_id =".$_GET['categoria_id'])[0];

        $sql['CHAROLA'] = $this->config_mdl->_query("SELECT *FROM abs_charola
                                                     WHERE abs_charola.charola_id =".$_GET['charola_id'])[0];
        
        $sql['TOTAL_INS'] = $this->config_mdl->_query(" SELECT *FROM abs_instrumental, abs_charola, abs_categoria 
                                                        WHERE abs_charola.charola_id = abs_instrumental.charola_id
                                                        AND abs_instrumental.charola_id = ".$_GET['charola_id']."
                                                        AND abs_categoria.categoria_id = abs_charola.categoria_id
                                                        ORDER BY instrumental_id DESC");
        $this->load->view("Catalogos/ConsumoTotalInst", $sql);
    }
    
    public function NuevoInstrumental() {
        if(isset($_GET['instrumental_id'])){
            $sql['CONTRATOS'] = $this->config_mdl->_query("SELECT *FROM abs_contrato");
            
            $sql['DATOS'] = $this->config_mdl->_query("SELECT *FROM abs_instrumental, abs_contrato
                                                       WHERE abs_contrato.contrato_id = abs_instrumental.contrato_id 
                                                       AND abs_instrumental.instrumental_id =".$_GET['instrumental_id'])[0];
        }else{
            $sql['CONTRATOS'] = $this->config_mdl->_query("SELECT *FROM abs_contrato");
            $sql['DATOS'] = '';
        }
        $this->load->view('Catalogos/NuevoInstrumental', $sql);
    }
    
    public function GuardarNuevoInstrumental() {
        if($this->input->post('accion') == 'add') {
            $ext= md5(rand()).'.'.end(explode('.',$_FILES['instrumental_imagen']['name']));
            if(copy($_FILES['instrumental_imagen']['tmp_name'],'assets/evidencias_procedimiento/'.$ext)){
                $this->config_mdl->_insert('abs_instrumental', array(
                    'contrato_id'=> $this->input->post('contrato_id'),
                    'instrumental_nombre'=> $this->input->post('nombre_instrumental'),
                    'instrumental_imagen'=> $ext,
                    'instrumental_descripcion'=> $this->input->post('instrumental_descripcion'),
                    'charola_id'=> $this->input->post("id_charola"),
                    'instrumental_status'=>0
                ));
            }
            $this->setOutput(array('accion'=>'1'));
        }else {
            
            if($_FILES['instrumental_imagen']['name'] != '') {
            
                $ext= md5(rand()).'.'.end(explode('.',$_FILES['instrumental_imagen']['name']));
                if(copy($_FILES['instrumental_imagen']['tmp_name'],'assets/evidencias_procedimiento/'.$ext)){
                    $this->config_mdl->_update_data('abs_instrumental', array(
                        'contrato_id'=> $this->input->post('contrato_id'),
                        'instrumental_nombre'=> $this->input->post('nombre_instrumental'),
                        'instrumental_imagen'=> $ext,
                        'instrumental_descripcion'=> $this->input->post('instrumental_descripcion'),
                    ), array(
                        'instrumental_id'=> $this->input->post('id_instrumental')
                    ));
                }
            }else {
                $this->config_mdl->_update_data('abs_instrumental', array(
                    'contrato_id'=> $this->input->post('contrato_id'),
                    'instrumental_nombre'=> $this->input->post('nombre_instrumental'),
                    'instrumental_descripcion'=> $this->input->post('instrumental_descripcion')
                ), array(
                    'instrumental_id'=> $this->input->post('id_instrumental')
                ));
            }
            
            $this->setOutput(array('accion'=>'1'));
        }
        $sql = $this->config_mdl->_query("SELECT *FROM abs_instrumental WHERE abs_instrumental.charola_id =".$this->input->post('id_charola'));
        if(!empty($sql)){
            $this->config_mdl->_update_data('abs_charola', array(
                    'charola_status'=> 1
                ), array(
                    'charola_id'=> $this->input->post("id_charola")
            ));
        }
    }
    
    public function Cantidades() {
        
        $sql['CATEGORIA'] = $this->config_mdl->_query("SELECT *FROM abs_categoria
                                                       WHERE abs_categoria.categoria_id =".$_GET['categoria_id'])[0];
        
        if(isset($_GET['instrumental_id'])){
            
            $sql['CHAROLA'] = $this->config_mdl->_query("SELECT *FROM abs_charola
                                                         WHERE abs_charola.charola_id =".$_GET['charola_id'])[0];
            
            $sql['INSTRUMENTAL'] = $this->config_mdl->_query("SELECT *FROM abs_instrumental
                                                              WHERE abs_instrumental.instrumental_id =".$_GET['instrumental_id'])[0];
            
            $sql['TOTAL_CANTIDAD'] = $this->config_mdl->_query("SELECT *FROM abs_cantidad, abs_instrumental 
                                                                WHERE abs_cantidad.tipo_inst_equi_id = abs_instrumental.instrumental_id
                                                                AND abs_cantidad.cantidad_tipo ='instrumental'
                                                                AND abs_cantidad.tipo_inst_equi_id = ".$_GET['instrumental_id']."
                                                                ORDER BY cantidad_id DESC");
            
            $this->load->view("Catalogos/Cantidad_Inst_Equip", $sql);
        }if(isset($_GET['equipamiento_id'])){
            
            $sql['EQUIPAMIENTO'] = $this->config_mdl->_query("SELECT *FROM abs_equipamiento
                                                              WHERE abs_equipamiento.equipamiento_id =".$_GET['equipamiento_id'])[0];
            
            $sql['TOTAL_CANTIDAD'] = $this->config_mdl->_query("SELECT *FROM abs_cantidad, abs_equipamiento 
                                                                WHERE abs_cantidad.tipo_inst_equi_id = abs_equipamiento.equipamiento_id
                                                                AND abs_cantidad.cantidad_tipo ='equipamiento'
                                                                AND abs_cantidad.tipo_inst_equi_id = ".$_GET['equipamiento_id']."
                                                                ORDER BY cantidad_id DESC");
            $this->load->view("Catalogos/Cantidad_Inst_Equip", $sql);
        }
    }
    
    public function CantidadAgregar() {
        $tipo = '';
        $id = 0;
        
        if($this->input->post('rango_id') == '') {
        
            if($this->input->post('instrumental_id') != '') {
                $tipo = 'instrumental';
                $id = $this->input->post('instrumental_id');
            }else if($this->input->post('equipamiento_id') != ''){
                $tipo = 'equipamiento';
                $id = $this->input->post('equipamiento_id');
            }
            for ($index = 1; $index <= $this->input->post('cantidad_agregar'); $index++) {
                $this->config_mdl->_insert('abs_cantidad', array(
                    'tipo_inst_equi_id'=> $id,
                    'cantidad_tipo'=> $tipo
                ));
            }
        }else {
            $this->config_mdl->_insert('abs_entrega', array(
                'entrega_fecha'=> date('d/m/Y'),
                'sistema_id'=> $this->input->post('sistema_id')
            ));
            $sql_max_tipo= $this->config_mdl->_get_last_id('abs_entrega','entrega_id');
            for( $i= 0; $i < $this->input->post('cantidad_agregar'); $i++) {
                $this->config_mdl->_insert('abs_inventario',array(
                    'rango_id'=> $this->input->post('rango_id'),
                    'entrega_id'=> $sql_max_tipo,
                    'inventario_status'=>'false',
                    'vale_servicio_id'=>0,
                    'procedimiento_status'=>'SIN ASIGNAR'
                ));  
            }
        $sql = $this->config_mdl->_query("SELECT *FROM abs_inventario WHERE abs_inventario.rango_id =".$this->input->post('rango_id'));
        if(!empty($sql)){
                $this->config_mdl->_update_data('abs_rangos', array(
                        'rangos_status'=> 1
                    ), array(
                        'rango_id'=> $this->input->post('rango_id')
                ));
            }
        }
        
        $sql = $this->config_mdl->_query("SELECT *FROM abs_cantidad 
                                          WHERE abs_cantidad.tipo_inst_equi_id = '$id'
                                          AND abs_cantidad.cantidad_tipo = '$tipo'");
        if(!empty($sql)){
            if($tipo == 'instrumental') {
                $this->config_mdl->_update_data('abs_instrumental', array(
                        'instrumental_status'=> 1
                    ), array(
                        'instrumental_id'=> $id
                ));
            }else {
                $this->config_mdl->_update_data('abs_equipamiento', array(
                        'equipamiento_status'=> 1
                    ), array(
                        'equipamiento_id'=> $id
                ));
            }
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
  
    public function ConsumoTotalEqui() {
        $sql['CATEGORIA'] = $this->config_mdl->_query("SELECT *FROM abs_categoria
                                                       WHERE abs_categoria.categoria_id =".$_GET['categoria_id'])[0];
        
        $sql['TOTAL_EQUI'] = $this->config_mdl->_query("SELECT *FROM abs_equipamiento, abs_categoria 
                                                        WHERE abs_categoria.categoria_id = ".$_GET['categoria_id']."
                                                        AND abs_categoria.categoria_id = abs_equipamiento.categoria_id
                                                        ORDER BY equipamiento_id DESC");
        $this->load->view("Catalogos/ConsumoTotalEqui", $sql);
    }
    
    public function NuevoEquipamiento() {
        if(isset($_GET['equipamiento_id'])){
            $sql['CONTRATOS'] = $this->config_mdl->_query("SELECT *FROM abs_contrato");
            $sql['DATOS'] = $this->config_mdl->_query("SELECT *FROM abs_equipamiento
                                                       WHERE abs_equipamiento.equipamiento_id =".$_GET['equipamiento_id'])[0];
        }else{
            $sql['CONTRATOS'] = $this->config_mdl->_query("SELECT *FROM abs_contrato");
            $sql['DATOS'] = '';
        }
        $this->load->view('Catalogos/NuevoEquipamiento', $sql);
    }
    
    public function GuardarNuevoEquipamiento() {
        if($this->input->post('accion') == 'add') {
            $ext= md5(rand()).'.'.end(explode('.',$_FILES['equipamiento_imagen']['name']));
            if(copy($_FILES['equipamiento_imagen']['tmp_name'],'assets/evidencias_procedimiento/'.$ext)){
                $this->config_mdl->_insert('abs_equipamiento', array(
                    'equipamiento_serie'=> $this->input->post('equipamiento_serie'),
                    'contrato_id'=> $this->input->post('contrato_id'),
                    'equipamiento_nombre'=> $this->input->post('equipamiento_nombre'),
                    'equipamiento_imagen'=> $ext,
                    'equipamiento_descripcion'=> $this->input->post('equipamiento_descripcion'),
                    'categoria_id'=> $this->input->post('categoria_id'),
                    'equipamiento_status'=>0
                ));
            }
            $this->setOutput(array('accion'=>'1'));
        }else {
            if($_FILES['equipamiento_imagen']['name'] != ''){
                $ext= md5(rand()).'.'.end(explode('.',$_FILES['equipamiento_imagen']['name']));
                if(copy($_FILES['equipamiento_imagen']['tmp_name'],'assets/evidencias_procedimiento/'.$ext)){
                    $this->config_mdl->_update_data('abs_equipamiento', array(
                        'equipamiento_serie'=> $this->input->post('equipamiento_serie'),
                        'contrato_id'=> $this->input->post('contrato_id'),
                        'equipamiento_nombre'=> $this->input->post('equipamiento_nombre'),
                        'equipamiento_imagen'=> $ext,
                        'equipamiento_descripcion'=> $this->input->post('equipamiento_descripcion'),
                        'categoria_id'=> $this->input->post('categoria_id'),
                        'equipamiento_status'=>0
                    ), array(
                        'equipamiento_id'=> $this->input->post('id_equipamiento')
                    ));
                }
            }else {
                $this->config_mdl->_update_data('abs_equipamiento', array(
                    'equipamiento_serie'=> $this->input->post('equipamiento_serie'),
                    'contrato_id'=> $this->input->post('contrato_id'),
                    'equipamiento_nombre'=> $this->input->post('equipamiento_nombre'),
                    'equipamiento_descripcion'=> $this->input->post('equipamiento_descripcion'),
                    'categoria_id'=> $this->input->post('categoria_id')
                ), array(
                    'equipamiento_id'=> $this->input->post('id_equipamiento')
                ));
            }
            
        }
        
        $sql = $this->config_mdl->_query("SELECT *FROM abs_categoria WHERE abs_categoria.categoria_id =".$this->input->post('categoria_id'));
        if(!empty($sql)){
            $this->config_mdl->_update_data('abs_categoria', array(
                    'categoria_status'=> 1
                ), array(
                    'categoria_id'=> $this->input->post('categoria_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Contratos() {
        $sql['CONTRATOS'] = $this->config_mdl->_query("SELECT *FROM abs_contrato");
        $this->load->view("Catalogos/Contratos", $sql);
    }
    
    public function NuevoContrato() {
        if(isset($_GET['contrato_id'])){
            $sql['DATOS'] = $this->config_mdl->_query("SELECT *FROM abs_contrato WHERE abs_contrato.contrato_id =".$_GET['contrato_id'])[0];
        }else{
            $sql['DATOS'] = '';
        }
        $this->load->view("Catalogos/NuevoContrato", $sql);
    }
    
    public function GuardarNuevoContrato() {
        if($this->input->post('accion') == 'add') {
            $this->config_mdl->_insert('abs_contrato', array(
                'contrato_nombre'=> $this->input->post('contrato_nombre')
            ));
        }else {
            $this->config_mdl->_update_data('abs_contrato', array(
                'contrato_nombre'=> $this->input->post('contrato_nombre')
            ), array(
                'contrato_id'=> $this->input->post('id_contrato')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Categorias_Ins_Equi() {
        
        if($_GET['name']=='instrumental') {
            
            $sql['TOTAL_INS'] = $this->config_mdl->_query("SELECT *FROM abs_categoria
                                                           WHERE abs_categoria.categoria_tipo='instrumental' 
                                                           ORDER BY categoria_id DESC");
            $this->load->view("Catalogos/CategoriasPrincipal", $sql);
            
        } else if($_GET['name']=='equipamiento') {
            
            $sql['TOTAL_INS'] = $this->config_mdl->_query("SELECT *FROM abs_categoria
                                                           WHERE abs_categoria.categoria_tipo='equipamiento' 
                                                           ORDER BY categoria_id DESC");
            $this->load->view("Catalogos/CategoriasPrincipal", $sql);
            
        }
    }
    
    public function NuevaCategoria() {
        if(isset($_GET['id_categoria'])) {
            $sql['categoria'] = $this->config_mdl->_query("SELECT *FROM abs_categoria
                                                           WHERE abs_categoria.categoria_id =".$_GET['id_categoria'])[0];
        }else {
            $sql['categoria'] ='';
        }
        $this->load->view("Catalogos/NuevaCategoria", $sql);
    }
    
    public function GuardarCategoria() {
        if($this->input->post('accion') == 'add') {
            $this->config_mdl->_insert('abs_categoria', array(
                'categoria_nombre'=> $this->input->post('categoria_nombre'),
                'categoria_descripcion'=> $this->input->post('categoria_descripcion'),
                'categoria_tipo'=> $this->input->post('categoria_tipo'),
                'categoria_status'=>0
            ));
        }else {
            $this->config_mdl->_update_data('abs_categoria', array(
                'categoria_nombre'=> $this->input->post('categoria_nombre'),
                'categoria_descripcion'=> $this->input->post('categoria_descripcion')
            ), array(
                'categoria_id'=> $this->input->post('categoria_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function NuevaCharola() {
        if(isset($_GET['charola_id'])){
            $sql['CHAROLAS'] = $this->config_mdl->_query("SELECT *FROM abs_charola WHERE 
                                                          abs_charola.charola_id =".$_GET['charola_id'])[0];
        }else {
            $sql['CHAROLAS'] = '';
        }
        $this->load->view("Catalogos/NuevaCharola", $sql);
    }
    
    public function GuardarCharola() {
        if($this->input->post('accion') == 'add') {
            $this->config_mdl->_insert('abs_charola', array(
                'categoria_id'=> $this->input->post('id_categoria'),
                'charola_nombre'=> $this->input->post('charola_nombre'),
                'charola_descripcion'=> $this->input->post('charola_descripcion'),
                'charola_status'=>0
            ));
        }else {
            $this->config_mdl->_update_data('abs_charola', array(
                'charola_nombre'=> $this->input->post('charola_nombre'),
                'charola_descripcion'=> $this->input->post('charola_descripcion')
            ), array(
                'charola_id'=> $this->input->post('id_charola')
            ));
        }
        
        $sql = $this->config_mdl->_query("SELECT *FROM abs_charola
                                          WHERE abs_charola.categoria_id =".$this->input->post('id_categoria'));
        if(!empty($sql)){
            $this->config_mdl->_update_data('abs_categoria', array(
                    'categoria_status'=> 1
                ), array(
                    'categoria_id'=> $this->input->post('id_categoria')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Charolas() {
        $sql['CATEGORIA'] = $this->config_mdl->_query("SELECT *FROM abs_categoria WHERE abs_categoria.categoria_id =".$_GET['categoria_id'])[0];
        
        $sql['CHAROLAS'] = $this->config_mdl->_query("SELECT *FROM abs_charola, abs_categoria WHERE 
                                                      abs_categoria.categoria_id = abs_charola.categoria_id
                                                      AND abs_charola.categoria_id =".$_GET['categoria_id']."
                                                      ORDER BY abs_charola.charola_id DESC");
        
        $this->load->view("Catalogos/Charolas", $sql); 
    }

    public function EliminarImagen() {
        unlink('assets/evidencias_procedimiento/'.$_POST['imagen_Inst_Equip']);
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function EliminarEvidencia() {
        $this->config_mdl->_delete_data('abs_evidencias',array(
                'evidencias_id'=> $_POST['evidencia_id']
        ));
        
        unlink('assets/evidencias_procedimiento/'.$_POST['evidencia_nombre']);
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function EliminarCharola() {
        $this->config_mdl->_delete_data('abs_charola',array(
                'charola_id'=> $this->input->post('charola_id')
        ));
        
        $sql = $this->config_mdl->_query("SELECT *FROM abs_charola WHERE abs_charola.categoria_id =".$this->input->post('dependencia'));
            
        if(empty($sql)){
            $this->config_mdl->_update_data('abs_categoria', array(
                    'categoria_status'=> 0
                ), array(
                    'categoria_id'=> $this->input->post('dependencia')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function EliminarCategoria() {
        $this->config_mdl->_delete_data('abs_categoria',array(
                'categoria_id'=> $this->input->post('id_categoria')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxEliminar() {
        $tipo = $this->input->post('tipo');
        
        $this->config_mdl->_delete_data('abs_cantidad',array(
            'cantidad_id'=> $this->input->post('id')
        ));

        if($tipo=='equipamiento'){
            $sql = $this->config_mdl->_query("SELECT *FROM abs_cantidad WHERE abs_cantidad.cantidad_tipo = '$tipo'
                                              AND abs_cantidad.tipo_inst_equi_id =".$this->input->post('dependencia'));
            if(empty($sql)){
                $this->config_mdl->_update_data('abs_equipamiento', array(
                        'equipamiento_status'=> 0
                    ), array(
                        'equipamiento_id'=> $this->input->post('dependencia')
                ));
            }
        }if($tipo=='instrumental'){
            $sql = $this->config_mdl->_query("SELECT *FROM abs_cantidad WHERE abs_cantidad.cantidad_tipo = '$tipo'
                                              AND abs_cantidad.tipo_inst_equi_id =".$this->input->post('dependencia'));            

            if(empty($sql)){
                $this->config_mdl->_update_data('abs_instrumental', array(
                        'instrumental_status'=> 0
                    ), array(
                        'instrumental_id'=> $this->input->post('dependencia')
                ));
            }
        }if($tipo=='Osteo_peticion'){       
            $this->config_mdl->_delete_data('abs_solicitud_osteo',array(
                'peticion_id'=> $this->input->post('peticion_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxInstrumentalOequipamiento() {
        if($this->input->post('tipo')=='equipamiento'){

            $this->config_mdl->_delete_data('abs_equipamiento',array(
                'equipamiento_id'=> $this->input->post('id')
            ));
            
            $sql = $this->config_mdl->_query("SELECT *FROM abs_equipamiento WHERE abs_equipamiento.categoria_id =".$this->input->post('dependencia'));
            if(empty($sql)){
                $this->config_mdl->_update_data('abs_categoria', array(
                        'categoria_status'=>0
                    ), array(
                        'categoria_id'=> $this->input->post('dependencia')
                ));
            }
        }if($this->input->post('tipo')=='instrumental'){
            $this->config_mdl->_delete_data('abs_instrumental',array(
                'instrumental_id'=> $this->input->post('id')
            ));
            
            $sql = $this->config_mdl->_query("SELECT *FROM abs_instrumental WHERE abs_instrumental.charola_id =".$this->input->post('dependencia'));
            if(empty($sql)){
                $this->config_mdl->_update_data('abs_charola', array(
                        'charola_status'=>0
                    ), array(
                        'charola_id'=> $this->input->post('dependencia')
                ));
            }
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function EliminarProced_Contr() {
        
        if($this->input->post("tipo") == 'procedimiento'){
            $this->config_mdl->_delete_data('abs_procedimiento',array(
                'procedimiento_id'=> $this->input->post('id')
            ));
            
        }if($this->input->post("tipo") == 'contrato'){
            
            $this->config_mdl->_delete_data('abs_contrato',array(
                'contrato_id'=> $this->input->post('id')
            ));
            
        }if($this->input->post("tipo")=='vale'){
            
            $this->config_mdl->_update_data('abs_inventario',array(
                'inventario_status'=>'false',
                'vale_servicio_id'=>0,
                'inventario_status'=>'SIN ASIGNAR'
            ),array(
                'vale_servicio_id'=>$this->input->post('id')
            ));
            
            $this->config_mdl->_delete_data('abs_instrumental_procedimiento',array(
                'vale_servicio_id'=> $this->input->post('id')
            ));
            
            $this->config_mdl->_delete_data('abs_equipamiento_procedimiento',array(
                'vale_servicio_id'=> $this->input->post('id')
            ));
        
            $this->config_mdl->_delete_data('abs_vale_servicio',array(
                    'vale_servicio_id'=> $this->input->post('id')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function SolicitarInventario() {
        for( $i= 0; $i < $this->input->post('cantidad_agregar'); $i++) {
            $this->config_mdl->_insert('abs_solicitud_osteo', array(
                'rango_id'=> $this->input->post('rango_id'),
                'tratamiento_id'=>$this->input->post('vale'),
                'peticion_fecha'=>Date('d-m-Y'),
                'peticion_hora'=> Date("H:i"),
                'confirmado'=>'no',
                'empleado_area'=> $this->UMAE_AREA,
                'empleado_id'=> $this->UMAE_USER,
                'tratamiento_qx'=>$this->input->post('tratamiento_qx'),
                'elemento_id'=>$this->input->post('elemento_id'),
                'sistema_id'=>$this->input->post('sistema_id'),
                'inventario_id'=>0
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function ImprimirInventarioOsteo() {
        $sql['solicitados'] = $this->config_mdl->_query("SELECT *FROM abs_solicitud_osteo, abs_rangos 
                                                         WHERE abs_solicitud_osteo.rango_id = abs_rangos.rango_id
                                                         AND abs_solicitud_osteo.tratamiento_id =".$_GET['vale']);
        
        $this->load->view("Catalogos/ImprimirOsteoInsumos", $sql); 
    }
    
    public function TerminarSolicitudOsteo() {
        $this->config_mdl->_update_data('abs_solicitud_osteo', array(
                'confirmado'=>'si'
            ), array (
                'tratamiento_id'=>$this->input->post('vale')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function ValeSolicitudes() {
        $sql['solicitados'] = $this->config_mdl->_query("SELECT *FROM abs_solicitud_osteo WHERE abs_solicitud_osteo.confirmado = 'si'");
        
        $this->load->view("Catalogos/ValeSolicitudes", $sql); 
    }
 
    public function SolicitudDetalles() {
        $sql['solicitados'] = $this->config_mdl->_query("SELECT * FROM abs_solicitud_osteo WHERE abs_solicitud_osteo.confirmado='si' AND abs_solicitud_osteo.tratamiento_id=".$_GET['peticion']);
        
        $sql['total_solicitud'] = $this->config_mdl->_query("SELECT COUNT(abs_solicitud_osteo.peticion_id) AS total_sol FROM abs_solicitud_osteo WHERE abs_solicitud_osteo.confirmado = 'si' AND abs_solicitud_osteo.tratamiento_id =".$_GET['peticion'])[0];
        
        $sql['total'] = $this->config_mdl->_query("SELECT COUNT(abs_inventario.inventario_id)AS total FROM abs_inventario
                                                   WHERE abs_inventario.vale_servicio_id = 0
                                                   AND abs_inventario.rango_id =".$_GET['rango'])[0];
        
        $this->load->view("Catalogos/SolicitudDetalles", $sql); 
    }
}

