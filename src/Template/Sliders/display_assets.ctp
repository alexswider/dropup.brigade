<?php $this->Html->addCrumb($client->name, '/' . $client->urlName) ?>
<?php $this->Html->addCrumb($project->name, '/' . $client->urlName . '/' . $project->urlName) ?>
<?php $this->Html->addCrumb($item->name, '/' . $client->urlName . '/' . $project->urlName . '/' . $item->idItem) ?>

<?php if ($isAdmin): ?>
<?= $this->Html->script('jquery-2.1.4.min') ?>
<?= $this->Html->script('jquery-ui.min') ?>
<?= $this->Html->script('drop') ?>

<script>
    $(document).ready(function() {
        $('#assets').sortable();
        $('.asset').mousedown(function() {
            $('#save-order').show();
        });
    });
</script>
<?php endif; ?>
<div id="assets">
    <?php if ($isAdmin): ?>
    <?= $this->Form->create(null, ['url' => '/saveOrder/Assets/' . $idItem]) ?>
    <?= $this->Form->input('refpage', ['type' => 'hidden', 'value' => $this->request->here]) ?>
    <?= $this->Form->input('orderAsset', ['type' => 'hidden', 'id' => 'orderAsset']) ?>
    <?= $this->Form->button('Save order', ['id' => 'save-order']) ?>
    <?= $this->Form->end() ?>
        <div id="new-asset">
            <div id="dropzone">
                <p>Add new asset</p>
            </div>
            <div id="info">
                <?= $this->Form->create(null, ["id" => "image-form"]) ?>
                <?= $this->Form->input('images[0]', ['type' => 'hidden']) ?>
                <?= $this->Form->input('description') ?>
                <?= $this->Form->button('Save') ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    <?php endif; ?>
    <?php foreach ($data as $key => $asset): ?>
    <div class="asset" id="<?= $asset->idAsset ?>">
        <p class="order">
            <?= $key+1 ?>
            <?php if ($isAdmin): ?>
                <a href="/deleteAsset/<?= $item->idItem . '/' . $asset->idAsset?>"><i class="fa fa-trash"></i></a>
            <?php endif; ?>
        </p>
        <img src="<?= $this->Link->dropupLink($asset->cdn, $asset->imagePath) ?>">
        <p><?= $asset->description ?></p>
    </div>
    <?php endforeach; ?>
</div>