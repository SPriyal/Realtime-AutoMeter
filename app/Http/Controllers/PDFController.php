<?php
/**
 * Created by PhpStorm.
 * User: sPriyal
 * Date: 10/04/16
 * Time: 10:52 PM
 */

namespace App\Http\Controllers;


use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Input;
use File;
use Validator;
use Illuminate\Support\Facades\Session as Session;
use DB;
use App\parameterDetails;
use App\Data as Data;


include(app_path() . '/Libraries/tcpdf/tcpdf.php');


class MYPDF extends \TCPDF
{

    //Page header
    public function Header()
    {
        $value = Session::get('nodeID');
        $parent = Company::where('id',$value)->first()->getRoot();
        $node = Company::where('id', $value)->first();
        //echo $node['name'];
        foreach ($node->getDescendantsAndSelf() as $descendant) {
            $result = Company::where('id', $descendant->parent_id)->first();
        }
        //echo $result['name'];

        // Logo
        $image_file = K_PATH_IMAGES . 'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Report for ' . $result['name'] . ' of ' . $parent['name'], 0, false, 'C', 0, '', 3, false, 'M', 'M');

    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 5, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '        ' . 'Report Generation Time ' . date("d/m/y") . ' - ' . date("h:i:sa"), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        date_default_timezone_set("Asia/Kolkata");
        //$this->Cell(0, 5, 'Time ' . date("d/m/y") . ' - ' . date("h:i:sa"), 0, false, 'l', 0, '', 0, false, 'T', 'M');
    }

}


class PDFController extends Controller
{

    public function PDFGen()
    {

        $pdf = new MYPDF();
        //$pdf = new \TCPDF();


// set margins for header and footer
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Data fetching from database for table in pdf
        $value = Session::get('nodeID');
        $node = Company::where('id', $value)->first();
        foreach ($node->getDescendantsAndSelf() as $descendant) {
            $parentid = Company::where('id', $descendant->parent_id)->first();
        }
        $i = 0;
        foreach ($parentid->getDescendants() as $siblings) {
            $SiblingsID[$i] = $siblings['id'];
            $i++;

        }

        $pdf->AddPage();


        date_default_timezone_set("Asia/Kolkata");
        $StartTime = "08:00:00am - " . date("d/m/y");
        $EndTime = date("h:i:sa");

        $TestStart = date("Y-m-d 08:00:00");
        $TestEnd = date("Y-m-d h:i:s");
//        echo $TestStart;

        //$sql = testdata::whereBetween('dateTime',[$dateVariable,$now])->get();


//        $pdf->Cell(0,15,'Report Start Time: '.$StartTime,0,false, 'C', 0, '', 3, false,'M','M');
//        $pdf->Cell(0,15,'Report End Time: '.$EndTime,0,false, 'C', 0, '', 4, false,'M','M');
        $txt = <<<EOD
Report Start Time and Date: $StartTime
Report End Time: $EndTime

EOD;

// print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);


        for ($a = 0; $a < sizeof($SiblingsID); $a++) {

            $header = array(array('Number', 'Parameter Name', 'Value', 'Date And Time'));
            //$sql = Data::whereBetween('DateTime',[$TestStart,$TestEnd])->get();
            //echo $sql;
            //var_dump($sql);
            $result = Data::select('parameter_id', 'value', 'DateTime')->where('meter_id', $SiblingsID[$a])->where('DateTime', '>', $TestStart)->get();
            //echo $result;
            $result1 = Company::select('name')->where('id', $SiblingsID[$a])->first();
            $result2 = parameterDetails::select('unit')->where('id', $result[0]['parameter_id'])->get();
            $txt = 'Table of ' . $result1['name'] . $pdf->Ln();

// print a block of text using Write()
            $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

            $pdf->SetFont('Times', '', 12);
            foreach ($header as $heading) {
                foreach ($heading as $column_heading)
                    $pdf->Cell(35, 8, $column_heading, 1, 0, 'C', 0, '', 3);

            }
            $b = 1;
            foreach ($result as $row) {
                $pdf->SetFont('Times', '', 10);
                $pdf->Ln();
                $pdf->Cell(35, 8, $b, 1, 0, 'C', 0, '', 3);
                $pdf->Cell(35, 8, $result1['name'], 1, 0, 'C', 0, '', 3);
                $pdf->Cell(35, 8, $row['value'] . ' ' . $result2[0]['unit'], 1, 0, 'C', 0, '', 3);
                $pdf->Cell(35, 8, $row['DateTime'], 1, 0, 'C', 0, '', 3);
                $b++;
            }
            $pdf->AddPage();


        }

        $pdf->Output();

    }

//    public function current()
//    {
//        $from = date('Y-m-d' . '00:00:00', time());
//        $to = date('Y-m-d' . '24:60:60', time());
//    }
//$current = Connection::
//where('user_id',$this->user_id)
//->where('status','active')
//->whereBetween('created_at', array($from, $to))->first();
//return $current; }

}


