<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('jquery.friendurl.min') ?>

<script>
$(function(){
	$('#name').friendurl({id : 'slug'});
});
</script>
<?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('Add Project') ?></legend>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('slug', [
            'readonly' => 'readonly'
        ]) ?>
        <?= $this->Form->hidden('idClient', ['value' => $idClient]) ?>
   </fieldset>
<?= $this->Form->button(__('Add')); ?>
<?= $this->Form->end() ?>