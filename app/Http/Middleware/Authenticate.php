<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $guards = [];

    public function handle($request, Closure $next, ...$guards)
    {
        //dd($request);

        //dd($next);

        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if (in_array('admin', $this->guards)) {

                return route('admin.login');
            }

            return route('login');
        }
    }
}
