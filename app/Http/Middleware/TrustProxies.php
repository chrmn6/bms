<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for the application.
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        SymfonyRequest::HEADER_X_FORWARDED_FOR |
        SymfonyRequest::HEADER_X_FORWARDED_HOST |
        SymfonyRequest::HEADER_X_FORWARDED_PORT |
        SymfonyRequest::HEADER_X_FORWARDED_PROTO;
}
