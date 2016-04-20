<?php namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GetDatabase extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$companyList = $this->listOfCompanies();
		return view('adminPanel.db.companyList',compact('companyList'));
	}

	public function listOfCompanies()
	{
		$query = Company::select('id','name','created_at')->where('depth',0)->get();
		$html1 = '';
		for($a = 0; $a<sizeof($query); $a++) {
			$html1 = $html1 . ' <tr>';
			$html1 = $html1 . '<td>'. ($a+'1') .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['name'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['created_at'] .'</td>';
			$html1 = $html1 . ' </tr>';
		}
		return $html1;
	}

}
