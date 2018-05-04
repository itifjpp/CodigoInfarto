<?php  defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'modules/config/controllers/Config.php';
class Menu extends Config{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Menu_m','Menus_mdl'));
    }
    public function index(){
        $sql['info']=  $this->config_mdl->_get_data_condition('sigh_empleados',array(
            'empleado_id'=>$_SESSION['UMAE_USER']
        ))[0];
        $this->load->view('Menu/Header',$sql);
    }
    public function ObtenerMenu() {
        $Menus='';
        foreach ($this->Menu_m->_get_menuN1($_SESSION['UMAE_AREA']) as $mn1) { 
            if ($mn1['menuN1_c_m'] == '1'){
                $AccionN1=$mn1['menuN1_status']=='1' ? 'block': 'none';
                $Menus.='<li  style="display:'.$AccionN1.'!important">';
                        $Menus.='<a md-ink-ripple href="#">';
                            $Menus.='<span class="pull-right text-muted">';
                                $Menus.='<i class="fa fa-caret-down"></i>';
                            $Menus.='</span>';
                            $Menus.='<i class="icon fa '.$mn1['menuN1_icono'].' i-20"></i>';
                            $Menus.='<span class="font-normal" style="margin-left: -15px;">'.$mn1['menuN1_menu'].'</span>';
                        $Menus.= '</a>';
                        $Menus.= '<ul class="nav nav-sub">';
                        foreach ($this->Menu_m->_get_menuN2($mn1['menuN1_id']) as $mn2) {
                            if ($mn2['menuN2_c_m'] == '1'){
                                $Menus.= '<li>';
                                    $Menus.='<a md-ink-ripple style="padding-top: 10px;padding-bottom: 10px;">';
                                        $Menus.='<span class="pull-right text-muted">';
                                            $Menus.='<i class="fa fa-caret-down"></i>';
                                        $Menus.='</span>';
                                        $Menus.='<span class="font-normal">'.$mn2['menuN2_menu'].'</span>';
                                    $Menus.='</a>';
                                    $Menus.='<ul class="nav nav-sub">';
                                    foreach ($this->Menu_m->_get_menuN3($mn2['menuN2_id']) as $mn3) { 
                                        $Menus.= '<li>';
                                            $Menus.='<a md-ink-ripple href="'.  base_url().$mn3['menuN3_url'].'" style="padding: 10px 10px 7px 0px;margin-left: 10px">'.$mn3['menuN3_menu'].'</a>';
                                        $Menus.='</li>';
                                    }
                                    $Menus.='</ul>';
                                $Menus.= '</li>';
                            }else{
                                $Menus.= '<li>';
                                    $Menus.= '<a md-ink-ripple href="'.base_url().$mn2['menuN2_url'].'" style="padding-top: 10px;padding-bottom: 10px;">'.$mn2['menuN2_menu'].'</a>';
                                $Menus.= '</li>';                     
                            }
                        }
                        $Menus.= '</ul>';
                $Menus.= '</li>';
            }else{
                $AccionN1=$mn1['menuN1_status']=='1' ? 'block': 'none';
                $MenuN1_new=$mn1['menuN1_new']=='Si' ? '<i class="pull-right up " ><b class="label bg-info">NUEVO</b></i>': '';
                $Menus.= '<li  style="display:'.$AccionN1.'!important" class=" waves-effect " >';
                    $Menus.= '<a md-ink-ripple href="'.  base_url().$mn1['menuN1_url'].'">';
                        $Menus.=$MenuN1_new;
                        $Menus.='<i class="icon '.$mn1['menuN1_icono'].' i-20"></i>';
                    $Menus.='<span class="font-normal " style="margin-left: -15px;">'.$mn1['menuN1_menu'].'</span>';
                    $Menus.='</a>';
                $Menus.='</li>';
            }
        }
        echo $Menus;
    }
    public function footer() {
            return $this->load->view('Menu/Footer.php','',TRUE); 
    }
    public function HeaderBasico() {
        $this->load->view('Menu/HeaderBasico');
    }
    public function FooterBasico() {
        $this->load->view('Menu/FooterBasico');
    }
    public function Menus() {
        $sql['Gestion']=  $this->Menus_mdl->_get_menu_n1();
        $this->load->view('Menu/menu_n1',$sql);
    }
    public function insert_menuN1() {
        $data=array(
            'menuN1_menu'=>  $this->input->post('mn1_menu_1'),
            'menuN1_url'=>  $this->input->post('mn1_url'),
            'menuN1_c_m'=>  $this->input->post('mn1_c_m'),
            'menuN1_status'=>  $this->input->post('menuN1_status'),
            'menuN1_icono'=>  $this->input->post('mn1_icono')
        );
        if($this->input->post('accion')=='add'){
            if($this->Menus_mdl->_insert('menu_1',$data)){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }   
        }else{
            if($this->Menus_mdl->_update_menus('menu_1',$data,array('menuN1_id'=>  $this->input->post('mn1_id')))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }
    }
    public function get_menuN1() {
        $this->setOutput($this->Menus_mdl->_get_menus('menu_1',array('menuN1_id'=>  $this->input->post('id'))));
    }
    public function mn1_area() {
        $sql['Gestion']=  $this->Menus_mdl->_get_mn1_rol($this->input->get_post('m'));
        $this->load->view('Menu/menu_n1_rol',$sql);
    }
    public function get_areas_acceso() {
        foreach ($this->config_mdl->_get_data('sigh_areasacceso') as $value) {
            $option.='<option value="'.$value['areas_acceso_id'].'">'.$value['areas_acceso_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function insert_mn1_rol() {
        $sql=$this->Menus_mdl->_get_menus('menu_1_area',array(
            'menuN1_id'=>  $this->input->post('menuN1_id'),
            'areas_acceso_id'=>  $this->input->post('areas_acceso_id')
        ));
        if(empty($sql)){
            if($this->Menus_mdl->_insert('menu_1_area',array(
                'menuN1_id'=>  $this->input->post('menuN1_id'),
                'areas_acceso_id'=>  $this->input->post('areas_acceso_id')
            ))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            $this->setOutput(array('accion'=>'3','msj'=>'El area ya se encuentra agregado a este menu'));
        }
    }  
    public function delete_mn1_rol() {
        $sql=$this->Menus_mdl->_delete_menus('menu_1_area',array(
            'menuN1_id'=>  $this->input->post('menuN1_id'),
            'areas_acceso_id'=>  $this->input->post('areas_acceso_id')
        ));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    /*Menu nivel 2*/
    public function menuN2() {
        $sql['Gestion']=  $this->Menus_mdl->_get_menuN2($this->input->get_post('m'));
        $this->load->view('Menu/menu_n2',$sql);
    }
    public function insert_menuN2() {
        $data=array(
            'menuN2_menu'   =>  $this->input->post('menuN2_menu'),
            'menuN2_url'    =>  $this->input->post('menuN2_url'),
            'menuN2_c_m'    =>  $this->input->post('menuN2_c_m'),
            'menuN2_status' =>  $this->input->post('menuN2_status'),
            'menuN2_icono'  =>  $this->input->post('menuN2_icono'),
            'menuN1_id'     =>  $this->input->post('menuN1_id')
        );
        if($this->input->post('accion')=='add'){
            if($this->Menus_mdl->_insert('menu_2',$data)){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }   
        }else{
            if($this->Menus_mdl->_update_menus('menu_2',$data,array('menuN2_id'=>  $this->input->post('menuN2_id')))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }   
    }
    public function get_menuN2() {
        $this->setOutput($this->Menus_mdl->_get_menus('menu_2',array('menuN2_id'=>  $this->input->post('id'))));
    }
    /*Menu nivel 3*/
    public function menuN3() {
        $sql['Gestion']=  $this->Menus_mdl->_get_menuN3($this->input->get_post('m'));
        $this->load->view('Menu/menu_n3',$sql);
    }
    public function insert_menuN3() {
        $data=array(
            'menuN3_menu'   =>  $this->input->post('menuN3_menu'),
            'menuN3_url'    =>  $this->input->post('menuN3_url'),
            'menuN3_status' =>  $this->input->post('menuN3_status'),
            'menuN3_icono'  =>  $this->input->post('menuN3_icono'),
            'menuN2_id'     =>  $this->input->post('menuN2_id')
        );
        if($this->input->post('accion')=='add'){
            if($this->Menus_mdl->_insert('menu_3',$data)){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }   
        }else{
            if($this->Menus_mdl->_update_menus('menu_3',$data,array('menuN3_id'=>  $this->input->post('menuN3_id')))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }   
    }
    public function get_menuN3() {
        $this->setOutput($this->Menus_mdl->_get_menus('menu_3',array('menuN3_id'=>  $this->input->post('id'))));
    }    
    public function delete_mn3() {
        $sql=$this->Menus_mdl->_delete_menus('menu_3',array(
            'menuN3_id'=>  $this->input->post('id')
        ));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function delete_mn2() {
        $sql=$this->Menus_mdl->_delete_menus('menu_2',array(
            'menuN2_id'=>  $this->input->post('id')
        ));
        if($sql){
            $sql=$this->Menus_mdl->_delete_menus('menu_3',array(
                'menuN2_id'=>  $this->input->post('id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function delete_mn1() {
        foreach ($this->Menus_mdl->_get_menus('menu_2',array('menuN1_id'=>  $this->input->post('id'))) as $mn2) {
            foreach ($this->Menus_mdl->_get_menus('menu_3',array('menuN2_id'=>  $mn2['menuN2_id'])) as $mn3) {
                $sql=$this->Menus_mdl->_delete_menus('menu_3',array(
                    'menuN3_id'=>  $mn3['menuN3_id']
                ));
            }
            $sql=$this->Menus_mdl->_delete_menus('menu_2',array(
                'menuN2_id'=>  $mn2['menuN2_id']
            ));
        }
        if($sql){
            $sql=$this->Menus_mdl->_delete_menus('menu_1',array(
                'menuN1_id'=>  $this->input->post('id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function HeaderLanding() {
        $this->load->view('Menu/HeaderLanding');
    }
    public function FooterLanding() {
        $this->load->view('Menu/FooterLanding');
    }
    /*VERSION 2.0 IN TEMPLATE*/
    public function loadHeader() {
        $sql['info']=  $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$_SESSION['UMAE_USER']
        ))[0];
        $sql['css']= $this->loadFilesCss();
        $this->load->view('Menu/v2/Header',$sql);
    }
    public function loadFooter() {
        $files['scripts']= $this->loadFilesScripts();
        $this->load->view('Menu/v2/Footer',$files);
    }
    public function loadHeaderBasico() {
        $files['css']= $this->loadFilesCss();
        $this->load->view('Menu/v2/HeaderBasico',$files);
    }
    public function loadFooterBasico() {
        $files['scripts']= $this->loadFilesScripts();
        $this->load->view('Menu/v2/FooterBasico',$files);
    }
    public function loadMenu() {
        $Menus='';
        foreach ($this->Menu_m->_get_menuN1($_SESSION['UMAE_AREA']) as $mn1) { 
            if ($mn1['menuN1_c_m'] == '1'){
                $AccionN1=$mn1['menuN1_status']=='1' ? 'block': 'none';
                $Menus.='<li  style="display:'.$AccionN1.'!important">';
                        $Menus.='<a href="#">';
                            $Menus.='<i class="fa '.$mn1['menuN1_icono'].' color-white" style="font-size:16px!important"></i>';
                            $Menus.='<span class="title">'.$mn1['menuN1_menu'].'</span>';
                            $Menus.='<span class="arrow color-white"></span> ';
                        $Menus.= '</a>';
                        $Menus.= '<ul class="sub-menu">';
                        foreach ($this->Menu_m->_get_menuN2($mn1['menuN1_id']) as $mn2) {
                            if ($mn2['menuN2_c_m'] == '1'){
                                $Menus.= '<li>';
                                    $Menus.='<a md-ink-ripple style="padding-top: 10px;padding-bottom: 10px;">';
                                        $Menus.='<span class="pull-right text-muted">';
                                            $Menus.='<i class="fa fa-caret-down"></i>';
                                        $Menus.='</span>';
                                        $Menus.='<span class="font-normal">'.$mn2['menuN2_menu'].'</span>';
                                    $Menus.='</a>';
                                    $Menus.='<ul class="nav nav-sub">';
                                    foreach ($this->Menu_m->_get_menuN3($mn2['menuN2_id']) as $mn3) { 
                                        $Menus.= '<li>';
                                            $Menus.='<a href="'.  base_url().$mn3['menuN3_url'].'" style="padding: 10px 10px 7px 0px;margin-left: 10px">'.$mn3['menuN3_menu'].'</a>';
                                        $Menus.='</li>';
                                    }
                                    $Menus.='</ul>';
                                $Menus.= '</li>';
                            }else{
                                $Menus.= '<li>';
                                    $Menus.= '<a  href="'.base_url().$mn2['menuN2_url'].'" >'.$mn2['menuN2_menu'].'</a>';
                                $Menus.= '</li>';                     
                            }
                        }
                        $Menus.= '</ul>';
                $Menus.= '</li>';
            }else{
                $AccionN1=$mn1['menuN1_status']=='1' ? 'block': 'none';
                $Menus.='   <li style="display:'.$AccionN1.'!important" >';
                    $Menus.='   <a href="'.  base_url().$mn1['menuN1_url'].'">';
                            $Menus.='<i class=" '.$mn1['menuN1_icono'].' style="font-size:16px!important"></i>';
                    $Menus.='       <span class="title">'.$mn1['menuN1_menu'].'</span>';
                    $Menus.='   </a>';
                $Menus.='   </li>';
            }
        }
        echo $Menus;
    }
    public function loadFilesCss() {
        $css=array(
            'plugins/pace/pace-theme-flash.css',
            'plugins/bootstrapv3/css/bootstrap.min.css',
            'plugins/bootstrapv3/css/bootstrap-theme.min.css',
            'plugins/font-awesome/css/font-awesome.css',
            'plugins/animate.min.css',
            'plugins/jquery-scrollbar/jquery.scrollbar.css',
            'plugins/bootstrap-datepicker/css/datepicker.min.css',
            'plugins/bootstrap-fileinput/css/fileinput.css',
            'plugins/bootstrap-select2/select2.min.css',
            'plugins/jquery-notifications/css/messenger.css',
            'plugins/jquery-notifications/css/messenger-theme-flat.css',
            'plugins/jquery-notifications/css/location-sel.css',
            'plugins/bootstrap-tag/bootstrap-tagsinput.css',
            'plugins/bootstrap-datepicker/css/datepicker.css',
            'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css',
            'plugins/bootstrap-timepicker/css/bootstrap-timepicker.css',
            'plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css',
            'plugins/pace/pace-theme-flash.css',
            'plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css',
            'plugins/html5imageupload/demo.html5imageupload.css',
            'plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css',
            'plugins/fullcalendar3.8.0/fullcalendar.css',
            'webarch/css/webarch.css'
        );
        return $css;
    }
    public function loadFilesScripts() {
        $scripts=array(
            'plugins/jquery/jquery.js',
            'plugins/pace/pace.min.js',
            'plugins/jquery/jquery-1.11.3.min.js',
            'plugins/bootstrapv3/js/bootstrap.min.js',
            'plugins/jquery-block-ui/jqueryblockui.min.js',
            'plugins/jquery-unveil/jquery.unveil.min.js',
            'plugins/jquery-scrollbar/jquery.scrollbar.min.js',
            'plugins/jquery-numberAnimate/jquery.animateNumbers.js',
            'plugins/jquery-validation/js/jquery.validate.min.js',
            'plugins/bootstrap-select2/select2.min.js',
            'plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            
            'plugins/pace/pace.min.js',
            'plugins/extras/moment.js',
            'plugins/extras/underscore-min.js',
            'plugins/extras/backbone-min.js',
            'plugins/jquery-notifications/js/demo/demo.js',
            'plugins/jquery-inputmask/jquery.inputmask.min.js',
            'plugins/jquery-autonumeric/autoNumeric.js',
            'plugins/jquery-notifications/js/messenger.min.js',
            'plugins/jquery-notifications/js/messenger-theme-future.js',
            'plugins/jquery-notifications/js/demo/location-sel.js',
            'plugins/jquery-notifications/js/demo/theme-sel.js',
            'plugins/html5imageupload/html5imageupload.js',
            'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js',
            'plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
            'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
            'plugins/jquery-inputmask/jquery.inputmask.min.js',
            'plugins/bootstrap-tag/bootstrap-tagsinput.min.js',
            'plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js',
            'plugins/bootstrap-select2/select2.min.js',
            'plugins/footable/footable.all.min.js',
            'plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
            'plugins/jquery-validation/js/jquery.validate.min.js',
            'plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js',
            'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js',
            'plugins/extras/bootbox.min.js',
            'plugins/extras/jquery-idletimer.js',
            'plugins/bootstrap-fileinput/js/fileinput.js',
            'plugins/bootstrap-fileinput/js/fileinput_locale_es.js',
            'plugins/extras/jquery.cookie.js',
            'plugins/fullcalendar3.8.0/fullcalendar.js',
            'plugins/fullcalendar3.8.0/gcal.js',
            'plugins/fullcalendar3.8.0/locale/es.js',
            'plugins/pasteimage.js'
        );
        return $scripts;
    }
}
