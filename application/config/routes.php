<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'sections/login';
$route['login']='sections/login';
$route['Status']='sections/login/Status';
$route['404_override'] = 'Error/index';
$route['Landing']='Sections/Landing/index';
$route['RopaQuirurgica']='Sections/Usuarios/RopaQuirurgica';
$route['CalendarioDeActividades']='Educacion/Calendario/CalendarEventsView';
$route['AvisoLegal']='Inicio/AvisoLegal';
$route['Privacidad']='Inicio/Privacidad';
$route['Registro']='Educacion/Registro';
$route['AnalisisDeIngresos']='Urgencias/Graficas/AnalisisDeIngresos';
$route['translate_uri_dashes'] = FALSE;
