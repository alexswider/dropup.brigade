<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('jquery.friendurl.min') ?>
<script>
$(function(){
    $('#name').keydown(function() { 
        setTimeout(updateSlug, 250);
    });
    $('.date > select').change(function() { 
        updateSlug();
    });
    $('#name').friendurl({id : 'slugh'});
});
function updateSlug() {
    var date = '';
    date += $('.date > select:nth-child(2)').val() + '-';
    date += $('.date > select:nth-child(3)').val() + '-';
    date += $('.date > select:nth-child(4)').val() + '-';
    $('#slug').val(date + $('#slugh').val());
}
</script>
<?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('Edit Item') ?></legend>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('date') ?>
        <?= $this->Form->input('slugh', ['type' => 'hidden']) ?>
        <?= $this->Form->input('slug', ['value' => $item->slug]) ?>
        <?= $this->Form->input('access', [
            'options' => $this->Access->options($userData['level'])
        ]) ?>
        <?= $this->Form->hidden('idProject') ?>
   </fieldset>
<?= $this->Form->button(__('Save')); ?>
<?= $this->Form->end() ?>