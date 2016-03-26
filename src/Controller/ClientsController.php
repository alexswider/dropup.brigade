<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ClientsController extends AppController {
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
    
    public function isAuthorized($user) {
        if (parent::getLevel() > 2) {
            return true;
        }
        return false;
    }
    
    public function index() {
        $conditions = [];
        if(parent::getLevel() === 0) {
            $conditions['private'] = 0;
        }
        
        $clients = $this->Clients
                ->find()
                ->where($conditions)
                ->order(['name' => 'ASC']);
        
        $this->set('clients', $clients);
    }
    
    public function add() {
        $client = $this->Clients->newEntity();
        if($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            if($result = $this->Clients->save($client)) {
                $this->Flash->success('New client has been saved.');
                parent::addLog('clients', $result->idClient, 'Create', "Client has been created. Name: $result->name");
                return $this->redirect(['action' => 'index']);
            }
            return $this->Flash->error('Unable to add client.');
        }
        
        $this->set('client', $client);
    }
    
    public function manage() {
        $clients = $this->Clients->find();
        
        $this->set('clients', $clients);
    }
    
    public function edit($id = null) {
        $client = $this->Clients->get($id);
        if($this->request->is(['post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            if($result = $this->Clients->save($client)) {
                $this->Flash->success('Client has been updated.');
                parent::addLog('clients', $id, 'Edit', "Client has been updated. Name: $result->name");
                return $this->redirect(['action' => 'manage']);
            }
            return $this->Flash->error('Unable to update client.');
        }
        
        $this->set('client', $client);
    }
    
    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $this->deleteProjects($id);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success('The client has been deleted.');
            parent::addLog('clients', $id, 'Delete', 'Client has been deleted');
            return $this->redirect(['action' => 'manage']);
        }
    }
    
    private function deleteProjects($idClient) {
        $this->loadModel('Projects');
        $ids = $this->Projects
                ->find()
                ->select(['idProject'])
                ->where(['idClient' => $idClient]);
        
        foreach ($ids as $id) {
            $this->requestAction(['controller' => 'Projects', 'action' => 'delete'], ['pass' => [$id->idProject]]);
        }
    }
}