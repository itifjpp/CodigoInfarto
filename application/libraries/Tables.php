<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tables {
   
   private $ci;

   public $tOpen = '<table>';

   public $headOpen = '<thead>';

   public $headClose = '</thead>';

   public $headRowStart = '<tr>';

   public $headRowEnd = '</tr>';

   public $headCellStart = '<th>';

   public $headCellEnd = '</th>';

   public $bodyOpen = '<tbody>';

   public $bodyClose = '</tbody>';

   public $rowStart = '<tr>';
   
   public $rowEnd = '</tr>';

   public $cellStart = '<td>';

   public $cellEnd = '</td>';

   public $footOpen = '<tfoot>';

   public $footClose = '</tfoot>';

   public $footRowStart = '<tr>';
   
   public $footRowEnd = '</tr>';

   public $footCellStart = '<td>';

   public $footCellEnd = '</td>';

   public $function = NULL;

   public $menosTotal = 0;

   public $noAttr = [];

   public function __construct($template=[]) {
      $this->ci =& get_instance();
      if (!empty($template)) {
         
      }
   }


   public function generate($data=[],$element='') {
      if (!empty($element)) {
         $this->function = $element;
         if (is_callable($this->function)) {
            return FALSE;
         }
         else {
            return call_user_func(get_class($this).'::'.$this->function,$data);
         }
      }
      else {
         // GENERAR TABLA COMPLETA
      }
   }

   public function tbodyTr($data) {
      $bodyHTML = '';
      foreach ($data as $keyData => $valueData) {
         $tr = $this->getAttr($data[$keyData],'tr');
         if ($tr !== FALSE) {
            $bodyHTML .= str_replace('<tr>','<tr '.$tr.' >',$this->rowStart);
         }
         else {
            $bodyHTML .= $this->rowStart;
         }
         $totalCell = count($valueData) - $this->menosTotal;
         $count = 0;
         foreach ($valueData as $keyValueData => $valueValueData) {
            if ($count < $totalCell) {
               if (!empty($this->noAttr)) {
                  if (array_search($keyValueData,$this->noAttr) === FALSE) {
                     $valueDataWithCall = $this->isCallBack($data[$keyData],$keyValueData,$valueValueData);
                     $cell = $this->getAttr($data[$keyData],$keyValueData);
                     if ($cell !== FALSE) {
                        $bodyHTML .= str_replace('<td>','<td '.$cell.' >'.$valueDataWithCall.$this->cellEnd,$this->cellStart);      
                     }
                     else {
                        $bodyHTML .= $this->cellStart.$valueDataWithCall.$this->cellEnd;
                     }
                  }
               }
               else {
                  $valueDataWithCall = $this->isCallBack($data[$keyData],$keyValueData,$valueValueData);
                  $cell = $this->getAttr($data[$keyData],$keyValueData);
                  if ($cell !== FALSE) {
                     $bodyHTML .= str_replace('<td>','<td '.$cell.' >'.$valueDataWithCall.$this->cellEnd,$this->cellStart);      
                  }
                  else {
                     $bodyHTML .= $this->cellStart.$valueDataWithCall.$this->cellEnd;
                  }
               }
            }
            else {
               break;
            }
            $count++;
         }
         $bodyHTML .= $this->rowEnd;
      }
      return $bodyHTML;
   }

   public function isCallBack($data,$key,$valueCell) {
      if (array_key_exists('callback',$data) and array_key_exists($key,$data['callback'])) {
         return call_user_func(get_class($this).'::'.$data['callback'][$key],$data,$key,$valueCell);
      }
      else {
         return $valueCell;
      }
   }

   private function setIconsMateriales($data,$key,$valueCell) {
      $btn = 
         '<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>
         <i data-id-accion="eliminar" data-toggle="tooltip" title="Desactivar" class="tip acciones fa fa-trash pointer fa-2x"></i>';
      if ($data['status'] == '0') {
         $btn = 
         '<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>
         <i data-id-accion="activar" data-toggle="tooltip" title="Activar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>';
      }
      return $btn;
   }

   private function setImagenMaterial($data,$key,$valueCell) {
      return '<img src="'.base_url('assets/img/materiales/'.$data['imagen']).'" height="30" width="30"></img>';
   }

   private function setStatus($data,$key,$valueCell) {
      return  ($valueCell == '1' ? '<span class="label b-green-i c-white">Activo</span>' : '<span class="label">Inactivo</span>');
   }

   private function switchBtn($data,$key,$valueCell) {
      if ($data['idEstado_Cirugia'] == '2') {
         return '<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>
         <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash-o pointer fa-2x"></i>
         <i data-id-accion="accion-esperar" data-toggle="tooltip" title="Materiales insuficientes" class="tip acciones fa fa-medkit pointer fa-2x"></i>';
      }
      else {
         return $valueCell;
      }
   }

   public function addCellValue($data='',$cell='index',$cellValue='') {
      foreach ($data as $key => $value) {
         $data[$key][$cell] = $cellValue;
      }
      return $data;
   }

   public function getAttr($data,$attr) {
      if (array_key_exists('attr',$data) and array_key_exists($attr,$data['attr'])) {
         $stringAttr = '';
         foreach ($data['attr'][$attr] as $key => $value) {
            if (array_key_exists($value,$data)) {
               $stringAttr .= $key.' = "'.$data[$value].'" ';
            }
            else {
               $stringAttr .= $key.' = "'.$value.'" ';  
            }
         }
         return $stringAttr;
      }
      else {
         return FALSE;
      }
   }

   public function setAttr($data='',$index='',$attr='attr') {
      $this->menosTotal++;
      if (!empty($data)) {
         if (is_array($index)) {
            $attrs = [];
            foreach ($data as $keyData => $valueData) {
               foreach ($index as $keyIndex => $valueIndex) {
                  if (array_key_exists($keyIndex,$valueData)) {
                     $attrs[$keyIndex] =  $valueIndex;
                  }
                  else {
                     $attrs[$keyIndex] =  $valueIndex;  
                  }
               }
               $data[$keyData][$attr] = $attrs;
            }
            return $data;
         }
         else if (is_string($index)) {
            // RECIBE STRING DE LOS ATRIBUTOS
         }
      }
   }

   public function setCallBack($data='',$index='') {
      return $this->setAttr($data,$index,'callback');
   }

}

/* End of file Tables.php */