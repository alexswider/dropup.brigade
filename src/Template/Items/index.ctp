<?php $this->Html->addCrumb($project->client->name, ['controller' => 'projects', 'action' => 'index', $project->client->slug]) ?>
<?php $this->Html->addCrumb($project->name, ['action' => 'index', $project->slug]) ?>
<h3>
    Items
    <?= $userData['level'] > 1 ? $this->Html->link('Manage', ['action' => 'manage', $project->idProject]) : '' ?>
    <?= $userData['level'] > 3 ? ' | ' . $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'items']) : '' ?>
</h3>
<?php foreach ($itemsDate as $key => $date): ?>
<div class="date-group">
    <h4><?= gettype($date->date) == 'object' ? $date->date->format('l, M. j') : ''?></h4>
    <ul>
        <?php foreach ($items[$key] as $item): ?>
        <li>
            <?= $this->Html->link($item->name, ['controller' => 'assets', 'slug' => $item->slug]) ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endforeach; ?>