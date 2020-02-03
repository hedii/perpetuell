<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Facades\Agent;

class RedirectIfMobileDevice
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
        if (Agent::isMobile() || Agent::isTablet()) {
            return redirect(route('front.no-mobile'));
        }

        return $next($request);
    }
}
