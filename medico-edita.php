<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Atualizar médico</title>
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
            height: 620px;
        }
        form [type="submit"] {
            display: block;
            background-color: var(--button-color);
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            text-align: center;
            color: var(--text-color);
            cursor: pointer;
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

<?php

require("valida-sessao.php");
require("conexao.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM medicos WHERE id = $id";
$resultado = $conn->prepare($sql);
$resultado->execute();

while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
    echo '<section class="area-login">';
        echo '<div class="formulario">';
            echo '<form action="medico-edita-bd.php" method="post">';
                echo '<h1>Atualizar dados</h1><br>';

                echo '<input type="hidden" name="id" value="'. $linha["id"] . '"><br>';

                echo '<label for="nome">Nome Completo</label>';
                echo '<input type="text" name="nome" placeholder="Digite o nome" required autofocus value="'. $linha["nome"] . '"><br>';

                echo '<label for="crm">CRM</label>';
                echo '<input type="number" name="crm" placeholder="Digite o CRM" required value="'. $linha["crm"] . '"><br>';

                echo '<label for="data_nascimento">Data de Nascimento</label>';
                echo '<input type="date" name="data_nascimento" required value="'. $linha["data_nascimento"] . '"><br>';

                echo '<label for="telefone">Telefone</label>';
                echo '<input type="text" name="telefone" id="tel" placeholder="Digite o telefone" required value="'. $linha["telefone"] . '"><br>';

                echo '<label for="especialidade">Especialidade</label>';
                echo '<input type="text" name="especialidade" required placeholder="Digite a especialidade" value="'. $linha["especialidade"] . '"><br>';
                
                echo '<input type="submit" value="Atualizar" name="editaMedico">';
            echo '</form>';
        echo '</div>';
    echo '</section>';
}

?>

<script src="js/main.js"></script>

</body>
</html>