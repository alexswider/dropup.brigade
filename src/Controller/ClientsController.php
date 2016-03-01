<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ClientsController extends AppController {
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
    
    public function index() {
        
    }
}