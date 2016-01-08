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
    <?= $this->Form->create(null, ['url' => '/saveOrder/Videos/' . $idItem]) ?>
    <?= $this->Form->input('refpage', ['type' => 'hidden', 'value' => $this->request->here]) ?>
    <?= $this->Form->input('orderAsset', ['type' => 'hidden', 'id' => 'orderAsset']) ?>
    <?= $this->Form->button('Save order', ['id' => 'save-order']) ?>
    <?= $this->Form->end() ?>
        <div id="new-asset">
            <div id="dropzone">
                <p>Add new video</p>
            </div>
            <div id="info">
                <?= $this->Form->create() ?>
                <?= $this->Form->input('base64', ['type' => 'hidden']) ?>
                <?= $this->Form->input('description') ?>
                <div class="inline">
                    <?= $this->Form->input('width') ?>
                    <?= $this->Form->input('height') ?>
                </div>
                <?= $this->Form->button('Save') ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    <?php endif; ?>
    <?php foreach ($data as $key => $video) : ?>
        <div class="asset" id="<?= $video->idAsset ?>">
            <p class="order"><?= $key+1 ?></p>
            <video width="<?= $video->width ?>" height="<?= $video->height ?>" controls>
                <source src="<?= $this->Link->dropupLink($video->cdn, $video->videoPath)?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <p class="description"><?= $video->description ?></p>
        </div>
    <?php endforeach; ?>
</div>
