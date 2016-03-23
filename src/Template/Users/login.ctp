<?= $this->Form->create() ?>
<?= $this->Form->input('username') ?>
<?= $this->Form->input('password') ?>
<?= $this->Form->checkbox('rememberMe', ['id' => 'rememberMe', 'value' => 'rememberMe']); ?>
<?= $this->Form->label('rememberMe', 'Remember me for 7 days'); ?><br>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>