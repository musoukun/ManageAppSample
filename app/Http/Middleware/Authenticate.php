<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{

    protected string $manageapp_route = 'manageapp.login'; //追記

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if($request->is('manageapp') || $request->is('manageapp/*')){
                return route($this->manageapp_route);
            } else {
                return route('login');
            }
        }
    }
}
