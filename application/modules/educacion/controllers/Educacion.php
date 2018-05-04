<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Enzeñanza
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Educacion extends Config{
    public function Cursos() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_cursos');
        $this->load->view('Cursos/index',$sql);
    }
    public function TotalUsuarios($data) {
        return count($this->config_mdl->sqlGetDataCondition('sigh_cursos_empleados',array(
            'curso_id'=>$data['curso_id']
        )));
    }
    public function AgregarCurso($Curso) {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_cursos',array(
            'curso_id'=>$Curso
        ))[0];
        $this->load->view('Cursos/CursoNuevo',$sql);
    }
    public function AjaxAgregarCurso() {
        $data=array(
            'curso_fecha'=> date('Y-m-d'),
            'curso_hora'=> date('H:i:s'),
            'curso_nombre'=> $this->input->post('curso_nombre'),
            'curso_descripcion'=> $this->input->post('curso_descripcion'),
            'curso_inicio_fecha'=> $this->input->post('curso_inicio_fecha'),
            'curso_inicio_hora'=> $this->input->post('curso_inicio_hora'),
            'curso_termino_fecha'=> $this->input->post('curso_termino_fecha'),
            'curso_termino_hora'=> $this->input->post('curso_termino_hora')
        );
        if($this->input->post('curso_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_cursos',$data);
        }else{
            unset($data['curso_fecha']);
            unset($data['curso_hora']);
            $this->config_mdl->sqlUpdate('sigh_cursos',$data,array(
                'curso_id'=> $this->input->post('curso_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function CursoUsuario() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_cursos',array(
            'curso_id'=>$_GET['curso']
        ))[0];
        $this->load->view('Cursos/CursoUsuario',$sql);
    }
    public function AjaxValidarUsuario() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('input_matricula')
        ));
        if(empty($sql)){
            $sql2= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                'empleado_matricula'=> substr($this->input->post('input_matricula'), 5)
            ));
            if(empty($sql2)){
                $this->config_mdl->sqlInsert('sigh_empleados',array(
                    'empleado_matricula'=>$this->input->post('input_matricula'),
                    'empleado_nombre'=>'S/N',
                    'empleado_categoria'=>'S/N'
                ));
            }else{
                $this->config_mdl->sqlUpdate('sigh_empleados',array(
                    'empleado_matricula'=>$this->input->post('input_matricula')
                ),array(
                    'empleado_id'=>$sql2[0]['empleado_id']
                ));
            }
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxUsuariosInCursos() {
        $Curso= $this->input->post('CursoID');
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cursos AS curso, sigh_cursos_empleados AS ce, sigh_empleados AS emp
                                                        WHERE ce.curso_id=curso.curso_id AND ce.empleado_id=emp.empleado_id AND curso.curso_id=$Curso ORDER BY ce.ce_id DESC");
        $tr='';
        $InCursos= count($sql);
        foreach ($sql as $value) {
            $tr.=   '<tr>
                        <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                        <td>'.$value['empleado_matricula'].'</td>
                        <td>'.$value['ce_fecha_ingreso'].' '.$value['ce_hora_ingreso'].'</td>
                        <td>'.($value['ce_fecha_egreso']=='' ? '<span class="label label-important">EGRESO NO ESPECIFICADO</span>': $value['ce_fecha_egreso'].' '.$value['ce_hora_egreso']).'</td>
                        <td class="text-center">
                            <i class="fa fa-trash-o sigh-color i-20 pointer tip elimiar-curso-usuario" data-id="'.$value['ce_id'].'" data-original-title="Eliminar usuario de este curso"></i>
                        </td>
                    </tr>';
        }
        $this->setOutput(array('tr'=>$tr,'InCursos'=>$InCursos));
    }

    public function AjaxCursoUsuario() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sql)){
            $check= $this->config_mdl->sqlGetDataCondition('sigh_cursos_empleados',array(
                'empleado_id'=> $sql[0]['empleado_id'],
                'curso_id'=> $this->input->post('curso_id')
            ));
            if(empty($check)){
                $data=array(
                    'ce_fecha_ingreso'=> date('Y-m-d'),
                    'ce_hora_ingreso'=> date('H:i:s'),
                    'curso_id'=> $this->input->post('curso_id'),
                    'empleado_id'=> $sql[0]['empleado_id']
                );
                $this->config_mdl->sqlInsert('sigh_cursos_empleados',$data);
                $this->setOutput(array('action'=>1));
            }else{
                if($check[0]['ce_fecha_egreso']==''){
                    $this->config_mdl->sqlUpdate('sigh_cursos_empleados',array(
                        'ce_fecha_egreso'=> date('Y-m-d'),
                        'ce_hora_egreso'=> date('H:i:s')
                    ),array(
                        'curso_id'=> $this->input->post('curso_id'),
                        'empleado_id'=> $sql[0]['empleado_id']
                    ));
                    $this->setOutput(array('action'=>1));
                }else{
                    $this->setOutput(array('action'=>3));
                }
                
            }    
        }else{
            //$this->setOutput(array('action'=>1));
            $this->setOutput(array('action'=>2));
        }      
    }
    public function AjaxEliminarUsuarioCurso() {
        $this->config_mdl->sqlDelete('sigh_cursos_empleados',array(
            'ce_id'=> $this->input->post('ce_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Credencializacion() {
        $this->load->view('Credencializacion/cred_index');
    }
    public function AjaxCredencializacion() {
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sqlCheck)){
            $sqlCred= $this->config_mdl->sqlGetDataCondition('sigh_empleados_credencializacion',array(
                'credencial_tipo'=> $this->input->post('credencial_tipo'),
                'empleado_id'=>$sqlCheck[0]['empleado_id']
            ));
            if(empty($sqlCred)){
                $this->config_mdl->sqlInsert('sigh_empleados_credencializacion',array(
                    'credencial_tipo'=> $this->input->post('credencial_tipo'),
                    'credencial_date'=> date("Y-m-d"),
                    'credencial_time'=> date("H:i:s"),
                    'empleado_id'=>$sqlCheck[0]['empleado_id'],
                    'empleado_autoriza'=> $this->UMAE_USER
                ));
                $this->setOutput(array('action'=>1));    
            }else{
                $this->setOutput(array('action'=>3));    
            }
            
        }else{
            $this->setOutput(array('action'=>2));
        }
    }
}


