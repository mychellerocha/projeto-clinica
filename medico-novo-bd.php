<?php

require("valida-sessao.php");
require("conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['newDoctor'])) {
    $empty_input = false;

    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<script>alert('Erro! Necessário preencher todos os campos');</script>";
        echo "<script>window.location='medicos.php';</script>";
    }

    if (!$empty_input) {
        $query_usuario = "INSERT INTO medicos (nome, crm, data_nascimento, telefone, especialidade) VALUES (:nome, :crm, :data_nascimento, :telefone, :especialidade) ";
        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':crm', $dados['crm'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':especialidade', $dados['especialidade'], PDO::PARAM_STR);
        $cad_usuario->execute();
        if ($cad_usuario->rowCount()) {
            echo "<script>alert('Médico cadastrado com sucesso!');</script>";
            echo "<script>window.location='medicos.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar o médico!');</script>";
            echo "<script>window.location='medicos.php';</script>";
        }
    }
}
?>