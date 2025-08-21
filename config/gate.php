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
    /*
    |--------------------------------------------------------------------------
    | Proxy URLs
    |--------------------------------------------------------------------------
    |
    | Specify a list of proxy server URLs to be used for all outgoing HTTP
    | client requests. Supported schemes include http, https, socks5, etc.
    | The value is read as a comma-separated string and converted to an array.
    | If 'enabled' is true but the resulting array is empty, a GateNotConfigured
    | exception may be thrown during boot.
    |
    */

    'urls' => env('GATE_URLS'),

];
