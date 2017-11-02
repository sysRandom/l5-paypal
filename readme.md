# L5-Paypal

L5-Paypal is a wrapper package encapsulating Paypal REST API SDK.

## Installation

1. Install package using Composer `composer require xstech/l5-paypal`

2. Next, add the service provider to `app/config/app.php` in the `providers` array.

```php
'providers' => [
    XSTech\L5Paypal\L5PaypalServiceProvider::class,
]
```

3. Add an alias to `app/config/app.php` in the `aliases` array.

```php
'aliases' => [
    'Paypal' => XSTech\L5Paypal\Facades\Paypal::class,
]
```

4. Finally, publish package config.
    php artisan vendor:publish --provider="XSTech\L5Paypal\L5PaypalServiceProvider"
