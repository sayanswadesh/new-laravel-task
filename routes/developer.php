<?php

use Illuminate\Support\Facades\Route;



Route::get('/developer', ['as' => 'developer_login', 'uses' => 'Developer\Login\LoginController@index']);
Route::post('developer/login', ['as' => 'developerlogin', 'uses' => 'Developer\Login\LoginController@Check_login']);

Route::get('/forgot-password', ['as' => 'forgotPassword', 'uses' => 'Developer\Login\ForgotPasswordController@forgot_password']);
Route::post('/save-forgot-password', ['as' => 'saveForgotPassword', 'uses' => 'Developer\Login\ForgotPasswordController@save_forgot_password']);

Route::get('/resetPassword/{token}', ['as' => 'resetPassword', 'uses' => 'Developer\Login\ResetPasswordController@resetPassword']);
Route::post('/saveResetPassword/{token}', ['as' => 'saveResetPassword', 'uses' => 'Developer\Login\ResetPasswordController@saveResetPassword']);

Route::group(['prefix' => 'developer', 'middleware' => ['DeveloperMiddleware']], function () {
	Route::get('developer-logout', ['as' => 'dev_logout', 'uses' => 'Developer\Login\LoginController@logout']);
	Route::get('/dashboard', ['as' => 'dev_dashboard', 'uses' => 'Developer\Dashboard\DashboardController@index']);

	/*  profile setting */
	Route::post('/changeProfileImage', ['as' => 'changeDevProfileImage', 'uses' => 'Developer\Profile\GeneralController@changeProfileImage']);
	Route::get('/profile', ['as' => 'generalDevProfile', 'uses' => 'Developer\Profile\GeneralController@index']);
	Route::post('/saveGeneral', ['as' => 'saveDevGeneralProfile', 'uses' => 'Developer\Profile\GeneralController@save']);
	Route::get('/accountSettingProfile', ['as' => 'accountDevSettingProfile', 'uses' => 'Developer\Profile\GeneralController@accountsetting']);
	Route::post('/saveAccountSettingProfile', ['as' => 'saveDevAccountSettingProfile', 'uses' => 'Developer\Profile\GeneralController@saveaccountsetting']);

	/* Project */
	Route::group(['prefix' => 'project'], function () {
		Route::get('/project', ['as' => 'allDevProject', 'uses' => 'Developer\Project\ProjectController@index']);
		/* Task */
		Route::get('/task/{project_id}', ['as' => 'allDevTask', 'uses' => 'Developer\Project\TaskController@index']);
		Route::post('/task/status', ['as' => 'task_dev_status', 'uses' => 'Developer\Project\TaskController@status']);
	});

	Route::get('/task/all', ['as' => 'allDevTaskTable', 'uses' => 'Developer\Project\TaskController@all_task']);
});
