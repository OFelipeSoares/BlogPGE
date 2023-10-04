<h1>Add Article</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body' , ['rows' => '3']);
    echo $this->Form->control('category_id'); // A documentação manda colocar Input. Mas Control ficou melhor
    echo $this->Form->button(__('Salvar artigo'));
    echo $this->Form->end();
?>
