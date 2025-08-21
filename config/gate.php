<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gate Proxy Activation
    |--------------------------------------------------------------------------
    |
    | This option determines whether the global proxy for outbound HTTP
    | requests should be enabled. When set to true, the Laravel HTTP
    | client will automatically use the configured proxy URL below.
    |
    */

    'enabled' => env('GATE_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Proxy URL
    |--------------------------------------------------------------------------
    |
    | Define the proxy URL to be used for all HTTP client requests.
    | Supported schemes include http, https, socks5, etc.
    | If enabled is true but this is null, a GateNotConfigured
    | exception will be thrown during the boot process.
    |
    */

    'url' => env('GATE_URL', null),

];
