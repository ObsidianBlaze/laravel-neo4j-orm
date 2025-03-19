<?php
namespace Idada\LaravelNeo4j\Connections;

use Laudis\Neo4j\Client;

class Neo4jConnection
{
    protected Client $client;

    public function __construct(array $config)
    {
        $this->client = Client::create([
            'bolt' => "bolt://{$config['username']}:{$config['password']}@{$config['host']}:{$config['port']}"
        ]);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
