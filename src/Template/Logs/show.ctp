<h3>Logs</h3>
<table>
    <tr>
        <th>
            Id
        </th>
        <th>
            Date
        </th>
        <th>
            Entity
        </th>
        <th>
            IdEntity
        </th>
        <th>
            User
        </th>
        <th>
            Type
        </th>
        <th>
            Message
        </th>
    </tr>
    <?php foreach ($logs as $log): ?>
    <tr>
        <td>
            <?= $log->idLog ?>
        </td>
        <td>
            <?= $log->date->format('Y-m-d H:i:s') ?>
        </td>
        <td>
            <?= $log->entity ?>
        </td>
        <td>
            <?= $log->idEntity ?>
        </td>
        <td>
            <?= $log->user->username ?>
        </td>
        <td>
            <?= $log->type ?>
        </td>
        <td>
            <?= $log->message ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>