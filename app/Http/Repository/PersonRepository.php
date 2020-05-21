<?php declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Models\Person;

class PersonRepository extends Repository
{
    /**
     * PersonRepository constructor.
     *
     * @param  Person  $person
     */
    public function __construct(
        Person $person
    ) {
        $this->model = $person;
    }
    
    /**
     * Inserts a new resource if not exists or returns the existing one
     *
     * @param  array  $personData
     * @return Person
     */
    public function insertIfNotExists(array $personData): Person
    {
        $person = $this->findByName($personData['name']);
        
        if (!$person) {
            $person = new  $this->model();
            $person->name = $personData['name'];
            $person->save();
        }
        
        return $person;
    }
    
    /**
     * Retrieves first Person by the given name
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}
