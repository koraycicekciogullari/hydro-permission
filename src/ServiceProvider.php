<?php

namespace Koraycicekciogullari\HydroPermission;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/hydro-permission.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('hydro-permission.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__ . '/Routes/permission-route.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'hydro-permission'
        );
    }
}
