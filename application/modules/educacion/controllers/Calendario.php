<?php

/**
 * Description of Calendario
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */

include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/phpqrcode/qrlib.php';

class Calendario extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_calendars');
        $this->load->view('Calendario/Calendars',$sql);
    }
    public function Calendar() {
        $sql['Hospitales']= $this->config_mdl->sqlGetData('sigh_hospitales');
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_calendars',array(
            'calendar_id'=>$_GET['cal']
        ))[0];
        $this->load->view('Calendario/Calendar',$sql);
    }
    public function AjaxCalendar() {
        $data=array(
            'calendar_title'=> $this->input->post('calendar_title'),
            'calendar_description'=> $this->input->post('calendar_description'),
            'calendar_id_google'=> $this->input->post('calendar_id_google'),
            'calendar_api_key'=> $this->input->post('calendar_api_key'),
            'calendar_cliente_id'=> $this->input->post('calendar_cliente_id'),
            'hospital_id'=> $this->input->post('hospital_id')
        );
        if($this->input->post('calendar_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_calendars',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_calendars',$data,array(
                'calendar_id'=> $this->input->post('calendar_id')
            ));
        }
        $this->setOutput(array('action'=>'1'));
    }
    public function Events() {
        $sql['Eventos']= $this->config_mdl->sqlGetDataCondition('sigh_calendars_events',array(
            'calendar_id'=>$_GET['calendar']
        ));
        $this->load->view('Calendario/CalendarEvents',$sql);
    }
    public function Event() {
        $this->load->view('Calendario/CalendarEvent');
    }
    public function AjaxEvent() {
        $data=array(
            'event_title'=> $this->input->post('event_title'),
            'event_location'=> $this->input->post('event_location'),
            'event_description'=> $this->input->post('event_description'),
            'event_start_date'=> $this->input->post('event_start_date'),
            'event_start_time'=> $this->input->post('event_start_time'),
            'event_end_date'=> $this->input->post('event_end_date'),
            'event_end_time'=> $this->input->post('event_end_time'),
            'calendar_id'=> $this->input->post('calendar_id')
        );
        $this->config_mdl->sqlInsert('sigh_calendars_events',$data);
        $sqlLast= $this->config_mdl->sqlGetLastId('sigh_calendars_events','event_id');
        file_put_contents("assets/EventGoogleCalendar.txt",'Insert='.$sqlLast);
        $this->setOutput(array('action'=>1));
    }
    public function CalendarEventsView() {
        
        $sql['infoCalendar']=$this->config_mdl->sqlGetDataCondition('sigh_calendars',array(
            'hospital_id'=> $this->sigh->getInfo('hospital_id')
        ))[0];
        $this->QrCalendarID($sql['infoCalendar']['calendar_url_publica']);
        $this->load->view('Calendario/CalendarEventsView',$sql);
    }
    public function QrCalendarID($msj) {
        $codeContents = 'https://calendar.google.com/calendar/embed?src=proyectos.bientics%40gmail.com&ctz=America%2FMexico_City'; 
        $fileName = 'QR_CALENDAR.png'; 
        $pngAbsoluteFilePath = 'assets/img/'.$fileName; 
        // generating 
        QRcode::png($msj, $pngAbsoluteFilePath); 
    }
    public function ActionsEvents() {
        $sql['infoCalendar']=$this->config_mdl->sqlGetDataCondition('sigh_calendars',array(
            'hospital_id'=> $this->sigh->getInfo('hospital_id')
        ))[0];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_calendars AS calendar, sigh_calendars_events AS evento WHERE 
                                                    evento.calendar_id=calendar.calendar_id AND evento.event_id=".$_GET['event'])[0];
        if($_GET['action']=='Insert'){
            $this->load->view('Calendario/PublishEvent',$sql);
        }else{
            $this->load->view('Calendario/DeleteEvent',$sql);
        }
    }
    public function AjaxActualizarEvento() {
        $this->config_mdl->sqlUpdate('sigh_calendars_events',array(
            'event_idc'=> $this->input->post('event_idc')
        ),array(
            'event_id'=> $this->input->post('event_id')
        ));
        $this->setOutput(array('action'=>'1'));
    }
    public function DeleteEvent() {
        
        $sql['info']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_calendars AS calendar, sigh_calendars_events AS evento WHERE 
                                                    evento.calendar_id=calendar.calendar_id AND evento.event_id=".$_GET['event'])[0];
        $this->load->view('Calendario/DeleteEvent',$sql);
    }
    public function AjaxDeleteEvent() {
        file_put_contents("assets/EventGoogleCalendar.txt",'Delete='.$this->input->post('event_id'));
        $this->setOutput(array('action'=>'1'));
    }
    public function AjaxDeleteEventEnd() {
        $this->config_mdl->sqlDelete('sigh_calendars_events',array(
            'event_id'=> $this->input->post('event_id')
        ));
        $this->setOutput(array('action'=>'1'));
    }
}
