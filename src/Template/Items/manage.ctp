<?php $this->Html->addCrumb($project->client->name, ['controller' => 'projects', 'action' => 'index', $project->client->slug]) ?>
<?php $this->Html->addCrumb($project->name, ['action' => 'index', $project->slug]) ?>
<h3>
    Items 
    <?= $userData['level'] > 3 ? $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'items']) : '' ?>
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
            Date
        </th>
        <th>
            Access
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <?= $item->idItem ?>
        </td>
        <td>
            <?= $item->name ?>
        </td>
        <td>
            <?= $item->slug ?>
        </td>
        <td>
            <?= $item->date->i18nFormat('yyyy-MM-dd'); ?>
        </td>
        <td>
            <?= $this->Access->display($item->access) ?>
        </td>
        <td>
            <?= $this->Html->link('logs', ['controller' => 'logs', 'action' => 'show', 'items', $item->idItem]) ?>
            <span>|</span>
            <?= $this->Html->link('edit', ['action' => 'edit', $item->idItem]) ?>
            <span>|</span>
            <?= $this->Form->postLink(
                'delete',
                ['action' => 'delete', $item->idItem],
                ['confirm' => 'Are you sure?'])
            ?>
            <?php if ($item->access > 0): ?>
            <span>|</span>
            <?= $this->Html->link('publish', ['action' => 'publish', $item->idItem]) ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4">
            <?= $this->Html->link('Add new item', ['action' => 'add', $project->idProject]) ?>
        </td>
    </tr>
</table>