<?php

require("valida-sessao.php");
require("conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['newPaciente'])) {
    $empty_input = false;

    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<script>alert('Erro! Necessário preencher todos os campos');</script>";
        echo "<script>window.location='pacientes.php';</script>";
    }
    
    if (!$empty_input) {
        $query_usuario = "INSERT INTO paciente (nome, data_nascimento, cpf, telefone) VALUES (:nome, :data_nascimento, :cpf, :telefone) ";
        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $cad_usuario->execute();
        if ($cad_usuario->rowCount()) {
            echo "<script>alert('Paciente cadastrado com sucesso!');</script>";
            echo "<script>window.location='pacientes.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar o paciente!');</script>";
            echo "<script>window.location='pacientes.php';</script>";
        }
    }
}
?>