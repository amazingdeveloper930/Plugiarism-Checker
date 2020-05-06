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

URL::forceScheme('http');

Route::get('/clear-cache', function() {
    // Artisan::call('config:cache');
    Artisan::call('cache:clear');
});



Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'ContactController@site_map']);


Route::post('send-email', ['as' => 'send-email', 'uses' => 'ContactController@send_email']);
Route::post('partner-email', ['as' => 'partner-email', 'uses' => 'ContactController@send_email_partner']);

Route::post('university-email', ['as' => 'university-email', 'uses' => 'ContactController@send_email_university']);

Route::post('upload', ['as' => 'upload', 'uses' => 'UploadController@upload']);
Route::delete('deletefile/{id}', ['as' => 'deletefile', 'uses' => 'UploadController@destroy']);
Route::get('setemail/{id}', ['as' => 'setemail', 'uses' => 'UploadController@email_set']);


// Report Controller
Route::post('filedata', ['as' => 'report.rawfiledata', 'uses' => 'ReportController@getRawFileData']);
Route::post('reportdata', ['as' => 'report.getsavedreportdata', 'uses' => 'ReportController@getSavedReportData']);
Route::post('reportsample', ['as' => 'report.samplecheck', 'uses' => 'ReportController@checkSampleData']);
Route::get('doanalysis', ['as' => 'report.doanalysis', 'uses' => 'ReportController@doAnalysis']);
Route::post('deletereport', ['as' => 'report.delete', 'uses' => 'ReportController@delete']);
Route::get('test', ['as' => 'report.test', 'uses' => 'ReportController@test']);
Route::get('reportdownload/{filename}', ['as' => 'report.download', 'uses' => 'ReportController@download']);
Route::post('doAnalysis_text', ['as' => 'report.doAnalysis_text', 'uses' => 'ReportController@doAnalysis_text']);
// End Report Controller

//Payment
Route::post('payment', ['as' => 'cardinity', 'uses' => 'CardinityController@makePayment']);
Route::post('university-payment', ['as' => 'cardinity_university', 'uses' => 'CardinityController@makeUniversityPayment']);
Route::post('payment-user', ['as' => 'cardinity_user', 'uses' => 'CardinityController@makeUserPayment']);
//End Payment


Route::group(['namespace' => 'frontend'], function () {

	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
	Route::get('contact', ['as' => 'pages.contact', 'uses' => 'PagesController@contact']);
	Route::get('about', ['as' => 'pages.about', 'uses' => 'PagesController@about']);
	Route::get('plagiarism', ['as' => 'pages.plagiarism', 'uses' => 'PagesController@plagiarism']);
	Route::get('resellersanddistributors', ['as' => 'pages.partners', 'uses' => 'PagesController@partners']);
	Route::get('blog', ['as' => 'pages.blog', 'uses' => 'PagesController@blog']);
	Route::get('service', ['as' => 'service', 'uses' => 'ServicesController@index']);
	Route::get('industry', ['as' => 'industry', 'uses' => 'ServicesController@industry']);
	Route::get('process', ['as' => 'process.index', 'uses' => 'ProcessController@index']);
	Route::get('processing/{id}', ['as' => 'process.processing', 'uses' => 'ProcessController@processing']);
	Route::get('terms', ['as' => 'pages.terms', 'uses' => 'PagesController@terms']);


	Route::get('plagiarism_checker', ['as' => 'pages.plagiarism_checker', 'uses' => 'PagesController@plagiarism_checker']);
	Route::get('plagiarism_detection', ['as' => 'pages.plagiarism_detection', 'uses' => 'PagesController@plagiarism_detection']);
	Route::get('plagiarism_definition', ['as' => 'pages.plagiarism_definition', 'uses' => 'PagesController@plagiarism_definition']);
	Route::get('plagiarism_detector', ['as' => 'pages.plagiarism_detector', 'uses' => 'PagesController@plagiarism_detector']);
	Route::get('copyright_checker', ['as' => 'pages.copyright_checker', 'uses' => 'PagesController@copyright_checker']);
	Route::get('online_checker', ['as' => 'pages.online_checker', 'uses' => 'PagesController@online_checker']);
	Route::get('checker_students', ['as' => 'pages.checker_students', 'uses' => 'PagesController@checker_students']);
	Route::get('checker_universities', ['as' => 'pages.checker_universities', 'uses' => 'PagesController@checker_universities']);
	Route::get('checker_business', ['as' => 'pages.checker_business', 'uses' => 'PagesController@checker_business']);
	Route::get('similarity_checker', ['as' => 'pages.similarity_checker', 'uses' => 'PagesController@similarity_checker']);
	Route::get('google_checker', ['as' => 'pages.google_checker', 'uses' => 'PagesController@google_checker']);
	Route::get('plagiarism_scanner', ['as' => 'pages.plagiarism_scanner', 'uses' => 'PagesController@plagiarism_scanner']);
	Route::get('plagiarism_example', ['as' => 'pages.plagiarism_example', 'uses' => 'PagesController@plagiarism_example']);

	Route::get('calc_universities', ['as' => 'pages.calc_universities', 'uses' => 'PagesController@calc_universities']);

	Route::get('click-counter', ['as' => 'service.click_counter', 'uses' => 'ServicesController@click_counter']);
	Route::post('get-click-code', ['as' => 'service.get_code', 'uses' => 'ServicesController@get_code']);
	Route::get('click-counter/{id}', ['as' => 'service.counter_data', 'uses' => 'ServicesController@counter_data']);

	Route::get('counter_script/{id}', ['uses' => 'ServicesController@counter_script']);

});

Route::group(['namespace' => 'backend'], function () {
	Route::get('admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
	Route::get('admin/settings', ['as' => 'admin.settings', 'uses' => 'AdminController@settings']);
	Route::get('admin/orderlist', ['as' => 'admin.orderlist', 'uses' => 'AdminController@orderlist']);
	Route::get('admin/paymentlist', ['as' => 'admin.paymentlist', 'uses' => 'AdminController@paymentlist']);
	Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'AdminController@logout']);
	Route::get('user/newsearch', ['as' => 'user.newsearch', 'uses' => 'UserController@newsearch']);
	Route::get('user/dashboard', ['as' => 'user.dashboard', 'uses' => 'UserController@index']);
	Route::get('user/logout', ['as' => 'user.logout', 'uses' => 'UserController@logout']);
	Route::get('user/price', ['as' => 'user.price', 'uses' => 'UserController@price']);
	Route::get('user/reports', ['as' => 'user.reports', 'uses' => 'UserController@reports']);
	Route::get('user/report/{id}', ['as' => 'user.report', 'uses' => 'UserController@report']);
	Route::get('user/help', ['as' => 'user.help', 'uses' => 'UserController@help']);

	Route::post('user/save', ['as' => 'user.save', 'uses' => 'UserController@save']);
	Route::get('user/self', ['as' => 'user.self', 'uses' => 'UserController@self']);
	Route::post('user/save_self', ['as' => 'user.save_self', 'uses' => 'UserController@save_self']);
	Route::post('user/delete', ['as' => 'user.delete', 'uses' => 'UserController@delete']);

	Route::get('user/payment/{id}', ['as' => 'user.payment', 'uses' => 'UserController@payment']);
	Route::get('user/payforsupport/{report_id}', ['as' => 'user.payforsupport', 'uses' => 'UserController@payforsupport']);

	Route::post('setsidebarbackcolor', ['as' => 'util.sidebarbackcolor', 'uses' => 'UtilController@setSideBarBackgroundColor']);
	Route::get('setsidebarforecolor', ['as' => 'util.sidebarforecolor', 'uses' => 'UtilController@setSideBarForegroundColor']);
	Route::get('user/demoview', ['as' => 'user.demo', 'uses' => 'DemoUserController@viewDemo'])	;


	Route::get('user/demosave', ['as' => 'user.demosave', 'uses' => 'DemoUserController@save']);
	Route::get('user/demoself', ['as' => 'user.demoself', 'uses' => 'DemoUserController@self']);
	Route::post('user/demosave_self', ['as' => 'user.demosave_self', 'uses' => 'DemoUserController@save_self']);
	Route::get('user/demodelete', ['as' => 'user.demodelete', 'uses' => 'DemoUserController@delete']);

	Auth::routes();
});

