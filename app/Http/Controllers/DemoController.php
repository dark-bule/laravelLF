<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demo;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    //
    // public function index()
    // {
    //     return "Hi DemoController";
    // }
    public function welcome()
    {
        return view('welcome');
    }
    
    public function test1()
    {
        $datas = [1,2,3,4,5,6,7,8,9];
        return view("test1",['datas'=>$datas]);
    }

    public function hi($name)
    {
        return  "Hi ".$name;
    }
    public function bye($name = null)
    {
        if($name == null) 
        {
            return  "没有name值";
        }
        return  "Bye ".$name;
    }

    // 项目开始

    public function index()
    {
        // dd(Demo::all());
        return view("demo/index",['datas'=>Demo::all()]);
    }
    public function add()
    {
        return view('demo/add');
    }
    public function install(Request $request)
    {
        // echo $request['name'];
        // echo "<br>";
        // echo $request->input('pass');
        // echo "<br>";
        // echo $request['num'];

        $demo = [
            'name'=> $request['name'],
            'pass'=>$request['pass'],
            'num'=>$request['num'],
        ];

        $res = Demo::create($demo);
        //  var_dump($res);
        // var_dump($sql);
        // exit;

        return $res ? view("demo/install",['datas'=>Demo::all()]):view("demo/add");
    }

    public function delete($id)
    {
        // Header("HTTP/1.1 303 See Other"); 

        // Header("Location: http://demo.laravel/demo/index"); 
        Demo::destroy($id);
        return redirect('/demo/index');
    }

    public function edit($id)
    {
        return view('demo/edit',['data'=>Demo::find($id)]);
    }
    public function update(Request $Request,$id)
    {
        
        $demo =  Demo::find($id);
     
        if(isset($Request['name']))
        {
            $demo->name = $Request['name'];
        }
        if(isset($Request['pass']))
        {
            $demo->pass = $Request['pass'];
        }
        if(isset($Request['num']))
        {
            $demo->num = $Request['num'];
        }



        $demo->save();

        return view('demo/index',['datas'=>Demo::all()]);
    }
    
    public function inquire(Request $request)
    {
        // echo $request['name'];
        // echo "<br>";
        // echo $request->input('pass');
        // echo "<br>";
        // echo $request['num'];

        $demoQuery = [
            'idQuery' => $request['idQuery'],
            'nameQuery'=> $request['nameQuery'],
            'passQuery'=>$request['passQuery'],
            'numQuery'=>$request['numQuery'],
        ];

        // var_dump($demoQuery['name']);
        // exit;
        
        
    if (isset($demoQuery['idQuery']) || isset($demoQuery['nameQuery']) || isset($demoQuery['passQuery']) || isset($demoQuery['numQuery']))
    {
        $sql = "select * from demos where ";
        if(isset($demoQuery['idQuery'])){
            $sql = $sql." id = ".$demoQuery['idQuery']." and ";
        }
        if(isset($demoQuery['nameQuery'])){
            $sql = $sql." name = '".$demoQuery['nameQuery']."' and ";
        }
        if(isset($demoQuery['passQuery'])){
            $sql = $sql." pass = '".$demoQuery['passQuery']."' and ";
        }
        if(isset($demoQuery['numQuery'])){
            $sql = $sql." num = ".$demoQuery['numQuery']." and ";
        }
        $sql = substr($sql,0,strlen($sql)-4);
        
    } else $sql = ""; //若都不存在

    $results[] = DB::select($sql);

    // var_dump($results[0]);
    // exit;
    // $res = $results[0][0];
    // $res = (array)$results[0];
    $i=0;
    while (isset($results[0][$i])){
        $res[$i] = (array) $results[0][$i];
        $i = $i +1;
    }
    // $results ->save();
    // $res = array();
    // if($results) {
    //     //转化为数组
    //   while($value = $results->fetch_array()) {
    //       if(empty($res)){
    //           $res = $value;
    //       }else{
    //           $res[] = $value;
    //       }
    //    }
    // }
    // echo json_encode($res,JSON_UNESCAPED_UNICODE);
    // die;
    // $res[] =  $results;
    // $results = json_decode($results, true);
        // var_dump($results[0][0]);
        // var_dump($res);
        // var_dump($sql);
        // exit;
        // $users = Demo::table('laravel_lesson') -> where('name', 'pass','num')
        // $res = Demo::create($demoQuery);
        // return view("demo/inquire",['datas'=> $results[0][0]]);
        // return view("demo/inquire",['datas'=> $results]);
        return view("demo/inquire",['datas'=> $res]);
       
        // return isset($results) ? view("demo/inquire",['datas'=> $results]):view("demo/index");
        // $users = DB::select('select * from users where active = ?', [1]);
        // return view('user.index', ['users' => $users]);

    }

}
