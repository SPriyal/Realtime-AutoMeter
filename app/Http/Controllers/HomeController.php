<?php namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Session as Session;
use DB;
use App\parameterDetails;
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
//    =================================Index Page Related Code BELOW==============================================
    public function index()
    {
        $user = \Auth::user();
        $assocIdOfCurrentUser = $user->asso_id; //Assoc id of current user
        if ($assocIdOfCurrentUser == 0) {
            $html = '';//$this->getHTMLforAdmin();
            return view('adminPanel.adminDashboard', compact('html'));
        } else{
            $objectOfAssocIdOfCurrentUser = Company::where('id', '=', $assocIdOfCurrentUser)->first();
            if ($objectOfAssocIdOfCurrentUser) {
                if ($objectOfAssocIdOfCurrentUser->isLeaf()) {
                    $idOfFirstLeafOfCurrentUser = $objectOfAssocIdOfCurrentUser['id'];
                    $leafMeterObject = $objectOfAssocIdOfCurrentUser;
                } else {
                    $objectOfLeafIdOfCurrentUser = $objectOfAssocIdOfCurrentUser->getLeaves()->first();
                    $idOfFirstLeafOfCurrentUser = $objectOfLeafIdOfCurrentUser['id'];
                    $leafMeterObject = $objectOfLeafIdOfCurrentUser;
                }
                $html = $this->getHtmlForHierarchy($assocIdOfCurrentUser); //for left navigation
                $dataForPreviousValues = $this->PreviousValues($idOfFirstLeafOfCurrentUser); //for live graph
                $dataForTable = $this->TableValue($idOfFirstLeafOfCurrentUser); //for Table
                $companyNode = $objectOfAssocIdOfCurrentUser->getRoot();
                $companyAndMeterNames = array();
                $companyAndMeterNames[] = ['companyName'=>$companyNode->name,'meterName'=>$leafMeterObject->name];
                return view('maincontent', compact('html', 'dataForPreviousValues', 'dataForTable','companyAndMeterNames'));
            } else {
                echo "Invalid Association ID. Contact Administrator!";
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
                $companyAndMeterNames = array();
                $companyAndMeterNames[] = ['companyName'=>$companyNode->name,'meterName'=>$leafMeterObject->name];
                return view('maincontent', compact('html', 'dataForPreviousValues', 'dataForTable','companyAndMeterNames'));
            }
            else {
                echo "Node Id not in the scope of user! Contact Administrator";
            }
        } else{
            echo "Invalid Association ID. Contact Administrator!";
        }
    }
//    =================================Index Page Related Code FINISH==============================================




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
                App::abort(404);
//            echo "Array is empty ";
        }
        else {
            $value = Session::get('nodeID');
            $result1 = Company::select('name')->where('id', $value)->first();
            $result2 = parameterDetails::select('unit')->where('id', $query[0]['parameter_id'])->get();
            $html1 = '';
            for ($a = 0; $a < sizeof($query); $a++) {
                $html1 = $html1 . ' <tr>';
                $html1 = $html1 . '<td>' . ($a + '1') . '</td>';
                $html1 = $html1 . '<td>' . $result1['name'] . '</td>';
                $html1 = $html1 . '<td>' . $query[$a]['value'] . ' ' . $result2[0]['unit'] . '</td>';
                $html1 = $html1 . '<td>' . $query[$a]['DateTime'] . '</td>';
                $html1 = $html1 . ' </tr>';
            }
            return $html1;
        }
    }
//    =========================Table Generation Code FINISH======================================

}
