<?php

namespace App\Http\Middleware;
use App\UserHasGroup;
use Closure;
use Auth;

class GroupAdmin
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

        $group_id = ["id" => $url["group"]->id];
        
        $auth = Auth::id();
        $admin = UserHasGroup::where('user_id', $auth)->where('group_id', $group_id)->where('is_group_admin', 1)->first();

        if(!$admin)
        {
            return redirect(action("GroupController@show", ["id" => $url["group"]->id]));
        }
        

        return $next($request);
    }
}
