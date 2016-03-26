<?php $this->Html->addCrumb($client->name, ['action' => 'index', $client->slug]) ?>
<h3>
    Projects
    <?= $userData['level'] > 2 ? $this->Html->link('Manage', ['action' => 'manage', $client['idClient']]) : '' ?>
    <?= $userData['level'] > 3 ? ' | ' . $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'projects']) : '' ?>
</h3>
<ul>
    <?php foreach ($projects as $project): ?>
    <li>
        <?= $this->Html->link($project->name, ['controller' => 'items', 'slug' => $project->slug]) ?>
    </li>
    <?php endforeach; ?>
</ul>