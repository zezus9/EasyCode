<?php

    include 'connect.php';

    $id_curso = $_GET['curso'];
    $fase = $_GET['fase'];

    $nomeCurso = $sql -> query("SELECT linguagem FROM curso WHERE id = '$id_curso'");
    while ($nome = mysqli_fetch_array($nomeCurso)) { $linguagem = $nome['linguagem']; }
    
    $result = false;
    $questão = $_POST['questao'];

    $arquivo = explode("\n",file_get_contents("../../cursos/$linguagem/Aulas/fase $fase.txt"));
    $respostaC = trim($arquivo[5]);

    if ($questão == 'alternativa') {
        $resposta = $_POST['radios'];
        if ($respostaC == $resposta) {
            $result = true;
        }
    } elseif ($questão == 'Mescolha') {
        $resposta = $_POST['checks'];
        if (is_array($resposta)) {
            $resposta = implode(',',$resposta);
        }
        if ($respostaC == $resposta) {
            $result = true;
        }
    } elseif ($questão == 'botao') {
        $array = $_POST['array'];
        $respostaC = explode(',',$respostaC);
        $array = explode(',',$array);
        $result = true;

        for ($i=0; $i < count($respostaC); $i++) { 
            $respostaPos = explode(':',$respostaC[$i]);
            if ($respostaPos[0] != $array[$i] or $respostaPos[1] != $i + 1) {
                $result = false;
            }
        }
    }

    if ($result) {
        $result = "true";
    } else {
        $result = "false";
    }


    header("Location: ../curso.php?curso=$id_curso&fase=$fase&result=$result");
?>