<?php
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