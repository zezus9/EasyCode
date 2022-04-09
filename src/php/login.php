<?php
    
    include 'connect.php';
    
    $emailMatricula = $_POST['emailMatricula'];
    $senha = $_POST['senha'];
    
    // !Procura por um "@" dentro de $emailMatricula, se encontrar o login será feito pelo email, caso não pela matricula
    $user = is_int(strpos($emailMatricula,'@')) ? 'email' : 'matricula';

    $dados = $sql -> query("SELECT * FROM aluno WHERE `$user` = '$emailMatricula' AND `senha` = '$senha'");
    // !Se a variavel $dados tiver 0 linhas significa que o usuario não logou corretamente
    if (mysqli_num_rows($dados) == 0) {
        // *Não foi encontrado o login do usuario no banco
        echo 'não entrou';
    }
    else {
        // *O usuario foi encontrado no banco agora apenas vamos redireciona-lo para o site de sua matricula
        echo 'entrou';
    }

?>