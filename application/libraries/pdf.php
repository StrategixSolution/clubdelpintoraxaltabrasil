<?php defined('BASEPATH') OR exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf184/fpdf.php";
    
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }

        // El encabezado del PDF
        public function Header(){
//            switch (date('n')) {
//          case 1: $mes='Enero'; break;
//          case 2: $mes='Febrero'; break;
//          case 3: $mes='Marzo'; break;
//          case 4: $mes='Abril'; break;
//          case 5: $mes='Mayo'; break;
//          case 6: $mes='Junio'; break;
//          case 7: $mes='Julio'; break;
//          case 8: $mes='Agosto'; break;
//          case 9: $mes='Septiembre'; break;
//          case 10: $mes='Octubre'; break;
//          case 11: $mes='Noviembre'; break;
//          case 12: $mes='Diciembre'; break;
//         }
//            $this->Image(FCPATH.'assets/application/image/login/logo.png',10,8,50);
//            $this->SetFont('Arial','',10);
//            $this->Cell(0,10,utf8_decode("México").' Distrito Federal a '.date('d').' de '.$mes.' de '.date('Y'),0,0,'R');
//            $this->SetLeftMargin(15);
//            $this->SetRightMargin(15);
//            $this->Ln('10');
//            $this->SetFont('Arial','B',13);
//            $this->Ln('5');
//            $this->Cell(0,15,'AXALTA',0,0,'L');
//            $this->Ln('15');
//            $this->SetFont('Arial','',11);
//            $this->Cell(0,10,'PRESENTE',0,0,'L');
//            $this->Ln('10');
       }
       // El pie del pdf
       /*public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }*/
    }
?>