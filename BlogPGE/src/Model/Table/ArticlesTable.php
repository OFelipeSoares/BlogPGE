<?php

namespace App\Model\Table;

use Cake\Core\Retry\RetryStrategyInterface;
use Cake\ORM\Table;
use Cake\TestSuite\Constraint\Response\BodyNotEmpty;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config):void
    {
        $this->addBehavior('Timestamp');
        // As linhas abaixão farão o relacionamento dos artigos com suas respectivas categorias
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);
    }

    public function validationDefault(Validator $validator): Validator //Na documentação esse método ": Validator" não existe
    {
        $validator
            ->notEmpty('Title')
            ->notEmpty('body');


        return $validator;
    }

    public function isOwnedBy($articleId, $userId)
    {
        return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    }

}
