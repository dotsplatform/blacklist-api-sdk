<?php
/**
 * Description of ServiceProvider.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Liuba Kalyta <kalyta@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Illuminate\Support\ServiceProvider;

class BlacklistApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/blacklist-api-sdk.php',
            'blacklist-server'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/blacklist-api-sdk.php' => config_path('blacklist-api-sdk.php'),
        ], 'config');
    }
}
