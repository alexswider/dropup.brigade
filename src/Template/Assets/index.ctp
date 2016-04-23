<?php if($userData['level'] > 1): ?>
<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js') ?>
<?= $this->Html->script('uploader') ?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css') ?>
<?= $this->Html->css('uploader') ?>
<?php endif; ?>

<?php $this->Html->addCrumb($client->name, ['controller' => 'projects', 'action' => 'index', $client->slug]) ?>
<?php $this->Html->addCrumb($item->project->name, ['controller' => 'items', 'action' => 'index', $item->project->slug]) ?>
<?php $this->Html->addCrumb($item->name, ['action' => 'index', $item->slug]) ?>

<?php if($userData['level'] > 1): ?>
<?= $this->Form->create($asset, ['class' => 'dropzone', 'id' => 'dropzone' , 'url' => ['action' => 'add', $item->idItem]]) ?>
    <fieldset>
        <?= $this->Form->input('description') ?>
        <?= $this->Form->input('type', ['type' => 'text', 'readonly' => 'readonly']) ?>
        <?= $this->Form->input('width') ?>
        <?= $this->Form->input('height') ?>
    </fieldset>
<button>Add</button>
<?= $this->Form->end() ?>
<?php endif; ?>

<div id="assets">
    <?php foreach($assets as $key => $asset): ?>
    <div class="asset" id="<?= $asset->idAsset ?>">
        <p class="order">
            <?= $key+1 ?>
        </p>
        <?= $this->Asset->display($asset); ?>
        <p>
            <?= $asset->description ?>
        </p>
    </div>
    <?php endforeach; ?>
</div>
