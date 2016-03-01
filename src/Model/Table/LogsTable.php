<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class LogsTable extends Table {
    
    public function add($entity, $idEntity, $idUser, $type, $message = '') {
        $query = $this->query();
        $query->insert(['entity', 'idEntity', 'idUser', 'type', 'message'])
                ->values([
                    'entity' => $entity,
                    'idEntity' => $idEntity,
                    'idUser' => $idUser,
                    'type' => $type,
                    'message' => $message
                ])
                ->execute();
    }
}