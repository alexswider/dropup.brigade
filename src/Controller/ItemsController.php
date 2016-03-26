<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ItemsController extends AppController {
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
    
    public function isAuthorized($user) {
        if (parent::getLevel() > 1) {
            return true;
        }
    }
    
    public function index($slug) {
        $project = $this->Items->getProject($slug);
        $this->authorize($project);
        
        $itemsDate = $this->Items
                ->find()
                ->select('date')
                ->where(['idProject' => $project->idProject, 'access <=' => parent::getLevel()])
                ->order(['date' => 'DESC'])
                ->group('date');
        
        foreach ($itemsDate as $key => $date) {
            $items[$key] = $this->Items
                ->find('All')
                ->where(['idProject' => $project->idProject, 'date' => $date->date, 'access <=' => parent::getLevel()])
                ->order(['name' => 'ASC']);
        }
        
        $this->set('project', $project);
        $this->set('itemsDate', $itemsDate);
        if(!empty($items)) {
            $this->set('items', $items);
        }
    }
    
    public function manage($id) {
        $this->loadModel('Projects');
        $items = $this->Items
                ->find()
                ->where(['idProject' => $id, 'access <=' => parent::getLevel()]);
        
        $project = $this->Projects
                ->find()
                ->where(['idProject' => $id])
                ->contain(['Clients'])
                ->first();
        
        $this->set('items', $items);
        $this->set('project', $project);
    }
    
    public function add($id) {
        $this->set('idProject', $id);
        $item = $this->Items->newEntity();
        if($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if($result = $this->Items->save($item)) {
                $this->Flash->success('New item has been saved.');
                parent::addLog('items', $result->idItem, 'Create', "Item has been created. Name: $result->name");
                return $this->redirect(['action' => 'manage', $id]);
            }
            return $this->Flash->error('Unable to add item.');
        }
        
        $this->set('item', $item);
    }
    
    public function edit($id) {
        $item = $this->Items->get($id);
        if($this->request->is(['post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if($result = $this->Items->save($item)) {
                $this->Flash->success('Item has been updated.');
                parent::addLog('items', $id, 'Edit', "Item has been updated. Name: $result->name");
                return $this->redirect(['action' => 'manage', $result->idProject]);
            }
            return $this->Flash->error('Unable to update item.');
        }
        
        $this->set('item', $item);
    }
    
    public function delete($id) {
        //TODO: usuwanie wszystkiego wyżej !!!
        $this->request->allowMethod(['post', 'delete']);
        
        $item = $this->Items->get($id);
        
        if ($this->Items->delete($item)) {
            $this->Flash->success('The item has been deleted.');
            parent::addLog('items', $id, 'Delete', 'Item has been deleted');
            return $this->redirect(['action' => 'manage', $item->idProject]);
        }
    }
    
    public function publish($id) {
        $item = $this->Items->get($id);
        
        if($item->access > parent::getLevel() || $item->access === 0) {
            $this->Flash->error('Unable to publish item.');
            return $this->redirect($this->referer());
        }
        
        $query = $this->Items->query();
        $query->update()
            ->set(['access' => --$item->access])
            ->where(['idItem' => $id])
            ->execute();
        
        parent::addLog('items', $id, 'Publish', "Item has been published for: $item->access");
        $this->Flash->success("Item has been published for: $item->access");
        return $this->redirect($this->referer());
    }
    
    private function authorize($project) {
        if(parent::getLevel() > 1) {
            return true;
        }
        $this->loadModel('Permissions');
        $idUser = $this->Auth->user('idUser');
        if(!$this->Permissions->exists(['idUser' => $idUser, 'idProject' => $project->idProject]) && $project->client->private) {
            $this->Flash->error('You haven\'t permission to this project');
            return $this->redirect(['controller' => 'Clients']);
        }
    }
}
