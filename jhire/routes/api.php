<?php
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('employer')->group(function(){
Route::post('login', 'Api\EmployerController@login');
Route::post('register', 'Api\EmployerController@register');
	Route::group(['middleware' => 'auth:api'], function()
	{
   		Route::post('details', 'Api\EmployerController@getUser');
   		Route::post('logout', 'Api\EmployerController@logout');
	});
});


Route::prefix('jobseeker')->group(function(){

Route::post('login', 'Api\RegisterController@login');
Route::post('register', 'Api\RegisterController@register');
	Route::group(['middleware' => 'auth:api'], function()
	{
	   Route::post('details', 'Api\RegisterController@getUser');
	   Route::post('logout', 'Api\RegisterController@logout');
	});
});


/*
  
Route::post('register1', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
*/


/*
Route::post('register2', 'API\AuthController@login');
Route::post('login', 'API\AuthController@login');
Route::post('getuser', 'API\AuthController@getuser');

Route::resource('countries', 'API\CountriesController');
Route::resource('cities', 'API\CitiesController');
Route::resource('candidate_status', 'API\CandidatestatusController');
Route::resource('domains', 'API\DomainsController');
Route::resource('gender', 'API\GenderController');
Route::resource('skills', 'API\SkillsController');// not used
Route::resource('jobtypes', 'API\Job_typeController');
Route::resource('proficiency', 'API\ProficiencyController');
Route::resource('companydetails', 'API\CompanydetailsController');
Route::resource('jobposting', 'API\Job_postingController');
Route::resource('userprofile', 'API\User_profileController');
Route::resource('itexperience', 'API\TotalitexperienceController');
*/


  
Route::middleware('auth:api')->group( function () {
	//Route::resource('products', 'API\ProductController');
	//Route::resource('countries', 'API\CountriesController');
});
