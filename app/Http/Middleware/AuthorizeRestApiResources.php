<?php

namespace App\Http\Middleware;

use App\ApiClient;
use App\Events\UserNavigated;
use App\User;
use App\Utils\ResponseMod;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthorizeRestApiResources
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resource)
    {

        $user = $request->auth_user;

        Log::info($user->email . ' navigate to ' . $resource);

        if ($user->isSuperAdmin()) {
            event(new UserNavigated($user));
            return $next($request);
        }

        $authorize_menu = DB::table('menu')
            ->leftJoin('role_menu', 'role_menu.menu_id', '=', 'menu.id')
            ->where('role_menu.role_id', $user->role_id)
            ->where('menu.authorize_url', $resource)
            ->first();



        if (empty($authorize_menu)){

            return response('unauthorized', 403)->json(ResponseMod::failed('unauthorized'));

        } else {

            event(new UserNavigated($user));

            return $next($request);
        }


    }
}
