<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends table
{
    public function validationDefault(Validator $validator): Validator
    {
        return $validator
        ->notEmpty('email', 'Email é nescessário')
        ->email('email')
        ->notEmpty('password', 'Senha é necessária')
        ->notEmpty('role', 'inList', [
            'rule' => ['inList', ['admin', 'author']],
            'message' => 'Por favor informe uma função válida.'
        ]);
    }
}
