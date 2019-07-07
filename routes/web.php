<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use App\treasury;
// use App\payment;
// use App\agent;
// use App\district;
// // use App\DB;

// Route::get('/insert', function () {

//     $treasury=treasury::findorfail(1);
//     $payment=new payment(['amountpaid'=>100000]);
//     $treasury->amountAvailable()->save($payment);
// });
// Route::get('/insert/1', function () {

//     $district=district::findorfail();
//     $agent=new agent(['userName'=>'aksam','Member_Id'=>1,'status'=>0,'signature'=>'b','payment_No'=>2000]);
//     $district->agentAvailable()->save($agent);
// });
// Route::get('/read', function(){
//     $results=DB::select('select name from districts where (select agentId from agents where userName=?)',['aksam']);
//     return $results;
// });


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/high', 'HomeController@hierca')->name('home');

Route::get('/stat', 'HomeController@stat')->name('home');

Route::get('/record', 'HomeController@records')->name('home');

Route::get('/upgrade', 'HomeController@upgrades')->name('home');
Route::get('/upgrade/do', 'HomeController@becomeAgent')->name('home');

Route::post('/newpayment','HomeController@newpayment')->name('home');

Route::post('/newuser/dis', 'HomeController@formdata1')->name('home');
Route::post('/newuser/id', 'HomeController@formdata')->name('home');
// changes district id to the one required .
route::get('/dis','HomeController@changeid')->name('home'); 

Route::group(['Middleware'=>'Auth'],function(){
    
    Route::get('/newuser', 'HomeController@form')->name('home');
    Route::get('/newdist', 'HomeController@districtinfo')->name('home');
    Route::get('/payment', 'HomeController@payment')->name('home');
});




