<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ClientsTable extends Table {
    
    public function initialize(array $config) {
        $this->hasMany('Projects', [
            'foreignKey' => 'idClient',
        ]);
    }
    
    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name', 'A name is required')
            ->notEmpty('slug', 'A slug is required')
            ->add('slug', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Slug must be unique'
            ]);

        return $validator;
    }
}