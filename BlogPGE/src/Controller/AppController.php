<?php
declare(strict_types=1);
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Model\Entity\User;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        //parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        //Adicionado posteriormente para implementar a autorização de usuários

        $this->loadComponent('Auth',[
            'loginRedirect' => [
                'controller' => 'Articles',
                'action' => 'index'
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
            ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
    public function beforeFilter(EventInterface $event) //Essa função é responsável por dizer ao AuthComponent que não é necessário longin para visualizar o index e as views
    {
        $this->Auth->allow(['index', 'view', 'display']);
    }

    public function isAuthorized($user)
    {
        //Adimin pode acessar todas as ações
        if (isset($user['role']) && $user['role'] === 'admin')
        {
            return true;
        }
        //Bloqueia acesso por padrão
        return false;
    }


}
