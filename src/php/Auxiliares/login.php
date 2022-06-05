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

            $dadosAluno = $sql -> query("SELECT matricula FROM aluno     WHERE `$user` = '$emailMatricula' AND `senha` = '$senha'");
            $dadosProf  = $sql -> query("SELECT matricula FROM professor WHERE `$user` = '$emailMatricula' AND `senha` = '$senha'");

            if (mysqli_num_rows($dadosAluno) == 0 and mysqli_num_rows($dadosProf) == 0) {
                echo "<h1>Os dados de login fornecidos estão incorretos</h1>";
                header("Refresh: 2; ../cadastro_login.php#entrar");
            }
            if ((mysqli_num_rows($dadosAluno) != 0)) {
                while ($aluno = mysqli_fetch_array($dadosAluno)) {
                    $_SESSION['matricula'] = $aluno['matricula'];
                }
                header('Location: ../perfil.php');
            } elseif ((mysqli_num_rows($dadosProf) != 0)) {
                while ($professor = mysqli_fetch_array($dadosProf)) {
                    $_SESSION['matricula'] = $professor['matricula'];
                }
                header('Location: ../perfil.php');
            }
        ?>
    </div>
</body>
</html>