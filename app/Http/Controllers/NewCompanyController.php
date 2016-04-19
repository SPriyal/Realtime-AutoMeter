<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session as Session;
use App\Company;
use App\User;
use Input;
use File;
use Validator;
use App\Data as Data;
use Illuminate\Http\Request;

class NewCompanyController extends Controller {

	//

    //    =============================New Company Insertion from CSV Parser Code BELOW==================================
    public function processAdminPanelNewCompany(Request $request){
        date_default_timezone_set('Asia/Kolkata');
        $nowDateTime = date("d_m_Y-H_i_s");
        $newFile = $request->file('newCompanyCsvFile');
        $newCompanyName = $request->get('newCompanyName');
//        $newCompanyCsvFileName = $request->get('newCompanyCsvFileName') ;
//        echo "Company name is :".$newCompanyName.":...";
//        $rules = array('newCompanyCsvFile' => 'required',);
//        $validator = Validator::make($newFile, $rules);
//        if ($validator->fails()) {
//            // send back to the page with the input data and errors
//            return Redirect::to('upload')->withInput()->withErrors($validator);
//        }
//        else
        if($newCompanyName!="")
        {
            if ($newFile->isValid()) {
                $extension = $newFile->getClientOriginalExtension(); // getting extension
                $fileName = $newCompanyName.'_'.$nowDateTime.'.'.$extension;
                Storage::disk('local')->put($fileName,  File::get($newFile));
                Session::flash('success', 'Upload successfully');
//              Some variable initializations
                $i=0;
                foreach(file($newFile) as $line){
                    $companyFileArray[$i] = $line;
                    $i++;
                }
                for($i=0;$i<sizeof($companyFileArray);$i++){
                    $companyDetailsIn2dArray[$i] =str_getcsv($companyFileArray[$i]);
                }
                $csvPath = $newCompanyName . '/';
                $root = Company::create(['name' => $newCompanyName, 'csvFilePath' => $csvPath]);   //Creating node
                $root->makeRoot();  //Making Root Node
                for($i=0;$i<sizeof($companyDetailsIn2dArray);$i++){
                    if($companyDetailsIn2dArray[$i][0]!=""){
                        $this->addNewCompanyNode($root,$i,0,$companyDetailsIn2dArray,$csvPath);
                    }
                }
                echo "File Parsed Successfully!";
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
            }
        }
    }
    public function addNewCompanyNode($root,$I,$J,$contentForNode,$csvPath){
        $newNode[$I][$J] = Company::create(['name' => $contentForNode[$I][$J], 'csvFilePath' => $csvPath]);
        $newNode[$I][$J]->makeChildOf($root);
        $childrenListForCurrentNode = $this->findChildNodeOfCurrentNode($I,$J,$contentForNode);
        for($n=0;$n<sizeof($childrenListForCurrentNode);$n++){
            $this->addNewCompanyNode($newNode[$I][$J],$childrenListForCurrentNode[$n],$J+1,$contentForNode,$csvPath);
        }
    }
    public function findChildNodeOfCurrentNode($i,$j,$contentForNode){
        $childrenLocationArray = array();
        if($j+1<sizeof($contentForNode[$i])) {
            if ($contentForNode[$i][$j + 1] != "") {
                array_push($childrenLocationArray, $i);
            }
        }
        for($m=$i+1;$m<sizeof($contentForNode);$m++){
            if($contentForNode[$m][$j] == ""){
                if($j+1<sizeof($contentForNode[$i])) {
                    if ($contentForNode[$m][$j + 1] != "") {
                        array_push($childrenLocationArray, $m);
                    }
                }
            }
            else{
                break;
            }
        }
        return $childrenLocationArray;
    }
//    =============================New Company Insertion from CSV Parser Code FINISH==================================


}
