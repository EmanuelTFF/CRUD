<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Funcionários</title>
    <link rel="stylesheet" href="css/inicio.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciamento de Funcionários</h1>
        <div class="action-container">
            <a class="action-button" href="create.php">Cadastrar Funcionário</a>
            <a class="action-button" href="read.php">Ver Funcionários</a>
        </div>
        <div class="form-container">
            <form class="action-form" action="update.php" method="get">
                <label for="idUpdate">Atualizar Funcionário (ID):</label>
                <input type="number" id="idUpdate" name="id" required>
                <input class="form-btn update-btn" type="submit" value="Atualizar">
            </form>
            <form class="action-form" action="delete.php" method="post">
                <label for="idDelete">Deletar Funcionário (ID):</label>
                <input type="number" id="idDelete" name="funcionarioID" required>
                <input class="form-btn delete-btn" type="submit" value="Deletar">
            </form>
        </div>
    </div>
</body>
</html>
