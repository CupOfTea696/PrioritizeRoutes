# Installation
<!-- [[TOC]] -->

## Install Composer

To install PrioritizeRoutes, you will first need to install [Composer][composer] if you haven't already.

## Install PrioritizeRoutes

### Install via Composer

You can install PrioritizeRoutes by simply requiring the package with [Composer][composer] inside your projects root. To do so, run the following command:

```bash
$ composer require cupoftea/prioritize-routes ~1.0
```

### Setting up PrioritizeRoutes

You will need to add the following service providers to your `config/app.php`:

```php
	'providers' => [
        
		/*
		 * Laravel Framework Service Providers...
		 */
        
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        'Illuminate\Bus\BusServiceProvider',
        
        ...
        
        'CupOfTea\PrioritizeRoutes\PrioritizeRoutesServiceProvider',
        
	],
```

[composer]: https://getcomposer.org/doc/00-intro.md
