<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('jquery.friendurl.min') ?>

<script>
$(function(){
	$('#name').friendurl({id : 'slug'});
});
</script>
<?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('Edit Project') ?></legend>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('slug', [
            'readonly' => 'readonly'
        ]) ?>
        <?= $this->Form->hidden('idClient') ?>
   </fieldset>
<?= $this->Form->button(__('Edit')); ?>
<?= $this->Form->end() ?>