<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Funcionários</h1>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data de Contratação</th>
                        <th>Cargo</th>
                        <th>Documento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'include/db.php';
                    $sql = "SELECT f.idFuncionario, f.nome, f.dataContratacao, f.cargo, d.tp_documento, d.nr_documento 
                            FROM funcionario f 
                            LEFT JOIN documento_funcionario d ON f.idFuncionario = d.idFuncionario";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['idFuncionario']}</td>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['dataContratacao']}</td>
                                    <td>{$row['cargo']}</td>";
                            if ($row['tp_documento'] && $row['nr_documento']) {
                                echo "<td>{$row['tp_documento']} - {$row['nr_documento']}</td>";
                            } else {
                                echo "<td>N/A</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum funcionário cadastrado.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <a class="btn" href="create.php">Adicionar Novo Funcionário</a>
    </div>
</body>
</html>
