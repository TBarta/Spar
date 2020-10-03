<?php

namespace App\Http\Middleware;

use App\Trainer;
use Auth;
use Closure;

class IsTrainer
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

        if($trainer)
        {
            return redirect(action("TrainerController@dashboard"));
        }

        return $next($request);
    }
}
