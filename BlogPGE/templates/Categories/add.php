<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var \Cake\Collection\CollectionInterface|string[] $parentCategories
 */

use App\Model\Entity\Category;

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories form content">
            <?= $this->Form->create($category) ?>
            <fieldset>
                <legend><?= __('Add Category') ?></legend>
                <?php
                    // --  Documentação manda alterar de Control para input. Mas funcionou com control.
                    //echo $this->Form->input('parent_id', ['options' => $parentCategories, 'empty' => 'No parent category']);
                    echo $this->Form->control('parent_id', ['options' => $parentCategories, 'empty' => 'No parent category']);
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
