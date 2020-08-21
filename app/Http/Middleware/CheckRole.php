<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $username = $request->input('username');
        $password = $request->input('password');
        $isAdmin = DB::table('tableuser')->where("username", [$username])->where("password", $password)->value('isadmin');
         if($isAdmin == 0){
                // session()->flash('danger','您不是管理员');
                // return redirect()->back();
            return response()->json([
                'status' => 'danger',
                'msg' => '您不是管理员',
            ], 201);
                // 'admin/login'
        }
        return $next($request);
    }
}
