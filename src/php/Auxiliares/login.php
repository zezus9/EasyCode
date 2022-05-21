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
        echo 'não entrou';
    } 
    // !O usuario foi encontrado no banco agora apenas vamos redireciona-lo para o site de sua matricula
    if ((mysqli_num_rows($dadosAluno) != 0)) {
        // *O usuário é um aluno e deve ser redirecionado para o seu respectivo perfil
        while ($aluno = mysqli_fetch_array($dadosAluno)) {
            $_SESSION['matricula'] = $aluno['matricula'];
        }
        // !PERFIL DO ALUNO
        header("Refresh: 2;teste_login.php");
    }
    else {
        // *O usuário é um professor e deve ser redirecionado para o seu respectivo perfil
        while ($professor = mysqli_fetch_array($dadosProfessor)) {
            $_SESSION['matricula'] = $professor['matricula'];
        }
        // !PERFIL DO PROFESSOR
        header("Refresh: 2;teste_login.php");
    }








    // ! A PARTIR DAQUI É O TESTE DE SESSION

    if (!isset($_SESSION)) {session_start();}// Ativa a SESSION senão estivar ativada

    // ! CASO A PESSOA NÃO TEM A MATRICULA CERTA ELE IRIA PARA UMA PAGINAD DE ERRO
    if (!isset($_SESSION['matricula'])) {
        echo "<h1 style='text-align: center;'>Você não está logado, redirecionando à página de login</h1>";
        header('Refresh: 1;PAGINA DE ERRO.html');
    }
    else {
        // ! CODIGO DA PAGINA
        $matricula = $_SESSION['matricula'];
        if (substr($matricula,0,1) != '0') {
            echo "professor";
        }
        else {
            echo "aluno";
        }
    }
?>