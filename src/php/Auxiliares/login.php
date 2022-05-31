<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <!--link do icon-->
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../../assets/css/style.css'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
</head>
<body style="background-image: url(../../assets/img/bgimg.jpg);height:100vh">
    <div class="d-flex justify-content-center align-items-center h-100">
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
                echo "<h1>Os dados de login fornecidos estão incorretos</h1>";
                header("Refresh: 1;../../cadastro_login.html");
            }
            // !O usuario foi encontrado no banco agora apenas vamos redireciona-lo para o site de sua matricula
            if ((mysqli_num_rows($dadosAluno) != 0)) {
                // *O usuário é um aluno e deve ser redirecionado para o seu respectivo perfil
                while ($aluno = mysqli_fetch_array($dadosAluno)) {
                    $_SESSION['matricula'] = $aluno['matricula'];
                }
                // !PERFIL DO ALUNO
                header('Location: ../sobrenos.php');
            }
            elseif ((mysqli_num_rows($dadosProfessor) != 0)) {
                // *O usuário é um professor e deve ser redirecionado para o seu respectivo perfil
                while ($professor = mysqli_fetch_array($dadosProfessor)) {
                    $_SESSION['matricula'] = $professor['matricula'];
                }
                // !PERFIL DO PROFESSOR
                header('Location: ../sobrenos.php');
            }
        ?>
    </div>
</body>
</html>