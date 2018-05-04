<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class Dates {

   public $monthNames = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ]; 
   public $dayNames = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
   
   public function __construct() {
      Carbon::setLocale('es');
   }

   public function getMonth($date='') {
      if ($date != '') {
         $date = Carbon::parse($date);
         return $this->monthNames[$date->month-1];
      }
      else {

      }
   }

   public function getDayWeek($date='') {
      if ($date != '') {
         $date = Carbon::parse($date);
         return $this->dayNames[$date->dayOfWeek-1];
      }
      else {

      }
   }

   public function now() {
      return Carbon::now();
   }
   
   public function addDate($tipo='dias',$cantidad=1,$date='') {
      $dateAdd = FALSE;
      if ($date == '') {
         $date = Carbon::now();
      }
      switch ($tipo) {
         case 'dias': $dateAdd = $date->addDays($cantidad); break;
      }
      return $dateAdd; 
   }

   public function getDifferHuman($dateNotificacion = '2013-02-05 13:27:00') {
      $dateNotificacion = Carbon::parse($dateNotificacion);
      $dateNow = Carbon::now();
      $difference = $dateNotificacion->diffInSeconds($dateNow);
      if ($difference < 60) {
         // echo $difference . ' segundos <br>';      
         return ucfirst($dateNow->subSeconds($difference)->diffForHumans()); 
      }
      $difference = $dateNotificacion->diffInMinutes($dateNow);
      if ($difference < 60) {
         // echo $difference . ' minutos <br>';      
         return ucfirst($dateNow->subMinutes($difference)->diffForHumans()); 
      }
      $difference = $dateNotificacion->diffInHours($dateNow);
      if ($difference < 24) {
         // echo $difference . ' horas <br>';
         return ucfirst($dateNow->subHours($difference)->diffForHumans()); 
      }
      $difference = $dateNotificacion->diffInDays($dateNow);
      if ($difference < 7) {
         // echo $difference . ' días <br>';
         return ucfirst($dateNow->subDays($difference)->diffForHumans()); 
      }
      $difference = $dateNotificacion->diffInWeeks($dateNow);
      if ($difference < 5) {
         // echo $difference . ' semanas <br>';
         return ucfirst($dateNow->subWeeks($difference)->diffForHumans()); 
      }
      $difference = $dateNotificacion->diffInMonths($dateNow);
      if ($difference < 12) {
         // echo $difference . ' meses <br>';
         return ucfirst($dateNow->subMonths($difference)->diffForHumans()); 
      }
      $difference = $dateNotificacion->diffInYears($dateNow);
      // echo $difference . ' años <br>';
      return ucfirst($dateNow->subYears($difference)->diffForHumans());
   }
}

/* End of file Dates.php */
/* Location: ./application/libraries/Dates.php */