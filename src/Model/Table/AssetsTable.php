<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class AssetsTable extends Table {
    
    public function initialize(array $config) {
        $this->hasMany('Items', [
            'foreignKey' => 'idItem',
        ]);
    }
    
    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('width', 'A width is required')
            ->notEmpty('height', 'A height is required');
        
        return $validator;
    }
    
    public function getItem($slug) {
        $items = TableRegistry::get('Items');

        return $items
                ->find()
                ->where(['Items.slug' => $slug])
                ->contain(['Projects'])
                ->first();
    }
    
    public function getNextOrder($idItem) {
        $query = $this->query();
        
        return $query
                ->find('all')
                ->where(['idItem' => $idItem])
                ->count();
    }
}