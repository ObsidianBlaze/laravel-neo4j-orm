<?php
namespace Idada\LaravelNeo4j\Providers;

use Illuminate\Support\ServiceProvider;
use Idada\LaravelNeo4j\Connections\Neo4jConnection;

class Neo4jServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('neo4j', function ($app) {
            return new Neo4jConnection(config('neo4j'));
        });

        $this->mergeConfigFrom(__DIR__ . '/../../config/neo4j.php', 'neo4j');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/neo4j.php' => config_path('neo4j.php'),
        ], 'config');
    }
}
