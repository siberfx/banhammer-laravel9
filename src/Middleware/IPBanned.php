<?php

namespace Mchev\Banhammer\Middleware;

use Closure;
use Mchev\Banhammer\Banhammer;
use Symfony\Component\HttpFoundation\Response;

class IPBanned
{
    public function handle($request, Closure $next): Response
    {
        if ($request->ip() && Banhammer::isIpBanned($request->ip())) {
            return (config('ban.fallback_url'))
                ? redirect(config('ban.fallback_url'))
                : abort(403, config('ban.message'));
        }

        return $next($request);
    }
}