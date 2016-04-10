<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Company;
use DB;
use App\parameterDetails as Parameter;
use Illuminate\Http\Request;

class MappingController extends Controller {

	public function mappingIndexPage(){
        $companyListFromDB = Company::select('name')->whereNull('parent_id')->get();
        $companyList = array();
        foreach($companyListFromDB as $company){
            array_push($companyList,$company["name"]);
        }
        return view('pages.mapping.mappingIndex',compact('companyList'));
    }

    public function mappingSelectionPage(Request $request){
        $selectedCompany = $request->get('companiesList');
//        echo "Company selected is - " .$selectedCompany;
        $meterDetailsForSelectedCompany = Company::where('name','=',$selectedCompany)         //unable to select only 'name' column... Remaining to do so...
                                                            ->first()->getLeaves();
        $parameterListFromDB = Parameter::select('id','parameter_name')->get();
        $parameterNameList = array();
        $parameterIdList = array();
        $meterNameListForSelectedCompany =array();
        $meterIdListForSelectedCompany =array();
        foreach ($meterDetailsForSelectedCompany as $meterName) {
            array_push($meterNameListForSelectedCompany,$meterName["name"]);
            array_push($meterIdListForSelectedCompany,$meterName["id"]);
        }
        foreach($parameterListFromDB as $parameter){
            array_push($parameterNameList,$parameter["parameter_name"]);
            array_push($parameterIdList,$parameter["id"]);
        }

//        print_r($meterListForSelectedCompany);
        return view('pages.mapping.mappingSelectionPage',compact('meterNameListForSelectedCompany','selectedCompany','meterIdListForSelectedCompany','parameterNameList','parameterIdList'));
    }

    public function mappingSubmit(Request $request){
        $selectedCompanyNameOnRequest = $request->get('companyNameOnSelectionPage');
        $meterDetailsForSelectedCompany = Company::where('name','=',$selectedCompanyNameOnRequest)         //Try Creating helper function here
                                                            ->first()->getLeaves();
        $meterIdListForSelectedCompany =array();
        foreach ($meterDetailsForSelectedCompany as $meterName) {
            array_push($meterIdListForSelectedCompany,$meterName["id"]);
        }
        for($i=0;$i<sizeof($meterIdListForSelectedCompany);$i++){
            $columnValueForMeter = $request->get($meterIdListForSelectedCompany[$i]);
            $parameterIdValueForMeter = $request->get('parametersList-'.$meterIdListForSelectedCompany[$i]);
//            echo "<br/>parameter are - :".$parameterIdValueForMeter.": ... ";
            if($columnValueForMeter != ""){
                $detailsUpdate = Company::find($meterIdListForSelectedCompany[$i]);
                $detailsUpdate->columnNoInCSV = $columnValueForMeter;
                $detailsUpdate->parameter_id = $parameterIdValueForMeter;
                $detailsUpdate->save();
            }
        }
        echo "Column Mapped Successfully!";
    }

}
