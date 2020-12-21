<?php

declare(strict_types=1);

namespace Rinvex\Addresses\Providers;

use Rinvex\Addresses\Models\Address;
use Illuminate\Support\ServiceProvider;

class AddressesServiceProvider extends ServiceProvider
{

  /**
   * {@inheritdoc}
   */
  public function register()
  {
    // Merge config
    $this->mergeConfigFrom(realpath(__DIR__ . '/../../config/config.php'), 'rinvex.addresses');

    // Bind eloquent models to IoC container
    $this->app->singleton('rinvex.addresses.address', $addressModel = $this->app['config']['rinvex.addresses.models.address']);
    $addressModel === Address::class || $this->app->alias('rinvex.addresses.address', Address::class);
  }

  /**
   * {@inheritdoc}
   */
  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__.'/database/migrations');
  }


}
