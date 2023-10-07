<h1>Crie seu usuário</h1>
<div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor, informe seu usuário e senha.') ?></legend>
        <?=  $this->Form->input('email')?>
        <?=  $this->Form->input('password'/*,['type'=>'password']*/)?>
    </fieldset>
    <?= $this->Form->button(__('Login'))?>
    <?= $this->Form->end()?>
</div>
