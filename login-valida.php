<?php
session_start();
include 'conexao.php';
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//echo password_hash(123456, PASSWORD_DEFAULT);

if (!empty($dados['enviaLogin'])) {
    $query_usuario = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        if (password_verify($dados['senha'], $row_usuario['senha'])) {
            $_SESSION['id'] = $row_usuario['id'];
            $_SESSION['nome'] = $row_usuario['nome'];
            $_SESSION['usuario'] = $row_usuario['usuario'];
            $_SESSION['cpf'] = $row_usuario['cpf'];
            $_SESSION['email'] = $row_usuario['email'];
            $_SESSION['data_n'] = $row_usuario['data_n'];
            $_SESSION['telefone'] = $row_usuario['telefone'];
            echo "<script>window.location='index.php';</script>";
        } else {
            echo "<script>alert('Login e/ou senha está incorreto!');</script>";
            echo "<script>window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('Login e/ou senha está incorreto!');</script>";
        echo "<script>window.location='login.html';</script>";
    }
}

?>