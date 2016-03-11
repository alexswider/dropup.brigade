<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('jquery.friendurl.min') ?>

<script>
$(function(){
	$('#name').friendurl({id : 'slug'});
});
</script>
<?= $this->Form->create($client) ?>
    <fieldset>
        <legend><?= __('Add Client') ?></legend>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('slug', [
            'readonly' => 'readonly'
        ]) ?>
        <?= $this->Form->input('private', [
            'label' => 'Access',
            'options' => [
                '1' => 'private', 
                '0' => 'public',
            ]
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Add')); ?>
<?= $this->Form->end() ?>