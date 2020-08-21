<?php

namespace App\Http\Controllers\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    //测试
    public function country(){
        return response() -> json(CountryModel::get(),200);
    }

 // 项目开始

 public function index()
 {
     return response() -> json(CountryModel::get(),200);
 }
//  public function add()
//  {
//      return view('demo/add');
//  }
 public function add(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'pass' => 'required|min:3|max:20'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $index = CountryModel::create($request->all());
        return response()->json($index,201);
    }

 public function delete(Request $request,$id)
 {
    $index = CountryModel::find($id);
    if (is_null($index)){
        return response()->json('Record not found!',404);
    }
    $index->delete();
    return response()->json(null,204);

 }
 public function update(Request $request,CountryModel $index)
 {
    // $index = CountryModel::find($id);
    // if (is_null($index)) {
    // return response()->json( 'Record not found!' , 404);
    // }
    $index->update($request->all());
    return response()->json($index, 200);
    
 }
 public function inquireByID($id){
    $index = CountryModel::find($id);
    if (is_null($index)){
        return response()->json('Recod not found!',404);
    }
    return response()->json($index,200);
}
//  public function inquire(Request $request)
//  {
//      $demoQuery = [
//          'idQuery' => $request['idQuery'],
//          'nameQuery'=> $request['nameQuery'],
//          'passQuery'=>$request['passQuery'],
//          'numQuery'=>$request['numQuery'],
//      ];  
//  if (isset($demoQuery['idQuery']) || isset($demoQuery['nameQuery']) || isset($demoQuery['passQuery']) || isset($demoQuery['numQuery']))
//  {
//      $sql = "select * from demos where ";
//      if(isset($demoQuery['idQuery'])){
//          $sql = $sql." id = ".$demoQuery['idQuery']." and ";
//      }
//      if(isset($demoQuery['nameQuery'])){
//          $sql = $sql." name = '".$demoQuery['nameQuery']."' and ";
//      }
//      if(isset($demoQuery['passQuery'])){
//          $sql = $sql." pass = '".$demoQuery['passQuery']."' and ";
//      }
//      if(isset($demoQuery['numQuery'])){
//          $sql = $sql." num = ".$demoQuery['numQuery']." and ";
//      }
//      $sql = substr($sql,0,strlen($sql)-4);
     
//  } else $sql = ""; //若都不存在

//  $results[] = DB::select($sql);
//  $i=0;
//  while (isset($results[0][$i])){
//      $res[$i] = (array) $results[0][$i];
//      $i = $i +1;
//  }
//     return view("demo/inquire",['datas'=> $res]);
//  }

}
