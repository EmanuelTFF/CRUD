<?php
include 'include/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idFuncionario']) && !empty($_POST['idFuncionario'])) {
        $idFuncionario = intval($_POST['idFuncionario']);

        // Deletar documento
        $sql = "DELETE FROM documento_funcionario WHERE idFuncionario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idFuncionario);

        if ($stmt->execute()) {
            // Deletar funcionário
            $sql = "DELETE FROM funcionario WHERE idFuncionario=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idFuncionario);

            if ($stmt->execute()) {
                echo "Registro deletado com sucesso";
            } else {
                echo "Erro ao deletar funcionário: " . $stmt->error;
            }
        } else {
            echo "Erro ao deletar documento: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID do funcionário não fornecido.";
    }
} else {
    // Exibir o formulário
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Deletar Funcionário</title>
    </head>
    <body>
        <div class="container">
            <h1>Deletar Funcionário</h1>
            <form method="post" action="delete.php">
                <label for="idFuncionario">ID do Funcionário:</label>
                <input type="text" name="idFuncionario" id="idFuncionario" required><br>
                <input type="submit" value="Deletar">
            </form>
        </div>
    </body>
    </html>
    <?php
}
$conn->close();
?>
