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

            include 'connect.php';

            if (!isset($_SESSION)) {
                session_start();
            }

            if (isset($_SESSION['matricula'])) {
                $matricula = $_SESSION['matricula'];
            }
            else{
                header('Location: ../cadastro_login.html');
            }

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $celular = explode(' ',$_POST['celular']);
            $celular = preg_replace('/[+() -]/','',implode('+',\array_splice($celular,1,3)));

            if (substr($matricula,0,1) == 0) {
                $emails = $sql -> query("SELECT email FROM aluno WHERE email = '$email' AND matricula != '$matricula'");
            }
            else{
                $emails = $sql -> query("SELECT email FROM professor WHERE email = '$email' AND matricula != '$matricula'");
            }

            if (mysqli_num_rows($emails) != 0) {
                echo "<h1>Uma conta já foi criada neste e-mail</h1>";
                header("Refresh: 2; ../perfil.php");
            } else {
                $sql -> query(
                    "UPDATE aluno SET
                        `nome` = '$nome',
                        `telefone` = '$celular',
                        `email` = '$email'
                    WHERE matricula = '$matricula'");
    
                echo "<h1>Alterações Realizadas com sucesso!</h1>";
                header("Refresh: 2; ../perfil.php");
            }

        ?>
    </div>
</body>
</html>