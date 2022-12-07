<?php

require("valida-sessao.php");
require("conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

$query_paciente = "SELECT * FROM paciente WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_paciente);
$result_usuario->execute();

if (!empty($dados['editaPaciente'])) {
    $empty_input = false;
    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<script>alert('Preencha todos os campos!');</script>";
    }

    if (!$empty_input) {
        $query_up_paciente= "UPDATE paciente SET nome=:nome, data_nascimento=:data_nascimento, cpf=:cpf, telefone=:telefone WHERE id=:id";
        $edit_paciente = $conn->prepare($query_up_paciente);
        $edit_paciente->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $edit_paciente->bindParam(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
        $edit_paciente->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $edit_paciente->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $edit_paciente->bindParam(':id', $id, PDO::PARAM_INT);
        if($edit_paciente->execute()){
            echo "<script>alert('Dados do(a) paciente(a) " . $dados['nome'] . " atualizados com sucesso!');</script>";
            echo "<script>window.location='pacientes.php';</script>";
        }
        else {
            echo "<script>alert('Erro ao atualizar os dados.');</script>";
            echo "<script>window.location='paciente.php';</script>";
        }
    }
}

?>