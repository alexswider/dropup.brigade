<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Aws\S3\S3Client;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class AssetsTable extends Table {
        
    const KEY = 'AKIAJD6RN74BRAHETV3Q';
    const SECRET = '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';
    const BUCKET = 'dropup';
    const ACCES_KEY = 'AE5HqedyZZGo3YQ';
    
    public function initialize(array $config) {
        $this->hasMany('Items', [
            'foreignKey' => 'idItem',
        ]);
    }
    
    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('width', 'A width is required')
            ->notEmpty('height', 'A height is required');
        
        return $validator;
    }
    
    public function getItem($slug) {
        $items = TableRegistry::get('Items');

        return $items
                ->find()
                ->where(['Items.slug' => $slug])
                ->contain(['Projects'])
                ->first();
    }
    
    public function getNextOrder($idItem) {
        $query = $this->query();
        
        return $query
                ->find('all')
                ->where(['idItem' => $idItem])
                ->count();
    }
    
    public function uploadFile($file, $destination) {
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
    
    public function uploadDir($dir, $destination) {
        $client = S3Client::factory([
            'credentials' => [
                'key'    => self::KEY,
                'secret' => self::SECRET,
            ] 
            
        ]);
        $client->uploadDirectory($dir, self::BUCKET, $destination);
    }
    
    public function deleteDir($dir) {
        $client = S3Client::factory([
            'credentials' => [
                'key'    => self::KEY,
                'secret' => self::SECRET,
            ] 
            
        ]);
        $client->deleteMatchingObjects(self::BUCKET, $dir);
    }
}