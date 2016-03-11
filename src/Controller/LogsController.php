<?php

namespace App\Controller;

use App\Controller\AppController;

class LogsController extends AppController {
    
    public function show($entity = '', $idEntity = '', $order = 'ASC') {
        if (!empty($idEntity) && !empty($entity)) {
            $conditions = ['entity' => $entity, 'idEntity' => $idEntity];
        } else if (!empty($entity)) {
            $conditions = ['entity' => $entity];
        } else {
            $conditions = [];
        }
        
        $logs = $this->Logs->getLogs($conditions, $order);
        
        $this->set('logs', $logs);
    }
    
}