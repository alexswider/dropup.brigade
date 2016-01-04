<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Aws\S3\S3Client;

class CronController extends AppController
{
    const KEY = 'AKIAJD6RN74BRAHETV3Q';
    const SECRET = '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';
    const BUCKET = 'dropup';
    const FOLDER = 'uploads';
    const ACCES_KEY = 'AE5HqedyZZGo3YQ';
    
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['start']);
    }
    
    public function index() {
        
    }
    
    public function start() {
        
        if ($this->Auth->user('type') != 'admin' && $this->request->query('acces_key') != self::ACCES_KEY) {
            $this->Flash->error(__('You do not have permission.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        
        $this->redirect('/cron');
        
        define("STDOUT", fopen(WWW_ROOT . 'log.txt', 'w'));
        $client = S3Client::factory([
            'credentials' => [
                'key'    => self::KEY,
                'secret' => self::SECRET,
            ]
        ]);
        $client->uploadDirectory(WWW_ROOT . '/uploads', self::BUCKET, self::FOLDER,[
                'debug' => true
        ]);
        
        $this->setAsCdn();
        $this->deleteUploads();
    }
    
    private function setAsCdn() {
        $this->loadModel("Assets");
        $this->loadModel("Media");
        $this->loadModel("Videos");
        
        $assetsQuery = $this->Assets->query();
        $assetsQuery->update()
            ->set(['cdn' => true])
            ->execute();
        
        $MediaQuery = $this->Media->query();
        $MediaQuery->update()
            ->set(['cdn' => true])
            ->execute();
        
        $ViedosQuery = $this->Videos->query();
        $ViedosQuery->update()
            ->set(['cdn' => true])
            ->execute();
    }
    
    private function deleteUploads() {
        $files = glob(WWW_ROOT . '/uploads/*'); 
        foreach($files as $file){ 
            $this->rrmdir($file);
            if(is_file($file)) {
                unlink($file); 
            }
        }
    }
    
    private function rrmdir($dir) { 
        if (is_dir($dir)) { 
            $objects = scandir($dir); 
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object); 
                } 
            } 
            reset($objects); 
            return rmdir($dir); 
        } 
    }
}
