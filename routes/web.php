<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivesearchController; //add LivesearchController

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
    return view('auth.userlogin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// logout
Route::get('/logout', 'HomeController@destroy')->name('logout');

// reset password page not found
Route::get('auth/passwords/reset', 'Auth\ResetPasswordController@showResetForm')->name('auth.passwords.reset');
Route::post('auth/passwords/reset', 'Auth\ResetPasswordController@resetPassword')->name('password.update');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// super admin's dashboard
Route::get('/dashboard/mydashboard', 'HomeController@mydashboard')->name('dashboard.mydashboard');

// site admin's dashboard
Route::get('/dashboard/dashboardadmin', 'HomeController@dashboardadmin')->name('dashboard.dashboardadmin');

// site user's dashboard
Route::get('/dashboard/dashboarduser', 'HomeController@dashboarduser')->name('dashboard.dashboarduser');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// super admin's extension
Route::get('/myextension', 'HomeController@myextension')->name('myextension');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// users path - super admin view
Route::get('users/index', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users/store', 'UserController@store')->name('users.store');
//Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
Route::get('users/alluser', 'UserController@alluser')->name('users.alluser');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// roles path - super admin view
Route::get('roles/index', 'RoleController@index')->name('roles.index');
Route::get('roles/create', 'RoleController@create')->name('roles.create');
Route::post('roles/store', 'RoleController@store')->name('roles.store');
//Route::get('roles/{role}', 'RoleController@show')->name('roles.show');
Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
Route::put('roles/{role}', 'RoleController@update')->name('roles.update');
Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy');
Route::get('roles/allrole', 'RoleController@allrole')->name('roles.allrole');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// sites path - super admin view
Route::get('sites/index', 'SiteController@index')->name('sites.index');
Route::get('sites/create', 'SiteController@create')->name('sites.create');
Route::post('sites/store', 'SiteController@store')->name('sites.store');
//Route::get('sites/{site}', 'SiteController@show')->name('sites.show');
Route::get('sites/{site}/edit', 'SiteController@edit')->name('sites.edit');
Route::put('sites/{site}', 'SiteController@update')->name('sites.update');
Route::delete('sites/{site}', 'SiteController@destroy')->name('sites.destroy');
Route::get('sites/allsite', 'SiteController@allsite')->name('sites.allsite');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// kbcategorys path - super admin view
Route::get('kbcategorys/index', 'KbcategoryController@index')->name('kbcategorys.index');
Route::get('kbcategorys/create', 'KbcategoryController@create')->name('kbcategorys.create');
Route::post('kbcategorys/store', 'KbcategoryController@store')->name('kbcategorys.store');
//Route::get('kbcategorys/{kbcategory}', 'KbcategoryController@show')->name('kbcategorys.show');
Route::get('kbcategorys/{kbcategory}/edit', 'KbcategoryController@edit')->name('kbcategorys.edit');
Route::put('kbcategorys/{kbcategory}', 'KbcategoryController@update')->name('kbcategorys.update');
Route::delete('kbcategorys/{kbcategory}', 'KbcategoryController@destroy')->name('kbcategorys.destroy');
Route::get('kbcategorys/allkbcategory', 'KbcategoryController@allkbcategory')->name('kbcategorys.allkbcategory');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// knowledgebases path - super admin view
Route::get('knowledgebases/index', 'KnowledgebaseController@index')->name('knowledgebases.index');
Route::get('knowledgebases/create', 'KnowledgebaseController@create')->name('knowledgebases.create');
Route::post('knowledgebases/store', 'KnowledgebaseController@store')->name('knowledgebases.store');
//Route::get('knowledgebases/{knowledgebase}', 'KnowledgebaseController@show')->name('knowledgebases.show');
Route::get('knowledgebases/{knowledgebase}/edit', 'KnowledgebaseController@edit')->name('knowledgebases.edit');
Route::put('knowledgebases/{knowledgebase}', 'KnowledgebaseController@update')->name('knowledgebases.update');
Route::delete('knowledgebases/{knowledgebase}', 'KnowledgebaseController@destroy')->name('knowledgebases.destroy');
Route::get('knowledgebases/allknowledgebase', 'KnowledgebaseController@allknowledgebase')->name('knowledgebases.allknowledgebase');

// knowledgebases path - site admin view
Route::get('knowledgebases/kbadmin', 'KnowledgebaseController@kbadmin')->name('knowledgebases.kbadmin');
Route::get('knowledgebases/kbadmincreate', 'KnowledgebaseController@kbadmincreate')->name('knowledgebases.kbadmincreate');
Route::post('knowledgebases/kbadminstore', 'KnowledgebaseController@kbadminstore')->name('knowledgebases.kbadminstore');
Route::get('knowledgebases/{knowledgebase}/kbadminedit', 'KnowledgebaseController@kbadminedit')->name('knowledgebases.kbadminedit');
Route::put('knowledgebases/{knowledgebase}', 'KnowledgebaseController@kbadminupdate')->name('knowledgebases.kbadminupdate');

// knowledgebases path - site user view
Route::get('knowledgebases/entireknowledgebase', 'KnowledgebaseController@entireknowledgebase')->name('knowledgebases.entireknowledgebase');
Route::get('knowledgebases/entireknowledgebasecreate', 'KnowledgebaseController@entireknowledgebasecreate')->name('knowledgebases.entireknowledgebasecreate');
Route::post('knowledgebases/entireknowledgebasestore', 'KnowledgebaseController@entireknowledgebasestore')->name('knowledgebases.entireknowledgebasestore');
Route::get('knowledgebases/{knowledgebase}/entireknowledgebaseedit', 'KnowledgebaseController@entireknowledgebaseedit')->name('knowledgebases.entireknowledgebaseedit');
Route::put('knowledgebases/{knowledgebase}', 'KnowledgebaseController@entireknowledgebaseupdate')->name('knowledgebases.entireknowledgebaseupdate');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// equipments path - super admin view
Route::get('equipments/index', 'EquipmentController@index')->name('equipments.index');
Route::get('equipments/create', 'EquipmentController@create')->name('equipments.create');
Route::post('equipments/store', 'EquipmentController@store')->name('equipments.store');
//Route::get('equipments/{equipment}', 'EquipmentController@show')->name('equipments.show');
Route::get('equipments/{equipment}/edit', 'EquipmentController@edit')->name('equipments.edit');
Route::put('equipments/{equipment}', 'EquipmentController@update')->name('equipments.update');
Route::delete('equipments/{equipment}', 'EquipmentController@destroy')->name('equipments.destroy');
Route::get('equipments/allasset', 'EquipmentController@allasset')->name('equipments.allasset');

// equipments path - site admin view
Route::get('equipments/assetadmin', 'EquipmentController@assetadmin')->name('equipments.assetadmin');

// equipments path - site user view
Route::get('equipments/entireasset', 'EquipmentController@entireasset')->name('equipments.entireasset');
Route::get('equipments/{equipment}/entireassetlog', 'EquipmentController@entireassetlog')->name('equipments.entireassetlog');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// reportingpersons path - super admin view
Route::get('reportingpersons/index', 'ReportingpersonController@index')->name('reportingpersons.index');
Route::get('reportingpersons/create', 'ReportingpersonController@create')->name('reportingpersons.create');
Route::post('reportingpersons/store', 'ReportingpersonController@store')->name('reportingpersons.store');
//Route::get('reportingpersons/{reportingperson}', 'ReportingpersonController@show')->name('reportingpersons.show');
Route::get('reportingpersons/{reportingperson}/edit', 'ReportingpersonController@edit')->name('reportingpersons.edit');
Route::put('reportingpersons/{reportingperson}', 'ReportingpersonController@update')->name('reportingpersons.update');
Route::delete('reportingpersons/{reportingperson}', 'ReportingpersonController@destroy')->name('reportingpersons.destroy');
Route::get('reportingpersons/allreportingperson', 'ReportingpersonController@allreportingperson')->name('reportingpersons.allreportingperson');

// reportingpersons path - site admin view
Route::get('reportingpersons/rpadmin', 'ReportingpersonController@rpadmin')->name('reportingpersons.rpadmin');
Route::get('reportingpersons/rpadmincreate', 'ReportingpersonController@rpadmincreate')->name('reportingpersons.rpadmincreate');
Route::post('reportingpersons/rpadminstore', 'ReportingpersonController@rpadminstore')->name('reportingpersons.rpadminstore');
Route::get('reportingpersons/{reportingperson}/rpadminedit', 'ReportingpersonController@rpadminedit')->name('reportingpersons.rpadminedit');
Route::put('reportingpersons/{reportingperson}', 'ReportingpersonController@rpadminupdate')->name('reportingpersons.rpadminupdate');
Route::delete('reportingpersons/{reportingperson}', 'ReportingpersonController@rpadmindestroy')->name('reportingpersons.rpadmindestroy');

// reportingpersons path - site user view
Route::get('reportingpersons/entirereportingperson', 'ReportingpersonController@entirereportingperson')->name('reportingpersons.entirereportingperson');
Route::get('reportingpersons/entirereportingpersoncreate', 'ReportingpersonController@entirereportingpersoncreate')->name('reportingpersons.entirereportingpersoncreate');
Route::post('reportingpersons/entirereportingpersonstore', 'ReportingpersonController@entirereportingpersonstore')->name('reportingpersons.entirereportingpersonstore');
Route::get('reportingpersons/{reportingperson}/entirereportingpersonedit', 'ReportingpersonController@entirereportingpersonedit')->name('reportingpersons.entirereportingpersonedit');
Route::put('reportingpersons/{reportingperson}', 'ReportingpersonController@entirereportingpersonupdate')->name('reportingpersons.entirereportingpersonupdate');
Route::delete('reportingpersons/{reportingperson}', 'ReportingpersonController@entirereportingpersondestroy')->name('reportingpersons.entirereportingpersondestroy');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// types(request_type) path - super admin view
Route::get('types/index', 'TypeController@index')->name('types.index');
Route::get('types/create', 'TypeController@create')->name('types.create');
Route::post('types/store', 'TypeController@store')->name('types.store');
//Route::get('types/{type}', 'TypeController@show')->name('types.show');
Route::get('types/{type}/edit', 'TypeController@edit')->name('types.edit');
Route::put('types/{type}', 'TypeController@update')->name('types.update');
Route::delete('types/{type}', 'TypeController@destroy')->name('types.destroy');
Route::get('types/requesttype', 'TypeController@allrequesttype')->name('types.allrequesttype');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// reqcategorys path - super admin view
Route::get('reqcategorys/index', 'ReqcategoryController@index')->name('reqcategorys.index');
Route::get('reqcategorys/create', 'ReqcategoryController@create')->name('reqcategorys.create');
Route::post('reqcategorys/store', 'ReqcategoryController@store')->name('reqcategorys.store');
//Route::get('reqcategorys/{reqcategory}', 'ReqcategoryController@show')->name('reqcategorys.show');
Route::get('reqcategorys/{reqcategory}/edit', 'ReqcategoryController@edit')->name('reqcategorys.edit');
Route::put('reqcategorys/{reqcategory}', 'ReqcategoryController@update')->name('reqcategorys.update');
Route::delete('reqcategorys/{reqcategory}', 'ReqcategoryController@destroy')->name('reqcategorys.destroy');
Route::get('reqcategorys/allreqcategory', 'ReqcategoryController@allreqcategory')->name('reqcategorys.allreqcategory');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// severitys path - super admin view
Route::get('severitys/index', 'SeverityController@index')->name('severitys.index');
Route::get('severitys/create', 'SeverityController@create')->name('severitys.create');
Route::post('severitys/store', 'SeverityController@store')->name('severitys.store');
//Route::get('severitys/{severity}', 'SeverityController@show')->name('severitys.show');
Route::get('severitys/{severity}/edit', 'SeverityController@edit')->name('severitys.edit');
Route::put('severitys/{severity}', 'SeverityController@update')->name('severitys.update');
Route::delete('severitys/{severity}', 'SeverityController@destroy')->name('severitys.destroy');
Route::get('severitys/allseverity', 'SeverityController@allseverity')->name('severitys.allseverity');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// statuss path - super admin view
Route::get('statuss/index', 'StatusController@index')->name('statuss.index');
Route::get('statuss/create', 'StatusController@create')->name('statuss.create');
Route::post('statuss/store', 'StatusController@store')->name('statuss.store');
//Route::get('statuss/{status}', 'StatusController@show')->name('statuss.show');
Route::get('statuss/{status}/edit', 'StatusController@edit')->name('statuss.edit');
Route::put('statuss/{status}', 'StatusController@update')->name('statuss.update');
Route::delete('statuss/{status}', 'StatusController@destroy')->name('statuss.destroy');
Route::get('statuss/allstatus', 'StatusController@allstatus')->name('statuss.allstatus');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// reactions(response_type) path - super admin view
Route::get('reactions/index', 'ReactionController@index')->name('reactions.index');
Route::get('reactions/create', 'ReactionController@create')->name('reactions.create');
Route::post('reactions/store', 'ReactionController@store')->name('reactions.store');
//Route::get('reactions/{reaction}', 'ReactionController@show')->name('reactions.show');
Route::get('reactions/{reaction}/edit', 'ReactionController@edit')->name('reactions.edit');
Route::put('reactions/{reaction}', 'ReactionController@update')->name('reactions.update');
Route::delete('reactions/{reaction}', 'ReactionController@destroy')->name('reactions.destroy');
Route::get('reactions/responsetype', 'ReactionController@allresponsetype')->name('reactions.allresponsetype');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// ticstatuss path - super admin view
Route::get('ticstatuss/index', 'TicstatusController@index')->name('ticstatuss.index');
Route::get('ticstatuss/create', 'TicstatusController@create')->name('ticstatuss.create');
Route::post('ticstatuss/store', 'TicstatusController@store')->name('ticstatuss.store');
//Route::get('ticstatuss/{ticstatus}', 'TicstatusController@show')->name('ticstatuss.show');
Route::get('ticstatuss/{ticstatus}/edit', 'TicstatusController@edit')->name('ticstatuss.edit');
Route::put('ticstatuss/{ticstatus}', 'TicstatusController@update')->name('ticstatuss.update');
Route::delete('ticstatuss/{ticstatus}', 'TicstatusController@destroy')->name('ticstatuss.destroy');
Route::get('ticstatuss/allticstatus', 'TicstatusController@allticstatus')->name('ticstatuss.allticstatus');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// issues(request ticket & consumable) path - super admin view
Route::get('issues/index', 'IssueController@index')->name('issues.index');
Route::get('issues/create', 'IssueController@create')->name('issues.create');
Route::post('issues/store', 'IssueController@store')->name('issues.store');
// Route::get('issues/{issue}', 'IssueController@show')->name('issues.show');
Route::get('issues/{issue}/edit', 'IssueController@edit')->name('issues.edit');
Route::put('issues/{issue}', 'IssueController@update')->name('issues.update');
Route::delete('issues/{issue}', 'IssueController@destroy')->name('issues.destroy');
Route::get('issues/allissue', 'IssueController@allissue')->name('issues.allissue');

// issues(request ticket & consumables) path - site admin view
Route::get('issues/listissue', 'IssueController@listissue')->name('issues.listissue');
Route::get('issues/listissuecreate', 'IssueController@listissuecreate')->name('issues.listissuecreate');
Route::post('issues/listissuestore', 'IssueController@listissuestore')->name('issues.listissuestore');

// issues(request ticket & consumables) path - site user view
Route::get('issues/entireissue', 'IssueController@entireissue')->name('issues.entireissue');
Route::get('issues/entireissuecreate', 'IssueController@entireissuecreate')->name('issues.entireissuecreate');
Route::post('issues/entireissuestore', 'IssueController@entireissuestore')->name('issues.entireissuestore');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------
// tickets(ticket & consumable) path - super admin view
Route::get('tickets/index', 'TicketController@index')->name('tickets.index');

Route::get('tickets/allticket', 'TicketController@allticket')->name('tickets.allticket');
Route::get('tickets/{ticket}/allticketedit', 'TicketController@allticketedit')->name('tickets.allticketedit');
Route::put('tickets/{ticket}', 'TicketController@allticketupdate')->name('tickets.allticketupdate');

Route::get('tickets/allconsumable', 'TicketController@allconsumable')->name('tickets.allconsumable');
Route::get('tickets/{ticket}/allconsumableedit', 'TicketController@allconsumableedit')->name('tickets.allconsumableedit');
Route::put('tickets/{ticket}', 'TicketController@allconsumableupdate')->name('tickets.allconsumableupdate');


// tickets(ticket & consumable) path - site admin view
Route::get('tickets/listticket', 'TicketController@listticket')->name('tickets.listticket');
Route::get('tickets/{ticket}/listticketlog', 'TicketController@listticketlog')->name('tickets.listticketlog');

Route::get('tickets/listconsumable', 'TicketController@listconsumable')->name('tickets.listconsumable');
Route::get('tickets/{ticket}/listconsumablelog', 'TicketController@listconsumablelog')->name('tickets.listconsumablelog');
// Route::get('tickets/{ticket}/listconsumableedit', 'TicketController@listconsumableedit')->name('tickets.listconsumableedit');
// Route::put('tickets/{ticket}', 'TicketController@listconsumableupdate')->name('tickets.listconsumableupdate');


// tickets(ticket & consumable) path - site user view
Route::get('tickets/entireticket', 'TicketController@entireticket')->name('tickets.entireticket');
Route::get('tickets/{ticket}/entireticketlog', 'TicketController@entireticketlog')->name('tickets.entireticketlog');

Route::get('tickets/entireconsumable', 'TicketController@entireconsumable')->name('tickets.entireconsumable');
Route::get('tickets/{ticket}/entireconsumablelog', 'TicketController@entireconsumablelog')->name('tickets.entireconsumablelog');

//-------------------------------------------------------------------------------------------------------------------------------------------------------------



Route::get('/chat', 'HomeController@chat')->name('chat');