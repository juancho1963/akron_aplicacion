<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | which utilizes session storage plus the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    |Proveedores de usuarios
    |--------------------------------------------------------------------------
    |
    | Todos los guardias de autenticación tienen un proveedor de usuarios, que define cómo
    | Los usuarios se recuperan realmente de su base de datos u otro almacenamiento
    | Sistema utilizado por la aplicación. Normalmente se utiliza Eloquent.
    |
    | Si tiene varias tablas o modelos de usuarios, puede configurar varios
    |proveedores para representar el modelo/tabla. Estos proveedores pueden entonces
    | se asignará a cualquier guardia de autenticación adicional que haya definido.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Restablecer contraseñas
    |--------------------------------------------------------------------------
    |
    | Estas opciones de configuración especifican el comportamiento de la contraseña de Laravel
    | Funcionalidad de reinicio, incluida la tabla utilizada para el almacenamiento de tokens
    | y el proveedor de usuarios que se invoca para recuperar realmente los usuarios.
    |
    | El tiempo de expiración es la cantidad de minutos que durará cada token de reinicio.
    |considerado válido. Esta característica de seguridad mantiene los tokens de corta duración, por lo que
    | Tienen menos tiempo para ser adivinados. Puedes cambiar esto según sea necesario.
    |
    | La configuración del acelerador es la cantidad de segundos que un usuario debe esperar antes
    | Generando más tokens de restablecimiento de contraseña. Esto evita que el usuario...
    | generando rápidamente una gran cantidad de tokens de restablecimiento de contraseña.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
