<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

    function __construct(){
		parent::__construct();
		if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
		
    }

    function excelExportDevolucion(){
    	$this->load->library('ExcelCi');
    	$result = $this->excelci->export_ingreso_devolucion();
    }

/*


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
*/
}