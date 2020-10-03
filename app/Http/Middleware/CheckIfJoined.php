<?php

namespace App\Http\Middleware;
use Auth;
use App\UserHasGroup;
use Closure;
class CheckIfJoined
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
        $group_id = $url["group"]->id;
        $joined = UserHasGroup::where("user_id", Auth::id())->where("group_id", $group_id)->where("joined", 1)->first();
        $wannajoin = UserHasGroup::where("user_id", Auth::id())->where("group_id", $group_id)->where("wanna_join", 1)->first();
        if($joined)
        {
            return redirect(action("GroupController@show", ["id" => $group_id]))->with("success", "You already joined this group");
        } elseif($wannajoin)
        {
            return redirect(action("GroupController@show", ["id" => $group_id]))->with("success", "You already sent a request");
        }
    
        return $next($request);
    }
}
