<?php

/**
 * Description of Bibliografia
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Normativas extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT norma.*, rol.rol_nombre FROM sigh_roles AS rol, sigh_normativas AS norma WHERE rol.rol_id=norma.normativa_especialidad ORDER BY norma.normativa_id DESC");
        $this->load->view('Normativas/index',$sql);
    }
    public function NuevaNormativa() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_normativas',array(
            'normativa_id'=>$_GET['norma']
        ))[0];
        $sql['Areas']= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_status'=>''
        ));
        $sql['Roles']= $this->config_mdl->sqlGetData('sigh_roles');
        $this->load->view('Normativas/NuevaNormativa',$sql);
    }
    public function AjaxNuevaNormativa() {
        if($_FILES['normativa_file']['name']!=''){
            $Name=date('Ymdhis').'.'.end(explode('.', $_FILES['normativa_file']['name']));
            copy($_FILES['normativa_file']['tmp_name'], 'assets/Normativas/'.$Name);
        }
        $data=array(
            'normativa_fecha'=> date('Y-m-d'),
            'normativa_hora'=>date('H:i:s'),
            'normativa_titulo'=> $this->input->post('normativa_titulo'),
            'normativa_institucion'=> $this->input->post('normativa_institucion'),
            'normativa_especialidad'=> $this->input->post('normativa_especialidad'),
            'normativa_grupo_etario'=> $this->input->post('normativa_grupo_etario'),
            'normativa_nivel_atencion'=> $this->input->post('normativa_nivel_atencion'),
            'normativa_fecha_publicacion'=> $this->input->post('normativa_fecha_publicacion'),
            'normativa_categoria'=> $this->input->post('normativa_categoria'),
            'normativa_file'=> $Name,
            'normativa_portada'=> $this->input->post('normativa_portada'),
            'empleado_id'=> $this->UMAE_USER
        );
        if($_FILES['normativa_file']['name']==''){
            unset($data['normativa_fecha']);
            unset($data['normativa_hora']);
            unset($data['normativa_file']);
        }
        if($this->input->post('normativa_action')=='add'){
            
            $this->config_mdl->sqlInsert('sigh_normativas',$data);
            $sqlMax= $this->config_mdl->sqlGetLastId('sigh_normativas','normativa_id');
        }else{
            $this->config_mdl->sqlUpdate('sigh_normativas',$data,array(
                'normativa_id'=> $this->input->post('normativa_id')
            ));
            $sqlMax= $this->input->post('normativa_id');
        }
        $this->config_mdl->sqlDelete('sigh_normativas_areas',array('normativa_id'=>$sqlMax,));
        foreach ($this->input->post('areas_id') as $value) {
            $this->config_mdl->sqlInsert('sigh_normativas_areas',array(
                'normativa_id'=>$sqlMax,
                'area_id'=>$value
            ));
        }
        $this->setOutput(array(
            'accion'=>'1'
        ));
    }
    public function AjaxEliminarNormativa() {
        unlink('assets/Normativas/'.$this->input->post('normativa_file'));
        $this->config_mdl->sqlDelete('sigh_normativas',array(
            'normativa_id'=> $this->input->post('normativa_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Todas() {
        $this->load->view('Normativas/Todas');
    }
    public function AjaxCargarNormativas() {
         $Area= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_nombre'=> $this->UMAE_AREA
        ))[0];
        $inputStart= $this->input->post('inputStart');
        $inputLimit= $this->input->post('inputLimit');
        $sql=$this->config_mdl->sqlQuery("SELECT * FROM os_areas_acceso AS acc, um_normativas_areas AS na, um_normativas AS norma
                                            WHERE 
                                            na.normativa_id=norma.normativa_id AND
                                            na.area_id=acc.areas_acceso_id AND 
                                            acc.areas_acceso_id=".$Area['areas_acceso_id']." ORDER BY norma.normativa_id ASC LIMIT $inputStart,$inputLimit");
        $col='';
        foreach ($sql as $value) {
            $col.='<div class="col-md-4 pointer open-doc-click" data-url="assets/Normativas/'.$value['normativa_file'].'" style="margin-top: 5px;padding:4px">
                    <div class="tiles back-imss m-b-10" style="border-radius: 2px;">
                        <div class="tiles-body" style="padding: 10px 12px 6px 12px;">
                            <div class="controller"> 
                                <img src="'. base_url().'assets/img/Pdf-icon.png" style="margin-top: -6px;width: 36px;">
                            </div>
                            <div class="tiles-title text-white" style="font-size: 12px">'.$value['normativa_titulo'].'</div>
                            <hr class="hr-style1">
                            <div class="description" style="line-height: 1.4"> 
                                <span class="text-white mini-description " style="font-size: 10px">
                                    FECHA: '.$value['normativa_fecha'].' '.$value['normativa_hora'].'&nbsp;&nbsp;&nbsp; G. ETARIO: '.$value['normativa_grupo_etario'].' <br>
                                    CATEGORÍA: '.$value['normativa_categoria'].'<br>
                                    INSTITUCIÓN: '.$value['normativa_institucion'].'
                                </span>
                            </div>
                        </div>			
                    </div>	
                </div>';
        }
        $this->setOutput(array('col'=>$col));
    }
    public function Detalles() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_normativas',array(
            'normativa_id'=>$_GET['norma']
        ))[0];
        $this->load->view('Normativas/Detalles',$sql);
    }
}
