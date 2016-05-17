<?php namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\parameterDetails;
use Input;
use Response;

use Illuminate\Http\Request;

class SearchController extends Controller {

	//
    public function index()
    {
        return view('pages.taTest');
    }

    public function query()
    {
        $query = Input::get('user');
        $user = \Auth::user();
        $assocIdOfCurrentUser = $user->asso_id; //Assoc id of current user
        $searchResults   = Company::where('name', 'LIKE', "%$query%")->take(10)->get();

        $parentCompany = Company::where('id','=',$assocIdOfCurrentUser)->first()->getRoot();
        $result = array();

        foreach($searchResults as $individualResult){
            if($individualResult->isDescendantOf($parentCompany)){
                $result[] = ['id'=>$individualResult->id,'name'=>$individualResult->name];
            }
        }
        return Response::json($result);
    }

    public function searchDescendant(){
        $user = \Auth::user();
        $currentUserId = $user->asso_id;

        $companyHierarchyCollection = Company::where('id', '=', $currentUserId)
                                            ->first()->getDescendants();
        $arrayOfCompanyDescendants = array();
        foreach($companyHierarchyCollection as $descendant){
            $arrayOfCompanyDescendants[] = ['id'=>$descendant->id, 'name'=>$descendant->name];
        }
        return Response::json($arrayOfCompanyDescendants);
    }

    public function searchResult(Request $request){
        $selectedMeter = $request->get('searchBox');
        $idForSelectedMeter = Company::select('id')->where('name','=',$selectedMeter)->get();
        return redirect()->action('HomeController@indexForMeterFromHierarchy',[$idForSelectedMeter[0]['id']]);
    }

}
