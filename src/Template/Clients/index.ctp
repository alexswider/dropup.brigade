<h3>
    Clients
    <?= $userData['level'] > 2 ? $this->Html->link('Manage', ['action' => 'manage']) : '' ?>
    <?= $userData['level'] > 3 ? ' | ' . $this->Html->link('Logs', ['controller' => 'logs', 'action' => 'show', 'clients']) : '' ?>
</h3>
<ul>
    <?php foreach ($clients as $client): ?>
    <li>
        <?= $this->Html->link($client->name, ['controller' => 'projects', 'slug' => $client->slug]) ?>
    </li>
    <?php endforeach; ?>
</ul>