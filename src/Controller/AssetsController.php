<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Aws\S3\S3Client;

class AssetsController extends AppController {
    
    const KEY = 'AKIAJD6RN74BRAHETV3Q';
    const SECRET = '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';
    const BUCKET = 'dropup';
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
        
        $assets = $this->Assets
                ->find()
                ->where(['idItem' => $item->idItem])
                ->order(['orderAsset' => 'ASC']);
        
        $this->set('assets', $assets);
        $this->set('asset', $asset);
        $this->set('item', $item);
        $this->set('client', $client);
    }
    
    public function add($id) {
        $this->request->allowMethod('post');
        
        switch($this->request->data('type')) {
            case 'video':
                $this->saveVideo($id, $this->request->data('file')[0]);
                break;
            case 'image':
                foreach($this->request->data('file') as $file) {
                    $this->saveImage($id, $file);
                }
                break;
            case 'supergif':
                $this->saveVideo($id);
                break;
            case 'banner':
                $this->saveVideo($id);
                break;
        }
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
    
    private function saveVideo($id, $file) {
        $asset = $this->Assets->newEntity($this->request->data);
        $asset->idItem = $id;
        $asset->size = $file['size'];
        $asset->orderAsset = $this->Assets->getNextOrder($id);
        
        $asset->path = DS . self::FOLDER . DS . $id . DS . uniqid(). '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $this->uploadFile($file, $asset->path);
        
        if($result = $this->Assets->save($asset)) {
            $this->Flash->success('New asset has been saved.');
            parent::addLog('assets', $result->idAsset, 'Create', "Asset has been created");
        } else {
            return $this->Flash->error('Unable to add asset.');
        }
        
        return $asset;
    }
    
    private function saveImage($id, $file) {
        $asset = $this->Assets->newEntity($this->request->data);
        $asset->idItem = $id;
        $asset->size = $file['size'];
        $dimensions = getimagesize($file['tmp_name']);
        $asset->width = $dimensions[0];
        $asset->height = $dimensions[1];
        $asset->orderAsset = $this->Assets->getNextOrder($id);
        
        $asset->path = DS . self::FOLDER . DS . $id . DS . uniqid(). '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $this->uploadFile($file, $asset->path);
        
        if($result = $this->Assets->save($asset)) {
            $this->Flash->success('New asset has been saved.');
            parent::addLog('assets', $result->idAsset, 'Create', "Asset has been created");
        } else {
            return $this->Flash->error('Unable to add asset.');
        }
    }
    
    private function uploadFile($file, $destination) {
        $client = S3Client::factory([
            'credentials' => [
                'key'    => self::KEY,
                'secret' => self::SECRET,
            ] 
            
        ]);
        $result = $client->putObject([
            'Bucket'     => self::BUCKET,
            'Key'        => $destination,
            'SourceFile' => $file['tmp_name'],
        ]);
    }
   
}