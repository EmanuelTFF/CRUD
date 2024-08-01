<?php
include 'include/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $dataContratacao = isset($_POST['dataContratacao']) ? $_POST['dataContratacao'] : null;
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : null;
    $tp_documento = isset($_POST['tp_documento']) ? $_POST['tp_documento'] : null;
    $nr_documento = isset($_POST['nr_documento']) ? $_POST['nr_documento'] : null;

    if ($nome && $dataContratacao && $cargo) {
        $sqlFuncionario = "INSERT INTO funcionario (nome, dataContratacao, cargo) VALUES ('$nome', '$dataContratacao', '$cargo')";
        if ($conn->query($sqlFuncionario) === TRUE) {
            $idFuncionario = $conn->insert_id;

            if ($tp_documento && $nr_documento) {
                $sqlDocumento = "INSERT INTO documento_funcionario (idFuncionario, tp_documento, nr_documento) VALUES ($idFuncionario, '$tp_documento', '$nr_documento')";
                $conn->query($sqlDocumento);
            }
            
            header("Location: lista_funcionarios.php");
        } else {
            echo "Erro ao adicionar funcionário: " . $conn->error;
        }
    } else {
        echo "Todos os campos obrigatórios são necessários.";
    }
}
$conn->close();
?>
