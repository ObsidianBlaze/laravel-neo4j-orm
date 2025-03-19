<?php
namespace Idada\LaravelNeo4j\Models;

use Idada\LaravelNeo4j\Connections\Neo4jConnection;

abstract class Neo4jModel
{
    protected static $connection;

    public function __construct()
    {
        if (!static::$connection) {
            static::$connection = app('neo4j')->getClient();
        }
    }

    public static function find($id)
    {
        $query = "MATCH (n) WHERE ID(n) = \$id RETURN n";
        $result = static::$connection->run($query, ['id' => $id]);

        return $result->first();
    }

    public static function create(array $attributes)
    {
        $labels = static::getLabels();
        $query = "CREATE (n:{$labels} {props}) RETURN n";
        $result = static::$connection->run($query, ['props' => $attributes]);

        return $result->first();
    }

    public static function where($field, $operator, $value)
    {
        $labels = static::getLabels();
        $query = "MATCH (n:{$labels}) WHERE n.$field $operator \$value RETURN n";
        $result = static::$connection->run($query, ['value' => $value]);

        return $result->getResults();
    }

    protected static function getLabels()
    {
        return static::$label ?? 'Node';
    }
}
