<?php

require("valida-sessao.php");
require("conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
$status = "Consulta";

$query_medico = "SELECT * FROM medicos WHERE id = $id LIMIT 1";
$result_medico = $conn->prepare($query_medico);
$result_medico->execute();

if (!empty($dados['editaConsulta'])) 
{
    $empty_input = false;
    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) 
    {
        $empty_input = true;
        echo "<script>alert('Preencha todos os campos!');</script>";
        echo "<script>window.location='consultas.php';</script>";
    }

    if (!$empty_input) 
    {
        $query_up_consulta = "UPDATE consulta SET id_medico=:id_medico, matricula_paciente=:matricula_paciente, data_consulta=:data_consulta, horario=:horario, tipo=:tipo, estado=:estado WHERE id=:id";
        $edit_consulta = $conn->prepare($query_up_consulta);
        $edit_consulta->bindParam(':id_medico', $dados['id_medico'], PDO::PARAM_STR);
        $edit_consulta->bindParam(':matricula_paciente', $dados['matricula_paciente'], PDO::PARAM_STR);
        $edit_consulta->bindParam(':data_consulta', $dados['data_consulta']);
        $edit_consulta->bindParam(':horario', $dados['horario']);
        $edit_consulta->bindParam(':tipo', $status, PDO::PARAM_STR);
        $edit_consulta->bindParam(':estado', $dados['estado'], PDO::PARAM_STR);
        $edit_consulta->bindParam(':id', $id, PDO::PARAM_INT);
        if ($edit_consulta->execute()) 
        {
            echo "<script>alert('Dados da consulta atualizados com sucesso!');</script>";
            echo "<script>window.location='consultas.php';</script>";
        }
        else 
        {
            echo "<script>alert('Erro ao atualizar os dados.');</script>";
            echo "<script>window.location='consultas.php';</script>";
        }
    }
}

?>