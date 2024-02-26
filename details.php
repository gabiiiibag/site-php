<?php

session_start();
require __DIR__ . '/connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare('SELECT * FROM tasks WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        $data = [
            'task' => $task['name'],
            'description' => $task['description'],
            'date' => $task['date'],
        ];
    } else {
        $data = array(); 
    }
} else {
    $data = array(); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da tarefa</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo isset($data['task']) ? $data['task'] : 'Tarefa não encontrada'; ?></h1>
        </div>
        <div class="details">
            <dl>
                <dt>Descrição da tarefa:</dt>
                <dd><?php echo isset($data['description']) ? $data['description'] : 'Descrição não encontrada'; ?></dd>

                <dt>Data da tarefa:</dt>
                <dd><?php echo isset($data['date']) ? $data['date'] : 'Data não encontrada'; ?></dd>
            </dl>
        </div>
    </div>
</body>
</html>
