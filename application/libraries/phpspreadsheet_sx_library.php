<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 17 jun. 2026 12:53:09 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

require 'vendors/autoload.php';

class Phpspreadsheet_sx_library { 
    public function phpspreadsheet_sx_library_lee_archivo($file) {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $sheet = $worksheet->toArray();
        return $sheet;
    }
}