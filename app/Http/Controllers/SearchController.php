<?php namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        $res   = Company::select('name')->where('name', 'LIKE', "%$query%")->take(10)->get();
        $result = array();
//        foreach($res as $r)
//        {
//            $result[] = $r;
//        }
        return Response::json($res);
    }

    public function searchDescendant(){
        $companyHierarchyCollection = Company::where('id', '=', '16')           //TODO - Add assoc id!
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
        return redirect()->action('HomeController@TableFromHierarchy',[$idForSelectedMeter[0]['id']]);
    }

}
