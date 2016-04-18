<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class AssetsTable extends Table {
    
    public function initialize(array $config) {
        $this->hasMany('Items', [
            'foreignKey' => 'idItem',
        ]);
    }
    
    public function getItem($slug) {
        $items = TableRegistry::get('Items');

        return $items
                ->find()
                ->where(['Items.slug' => $slug])
                ->contain(['Projects'])
                ->first();
    }
}