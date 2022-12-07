<?php

require("valida-sessao.php");
require("conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$status = "Consulta";

if (!empty($dados['novaConsulta'])) {
    $empty_input = false;

    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<script>alert('Erro! Necessário preencher todos os campos');</script>";
        echo "<script>window.location='index-nova.php';</script>";
    }

    if (!$empty_input) {
        $query_usuario = "INSERT INTO consulta (id_medico, matricula_paciente, data_consulta, horario, tipo, estado) VALUES (:id_medico, :matricula_paciente, :data_consulta, :horario, :tipo, :estado) ";
        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':id_medico', $dados['id_medico'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':matricula_paciente', $dados['matricula_paciente'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':data_consulta', $dados['data_consulta'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':horario', $dados['horario']);
        $cad_usuario->bindParam(':tipo', $status, PDO::PARAM_STR);
        $cad_usuario->bindParam(':estado', $dados['estado'], PDO::PARAM_STR);
        $cad_usuario->execute();
        if ($cad_usuario->rowCount()) {
            echo "<script>alert('Consulta cadastrada com sucesso!');</script>";
            echo "<script>window.location='index.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar consulta!');</script>";
            echo "<script>window.location='index.php';</script>";
        }
    }
}
?>