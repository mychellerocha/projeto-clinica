<?php
ob_start();
require ('conexao.php');
require ('valida-sessao.php');

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    echo "<script>alert('Paciente não encontrado!');</script>";
    echo "<script>window.location='pacientes.php';</script>";
    exit();
}

$query_paciente = "SELECT id FROM paciente WHERE id = $id LIMIT 1";
$result_paciente = $conn->prepare($query_paciente);
$result_paciente->execute();

if (($result_paciente) AND ($result_paciente->rowCount() != 0)) {
    $query_del_paciente = "DELETE FROM paciente WHERE id = $id";
    $apagar_paciente = $conn->prepare($query_del_paciente);

    if ($apagar_paciente->execute()) {
        echo "<script>alert('Paciente apagado com sucesso!');</script>";
        echo "<script>window.location='pacientes.php';</script>";
    } else {
        echo "<script>alert('Erro ao apagar paciente!');</script>";
        echo "<script>window.location='pacientes.php';</script>";
    }
} else {
    echo "<script>alert('Paciente não encontrado!');</script>";
    echo "<script>window.location='pacientes.php';</script>";
}

?>