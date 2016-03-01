<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('role', [
            'options' => [
                'client' => 'Client', 
                'account' => 'Account',
                'creative' => 'Creative',
                'admin' => 'Admin'
            ]
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Add')); ?>
<?= $this->Form->end() ?>