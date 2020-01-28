<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\WelcomeController;
use Redirect;
use DB;

class CheckUser
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
        if (!WelcomeController::checkAccess()) {
            return Redirect::to(DB::table('acc_config')->whereId(1)->first()->master_url)
                    ->with('error', '<strong>Access denied!</strong><br />Please log in to gain access.');
        }
        
        return $next($request);
    }
}
