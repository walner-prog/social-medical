<?php

/*
 * Este archivo es parte de jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * Para información completa sobre derechos de autor y licencia, consulte el archivo LICENSE
 * incluido con este código fuente.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Secreto de Autenticación JWT
    |--------------------------------------------------------------------------
    |
    | No olvides configurar esto en tu archivo .env, ya que se usará para firmar
    | tus tokens. Hay un comando de ayuda para esto:
    | `php artisan jwt:secret`
    |
    | Nota: Esto se usará solo para algoritmos Simétricos (HMAC),
    | ya que RSA y ECDSA utilizan una combinación de clave privada/pública (ver abajo).
    |
    */

    'secret' => env('JWT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Claves de Autenticación JWT
    |--------------------------------------------------------------------------
    |
    | El algoritmo que uses determinará si tus tokens se firman con una
    | cadena aleatoria (definida en `JWT_SECRET`) o utilizando las siguientes claves
    | pública y privada.
    |
    | Algoritmos Simétricos:
    | HS256, HS384 & HS512 usarán `JWT_SECRET`.
    |
    | Algoritmos Asimétricos:
    | RS256, RS384 & RS512 / ES256, ES384 & ES512 usarán las claves de abajo.
    |
    */

    'keys' => [

        /*
        |--------------------------------------------------------------------------
        | Clave Pública
        |--------------------------------------------------------------------------
        |
        | Una ruta o recurso hacia tu clave pública.
        |
        | Ejemplo: 'file://ruta/a/clave/publica'
        |
        */

        'public' => env('JWT_PUBLIC_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Clave Privada
        |--------------------------------------------------------------------------
        |
        | Una ruta o recurso hacia tu clave privada.
        |
        | Ejemplo: 'file://ruta/a/clave/privada'
        |
        */

        'private' => env('JWT_PRIVATE_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Contraseña
        |--------------------------------------------------------------------------
        |
        | La contraseña para tu clave privada. Puede ser null si no tiene una.
        |
        */

        'passphrase' => env('JWT_PASSPHRASE'),

    ],

    /*
    |--------------------------------------------------------------------------
    | Tiempo de vida del JWT
    |--------------------------------------------------------------------------
    |
    | Especifica el tiempo (en minutos) que el token será válido.
    | Por defecto es 1 hora.
    |
    | También puedes configurar esto como null para que el token no expire nunca.
    | Esto puede ser útil para, por ejemplo, una aplicación móvil.
    | No se recomienda particularmente, así que asegúrate de tener sistemas
    | adecuados para revocar el token si es necesario.
    | Nota: Si configuras esto como null, debes eliminar el elemento 'exp' de
    | la lista 'required_claims'.
    |
    */

    'ttl' => env('JWT_TTL', 60),

    /*
    |--------------------------------------------------------------------------
    | Tiempo de vida para refrescar el token
    |--------------------------------------------------------------------------
    |
    | Especifica el tiempo (en minutos) durante el cual el token puede ser
    | refrescado. Por ejemplo, el usuario puede refrescar su token dentro de
    | un plazo de 2 semanas desde la creación del token original hasta que deba
    | autenticarse de nuevo.
    | Por defecto son 2 semanas.
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),

    /*
    |--------------------------------------------------------------------------
    | Algoritmo de hash para el JWT
    |--------------------------------------------------------------------------
    |
    | Especifica el algoritmo de hash que se usará para firmar el token.
    |
    */

    'algo' => env('JWT_ALGO', Tymon\JWTAuth\Providers\JWT\Provider::ALGO_HS256),

    /*
    |--------------------------------------------------------------------------
    | Reclamos requeridos
    |--------------------------------------------------------------------------
    |
    | Especifica los reclamos que deben existir en cualquier token.
    | Se lanzará una excepción TokenInvalidException si alguno de estos
    | reclamos no está presente en el payload.
    |
    */

    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ],

    /*
    |--------------------------------------------------------------------------
    | Reclamos persistentes
    |--------------------------------------------------------------------------
    |
    | Especifica las claves de reclamos que se deben mantener al refrescar un token.
    | `sub` e `iat` se mantendrán automáticamente, además de estos reclamos.
    |
    */

    'persistent_claims' => [
        // 'foo',
        // 'bar',
    ],

    /*
    |--------------------------------------------------------------------------
    | Bloquear sujeto
    |--------------------------------------------------------------------------
    |
    | Determina si un reclamo `prv` se agrega automáticamente al token.
    |
    */

    'lock_subject' => true,

    /*
    |--------------------------------------------------------------------------
    | Margen de tiempo
    |--------------------------------------------------------------------------
    |
    | Proporciona un margen para los reclamos de tiempo del jwt.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    |--------------------------------------------------------------------------
    | Lista negra habilitada
    |--------------------------------------------------------------------------
    |
    | Para invalidar tokens, debes habilitar la lista negra.
    |
    */

    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Periodo de gracia para lista negra
    |--------------------------------------------------------------------------
    |
    | Previene fallos en solicitudes concurrentes con el mismo JWT.
    |
    */

    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),

    /*
    |--------------------------------------------------------------------------
    | Proveedores
    |--------------------------------------------------------------------------
    |
    | Especifica los diferentes proveedores utilizados en el paquete.
    |
    */

    'providers' => [

        'jwt' => Tymon\JWTAuth\Providers\JWT\Lcobucci::class,

        'auth' => Tymon\JWTAuth\Providers\Auth\Illuminate::class,

        'storage' => Tymon\JWTAuth\Providers\Storage\Illuminate::class,

    ],

];
