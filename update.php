<?php
include 'include/db.php';

$alertMessage = "";
$alertClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e valida os dados do POST
    $idFuncionario = isset($_POST['idFuncionario']) ? intval($_POST['idFuncionario']) : null;
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
    $dataContratacao = isset($_POST['dataContratacao']) ? trim($_POST['dataContratacao']) : null;
    $cargo = isset($_POST['cargo']) ? trim($_POST['cargo']) : null;
    $tp_documento = isset($_POST['tp_documento']) ? trim($_POST['tp_documento']) : null;
    $nr_documento = isset($_POST['nr_documento']) ? trim($_POST['nr_documento']) : null;

    // Verifica se todos os campos obrigatórios estão presentes
    if ($idFuncionario && $nome && $dataContratacao && $cargo) {
        // Atualiza o funcionário
        $sqlFuncionario = "UPDATE funcionario SET nome=?, dataContratacao=?, cargo=? WHERE idFuncionario=?";
        $stmt = $conn->prepare($sqlFuncionario);
        $stmt->bind_param("sssi", $nome, $dataContratacao, $cargo, $idFuncionario);

        if ($stmt->execute()) {
            // Atualiza o documento se os campos estiverem presentes
            if ($tp_documento && $nr_documento) {
                $sqlDocumento = "UPDATE documento_funcionario SET tp_documento=?, nr_documento=? WHERE idFuncionario=?";
                $stmt = $conn->prepare($sqlDocumento);
                $stmt->bind_param("ssi", $tp_documento, $nr_documento, $idFuncionario);

                if ($stmt->execute()) {
                    $alertMessage = "Funcionário e documento atualizados com sucesso.";
                    $alertClass = "success";
                } else {
                    $alertMessage = "Erro ao atualizar documento: " . $stmt->error;
                    $alertClass = "error";
                }
            } else {
                $alertMessage = "Funcionário atualizado com sucesso. Campos do documento não fornecidos, documento não atualizado.";
                $alertClass = "success";
            }
        } else {
            $alertMessage = "Erro ao atualizar funcionário: " . $stmt->error;
            $alertClass = "error";
        }
        $stmt->close();
    } else {
        $alertMessage = "Todos os campos obrigatórios para o funcionário são necessários.";
        $alertClass = "error";
    }

    // Consulta para obter os dados do funcionário e documento após atualização
    $idFuncionario = intval($_POST['idFuncionario']);
} elseif (isset($_GET['id'])) {
    $idFuncionario = intval($_GET['id']);
    if (!$idFuncionario) {
        echo "ID do funcionário não fornecido.";
        exit;
    }
} else {
    echo "ID do funcionário não fornecido.";
    exit;
}

// Consulta para obter os dados do funcionário e documento
$sql = "SELECT f.idFuncionario, f.nome, f.dataContratacao, f.cargo, d.tp_documento, d.nr_documento 
        FROM funcionario f 
        LEFT JOIN documento_funcionario d ON f.idFuncionario = d.idFuncionario 
        WHERE f.idFuncionario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idFuncionario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Nenhum registro encontrado para o ID fornecido.";
    exit;
}
$stmt->close();
?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Atualização de Funcionário</title>
        <link rel="stylesheet" href="css/update.css">
    </head>
    <body>
    <div class="container">
        <a href="index.php" class="back-arrow">&#8592; Voltar</a>
        <h1>Atualização de Funcionário</h1>
        <?php if ($alertMessage): ?>
            <div class="alert <?php echo htmlspecialchars($alertClass); ?>">
                <?php echo htmlspecialchars($alertMessage); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="update.php">
            <input type="hidden" name="idFuncionario" value="<?php echo htmlspecialchars($row['idFuncionario']); ?>">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required><br>

            <label for="dataContratacao">Data de Contratação:</label>
            <input type="date" name="dataContratacao" id="dataContratacao" value="<?php echo htmlspecialchars($row['dataContratacao']); ?>" required><br>

            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($row['cargo']); ?>" required><br>

            <label for="tp_documento">Tipo de Documento:</label>
            <input type="text" name="tp_documento" id="tp_documento" value="<?php echo htmlspecialchars($row['tp_documento']); ?>"><br>

            <label for="nr_documento">Número do Documento:</label>
            <input type="text" name="nr_documento" id="nr_documento" value="<?php echo htmlspecialchars($row['nr_documento']); ?>"><br>

            <input class="form-btn" type="submit" value="Atualizar">
        </form>
    </div>
    </body>
    </html>

    <?php
