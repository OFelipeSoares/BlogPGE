<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\TestSuite\Constraint\Response\BodyNotEmpty;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config):void
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator //Na documentação esse método ": Validator" não existe
    {
        $validator
            ->notEmpty('Title')
            ->notEmpty('body');

        return $validator;
    }

}
