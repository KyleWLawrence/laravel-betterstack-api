# Laravel BetterStack

This package provides integration with the BetterStack API. It currently only supports sending a chat message.

## Installation

You can install this package via Composer using:

```bash
composer require kylewlawrence/laravel-betterstack-api
```

The facade is automatically installed.

```php
BetterStack::get('zones', ['per_page' => 100]);
```

## Configuration

To publish the config file to `app/config/betterstack-laravel.php` run:

```bash
php artisan vendor:publish --provider="KyleWLawrence\BetterStack\Providers\BetterStackServiceProvider"
```

Set your configuration using **environment variables**, either in your `.env` file or on your server's control panel:

- `BETTERSTACK_TOKEN`

The API access token. You can create one as described here: `https://betterstack.com/docs/uptime/api/getting-started-with-uptime-api/multiple-tokens/`

- `BETTERSTACK_DRIVER` _(Optional)_

Set this to `null` or `log` to prevent calling the BetterStack API directly from your environment.

## Contributing

Pull Requests are always welcome here. I'll catch-up and develop the contribution guidelines soon. For the meantime, just open and issue or create a pull request.

## Usage

### Facade

The `BetterStack` facade acts as a wrapper for an instance of the `BetterStack\Http\HttpClient` class.

### Dependency injection

If you'd prefer not to use the facade, you can instead inject `KyleWLawrence\BetterStack\Services\BetterStackService` into your class. You can then use all of the same methods on this object as you would on the facade.

```php
<?php

use KyleWLawrence\BetterStack\Services\BetterStackService;

class MyClass {

    public function __construct(BetterStackService $betterstack_service) {
        $this->betterstack_service = $betterstack_service;
    }

    public function listZones() {
        return $this->betterstack_service->get('dnszone', ['perPage' => 100]);
    }

}
```

This package is available under the [MIT license](http://opensource.org/licenses/MIT).
