<?php

    include 'connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    // !Testa se esta logado ou não
    $logado = false;
    if (isset($_SESSION['matricula'])) {
        // !Testa se quem está logado é aluno ou professor
        $logado = true;
        $matricula = $_SESSION['matricula'];
    }
    else{
        header('Location: ../cadastro_login.html');
    }

    $linkedin = $_POST['linkedin'];
    $github = $_POST['github'];
    $link = $_POST['link'];

    $sql -> query(
        "UPDATE aluno SET
            `linkedin` = '$linkedin',
            `github` = '$github',
            `link_personalizado` = '$link'
        WHERE matricula = '$matricula'");

    echo "<h1>Alterações Realizadas com sucesso!</h1>";
    header("Refresh: 2; ../perfil.php");

?>