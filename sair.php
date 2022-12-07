<?php

require("valida-sessao.php");

ob_start();
unset(
    $_SESSION['id'], 
    $_SESSION['nome'], 
    $_SESSION['usuario'], 
    $_SESSION['cpf'],
    $_SESSION['email'], 
    $_SESSION['data_n'], 
    $_SESSION['telefone']
);

echo "<script>alert('Agradecemos sua visita! Volte sempre.');</script>";
echo "<script>window.location='login.html';</script>";

?>