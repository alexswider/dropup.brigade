<?php if($userData['level'] > 1): ?>
<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>
<?= $this->Html->script('jquery-ui.min') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js') ?>
<?= $this->Html->script('uploader') ?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css') ?>
<?= $this->Html->css('uploader') ?>
<?php endif; ?>

<?php $this->Html->addCrumb($client->name, ['controller' => 'projects', 'action' => 'index', $client->slug]) ?>
<?php $this->Html->addCrumb($item->project->name, ['controller' => 'items', 'action' => 'index', $item->project->slug]) ?>
<?php $this->Html->addCrumb($item->name, ['action' => 'index', $item->slug]) ?>
<h3>
    Assets 
    <?= $userData['level'] > 3 ? $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'assets']) : '' ?>
</h3>
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
<?= $this->Form->create(null, ['url' => ['action' => 'saveOrder', $item->idItem]]) ?>
<?= $this->Form->input('orderAsset', ['type' => 'hidden', 'id' => 'orderAsset']) ?>
<?= $this->Form->button('Save order', ['id' => 'save-order']) ?>
<?= $this->Form->end() ?>
<?php endif; ?>

<div id="assets">
    <?php foreach($assets as $key => $asset): ?>
    <div class="asset" id="<?= $asset->idAsset ?>">
        <div class="order">
            <?= $key+1 ?>
            <a class="show-meta">▼</a>
            <div class="meta">
                <p><a href="#<?= $asset->idAsset ?>">ANCHOR</a></p>
                <?= $userData['level'] > 3 ? '<p>' . $this->Html->link('LOGS', ['controller' => 'logs', 'action' => 'show', 'assets', $asset->idAsset]) . '</p>' : '' ?>
                <p><?= $asset->width ?> x <?= $asset->height ?></p>
                <p><?= $this->Asset->formatBytes($asset->size) ?></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <?= $this->Asset->display($asset); ?>
        <p>
            <?= $asset->description ?>
        </p>
    </div>
    <?php endforeach; ?>
</div>
