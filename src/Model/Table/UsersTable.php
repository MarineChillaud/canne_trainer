<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('users');
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('username')
            ->notEmptyString('password')
            ->notEmptyString('firstName')
            ->notEmptyString('lastName');

        return $validator;
    }
}
