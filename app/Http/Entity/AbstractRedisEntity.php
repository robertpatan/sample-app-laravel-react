<?php declare(strict_types=1);

//https://divinglaravel.com/introduction-to-redis-hashes

namespace App\Http\Entity;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

abstract class AbstractRedisEntity
{
    
    protected object $connection;
    
    protected string $table;
    
    public function __construct()
    {
        $this->connection = new Redis();
    }
    
    /**
     * Keys must match all class entity public properties/attributes
     *
     * @param  string  $keyId
     * @param  array  $keyValueData
     * @return object
     * @throws Exception
     */
    public function create(string $keyId, array $keyValueData): object
    {
        $attributes = $this->attributes();
        foreach ($keyValueData as $attribute => $value) {
            if (!in_array($attribute, $attributes, false)) {
                throw new Exception('Property '.$attribute.' is missing in '.$this->className());
            }
            
            $this->{$attribute} = $value;
        }
        
        $this->connection::hMSet($keyId, $keyValueData);
        
        return $this;
    }
    
    
    /**
     *
     * @param  string  $key
     * @param  null  $attributes
     * @return mixed
     * @throws Exception
     */
    public function findByKey(string $key, $attributes = null)
    {
        if(!$attributes) {
            return $this->connection->hgetall($key);
        }
        
        return $this->connection->hget($key, $attributes);
        
    }
    
    /**
     * Get called class public properties/attributes
     *
     * @return array
     * @throws Exception
     */
    public function attributes(): array
    {
        try {
            $rClass = new \ReflectionClass(get_class($this));
            
            $results = $rClass->getProperties(\ReflectionProperty::IS_PUBLIC) ?? [];
            
            $props = [];
            foreach ($results as $prop) {
                $props[] = $prop->getName();
            }
        } catch (Exception $e) {
            Log::error($e);
            throw new Exception('Could not get class properties');
        }
        
        return $props;
    }
    
    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * @return string
     */
    public function className(): string
    {
        return get_class($this);
    }
    
    /**
     * Handle dynamic static method calls
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static())->$method(...$parameters);
    }
    
    /**
     * @param  string  $id
     * @return string
     */
    public function generateKeyId(string $id): string
    {
        return $this->getTable().':'.$id;
    }
}