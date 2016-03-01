<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ClientsTable extends Table {
    
    public function initialize(array $config) {
        $this->hasMany('Projects', [
            'foreignKey' => 'projectsId',
            //'className' => 'Clients'
        ]);
    }
    
}