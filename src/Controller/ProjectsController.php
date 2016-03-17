<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ProjectsController extends AppController {
    
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
    
    public function index($slug) {
        $client = $this->Projects->getClient($slug);
        
        $this->authorize($client['private']);
        
        $projects = $this->Projects
                ->find()
                ->contain('Clients')
                ->where(['Clients.slug' => $slug]);
        
        if (parent::getLevel() === 1 && $client['private']) {
            $this->loadModel('Permissions');
            $permitted = $this->Permissions->getPermittedProjects($this->Auth->user('idUser'));
            $projects->where(['idProject IN' => $permitted]);
        }
            
        $this->set('projects', $projects);
        $this->set('client', $client);
    }
    
    public function add($id) {
        $this->set('idClient', $id);
        $project = $this->Projects->newEntity();
        if($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if($result = $this->Projects->save($project)) {
                $this->Flash->success('New project has been saved.');
                parent::addLog('projects', $result->idProject, 'Create', "Project has been created. Name: $result->name");
                return $this->redirect(['action' => 'manage', $id]);
            }
            return $this->Flash->error('Unable to add project.');
        }
        
        $this->set('project', $project);
    }
    
    public function manage($id) {
        $projects = $this->Projects
                ->find()
                ->where(['idClient' => $id]);
        
        $this->set('projects', $projects);
        $this->set('idClient', $id);
    }
    
    public function edit($id) {
        $project = $this->Projects->get($id);
        if($this->request->is(['post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if($result = $this->Projects->save($project)) {
                $this->Flash->success('Project has been updated.');
                parent::addLog('projects', $id, 'Edit', "Project has been updated. Name: $result->name");
                return $this->redirect(['action' => 'manage', $result->idClient]);
            }
            return $this->Flash->error('Unable to update project.');
        }
        
        $this->set('project', $project);
    }
    
    public function delete($id) {
        //TODO: usuwanie wszystkiego wyżej !!!
        $this->request->allowMethod(['post', 'delete']);
        
        $this->loadModel('Projects');
        $project = $this->Projects->get($id);
        
        if ($this->Projects->delete($project)) {
            $this->Flash->success('The project has been deleted.');
            parent::addLog('projects', $id, 'Delete', 'Project has been deleted');
            return $this->redirect(['action' => 'manage', $project->idClient]);
        }
    }
    
    private function authorize($private) {
        if (parent::getLevel() === 0 && $private) {
            $this->Flash->error('This client is private');
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
    }
}