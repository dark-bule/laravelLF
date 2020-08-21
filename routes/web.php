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

Route::get('/', function () {return view('welcome');});


Route::get('/test', function () {

    return view('test',['name'=>'Bob']);
});
Route::get('/test1', function () {
    $datas = [1,2,3,4,5,6,7,8,9];
    return view('test1',['datas'=>$datas]);
});

Route::get('/test/{name}', function ($name) {
    $data = ['name'=>$name];
    return view('test',$data);
});

Route::get('/test/index', function () {return  123; });

Route::get('/hi/{name}', function ($name) {return   "Hi " .$name; });
Route::get('/bye/{name?}', function ($name = "Bob") {return   "Bye " .$name; });

//   Route::get($url,function (){} );
//   Route::get($url,"DemoController@index");


Route::get('/demo', 'DemoController@index');
Route::get('/demo/hi/{name}', 'DemoController@hi');  // 参数
Route::get('/demo/bye/{name?}', 'DemoController@bye'); // 
Route::get('/demo/welcome', 'DemoController@welcome');  //返回view
Route::get('/demo/test1', 'DemoController@test1');   


// 项目开始
Route::get('/demo/index', 'DemoController@index');   
Route::get('/demo/add', 'DemoController@add');   
Route::post('/demo/install', 'DemoController@install');   
Route::get('/demo/edit/{id}', 'DemoController@edit');   
Route::post('/demo/update/{id}', 'DemoController@update');
Route::post('/demo/inquire', 'DemoController@inquire');

Route::get('/demo/delete/{id}', 'DemoController@delete');   
// Route::get('/demo/add', 'DemoController@add');   
// Route::get('/demo/add', 'DemoController@add');   
