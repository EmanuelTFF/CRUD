<?php
include 'include/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-arrow">&#8592; Voltar</a>
        <h1>Cadastro de Funcionário</h1>
        <form method="post" action="processa_cadastro.php">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br>

            <label for="dataContratacao">Data de Contratação:</label>
            <input type="date" name="dataContratacao" id="dataContratacao" required><br>

            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" id="cargo" required><br>

            <label for="tp_documento">Tipo de Documento:</label>
            <input type="text" name="tp_documento" id="tp_documento"><br>

            <label for="nr_documento">Número do Documento:</label>
            <input type="text" name="nr_documento" id="nr_documento"><br>

            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>
</html>
