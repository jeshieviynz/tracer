	<?php

use Illuminate\Http\Request;
use App\alumni;
use App\Employability;
use App\CompanyDetails;
use App\Events;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/Login', function () {
    return view('auth.login');
});
// Group of admin




// Group of alumni
	Route::group(['middleware' => ['alumni']], function()
	{

		Route::get('/home', function () 
		{
		    
		    $employed = Employability::where("alumni_id", auth()->user()->alumni_id )->first();
		    $CompanyDetails = CompanyDetails::where("alumni_id", auth()->user()->alumni_id )->first();


		    if( empty( $employed )){

				return redirect('/alumnisurvey');

			}


			return view('alumni.home');
		    	
		});
	



		
		Route::get('/PersonalInfoSurvey_Step1','AlumniController@PersonalInfoSurvey_Step1'); 
		Route::get('/EmploymentInfoSurvey_Step2','AlumniController@EmploymentInfoSurvey_Step2'); 
		Route::get('/EmploymentInfoSurvey_Step2_Others','AlumniController@EmploymentInfoSurvey_Step2_Others'); 

		Route::get('/EmploymentInfoSurvey_Not_Employed','AlumniController@EmploymentInfoSurvey_Not_Employed');
		Route::delete('/alumni/{id}/deleteAlumni', 'AlumniController@deleteAlumni');
		Route::delete('/alumni/{id}/toactiveAlumni', 'AlumniController@toactiveAlumni');
		Route::post('/filloutstep1','AlumniController@filloutstep1');
		Route::post('/filloutstep2','AlumniController@filloutstep2');
		Route::post('/filloutstep3','AlumniController@filloutstep3');
		Route::get('/alumnisurvey','AlumniController@alumnisurvey');
		Route::get('/myprofile','AlumniController@myprofile');
		Route::get('/viewEvent','AlumniController@viewEvent');  
		Route::get('/Activities','AlumniController@viewActivities');
		Route::get('/Officers','AlumniController@viewOfficers');




		Route::get('/alumni/events', function () 
		{

			$events = Events::all();

		    return view('alumni.events.index', compact('events'));

		});


		Route::get('/alumni/event', function () 
		{

			$event = Events::where('id', request()->id )->first();

			return response()->json($event);
		    
		});




		Route::get('/batchmates','AlumniController@batchmates');
		Route::get('/notable','AlumniController@notable');




	});




Auth::routes();


//avatar
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('/proceed','AlumniController@proceed');
Route::post('/createaccount','AlumniController@createaccount');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');







	Route::group(['middleware' => ['isAdminOrStaff']], function()
	{
		Route::get('/import', function () {
	    return view('excel.importalumni');
		});


		Route::get('/dashboard', 'DashboardController@dashboard');


		//Route::get('/dashboard', 'AdminController@graph');

		Route::get('/Alumni','AdminController@alumnis');

		Route::get('/alumni/filter_by_year','AdminController@filter_alumni');
		Route::get('/dashboard/graph/filter','AdminController@graph_filter'); 

		Route::get('/profile', 'AdminController@profile');
		Route::post('/profile', 'AdminController@update_avatar');
		Route::get('/users', 'AdminController@users')->name('users');
		Route::get('/user', 'AdminController@getuser');
		Route::get('/getExport','ExcelController@getExport');
		Route::get('/graph','AdminController@graph');
		Route::get('/print/graph','AdminController@printGraph');
		Route::get('/googlemap','AdminController@googlemap');
		Route::post('/users/{id}/toactive', 'AdminController@activeUserModal');
		Route::post('/users/{id}/delete', 'AdminController@deleteUser')->name('delete');
		Route::patch('user/Update', 'AdminController@UpdateUser');
		Route::patch('user/UpdateProfile', 'AdminController@UpdateUserProfile');
		Route::post('alumni/Update', 'AdminController@updateAlumni');
		Route::get('alumni/get', 'AdminController@getalumni');
		Route::post('/postexcel','ExcelController@postexcel');
		Route::post('/postimport','ExcelController@postimport');

		Route::get('/events','EventController@events');
		Route::post('/events/create','EventController@createEvent');
		Route::get('/events/getevents','EventController@getEvents');
		Route::get('/events/getevent','EventController@getEvent');
		Route::post('/events/updateevent','EventController@updateEvent');
		Route::post('/events/deleteevent','EventController@deleteEvent');
		Route::post('/events/resetevent','EventController@resetEvent');



		Route::get('/staff','AdminController@staff');


		Route::get('/admin','AdminController@adminpage');

		Route::get('/Alumniofficer','AdminController@alumniOfficers');

		Route::get('/Alumniactivities','EventController@alumniActivities');


		Route::post('/alumni/add','AdminController@addAlumni');


		Route::get('/reports','ReportController@reports');
		Route::get('/reports/filters','ReportController@reports_filter');

		Route::get('/notableAlumni','AdminController@notablealumni');


		Route::get('/AllTracedAlumni','AdminController@AllTracedAlumni');
		Route::post('/alumni/officer/elect','AdminController@ElectOfficer');





	});


