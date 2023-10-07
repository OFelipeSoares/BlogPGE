<?php

namespace App\Controller;

use App\Controller\AppController;

class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent :: initialize();

        $this->loadComponent('Flash');
    }
    public function index()
    {
        $this->set('articles', $this->Articles->find('all'));
        //$articles = $this->Articles->find('all');
        //$this->set(compact('articles'));
    }

    public function view($id /*= null*/)
    {
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post'))
        {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id = $this->Auth->user('id');
            //Opção alternativa
            //$newData = ['user_id' => $this->Auth->user('id')];
            //$article = $this->Articles->patchEntity($article, $newData);
            if ($this->Articles->save($article))
                {
                    $this->Flash->success(__('Seu artigo foi salvo.'));
                    return $this->redirect(['action' => 'index']);
                }
            $this->Flash->error(__('Não foi possivel adicionar seu artigo'));
        }
        $this->set('article', $article);

        // Criando a opção de Escolher uma categoria ao criar um artigo
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }

    public function edit($id = null)
    {
        $article = $this->Articles->get($id);
        if($this->request->is(['post', 'put']))
            {
                $this->Articles->patchEntity($article, $this->request->getData());
                if ($this->Articles->save($article))
                    {
                        $this->Flash->success(__('Seu artigo foi atualizado.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('Seu artigo não pôde ser atualizado.'));
            }
            $this->set('article', $article);
    }
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article))
            {
                $this->Flash->success(__('O artigo com id: {0} foi deletado.', h($id)));
                return $this->redirect(['action' => 'index']);
            }
    }

    public function isAuthorized($user)
    {
        // Todos os Usuários podem adicionar atigos
        if($this->request->getParam('action') === 'add')
        {
            return true;
        }

        //Apenas o proprietário do artigo pode editar ou excluir
        if (in_array($this->request->getParam('action'), ['edit', 'delete']))
        {
            $articleId = (int)$this->request->getParam('pass.0');
            if($this->Articles->isOwnedBy($articleId, $user['id']))
            {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

}
?>
