<?php

require __DIR__ . '/../vendor/autoload.php';

$database = new PDO('sqlite:../statistics');
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = $database->query('SELECT * FROM statistics ORDER BY day ASC');

?><!DOCTYPE html>
<html>
<head>
    <title>Todoist statistics</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $datum): ?>
                <tr>
                    <td><?= $datum['day'] ?></td>
                    <td><?= $datum['completed'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
