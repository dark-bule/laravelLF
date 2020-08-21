<?php

namespace App\Http\Controllers\Api;

use App\Models\FoundModel;
use App\Models\LostModel;

use Intervention\Image\Facades\Image;
use App\Libs\UploadUtils;

use Alert;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LostFoundController extends Controller
{
    private $tablelost = 'lf_lost';
    private $tablefound = 'lf_found';
    private $tableimage = 'lf_img';
    private $tableadmin = 'lf_admin';

    //添加
    public function increaseData(Request $Request, $method)
    {
        $thingName = $Request->input('thingName');
        $time = $Request->input('time');
        $place = $Request->input('place');
        $detail = $Request->input('detail');
        $personName = $Request->input('personName');
        $phoneNumber = $Request->input('phoneNumber');
        $status = 1;
        if ($place == null) {
            return response()->json([
                'status' => 'warning',
                'msg' => '请完善信息'
            ], 412);
        }
        $pattern = "/^1[34578]\d{9}$/";
        $res = preg_match($pattern, $phoneNumber);
        if ($res) {//y !$res
            return response()->json([
                'status' => 'warning',
                'msg' => '请输入正确手机号码'
            ], 412);
        }
        if ($Request->input('picture')) {//存在图片
            $file = $Request->input('picture');
        $path = UploadUtils::getUploadPath();//获取保存的文件路径 
        Image::make($file)->resize(200, 200)->insert('images/watermark.png', 'bottom-right', 15, 10)->save($path);//保存 env('THUMB_WIDTH'), env('THUMB_HEIGHT')   
        }
        if ($method == 1) {
            $insertResult = LostModel::insert(
                [
                    'lost_name' => (string) $thingName,
                    'lost_time' => $time,
                    'lost_place' => $place,
                    'lost_detail' => $detail,
                    'lost_img' => $path,
                    'lost_person' => $personName,
                    'lost_phone' => $phoneNumber,
                    'lost_status' => $status,
                    'created_at' => date(now()),
                ]
            );
        } else if ($method == 2) {
            $insertResult = FoundModel::insert(
                [
                    'found_name' => $thingName,
                    'found_time' => $time,
                    'found_place' => $place,
                    'found_detail' => $detail,
                    'found_img' => $path,
                    'found_person' => $personName,
                    'found_phone' => $phoneNumber,
                    'found_status' => $status,
                    'created_at' => date(now())
                ]
            );
        }
        if ($insertResult) {
            return response()->json([
                'status' => 'ok',
                'msg' => '发布成功'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '发布失败'
            ], 200);
        }
    }

    //删除
    public function deleteData(request $Request, $id, $method)
    {
        if ($method == 1) {
            $deleteresults = DB::table('tablelost')->where('lost_id', $id)->delete();
        } else if ($method == 2) {
            $deleteresults = DB::table('tablefound')->where('found_id', $id)->delete();
        } else {
            $deleteresults = 0;
        }
        if ($deleteresults) {
            return response()->json([
                'status' => 'ok',
                'msg' => '删除成功'
            ], 201);
        }
        return response()->json([
            'status' => 'error',
            'msg' => '删除失败'
        ], 200);
    }

    //更新物品状态
    public function updateStatus($method, request $Request)
    {
        if (!isset($Request['checkUser']) || !isset($Request['checkPhone'])) {
            return response()->json([
                'status' => 'error',
                'msg' => '无效验证数据'
            ], 200);
        }
        $id = $Request->input('id');
        $status = $Request['status'];
        $return_at = date(now());
        if ($method == 1) {
            $check = DB::table('tablelost')->where('lost_id', $id)->first();
            if ($check && $Request['checkUser'] == $check->lost_person && $Request['checkPhone'] == $check->lost_phone) {
                $res = DB::table('tablelost')
                    ->where('lost_id', $id)
                    ->update(['lost_status' => $status, 'found_at' => $return_at]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => '身份验证未通过'
                ]);
            }
        } else if ($method == 2) {
            $check = DB::table('tablefound')->where('found_id', $id)->first();
            if ($check && $Request['checkUser'] == $check->found_person && $Request['checkPhone'] == $check->found_phone) {
                $res = DB::table('tablefound')->where('found_id', $id)->update(['found_status' => $status, 'return_at' => $return_at]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => '身份验证未通过'
                ]);
            }
        }
        if ($res) {
            return response()->json([
                'status' => 'ok',
                'msg' => '修改成功'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '操作失败'
            ], 200);
        }
    }

    //更新数据
    public function updateData($method, request $Request)
    {
        $someThing = isset($Request['thing']) ? $Request['thing'] : null;
        $time = isset($Request['time']) ? $Request['time'] : null;
        $place = isset($Request['place']) ? $Request['place'] : null;
        $detail = isset($Request['detail']) ? $Request['detail'] : null;
        // $status = isset($Request['status']) ? $Request['status'] : null;
        if ($Request->input('picture') && $Request->input('picture') != 'delete') {//存在图片
            $file = $Request->input('picture');
        $path = UploadUtils::getUploadPath();//获取保存的文件路径 
        Image::make($file)->resize(200, 200)->insert('images/watermark.png', 'bottom-right', 15, 10)->save($path);//保存 env('THUMB_WIDTH'), env('THUMB_HEIGHT')   
        } else if($Request->input('picture') == 'delete'){
            $path = null;
            $hasData = true;
            // var_dump($path);
        }
        $thingImg = null;
        $hasData = false;
        if (strlen($someThing) >= 0 || strlen($time) > 0 || strlen($place) > 0 || strlen($detail) > 0 || (int) $status == (1 || 0)) {
            $hasData = true;
        }
        if (!isset($Request['id'])) {
            return response()->json([
                'status' => 'warning',
                'msg' => '字段缺失'
            ], 200);
        }
        $id = $Request->input('id');
        if ($method == 1 && $hasData) {
            $updateData['found_at'] = null;
            if ($someThing) {
                $updateData['lost_name'] = $someThing;
            }
            if ($time) {
                $updateData['lost_time'] = $time;
            }
            if ($place) {
                $updateData['lost_place'] = $place;
            }
            if ($detail) {
                $updateData['lost_detail'] = $detail;
            }
            if ($path || $Request->input('picture') == 'delete') {
                $updateData['lost_img'] = $path;
            }
        } else
            if ($method == 2 && $hasData) {
            $updateData['return_at'] = null;
            if ($someThing) {
                $updateData['found_name'] = $someThing;
            }
            if ($time) {
                $updateData['found_time'] = $time;
            }
            if ($place) {
                $updateData['found_place'] = $place;
            }
            if ($detail) {
                $updateData['found_detail'] = $detail;
            }
            if ($path) {
                $updateData['found_img'] = $path;
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '无效数据'
            ], 200);
        }
        if (!isset($updateData) || !sizeof($updateData)) {
            return response()->json([
                'status' => 'error',
                'msg' => '无效数据'
            ], 200);
        }
        $updateData['updated_at'] = date(now());

        if ($method == 1) {
            $res = DB::table('tablelost')->where('lost_id', $id)->update($updateData);
        } else if ($method == 2) {
            $res = DB::table('tablefound')->where('found_id', $id)->update($updateData);
        }
        if ($res) {
            return response()->json([
                'status' => 'ok',
                'msg' => '修改成功'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '修改失败'
            ], 200);
        }
    }
    //分页返回数据列表
    public function getData(request $Request, $method)
    {
        $dataImg = [];
        switch ($method) {
            case 3:{
                    $datas1 = DB::table('tablefound')->orderBy('found_id', 'desc')->paginate(6);
                    foreach ($datas1 as $data1) {
                        $img1 = explode("|", $data1->found_img);
                        foreach ($img1 as $data1) {
                            $dataImg1[] = $data1;
                        }
                    }
                    $datas2 = DB::table('tablelost')->orderBy('lost_id', 'desc')->paginate(6);
                    foreach ($datas2 as $data2) {
                        $img2 = explode("|", $data2->lost_img);
                        foreach ($img2 as $data2) {
                            $dataImg2[] = $data2;
                        }
                    }
                    return response()->json([$datas1,$datas2], 200);
                    // $datas[] = array_merge($datas1,$datas2);
                    // $datas = $datas1 + $datas2;
                break;
            }
            case 2: {
                    $datas = DB::table('tablefound')->orderBy('found_id', 'desc')->paginate(6);
                    foreach ($datas as $data) {
                        $img = explode("|", $data->found_img);
                        foreach ($img as $data) {
                            $dataImg[] = $data;
                        }
                    }
                    $dataImgId = array_unique($dataImg);
                    $dataImgAll = DB::table('tablefound')->orderBy('found_id', 'desc')->pluck('found_img');
                    break;
                }
            default: {
                    $datas = DB::table('tablelost')->orderBy('lost_id', 'desc')->paginate(6);
                    foreach ($datas as $data) {
                        $img = explode("|", $data->lost_img);
                        foreach ($img as $data) {
                            $dataImg[] = $data;
                        }
                    }
                    $dataImgId = array_unique($dataImg);
                    $dataImgAll = DB::table('tablelost')->orderBy('lost_id', 'desc')->pluck('lost_img');
                }
        }
        return response()->json([$datas], 200);
    }

    //查询
    public function searchData(Request $Request, $method = 1)
    {
        $searchId = $Request['searchId'];
        $judgeIdRes = false;
        if(!$searchId){
            $judgeIdRes = false;
        }else {
            $judgeIdRes = true;
        }

        $keyWord = $Request['keyWord'];
        $startTime = isset($Request['startTime']) ? $Request['startTime'] : 0;
        $endTime = isset($Request['endTime']) ? $Request['endTime'] : time();
        $status = isset($Request['status']) ? $Request['status'] : 1;
        $searchKey = isset($Request['searchKey']) ? $Request['searchKey'] : 1;
        $dataImg = null;
        $dataImgAll = null;

        switch (isset($searchKey) ? $searchKey : 1) {
            case 1:
                $searchKey = 'name';
                break;
            case 2:
                $searchKey = 'place';
                break;
            case 3:
                $searchKey = 'detail';
                break;
            default:
                $searchKey = 'name';
        }

        if ($method == 1) {
            if($judgeIdRes){
                $datas = DB::table('tablelost')->where('lost_id', $searchId)->get();
            }else {
                $datas = DB::table('tablelost')->whereBetween('created_at', [$startTime, $endTime])->where("lost_{$searchKey}", 'like', "%{$keyWord}%")->where('lost_status', $status)->get();//lost_time
            }
            foreach ($datas as $data) {
                $img = explode("|", $data->lost_img);
                foreach ($img as $data) {
                    $dataImg[] = $data;
                }
            }
        } elseif ($method == 2) {
            if($judgeIdRes){
                $datas = DB::table('tablefound')->where('found_id', $searchId)->get();
            } else {
                $datas = DB::table('tablefound')->whereBetween('created_at', [$startTime, $endTime])->where("found_{$searchKey}", 'like', "%$keyWord%")->where('found_status', $status)->get();
            }
            foreach ($datas as $data) {
                $img = explode("|", $data->found_img);
                foreach ($img as $data) {
                    $dataImg[] = $data;
                }
            }
        } else {
            return response()->json(['error' => '查询失败'], 201);
        }
        if ($datas) {
            return response()->json([$datas, 'imgs' => $dataImgAll], 200);
        }
    }


    //管理员登陆
    public function loginadmin(Request $Request)
    {
        if (!isset($Request['username']) || (!isset($Request['password']))) {
            return response()->json([
                'status' => 'error',
                'msg' => '参数异常'
            ]);
        }
        $username = $Request['username'];
        $password = $Request['password'];
        $isres = DB::table('tableuser')->where("username", [$username])->where("password", $password)->first();
        $isAdmin = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('isadmin');
        $picture = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('picture');
        $created_at = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('creat_at');
        if (!$isres) {
            return response()->json([
                'status' => 'error',
                'msg' => '登陆失败',
            ], 201);
        }
        $id = $isres->id;
        $strs = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm1234567890";
        $randString = substr(str_shuffle($strs), mt_rand(0, strlen($strs) - 11), 8);
        $fakeStringB = substr(str_shuffle($strs), mt_rand(0, strlen($strs) - 11), 7);
        $fakeStringE = substr(str_shuffle($strs), mt_rand(0, strlen($strs) - 11), 9);
        $res = DB::table('tableadmin')->where('id', $id)->update(['login_key' => $randString, 'login_at' => date(now()),'name' => $username]);
        if ($res) {
            return response()->json([
                'status' => 'ok',
                'msg' => '登录成功',
                'key' => $fakeStringB . $randString . $fakeStringE,
                'username' => $username,
                'password' => $password,
                'picture' => $picture,
                'created_at' => $created_at,
                'admin' => $isAdmin,
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '登陆失败',
            ], 200);
        }
    }

    // 登陆界面
    public function login(Request $Request)
    {
        if (!isset($Request['username']) || (!isset($Request['password']))) {
            return response()->json([
                'status' => 'error',
                'msg' => '参数异常'
            ]);
        }
        $username = $Request['username'];
        $password = $Request['password'];
        $res = DB::table('tableuser')->where("username", [$username])->where("password", $password)->first();
        $isAdmin = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('isadmin');
        $picture = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('picture');
        $created_at = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('creat_at');
        // var_dump($isAdmin);
        if (!$res) {
            return response()->json([
                'status' => 'error',
                'msg' => '登陆失败',
            ], 201);
        }else {
            return response()->json([
                'status' => 'ok',
                'msg' => '登录成功',
                'username' => $username,
                'password' => $password,
                'picture' => $picture,
                'created_at' => $created_at,
                'admin' => $isAdmin,
            ], 201);
        } 
    }

    //注册
    public function register(Request $Request)
    {
        $username = $Request->input('username');
        $password = $Request->input('password');
        $isadmin = 0;
        if ($Request->input('picture')) {//存在图片
        // $file = $Request->file('picture');
        // var_dump($file);
            $file = $Request->input('picture');
        // var_dump($Request->input('picture'));
        // break;
        $path = UploadUtils::getUploadPath();//获取保存的文件路径 
        Image::make($file)->resize(200, 200)->insert('images/watermark.png', 'bottom-right', 15, 10)->save($path);//保存 env('THUMB_WIDTH'), env('THUMB_HEIGHT')   images/1.png  $file
        // $picture = isset($Request['picture']) ? $Request['picture'] : 0;
        }
        $insertResult = DB::table('tableuser')->insert(
                [
                    'username' => $username,
                    'password' => $password,
                    'picture' => $path,
                    'isadmin' => $isadmin,
                    'creat_at' => date(now()),
                ]
            );

        if ($insertResult) {
            return response()->json([
                'status' => 'ok',
                'msg' => '注册成功'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '注册失败'
            ], 200);
        }
       

    }

//管理员注册
    public function registeradmin(Request $Request)
    {
        $username = $Request->input('username');
        $password = $Request->input('password');
        $isadmin = 1;//表示管理员
        if ($Request->input('picture')) {//存在图片
        // $file = $Request->file('picture');
        // var_dump($file);
            $file = $Request->input('picture');
        // var_dump($Request->input('picture'));
        // break;
        $path = UploadUtils::getUploadPath();//获取保存的文件路径 
        Image::make($file)->resize(200, 200)->insert('images/watermark.png', 'bottom-right', 15, 10)->save($path);//保存 env('THUMB_WIDTH'), env('THUMB_HEIGHT')   images/1.png  $file
        // $picture = isset($Request['picture']) ? $Request['picture'] : 0;
        }
        $insertResult = DB::table('tableuser')->insert(
                [
                    'username' => $username,
                    'password' => $password,
                    'picture' => $path,
                    'isadmin' => $isadmin,
                    'creat_at' => date(now()),
                ]
            );

        if ($insertResult) {
            return response()->json([
                'status' => 'ok',
                'msg' => '注册成功'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => '注册失败'
            ], 200);
        }
       

    }
}