<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Headers de seguridad

        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains'); // Habilita HSTS para forzar el uso de HTTPS durante 1 año, incluyendo subdominios.
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Previene ataques de clickjacking permitiendo el iframe solo desde el mismo origen.
        $response->headers->set('X-Content-Type-Options', 'nosniff'); // Evita que el navegador realice MIME-sniffing y respete el tipo de contenido declarado.
        $response->headers->set('Referrer-Policy', 'no-referrer'); // Controla la información de referencia enviada, en este caso, no envía ninguna.
        $response->headers->set('Permissions-Policy', 'geolocation=(self)'); // Restringe el uso de la API de geolocalización solo al mismo origen (mi dominio).

        /* De aca saque la data https://laravel.com/docs/11.x/middleware#introduction */

        return $response;
    }
}
