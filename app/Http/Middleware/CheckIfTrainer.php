<?php

namespace App\Http\Middleware;
use Auth;
use App\Trainer;

use Closure;

class CheckIfTrainer
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
        $trainer = Trainer::where("user_id", Auth::id())->where("registered",1)->first();

        if(!$trainer)
        {
            return redirect(action("TrainerController@index"));
        }


        return $next($request);
    }
}
