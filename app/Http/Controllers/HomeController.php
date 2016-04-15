<?php namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Input;
use File;
use Validator;
use Illuminate\Support\Facades\Session as Session;
use DB;
use App\testdata as testdata;
use App\parameterDetails as Parameter;
use App\Data as Data;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the application's "dashboard" for users that
    | are authenticated. Authentication is provided by the middleware in
    | in the constructor.
    |
    *

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {

        $html = $this->getHtmlForHierarchy(); //for left navigation
        $dataForPreviousValues = $this->PreviousValues(18); //for live graph
        $dataForTable = $this->TableValue(18); //for Table
        return view('maincontent', compact('html','dataForPreviousValues','dataForTable'));

        $user = \Auth::user();
        $associated_id = $user->asso_id;
        if($associated_id == 0){
            $html = '';//$this->getHTMLforAdmin();
            return view('adminPanel.adminDashboard', compact('html'));
        }
        else {
            $html = $this->getHtmlForHierarchy(); //for left navigation
            $dataForPreviousValues = $this->PreviousValues(); //for live graph
            $dataForTable = $this->TableValue(4); //for Table
            return view('maincontent', compact('html', 'dataForPreviousValues', 'dataForTable'));
        }
    }


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


//    =============================New USER Insertion from form BELOW==================================
public function AdminPanelNewUser(Request $request){
    $name = $request->get('inputName3');
    $email = $request->get('inputEmail3');
    $password = bcrypt($request->get('inputPassword3'));
    $asso_id = $request->get('inputAsso3');

    $root = User::create(['name' => $name, 'email' => $email, 'password' => $password, 'asso_id' => $asso_id]);   //Creating node
}
//    =============================New USER Insertion from form Finish==================================


    // -----------------------LEFT NAVIGATION HIERARCHY CODE BELOW ----------------------------
    /**
     * Recursive function that returns tree for a given node.
     * Specially made for AdminLTE
     *
     * @param $node
     */
    public function renderNode($node)
    {
        global $html;

        if ($node->children()->count() > 0) {
            $html = $html . "<li class='treeview'>"
                          . "<a href='#'><i class='fa fa-circle'></i><span>{$node->name}</span>"
                          . "<i class='fa fa-angle-left pull-right'></i></a>"
                          . "<ul class='treeview-menu'>";

            foreach ($node->children as $child)
                $this->renderNode($child);

            $html = $html . "</ul>";
        } else {
            $html = $html . "<li>"
                          . "<a href='/"
                          .env('URL_ENTITY', 'auto')
                          ."/{$node->id}'><i class='fa fa-circle'></i><span>{$node->name}</span></a>";
        }

        $html = $html . "</li>";
    }
    /**
     * Generate html for hierarchy from a given collection of nested arrays.
     * Specially made for AdminLTE.
     *
     * @return string
     * @internal param $companyHierarchyCollection
     */
    public function getHtmlForHierarchy() {

        $user = \Auth::user();
        $associated_id = $user->asso_id;
        //get the descendants of the given company for sidebar hierarchy into a collection
        $companyHierarchyCollection = Company::where('id', '=', $associated_id)
                                        ->first()->getDescendants()->toHierarchy();

        global $html;
        foreach ($companyHierarchyCollection as $root) {
            $html = $html . $this->renderNode($root);
        }

        return $html;
    }
    // -----------------------LEFT NAVIGATION HIERARCHY CODE Finish ----------------------------

    // -----------------------GRAPH REQUIRED CODE BELOW ----------------------------------------
    public function PreviousValues($nodeId)
    {
        date_default_timezone_set('Asia/Kolkata');

        $shiftCheckResult = $this->shiftCheck();
        $GLOBALS['$shiftCheckResult'] = $this->shiftCheck();
        $nowTime = strtotime('now');
        if ($shiftCheckResult == "day") {
            $morningShiftTime = strtotime(date("Y-m-d") . "09:00:00");
            $tenMinutesAfterMorningShiftTime = strtotime(date("Y-m-d") . "09:10:00");
            if ($nowTime >= $morningShiftTime && $nowTime <= $tenMinutesAfterMorningShiftTime)
                $previousValueData = $this->fetchData("08:45:00",$nodeId);
            else
                $previousValueData = $this->fetchData("09:00:00",$nodeId);
        } else if ($shiftCheckResult == "night" || $shiftCheckResult == "midnight") {
            $nightShiftTime = strtotime(date("Y-m-d") . "21:00:00");
            $tenMinutesAfterNightShiftTime = strtotime(date("Y-m-d") . "21:10:00");
            if ($nowTime >= $nightShiftTime && $nowTime <= $tenMinutesAfterNightShiftTime)
                $previousValueData = $this->fetchData("20:45:00",$nodeId);
            else
                $previousValueData = $this->fetchData("21:00:00",$nodeId);
        }

        return $previousValueData;
        //return view('graphs.index',compact('dataForPreviousValues'));
    }
    public function LiveValues($nodeId)
    {
//        echo "id from client is ".$nodeId;
        $query =  Data::select('id','meter_id','parameter_id','value','DateTime')->where('meter_id','=',$nodeId)->where('DateTime','>=',DB::raw('DATE_SUB(NOW(),INTERVAL 4 SECOND)'))->where('DateTime','<=',DB::raw('DATE_ADD(NOW(),INTERVAL 4 SECOND)'))->get();
        return json_encode($query);
    }
    public function shiftCheck()
    {
        $shiftCheckResult = "";
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
    /**
     * @param $RequiredStartTimeOfShift
     */
    public function fetchData($RequiredStartTimeOfShift,$nodeId)
    {

        if ($GLOBALS['$shiftCheckResult'] == "midnight")
            $dateVariable = date('Y-m-d', strtotime(' -1 day')) . " " . $RequiredStartTimeOfShift;  //I need to figure out this, '-1 day' that why have i used...
        else
            $dateVariable = date("Y-m-d") . " " . $RequiredStartTimeOfShift;

        $now = date('Y-m-d H:i:s');

        $parameterIdOfCurrentNode = Company::select('parameter_id')->where('id','=',$nodeId)->get();

        $sql = Data::select('id','meter_id','parameter_id','value','DateTime')
                    ->where('meter_id','=',$nodeId)->whereBetween('DateTime',[$dateVariable,$now])
                    ->get();
//        $sql = Data::with('paraDetails')->find(1)->paraDetails;
//        $sql = Parameter::find(1)->dataDetails;
//            echo "para id - ".$parameterIdOfCurrentNode;
//        $parameterIdOfCurrentNode = $sql[0]['parameter_id'];
        $parameterNameOfCurrentNode = Parameter::select('unit')->where('id','=',$parameterIdOfCurrentNode[0]['parameter_id'])->get();
//        echo json_decode($parameterNameOfCurrentNode);
//        $finalResult = array_merge(json_decode($parameterNameOfCurrentNode),json_decode($sql));
        $final = ['parameter'=>$parameterNameOfCurrentNode,'data'=>$sql];


//        echo $sql;
//        return $finalResult;
//        return $sql;
        return $final;

    }
    // ----------------------- GRAPH CODE Finish------------------------------------------------

    public function testing()
    {
        return "inside testing function in home controller";
//        return view('pages.mapping');
        // $parent = Company::where('id','12')->first()->getRoot();
//        var_dump($parent);
//        var_dump($parent['name']);
        //echo $parent['name'];

//        $ancestor = Company::where('id','3')->parent()->get();
//        //var_dump($ancestor['name']);
//        echo $ancestor['name'];


//        $parent = Company::where('id','3')->parent()->get();
//        echo $parent;

    }

//    =========================Table Generation Code BELOW======================================
    public function TableFromHierarchy($nodeId)
    {
        $dataForTable = $this->TableValue($nodeId);
        Session::set('nodeID', $nodeId);
        $html = $this->getHtmlForHierarchy(); //for left navigation
        $dataForPreviousValues = $this->PreviousValues($nodeId); //for live graph              
//        echo $dataForPreviousValues;
        return view('maincontent', compact('html','dataForPreviousValues','dataForTable'));
    }
    public function TableValue($meterIdFromHierarchy)
    {
        $query = Data::select('parameter_id','value','DateTime')->where('meter_id',$meterIdFromHierarchy)->take(100)->get();
        $html1 = '';
        for($a = 0; $a<sizeof($query); $a++) {
            $html1 = $html1 . ' <tr>';
            $html1 = $html1 . '<td>'. ($a+'1') .'</td>';
            $html1 = $html1 . '<td>'. $query[$a]['parameter_name'] .'</td>';
            $html1 = $html1 . '<td>'. $query[$a]['value'] .'</td>';
            $html1 = $html1 . '<td>'. $query[$a]['DateTime'] .'</td>';
            $html1 = $html1 . ' </tr>';
        }
        return $html1;
    }
//    =========================Table Generation Code FINISH======================================

}
