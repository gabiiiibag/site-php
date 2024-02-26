<?php

require __DIR__ . '/connect.php';
session_start();
$con->query('USE tasks');

if (isset($_POST['task'])) {
    if ($_POST['task'] != "") {
        $data = [
            'task' => $_POST['task'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
        ];

        $stmt = $con->prepare('INSERT INTO tasks (name, description, date) VALUES(:name, :description, :date)');
        $stmt->bindParam(':name', $data['task']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':date', $data['date']);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Tarefa adicionada com sucesso!";
            header('location:  index.php');
            exit();
        } else {
            $_SESSION['error'] = "Erro ao adicionar tarefa!";
            header('location:  index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Digite o nome da tarefa!";
        header('location:  index.php');
        exit();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare('DELETE FROM tasks WHERE id = :id');
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tarefa excluída com sucesso!";
        header('location:  index.php');
        exit();
    } else {
        $_SESSION['error'] = "Erro ao excluir tarefa!";
        header('location:  index.php');
        exit();
    }
}
?>
