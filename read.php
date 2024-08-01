<?php
include 'include/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="css/read.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-arrow">&#8592; Voltar</a>
        <h1>Lista de Funcionários</h1>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data de Contratação</th>
                        <th>Cargo</th>
                        <th>Tipo de Documento</th>
                        <th>Número do Documento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT f.idFuncionario, f.nome, f.dataContratacao, f.cargo, d.tp_documento, d.nr_documento
                            FROM funcionario f
                            LEFT JOIN documento_funcionario d ON f.idFuncionario = d.idFuncionario";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['idFuncionario']}</td>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['dataContratacao']}</td>
                                    <td>{$row['cargo']}</td>
                                    <td>{$row['tp_documento']}</td>
                                    <td>{$row['nr_documento']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum funcionário cadastrado.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
