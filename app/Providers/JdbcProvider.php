<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use App\JDBC\PJBridge;
use Exception;


class JdbcProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('jdbc', function ($app) {
            $host = env('JDBC_HOST', 'localhost');
            $port = env('JDBC_PORT', '4444');

            $user = env('JDBC_USER', 'master');
            $password = env('JDBC_PASSWORD', 'password');
            $database = env('JDBC_DATABASE', 'database');

            $bridge = new PJBridge($host, $port, 'utf-8', 'utf-8');

            try {
                $connection = $bridge->connect($database, $user, $password);
                if (!$connection) {
                    throw new Exception("JDBC Connection failed to resolve...");
                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return null;
            }

            return $bridge;
        });
    }
}
