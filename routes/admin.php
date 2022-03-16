<?php

use Illuminate\Support\Facades\Route;



Route::get('/admin', ['as' => 'admin_login', 'uses' => 'Auth\LoginController@index']);
Route::post('admin/login', ['as' => 'adminlogin', 'uses' => 'Auth\LoginController@Check_login']);

Route::get('/forgot-password', ['as' => 'forgotPassword', 'uses' => 'Auth\ForgotPasswordController@forgot_password']);
Route::post('/save-forgot-password', ['as' => 'saveForgotPassword', 'uses' => 'Auth\ForgotPasswordController@save_forgot_password']);

Route::get('/resetPassword/{token}', ['as' => 'resetPassword', 'uses' => 'Auth\ResetPasswordController@resetPassword']);
Route::post('/saveResetPassword/{token}', ['as' => 'saveResetPassword', 'uses' => 'Auth\ResetPasswordController@saveResetPassword']);

Route::group(['prefix' => 'admin', 'middleware' => ['AdminMiddleware']], function () {
	Route::get('admin-logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
	Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Backend\Dashboard\DashboardController@index']);

	/*setting */
	Route::get('/general-setting', ['as' => 'generalSetting',  'uses' => 'Backend\Settings\GeneralSettingsController@index']);
	Route::post('/general-setting/save/{id}', ['as' => 'saveGeneralSetting', 'uses' => 'Backend\Settings\GeneralSettingsController@saveGeneralSetting']);

	/*  profile setting */
	Route::post('/changeProfileImage', ['as' => 'changeProfileImage', 'uses' => 'Backend\Profile\GeneralController@changeProfileImage']);
	Route::get('/profile', ['as' => 'generalProfile', 'uses' => 'Backend\Profile\GeneralController@index']);
	Route::post('/saveGeneral', ['as' => 'saveGeneralProfile', 'uses' => 'Backend\Profile\GeneralController@save']);
	Route::get('/accountSettingProfile', ['as' => 'accountSettingProfile', 'uses' => 'Backend\Profile\GeneralController@accountsetting']);
	Route::post('/saveAccountSettingProfile', ['as' => 'saveAccountSettingProfile', 'uses' => 'Backend\Profile\GeneralController@saveaccountsetting']);

	/* users */
	Route::get('/developer', ['as' => 'allUsers', 'uses' => 'Backend\Users\UsersController@index']);
	Route::get('/developer/add', ['as' => 'addUser', 'uses' => 'Backend\Users\UsersController@add']);
	Route::post('/developer/save', ['as' => 'saveUser', 'uses' => 'Backend\Users\UsersController@save']);
	Route::get('/developer/delete/{id}', ['as' => 'deleteUser', 'uses' => 'Backend\Users\UsersController@delete']);
	Route::post('/developer/developer-status', ['as' => 'user_status', 'uses' => 'Backend\Users\UsersController@status']);

	Route::group(['prefix' => 'client'], function () {
		Route::get('/all', ['as' => 'allClients', 'uses' => 'Backend\Client\ClientController@index']);
		Route::get('/add', ['as' => 'addClient', 'uses' => 'Backend\Client\ClientController@add']);
		Route::post('/save', ['as' => 'saveClient', 'uses' => 'Backend\Client\ClientController@save']);
		Route::get('/edit/{id}', ['as' => 'editClient', 'uses' => 'Backend\Client\ClientController@edit']);
		Route::post('/update', ['as' => 'updateClient', 'uses' => 'Backend\Client\ClientController@update']);
		Route::get('/delete/{id}', ['as' => 'deleteClient', 'uses' => 'Backend\Client\ClientController@delete']);
	});
	/* Project */
	Route::group(['prefix' => 'project'], function () {
		Route::get('/project', ['as' => 'allProject', 'uses' => 'Backend\Project\ProjectController@index']);
		Route::get('/project/add', ['as' => 'addProject', 'uses' => 'Backend\Project\ProjectController@add']);
		Route::post('/project/save', ['as' => 'saveProject', 'uses' => 'Backend\Project\ProjectController@save']);
		Route::get('/project/edit/{id}', ['as' => 'editProject', 'uses' => 'Backend\Project\ProjectController@edit']);
		Route::post('/project/update', ['as' => 'updateProject', 'uses' => 'Backend\Project\ProjectController@update']);
		Route::get('/project/delete/{id}', ['as' => 'deleteProject', 'uses' => 'Backend\Project\ProjectController@delete']);

		/* Task */
		Route::get('/task/{project_id}', ['as' => 'allTask', 'uses' => 'Backend\Project\TaskController@index']);
		Route::get('/task/add/{project_id}', ['as' => 'addTask', 'uses' => 'Backend\Project\TaskController@add']);
		Route::post('/task/save', ['as' => 'saveTask', 'uses' => 'Backend\Project\TaskController@save']);
		Route::get('/task/edit/{id}', ['as' => 'editTask', 'uses' => 'Backend\Project\TaskController@edit']);
		Route::post('/task/update', ['as' => 'updateTask', 'uses' => 'Backend\Project\TaskController@update']);
		Route::post('/task/status', ['as' => 'task_status', 'uses' => 'Backend\Project\TaskController@status']);
		Route::get('/task/delete/{id}', ['as' => 'deleteTask', 'uses' => 'Backend\Project\TaskController@delete']);
	});
});
