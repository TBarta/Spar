<?php

namespace App\Http\Middleware;
use App\UserHasGroup;
use Closure;
use Auth;

class GroupAdminUpload
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
        $url = $request->route()->parameters();

        $group_id = $url["group"];
        
        $auth = Auth::id();
        $admin = UserHasGroup::where('user_id', $auth)->where('group_id', $group_id)->where('is_group_admin', 1)->first();


        if(!$admin)
        {
            return redirect(action("GroupController@show", ["id" => $group_id]));
        }
        return $next($request);
    }
}
