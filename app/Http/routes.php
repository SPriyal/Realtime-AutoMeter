<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'HomeController@index');

Route::get('/' , 'Auth\AuthController@getLogin' ) ;

Route::post('adminPanel/Process','HomeController@processAdminPanelNewCompany');

//==================Mapping related routes BELOW [parameter & csvDataColumn mappings]==================
Route::get('mapping','MappingController@mappingIndexPage');
Route::post('mapping/Selection','MappingController@mappingSelectionPage');
Route::post('mapping/Selection/Submit','MappingController@mappingSubmit');
//==================Mapping related routes FINISH [parameter & csvDataColumn mappings]==================

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/login', array('as' => 'login', 'uses' => 'Auth\AuthController@getLogin'));
Route::post('/login', array('as' => 'login', 'uses' => 'Auth\AuthController@postLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'Auth\AuthController@getLogout'));
Route::post('/liveGraphValues', 'HomeController@LiveValues');
//Show live graph if a meter name is clicked
Route::get('/'.env('URL_ENTITY', 'auto').'/{c}', ['uses' =>'HomeController@TableFromHierarchy']);
//Route::get('/'.env('URL_ENTITY', 'auto').'/{c}', function($c){$data['c'] = $c;return View::make('maincontent', $data);});
//Route::get('/'.env('URL_ENTITY', 'auto').'/{c}', function($c) {
//	echo "Entity id chosen is : ".$c;
//});

//<<<<<<<<<<<<<<--------------FOR TESTING PURPOSES ONLY-------------->>>>>>>>>>>>>>//
// make a sample hierarchy in thr database
Route::get('/makehierarchy',function(){

    $categories = [
        ['id' => 1, 'name' => 'AutoSoft Corp.', 'children' => [
            ['id' => 2, 'name' => 'Dept 1 : Spinning', 'children' => [
                ['id' => 3, 'name' => 'Machine 1 : Dyeing', 'children' => [
                    ['id' => 4, 'name' => 'Meter 1'],
                    ['id' => 5, 'name' => 'Meter 2']
                ]],
                ['id' => 6, 'name' => 'Machine 2 : Printing', 'children' => [
                    ['id' => 7, 'name' => 'Meter 1'],
                    ['id' => 8, 'name' => 'Meter 2']
                ]],
                [ 'name' => 'Machine 3 : Printing3', 'children' => [
                    ['name' => 'Meter 1'],
                    ['name' => 'Meter 2']
                ]],
            ]],
            ['id' => 14, 'name' => 'Dept 2 : Knitting', 'children' => [
                ['id' => 15, 'name' => 'Machine 1 : Dyeing', 'children' => [
                    ['id' => 9, 'name' => 'Meter 1'],
                    ['id' => 10, 'name' => 'Meter 2']
                ]],
                ['id' => 11, 'name' => 'Machine 2 : Printing']
            ]],
            ['id' => 12, 'name' => 'Dept 3 : Finishing'],
            ['id' => 13, 'name' => 'Dept 4 : Testing']
        ]],
    ];

    \App\Company::buildTree($categories); // => true

    //DB::insert('insert into users (name, email, password, remember_token, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', ['demo','demo@demo.com','$2y$10$cJvsjnFNHwtn86kKAr.XYOHsNiCef42IM./ZDwiF9r1S/CSP/Skfm','dGGve9piPpxj94WDsjTHdE1EuuewI7Ki52LdrsQ1rQDbrnAJ5kz6R7hfEafN','2015-09-14 10:37:31','2015-09-14 12:11:45']);

});

//seed the databse with meter data for the specified date for 24 hours - data per second
Route::get('/timeseed',function(){
	for($i=0;$i<=23;$i++){
	for($j=0;$j<=59;$j++){
	for($k=0;$k<=59;$k++){
		DB::insert('INSERT INTO `data` (`meter_id`, `parameter_name`, `value`, `DateTime`, `created_at`, `updated_at`) values (?, ?, ?, ?, ?, ?)',
			['4', 'k', rand(10,100), '2015-11-16 '.$i.':'.$j.':'.$k, '0000-00-00 00:00:00', '0000-00-00 00:00:00']);

	}}}

});

Route::get('/graph',function() {
	$query = DB::select('select DateTime,value from data where meter_id = 4 && DateTime >= (now() - INTERVAL 24 HOUR) && DateTime <= now()');

	$outp = "[";
	foreach ($query as $user) {
		if ($outp != "[") {
			$outp .= ",";
		}
		$outp .= '[' . strtotime($user->DateTime)*1000 . ','; //convert php time to JS time by multiplying by 1000
		$outp .= $user->value . ']';
	}
		$outp .= "]";

	return view('lol', compact('outp'));

});