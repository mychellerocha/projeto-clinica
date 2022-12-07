<?php

require("valida-sessao.php");
require("conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

$query_medico = "SELECT * FROM medicos WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_medico);
$result_usuario->execute();

if (!empty($dados['editaMedico'])) {
    $empty_input = false;
    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<script>alert('Preencha todos os campos!');</script>";
    }

    if (!$empty_input) {
        $query_up_usuario= "UPDATE medicos SET nome=:nome, crm=:crm, data_nascimento=:data_nascimento, telefone=:telefone, especialidade=:especialidade WHERE id=:id";
        $edit_medico = $conn->prepare($query_up_usuario);
        $edit_medico->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $edit_medico->bindParam(':crm', $dados['crm'], PDO::PARAM_STR);
        $edit_medico->bindParam(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
        $edit_medico->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $edit_medico->bindParam(':especialidade', $dados['especialidade'], PDO::PARAM_STR);
        $edit_medico->bindParam(':id', $id, PDO::PARAM_INT);
        if($edit_medico->execute()){
            echo "<script>alert('Dados do(a) médico(a) " . $dados['nome'] . " atualizados com sucesso!');</script>";
            echo "<script>window.location='medicos.php';</script>";
        }
        else {
            echo "<script>alert('Erro ao atualizar os dados.');</script>";
            echo "<script>window.location='medicos.php';</script>";
        }
    }
}

?>