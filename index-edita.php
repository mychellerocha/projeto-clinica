<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Atualizar consulta</title>
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

$sql = "SELECT * FROM consulta WHERE id = $id";
$resultado = $conn->prepare($sql);
$resultado->execute();

$result_doctor_cont = "SELECT * FROM medicos";
$resultado_doctor_cont = $conn->prepare($result_doctor_cont);
$resultado_doctor_cont->execute();

$result_pac_cont = "SELECT * FROM paciente";
$resultado_pac_cont = $conn->prepare($result_pac_cont);
$resultado_pac_cont->execute();

while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $sql_medico = "SELECT medicos.nome FROM consulta
                   LEFT JOIN medicos on (consulta.id_medico = medicos.id)";
    $nome_medico = $conn->prepare($sql_medico);
    $nome_medico->execute();

    $paciente_id = $linha['matricula_paciente'];
    $sql_paciente = "SELECT paciente.nome FROM consulta
                     LEFT JOIN paciente on (consulta.matricula_paciente = paciente.id)
                     WHERE
                     paciente.id = $paciente_id";
    $nome_paciente = $conn->prepare($sql_paciente);
    $nome_paciente->execute();
    $paciente = $name_paciente = $nome_paciente->fetch(PDO::FETCH_ASSOC);

    echo '<section class="area-login">';
        echo '<div class="formulario">';
            echo '<form action="index-edita-bd.php" method="post">';
                echo '<h1>Atualizar consulta</h1><br>';

                echo '<input type="hidden" name="id" value="'. $linha["id"] . '"><br>';

                echo '<label for="nome">Nome Paciente</label>';
                echo '<select name="matricula_paciente">';
                echo '<option value="">Selecione um paciente...</option>';
                echo '<option value=""></option>';
                    while ($pac = $resultado_pac_cont->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'. $pac['id'] . '">' . $pac['nome'] . '</option>';
                    }
                echo '</select><br>';
                echo '<label for="nome">Nome Médico</label>';
                echo '<select name="id_medico">';
                echo '<option value="">Selecione um médico...</option>';
                echo '<option value=""></option>';
                while ($med = $resultado_doctor_cont->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'. $med['id'] . '">' . $med['nome'] . '</option>';
                }
                echo '</select><br>';

                echo '<label for="data_consulta">Data consulta</label>';
                echo '<input type="date" name="data_consulta" required value="'. $linha["data_consulta"] . '"><br>';

                echo '<label for="horario">Horário</label>';
                echo '<input type="text" name="horario" placeholder="Digite o horário" required value="'. $linha["horario"] . '"><br>';

                echo '<label for="estado">Status</label>';
                echo '<select name="estado">';
                echo '<option value=""></option>';
                echo '<option value="Pendente">Pendente</option>';
                echo '<option value="Cancelada">Cancelada</option>';
                echo '<option value="Realizada">Realizada</option>';
                echo '</select><br>';
                
                echo '<input type="submit" value="Atualizar" name="editaConsulta">';
            echo '</form>';
        echo '</div>';
    echo '</section>';
}

?>

<script src="js/main.js"></script>

</body>
</html>