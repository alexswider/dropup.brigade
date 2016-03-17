<?= $this->Html->script('http://code.jquery.com/jquery-2.2.1.min.js') ?>

<script>
$(function () {
    //  Accordion Panels
    $(".accordion div").show();
    setTimeout("$('.accordion div').slideToggle('slow');", 500);
    $(".accordion h3").click(function () {
        $(this).next(".pane").slideToggle("slow").siblings(".pane:visible").slideUp("slow");
        $(this).toggleClass("current");
        $(this).siblings("h3").removeClass("current");
    });
});
</script>

<p>Set permission for user <strong><?= $user->username ?></strong>:</p>
<?= $this->Form->create() ?>
    <div class="accordion">
        <?php foreach ($clients as $client): ?>
        <h3><?= $client->name ?></h3>
        <div class="pane">
            <?php foreach ($client->projects as $project): ?>
            <?= $this->Form->checkbox($project->idProject, ['id' => $project->idProject, in_array($project->idProject, $permissions) ? 'checked' : '']) ?>
            <?= $this->Form->label($project->idProject, $project->name) ?><br>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?= $this->Form->button('Save') ?>
<?= $this->Form->end() ?>