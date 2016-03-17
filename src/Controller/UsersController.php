<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController {
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }
    
    public function index() {
        $users = $this->Users->find();
        
        $this->set('users', $users);
    }
    
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }
    
    public function logout() {
        $this->Flash->success('You are logout successfully');
        return $this->redirect($this->Auth->logout());
    }
    
    public function add() {
        $user = $this->Users->newEntity();
        if($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if($result = $this->Users->save($user)) {
                $this->Flash->success('New user has been saved.');
                parent::addLog('users', $result->idUser, 'Create', "User has been created. Username: $result->username");
                return $this->redirect(['action' => 'index']);
            }
            return $this->Flash->error('Unable to add user.');
        }
        
        $this->set('user', $user);
    }
    
    public function edit($id = null) {
        $user = $this->Users->get($id);
        if($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if($result = $this->Users->save($user)) {
                $this->Flash->success('User has been updated.');
                parent::addLog('users', $id, 'Edit', "User has been updated. Username: $result->username");
                return $this->redirect(['action' => 'index']);
            }
            return $this->Flash->error('Unable to update user.');
        }
        
        $this->set('user', $user);
    }
    
    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
            parent::addLog('users', $id, 'Delete', 'User has been deleted');
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function permissions($id = null) {
        if($this->request->is(['post', 'put'])) {
            $this->savePermissions($id, $this->request->data);
        }
        
        $this->loadModel('Clients');
        $this->loadModel('Permissions');
        
        $user = $this->Users->get($id);
        $clients = $this->Clients
                ->find()
                ->contain('Projects')
                ->where(['private' => 1]);
        $permissions = $this->Permissions->getPermittedProjects($id);
        
        $this->set(compact('user', 'clients', 'permissions'));
    }
    
    private function savePermissions($idUser, $data) {
        $this->loadModel('Permissions');
        
        $this->Permissions->deleteAll(['idUser' => $idUser]);
        $ids = '';
        foreach ($data as $idProject => $perm) {
            if ($perm) {
                $ids .= "$idProject ";
                $this->Permissions
                        ->query()
                        ->insert(['idUser', 'idProject'])
                        ->values([
                            'idUser' => $idUser,
                            'idProject' => $idProject
                        ])
                        ->execute();
                }
        }
        $this->Flash->success('Permissions has been updated.');
        parent::addLog('users', $idUser, 'Permissions', "Permissions has been updated. Permissions: $ids");
    }
}