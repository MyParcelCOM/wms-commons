<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;

/**
 * Maps the default middleware needed for WMS integrations.
 * It does this by being passed to `Application::configure()->withMiddleware()` in `boostrap/app.php`
 */
class DefaultMiddleware
{
    public function __invoke(Middleware $middleware): void
    {
        $middleware->use([
            'throttle:api',
            ForceJsonResponse::class,
            TrustProxies::class,
            HandleCors::class,
            ValidatePostSize::class,
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,
            SubstituteBindings::class,
        ]);
        $middleware->alias([
            'auth'                       => Authenticate::class,
            'auth.basic'                 => AuthenticateWithBasicAuth::class,
            'cache.headers'              => SetCacheHeaders::class,
            'can'                        => Authorize::class,
            'password.confirm'           => RequirePassword::class,
            'signed'                     => ValidateSignature::class,
            'throttle'                   => ThrottleRequests::class,
            'verified'                   => EnsureEmailIsVerified::class,
        ]);
    }
}
