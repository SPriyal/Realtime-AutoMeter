<?php namespace App\Http\Controllers;

use App\Company;
use App\Data;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\parameterDetails;
use App\User;
use Illuminate\Http\Request;

class GetDatabase extends Controller {

	public function __construct()
	{
		$this->middleware('admincheck');
	}

	public function listOfCompanies()
	{
		$query = Company::select('id','name','created_at')->where('depth',0)->get();
		$html1 = '';

		$html1 = $html1 . '<tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Creation</th></tr></thead><tbody>';

		for($a = 0; $a<sizeof($query); $a++) {
			$html1 = $html1 . ' <tr>';
			$html1 = $html1 . '<td>'. ($a+'1') .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['name'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['created_at'] .'</td>';
			$html1 = $html1 . ' </tr>';
		}

		$html1 = $html1 . '</tbody><tfoot><tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Creation</th></tr>';

		$List = $html1;
		return view('adminPanel.db.DBList',compact('List'));
	}

	public function listOfCompanyWithHierarchy()
	{
		$query = Company::select('id','name','parent_id')->where('id','>',0)->get();
		$html1 = '';

		$html1 = $html1 . '<tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Parent ID</th></tr></thead><tbody>';

		for($a = 0; $a<sizeof($query); $a++) {
			$html1 = $html1 . ' <tr>';
			$html1 = $html1 . '<td>'. ($a+'1') .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['name'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['parent_id'] .'</td>';
			$html1 = $html1 . ' </tr>';
		}

		$html1 = $html1 . '</tbody><tfoot><tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Parent ID</th></tr>';

		$List = $html1;
		return view('adminPanel.db.DBList',compact('List'));
	}

	public function listOfUsers()
	{
		$query = User::select('id','name','email','asso_id')->where('id','>',0)->get();
		$html1 = '';

		$html1 = $html1 . '<tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Asso id</th><th>Email</th></tr></thead><tbody>';

		for($a = 0; $a<sizeof($query); $a++) {
			$html1 = $html1 . ' <tr>';
			$html1 = $html1 . '<td>'. ($a+'1') .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['name'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['asso_id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['email'] .'</td>';
			$html1 = $html1 . ' </tr>';
		}

		$html1 = $html1 . '</tbody><tfoot><tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Asso id</th><th>Email</th></tr>';

		$html1 = $html1	. '<p>The Association ID is access level given to the User.
							<b>(DB-ID of Companies Table = Asso ID in Users Table)</b>
							<br>If Association Id is zero, then user is Admin.</p>';

		$List = $html1;
		return view('adminPanel.db.DBList',compact('List'));
	}
	public function listOfParameters()
	{
		$query = parameterDetails::select('id','parameter_name','unit')->where('id','>',0)->get();
		$html1 = '';

		$html1 = $html1 . '<tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Unit</th></tr></thead><tbody>';

		for($a = 0; $a<sizeof($query); $a++) {
			$html1 = $html1 . ' <tr>';
			$html1 = $html1 . '<td>'. ($a+'1') .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['parameter_name'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['unit'] .'</td>';
			$html1 = $html1 . ' </tr>';
		}

		$html1 = $html1 . '</tbody><tfoot><tr><th>Sr.</th><th>DbID</th><th>Name</th><th>Unit</th></tr>';

		$List = $html1;
		return view('adminPanel.db.DBList',compact('List'));
	}

	public function listOfData()
	{
		$query = Data::select('id','meter_id','value','DateTime')->where('id','>',0)->get();
		$html1 = '';

		$html1 = $html1 . '<tr><th>Sr.</th><th>DbID</th><th>meter_id</th><th>Value</th><th>DateTime</th></tr></thead><tbody>';

		for($a = 0; $a<sizeof($query); $a++) {
			$html1 = $html1 . ' <tr>';
			$html1 = $html1 . '<td>'. ($a+'1') .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['meter_id'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['value'] .'</td>';
			$html1 = $html1 . '<td>'. $query[$a]['DateTime'] .'</td>';
			$html1 = $html1 . ' </tr>';
		}

		$html1 = $html1 . '</tbody><tfoot><tr><th>Sr.</th><th>DbID</th><th>meter_id</th><th>Value</th><th>DateTime</th></tr>';

		$List = $html1;
		return view('adminPanel.db.DBList',compact('List'));
	}

}
