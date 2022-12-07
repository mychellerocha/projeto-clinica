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
    <title>Pacientes</title>
    <style>
        body {
            padding-top: 10%;
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

    $result_paciente_cont = "SELECT * FROM paciente ORDER BY nome ASC";
    $resultado_paciente_cont = $conn->prepare($result_paciente_cont);
    $resultado_paciente_cont->execute();
    echo '<div id="busca">';
    echo'<form action="" class="search" method="POST">';
        echo'<input id="txtbusca" name="nome" type="text" value="" placeholder="Digite o nome do paciente...">';
        echo'<input id="btnBusca" type="submit" name="pesqUsuario" value="Buscar">';
    echo'</form>';
echo'</div><br>';
    echo '<div>';
        
    
        echo '<div class="tabela">';
            echo '<div style="float:right;">';
                echo '<a href="paciente-novo.php" class="botao flutuante">+ &nbsp Novo paciente</a>';
            echo '</div>';
            echo '<table>';
                if (empty($dados['pesqUsuario'])) {
                    if (($resultado_paciente_cont) and ($resultado_paciente_cont->rowCount() != 0)) {
                        echo '<h1>Pacientes</h1><br>';
                        echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Nome</th>';
                            echo '<th>Data de Nascimento</th>';
                            echo '<th>CPF</th>';
                            echo '<th>Telefone</th>';
                            echo '<th>Ações</th>';
                        echo '</tr>';
                        while ($row_paciente_cont = $resultado_paciente_cont->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                                echo '<td>' . $row_paciente_cont['id'] . '</td>';
                                echo '<td>' . $row_paciente_cont['nome'] . '</td>';
                                echo '<td>' . date('d/m/Y', strtotime($row_paciente_cont['data_nascimento'])) . '</td>';
                                echo '<td>' . $row_paciente_cont['cpf'] . '</td>';
                                echo '<td>' . $row_paciente_cont['telefone'] . '</td>';
                                echo "<td><a href='paciente-edita.php?id=" . $row_paciente_cont['id'] . "'>Editar&nbsp&nbsp&nbsp&nbsp</a>";
                                echo "<a href='paciente-apaga.php?id=" . $row_paciente_cont['id'] . "'>Apagar</a></td>";
                            echo '</tr>';
                        }
                    } 
                    else {
                        echo '<h3>Não há pacientes cadastrados</h3><br>';
                    }
                }
                else {
                    $nome = "%" . $dados['nome'] . "%";

                    $query_usuarios = "SELECT * FROM paciente WHERE nome LIKE :nome ORDER BY nome ASC";
                    $result_usuarios = $conn->prepare($query_usuarios);
                    $result_usuarios->bindParam(':nome', $nome, PDO::PARAM_STR);

                    $result_usuarios->execute();

                    if (($result_usuarios) and ($result_usuarios->rowCount() != 0)) {
                        echo '<h1>Pacientes</h1><br>';
                        echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Nome</th>';
                            echo '<th>Data de Nascimento</th>';
                            echo '<th>CPF</th>';
                            echo '<th>Telefone</th>';
                            echo '<th>Ações</th>';
                        echo '</tr>';
                        while ($row_paciente_cont = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                                echo '<td>' . $row_paciente_cont['id'] . '</td>';
                                echo '<td>' . $row_paciente_cont['nome'] . '</td>';
                                echo '<td>' . date('d/m/Y', strtotime($row_paciente_cont['data_nascimento'])) . '</td>';
                                echo '<td>' . $row_paciente_cont['cpf'] . '</td>';
                                echo '<td>' . $row_paciente_cont['telefone'] . '</td>';
                                echo "<td><a href='paciente-edita.php?id=" . $row_paciente_cont['id'] . "'>Editar&nbsp&nbsp&nbsp&nbsp</a>";
                                echo "<a href='paciente-apaga.php?id=" . $row_paciente_cont['id'] . "'>Apagar</a></td>";
                            echo '</tr>';
                        }
                    } 
                    else {
                        echo '<h3>Não há resultados para "' . $dados['nome'] .'"</h3><br>';
                    }
                }
            echo '</table>';
        echo '</div>';
    echo '</div>';
    ?>

    <script src="js/main.js"></script>
</body>

</html>