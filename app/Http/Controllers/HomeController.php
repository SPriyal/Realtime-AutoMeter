<?php namespace App\Http\Controllers;

use App\Company;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Session as Session;
use DB;
use App\parameterDetails;
use App\parameterDetails as Parameter;
use App\Data as Data;
use PhpParser\Node\Param;
use Response;

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
//    =================================Index Page Related Code BELOW==============================================
    public function index()
    {
        $value = Session::flush();  //To clear all session values.
        $user = \Auth::user();
        $assocIdOfCurrentUser = $user->asso_id; //Assoc id of current user
        if ($assocIdOfCurrentUser == 0) {
            $html = '';//$this->getHTMLforAdmin();
            return view('adminPanel.adminDashboard', compact('html'));
        } else{
            $objectOfAssocIdOfCurrentUser = Company::where('id', '=', $assocIdOfCurrentUser)->first();
            if ($objectOfAssocIdOfCurrentUser) {
                $html = $this->getHtmlForHierarchy($assocIdOfCurrentUser); //for left navigation
                $companyNode = $objectOfAssocIdOfCurrentUser->getRoot();
                $companyAndMeterNames = array('companyName'=>$companyNode->name, 'assocId'=> $assocIdOfCurrentUser);
                $breadcrumbs ="";
                if($objectOfAssocIdOfCurrentUser->isRoot()){
                    $typeOfIndex = $this->indexPageDecider($objectOfAssocIdOfCurrentUser);
                    $productionData = $this->getPreviousTotalProductionAndDescendantData($assocIdOfCurrentUser);
                    $dataForTable = "";
                    return view('ownerOrDepartmental',compact('html','companyAndMeterNames','typeOfIndex','productionData','dataForTable'));
                }else {
                    $idOfFirstLeafOfCurrentUser = $objectOfAssocIdOfCurrentUser['id'];
                    $dataForPreviousValues = $this->PreviousValues($idOfFirstLeafOfCurrentUser); //for live graph
                    $dataForTable = $this->TableValue($idOfFirstLeafOfCurrentUser); //for Table
                    $typeOfIndex = $this->indexPageDecider($objectOfAssocIdOfCurrentUser);
                    return view('maincontent', compact('html', 'dataForPreviousValues', 'dataForTable','companyAndMeterNames','breadcrumbs','typeOfIndex'));
                }
            } else {
                return response(view('errors.401'),401);
                //echo "Invalid Association ID. Contact Administrator!";
            }
        }
    }

    public function indexForMeterFromHierarchy($nodeId)
    {
        $user = \Auth::user();
        $assocIdOfCurrentUser = $user->asso_id; //Assoc id of current user
        $objectOfNodeId = Company::where('id','=',$nodeId)->first();
        $objectOfAssocIdOfCurrentUser = Company::where('id', '=', $assocIdOfCurrentUser)->first();
        if($objectOfNodeId) {
            if ($objectOfNodeId->isDescendantOf($objectOfAssocIdOfCurrentUser)) {
                if ($objectOfNodeId->isLeaf()) {
                    $idOfFirstLeafOfCurrentUser = $objectOfNodeId['id'];
                    $leafMeterObject = $objectOfNodeId;
                } else {
                    $objectOfLeafIdOfRequestedNode = $objectOfNodeId->getLeaves()->first();
                    $idOfFirstLeafOfCurrentUser = $objectOfLeafIdOfRequestedNode['id'];
                    $leafMeterObject = $objectOfLeafIdOfRequestedNode;
                }
                $dataForTable = $this->TableValue($idOfFirstLeafOfCurrentUser);
                Session::set('nodeID', $idOfFirstLeafOfCurrentUser);
                $html = $this->getHtmlForHierarchy($assocIdOfCurrentUser); //for left navigation
                $dataForPreviousValues = $this->PreviousValues($idOfFirstLeafOfCurrentUser); //for live graph
                $companyNode = $objectOfAssocIdOfCurrentUser->getRoot();
                $breadcrumbs = $this->getBreadCrumbs($objectOfNodeId);
                $companyAndMeterNames = array('companyName'=>$companyNode->name);
                $typeOfIndex = $this->indexPageDecider($leafMeterObject);
                return view('maincontent', compact('html', 'dataForPreviousValues', 'dataForTable','companyAndMeterNames','breadcrumbs','typeOfIndex'));
            }
            else {
                return response(view('errors.401'),401);
               // echo "Node Id not in the scope of user! Contact Administrator";
            }
        } else{
            return response(view('errors.401'),401);
//            echo "Invalid Association ID. Contact Administrator!";
        }
    }
//    =================================Index Page Related Code FINISH==============================================



//    =================================BreadCrumbs BELOW==============================================
    public function getBreadCrumbs($objectOfNodeId){
    $ancestorsOfCurrentAssocId = $objectOfNodeId->getAncestorsAndSelf();
    $breadcrumbs = "<ol class=\"breadcrumb\" style=\"background: none\">\n";
    $i=0;
    $lengthOfAncestorObject = count($ancestorsOfCurrentAssocId);
    foreach($ancestorsOfCurrentAssocId as $ancestor){
        $i++;
        if($lengthOfAncestorObject == 1)
            $breadcrumbs .= " <li class=\"active\"><p><span class='glyphicon glyphicon-home'></span></p></li>\n";
        else {
            if ($i == 1)
                $breadcrumbs .= " <li><a href='/'><p><span class='glyphicon glyphicon-home'></span></p></a></li>\n";
            else if ($i == $lengthOfAncestorObject)
                $breadcrumbs .= " <li class=\"active\">" . $ancestor['name'] . "</li>\n";
            else
                $breadcrumbs .= " <li><a href='/" . env('URL_ENTITY', 'auto') . "/" . $ancestor['id'] . "'>" . $ancestor['name'] . "</a></li>\n";
        }
    }
    $breadcrumbs .= "</ol>\n";
    return $breadcrumbs;
}
//    =================================BreadCrumbs FINISH==============================================


//    =================================Index Page Type Decider BELOW==============================================
    public function indexPageDecider($objectOfNodeid){
    if($objectOfNodeid->isLeaf()){
        return "leaf";
    }else if ($objectOfNodeid->isRoot()) {
        return "root";
    }else{
//        $companyNode = $objectOfNodeid->getRoot();
//        $heightOfCompany = $companyNode->getDescendants()->max('depth');
//        $levelOfCurrentNode = $objectOfNodeid->getLevel();
//        echo "minus 1 is : " . ($heightOfCompany - 1);
        $levelOfCurrentNode = $objectOfNodeid->getLevel();
//        $levelOfLeafOfCurrentNode = $objectOfNodeid->getLeaves()->getLevel();
//        echo "current level is ". $levelOfCurrentNode . "and its leaf level is " . $levelOfLeafOfCurrentNode;
//        $differenceInBothLevel = $levelOfLeafOfCurrentNode - $levelOfCurrentNode;
//        if($differenceInBothLevel == 1){
//            return "machinal";
//        }else{
//            return "departmental";
//        }
        return "other";
    }

}
//    =================================Index Page Type Decider FINISH==============================================



//    =============================New USER Insertion from form BELOW==================================
    public function AdminPanelNewUser(Request $request){
    $name = $request->get('inputName3');
    $email = $request->get('inputEmail3');
    $pass = $request->get('inputPassword3');
    $password = bcrypt($pass);
    $asso_id = $request->get('inputAsso3');

    if($name == NULL || $email == NULL || $pass == NULL || $asso_id ==NULL ){
        echo "Fields cannot be empty. Please go back. "; //TODO: Set Alert and Validation of inputs
        return;
    }
    $root = User::create(['name' => $name, 'email' => $email, 'password' => $password, 'asso_id' => $asso_id]);   //Creating node

    if($root){
        echo "User Added to Database!";
    }
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
    public function getHtmlForHierarchy($associated_id) {

//        $user = \Auth::user();
//        $associated_id = $user->asso_id;
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
        $query =  Data::select('id','meter_id','parameter_id','value','DateTime')->where('meter_id','=',$nodeId)->where('DateTime','>=',DB::raw('DATE_SUB(NOW(),INTERVAL 45 SECOND)'))->where('DateTime','<=',DB::raw('DATE_ADD(NOW(),INTERVAL 45 SECOND)'))->get();
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
     * @return array
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
        $parameterNameOfCurrentNode = Parameter::select('id','unit')->where('id','=',$parameterIdOfCurrentNode[0]['parameter_id'])->get();
//        echo json_decode($parameterNameOfCurrentNode);
//        $finalResult = array_merge(json_decode($parameterNameOfCurrentNode),json_decode($sql));
        $final = ['parameter'=>$parameterNameOfCurrentNode,'data'=>$sql];


//        echo $sql;
//        return $finalResult;
//        return $sql;
        return $final;

    }
    // ----------------------- GRAPH CODE Finish------------------------------------------------


//    =============================ownerOrDepartmentalIndex Page Code BELOW==================================
    public function getPreviousTotalProductionAndDescendantData($nodeId) {
        date_default_timezone_set('Asia/Kolkata');
        $objectOfCurrentNode = Company::where('id','=',$nodeId)->first();
        $descendantsBelowOneLevel = $objectOfCurrentNode->getDescendants(1);
        $totalProduction = 0;
        $combinedData = array();
        for($j=0;$j<7;$j++){
            $i=0;
            foreach($descendantsBelowOneLevel as $descendant){
                $leavesOfDescendant = $descendant->getLeaves()->all();
                $combinedData['totalProduction'][Carbon::now()->subDays($j)->format("Y-m-d")]['data'] = 0;
                $combinedData['totalProduction'][Carbon::now()->subDays($j)->format("Y-m-d")]['dateTime'] = Carbon::now()->subDays($j)->format("Y-m-d");
                $combinedData['descendants'][Carbon::now()->subDays($j)->format("Y-m-d")][$i] = ['deptName' => $descendant['name'], 'deptId' => $descendant['id'], 'value' => 0, 'dateTime' => Carbon::now()->subDays($j)->format("Y-m-d")];
                foreach($leavesOfDescendant as $leaf){
                    if($leaf->parameter_id == 1) {
                        $data = Data::whereDate('DateTime', '=', Carbon::now()->subDays($j)->format("Y-m-d"))->where('meter_id', '=', $leaf->id)->orderBy('DateTime', 'desc')->first();
                        // TODO - Parameter is hard coded in this whole section.... It will work on one primary parameter....
                        $combinedData['totalProduction'][Carbon::now()->subDays($j)->format("Y-m-d")]['data'] = 0;
                        $combinedData['totalProduction'][Carbon::now()->subDays($j)->format("Y-m-d")]['dateTime'] = Carbon::now()->subDays($j)->format("Y-m-d");
                        $combinedData['descendants'][Carbon::now()->subDays($j)->format("Y-m-d")][$i] = ['deptName' => $descendant['name'], 'deptId' => $descendant['id'], 'meter_id' => $data['meter_id'], 'meter_name' => $leaf['name'], 'value' => 0, 'dateTime' => Carbon::now()->subDays($j)->format("Y-m-d")];
                        if ($data) {
                            $totalProduction += $data['value'];
                            $combinedData['totalProduction'][Carbon::now()->subDays($j)->format("Y-m-d")]['data'] = $totalProduction;
                            $combinedData['descendants'][Carbon::now()->subDays($j)->format("Y-m-d")][$i] = ['deptName' => $descendant['name'], 'deptId' => $descendant['id'], 'meter_id' => $data['meter_id'], 'meter_name' => $leaf['name'], 'value' => $data['value'], 'dateTime' => $data['DateTime']];
                            $combinedData['totalProduction'][Carbon::now()->subDays($j)->format("Y-m-d")]['dateTime'] = $data['DateTime'];
                        }
                    }
                }
                $i++;
            }
            $totalProduction = 0;
        }
        $parameterOfData = Parameter::where('id','=','1')->first();
        $combinedData['parameterUnit']['value'] = $parameterOfData['unit'];
//        return json_encode($combinedData);
        return $combinedData;
    }
    public function OwnerTableValue($meterIdFromHierarchy)
    {
        $query = Data::select('id','parameter_id','value','DateTime')
//            ->havingRaw('id%10 = 0')
            ->where('meter_id',$meterIdFromHierarchy)
            ->where('DateTime', '>', date('Y-m-d 08:00:00'))
            ->orderBy('DateTime','des')
            ->get();

        if ( $query->count() == 0) {
//                App::abort(404);
//            echo "Array is empty ";
            date_default_timezone_set("Asia/Kolkata");
            $html1 = '';
            $html1 = $html1 . ' <tr>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . ' </tr>';
            return $html1;
        }
        else {
//            $value = Session::get('nodeID');
//            $result1 = Company::select('name')->where('id', $value)->first();
            $result2 = parameterDetails::select('parameter_name','unit')->where('id', $query[0]['parameter_id'])->get();
            $html1 = '';
            for ($a = 0; $a < sizeof($query); $a++) {
                $html1 = $html1 . ' <tr>';
                $html1 = $html1 . '<td>' . ($a + '1') . '</td>';
                $html1 = $html1 . '<td>' . $result2[0]['parameter_name'] . '</td>';
                $html1 = $html1 . '<td>' . $query[$a]['value'] . ' ' . $result2[0]['unit'] . '</td>';
                $html1 = $html1 . '<td>' . $query[$a]['DateTime'] . '</td>';
                $html1 = $html1 . ' </tr>';
            }
            return $html1;
        }
    }


//    public function getDescendantTiles($nodeId){
//        $productionData = $this->getPreviousTotalProductionAndDescendantData($nodeId);
//        $pDarray = json_decode($productionData);
////        echo $pDarray['totalProduction']['data'];
//        print_r($pDarray);
//        echo $productionData;
//        var_dump($pDarray);
//    }

//    =============================ownerOrDepartmentalIndex Page Code FINISH==================================



//    =========================Testing function BELOW======================================
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
//    =========================Testing function FINISH======================================




//    =========================Table Generation Code BELOW======================================
    public function TableValue($meterIdFromHierarchy)
    {
        $query = Data::select('id','parameter_id','value','DateTime')
//            ->havingRaw('id%10 = 0')
            ->where('meter_id',$meterIdFromHierarchy)
            ->where('DateTime', '>', date('Y-m-d 08:00:00'))
            ->orderBy('DateTime','des')
            ->get();

        if ( $query->count() == 0) {
//                App::abort(404);
//            echo "Array is empty ";
            date_default_timezone_set("Asia/Kolkata");
            $html1 = '';
            $html1 = $html1 . ' <tr>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . '<td>' . ('No Data Found') . '</td>';
            $html1 = $html1 . ' </tr>';
            return $html1;
        }
        else {
//            $value = Session::get('nodeID');
//            $result1 = Company::select('name')->where('id', $value)->first();
            $result2 = parameterDetails::select('parameter_name','unit')->where('id', $query[0]['parameter_id'])->get();
            $html1 = '';
            for ($a = 0; $a < sizeof($query); $a++) {
                $html1 = $html1 . ' <tr>';
                $html1 = $html1 . '<td>' . ($a + '1') . '</td>';
                $html1 = $html1 . '<td>' . $result2[0]['parameter_name'] . '</td>';
                $html1 = $html1 . '<td>' . $query[$a]['value'] . ' ' . $result2[0]['unit'] . '</td>';
                $html1 = $html1 . '<td>' . $query[$a]['DateTime'] . '</td>';
                $html1 = $html1 . ' </tr>';
            }
            return $html1;
        }
    }
//    =========================Table Generation Code FINISH======================================

}
