<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportes
 *
 * @author bienTICS
 */
include_once APPPATH.'modules/config/controllers/Config.php';
include_once APPPATH.'third_party/PHPExcel/PHPExcel.php';

class Reportes extends Config{
    private $objPHPExcel=null;
    public function __construct() {
        parent::__construct();
        $this->$this->objPHPExcel = new PHPExcel();
    }
    public function index() {
        if($_GET['inputFechaInicio']){
            $fi=$_GET['inputFechaInicio'];
            $ff=$_GET['inputFechaTermino'];
            $sql['info']= $this->config_mdl->_query("SELECT triage_id,triage_nombre, triage_nombre_ap, triage_nombre_am,triage_horacero_f,triage_horacero_h,
                                                    triage_fecha, triage_hora,
                                                    triage_fecha_clasifica,triage_hora_clasifica ,
                                                    triage_color
                                                    FROM os_triage WHERE 
                                                    triage_fecha_clasifica BETWEEN '$fi' AND '$ff' AND triage_fecha_clasifica!=''");
        }else{
            $sql['info']='';
        }
        $this->load->view('Reportes/index',$sql);
    }
    public function ReporteGeneral() {
        error_reporting(1);
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','600M');
        $fi=$_GET['inputFechaInicio'];
        $ff=$_GET['inputFechaTermino'];
        $sql= $this->config_mdl->_query("SELECT triage_id,triage_nombre, triage_nombre_ap, triage_nombre_am,triage_horacero_f,triage_horacero_h,
                                                triage_fecha, triage_hora,
                                                triage_fecha_clasifica,triage_hora_clasifica ,
                                                triage_color
                                                FROM os_triage WHERE 
                                                triage_fecha_clasifica BETWEEN '$fi' AND '$ff' AND triage_fecha_clasifica!=''");
        // Se crea el objeto PHPExcel
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator("UMAE | Dr. Victorio de la Fuente Narváez") // Nombre del autor
            ->setLastModifiedBy("UMAE | Dr. Victorio de la Fuente Narváez") //Ultimo usuario que lo modificó
            ->setTitle("UMAE | Dr. Victorio de la Fuente Narváez") // Titulo
            ->setSubject("UMAE | Dr. Victorio de la Fuente Narváez") //Asunto
            ->setDescription("REPORTE DE PACIENTES") //Descripción
            ->setKeywords("REPORTE DE PACIENTES") //Etiquetas
            ->setCategory("REPORTE DE PACIENTES"); //Categorias
        $tituloReporte = "REPORTE DE PACIENTES DEL ".$fi.' AL '.$ff.'('.count($sql).') PACIENTES';
        $titulosColumnas = array(
            'FOLIO ', //A
            'NOMBRE DEL PACIENTE ', //B
            'HORA CERO', //C
            'ENFERMERÍA TRIAGE',//D
            'MÉDICO TRIAGE',//E
            'CLASIFICACIÓN',//F
            'T.T HORACERO - MT'//G
        );
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:G1');

        // Se agregan los titulos del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2])
            ->setCellValue('D3',  $titulosColumnas[3])
            ->setCellValue('E3',  $titulosColumnas[4])
            ->setCellValue('F3',  $titulosColumnas[5])
            ->setCellValue('G3',  $titulosColumnas[6]);
        //Se agregan los datos de los alumnos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
        foreach ($sql as $value) {
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value['triage_horacero_f'] ) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value['triage_fecha_clasifica'] )){
                $TiempoHoraCero=Modules::run('Config/CalcularTiempoTranscurrido',array(
                    'Tiempo1'=>$value['triage_horacero_f'].' '.$value['triage_horacero_h'],
                    'Tiempo2'=>$value['triage_fecha_clasifica'].' '.$value['triage_hora_clasifica'],
                ));
                $Tiempo=$TiempoHoraCero->h*60 + $TiempoHoraCero->i;
            }else{
                $Tiempo=0;
            }
            
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $value['triage_id'])
                ->setCellValue('B'.$i, $value['triage_nombre_ap'].' '.$value['triage_nombre_am'].' '.$value['triage_nombre'])
                ->setCellValue('C'.$i, $value['triage_horacero_f'].' '.$value['triage_horacero_h'])
                ->setCellValue('D'.$i, $value['triage_fecha'].' '.$value['triage_hora'],'')
                ->setCellValue('E'.$i, $value['triage_fecha_clasifica'].' '.$value['triage_hora_clasifica'])
                ->setCellValue('F'.$i, $value['triage_color'])
                ->setCellValue('G'.$i,$Tiempo.' Minutos' );
             $i++;
         }
         
        for($i = 'A'; $i <= 'G'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        // Se asigna el nombre a la hoja
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        //
        
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $styleArray = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 15,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A1:G1')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        $styleArrayCols = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 10,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($styleArrayCols)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A3:G3')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE_DE_PACIENTES.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function ReportesGeneralCamas() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_areas, os_camas, os_pisos, os_pisos_camas WHERE
            os_areas.area_id=os_camas.area_id AND os_areas.area_modulo='Pisos' AND
            os_pisos.piso_id=os_pisos_camas.piso_id AND os_camas.cama_id=os_pisos_camas.cama_id");
        // Se crea el objeto PHPExcel
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator("UMAE | Dr. Victorio de la Fuente Narváez") // Nombre del autor
            ->setLastModifiedBy("UMAE | Dr. Victorio de la Fuente Narváez") //Ultimo usuario que lo modificó
            ->setTitle("UMAE | Dr. Victorio de la Fuente Narváez") // Titulo
            ->setSubject("UMAE | Dr. Victorio de la Fuente Narváez") //Asunto
            ->setDescription("REPORTE GENERAL DE CAMAS") //Descripción
            ->setKeywords("REPORTE GENERAL DE CAMAS") //Etiquetas
            ->setCategory("REPORTE GENERAL DE CAMAS"); //Categorias
        $tituloReporte = "REPORTE GENERAL DE CAMAS";
        $titulosColumnas = array(
            'PISO ', //A
            'ÁREA', //B
            'CAMAS', //C
            'ESTADO',//D
            'FECHA DE ESTADO',//E
            'TIEMPO TRANSCURRIDO',//F
        );
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:F1');

        // Se agregan los titulos del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2])
            ->setCellValue('D3',  $titulosColumnas[3])
            ->setCellValue('E3',  $titulosColumnas[4])
            ->setCellValue('F3',  $titulosColumnas[5]);
        //Se agregan los datos de los alumnos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
        foreach ($sql as $value) {
            if($value['cama_fh_estatus']!=''){
                $TiempoHoraCero=Modules::run('Config/CalcularTiempoTranscurrido',array(
                    'Tiempo1'=>$value['cama_fh_estatus'],
                    'Tiempo2'=> date('Y-m-d H:i:s'),
                ));
                $Tiempo=$TiempoHoraCero->d.' Días '.$TiempoHoraCero->h.' Hrs '.$TiempoHoraCero->i.' Min';
            }else{
                $Tiempo='NO SE PUEDE DETERMINAR';
            }
            
            
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $value['piso_nombre'])
                ->setCellValue('B'.$i, $value['area_nombre'])
                ->setCellValue('C'.$i, $value['cama_nombre'].'  ')
                ->setCellValue('D'.$i, $value['cama_status'])
                ->setCellValue('E'.$i, $value['cama_fh_estatus'])
                ->setCellValue('F'.$i, $Tiempo);
             $i++;
         }
         
        for($i = 'A'; $i <= 'F'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        // Se asigna el nombre a la hoja
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        //
        
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $styleArray = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 15,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A1:F1')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        $styleArrayCols = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 10,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($styleArrayCols)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A3:F3')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE_GENERAL_DE_CAMAS.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function ReporteGeneralCamasPDF() {
        $fecha=$_GET['fecha'];
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_areas, os_camas, os_pisos, os_pisos_camas, cm_camas_log WHERE
        os_areas.area_id=os_camas.area_id AND os_areas.area_modulo='Pisos' AND
        os_pisos.piso_id=os_pisos_camas.piso_id AND os_camas.cama_id=os_pisos_camas.cama_id AND
        os_camas.cama_id=cm_camas_log.cama_id AND cm_camas_log.log_fecha='$fecha'");
        $this->load->view('Reportes/ReportesCamas',$sql);
    }
    public function ImportarDiagnosticos() {
        header("Content-Type: text/html;charset=utf-8");
        //Nombre del Archivo a leer
        $this->objPHPExcel = PHPExcel_IOFactory::load('assets/CIE10.xlsx');
        //Asigno la hoja de calculo activa
        $this->objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $this->objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        for ($i = 1; $i <= $numRows; $i++) {
            if($this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!='Clave' && $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''){
                $this->config_mdl->_insert('um_hojafrontal_diagnosticoscie10',array(
                    'diagnostico_clave' => $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                    'diagnostico_nombre'=> $this->objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                    
                ));
                
            }
        }
        $this->setOutput(array('accion'=>'1'));
    }
    /*
     * REPORTES DE TIEMPO PROMEDIO DE HORACERO - MÉDICO TRIAGE POR COLOR DE 
     * CLASIFICACIÓN
     */
    public function UrgenciasTriage() {
        $this->load->view('Reportes/UrgenciasTriage');
    }
    public function AjaxUrgenciasTriage() {
        $inputFecha1= $this->input->post('inputFecha1');
        $inputFecha2= $this->input->post('inputFecha2');
        $Limit= $this->CalcularTiempoTranscurrido(array(
            'Tiempo1'=>$inputFecha1,
            'Tiempo2'=>$inputFecha2
        ));
        if($Limit->m<=1){
            $sql= $this->config_mdl->sqlQuery("SELECT count(t.triage_id) AS total FROM os_triage AS t, os_consultorios_especialidad_hf AS hf, paciente_info AS pac
                        WHERE t.triage_id=hf.triage_id AND
                        t.triage_id=pac.triage_id AND
                        hf.hf_fg BETWEEN '$inputFecha1' AND '$inputFecha2'");
            $this->setOutput(array(
                'accion'=>'1',
                'Total'=>$sql[0]['total']
            ));
        }else{
            $this->setOutput(array(
                'accion'=>'2',
                'LimitDay'=>$Limit->d,
                'LimitMonth'=>$Limit->m
            ));
        }
        
        
    }
    public function ExportReportUrgenciasTriage() {
        $inputFecha1= $this->input->get_post('inputFecha1');
        $inputFecha2= $this->input->get_post('inputFecha2');
        $sql= $this->config_mdl->sqlQuery("SELECT 
                        t.triage_id,
                        t.triage_nombre, t.triage_nombre_ap,t.triage_nombre_am,
                        pac.pum_nss,pac.pum_nss_agregado,pac.pia_procedencia_espontanea_lugar,
                        t.triage_horacero_f,t.triage_horacero_h,
                        t.triage_fecha,t.triage_hora,
                        t.triage_fecha_clasifica,t.triage_hora_clasifica,
                        t.triage_color,hf.hf_fg,hf.hf_hg 
                        FROM os_triage AS t, os_consultorios_especialidad_hf AS hf, paciente_info AS pac
                        WHERE t.triage_id=hf.triage_id AND
                        t.triage_id=pac.triage_id AND
                        hf.hf_fg BETWEEN '$inputFecha1' AND '$inputFecha2'");
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator("UMAE | Dr. Victorio de la Fuente Narváez") // Nombre del autor
            ->setLastModifiedBy("UMAE | Dr. Victorio de la Fuente Narváez") //Ultimo usuario que lo modificó
            ->setTitle("UMAE | Dr. Victorio de la Fuente Narváez") // Titulo
            ->setSubject("UMAE | Dr. Victorio de la Fuente Narváez") //Asunto
            ->setDescription("REPORTES URGENCIAS/TRIAGE") //Descripción
            ->setKeywords("REPORTES URGENCIAS/TRIAGE") //Etiquetas
            ->setCategory("REPORTES URGENCIAS/TRIAGE"); //Categorias
        $tituloReporte = "REPORTES URGENCIAS/TRIAGE";
        $titulosColumnas = array(
            'FOLIO',//A
            'NOMBRE ', //B
            'A PATERNO', //C
            'A MATERNO', //D
            'NSS',//E
            'NSS AGREGADO',//F
            'HC FECHA',//G
            'HC HORA',//H
            'ET FECHA',//I
            'ET HORA',//J
            'MT FECHA',//K
            'MT HORA',//L
            'FECHA Y HORA 430128',//M
            'CLASIFICACIÓN',//N
            'TIEMPO TRANSCURRIDO',//O,
            'TIEMPO EN ESPERA',//P
            'PROCEDENCIA'//Q
            
        );
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:Q1');

        // Se agregan los titulos del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2])
            ->setCellValue('D3',  $titulosColumnas[3])
            ->setCellValue('E3',  $titulosColumnas[4])
            ->setCellValue('F3',  $titulosColumnas[5])
            ->setCellValue('G3',  $titulosColumnas[6])
            ->setCellValue('H3',  $titulosColumnas[7])
            ->setCellValue('I3',  $titulosColumnas[8])
            ->setCellValue('J3',  $titulosColumnas[9])
            ->setCellValue('K3',  $titulosColumnas[10])
            ->setCellValue('L3',  $titulosColumnas[11])
            ->setCellValue('M3',  $titulosColumnas[12])
            ->setCellValue('N3',  $titulosColumnas[13])
            ->setCellValue('O3',  $titulosColumnas[14])
            ->setCellValue('P3',  $titulosColumnas[15])
            ->setCellValue('Q3',  $titulosColumnas[16]);
        //Se agregan los datos de los alumnos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
        foreach ($sql as $value) {
            $Tiempo=0;
            if($value['hf_fg']!=''){
                $TiempoHoraCero=Modules::run('Config/CalcularTiempoTranscurrido',array(
                    'Tiempo1'=>$value['triage_horacero_f'].' '.$value['triage_horacero_h'],
                    'Tiempo2'=>$value['hf_fg'].' '.$value['hf_hg'],
                ));
                $Tiempo=$TiempoHoraCero->h*60 + $TiempoHoraCero->i;
                if($value['triage_color']=='Rojo'){
                    $Max=10;
                }if($value['triage_color']=='Naranja'){
                    $Max=10;
                }if($value['triage_color']=='Amarillo'){
                    $Max=60;
                }if($value['triage_color']=='Verde'){
                    $Max=120;
                }if($value['triage_color']=='Azul'){
                    $Max=240;
                }
                if($Tiempo<$Max){
                    $tiempoEspera='ACEPTABLE';
                }else{
                    $tiempoEspera=($Tiempo-$Max).' Minutos';
                }
                
            }else{
                
            }
            
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $value['triage_id'])
                ->setCellValue('B'.$i, $value['triage_nombre'])
                ->setCellValue('C'.$i, $value['triage_nombre_ap'])
                ->setCellValue('D'.$i, $value['triage_nombre_am'])
                ->setCellValue('E'.$i, $value['pum_nss'])
                ->setCellValue('F'.$i, $value['pum_nss_agregado'])
                ->setCellValue('G'.$i, $value['triage_horacero_f'])
                ->setCellValue('H'.$i, $value['triage_horacero_h'])
                ->setCellValue('I'.$i, $value['triage_fecha'])
                ->setCellValue('J'.$i, $value['triage_hora'])
                ->setCellValue('K'.$i, $value['triage_fecha_clasifica'])
                ->setCellValue('L'.$i, $value['triage_hora_clasifica'])
                ->setCellValue('N'.$i, $value['hf_fg'].' '.$value['hf_hg'])
                ->setCellValue('M'.$i, $value['triage_color'])
                ->setCellValue('O'.$i, $Tiempo.' Minutos')
                ->setCellValue('P'.$i, $tiempoEspera)
                ->setCellValue('Q'.$i, $value['pia_procedencia_espontanea_lugar']);
             $i++;
         }
         
        for($i = 'A'; $i <= 'Q'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        // Se asigna el nombre a la hoja
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        //
        
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $styleArray = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 15,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A1:Q1')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        $styleArrayCols = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 10,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->getActiveSheet()->getStyle('A3:Q3')->applyFromArray($styleArrayCols)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A3:Q3')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE_URGENCIAS_TRIAGE.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function ReportesUrgencias() {
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator("UMAE | Dr. Victorio de la Fuente Narváez") // Nombre del autor
            ->setLastModifiedBy("UMAE | Dr. Victorio de la Fuente Narváez") //Ultimo usuario que lo modificó
            ->setTitle("UMAE | Dr. Victorio de la Fuente Narváez") // Titulo
            ->setSubject("UMAE | Dr. Victorio de la Fuente Narváez") //Asunto
            ->setDescription("REPORTES PACIENTES") //Descripción
            ->setKeywords("REPORTES URGENCIAS/TRIAGE") //Etiquetas
            ->setCategory("REPORTES PACIENTES"); //Categorias
        $tituloReporte = "REPORTES PACIENTES";
        $titulosColumnas = array(
            'N°',
            'FOLIO ', //A
            'PACIENTE', //B
            'A MATERNO', //C
            'A.MATERNO',//D
            'CURP',//E
            'NSS',//F
            'EDAD',//G
            'SEXO',//H
            'CLASIFICACIÓN',//I
            'DIAGNOSTICO',//J
            'FECHA Y HORA'
        );
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:L1');

        // Se agregan los titulos del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$tituloReporte) // Titulo del reporte
            ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2])
            ->setCellValue('D3',  $titulosColumnas[3])
            ->setCellValue('E3',  $titulosColumnas[4])
            ->setCellValue('F3',  $titulosColumnas[5])
            ->setCellValue('G3',  $titulosColumnas[6])
            ->setCellValue('H3',  $titulosColumnas[7])
            ->setCellValue('I3',  $titulosColumnas[8])
            ->setCellValue('J3',  $titulosColumnas[9])
            ->setCellValue('K3',  $titulosColumnas[10])
            ->setCellValue('L3',  $titulosColumnas[11]);
        //Se agregan los datos de los alumnos
        $i = 4; //Numero de fila donde se va a comenzar a rellenar
        
        $Hoy= date('Y-m-d H:i:s');
        $Gestion= $this->config_mdl->sqlQuery("SELECT c.acceso_fecha, c.acceso_hora, 
                                                    t.triage_id,t.triage_nombre, t.triage_nombre_ap, t.triage_nombre_am,
                                                    t.triage_fecha_nac, t.triage_paciente_sexo,t.triage_paciente_curp,
                                                    t.triage_color, t.triage_en
                                                    FROM os_triage AS t,os_accesos AS c WHERE
                                                    c.triage_id=t.triage_id AND 
                                                    c.acceso_fecha='2017-09-19' AND
                                                    c.acceso_hora BETWEEN '14:00:00' AND '23:59:59' AND c.acceso_tipo='Hora Cero' AND
                                                    t.triage_nombre!=''  ORDER BY t.triage_id DESC ");
        $Gestion2= $this->config_mdl->sqlQuery("SELECT c.acceso_fecha, c.acceso_hora, 
                                                    t.triage_id,t.triage_nombre, t.triage_nombre_ap, t.triage_nombre_am,
                                                    t.triage_fecha_nac, t.triage_paciente_sexo,t.triage_paciente_curp,
                                                    t.triage_color, t.triage_en
                                                    FROM os_triage AS t,os_accesos AS c WHERE
                                                    c.triage_id=t.triage_id AND 
                                                    c.acceso_fecha='2017-09-20' AND
                                                    c.acceso_hora BETWEEN '00:00:00' AND '$Hoy' AND c.acceso_tipo='Hora Cero' AND
                                                    t.triage_nombre!=''  ORDER BY t.triage_id DESC ");
        $num=0;
        foreach ($Gestion as $value) {
            $num++;
            $sqlNss=$this->config_mdl->sqlGetDataCondition('paciente_info',array(
                                'triage_id'=>$value['triage_id']
                        ),'pum_nss,pum_nss_agregado')[0];
            $sqlDx=$this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
                            'triage_id'=>$value['triage_id']
                        ),'hf_diagnosticos')[0];
            $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['triage_fecha_nac']));
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $num)
                ->setCellValue('B'.$i, $value['triage_id'])
                ->setCellValue('C'.$i, $value['triage_nombre'])
                ->setCellValue('D'.$i, $value['triage_nombre_ap'])
                ->setCellValue('E'.$i, $value['triage_nombre_am'])
                ->setCellValue('F'.$i, $value['triage_paciente_curp'])
                ->setCellValue('G'.$i, $sqlNss['pum_nss'].' '.$sqlNss['pum_nss_agregado'])
                ->setCellValue('H'.$i, ($fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'))
                ->setCellValue('I'.$i, $value['triage_paciente_sexo'])
                ->setCellValue('J'.$i, $value['triage_color'])
                ->setCellValue('K'.$i, $sqlDx['hf_diagnosticos'])
                ->setCellValue('L'.$i, $value['acceso_fecha'].' '.$value['acceso_hora']);
             $i++;
         }
        foreach ($Gestion2 as $value) {
            $num++;
            $sqlNss=$this->config_mdl->sqlGetDataCondition('paciente_info',array(
                                'triage_id'=>$value['triage_id']
                        ),'pum_nss,pum_nss_agregado')[0];
            $sqlDx=$this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
                            'triage_id'=>$value['triage_id']
                        ),'hf_diagnosticos')[0];
            $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['triage_fecha_nac']));
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $num)
                ->setCellValue('B'.$i, $value['triage_id'])
                ->setCellValue('C'.$i, $value['triage_nombre'])
                ->setCellValue('D'.$i, $value['triage_nombre_ap'])
                ->setCellValue('E'.$i, $value['triage_nombre_am'])
                ->setCellValue('F'.$i, $value['triage_paciente_curp'])
                ->setCellValue('G'.$i, $sqlNss['pum_nss'].' '.$sqlNss['pum_nss_agregado'])
                ->setCellValue('H'.$i, ($fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'))
                ->setCellValue('I'.$i, $value['triage_paciente_sexo'])
                ->setCellValue('J'.$i, $value['triage_color'])
                ->setCellValue('K'.$i, $sqlDx['hf_diagnosticos'])
                ->setCellValue('L'.$i, $value['acceso_fecha'].' '.$value['acceso_hora']);
             $i++;
        }
        for($i = 'A'; $i <= 'L'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        // Se asigna el nombre a la hoja
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        //
        
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $styleArray = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 15,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A1:N1')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        $styleArrayCols = array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => 10,
            'name'  => 'Verdana',
        ));
        $this->objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($styleArrayCols)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
                    ->getStyle('A3:L3')
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '256659')
                            )
                        )
                    );
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE_PACIENTES.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function StyleReport($size) {
        return array(
            'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size'  => $size,
            'name'  => 'Verdana',
        ));
    }
    public function BackReport($size,$range) {
        
        $this->objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray($this->StyleReport($size))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->objPHPExcel->getActiveSheet()
        ->getStyle($range)
        ->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '256659')
                )
            )
        );
    }
    public function sighBgReport($bg,$size,$range,$align) {
        if($align=='center'){
            $this->objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray($this->StyleReport($size))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }if($align=='left'){
            $this->objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray($this->StyleReport($size))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }if($align=='right'){
            $this->objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray($this->StyleReport($size))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        }
        $this->objPHPExcel->getActiveSheet()
        ->getStyle($range)
        ->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => $bg)
                )
            )
        );
    }
    public function ReporteStatusHospital() {
        $Hospital= $this->config_mdl->sqlGetDataCondition('um_hospitales',array(
            'hospital_id'=>$_GET['hos']
        ))[0];
        $info= $this->config_mdl->sqlGetDataCondition('um_hospitales_status',array(
            'status_id'=>$_GET['st']
        ))[0];
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator("UMAE | Dr. Victorio de la Fuente Narváez") // Nombre del autor
            ->setLastModifiedBy("UMAE | Dr. Victorio de la Fuente Narváez") //Ultimo usuario que lo modificó
            ->setTitle("UMAE | Dr. Victorio de la Fuente Narváez") // Titulo
            ->setSubject("UMAE | Dr. Victorio de la Fuente Narváez"); //Asunto
        $Fecha=$info['status_fecha'];
        $Hora=$info['status_hora'];
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:B1');

 
        for($i = 'A'; $i <= 'B'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $this->BackReport(16, 'A1:B1');
        $this->BackReport(14, 'A2:B2');
        $this->BackReport(10, 'A3:B3');
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:B1');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A1')
            ->setValue('INSTITUTO MEXICANO DEL SEGURO SOCIAL');
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A2')
            ->setValue($Hospital['hospital_nombre']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A3')
            ->setValue("REPORTE DEL ESTADO ACTUAL DEL HOSPITAL DEL $Fecha A LAS $Hora");
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:B5');
        $this->BackReport(10, 'A5:B5');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A5')
            ->setValue('DISPONIBILIDAD DE CAMAS Y SERVICIOS');
        
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A6', 'CAMAS TOTAL');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B6', $info['s1_camas_hospitalacion']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A7', 'CAMAS ADULTOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B7', $info['s1_camas_adultos']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A8', 'CAMAS ADULTOS QUEMADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B8', $info['s1_camas_adultos_quemados']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A9', 'CAMAS PEDIATRICOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B9', $info['s1_camas_pediatria']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A10', 'CUNAS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B10', $info['s1_cunas']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A11', 'CUNAS QUEMADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B11', $info['s1_cunas_quemados']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A12', 'CAMAS DE TERAPIA DISPONIBLES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B12', $info['s1_camas_terapia_intensiva']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A13', 'ESPACIOS URGENCIAS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B13', $info['s1_espacios_urgencias']);
        /*----------------------------------------------------------------*/
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A15:B15');
        $this->BackReport(10, 'A15:B15');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A15')
            ->setValue('ADMISIÓN DE PACIENTES RELACIONADOS CON EL SISMO');
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A16', 'DERECHOHABIENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B16', $info['s2_derechohabiente']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A17', 'NO DERECHOHABIENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B17', $info['s2_noderechohabiente']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A18', 'TOTAL');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B18', $info['s2_total_derechohabiente']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A20:B20');
        $this->BackReport(10, 'A20:B20');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A20')
            ->setValue('REPORTE DE DEFUNCIONES');
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A21', 'RELACIONADOS CON EL SISMO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B21', $info['s3_defunciones_si_sismo']);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A22', 'NO RELACIONADOS CON EL SISMO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B22', $info['s3_defunciones_no_sismo']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A24:B24');
        $this->BackReport(10, 'A24:B24');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A24')
            ->setValue('DAÑOS QUE PREVALECEN EN LA UNIDAD PARA SER EVALUADOS POR EL PERSONAL ESPECIALIADOS');
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A25:B25');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A25', $info['s4_daños']);
        
        if($info['s4_daños_comentarios']!=''){
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A26:B26');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A26', 'COMENTARIOS: '.$info['s4_daños_comentarios']);
        }
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A28:B28');
        $this->BackReport(10, 'A28:B28');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A28')
            ->setValue('CAMAS OCUPADAS');
        
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A29:B29');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A29', $info['s5_camas_ocupadas']);
        
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A31:B31');
        $this->BackReport(10, 'A31:B31');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A31')
            ->setValue('DISPONIBILIDAD DE HEMOCOMPONENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A32', 'PAQUETES GLOBULARES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B32', $info['s6_paquetas_globulares']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A33', 'PLASMA');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B33', $info['s6_plasmas']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A34', 'ENVÍOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B34', $info['s6_envios']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A35', 'RECIBIDOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B35', $info['s6_recibidos']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A37:B37');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A37')
            ->setValue('ANALISIS DE NECESIDADES');
        $this->BackReport(10, 'A37:B37');
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A38:B38');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A38')
            ->setValue($info['s7_analisis_necesidades_pro']);
        if($info['s7_analisis_necesidades']!=''){
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A39:B39');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A39', 'COMENTARIOS: '.$info['s7_analisis_necesidades']);
        }
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A41:B41');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A41')
            ->setValue('EGRESOS DE PACIENTES ESPECIFICANDO DESTINO');
        $this->BackReport(10, 'A41:B41');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A42', 'HOSPITALIZADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B42', $info['s6_egreso_hospitalizacion']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A43', 'DOMICILIO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B43', $info['s6_egreso_domicilio']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A44', 'DEFUNCIÓN');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B44', $info['s6_egreso_defuncion']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A45', 'TRASLADO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B45', $info['s6_egreso_traslado']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A46', 'TOTAL');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B46', $info['s6_egreso_total']);
        if($info['s6_egreso_comentarios']!=''){
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A47:B47');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A47', 'COMENTARIOS: '.$info['s6_egreso_comentarios']);
        }
        
        
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A49:B49');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A49')
            ->setValue('ABASTO DE MEDICAMENTOS Y ESTADO DE LA RED DE FRÍO');
        $this->BackReport(10, 'A49:B49');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A50', 'PORCENTAJE');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B50', $info['s9_abasto_porcentaje']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A51', 'DÍAS GARANTIZADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B51', $info['s9_abasto_dias']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A52', 'VENTILADORES DISPONIBLES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B52', $info['s9_ventiladores']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A53', 'QUIRÓFANOS DISPONIBLES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B53', $info['s9_sala_quirofanos']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A54', 'RED DE FRIO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B54', $info['s9_red_fria']);
        if($info['s9_abasto_comentarios']!=''){
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A55:B55');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A55', 'COMENTARIOS: '.$info['s9_abasto_comentarios']);
        }
        
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A57:B57');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A57')
            ->setValue('PROBLEMAS DE OPERACIÓN DE EQUIPOS CRITICOS Y SOPORTE');
        $this->BackReport(10, 'A57:B57');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A58', 'TOMOGRAFIA');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B58', $info['s10_tomografia']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A59', 'RESONADOR');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B59', $info['s10_resonador']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A60', 'RAYOS "X"');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B60', $info['s10_rayos_x']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A61', 'HEMOCOMPONENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B61', $info['s10_hemocomponentes']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A62', 'VENTILADORES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B62', $info['s10_ventiladores']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A63', 'DESFIBRILADORES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B63', $info['s10_desfibriladores']);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A65:B65');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A65')
            ->setValue('EQUIPO DE SOPORTE DE LA UNIDAD');
        $this->BackReport(10, 'A65:B65');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A66', 'ELEVADORES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B66', $info['s11_elevadores']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A67', 'SUMINISTRO DE LUZ EXTERNO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B67', $info['s11_suministro_de_luz']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A68', 'PLANTA DE LUZ');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B68', $info['s11_planta_de_luz']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A69', 'SUPERVISION DE COMBUSTIBLE DE PLANTA DE LUZ');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B69', $info['s11_combustible_planta_de_luz']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A70', 'TANQUE TERMO DE OXÍGENO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B70', $info['s11_tanque_termo_oxigeno']);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A71', 'GENERADOR DE VAPOR');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B71', $info['s11_generador_de_vapor']);
        
        
        // Se asigna el nombre a la hoja
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE_PACIENTES.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function AlignCellText($range) {
        $this->objPHPExcel->getActiveSheet()->getStyle($range)->applyFromArray($this->StyleReport(10))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    }
    public function ReporteStatusHospitalGeneral() {
        $sqlInfo= $this->config_mdl->sqlGetDataCondition('um_hospitales_status',array(
            'status_fecha'=> base64_decode($_GET['inputFecha']),
            'status_hora'=> base64_decode($_GET['inputHora']) 
        ));
        $fecha=base64_decode($_GET['inputFecha']);
        $hora=base64_decode($_GET['inputHora']) ;
        $sqlHospital= $this->config_mdl->sqlQuery("SELECT * FROM um_hospitales, um_hospitales_status WHERE um_hospitales.hospital_id=um_hospitales_status.hospital_id AND
                    um_hospitales_status.status_fecha='$fecha' AND  um_hospitales_status.status_hora='$hora'");
        $Hospital_='';
        foreach ($sqlHospital as $value) {
            $Hospital_.=$value['hospital_nombre'].', ';
        }
        $s1_camas_hospitalacion=0;
        $s1_camas_adultos=0;
        $s1_camas_adultos_quemados=0;
        $s1_camas_pediatria=0;
        $s1_cunas=0;
        $s1_cunas_quemados=0;
        $s1_camas_terapia_intensiva=0;
        $s1_espacios_urgencias=0;
        $s2_total_derechohabiente=0;
        $s2_derechohabiente=0;
        $s2_noderechohabiente=0;
        $s3_defunciones_si_sismo=0;
        $s3_defunciones_no_sismo=0;
        $s4_daños=0;
        $s5_camas_ocupadas=0;
        $s6_paquetas_globulares=0;
        $s6_plasmas=0;
        $s6_envios=0;
        $s6_recibidos=0;
        $s7_analisis_necesidades_pro=0;
        $s6_egreso_hospitalizacion=0;
        $s6_egreso_domicilio=0;
        $s6_egreso_defuncion=0;
        $s6_egreso_traslado=0;
        $s6_egreso_total=0;
        $s9_abasto_porcentaje=0;
        $s9_abasto_dias=0;
        $s9_ventiladores=0;
        $s9_sala_quirofanos=0;
        $s9_red_fria=0;
        $s10_tomografia=0;
        $s10_resonador=0;
        $s10_rayos_x=0;
        $s10_hemocomponentes=0;
        $s10_ventiladores=0;
        $s10_desfibriladores=0;
        $s11_elevadores=0;
        $s11_suministro_de_luz=0;
        $s11_planta_de_luz=0;
        $s11_combustible_planta_de_luz=0;
        $s11_tanque_termo_oxigeno=0;
        $s11_generador_de_vapor=0;
        foreach ($sqlInfo as $value) {
            $s1_camas_hospitalacion=$s1_camas_hospitalacion+$value['s1_camas_hospitalacion'];
            $s1_camas_adultos=$s1_camas_adultos+$value['s1_camas_adultos'];
            $s1_camas_adultos_quemados=$s1_camas_adultos_quemados+$value['s1_camas_adultos_quemados'];
            $s1_camas_pediatria=$s1_camas_pediatria+$value['s1_camas_pediatria'];
            $s1_cunas=$s1_cunas+$value['s1_cunas'];
            $s1_cunas_quemados=$s1_cunas_quemados+$value['s1_cunas_quemados'];
            $s1_camas_terapia_intensiva=$s1_camas_terapia_intensiva+$value['s1_camas_terapia_intensiva'];
            $s1_espacios_urgencias=$s1_espacios_urgencias+$value['s1_espacios_urgencias'];
            $s2_total_derechohabiente=$s2_total_derechohabiente+$value['s2_total_derechohabiente'];
            $s2_derechohabiente=$s2_derechohabiente+$value['s2_derechohabiente'];
            $s2_noderechohabiente=$s2_noderechohabiente+$value['s2_noderechohabiente'];
            $s3_defunciones_si_sismo=$s3_defunciones_si_sismo+$value['s3_defunciones_si_sismo'];
            $s3_defunciones_no_sismo=$s3_defunciones_no_sismo+$value['s3_defunciones_no_sismo'];
            if($value['s4_daños']=='ALGUNO'){
                $s4_daños=$s4_daños+50;
            }else{
                $s4_daños=$s4_daños+0;
            }
            $s5_camas_ocupadas=$s5_camas_ocupadas+$value['s5_camas_ocupadas'];
            $s6_paquetas_globulares=$s6_paquetas_globulares+$value['s6_paquetas_globulares'];
            $s6_plasmas=$s6_plasmas+$value['s6_plasmas'];
            $s6_envios=$s6_envios+$value['s6_envios'];
            $s6_recibidos=$s6_recibidos+$value['s6_recibidos'];
            if($value['s7_analisis_necesidades_pro']=='SIN PROBLEMA'){
                $s7_analisis_necesidades_pro=$s7_analisis_necesidades_pro+0;
            }else{
                $s7_analisis_necesidades_pro=$s7_analisis_necesidades_pro+50;
            }
            $s6_egreso_hospitalizacion=$s6_egreso_hospitalizacion+$value['s6_egreso_hospitalizacion'];
            $s6_egreso_domicilio=$s6_egreso_domicilio+$value['s6_egreso_domicilio'];
            $s6_egreso_defuncion=$s6_egreso_defuncion+$value['s6_egreso_defuncion'];
            $s6_egreso_traslado=$s6_egreso_traslado+$value['s6_egreso_traslado'];
            $s6_egreso_total=$s6_egreso_total+$value['s6_egreso_total'];
            $s9_abasto_porcentaje=$s9_abasto_porcentaje+$value['s9_abasto_porcentaje'];
            $s9_abasto_dias=$s9_abasto_dias+$value['s9_abasto_dias'];
            $s9_ventiladores=$s9_ventiladores+$value['s9_ventiladores'];
            $s9_sala_quirofanos=$s9_sala_quirofanos+$value['s9_sala_quirofanos'];
            if($value['s9_red_fria']=='FUNCIONANDO'){
                $s9_red_fria=$s9_red_fria+100;
            }else{
                $s9_red_fria=$s9_red_fria+50;
            }
            if($value['s10_tomografia']=='FUNCIONANDO'){
                $s10_tomografia=$s10_tomografia+100;
            }else{
                $s10_tomografia=$s10_tomografia+50;
            }
            if($value['s10_resonador']=='FUNCIONANDO'){
                $s10_resonador=$s10_resonador+100;
            }else{
                $s10_resonador=$s10_resonador+50;
            }
            if($value['s10_rayos_x']=='FUNCIONANDO'){
                $s10_rayos_x=$s10_rayos_x+100;
            }else{
                $s10_rayos_x=$s10_rayos_x+50;
            }
            if($value['s10_hemocomponentes']=='FUNCIONANDO'){
                $s10_hemocomponentes=$s10_hemocomponentes+100;
            }else{
                $s10_hemocomponentes=$s10_hemocomponentes+50;
            }
            if($value['s10_ventiladores']=='FUNCIONANDO'){
                $s10_ventiladores=$s10_ventiladores+100;
            }else{
                $s10_ventiladores=$s10_ventiladores+50;
            }
            if($value['s10_desfibriladores']=='FUNCIONANDO'){
                $s10_desfibriladores=$s10_desfibriladores+100;
            }else{
                $s10_desfibriladores=$s10_desfibriladores+50;
            }
            if($value['s11_elevadores']=='FUNCIONANDO'){
                $s11_elevadores=$s11_elevadores+100;
            }else{
                $s11_elevadores=$s11_elevadores+50;
            }
            if($value['s11_suministro_de_luz']=='FUNCIONANDO'){
                $s11_suministro_de_luz=$s11_suministro_de_luz+100;
            }else{
                $s11_suministro_de_luz=$s11_suministro_de_luz+50;
            }
            if($value['s11_planta_de_luz']=='FUNCIONANDO'){
                $s11_planta_de_luz=$s11_planta_de_luz+100;
            }else{
                $s11_planta_de_luz=$s11_planta_de_luz+50;
            }
            $s11_combustible_planta_de_luz=$s11_combustible_planta_de_luz+$value['s11_combustible_planta_de_luz'];
            $s11_tanque_termo_oxigeno=$s11_tanque_termo_oxigeno+$value['s11_tanque_termo_oxigeno'];
            if($value['s11_generador_de_vapor']=='FUNCIONANDO'){
                $s11_generador_de_vapor=$s11_generador_de_vapor+100;
            }else{
                $s11_generador_de_vapor=$s11_generador_de_vapor+50;
            }
            
        }
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator("UMAE | Dr. Victorio de la Fuente Narváez") // Nombre del autor
            ->setLastModifiedBy("UMAE | Dr. Victorio de la Fuente Narváez") //Ultimo usuario que lo modificó
            ->setTitle("UMAE | Dr. Victorio de la Fuente Narváez") // Titulo
            ->setSubject("UMAE | Dr. Victorio de la Fuente Narváez"); //Asunto
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:B1');

 
        for($i = 'A'; $i <= 'B'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $this->BackReport(16, 'A1:B1');
        $this->BackReport(10, 'A2:B2');
        $this->BackReport(10, 'A3:B3');
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:B1');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A1')
            ->setValue('INSTITUTO MEXICANO DEL SEGURO SOCIAL');
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A2')
            ->setValue(trim($Hospital_, ', '));
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A3')
            ->setValue("REPORTE DE LOS ESTADOS ACTUALES DE LOS HOSPITALES DEL $fecha  A LAS $hora");
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:B5');
        $this->BackReport(10, 'A5:B5');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A5')
            ->setValue('DISPONIBILIDAD DE CAMAS Y SERVICIOS');
        
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A6', 'CAMAS TOTAL');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B6', $s1_camas_hospitalacion);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A7', 'CAMAS ADULTOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B7', $s1_camas_adultos);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A8', 'CAMAS ADULTOS QUEMADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B8', $s1_camas_adultos_quemados);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A9', 'CAMAS PEDIATRICOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B9', $s1_camas_pediatria);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A10', 'CUNAS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B10', $s1_cunas);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A11', 'CUNAS QUEMADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B11', $s1_cunas_quemados);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A12', 'CAMAS DE TERAPIA DISPONIBLES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B12', $s1_camas_terapia_intensiva);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A13', 'ESPACIOS URGENCIAS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B13', $s1_espacios_urgencias);
        /*----------------------------------------------------------------*/
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A15:B15');
        $this->BackReport(10, 'A15:B15');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A15')
            ->setValue('ADMISIÓN DE PACIENTES RELACIONADOS CON EL SISMO');
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A16', 'DERECHOHABIENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B16', $s2_derechohabiente);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A17', 'NO DERECHOHABIENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B17', $s2_noderechohabiente);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A18', 'TOTAL');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B18', $s2_total_derechohabiente);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A21:B21');
        $this->BackReport(10, 'A21:B21');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A21')
            ->setValue('REPORTE DE DEFUNCIONES');
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A22', 'RELACIONADOS CON EL SISMO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B22', $s3_defunciones_si_sismo);
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A23', 'NO RELACIONADOS CON EL SISMO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B23', $s3_defunciones_no_sismo);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A26:B26');
        $this->BackReport(10, 'A26:B26');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A26')
            ->setValue('DAÑOS QUE PREVALECEN EN LA UNIDAD PARA SER EVALUADOS POR EL PERSONAL ESPECIALIADOS');
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A27:B27');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A27', $s4_daños/count($sqlInfo));
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A29:B29');
        $this->BackReport(10, 'A29:B29');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A29')
            ->setValue('CAMAS OCUPADAS');
        
        /*----------------------------------------------------------------*/
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A30:B30');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A30', $s5_camas_ocupadas);
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A32:B32');
        $this->BackReport(10, 'A32:B32');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A32')
            ->setValue('DISPONIBILIDAD DE HEMOCOMPONENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A33', 'PAQUETES GLOBULARES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B33', $s6_paquetas_globulares);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A34', 'PLASMA');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B34', $s6_plasmas);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A35', 'ENVÍOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B35', $s6_envios);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A36', 'RECIBIDOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B36', $s6_recibidos);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A38:B38');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A38')
            ->setValue('ANALISIS DE NECESIDADES');
        $this->BackReport(10, 'A38:B38');
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A39:B39');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A39')
            ->setValue($s7_analisis_necesidades_pro/count($sqlInfo));
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A42:B42');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A42')
            ->setValue('EGRESOS DE PACIENTES ESPECIFICANDO DESTINO');
        $this->BackReport(10, 'A42:B42');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A43', 'HOSPITALIZADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B43', $s6_egreso_hospitalizacion);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A44', 'DOMICILIO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B44', $s6_egreso_domicilio);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A45', 'DEFUNCIÓN');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B45', $s6_egreso_defuncion);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A46', 'TRASLADO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B46', $s6_egreso_traslado);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A47', 'TOTAL');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B47', $s6_egreso_total);
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A50:B50');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A50')
            ->setValue('ABASTO DE MEDICAMENTOS Y ESTADO DE LA RED DE FRÍO');
        $this->BackReport(10, 'A50:B50');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A51', 'PORCENTAJE');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B51', $s9_abasto_porcentaje/count($sqlInfo));
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A52', 'DÍAS GARANTIZADOS');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B52', $s9_abasto_dias/count($sqlInfo));
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A53', 'VENTILADORES DISPONIBLES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B53', $s9_ventiladores);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A54', 'QUIRÓFANOS DISPONIBLES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B54', $s9_sala_quirofanos);
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A55', 'RED DE FRIO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B55', $s9_red_fria/ count($sqlInfo).'%');
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A58:B58');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A58')
            ->setValue('PORCENTAJE DE OPERACIÓN DE EQUIPOS CRITICOS Y SOPORTE');
        $this->BackReport(10, 'A58:B58');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A59', 'TOMOGRAFIA');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B59', $s10_tomografia/ count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A60', 'RESONADOR');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B60', $s10_resonador/ count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A61', 'RAYOS "X"');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B61', $s10_rayos_x/ count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A62', 'HEMOCOMPONENTES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B62', $s10_hemocomponentes/ count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A63', 'VENTILADORES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B63', $s10_ventiladores/ count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A64', 'DESFIBRILADORES');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B64', $s10_desfibriladores/ count($sqlInfo).'%');
        
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('A66:B66');
        $this->objPHPExcel->getActiveSheet()
            ->getCell('A66')
            ->setValue('EQUIPO DE SOPORTE DE LA UNIDAD');
        $this->BackReport(10, 'A66:B66');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A67', 'ELEVADORES'.'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B67', $s11_elevadores/ count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A68', 'SUMINISTRO DE LUZ EXTERNO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B68', $s11_suministro_de_luz/count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A69', 'PLANTA DE LUZ');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B69', $s11_planta_de_luz/count($sqlInfo).'%');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A70', 'SUPERVISION DE COMBUSTIBLE DE PLANTA DE LUZ');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B70', $s11_combustible_planta_de_luz/count($sqlInfo));
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A71', 'TANQUE TERMO DE OXÍGENO');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B71', $s11_tanque_termo_oxigeno/count($sqlInfo));
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A72', 'GENERADOR DE VAPOR');
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B72', $s11_generador_de_vapor/ count($sqlInfo).'%');
        
        
        // Se asigna el nombre a la hoja
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE_PACIENTES.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function ImportarUsuariosCandidatos() {
        header("Content-Type: text/html;charset=utf-8");
        //Nombre del Archivo a leer
        $this->objPHPExcel = PHPExcel_IOFactory::load('assets/csv/sigh_tbl_candidatos.xlsx');
        //Asigno la hoja de calculo activa
        $this->objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $this->objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        for ($i = 1; $i <= $numRows; $i++) {
            if($this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!='numcandidatogys' && $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''){
                
                $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_curp'=>$this->objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue()
                ));
                $data=array(
                    'empleado_matricula'=>$this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                    'empleado_ap'=> $this->objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                    'empleado_am'=>$this->objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue(),
                    'empleado_nombre'=>$this->objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                    'empleado_curp'=>$this->objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(),
                    'empleado_sexo'=>$this->objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                    'empleado_modulo'=>'Actualización'
                );
                if(empty($sqlCheck)){
                    $this->config_mdl->sqlInsert('sigh_empleados',$data);
                    echo $this->objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue().'->INSERT<br>';
                }else{
                    $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
                        'empleado_id'=>$sqlCheck[0]['empleado_id']
                    ));
                    echo $this->objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue().'->UPDATE<br>';
                }
            }
        }
    }
    public function ImportarUsuariosEmpleados() {
        header("Content-Type: text/html;charset=utf-8");
        //Nombre del Archivo a leer
        $this->objPHPExcel = PHPExcel_IOFactory::load('assets/csv/sigh_tbl_empleados.xlsx');
        //Asigno la hoja de calculo activa
        $this->objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $this->objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        for ($i = 1; $i <= $numRows; $i++) {
            if($this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!='numempleado' && $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''){
                
                $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_curp'=>$this->objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue()
                ));
                $data=array(
                    'empleado_matricula'=>$this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                    'empleado_ap'=> $this->objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                    'empleado_am'=>$this->objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue(),
                    'empleado_nombre'=>$this->objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                    'empleado_rfc'=>$this->objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(),
                    'empleado_curp'=>$this->objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                    'empleado_nss'=>$this->objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                    'empleado_nacionalidad'=>$this->objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue(),
                    'empleado_ingreso'=>$this->objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue(),
                    'empleado_modulo'=>'Actualización'
                );
                if(empty($sqlCheck)){
                    $this->config_mdl->sqlInsert('sigh_empleados',$data);
                    echo $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue().'->INSERT<br>';
                }else{
                    $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
                        'empleado_id'=>$sqlCheck[0]['empleado_id']
                    ));
                    echo $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue().'->UPDATE<br>';
                }
            }
        }
    }
    public function ImportarUsuariosResidentes() {
        header("Content-Type: text/html;charset=utf-8");
        //Nombre del Archivo a leer
        $this->objPHPExcel = PHPExcel_IOFactory::load('assets/csv/sigh_tbl_residentes.xlsx');
        //Asigno la hoja de calculo activa
        $this->objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $this->objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        for ($i = 1; $i <= $numRows; $i++) {
            if($this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!='numresidente' && $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''){
                
                $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_curp'=>$this->objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue()
                ));
                $data=array(
                    'empleado_matricula'=>$this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                    'empleado_ap'=> $this->objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                    'empleado_am'=>$this->objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue(),
                    'empleado_nombre'=>$this->objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                    'empleado_rfc'=>$this->objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(),
                    'empleado_curp'=>$this->objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                    'empleado_nacionalidad'=>$this->objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                    'empleado_sexo'=>$this->objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue(),
                    'empleado_ingreso'=>$this->objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue(),
                    'empleado_modulo'=>'Actualización'
                );
                if(empty($sqlCheck)){
                    $this->config_mdl->sqlInsert('sigh_empleados',$data);
                    echo $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue().'->INSERT<br>';
                }else{
                    $this->config_mdl->sqlUpdate('sigh_empleados',$data,array(
                        'empleado_id'=>$sqlCheck[0]['empleado_id']
                    ));
                    echo $this->objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue().'->UPDATE<br>';
                }
            }
        }
    }
    public function UsuariosEnCursos() {
        $Curso=$_GET['curso'];
        $sqlCurso= $this->config_mdl->sqlGetDataCondition('sigh_cursos',array(
            'curso_id'=>$Curso
        ))[0];
        $Gestion= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cursos AS curso, sigh_cursos_empleados AS ce, sigh_empleados AS emp
                                                        WHERE ce.curso_id=curso.curso_id AND ce.empleado_id=emp.empleado_id AND curso.curso_id=$Curso ORDER BY ce.ce_id DESC");
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')) // Nombre del autor
            ->setLastModifiedBy($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')) //Ultimo usuario que lo modificó
            ->setTitle($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')) // Titulo
            ->setSubject($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')); //Asunto
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        
        $HospitalSiglasDes = $this->sigh->getInfo('hospital_siglas_des');
        $HospitalNombre = $this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre');
        $HospitalTitulo='Coordinación de Enseñanza e Investigación';
        $TituloCursoGeneral='REPORTE DE USUARIOS QUE ASISTIERÓN AL CURSO'; 
        $TituloCursoNombre='NOMBRE DEL CURSO: '.strtoupper($sqlCurso['curso_nombre']);
        $TituloCursoFecha='FECHA DEL CURSO: '.$sqlCurso['curso_fecha'];
        $titulosColumnas = array(
            'N°',//A
            'MATRICULA ', //B
            'NOMBRE', //C
            'APELLIDOS', //D
            'CARGO',//E
            'FECHA Y HORA DE INGRESO',//F
            'FECHA Y HORA DE EGRESO',//G
        );
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:G1');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A2:G2');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A3:G3');
        
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A5:G5');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A6:G6');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A7:G7');
        
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$HospitalSiglasDes) // Titulo del reporte
            ->setCellValue('A2',$HospitalNombre) // Titulo del reporte
            ->setCellValue('A3',$HospitalTitulo) // Titulo del reporte
            ->setCellValue('A5',$TituloCursoGeneral) // Titulo del reporte  
            ->setCellValue('A6',$TituloCursoNombre) // Titulo del reporte  
            ->setCellValue('A7',$TituloCursoFecha) // Titulo del reporte  
            ->setCellValue('A9',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B9',  $titulosColumnas[1])
            ->setCellValue('C9',  $titulosColumnas[2])
            ->setCellValue('D9',  $titulosColumnas[3])
            ->setCellValue('E9',  $titulosColumnas[4])
            ->setCellValue('F9',  $titulosColumnas[5])
            ->setCellValue('G9',  $titulosColumnas[6]);
        //Se agregan los datos de los alumnos
        $i = 10; //Numero de fila donde se va a comenzar a rellenar
        $num=0;
        foreach ($Gestion as $value) {
            $num++;
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $num)
                ->setCellValue('B'.$i, $value['empleado_matricula'])
                ->setCellValue('C'.$i, $value['empleado_nombre'])
                ->setCellValue('D'.$i, $value['empleado_ap'].' '.$value['empleado_am'])
                ->setCellValue('E'.$i, $value['empleado_categoria']=='' ?'SIN ESPECIFICAR':$value['empleado_categoria'])
                ->setCellValue('F'.$i, $value['ce_fecha_ingreso'].' '.$value['ce_hora_ingreso'])
                ->setCellValue('G'.$i, $value['ce_fecha_egreso'].' '.$value['ce_hora_egreso']);
             $i++;
        }
        for($i = 'A'; $i <= 'G'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre

        $this->objPHPExcel->setActiveSheetIndex(0);
        $sigh_bg= trim($this->sigh->getInfo('hospital_back_secundary'), '#');
        $this->sighBgReport($sigh_bg,12, 'A1:G1','center');
        $this->sighBgReport($sigh_bg,11, 'A2:G2','center');
        $this->sighBgReport($sigh_bg,11, 'A3:G3','center');
        
        $this->sighBgReport($sigh_bg,10, 'A5:G5','center');
        $this->sighBgReport($sigh_bg,8, 'A6:G6','left');
        $this->sighBgReport($sigh_bg,8, 'A7:G7','left');
        
        $this->sighBgReport($sigh_bg,10, 'A9:G9','left');
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $TituloOutput=$sqlCurso['curso_fecha'].'-'.date('YmdHis');
        header('Content-Disposition: attachment;filename="'.$TituloOutput.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    public function DownloadExcelTriage() {
        $inputFiltro= $this->input->get('inputFiltro');
        $inputTurno= $this->input->get('inputTurno');
        $inputFi= $this->input->get('inputFi');
        $inputFf= $this->input->get('inputFf');
        
        if($inputFiltro=='Fechas'){
            $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_medico
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico BETWEEN '$inputFi' AND '$inputFf'");
        }else{
            if($inputTurno=='Mañana'){
                $inputHora1='07:00';
                $inputHora2='13:59';
            }if($inputTurno=='Tarde'){
                $inputHora1='14:00';
                $inputHora2='20:59';
            }if($inputTurno=='Noche'){
                $inputHora1='21:00';
                $inputHora2='23:59';
            }
            if($inputTurno=='Noche'){
                $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_enfermera
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico='$inputFi' AND
                                                        ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'");
                
                $sql2= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_enfermera
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico=DATE_ADD('$inputFi', INTERVAL 1 DAY) AND
                                                        ing.ingreso_time_medico BETWEEN '00:00' AND '06:59:59'");
                
            }else{
                $sql2=NULL;
                $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                        ing.ingreso_id, pac.paciente_nombre,
                                                        pac.paciente_ap,pac.paciente_am,pac.paciente_fn,ing.ingreso_clasificacion,
                                                        ing.ingreso_date_horacero,ing.ingreso_time_horacero,
                                                        ing.ingreso_date_enfermera, ing.ingreso_time_enfermera, ing.ingreso_date_medico, ing.ingreso_time_enfermera
                                                FROM 
                                                        sigh_pacientes_ingresos As ing, sigh_pacientes AS pac 
                                                WHERE 
                                                        ing.paciente_id=pac.paciente_id  AND
                                                        ing.ingreso_date_medico='$inputFi' AND
                                                        ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'");
            }
        }
        $this->objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        $this->objPHPExcel->getProperties()->setCreator($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')) // Nombre del autor
            ->setLastModifiedBy($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')) //Ultimo usuario que lo modificó
            ->setTitle($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')) // Titulo
            ->setSubject($this->sigh->getInfo('hospital_clasificacion').' '.$this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre')); //Asunto
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        
        $HospitalSiglasDes = $this->sigh->getInfo('hospital_siglas_des');
        $HospitalNombre = $this->sigh->getInfo('hospital_tipo').' '.$this->sigh->getInfo('hospital_nombre');
        $HospitalTitulo='Coordinación de Enseñanza e Investigación';
        $TituloCursoGeneral='INDICADOR DE PACIENTES ENFERMERÍA - MÉDICO TRIAGE'; 
        $titulosColumnas = array(
            'FOLIO DE INGRESO',//A
            'NOMBRE ', //B
            'A. PATERNO', //C
            'A. MATERNO', //D
            'EDAD',//E
            'CLASIFICACIÓN',//F
            'HORACERO',//G
            'TIEMPO TRANSCURRIDO'//H
        );
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:H1');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A2:H2');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A3:H3');
        
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A5:H5');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A6:H6');
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A7:H7');
        
        $this->objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$HospitalSiglasDes) // Titulo del reporte
            ->setCellValue('A2',$HospitalNombre) // Titulo del reporte
            ->setCellValue('A3',$HospitalTitulo) // Titulo del reporte
            ->setCellValue('A5',$TituloCursoGeneral) // Titulo del reporte  
            ->setCellValue('A6','DEL '.$inputFi.' AL '.$inputFf) // Titulo del reporte  
 
            ->setCellValue('A8',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B8',  $titulosColumnas[1])
            ->setCellValue('C8',  $titulosColumnas[2])
            ->setCellValue('D8',  $titulosColumnas[3])
            ->setCellValue('E8',  $titulosColumnas[4])
            ->setCellValue('F8',  $titulosColumnas[5])
            ->setCellValue('G8',  $titulosColumnas[6])
            ->setCellValue('H8',  $titulosColumnas[7]);
        //Se agregan los datos de los alumnos
        $i = 9; //Numero de fila donde se va a comenzar a rellenar
        foreach ($sql as $value) {
            $Edad= $this->CalcularEdad_($value['paciente_fn']);
            $TT= $this->getTimeElapsed(array(
                'Time1'=>$value['ingreso_date_enfermera'].' '.$value['ingreso_time_enfermera'],
                'Time2'=>$value['ingreso_date_medico'].' '.$value['ingreso_time_medico']
            ));
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $value['ingreso_id'])
                ->setCellValue('B'.$i, $value['paciente_nombre'])
                ->setCellValue('C'.$i, $value['paciente_ap'])
                ->setCellValue('D'.$i, $value['paciente_am'])
                ->setCellValue('E'.$i, ($Edad->y==0 ? $Edad->m.' MESES' : $Edad->y.' AÑOS '))
                ->setCellValue('F'.$i, $value['ingreso_clasificacion'])
                ->setCellValue('G'.$i, $value['ingreso_date_horacero'].' '.$value['ingreso_time_horacero'])
                ->setCellValue('H'.$i, $TT->d.' Dias '.$TT->h.' Hrs '.$TT->i.' Min ');
             $i++;
        }
        foreach ($sql2 as $value) {
            $Edad= $this->CalcularEdad_($value['paciente_fn']);
            $TT= $this->getTimeElapsed(array(
                'Time1'=>$value['ingreso_date_enfermera'].' '.$value['ingreso_time_enfermera'],
                'Time2'=>$value['ingreso_date_medico'].' '.$value['ingreso_time_medico']
            ));
            $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $value['ingreso_id'])
                ->setCellValue('B'.$i, $value['paciente_nombre'])
                ->setCellValue('C'.$i, $value['paciente_ap'])
                ->setCellValue('D'.$i, $value['paciente_am'])
                ->setCellValue('E'.$i, ($Edad->y==0 ? $Edad->m.' MESES' : $Edad->y.' AÑOS '))
                ->setCellValue('F'.$i, $value['ingreso_clasificacion'])
                ->setCellValue('G'.$i, $value['ingreso_date_horacero'].' '.$value['ingreso_time_horacero'])
                ->setCellValue('H'.$i, $TT->d.' Dias '.$TT->h.' Hrs '.$TT->i.' Min ');
             $i++;
        }
        for($i = 'A'; $i <= 'H'; $i++){
            $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $this->objPHPExcel->getActiveSheet()->setTitle('REPORTES');
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre

        $this->objPHPExcel->setActiveSheetIndex(0);
        $sigh_bg= trim($this->sigh->getInfo('hospital_back_secundary'), '#');
        $this->sighBgReport($sigh_bg,12, 'A1:H1','center');
        $this->sighBgReport($sigh_bg,11, 'A2:H2','center');
        $this->sighBgReport($sigh_bg,11, 'A3:H3','center');
        
        $this->sighBgReport($sigh_bg,10, 'A5:H5','center');
        $this->sighBgReport($sigh_bg,8, 'A6:H6','center');
        //$this->sighBgReport($sigh_bg,8, 'A7:G7','left');
        
        $this->sighBgReport($sigh_bg,10, 'A8:H8','left');
        // Inmovilizar paneles
        //$this->objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $this->objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $TituloOutput='INDICADOR TRIAGE DEL '.$inputFi.' AL '.$inputFf;
        header('Content-Disposition: attachment;filename="'.$TituloOutput.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}
