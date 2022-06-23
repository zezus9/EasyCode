<?php

    include 'connect.php';

    if (!isset($_SESSION) || !isset($_GET['curso'])) {
        session_start();
    }

    // !Testa se esta logado ou não
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        if (substr($matricula,0,1) == 1) {
            header('Location: cadastro_login.php');    
        }
    }
    else{
        header('Location: cadastro_login.php');
    }

    $id_curso = $_GET['curso'];
    $faseA = $_GET['faseA'] + 1;

    $idCertificado = $sql -> query(
        "SELECT 
            cert.id
        FROM certificado AS cert
        INNER JOIN curso ON cert.id_curso = curso.id
        INNER JOIN aluno ON cert.id_aluno = aluno.id
        WHERE cert.id_curso = '$id_curso' AND aluno.matricula = '$matricula'"
    );

    while ($id = mysqli_fetch_array($idCertificado)) {
        $id_certificado = $id['id'];
    }

    $sql -> query(
        "UPDATE certificado SET
            `fase` = '$faseA'
        WHERE id = '$id_certificado'");

    header("Location: ../curso.php?curso=$id_curso");
?>