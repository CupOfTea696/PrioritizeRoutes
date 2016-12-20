# Usage
<!-- [[TOC]] -->

## Basic Usage

You can add a priority to a route by simply calling the `priority` method on the route.

```php
Route::get('home', function() {
    return 'Homepage';
})->priority(5);

Route::get('{catch?}', function ($catch) {
    return 'Caught ' . $catch;
})->priority(0);
```

You can also assign priority to Route Groups, like below.

```php
Route::group(['namespace' => 'Admin', 'priority' => 5], function () {
    Route::get('admin', function () {
        return 'Admin dashboard';
    });
    
    Route::get('admin/users', function() {
        return 'User management';
    });
});

Route::get('{catch?}', function ($catch) {
    return 'Caught ' . $catch;
})->priority(0);
```

## Configuration

By default, the priority of any route where you didn't explicitly assigned a priority will be set to `0`. You can change this by publishing the vendor assets for this package and editing the configuration file.

To publish the vendor assets, run the command below.

```bash
$ php artisan vendor:publish --provider='CupOfTea\PrioritizeRoutes\PrioritizeRoutesServiceProvider'
```

Now the configuration file is available in `config/routing.php`. Simply change the `priority` key to your preferred default route priority.

```php
<?php

return [
    'priority' => 5,
];
```
