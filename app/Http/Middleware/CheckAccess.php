<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\WelcomeController;
use Redirect;
use DB;
use Session;

use GuzzleHttp\Client;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $link_id = $roles[0];
        unset($roles[0]);
        
        if (!isset($_SESSION)) session_start();
        $halo_user = $_SESSION['halo_user'];
        
        $pass = false;
        $client = new Client();
        $res = $client->request('GET', DB::table('acc_config')->whereId(1)->first()->master_url.'/api/getRoles', [
            'query' => [
                'username' => $halo_user->username,
                'link_id' => $link_id
            ]
        ]);
        $permissions = json_decode($res->getBody());
        
        foreach ($permissions as $permission) {
            if (in_array($permission, $roles)) {
                $pass = true;
                break;
            }
        }
        
        if ($pass == false) {
            return Redirect::to(DB::table('acc_config')->whereId(1)->first()->master_url.'/dashboard')
                    ->with('error', '<strong>Access denied!</strong><br />You are not permitted to view the requested page.');
        }
        
        return $next($request);
    }
}
