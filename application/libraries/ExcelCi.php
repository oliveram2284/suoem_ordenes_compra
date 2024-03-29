<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          OLIVERAM
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-  PDF-Generator-Library



*/

require_once APPPATH.'third_party/phpspreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelCi{
    /**
     * Get an instance of CodeIgniter
     *
     * @access  protected
     * @return  void
     */
    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('Afiliados');
        $this->ci->load->model('Municipios');
        
    }

    public function import($inputFileName=false){
        if(!$inputFileName){
            return false;
        }


       
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $total_rows=count($sheetData)-1;
        $total_inserted=0;
        $total_updated=0;
        foreach($sheetData as $key => $item){
            if($key<=1 || $item['A']==null){
                continue;
            }

            $date_temp=explode('-',$item['I']); 

           
            //continue;
            /*
            $date_added=$date_temp['2'].'-'.$date_temp['1'].'-'.$date_temp['0']; 
            $date_temp=explode('-',$item['J']);
            $date_activation=$date_temp['2'].'-'.$date_temp['1'].'-'.$date_temp['0']; 
             
            $municipio=$this->ci->Municipios->getByName($item['G']);*/

            //Separar fullname en name & lastname
            $fullname=str_replace('#','', $item['D']);
            $name_array=explode(' ',$fullname);
            $firstname = $name_array[0];
            unset($name_array[0]);
            $lastname = implode(' ',$name_array);
            
            $data_insert=array(
                //'nro'=>$item['A'],
                'rep'=>$item['A'],
                'legajo'=>$item['B'],
                'dv'=>$item['C'],
                'firstname'=>utf8_decode($firstname),
                'lastname'=>utf8_decode($lastname),                
                'tipo_doc'=>$item['E'],
                'dni'=>($item['F']!=NULL)?str_replace(',','',$item['F']):'',
                'clase'=>$item['G'],
                'address'=>utf8_decode($item['H']),
                'nro'=>$item['I'],
                'municipio_id'=>1,
                //'observation'=>$item['H'],
                //'municipality_code'=>$item['F'],
                //'municipio_id'=>(empty($municipio))?$municipio['id']:1,
                'date_added'=>date("Y-m-d H:i:s"),
                //'date_activation'=>( $item['I'] )? date("Y-m-d",strtotime($date_activation)) : null,
                'status' => 1
            );
           // var_dump($data_insert);
            //continue;
            $this->ci->db->where('dni',$data_insert['dni']);
            $query=$this->ci->db->get('afiliados');
            
            if($query->num_rows()!=0){
                $this->ci->db->where('dni',$data_insert['dni']);
                $this->ci->db->update('afiliados',$data_insert);
                $total_updated++;
            }else{
                $this->ci->db->insert('afiliados',$data_insert);
                if($this->ci->db->insert_id()){
                    $total_inserted++;
                }
            }
            
        }
        //die("fin");
        return array('total_rows'=>$total_rows, 'inserted'=>$total_inserted,'updated'=>$total_updated);

    }



    public function import_aportes($inputFileName=false){
        //var_dump($inputFileName);
        
        if(!$inputFileName){
            return false;
        }
       
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        //var_dump($spreadsheet);
        $head_col=array();
        foreach($sheetData as $key => $item){
            if($key==1){
                foreach($item as $title=>$value){
                    if($value!=null){
                        //var_dump($title);
                        //var_dump($value);
                        $head_col[]=array('letra'=>$title,'fecha'=>$value);
                    }                    
                }
                break;
            }            
            //var_dump($item);
        }
        //var_dump($head_col);
        $new_aportes=array();
        $feeds=array();
        foreach($sheetData as $key => $item){
            if($key==1){
                continue;
            }
            $amount_total=0;
            $feed_total=0;
            
            $nro=0;
            $first_payment=null;
            foreach($head_col as $l=>$col_item){

                if($col_item['letra']=='B'){
                    $nro=$item[$col_item['letra']];
                }else{

                    

                    if($item[$col_item['letra']]!='' && $item[$col_item['letra']]!='$ 0.00'){

                        if( $first_payment==null){
                            $first_payment=date('Y-m-d H:i:s',strtotime($col_item['fecha']));
                        }

                        $feed_total++;
                        $amount_temp=$item[$col_item['letra']];
                        $amount_temp=trim($item[$col_item['letra']]);
                        $amount_temp=str_replace("$ ","",trim($amount_temp));
                        $amount_temp=str_replace("$","",trim($amount_temp));
                        $amount_temp=str_replace(".00","",trim($amount_temp));
                        $amount_temp=str_replace(",",".",trim($amount_temp));
                        
                        $feeds[$nro][]=array(
                            'fecha'=>date('Y-m-d H:i:s',strtotime($col_item['fecha'])),
                            'monto'=>floatval($amount_temp)*1000,
                        );
                        $amount_total+=floatval($amount_temp)*1000;
                        //$feeds[]=floatval($amount_temp)*1000;
                    }
                }
            }

            $new_aportes[]=array(
                'adherent_nro'=>$nro,
                'monto'=>6000,
            );            
        }

        $aportes_totales= count($new_aportes);
        
        $this->ci->db->insert_batch('aportes',$new_aportes);
        $totals_feeds=0;

        foreach($feeds as $key => $item){
            $query=$this->ci->db->get_where('aportes',array('adherent_nro'=>$key));
            if($query->num_rows()){

                $aporte_data = $query->row_array();
                
                $monto_abonado=0;
                foreach($item as $subkey=>$sfeed){                    
                    $feed_data= array();
                    $feed_data['aporte_id'] = (int)$aporte_data['id'];
                    $feed_data['monto'] = $sfeed['monto'];
                    $feed_data['date_added'] = $sfeed['fecha'];
                    $monto_abonado += $sfeed['monto'];
                    $this->ci->db->insert('aporte_cuotas',$feed_data);
                    $totals_feeds++;
                }

                $aporte_data['cuotas']=count($item);
                $aporte_data['cuotas_pagas']=count($item);
                $aporte_data['monto_abonado']=$monto_abonado;
                //$aporte_data['cuotas_abonado']=count($item);

                $aporte_data['date_added']=$item[0]['fecha'];

                if( floatval($aporte_data['monto']) >= $monto_abonado ){
                    $aporte_data['date_cancelation']= end($item)['fecha'];
                }
                
                $this->ci->db->update('aportes',$aporte_data,array('id' => $aporte_data['id']));

            }
        }

        return array('aportes_totales'=>$aportes_totales, 'totals_feeds'=>$totals_feeds);

    }

    public function export_ingreso_devolucion(){
        $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
        //$Excel_writer = new Xls($spreadsheet);

        //$spreadsheet->setActiveSheetIndex(0);
        //$activeSheet = $spreadsheet->getActiveSheet();

        //$activeSheet->setCellValue('A1' , 'New file content')->getStyle('A1')->getFont()->setBold(true);

        //header('Content-Type: application/vnd.ms-excel');
        //header('Content-Disposition: attachment;filename="testfile.xls"'); /*-- $filename is  xsl filename ---*/
        //header('Cache-Control: max-age=0');
        
        //ob_end_clean();

        //$Excel_writer->save('php://output');
        /*
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('helloworld.xlsx');
        */
    }


/**
 * Load a CodeIgniter view into domPDF
 *
 * @access  public
 * @param   string  $view The view to load
 * @param   array   $data The view data
 * @return  void
 */
    
}