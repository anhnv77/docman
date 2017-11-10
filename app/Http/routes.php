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

Route::get('/', 'HandleAllCaller@goHome');

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/logout', 'HandleAllCaller@logout');

Route::get('/hdsd', function(){
    return view('hdsd');
});

Route::post('submitAddInfo', 'HandleAllCaller@submitAddInfo');

Route::post('/login', 'HandleAllCaller@submitLoginForm');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => ['admin']], function () {
    // Department Management
//    Route::get('departments', 'DepartmentController@index');
//    Route::get('departments/create', 'DepartmentController@create');
//    Route::get('departments/edit/{id?}', 'DepartmentController@edit');
//
//    Route::post('departments/startAddDepartment', 'DepartmentController@store');
//    Route::post('departments/edit/startEditDepartment', 'DepartmentController@update');
    
    // Dashboard
    Route::get('dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'DocumentsController@dashboard'
    ]);

    // User Management

    Route::get('users/{key?}', 'UserController@handleAll');
    Route::post('users/getUsersList', 'UserController@getUserList');
    Route::post('users/deleteUser', 'UserController@deleteUser');
    Route::post('users/changeRoleUser', 'UserController@changeRoleUser');
    Route::post('users/startAddUser', 'UserController@startAddUser');

    // TypeDocument management
//    Route::get('typedocuments', 'TypeDocumentController@index');
//    Route::post('typedocuments/getInfoEdit', 'TypeDocumentController@getInfoEdit');
//    Route::post('typedocuments/submitInfoEdit', 'TypeDocumentController@submitInfoEdit');
//    Route::post('typedocuments/deleteType', 'TypeDocumentController@deleteType');
//
//    Route::get('typedocuments/create', 'TypeDocumentController@create');
//    Route::post('typedocuments/submitAddType', 'TypeDocumentController@submitAddType');

    // Log
    Route::get('logs', 'LogController@index');
    Route::post('logs/getDataForLogPage', 'LogController@getDataForLogPage');
    Route::post('logs/deleteLogFromTo', 'LogController@deleteLogFromTo');
    Route::post('logs/deleteAllLog', 'LogController@deleteAllLog');
});

Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'roles'], 'roles' => ['manager']], function () {
    // Department Management

    // 1. users
//    Route::get('users', 'ManagerController@users');
    
    // 2. documents
    Route::get('documents', 'ManagerController@documents');

});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin', 'user', 'manager'] ], function () {

    // Document:

    Route::get('document/{key?}', 'DocumentsController@handleAll');

    Route::get('document/edit/{id?}', 'DocumentsController@edit');
    
    Route::post('document/getDocumentList', 'DocumentsController@getDocumentList');

    Route::post('document/getInfoDocumentForModal', 'DocumentsController@getInfoDocumentForModal');

    Route::post('document/deleteDocumentWithID', 'DocumentsController@deleteDocumentWithID');

    Route::post('document/deleteManyDocuments', 'DocumentsController@deleteManyDocuments');

    Route::post('document/startUploadDocument', 'DocumentsController@store');

    Route::post('document/editDocumentWithID', 'DocumentsController@update');

    // My document:

//    Route::get('mydocuments', 'DocumentsController@mydocuments');
//    Route::post('mydocuments/getDocumentList', 'DocumentsController@getMyDocumentList');

    // Profile:

    Route::get('users/profile', 'UserController@showProfile');
    Route::post('users/profile/submitProfile', 'UserController@editProfile');
    Route::post('users/profile/submitPassword', 'UserController@editPassword');
});