<?php

namespace App\Http\Middleware;

use Closure;

class TrustedIps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $ips
     * @return mixed
     */
    public function handle($request, Closure $next, $ips)
    {
        $access = array_filter(array_map(function ($ip) {
            return ($star = strpos($ip, '*')) ? substr(getenv('REMOTE_ADDR'), 0, $star) == substr($ip, 0, $star) : (getenv('REMOTE_ADDR') == $ip);
        }, $ips));
        return $access ? $next($request) : abort(403);
    }
}
