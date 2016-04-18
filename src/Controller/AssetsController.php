<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class AssetsController extends AppController {
    
    const KEY = 'AKIAJD6RN74BRAHETV3Q';
    const SECRET = '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';
    const BUCKET = 'dropup_dev';
    const FOLDER = 'test';
    const ACCES_KEY = 'AE5HqedyZZGo3YQ';
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
    
    public function index($slug) {
        $this->loadModel('Clients');
        $asset = $this->Assets->newEntity();
        
        $item = $this->Assets->getItem($slug);
        $client = $this->Clients->get($item->project->idClient);
        $this->authorize($item, $client);
        
        $this->set('asset', $asset);
        $this->set('item', $item);
        $this->set('client', $client);
    }
    
    public function add($id) {
        $this->redirect($this->request->referer());
    }


    private function authorize($item, $client) {
        if(parent::getLevel() >= $item->access) {
            if(parent::getLevel() != 1) {
                return true;
            }
            $this->loadModel('Permissions');
            $idUser = $this->Auth->user('idUser');
            if(!$this->Permissions->exists(['idUser' => $idUser, 'idProject' => $item->project->idProject]) && $client->private) {
                $this->Flash->error('You haven\'t permission to this project');
                return $this->redirect(['controller' => 'Clients']);
            }
            return true;
        }
        $this->Flash->error('You haven\'t permission to this project');
        return $this->redirect(['controller' => 'Clients']);
    }
   
}