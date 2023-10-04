<html>
    <h1>Blog articles</h1>

    <?= $this->Html->link('Adicionar artigo', ['action' => 'add']) ?>
<table>
    <tr>
        <th>Id</th>
        <th>Titulo</th>
        <th>description</th>
        <th>Categoria</th>
        <th>Criado</th>
        <th>Ações</th>
    </tr>

    <?php

    use PhpParser\Node\Name;

 foreach ($articles as $article): ?>
        <tr>
            <td> <?= $article->id ?></td>
            <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
            </td>
            <td>
                <?= $this->Html->link($article->body, ['action' => 'view', $article->id]) ?>
            </td>
            <td>
                <?= $this->Html->link($article->category_id, ['action' => 'view', $article->id]) ?>
            </td>
            <td>
                <?= $article->created->format(DATE_RFC850)?>
            </td>
            <td>
                <?= $this->Form->postLink(
                    'Deletar',
                    ['action' => 'delete', $article->id],
                    ['confirm' => 'Tem certeza?'])

                ?>
                <?= $this->Html->link('Editar', ['action' => 'edit', $article->id] )?>
            </td>

        </tr>
    <?php endforeach; ?>

</table>
</html>
