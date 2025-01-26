<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RedirectUrl
{
    public function handle($request, Closure $next)
    {
        $requestedUrl = trim($request->path(), '/');
        $cacheTag = 'requested-url-' . md5($requestedUrl);
    
        $redirect = Cache::remember($cacheTag, now()->addMinutes(5), function () use($requestedUrl) {
            $decodedUrl = rawurldecode($requestedUrl);
            return DB::table('redirects')
                ->where('old', $requestedUrl)
                ->orWhere('old', $decodedUrl)
                ->first();
        });
        
        if ($redirect) {
            return redirect($redirect->url, $redirect->type);
        }
        
        return $next($request);
    }
}
