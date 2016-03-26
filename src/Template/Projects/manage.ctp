<?php $this->Html->addCrumb($client->name, ['action' => 'index', $client->slug]) ?>
<h3>
    Projects 
    <?= $userData['level'] > 3 ? $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'projects']) : '' ?>
</h3>
<table>
    <tr>
        <th>
            Id
        </th>
        <th>
            Name
        </th>
        <th>
            Slug
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php foreach ($projects as $project): ?>
    <tr>
        <td>
            <?= $project->idProject ?>
        </td>
        <td>
            <?= $project->name ?>
        </td>
        <td>
            <?= $project->slug ?>
        </td>
        <td>
            <?= $this->Html->link('logs', ['controller' => 'logs', 'action' => 'show', 'projects', $project->idProject]) ?>
            <span>|</span>
            <?= $this->Html->link('edit', ['action' => 'edit', $project->idProject]) ?>
            <span>|</span>
            <?= $this->Form->postLink(
                'delete',
                ['action' => 'delete', $project->idProject],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4">
            <?= $this->Html->link('Add new project', ['action' => 'add', $client->idClient]) ?>
        </td>
    </tr>
</table>