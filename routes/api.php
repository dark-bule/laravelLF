<?php
// require('./vendor/autoload.php');
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use App\Http\Middleware\CheckAdmin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country','Country\CountryController@country');

// var_dump("yes");
Route::get('/demo/index', 'Country\CountryController@index');   
Route::post('/demo/add', 'Country\CountryController@add');   
// Route::post('/demo/install', 'DemoController@install');   
Route::get('/demo/edit/{id}', 'DemoController@edit');   
Route::put('/demo/update/{index}', 'Country\CountryController@update');
Route::post('/demo/inquire', 'DemoController@inquire');

Route::delete('/demo/delete/{id}', 'Country\CountryController@delete');   
Route::get('/demo/inquire/{id}', 'Country\CountryController@inquireByID');   


//失物招领
Route::post('lf/increasedata/{method}','Api\LostFoundController@increaseData');//添加数据

Route::post('lf/deletedata/{id}/{method}','Api\LostFoundController@deleteData')->middleware('admin');//删除数据

Route::post('lf/updatedata/{method}', 'Api\LostFoundController@updateData')->middleware('admin');//修改数据         

Route::post('lf/searchdata/{method}','Api\LostFoundController@searchData');//查找数据

Route::get('lf/getdata/{method}/','Api\LostFoundController@getData');//获取数据

Route::post('lf/login', 'Api\LostFoundController@login');//登录

Route::post('lf/loginadmin', 'Api\LostFoundController@loginadmin')->middleware('isadmin');//管理员登录 ->middleware('isadmin')

Route::post('lf/register', 'Api\LostFoundController@register');//注册
Route::post('lf/registeradmin', 'Api\LostFoundController@registeradmin');//管理员注册

Route::post('lf/updatestatus/{method}','Api\LostFoundController@updateStatus');//修改物品状态码