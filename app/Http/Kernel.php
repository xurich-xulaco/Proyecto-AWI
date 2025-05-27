<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware globales de HTTP que se ejecutan en cada petición.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Confía automáticamente en cabeceras proxy (si usas alb, nginx, etc.)
        \App\Http\Middleware\TrustProxies::class,
        // Manejo de CORS
        \Fruitcake\Cors\HandleCors::class,
        // Deshabilita el sitio si está en modo mantenimiento
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // Valida el tamaño máximo de los POST
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // Recorta espacios en cadenas de entrada
        \App\Http\Middleware\TrimStrings::class,
        // Convierte cadenas vacías a null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Grupos de middleware para rutas "web" y "api".
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Encripta y desencripta cookies
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // Maneja la sesión
            \Illuminate\Session\Middleware\StartSession::class,
            // Comparte errores de validación con las vistas
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // Protección CSRF
            \App\Http\Middleware\VerifyCsrfToken::class,
            // Vincula parámetros de ruta a modelos
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // Para que Sanctum reconozca stateful requests desde SPA
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // Límite de peticiones
            'throttle:api',
            // Vincula parámetros de ruta a modelos
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware que puedes asignar a rutas individuales.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth'             => \App\Http\Middleware\Authenticate::class,
        'auth.basic'       => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers'    => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'              => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'            => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed'           => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'         => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'         => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'role'       => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    ];
}
