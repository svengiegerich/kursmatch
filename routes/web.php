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

Route::get('/', 'AuthController@handelInitAuthentication'); #root

//Applicant
Route::get('/applicant/{aid}', 'ApplicantController@show'); #welcome
Route::post('/applicant/{aid}', 'ApplicantController@add');
Route::get('/applicant/submitted/{aid}', 'ApplicantController@submitted'); #submitted page

//Preference
Route::post('/applicant/programs/{aID}', 'PreferenceController@addByApplicant');
Route::post('/applicant/preferences/delete/{aID}', 'PreferenceController@deleteByApplicantAjax');
Route::post('/applicant/preferences/reorder/{aID}', 'PreferenceController@reorderByApplicantAjax');
Route::get('/applicant/programs/{aid}', 'PreferenceController@showByApplicant');

//Exchange-login
Route::get('/login', 'AuthController@loginExchange');
Route::post('/activate', 'AuthController@activate');
Route::get('/login/{aid}', 'ApplicantController@show');

//Write files
Route::get('/7uvmvnm0yz', 'MatchingController@writeCsvFiles');
