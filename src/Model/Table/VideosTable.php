<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VideosTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('width')
            ->notEmpty('height');
            

        return $validator;
    }
}