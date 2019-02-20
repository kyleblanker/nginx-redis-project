<?php

namespace App\Http\Middleware;

use Crypt;
use Closure;
use Illuminate\Support\Facades\Redis;

class RedisCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$time = 3600, $type = 'general')
    {
        $time = (int) $time;
        $key = $request->url();

        if($request->path() == '/') {
            $key .= '/';
        }
        $key .= ':' . $request->getQueryString();
        if($type == 'session') {
            $key .= ':' . urlencode($request->cookie('laravel_session'));
        }

        $response = $next($request);

        //Only cache get responses
        if($request->isMethod('get')) {
            $responseContent = sprintf("%s<!-- Cached: %s -->",$response->getContent(),date('Y-m-d H:i:s'));
            Redis::setex($key,$time,$responseContent);
        }

        return $response;
    }
}
