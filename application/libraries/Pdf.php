<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once APPPATH."/third_party/tcpdf/tcpdf.php";

class Pdf extends TCPDF {
    
   public $pdf;
   
   public $path_background;

   private $ci;

   public function __construct() {
      parent::__construct();
      $this->ci =& get_instance();
      // !$this->ci->load->helper('variado_helper') ? $this->ci->load->helper('variado_helper') : FALSE;
      $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
   }

   public function guardarSolicitudConsumoPDF($infoSolicitud,$materiales,$medico,$derechohabiente) {
      $pdf = new SolicitudConsummoPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(0);
      $pdf->SetFooterMargin(0);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();
      $pdf->SetFont('helvetica', '', 12);
      $table = '<table><tbody>';
      foreach ($materiales as $key => $material) {
         $table .= 
         '<tr>
            <td style="width:85px;text-align:center;">'.$material['cantidad'].'</td>
            <td>
               &nbsp;&nbsp;&nbsp;'.$material['nombre'].'
            </td>
         </tr>';
      }
      $table .= '</tbody></table>';
      // ------------------------------------------------------------------------
      // Configuración lista de materiales
      $pdf->setCellPaddings(0,0,0,0);
      $pdf->SetTopMargin(70);
      $pdf->SetX(3, true, true);
      $pdf->SetRightMargin(3);
      $pdf->setPageOrientation('',true,75);
      $pdf->writeHTML($table, true, false, true, false, '');
      // Fin configuración
      // ------------------------------------------------------------------------
      $pdf->Text(145,12,$infoSolicitud['folio']);
      // ------------------------------------------------------------------------
      // Fecha Emisión
      $pdf->Text(175,23,$infoSolicitud['diaMesEmision']);
      $pdf->Text(188,23,$infoSolicitud['mesEmision']);
      $pdf->Text(199,23,$infoSolicitud['yearEmision']);
      // ------------------------------------------------------------------------
      // Fecha Tratamiento
      $pdf->Text(175,32,$infoSolicitud['diaMesTratamiento']);
      $pdf->Text(188,32,$infoSolicitud['mesTratamiento']);
      $pdf->Text(199,32,$infoSolicitud['yearTratamiento']);
      // ------------------------------------------------------------------------
      // Datos
      $pdf->Text(55,42,$medico['matricula'].' - '.$medico['nombre'].' '.$medico['apellido_paterno'].' '.$medico['apellido_materno']);
      $pdf->Text(55,52,$derechohabiente['nss'].' - '.$derechohabiente['nombre'].' '.$derechohabiente['apellido_paterno'].' '.$derechohabiente['apellido_materno']);
      
      $pdf->Output(__DIR__.'/../../'.$infoSolicitud['ruta_save'].'/'.$infoSolicitud['solcitudPdf'], 'F');
      
      return TRUE;
   }

   public function guardarSolicitudProvPDF($idProveedor,$materiales,$infoSolicitud) {
      $pdf = new EntregaConsumoPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(0);
      $pdf->SetFooterMargin(0);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $pdf->AddPage();
      $pdf->SetFont('helvetica', '', 12);
      $table = '<table><tbody>';
      foreach ($materiales as $key => $material) {
         if ($material['sistema']['idProveedor'] == $idProveedor) {
            $table .= 
            '<tr>
               <td style="width:85px;text-align:center;">'.$material['info']['cantidadSolicitada'].'</td>
               <td>
                  &nbsp;&nbsp;&nbsp;'.$material['info']['nombre'].'
               </td>
            </tr>';
         }
      }
      $table .= '</tbody></table>';
      $pdf->Text(145,10,$infoSolicitud['folio']);
      $pdf->setCellPaddings(0,0,0,0);
      $pdf->SetTopMargin(65);
      $pdf->SetX(3, true, true);
      $pdf->SetRightMargin(3);
      $pdf->setPageOrientation('',true,75);
      $pdf->writeHTML($table, true, false, true, false, '');
      // $pdf->writeHTMLCell(0, 0, 32, 65, $materiales, 0, 1, 0, true, 'L', true);
      // $pdf->writeHTMLCell(0, 0, 10, 65, $cantidad, 0, 1, 0, true, 'L', true);
      $pdf->Output(__DIR__.'/../../documentos/asa.pdf', 'F');
      // $pdf->Output('example_001.pdf', 'I');
   }

   public function generarBarcodeMateriales($materiales,$idTratamiento) {
      $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      // set auto page breaks
      $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      // set image scale factor
      $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      // set font
      $this->pdf->SetFont('helvetica', '', 11);
      // define barcode style
      $style = array(
         'position'     => '',
         'align'        => 'C',
         'stretch'      => false,
         'fitwidth'     => true,
         'cellfitalign' => '',
         'border'       => true,
         'hpadding'     => 'auto',
         'vpadding'     => 'auto',
         'fgcolor'      => array(0,0,0),
         'bgcolor'      => false, //array(255,255,255),
         'text'         => true,
         'font'         => 'helvetica',
         'fontsize'     => 8,
         'stretchtext'  => 4
      );
      // add a page
      $this->pdf->AddPage();
      $this->pdf->Cell(0, 0, 'Lista de materiales', 0, 1);
      foreach ($materiales as $key => $value) {
         $this->pdf->Ln(2);
         $this->pdf->write1DBarcode($value['codigo_barra'], 'C39', '', '', '', 18, 0.4, $style, 'N');
      }
      $this->pdf->Output('materiales_'.$idTratamiento.'.pdf', 'I');
   }

   public function addNumToStr($num=0,$cant=5,$numAdd=0,$lado='l') {
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

class SolicitudConsummoPDF extends TCPDF {
   private $ci;
   public function Header() {
      $this->ci =& get_instance();
      $this->SetAutoPageBreak(false, 0);
      $img_file = $this->ci->config->item('nombre_documentos')['ruta'].$this->ci->config->item('nombre_documentos')['solicitud_consumo']['archivo'];
      $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
      $this->SetAutoPageBreak(TRUE,80);
      $this->setPageMark();
   }
}

class EntregaConsumoPDF extends TCPDF {
   private $ci;
   public function Header() {
      $this->ci =& get_instance();
      $this->SetAutoPageBreak(false, 0);
      $img_file = $this->ci->config->item('nombre_documentos')['ruta'].$this->ci->config->item('nombre_documentos')['entrega_solicitud']['archivo'];
      $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
      $this->SetAutoPageBreak(TRUE,80);
      $this->setPageMark();
   }
}