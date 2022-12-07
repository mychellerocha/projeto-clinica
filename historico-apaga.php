<?php
ob_start();
require('conexao.php');
require('valida-sessao.php');

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) 
{
    echo "<script>alert('Consulta não encontrada!');</script>";
    echo "<script>window.location='historico.php';</script>";
    exit();
}

$query_consulta = "SELECT id FROM consulta WHERE id = $id LIMIT 1";
$result_consulta = $conn->prepare($query_consulta);
$result_consulta->execute();

if (($result_consulta) and ($result_consulta->rowCount() != 0)) 
{
    $query_del_consulta = "DELETE FROM consulta WHERE id = $id";
    $apagar_consulta = $conn->prepare($query_del_consulta);

    if ($apagar_consulta->execute()) 
    {
        echo "<script>alert('Consulta apagada com sucesso!');</script>";
        echo "<script>window.location='historico.php';</script>";
    } 
    else 
    {
        echo "<script>alert('Erro ao apagar consulta!');</script>";
        echo "<script>window.location='historico.php';</script>";
    }
} 
else 
{
    echo "<script>alert('Consulta não encontrada!');</script>";
    echo "<script>window.location='historico.php';</script>";
}

?>