<div class="players form">
    <?= $this->Form->create($player) ?>
    <fieldset>
        <legend><?= __('Ajouter un utilisateur') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Ajouter')); ?>
    <?= $this->Form->end() ?>
</div>