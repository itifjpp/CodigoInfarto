<?php

/**
 * Description of Noticias
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Noticias extends Config{
    public function index(){
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT noti.*, em.empleado_nombre, em.empleado_ap,em.empleado_am  FROM sigh_noticias AS noti, sigh_empleados AS em
                                                        WHERE noti.empleado_id=em.empleado_id ORDER BY noticia_id DESC");
        $this->load->view('Noticias/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_noticias',array(
            'noticia_id'=>$_GET['noticia']
        ))[0];
        $this->load->view('Noticias/Agregar',$sql);
    }
    public function AjaxAgregar() {
        $data=array(
            'noticia_titulo'=> $this->input->post('noticia_titulo'),
            'noticia_descripcion_breve'=> $this->input->post('noticia_descripcion_breve'),
            'noticia_descripcion'=> $this->input->post('noticia_descripcion'),
            'noticia_fecha'=> $this->input->post('noticia_fecha'),
            'noticia_hora'=> $this->input->post('noticia_hora'),
            'noticia_fecha_gen'=> date('Y-m-d H:i:s'),
            'noticia_portada'=> $this->input->post('noticia_portada'),
            'noticia_status'=>'En Espera',
            'empleado_id'=> $this->UMAE_USER
        );
        if($this->input->post('noticia_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_noticias',$data);
            
        }else{
            unset($data['noticia_status']);
            unset($data['noticia_fecha_gen']);
            unset($data['empleado_id']);
            $this->config_mdl->sqlUpdate('sigh_noticias',$data,array(
                'noticia_id'=> $this->input->post('noticia_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function Imagenes() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('sigh_noticias_img',array(
            'noticia_id'=>$_GET['noticia']
        ));
        $this->load->view('Noticias/Imagenes',$sql);
    }
    public function ImagenesAgregar() {
        $this->load->view('Noticias/ImagenesAgregar');
    }
    public function AjaxImagenesAgregar() {
        $this->config_mdl->sqlInsert('sigh_noticias_img',array(
            'img_url'=> $this->input->post('img_url'),
            'noticia_id'=> $this->input->post('noticia_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjxEliminarImg() {
        unlink('assets/Noticias/'.$this->input->post('img_url'));
        $this->config_mdl->sqlDelete('sigh_noticias_img',array(
            'img_id'=> $this->input->post('img_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxPublicarNoticia() {
        $this->config_mdl->sqlUpdate('sigh_noticias',array(
            'noticia_status'=> $this->input->post('noticia_status')
        ),array(
            'noticia_id'=> $this->input->post('noticia_id')
        ));
        $checkIfNotificacion= $this->config_mdl->sqlGetDataCondition('sigh_notificaciones',array(
            'notificacion_tipo'=>'Noticias',
            'notificacion_url'=>'Sections/Noticias/Detalles?not='. $this->input->post('noticia_id')
        ));
        if(empty($checkIfNotificacion) && $this->input->post('noticia_status')=='Publicado'){
            $sqlNoticia= $this->config_mdl->sqlGetDataCondition('sigh_noticias',array(
                'noticia_id'=> $this->input->post('noticia_id')
            ))[0];
            $this->config_mdl->sqlInsert('sigh_notificaciones',array(
                'notificacion_fecha'=> date('Y-m-d'),
                'notificacion_hora'=> date('H:i'),
                'notificacion_titulo'=>$sqlNoticia['noticia_titulo'],
                'notificacion_descripcion'=>$sqlNoticia['noticia_descripcion_breve'],
                'notificacion_tipo'=>'Noticias',
                'notificacion_url'=>'Sections/Noticias/Detalles?not='. $this->input->post('noticia_id')
            ));
            $sqlLastNotificacion= $this->config_mdl->sqlGetLastId('sigh_notificaciones','notificacion_id');
            $sqlEmpleados= $this->config_mdl->sqlQuery("SELECT emp.empleado_id FROM sigh_empleados AS emp WHERE emp.empleado_acceso_f!=''");
            foreach ($sqlEmpleados as $value) {
                $this->config_mdl->sqlInsert('sigh_notificaciones_usuarios',array(
                    'nu_status'=>'Nuevo',
                    'notificacion_id'=>$sqlLastNotificacion,
                    'empleado_id'=> $value['empleado_id']
                ));
            }    
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjxEliminarNoticia() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_noticias_img',array(
            'noticia_id'=> $this->input->post('noticia_id')
        ));
        foreach ($sql as $img){
            unlink('assets/Noticias/'.$img['img_url']);
        }
        $this->config_mdl->sqlDelete('sigh_noticias',array(
            'noticia_id'=> $this->input->post('noticia_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Detalles() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_noticias',array(
            'noticia_id'=> $_GET['not']
        ))[0];
        $sql['Empleado']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['empleado_id']
        ))[0];
        $sql['Galeria']= $this->config_mdl->sqlGetDataCondition('sigh_noticias_img',array(
            'noticia_id'=>$sql['info']['noticia_id']
        ));
        $sql['Noticias']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_noticias ORDER BY sigh_noticias.noticia_id DESC LIMIT 4");
        $this->load->view('Noticias/Detalles',$sql);
    }
    public function Todas() {
        $this->load->view('Noticias/Todas');
    }
    public function AjaxCargarNoticias() {
        $sql= $this->config_mdl->sqlQuery("SELECT noti.*, em.empleado_nombre, em.empleado_ap,em.empleado_am  FROM sigh_noticias AS noti, sigh_empleados AS em
                                            WHERE noti.empleado_id=em.empleado_id AND noti.noticia_status='Publicado' ORDER BY noticia_id DESC");
        $col='';
        foreach ($sql as $value) {
            $col.='<a href="'.base_url().'Sections/Noticias/Detalles?not='.$value['noticia_id'].'&via=all">
                    <div class="col-md-4 pointer" data-url="" style="margin-top: 10px">
                        <img src="'.base_url().'assets/Noticias/'.$value['noticia_portada'].'" style="width: 100%;border-radius: 5px">
                        <div class="noticia-img">
                            <div class="description">
                            <div class="text-nowrap-imss">'.$value['noticia_titulo'].'</div>
                                <hr class="hr-style1">
                                <h6 style="font-size: 10px;margin-bottom: 4px;margin-top: 0px"><b>FECHA Y HORA:</b> '.$value['noticia_fecha_gen'].'</h6>
                            </div>

                        </div>
                    </div>
                </a>';
        }
        $this->setOutput(array('col'=>$col));
    }
}
