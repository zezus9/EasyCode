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

            $nome = $_POST['nome'];
            $cpf = preg_replace('/[^0-9]/','',$_POST['cpf']);
            $celular = explode(' ',$_POST['celular']);
            $celular = preg_replace('/[+() -]/','',implode('+',\array_splice($celular,1,3)));
            $email = $_POST['email'];
            $nascimento = implode('-',array_reverse(explode('/',$_POST['nascimento'])));
            $senha = $_POST['senha'];

            $cpfExiste = false;
            
            $emails = $sql -> query("SELECT * FROM aluno WHERE email = '$email'");
            $cpfs = $sql -> query("SELECT * FROM aluno WHERE email = '$cpfs'");

            if (mysqli_num_rows($emails) != 0) {
                echo "<h1>Uma conta já foi criada neste e-mail</h1>";
                header("Refresh: 2; ../../cadastro_login.html#cadastrar");
            } elseif (mysqli_num_rows($emails) != 0) {
                echo "<h1>Uma conta já foi criada neste cpf</h1>";
                header("Refresh: 2; ../../cadastro_login.html#cadastrar");
            }
            
            $sql -> query(
                "INSERT INTO aluno (id,nome,telefone,email,cpf,matricula,nasc,avatar,linkedin,github,link_personalizado,senha) 
                VALUES (proximo_id(),
                        '$nome',
                        '$celular',
                        '$email',
                        '$cpf',
                        CONCAT('0',DATE_FORMAT(CURDATE(),'%y'),proximo_id()),
                        '$nascimento',
                        'd_img.png',NULL,NULL,NULL,'$senha')");

            
            echo "<h1>Usuario Cadastrado com sucesso</h1>";
            header("Refresh: 2; ../../cadastro_login.html#entrar");
            
        ?>
    </div>
</body>
</html>