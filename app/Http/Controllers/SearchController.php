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

}
