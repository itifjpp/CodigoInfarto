<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_select')) {
	/**
	 * [format_select Recibe un array y lo formatea en un select: 'nombre_columna AS nuevo_nombre']
	 * @param  [Array] $array_s   [Arrays de select]
	 * @return [boolean/string]   [Retorna string formateado o false en caso de un error]
	 */
	function format_select($array_s) {
		if (is_array($array_s)) {
			$formated = '';
			foreach ($array_s as $key => $value) {
				if (is_string($key) and is_string($value)) {
               if ($value == '*') {
                  $formated .= ' ' . $key . '.' . $value . ',';
               }
               else {
					 $formated .= ' ' . $key . ' AS ' . $value . ',';
               }
				} else {
					return false;
				}
			}
			return rtrim($formated, ',');
		} else {
			return false;
		}
	}
}

if (!function_exists('uniq_id')) {
	/**
	 * [uniq_id Retorna un hash en MD5 de una concatenación de uniqid() y rand()]
	 * @return [string] [Hashed]
	 */
	function uniq_id() {
		return md5(uniqid() . rand());
	}
}

if (!function_exists('addNumToStr')) {
   
   function addNumToStr($num=0,$cant=5,$numAdd=0,$lado='l') {
      if ($lado == 'l') {
        $string = str_pad($num,$cant,$numAdd,STR_PAD_LEFT);
      }
      else if ($lado == 'r') {
         $string = str_pad($num,$cant,$numAdd,STR_PAD_RIGHT);  
      }
      else {
         return FALSE;
      }
      return $string;
   }
}