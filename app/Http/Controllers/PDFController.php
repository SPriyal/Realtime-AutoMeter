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
use Carbon\Carbon;


include(app_path() . '/Libraries/tcpdf/tcpdf.php');


class MYPDF extends \TCPDF
{

    //Page header
    public function Header()
    {
        $value = Session::get('nodeID');
        if ( $value == NULL) {
            echo "Select One meter on Homepage to generate report";
            App::abort(404);
//                echo "Array is empty ";
            $flag = 0;
        }
        else {
            $parent = Company::where('id', $value)->first()->getRoot();
            $node = Company::where('id', $value)->first();
            foreach ($node->getDescendantsAndSelf() as $descendant) {
                $result = Company::where('id', $descendant->parent_id)->first();
            }
            if ( $result->count() == 0) {
                echo "No data found";
                App::abort(404);
//                echo "Array is empty ";
                $flag = 0;
            }
            else {

                // Logo
                $image_file = K_PATH_IMAGES . 'logo_example.jpg';
                $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                // Set font
                $this->SetFont('helvetica', 'B', 20);
                // Title
                $this->Cell(0, 15, 'Report for ' . $result['name'] . ' of ' . $parent['name'], 0, false, 'C', 0, '', 3, false, 'M', 'M');
            }
        }

    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        date_default_timezone_set("Asia/Kolkata");
        $this->Cell(0, 5, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '        ' . 'Report Generation Time ' . date("d/m/y") . ' - ' . date("h:i:sa"), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
//        echo $value;
//        var_dump($value);
        if ( empty($value)) {
            echo "Select One meter on Homepage to generate report";
            App::abort(404);
//                echo "Array is empty ";
            $flag = 0;
        }
        else {
            //echo $value;
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

            $TestStartCall = $this->TimeCheck($value);
            $TestEnd = date("Y-m-d G:i:s");

            for ($a = 0; $a < sizeof($SiblingsID); $a++) {

                $header = array(array('Number', 'Parameter Name', 'Value', 'Date And Time'));
                $result = Data::select('id', 'parameter_id', 'value', 'DateTime')
                    ->havingRaw('id%60 = 0')
                    ->where('meter_id', $SiblingsID[$a])
                    ->where('DateTime', '>', $TestStartCall)
                    ->where('DateTime', '<', $TestEnd)
                    ->get();
//            echo $result;
                if ($result->count() == 0) {
                    echo "No Data Found for report";
                    App::abort(404);
//                echo "Array is empty ";
                    $flag = 0;
                } else {
                    $flag = 1;
                    $result1 = Company::select('name')->where('id', $SiblingsID[$a])->first();
                    $result2 = parameterDetails::select('unit')->where('id', $result[0]['parameter_id'])->get();

// print a block of text using Write()
                    $txt = 'Table of ' . $result1['name'] . $pdf->Ln();
                    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
                    $html = '<h2 align="center"><b> </b></h2>';
                    $pdf->writeHTML($html, true, false, true, false, '');
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
            }
        }


        if ($flag != 0){

            $txt = <<<EOD
============Report Summary============



Report Start Time and Date: $TestStartCall
Report  End  Time and Date: $TestEnd

EOD;

// print a block of text using Write()
            $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

            $pdf->Output();

        }


    }

    public function PDFYesterday()
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
        //echo $value;
        if ( empty($value)) {
            echo "Select One meter on Homepage to generate report";
            App::abort(404);
//                echo "Array is empty ";
            $flag = 0;
        }
        else {
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

            date_default_timezone_set('Asia/Kolkata');
            $TestStartCall = date("Y-m-d 00:00:00", strtotime("-1 day"));
            $TestEnd = date("Y-m-d 23:59:59", strtotime("-1 day"));

            for ($a = 0; $a < sizeof($SiblingsID); $a++) {

                $header = array(array('Number', 'Parameter Name', 'Value', 'Date And Time'));
                $result = Data::select('id', 'parameter_id', 'value', 'DateTime')
                    ->havingRaw('id%60 = 0')
                    ->where('meter_id', $SiblingsID[$a])
                    ->where('DateTime', '>', $TestStartCall)
                    ->where('DateTime', '<', $TestEnd)
                    ->get();
//            echo $result;
                if ($result->count() == 0) {
                    echo "No Data found for selected meters";
                    App::abort(404);
//                echo "Array is empty ";
                    $flag = 0;
                } else {
                    $flag = 1;
                    $result1 = Company::select('name')->where('id', $SiblingsID[$a])->first();
                    $result2 = parameterDetails::select('unit')->where('id', $result[0]['parameter_id'])->get();

// print a block of text using Write()
                    $txt = 'Table of ' . $result1['name'] . $pdf->Ln();
                    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
                    $html = '<h2 align="center"><b> </b></h2>';
                    $pdf->writeHTML($html, true, false, true, false, '');
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
            }
        }


        if ($flag != 0){

            $txt = <<<EOD
============Report Summary============



Report Start Time and Date: $TestStartCall
Report  End  Time and Date: $TestEnd

EOD;

// print a block of text using Write()
            $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

            $pdf->Output();

        }


    }

    public function TimeCheck($nodeId)
    {
        date_default_timezone_set('Asia/Kolkata');

        $shiftCheckResult = $this->shiftCheck();
        $GLOBALS['$shiftCheckResult'] = $this->shiftCheck();
        if ($shiftCheckResult == "day" || $shiftCheckResult == "night") {
            $TestStart = date("Y-m-d 08:00:00");
        } else if ($shiftCheckResult == "midnight") {
            $TestStart = date("Y-m-d 08:00:00", strtotime("-1 day"));
        }
        return $TestStart;
    }

    public function shiftCheck()
    {
        date_default_timezone_set("Asia/Kolkata");
        $starttime = strtotime(date("Y-m-d") . "09:00:00");
        $endtime = strtotime(date("Y-m-d") . "21:00:00");
        $currenttime = strtotime('now');
        $nextstarttime = strtotime(date('Y-m-d', strtotime(' +1 day')) . "09:00:00");
        if ($currenttime >= $starttime && $currenttime < $endtime) {
            return "day";
        } else if ($currenttime >= $endtime) {
            return "night";
        } else if ($currenttime < $nextstarttime)
            return "midnight";
        else
            return "error!";
    }

}