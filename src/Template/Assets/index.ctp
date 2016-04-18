<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js') ?>
<?= $this->Html->script('uploader') ?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css') ?>
<?= $this->Html->css('uploader') ?>

<?php $this->Html->addCrumb($client->name, ['controller' => 'projects', 'action' => 'index', $client->slug]) ?>
<?php $this->Html->addCrumb($item->project->name, ['controller' => 'items', 'action' => 'index', $item->project->slug]) ?>
<?php $this->Html->addCrumb($item->name, ['action' => 'index', $item->slug]) ?>

<?= $this->Form->create($asset, ['class' => 'dropzone', 'id' => 'dropzone' , 'url' => ['action' => 'add', $item->idItem]]) ?>
    <fieldset>
        <?= $this->Form->input('description') ?>
        <?= $this->Form->input('type',['type' => 'text','disabled' => 'disabled']) ?>
        <?= $this->Form->input('width') ?>
        <?= $this->Form->input('height') ?>
    </fieldset>
<?= $this->Form->button(__('Add')); ?>
<?= $this->Form->end() ?>