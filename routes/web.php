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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'hello';
});

Route::get('/aa','IndexController@test');

Route::view('/bb','hello',['name'=>'张三']);

// Route::view('/login','login');
// Route::get('/login','IndexController@login');
// Route::match(['get','post'],'/login','IndexController@login');
//Route::any('/login','IndexController@login');

//Route::post('/dologin','IndexController@dologin');

//Route::get('/goods/{id}','IndexController@goods')->where('id','\d+');
Route::get('/goods/{id}/{name?}','IndexController@getgoods')->where('id','\d+');

Route::prefix('brand')->middleware('checklogin')->group(function(){
    Route::get('create','Brand@create');
    Route::post('store','Brand@store');
    Route::get('/','Brand@index');
    Route::get('edit/{id}','Brand@edit');
    Route::post('update/{id}','Brand@update');
//    Route::post('destroy/{id}','Brand@destroy');
//    Route::get('destroy/{id}','Brand@destroy');
    Route::get('checkOnly','Brand@checkOnly');
    Route::any('destroy/{id}','Brand@destroy');

});

Route::prefix('students')->group(function(){
    Route::get('/','Students@index');
    Route::get('create','Students@create');
    Route::post('store','Students@store');
    Route::get('destroy/{id}','Students@destroy');
    Route::get('edit/{id}','Students@edit');
    Route::post('update/{id}','Students@update');
});

Route::prefix('yuangong')->group(function(){
   Route::get('/','Yuangong@index');
   Route::get('create','Yuangong@create');
   Route::post('store','Yuangong@store');
    Route::get('destroy/{id}','Yuangong@destroy');
});

Route::prefix('book')->group(function(){
   Route::get('/','Book@index');
   Route::get('create','Book@create');
   Route::post('store','Book@store');
});

Route::prefix('cate')->group(function(){
    Route::get('create','CategoryController@create');
    Route::post('store','CategoryController@store');
    Route::get('/','CategoryController@index');
    Route::get('edit/{id}','CategoryController@edit');
    Route::post('update/{id}','CategoryController@update');
    Route::get('destroy/{id}','CategoryController@destroy');
});

Route::prefix('shop')->group(function(){
    Route::get('create','Shop@create');
    Route::get('create1','Shop@create');
    Route::post('store','Shop@store');
    Route::get('/','Shop@index');
    Route::get('edit/{id}','Shop@edit');
    Route::post('update/{id}','Shop@update');
    Route::get('destroy/{id}','Shop@destroy');
    Route::get('show/{id}','Shop@show');
    Route::post('addcart','Shop@addcart');
});

Route::prefix('news')->group(function(){
    Route::get('create','News@create');
    Route::post('store','News@store');
    Route::get('/','News@index');
});

Route::prefix('login')->group(function(){
    Route::any('/','login@index');
    Route::post('do','login@do');
    Route::post('logout','login@logout');
});

Route::prefix('article')->group(function(){
    Route::get('create','Article@create');
    Route::post('store','Article@store');
    Route::get('/','Article@index');
    Route::get('edit/{id}','Article@edit');
    Route::post('update/{id}','Article@update');
    Route::get('destroy/{id}','Article@destroy');
});

Route::prefix('shops')->group(function(){
    Route::get('create','Shops@create');
    Route::post('store','Shops@store');
    Route::get('/','Shops@index');
    Route::get('edit/{id}','Shops@edit');
    Route::post('update/{id}','Shops@update');
    Route::get('destroy/{id}','Shops@destroy');
});

Route::prefix('district')->group(function(){
    Route::get('create','District@create');
    Route::post('store','District@store');
    Route::get('/','District@index');
    Route::get('destroy/{id}','District@destroy');
    Route::get('xiangqing/{id}','District@xiangqing');
});

//将cookie添加到响应上
Route::get('/set',function(){
    return response('hello')->cookie('name','张三',2);
});

Route::get('/get',function(){
    return request()->cookie('name');
});
//第二种添加cookie
Route::get('/set2',function(){
    Illuminate\Support\Facades\Cookie::queue('name','lisi',1);
    echo request()->cookie('name');
});

//发送验证码
Route::get('send','Book@sendemail');

Route::prefix('logins')->group(function(){
    Route::any('/','logins@index');
    Route::post('do','logins@do');
    Route::post('logout','logins@logout');
});

Route::prefix('message')->middleware('checklogin')->group(function(){
    Route::get('create','MessageController@create');
    Route::post('store','MessageController@store');
    Route::get('/','MessageController@index');
    Route::get('edit/{id}','MessageController@edit');
    Route::post('update/{id}','MessageController@update');
    Route::get('checkOnly','MessageController@checkOnly');
    Route::any('destroy/{id}','MessageController@destroy');
    Route::get('info/{id}','MessageController@info');
});