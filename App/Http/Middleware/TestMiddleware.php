<?php

namespace App\Http\Middleware;

class TestMiddleware
{
    public function handle($request, $next)
    {   
        echo "This is a test middleware!<br>";
        return $next($request);
    }
}