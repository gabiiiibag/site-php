<?php

require __DIR__ . '/connect.php';
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

$con->query('USE tasks');
$stmt = $con->prepare('SELECT * FROM tasks');
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de tarefas</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        
        <div class="header">
            <h1>Gerenciador de tarefas</h1>
        </div>

        <div class="form">
            <form action="task.php" method="POST">
                <input type="hidden" name="insert" value="insert">
                <label for="nome_task">Tarefa</label>
                <input type="text" name="task" placeholder="Digite o nome da tarefa">
                <label for="description">Descrição</label>
                <input type="text" name="description" placeholder="Digite a descrição da tarefa">
                <label for="date">Data</label>
                <input type="date" name="date" placeholder="Digite a data da tarefa">
                <button type="submit">Adicionar</button>
            </form>
            
        </div>

        <div class="separator"></div>

        <div class="task">
            <ul>
                <?php foreach ($stmt->fetchAll() as $task): ?>
                    <li>
                        <a href='details.php?id=<?php echo $task['id']; ?>'><?php echo $task['name']; ?></a>
                        <button type='button' class='rmvBtn' onclick='deletar(<?php echo $task['id']; ?>)'>Remover</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        function deletar(id) {
            if (confirm('Deseja realmente remover a tarefa?')) {
                window.location = 'task.php?id=' + id;
            }
        }
    </script>
</body>
</html>
