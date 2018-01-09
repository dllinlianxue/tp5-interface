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
//设计规范的写法
Route::get('persons$','api/Persons/index');

Route::get('persons/:id','api/Persons/read');

Route::post('persons','api/Persons/save');

//Route::post('persons','api/Common/checkSignAuth');

Route::put('persons/:id','api/Persons/update');

Route::delete('persons/:id','api/Persons/delete');

Route::get('Test','api/Test/aes');
Route::get('time','api/Time/time');

Route::get('v1/cat','api/v1.cat/index');

//Route::get('v1/home','api/v1.home/index');

Route::get('v1/home','api/v1.home/header');

Route::get('v1/news$','api/v1.news/index');
//此id = cat_id

Route::get('v1/rank','api/v1.news/rank');

Route::get('v1/init','api/v1.home/init');

Route::get('v1/news/:id','api/v1.news/read');
//:id 是动态路由 不能用请求参数的方式获取

Route::get('v1/sources','api/v1.news/index');

//Route::get/post/put/delete(rule'请求路由' route'文件名/控制器/方法')
Route::post('v1/signname','api/v1.signname/save');

Route::post('v1/loginbase','api/v1.loginbase/islogin');

//这种是tp5里可以顶七种请求路径
//Route::resource('persons','api/Persons');





