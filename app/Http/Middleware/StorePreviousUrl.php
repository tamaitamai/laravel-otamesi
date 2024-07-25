<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StorePreviousUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        session(['url' => $request->url()]);
        return $next($request);
    }
}
