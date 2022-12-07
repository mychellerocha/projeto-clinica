<?php
require("valida-sessao.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Novo paciente</title>
    <style>
        body {
            padding-top: 2.7%;
        }

        html,
        body {
            overflow: hidden;
        }

        .formulario {
            width: 600px;
            height: 540px;
        }
    </style>
    <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
</head>

<body>
    <!-- início cabeçalho -->
    <header>
        <nav>
            <div class="navbar">
                <span class="logo">
                    <a href="index.php">
                        <img src="img/logo.png" width="188.1px" height="34.35px">
                    </a>
                </span>
                <div class="menu">
                    <ul class="menu-paginas">
                        <li><a href="index.php">Agenda</a></li>
                        <li><a href="historico.php">Histórico</a></li>
                        <li><a href="consultas.php">Consultas</a></li>
                        <li><a href="medicos.php">Médicos</a></li>
                        <li><a href="pacientes.php">Pacientes</a></li>
                        <li style="float: right;"><a href="sair.php">Sair</a></li>
                    </ul>
                </div>
                <div class="modo">
                    <div class="botao-tema">
                        <i class='bx bx-moon moon'></i>
                        <i class='bx bx-sun sun'></i>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- fim cabeçalho -->

    <section class="area-login">
        <div class="formulario">
            <form action="paciente-novo-bd.php" method="post">
                <h1>Novo paciente</h1><br>

                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" placeholder="Digite o nome" required autofocus><br>

                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" required><br>

                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF" required><br>

                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="tel" placeholder="Digite o telefone" required><br>

                <input type="submit" value="Cadastrar" name="newPaciente">
            </form>
        </div>
    </section>

    <script src="js/main.js"></script>
</body>

</html>