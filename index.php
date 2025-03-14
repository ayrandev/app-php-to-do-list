<?php
require "db.php"; //importa a conexao com o banco

//Adiciona nova tarefa
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty( $_POST["task"] )) {
    $stmt = $pdo->prepare("INSERT INTO tasks (task) VALUES (:task)");
    $stmt->execute([":task" => $_POST["task"]]);
    header("Location: index.php"); //Atualizar a pagina.
    exit;
}

//Remove tarafa
if (isset($_GET["done"])) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute([":id" => $_GET["done"]]);
    header("Location: index.php");
    exit;
}

//Buscar todas as tarefas
$tasks = $pdo->query("SELECT * FROM tasks")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>

        <form method="post">
            <input type="text" name="task" placeholder="Nova tarefa">
            <button type="submit">Adicionar</button>
        </form>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <?= htmlspecialchars($tasks["task"]) ?>
                    <a href="?done=<?= $task["id"] ?>">[Concluir]</a>
                </li>
                <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>