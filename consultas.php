<?php
require("valida-sessao.php");
require("conexao.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Consultas</title>
    <style>
        body {
            padding-top: 13%;
        }

        th,
        td {
            text-align: center;
        } 
    </style>
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

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $result_consulta_cont = "SELECT * FROM consulta WHERE estado = 'Pendente' ORDER BY data_consulta ASC";
    $resultado_consulta_cont = $conn->prepare($result_consulta_cont);
    $resultado_consulta_cont->execute();

    echo '<div>'; 
        echo '<div class="tabela">';
            echo '<div style="float:right;">';
                echo '<a href="consulta-nova.php" class="botao flutuante">+ &nbsp Nova consulta</a>';
            echo '</div>';
            echo '<table>';
                if (empty($dados['pesqUsuario'])) {
                    if (($resultado_consulta_cont) and ($resultado_consulta_cont->rowCount() != 0)) {
                        echo '<h1>Consultas marcadas</h1><br>';
                        echo '<tr>';
                            echo '<th>Paciente</th>';
                            echo '<th>Médico</th>';
                            echo '<th>Data</th>';
                            echo '<th>Horário</th>';
                            echo '<th>Status</th>';
                            echo '<th>Ações</th>';
                        echo '</tr>';
                        while ($row_consulta_cont = $resultado_consulta_cont->fetch(PDO::FETCH_ASSOC)) {
                            $medico_matric = $row_consulta_cont['id_medico'];
                            $sql_medico = "SELECT medicos.nome FROM consulta
                                LEFT JOIN medicos on (consulta.id_medico = medicos.id)
                                WHERE
                                medicos.id = $medico_matric";
                            $nome_medico = $conn->prepare($sql_medico);
                            $nome_medico->execute();

                            $paciente_id = $row_consulta_cont['matricula_paciente'];
                            $sql_paciente = "SELECT paciente.nome FROM consulta
                                LEFT JOIN paciente on (consulta.matricula_paciente = paciente.id)
                                WHERE
                                paciente.id = $paciente_id";
                            $nome_paciente = $conn->prepare($sql_paciente);
                            $nome_paciente->execute();

                            echo '<tr>';
                                $paciente = $name_paciente = $nome_paciente->fetch(PDO::FETCH_ASSOC);
                                echo '<td>' . $name_paciente['nome'] . '</td>';
                                $medico = $name_med = $nome_medico->fetch(PDO::FETCH_ASSOC);
                                echo '<td>' . $name_med['nome'] . '</td>';
                                echo '<td>' . date('d/m/Y', strtotime($row_consulta_cont['data_consulta'])) . '</td>';
                                echo '<td>' . $row_consulta_cont['horario'] . '</td>';
                                echo '<td>' . $row_consulta_cont['estado'] . '</td>';
                                echo "<td><a href='consulta-edita.php?id=" . $row_consulta_cont['id'] . "'>Editar&nbsp&nbsp&nbsp&nbsp</a>";
                                echo "<a href='consulta-apaga.php?id=" . $row_consulta_cont['id'] . "'>Apagar</a></td>";
                            echo '</tr>';
                        }
                    } 
                    else {
                        echo '<h3>Não há consultas marcadas!</h3><br>';
                    }
                }
            echo '</table>';
        echo '</div>';
    echo '</div>';
    ?>
    
    <script src="js/main.js"></script>
</body>

</html>