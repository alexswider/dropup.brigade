<h3>
    Clients 
    <?= $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'clients']) ?>
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
            Access
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php foreach ($clients as $client): ?>
    <tr>
        <td>
            <?= $client->idClient ?>
        </td>
        <td>
            <?= $client->name ?>
        </td>
        <td>
            <?= $client->slug ?>
        </td>
        <td>
            <?= $client->private ? 'Private' : 'Public' ?>
        </td>
        <td>
            <?= $this->Html->link('logs', ['controller' => 'logs', 'action' => 'show', 'clients', $client->idClient]) ?>
            <span>|</span>
            <?= $this->Html->link('edit', ['action' => 'edit', $client->idClient]) ?>
            <span>|</span>
            <?= $this->Form->postLink(
                'delete',
                ['action' => 'delete', $client->idClient],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5">
            <?= $this->Html->link('Add new client', ['action' => 'add']) ?>
        </td>
    </tr>
</table>