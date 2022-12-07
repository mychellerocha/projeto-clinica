<?php
ob_start();
require ('conexao.php');
require ('valida-sessao.php');

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    echo "<script>alert('Médico não encontrado!');</script>";
    echo "<script>window.location='medicos.php';</script>";
    exit();
}

$query_medico = "SELECT id FROM medicos WHERE id = $id LIMIT 1";
$result_medico = $conn->prepare($query_medico);
$result_medico->execute();

if (($result_medico) AND ($result_medico->rowCount() != 0)) {
    $query_del_medico = "DELETE FROM medicos WHERE id = $id";
    $apagar_medico = $conn->prepare($query_del_medico);

    if ($apagar_medico->execute()) {
        echo "<script>alert('Médico apagado com sucesso!');</script>";
        echo "<script>window.location='medicos.php';</script>";
    } else {
        echo "<script>alert('Erro ao apagar médico!');</script>";
        echo "<script>window.location='medicos.php';</script>";
    }
} else {
    echo "<script>alert('Médico não encontrado!');</script>";
    echo "<script>window.location='medicos.php';</script>";
}

?>