<?php
    session_start();
    include 'connect.php';
    
    $emailMatricula = $_POST['emailMatricula'];
    $senha = $_POST['senha'];
    
    // !Procura por um "@" dentro de $emailMatricula, se encontrar o login será feito pelo email, caso não pela matricula
    $user = is_int(strpos($emailMatricula,'@')) ? 'email' : 'matricula';

    $dadosAluno     = $sql -> query("SELECT * FROM aluno WHERE `$user` = '$emailMatricula' AND `senha` = '$senha'");
    $dadosProfessor = $sql -> query("SELECT * FROM professor WHERE `$user` = '$emailMatricula' AND `senha` = '$senha'");

    // !Se a variavel $dados tiver 0 linhas significa que o usuario não logou corretamente
    if (mysqli_num_rows($dadosAluno) == 0 and mysqli_num_rows($dadosProfessor) == 0) {
        // !PAGINA DE ERRO
        header("Refresh: 1;../../cadastro_login.html");
        echo "nao foi";
    }
    // !O usuario foi encontrado no banco agora apenas vamos redireciona-lo para o site de sua matricula
    if ((mysqli_num_rows($dadosAluno) != 0)) {
        // *O usuário é um aluno e deve ser redirecionado para o seu respectivo perfil
        while ($aluno = mysqli_fetch_array($dadosAluno)) {
            $_SESSION['matricula'] = $aluno['matricula'];
        }
        // !PERFIL DO ALUNO
        header('Location: ../perfil.php');
    }
    elseif ((mysqli_num_rows($dadosProfessor) != 0)) {
        // *O usuário é um professor e deve ser redirecionado para o seu respectivo perfil
        while ($professor = mysqli_fetch_array($dadosProfessor)) {
            $_SESSION['matricula'] = $professor['matricula'];
        }
        // !PERFIL DO PROFESSOR
        header('Location: ../perfil.php');
    }
?>