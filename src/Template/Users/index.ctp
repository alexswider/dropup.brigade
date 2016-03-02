<h3>Users <?= $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'users']) ?></h3>
<table>
    <tr>
        <th>
            Id
        </th>
        <th>
            Username
        </th>
        <th>
            Role
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td>
            <?= $user->idUser ?>
        </td>
        <td>
            <?= $user->username ?>
        </td>
        <td>
            <?= $user->role ?>
        </td>
        <td>
            <?= $this->Html->link('logs', ['controller' => 'logs', 'action' => 'show', 'users', $user->idUser]) ?>
            <span>|</span>
            <?= $this->Html->link('edit', ['action' => 'edit', $user->idUser]) ?>
            <?php if ($user->role !== 'admin'): ?>
            <span>|</span>
            <?= $this->Html->link('set permissions', ['action' => 'permissions', $user->idUser]) ?>
            <?php endif; ?>
            <span>|</span>
            <?= $this->Form->postLink(
                'delete',
                ['action' => 'delete', $user->idUser],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4">
            <?= $this->Html->link('Add new user', ['action' => 'add']) ?>
        </td>
    </tr>
</table>