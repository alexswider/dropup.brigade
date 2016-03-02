<?php

namespace App\Controller;

use App\Controller\AppController;

class LogsController extends AppController {
    
    public function show($entity = '', $idEntity = '', $order = 'ASC') {
        if (!empty($idEntity) && !empty($entity)) {
            $condition = ['entity' => $entity, 'idEntity' => $idEntity];
        } else if (!empty($entity)) {
            $condition = ['entity' => $entity];
        } else {
            $condition = [];
        }
        
        $logs = $this->Logs
                ->find()
                ->where($condition)
                ->order(['date' => $order]);
        
        $this->set('logs', $logs);
    }
    
}