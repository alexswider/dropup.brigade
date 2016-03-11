<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class ProjectsTable extends Table {
    
    public function initialize(array $config) {
        $this->belongsTo('Clients', [
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
    
    public function getClient($slug) {
        $clients = TableRegistry::get('Clients');

        return $clients
                ->find()
                ->where(['slug' => $slug])
                ->first();
    }
}