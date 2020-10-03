<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\GroupArticles;
class GroupArticle
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
        if($user != $auth)
        {
            return redirect(action("GroupController@show", ["id" => $url["group"]->id]));
        }
        return $next($request);
    }
}
