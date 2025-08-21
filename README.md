# Perfocard Gate

A lightweight package for Laravel that globally configures the Laravel HTTP Client (`Illuminate\Support\Facades\Http`) to use a proxy for all outgoing requests.

---

## Features

- Globally injects the `proxy` option into all outgoing HTTP requests
- Configurable via `config/gate.php`
- Simple enable/disable switch
- Throws a clear exception if misconfigured
- Supports `http`, `https`, `socks5`, etc.

---

## Installation

```bash
composer require perfocard/gate
```

---

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Perfocard\Gate\GateServiceProvider" --tag=config
```

This will create a file at `config/gate.php`:

```php
return [
    'enabled' => env('GATE_ENABLED', false),

    // You can specify a single URL or an array of URLs
    'urls' => env('GATE_URLS'), // e.g., http://localhost:8080 or socks5://127.0.0.1:9050
];
```

In your `.env` file:

```
GATE_ENABLED=true
GATE_URLS=http://localhost:8080,http://proxy2:8080,socks5://127.0.0.1:9050
```

---

## Usage

Once enabled, **all HTTP requests** using Laravel's HTTP client will automatically include the `proxy` option:

```php
use Illuminate\Support\Facades\Http;

$response = Http::get('https://example.com');
```

No manual configuration per request is needed.

If you specify multiple URLs in `GATE_URLS`, Gate will automatically select one of them at random for each application run.

---

## Notes

- If `gate.enabled = true` but no valid proxy URLs are set, a `GateNotConfigured` exception will be thrown.
- You can specify multiple proxy URLs (comma-separated in the env file or as an array in the config file). One of them will be selected at random.
- Internally, this package uses `Http::globalOptions()` to apply the proxy globally.

---

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/license/MIT).
