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

            if (!isset($_SESSION)) { session_start(); }

            if (isset($_SESSION['matricula'])) {

                $matricula = $_SESSION['matricula'];
                $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';
                $dadosUsuario = $sql -> query("SELECT senha FROM $usuario WHERE matricula = '$matricula'");
                if (!isset($_GET['rescue'])) {

                    while ($dados = mysqli_fetch_array($dadosUsuario)) { $senha = $dados['senha']; }

                    $senhaAnt = $_POST['senhaAnt'];
                    $senhaNov = $_POST['senha'];

                    if ($senhaAnt != $senha) {

                        echo "<h1>Senha Antiga incorreta</h1>";
                        header("Refresh: 3; ../perfil.php");
                    } else {

                        $sql -> query(
                            "UPDATE $usuario SET
                                `senha` = '$senhaNov'
                            WHERE matricula = '$matricula'");
                    
                        echo "<h1>Senha alterada com sucesso!</h1>";
                        header("Refresh: 2; sair.php");
                    }
                } else {
    
                    $senhaNov = $_POST['senha'];
                    $sql -> query(
                        "UPDATE $usuario SET
                            `senha` = '$senhaNov'
                        WHERE matricula = '$matricula'");
                
                    echo "<h1>Senha alterada com sucesso!</h1>";
                    header("Refresh: 2; sair.php");
                }
            } else {
                header('Location: ../cadastro_login.html');
            }

        ?>
    </div>
</body>
</html>