<?php


namespace App\Http\Repository;

use App\Helper\Util;
use Exception;

abstract class AbstractRepository
{
    protected object $entity;
    
    /**
     * @param  string  $key
     */
    public function findByKey(string $key, $attributes = null)
    {
        $this->entity->findByKey($key, $attributes);
    }
    
    /**
     * @param  string  $keyId
     * @param  array  $keyValueData
     * @return object
     * @throws Exception
     */
    public function create(array $keyValueData, $keyId = null): object
    {
        if(!$keyId) {
            $keyId = $this->generateKeyId($keyValueData['id'] ?? Util::generateUid());
        }
        
        return $this->entity->create($keyId, $keyValueData);
    }
    
    
    /**
     * @param  array  $records
     * @param  null  $keyPrefix
     * @return array
     */
    public function createMany(array $records, $keyPrefix = null): iterable
    {
        return collect(
            array_map(function ($recordData, $key) use ($keyPrefix) {
                
                if (isset($recordData['id'])) {
                    $id = $recordData['id'];
                } else {
                    $id = $key;
                }
                
                $keyId = $this->generateKeyId($id, $keyPrefix);
                
                return $this->entity->create($keyId, $recordData);
            }, $records)
        );
    }
    
    /**
     *
     *
     * @param $id
     * @param  null  $keyPrefix
     * @return string
     */
    public function generateKeyId(string $id, $keyPrefix = null): string
    {
        $keyId = $this->entity->generateKeyId($id);
        
        if ($keyPrefix) {
            $keyId = $keyPrefix.$keyId;
        }
        
        return $keyId;
    }
    
    
}
