<?php

try {
    $con = new PDO('mysql:host=localhost;dbname=tasks', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Erro na conexão :" . $exception->getMessage();
}

?>
