<?php

namespace App\Http\Middleware;
use App\GroupArticles;
use App\UserHasGroup;
use Auth;
use Closure;

class GroupAdminOrCreator
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
        $user = GroupArticles::find($url["id"])->user_id;
        $auth = Auth::id();
        $group_id = ["id" => $url["group"]->id];
        $admin = UserHasGroup::where('user_id', $auth)->where('group_id', $group_id)->where('is_group_admin', 1);

        if(!$admin && $user != $auth)
        {
            return redirect(action("GroupController@show", ["id" => $url["group"]->id]));
        }
        return $next($request);
    }
}
