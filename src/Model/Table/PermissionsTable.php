<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PermissionsTable extends Table {
    
    public function initialize(array $config) {
        $this->belongsTo('Users', [
            'foreignKey' => 'idUser',
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'idProject',
        ]);
    }
    
    public function getPermittedProjects($idUser) {
        $query = $this->query();
        
        return $query
                ->find('all')
                ->where(['idUser' => $idUser])
                ->extract('idProject')
                ->toArray();
    }
    
}
