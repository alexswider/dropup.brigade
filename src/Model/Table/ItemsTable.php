<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class ItemsTable extends Table {
    
    public function initialize(array $config) {
        $this->belongsTo('Projects', [
            'foreignKey' => 'idProject',
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
    
    public function getProject($slug) {
        $projects = TableRegistry::get('Projects');

        return $projects
                ->find()
                ->where(['Projects.slug' => $slug])
                ->contain(['Clients'])
                ->first();
    }

}