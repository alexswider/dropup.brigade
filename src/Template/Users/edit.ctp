<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password', ['value' => '']) ?>
        <?= $this->Form->input('role', [
            'options' => [
                'client' => 'Client', 
                'account' => 'Account',
                'creative' => 'Creative',
                'admin' => 'Admin'
            ]
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Save')); ?>
<?= $this->Form->end() ?>