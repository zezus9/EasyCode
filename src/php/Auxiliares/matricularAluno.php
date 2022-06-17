<?php

    include 'connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        $dadosAluno = $sql -> query("SELECT id FROM aluno WHERE matricula = '$matricula'");
        
        while ($dados = mysqli_fetch_array($dadosAluno)) {
            $id_aluno = $dados['id'];
        }
    }

    $id_curso = $_POST['id_curso'];

    $dadosProfessor = $sql -> query("SELECT id_responsavel FROM curso WHERE id = '$id_curso'");
    while ($dados = mysqli_fetch_array($dadosProfessor)) {
        $id_professor = $dados['id_responsavel'];
    }

    $sql -> query(
        "INSERT INTO certificado 
            VALUES (NULL, 
                    '$id_aluno',
                    '$id_curso',
                    '$id_professor',
                    '1', 
                    CURDATE(), 
                    NULL,
                    'INICIADO');");
    
    header("Location: ../template_cursos.php?curso=$id_curso");
?>