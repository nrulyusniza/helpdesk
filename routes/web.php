<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivesearchController; //add LivesearchController
use App\Http\Controllers\ResetPasswordController;  // Reset Password

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
Route::middleware(['setLocale'])->group(function () {
Route::get('/', function () {
    return view('auth.userlogin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// logout
Route::get('/logout', 'HomeController@destroy')->name('logout');

// reset password page not found
Route::get('auth/passwords/reset', 'Auth\ResetPasswordController@showResetForm')->name('auth.passwords.reset');
Route::post('auth/passwords/reset', 'Auth\ResetPasswordController@resetPassword')->name('password.update');

//------------------------------------------------------------------- DASHBOARD -------------------------------------------------------------------
// super admin's dashboard
Route::get('/dashboard/mydashboard', 'HomeController@mydashboard')->name('dashboard.mydashboard');
Route::get('dashboard/infohub/allticket', 'HomeController@allticket')->name('dashboard.infohub.allticket');
Route::get('dashboard/infohub/allopen', 'HomeController@allopen')->name('dashboard.infohub.allopen');
Route::get('dashboard/infohub/allclosed', 'HomeController@allclosed')->name('dashboard.infohub.allclosed');
Route::get('dashboard/infohub/allkiv', 'HomeController@allkiv')->name('dashboard.infohub.allkiv');

// site admin's dashboard
Route::get('/dashboard/dashboardadmin', 'HomeController@dashboardadmin')->name('dashboard.dashboardadmin');
Route::get('dashboard/infohub/listticket', 'HomeController@listticket')->name('dashboard.infohub.listticket');
Route::get('dashboard/infohub/listopen', 'HomeController@listopen')->name('dashboard.infohub.listopen');
Route::get('dashboard/infohub/listclosed', 'HomeController@listclosed')->name('dashboard.infohub.listclosed');
Route::get('dashboard/infohub/listkiv', 'HomeController@listkiv')->name('dashboard.infohub.listkiv');

// site user's dashboard
Route::get('/dashboard/dashboarduser', 'HomeController@dashboarduser')->name('dashboard.dashboarduser');
Route::get('dashboard/infohub/entireticket', 'HomeController@entireticket')->name('dashboard.infohub.entireticket');
Route::get('dashboard/infohub/entireopen', 'HomeController@entireopen')->name('dashboard.infohub.entireopen');
Route::get('dashboard/infohub/entireclosed', 'HomeController@entireclosed')->name('dashboard.infohub.entireclosed');
Route::get('dashboard/infohub/entirekiv', 'HomeController@entirekiv')->name('dashboard.infohub.entirekiv');

//------------------------------------------------------------------- EXTENSION -------------------------------------------------------------------
// super admin's extension
Route::get('/myextension', 'HomeController@myextension')->name('myextension');

//------------------------------------------------------------------- USERS -------------------------------------------------------------------
// users path - super admin view
Route::get('users/index', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users/store', 'UserController@store')->name('users.store');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
Route::get('users/alluser', 'UserController@alluser')->name('users.alluser');

//------------------------------------------------------------------- ROLES -------------------------------------------------------------------
// roles path - super admin view
Route::get('roles/index', 'RoleController@index')->name('roles.index');
Route::get('roles/create', 'RoleController@create')->name('roles.create');
Route::post('roles/store', 'RoleController@store')->name('roles.store');
Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
Route::put('roles/{role}', 'RoleController@update')->name('roles.update');
Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy');
Route::get('roles/allrole', 'RoleController@allrole')->name('roles.allrole');

//------------------------------------------------------------------- SITES -------------------------------------------------------------------
// sites path - super admin view
Route::get('sites/index', 'SiteController@index')->name('sites.index');
Route::get('sites/create', 'SiteController@create')->name('sites.create');
Route::post('sites/store', 'SiteController@store')->name('sites.store');
Route::get('sites/{site}/edit', 'SiteController@edit')->name('sites.edit');
Route::put('sites/{site}', 'SiteController@update')->name('sites.update');
Route::delete('sites/{site}', 'SiteController@destroy')->name('sites.destroy');
Route::get('sites/allsite', 'SiteController@allsite')->name('sites.allsite');

//------------------------------------------------------------------- KBCATEGORYS -------------------------------------------------------------------
// kbcategorys path - super admin view
Route::get('kbcategorys/index', 'KbcategoryController@index')->name('kbcategorys.index');
Route::get('kbcategorys/create', 'KbcategoryController@create')->name('kbcategorys.create');
Route::post('kbcategorys/store', 'KbcategoryController@store')->name('kbcategorys.store');
Route::get('kbcategorys/{kbcategory}/edit', 'KbcategoryController@edit')->name('kbcategorys.edit');
Route::put('kbcategorys/{kbcategory}', 'KbcategoryController@update')->name('kbcategorys.update');
Route::delete('kbcategorys/{kbcategory}', 'KbcategoryController@destroy')->name('kbcategorys.destroy');
Route::get('kbcategorys/allkbcategory', 'KbcategoryController@allkbcategory')->name('kbcategorys.allkbcategory');

//------------------------------------------------------------------- KNOWLEDGEBASES -------------------------------------------------------------------
// knowledgebases path - super admin view
Route::get('knowledgebases/index', 'KnowledgebaseController@index')->name('knowledgebases.index');
Route::get('knowledgebases/allknowledgebase', 'KnowledgebaseController@allknowledgebase')->name('knowledgebases.allknowledgebase');
Route::get('knowledgebases/allknowledgebasecreate', 'KnowledgebaseController@allknowledgebasecreate')->name('knowledgebases.allknowledgebasecreate');
Route::post('knowledgebases/allknowledgebasestore', 'KnowledgebaseController@allknowledgebasestore')->name('knowledgebases.allknowledgebasestore');
Route::get('knowledgebases/{knowledgebase}/allknowledgebaseedit', 'KnowledgebaseController@allknowledgebaseedit')->name('knowledgebases.allknowledgebaseedit');
// Route::put('knowledgebases/{knowledgebase}', 'KnowledgebaseController@allknowledgebaseupdate')->name('knowledgebases.allknowledgebaseupdate');
Route::put('knowledgebases/{knowledgebase}/allknowledgebaseupdate', 'KnowledgebaseController@allknowledgebaseupdate')->name('knowledgebases.allknowledgebaseupdate');
Route::delete('knowledgebases/{knowledgebase}', 'KnowledgebaseController@destroy')->name('knowledgebases.destroy');

// knowledgebases path - site admin view
Route::get('knowledgebases/listknowledgebase', 'KnowledgebaseController@listknowledgebase')->name('knowledgebases.listknowledgebase');
Route::get('knowledgebases/listknowledgebasecreate', 'KnowledgebaseController@listknowledgebasecreate')->name('knowledgebases.listknowledgebasecreate');
Route::post('knowledgebases/listknowledgebasestore', 'KnowledgebaseController@listknowledgebasestore')->name('knowledgebases.listknowledgebasestore');
Route::get('knowledgebases/{knowledgebase}/listknowledgebaseedit', 'KnowledgebaseController@listknowledgebaseedit')->name('knowledgebases.listknowledgebaseedit');
// Route::put('knowledgebases/{knowledgebase}', 'KnowledgebaseController@listknowledgebaseupdate')->name('knowledgebases.listknowledgebaseupdate');
Route::put('knowledgebases/{knowledgebase}/listknowledgebaseupdate', 'KnowledgebaseController@listknowledgebaseupdate')->name('knowledgebases.listknowledgebaseupdate');

// knowledgebases path - site user view
Route::get('knowledgebases/entireknowledgebase', 'KnowledgebaseController@entireknowledgebase')->name('knowledgebases.entireknowledgebase');
Route::get('knowledgebases/entireknowledgebasecreate', 'KnowledgebaseController@entireknowledgebasecreate')->name('knowledgebases.entireknowledgebasecreate');
Route::post('knowledgebases/entireknowledgebasestore', 'KnowledgebaseController@entireknowledgebasestore')->name('knowledgebases.entireknowledgebasestore');
Route::get('knowledgebases/{knowledgebase}/entireknowledgebaseedit', 'KnowledgebaseController@entireknowledgebaseedit')->name('knowledgebases.entireknowledgebaseedit');
// Route::put('knowledgebases/{knowledgebase}', 'KnowledgebaseController@entireknowledgebaseupdate')->name('knowledgebases.entireknowledgebaseupdate');
Route::put('knowledgebases/{knowledgebase}/entireknowledgebaseupdate', 'KnowledgebaseController@entireknowledgebaseupdate')->name('knowledgebases.entireknowledgebaseupdate');

//------------------------------------------------------------------- EQUIPMENTS & ASSET LOGS -------------------------------------------------------------------
// equipments path - super admin view
Route::get('equipments/index', 'EquipmentController@index')->name('equipments.index');
// Route::get('equipments/create', 'EquipmentController@create')->name('equipments.create');
// Route::post('equipments/store', 'EquipmentController@store')->name('equipments.store');
// Route::get('equipments/{equipment}/edit', 'EquipmentController@edit')->name('equipments.edit');
// Route::put('equipments/{equipment}', 'EquipmentController@update')->name('equipments.update');
Route::delete('equipments/{equipment}', 'EquipmentController@destroy')->name('equipments.destroy');

Route::get('equipments/allassetcreate', 'EquipmentController@allassetcreate')->name('equipments.allassetcreate');
Route::post('equipments/allassetstore', 'EquipmentController@allassetstore')->name('equipments.allassetstore');
Route::get('equipments/{equipment}/allassetedit', 'EquipmentController@allassetedit')->name('equipments.allassetedit');
// Route::put('equipments/{equipment}', 'EquipmentController@allassetupdate')->name('equipments.allassetupdate');
Route::put('equipments/{equipment}/allassetupdate', 'EquipmentController@allassetupdate')->name('equipments.allassetupdate');
Route::get('equipments/allasset', 'EquipmentController@allasset')->name('equipments.allasset');
Route::get('equipments/{equipment}/allassetlog', 'EquipmentController@allassetlog')->name('equipments.allassetlog');
Route::put('equipments/{equipment}/allassetlog/update', 'EquipmentController@allassetlogupdate')->name('equipments.allassetlogupdate');


// equipments path - site admin view
Route::get('equipments/listasset', 'EquipmentController@listasset')->name('equipments.listasset');
Route::get('equipments/{equipment}/listassetlog', 'EquipmentController@listassetlog')->name('equipments.listassetlog');

// equipments path - site user view
Route::get('equipments/entireasset', 'EquipmentController@entireasset')->name('equipments.entireasset');
Route::get('equipments/{equipment}/entireassetlog', 'EquipmentController@entireassetlog')->name('equipments.entireassetlog');

//------------------------------------------------------------------- REPORTINGPERSONS -------------------------------------------------------------------
// reportingpersons path - super admin view
Route::get('reportingpersons/index', 'ReportingpersonController@index')->name('reportingpersons.index');
Route::get('reportingpersons/allreportingpersoncreate', 'ReportingpersonController@allreportingpersoncreate')->name('reportingpersons.allreportingpersoncreate');
Route::post('reportingpersons/allreportingpersonstore', 'ReportingpersonController@allreportingpersonstore')->name('reportingpersons.allreportingpersonstore');
Route::get('reportingpersons/{reportingperson}/allreportingpersonedit', 'ReportingpersonController@allreportingpersonedit')->name('reportingpersons.allreportingpersonedit');
// Route::put('reportingpersons/{reportingperson}', 'ReportingpersonController@allreportingpersonupdate')->name('reportingpersons.allreportingpersonupdate');
Route::put('reportingpersons/{reportingperson}/allreportingpersonupdate', 'ReportingpersonController@allreportingpersonupdate')->name('reportingpersons.allreportingpersonupdate');
// Route::delete('reportingpersons/{reportingperson}', 'ReportingpersonController@allreportingpersondestroy')->name('reportingpersons.allreportingpersondestroy');
Route::delete('reportingpersons/all/{reportingperson}', 'ReportingpersonController@allreportingpersondestroy')->name('reportingpersons.allreportingpersondestroy');
Route::get('reportingpersons/allreportingperson', 'ReportingpersonController@allreportingperson')->name('reportingpersons.allreportingperson');

// reportingpersons path - site admin view
Route::get('reportingpersons/listreportingperson', 'ReportingpersonController@listreportingperson')->name('reportingpersons.listreportingperson');
Route::get('reportingpersons/listreportingpersoncreate', 'ReportingpersonController@listreportingpersoncreate')->name('reportingpersons.listreportingpersoncreate');
Route::post('reportingpersons/listreportingpersonstore', 'ReportingpersonController@listreportingpersonstore')->name('reportingpersons.listreportingpersonstore');
Route::get('reportingpersons/{reportingperson}/listreportingpersonedit', 'ReportingpersonController@listreportingpersonedit')->name('reportingpersons.listreportingpersonedit');
// Route::put('reportingpersons/{reportingperson}', 'ReportingpersonController@listreportingpersonupdate')->name('reportingpersons.listreportingpersonupdate');
Route::put('reportingpersons/{reportingperson}/listreportingpersonupdate', 'ReportingpersonController@listreportingpersonupdate')->name('reportingpersons.listreportingpersonupdate');
// Route::delete('reportingpersons/{reportingperson}', 'ReportingpersonController@listreportingpersondestroy')->name('reportingpersons.listreportingpersondestroy');
Route::delete('reportingpersons/list/{reportingperson}', 'ReportingpersonController@listreportingpersondestroy')->name('reportingpersons.listreportingpersondestroy');

// reportingpersons path - site user view
Route::get('reportingpersons/entirereportingperson', 'ReportingpersonController@entirereportingperson')->name('reportingpersons.entirereportingperson');
Route::get('reportingpersons/entirereportingpersoncreate', 'ReportingpersonController@entirereportingpersoncreate')->name('reportingpersons.entirereportingpersoncreate');
Route::post('reportingpersons/entirereportingpersonstore', 'ReportingpersonController@entirereportingpersonstore')->name('reportingpersons.entirereportingpersonstore');
Route::get('reportingpersons/{reportingperson}/entirereportingpersonedit', 'ReportingpersonController@entirereportingpersonedit')->name('reportingpersons.entirereportingpersonedit');
// Route::put('reportingpersons/{reportingperson}', 'ReportingpersonController@entirereportingpersonupdate')->name('reportingpersons.entirereportingpersonupdate');
Route::put('reportingpersons/{reportingperson}/entirereportingpersonupdate', 'ReportingpersonController@entirereportingpersonupdate')->name('reportingpersons.entirereportingpersonupdate');
// Route::delete('reportingpersons/{reportingperson}', 'ReportingpersonController@entirereportingpersondestroy')->name('reportingpersons.entirereportingpersondestroy');
Route::delete('reportingpersons/entire/{reportingperson}', 'ReportingpersonController@entirereportingpersondestroy')->name('reportingpersons.entirereportingpersondestroy');

//------------------------------------------------------------------- TYPES -------------------------------------------------------------------
// types(request_type) path - super admin view
Route::get('types/index', 'TypeController@index')->name('types.index');
Route::get('types/create', 'TypeController@create')->name('types.create');
Route::post('types/store', 'TypeController@store')->name('types.store');
Route::get('types/{type}/edit', 'TypeController@edit')->name('types.edit');
Route::put('types/{type}', 'TypeController@update')->name('types.update');
Route::delete('types/{type}', 'TypeController@destroy')->name('types.destroy');
Route::get('types/requesttype', 'TypeController@allrequesttype')->name('types.allrequesttype');

//------------------------------------------------------------------- REQCATEGORYS -------------------------------------------------------------------
// reqcategorys path - super admin view
Route::get('reqcategorys/index', 'ReqcategoryController@index')->name('reqcategorys.index');
Route::get('reqcategorys/create', 'ReqcategoryController@create')->name('reqcategorys.create');
Route::post('reqcategorys/store', 'ReqcategoryController@store')->name('reqcategorys.store');
Route::get('reqcategorys/{reqcategory}/edit', 'ReqcategoryController@edit')->name('reqcategorys.edit');
Route::put('reqcategorys/{reqcategory}', 'ReqcategoryController@update')->name('reqcategorys.update');
Route::delete('reqcategorys/{reqcategory}', 'ReqcategoryController@destroy')->name('reqcategorys.destroy');
Route::get('reqcategorys/allreqcategory', 'ReqcategoryController@allreqcategory')->name('reqcategorys.allreqcategory');

//------------------------------------------------------------------- SEVERITYS -------------------------------------------------------------------
// severitys path - super admin view
Route::get('severitys/index', 'SeverityController@index')->name('severitys.index');
Route::get('severitys/create', 'SeverityController@create')->name('severitys.create');
Route::post('severitys/store', 'SeverityController@store')->name('severitys.store');
Route::get('severitys/{severity}/edit', 'SeverityController@edit')->name('severitys.edit');
Route::put('severitys/{severity}', 'SeverityController@update')->name('severitys.update');
Route::delete('severitys/{severity}', 'SeverityController@destroy')->name('severitys.destroy');
Route::get('severitys/allseverity', 'SeverityController@allseverity')->name('severitys.allseverity');

//------------------------------------------------------------------- STATUSS -------------------------------------------------------------------
// statuss path - super admin view
Route::get('statuss/index', 'StatusController@index')->name('statuss.index');
Route::get('statuss/create', 'StatusController@create')->name('statuss.create');
Route::post('statuss/store', 'StatusController@store')->name('statuss.store');
Route::get('statuss/{status}/edit', 'StatusController@edit')->name('statuss.edit');
Route::put('statuss/{status}', 'StatusController@update')->name('statuss.update');
Route::delete('statuss/{status}', 'StatusController@destroy')->name('statuss.destroy');
Route::get('statuss/allstatus', 'StatusController@allstatus')->name('statuss.allstatus');

//------------------------------------------------------------------- REACTIONS -------------------------------------------------------------------
// reactions(response_type) path - super admin view
Route::get('reactions/index', 'ReactionController@index')->name('reactions.index');
Route::get('reactions/create', 'ReactionController@create')->name('reactions.create');
Route::post('reactions/store', 'ReactionController@store')->name('reactions.store');
Route::get('reactions/{reaction}/edit', 'ReactionController@edit')->name('reactions.edit');
Route::put('reactions/{reaction}', 'ReactionController@update')->name('reactions.update');
Route::delete('reactions/{reaction}', 'ReactionController@destroy')->name('reactions.destroy');
Route::get('reactions/responsetype', 'ReactionController@allresponsetype')->name('reactions.allresponsetype');

//------------------------------------------------------------------- TICSTATUSS -------------------------------------------------------------------
// ticstatuss path - super admin view
Route::get('ticstatuss/index', 'TicstatusController@index')->name('ticstatuss.index');
Route::get('ticstatuss/create', 'TicstatusController@create')->name('ticstatuss.create');
Route::post('ticstatuss/store', 'TicstatusController@store')->name('ticstatuss.store');
Route::get('ticstatuss/{ticstatus}/edit', 'TicstatusController@edit')->name('ticstatuss.edit');
Route::put('ticstatuss/{ticstatus}', 'TicstatusController@update')->name('ticstatuss.update');
Route::delete('ticstatuss/{ticstatus}', 'TicstatusController@destroy')->name('ticstatuss.destroy');
Route::get('ticstatuss/allticstatus', 'TicstatusController@allticstatus')->name('ticstatuss.allticstatus');

//------------------------------------------------------------------- ISSUES -------------------------------------------------------------------
// issues(request ticket & consumable) path - super admin view
Route::get('issues/index', 'IssueController@index')->name('issues.index');
// Route::get('issues/create', 'IssueController@create')->name('issues.create');
// Route::post('issues/store', 'IssueController@store')->name('issues.store');
// Route::get('issues/{issue}', 'IssueController@show')->name('issues.show');
// Route::get('issues/{issue}/edit', 'IssueController@edit')->name('issues.edit');
// Route::put('issues/{issue}', 'IssueController@update')->name('issues.update');
Route::delete('issues/{issue}', 'IssueController@destroy')->name('issues.destroy');


Route::get('issues/allissue', 'IssueController@allissue')->name('issues.allissue');
// Route::get('issues/{issue}', 'IssueController@allissuedetail')->name('issues.allissuedetail');
Route::get('issues/all/{issue}', 'IssueController@allissuedetail')->name('issues.allissuedetail');
Route::get('issues/allissuecreate', 'IssueController@allissuecreate')->name('issues.allissuecreate');
Route::post('issues/allissuestore', 'IssueController@allissuestore')->name('issues.allissuestore');
Route::get('/get-reportingperson/{siteId}', 'IssueController@getReportingpersonBySite');
Route::get('/get-equipment/{siteId}', 'IssueController@getEquipmentBySite');
Route::get('issues/{issue}/allresponse', 'IssueController@allresponse')->name('issues.allresponse');
Route::put('issues/{issue}/allresponseupdate', 'IssueController@allresponseupdate')->name('issues.allresponseupdate');

// Route::get('/issues/mark-as-read', [IssueController::class, 'markAsRead'])->name('mark-as-read');
Route::post('issues/markAsRead', 'IssueController@markAsRead')->name('issues.markAsRead');


// issues(request ticket & consumables) path - site admin view
Route::get('issues/listissue', 'IssueController@listissue')->name('issues.listissue');
// Route::get('issues/{issue}', 'IssueController@listissuedetail')->name('issues.listissuedetail');
Route::get('issues/list/{issue}', 'IssueController@listissuedetail')->name('issues.listissuedetail');
Route::get('issues/listissuecreate', 'IssueController@listissuecreate')->name('issues.listissuecreate');
Route::post('issues/listissuestore', 'IssueController@listissuestore')->name('issues.listissuestore');

// issues(request ticket & consumables) path - site user view
Route::get('issues/entireissue', 'IssueController@entireissue')->name('issues.entireissue');
// Route::get('issues/{issue}', 'IssueController@entireissuedetail')->name('issues.entireissuedetail');
Route::get('issues/entire/{issue}', 'IssueController@entireissuedetail')->name('issues.entireissuedetail');
Route::get('issues/entireissuecreate', 'IssueController@entireissuecreate')->name('issues.entireissuecreate');
Route::post('issues/entireissuestore', 'IssueController@entireissuestore')->name('issues.entireissuestore');

//------------------------------------------------------------------- TICKETS & LOGS -------------------------------------------------------------------
// tickets(ticket & consumable) path - super admin view
Route::get('tickets/index', 'TicketController@index')->name('tickets.index');

Route::get('tickets/allticket', 'TicketController@allticket')->name('tickets.allticket');
// Route::get('tickets/{ticket}/allticketedit', 'TicketController@allticketedit')->name('tickets.allticketedit');
// // Route::put('tickets/{ticket}', 'TicketController@allticketupdate')->name('tickets.allticketupdate');
// Route::put('tickets/{ticket}/allticketupdate', 'TicketController@allticketupdate')->name('tickets.allticketupdate');

Route::get('tickets/{ticket}/allticketedit', 'TicketController@allticketedit')->name('tickets.allticketedit');
Route::post('tickets/{ticket}/allticketupdate', 'TicketController@allticketupdate')->name('tickets.allticketupdate');

Route::get('tickets/allconsumable', 'TicketController@allconsumable')->name('tickets.allconsumable');
Route::get('tickets/{ticket}/allconsumableedit', 'TicketController@allconsumableedit')->name('tickets.allconsumableedit');
// Route::put('tickets/{ticket}', 'TicketController@allconsumableupdate')->name('tickets.allconsumableupdate');
Route::put('tickets/{ticket}/allconsumableupdate', 'TicketController@allconsumableupdate')->name('tickets.allconsumableupdate');


// tickets(ticket & consumable) path - site admin view
Route::get('tickets/listticket', 'TicketController@listticket')->name('tickets.listticket');
Route::get('tickets/{ticket}/listticketlog', 'TicketController@listticketlog')->name('tickets.listticketlog');

Route::get('tickets/listconsumable', 'TicketController@listconsumable')->name('tickets.listconsumable');
Route::get('tickets/{ticket}/listconsumablelog', 'TicketController@listconsumablelog')->name('tickets.listconsumablelog');


// tickets(ticket & consumable) path - site user view
Route::get('tickets/entireticket', 'TicketController@entireticket')->name('tickets.entireticket');
Route::get('tickets/{ticket}/entireticketlog', 'TicketController@entireticketlog')->name('tickets.entireticketlog');

Route::get('tickets/entireconsumable', 'TicketController@entireconsumable')->name('tickets.entireconsumable');
Route::get('tickets/{ticket}/entireconsumablelog', 'TicketController@entireconsumablelog')->name('tickets.entireconsumablelog');

//------------------------------------------------------------------- EQUIPMENTSTATUSS -------------------------------------------------------------------
// equipmentstatuss path - super admin view
Route::get('equipmentstatuss/index', 'EquipmentstatusController@index')->name('equipmentstatuss.index');
Route::get('equipmentstatuss/create', 'EquipmentstatusController@create')->name('equipmentstatuss.create');
Route::post('equipmentstatuss/store', 'EquipmentstatusController@store')->name('equipmentstatuss.store');
Route::get('equipmentstatuss/{equipmentstatus}/edit', 'EquipmentstatusController@edit')->name('equipmentstatuss.edit');
Route::put('equipmentstatuss/{equipmentstatus}', 'EquipmentstatusController@update')->name('equipmentstatuss.update');
Route::delete('equipmentstatuss/{equipmentstatus}', 'EquipmentstatusController@destroy')->name('equipmentstatuss.destroy');
Route::get('equipmentstatuss/allequipmentstatus', 'EquipmentstatusController@allequipmentstatus')->name('equipmentstatuss.allequipmentstatus');

//------------------------------------------------------------------- TICKET REPORTING -------------------------------------------------------------------
// tickets path - super admin view
Route::get('tickets/report/producereport', 'TicketController@producereport')->name('tickets.report.producereport');
Route::get('tickets/report/records', 'TicketController@records')->name('tickets.report.records');

// tickets path - site admin & site user view
Route::get('tickets/report/generatereport', 'TicketController@generatereport')->name('tickets.report.generatereport');

//------------------------------------------------------------------- XXXX -------------------------------------------------------------------


// Route::get('lang/home', [LangController::class, 'index']);
// Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

// Route::get('lang/home', 'LangController@index')->name('index');
// Route::get('lang/change', 'LangController@change')->name('changeLang');

// Route::get('lang/home', 'LangController@index');
// Route::get('lang/change', 'LangController@change')->name('changeLang');

// Route::get('/template', 'LangController@index');
// Route::get('/template', 'LangController@change')->name('changeLang');

// Route::get('/template', 'LangController@index')->name('template.index');
// Route::get('/lang/change', 'LangController@change')->name('changeLang');
// Route::get('/lang/change/{lang}', 'LangController@change')->name('changeLang');
// Route::get('/lang/change/{lang?}', 'LangController@change')->name('changeLang');


Route::post('/language-switch', 'LanguageController@switchLanguage')->name('language.switch');

//------------------------------------------------------------------- PAGE ERROR -------------------------------------------------------------------
Route::get('errors/pagenotfound', 'HomeController@pagenotfound')->name('errors.pagenotfound');

Route::fallback(function() {
    return view('errors.404');
});



});


