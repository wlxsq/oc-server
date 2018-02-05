<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//api

//  Staff
Route::get('api/:version/staff/:id','api/:version.Staff/getStaffInfo',[],['id'=>'\d+']);
Route::post('api/:version/staff/add','api/:version.Staff/createStaffInfo');
Route::get('api/:version/staff/all','api/:version.Staff/getAllStaffInfo');

//  Student
Route::get('api/:version/student/:id','api/:version.Student/getStudentInfo',[],['id'=>'\d+']);
Route::post('api/:version/student/add','api/:version.Student/createStudentInfo');

//  Course
Route::post('api/:version/course/add/detail','api/:version.Course/createDetailCourseInfo',[],['id'=>'\d+']);
Route::post('api/:version/course/add','api/:version.Course/createCourseInfo');
Route::get('api/:version/course/all','api/:version.Course/getAllCourseInfo');
Route::get('api/:version/course/detail/:id','api/:version.Course/getDetailCourseInfo',[],['id'=>'\d+']);

//  News
Route::post('api/:version/news/add','api/:version.News/createNewsInfo');
Route::get('api/:version/news/all','api/:version.News/getAllNewsInfo');
Route::get('api/:version/news/detail/:id','api/:version.News/getDetailNewsInfoByID',[],['id'=>'\d+']);

// Token
Route::post('api/:version/token/user','api/:version.Token/getToken');

// Pay
Route::post('api/:version/Pay','api/:version.Pay/pay');


//  User

//  Class

//  Record





//  exam

//  Problem
Route::group('exam/:version/problem',function(){
	Route::post('/add','exam/:version.Problem/createNewProblem');
	Route::post('/addselection','exam/:version.Problem/addProblemSelection');
	Route::post('/addanswer','exam/:version.Problem/addSelectionAnswer');
	Route::post('/check','exam/:version.Problem/checkAnswer');
	Route::get('/delete/:id','exam/:version.Problem/deleteProblemByID');
	Route::get('/all','exam/:version.Problem/getAllProblem');
});