<?php

    include 'connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    // !Testa se esta logado ou não
    $logado = false;
    if (isset($_SESSION['matricula'])) {
        // !Testa se quem está logado é aluno ou professor
        $logado = true;
        $matricula = $_SESSION['matricula'];
        if (substr($matricula,0,1) == 0) {
            $usuario = 'aluno';
            $dadosUsuario = $sql -> query("SELECT * FROM aluno WHERE matricula = '$matricula'");
        }
        else{
            $usuario = 'professor';
            $dadosUsuario = $sql -> query("SELECT * FROM professor WHERE matricula = '$matricula'");
        }
    }
    else{
        header('Location: ../cadastro_login.html');
    }

    $avatar = $_FILES['avatar']['name'];
    $separar = explode('.',$avatar);
    $type = array_reverse($separar);    
    $avatar = $matricula . '.' . $type[0];

    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $avatarA = $dados['avatar'];
    }

    if ($avatarA == 'd_img.png') {
        move_uploaded_file($_FILES['avatar']['tmp_name'],$avatar);
        $sql -> query(
            "UPDATE aluno SET
                `avatar` = '$avatar'
            WHERE matricula = '$matricula'");
    }
    else {
        echo '../../assets/img/Avatares/' . $avatar;
        unlink($avatarA);
        move_uploaded_file($_FILES['avatar']['tmp_name'],'../../assets/img/Avatares/' . $avatar);
        $sql -> query(
            "UPDATE aluno SET
                `avatar` = '$avatar'
            WHERE matricula = '$matricula'");
    }


    echo "<h1>Alterações Realizadas com sucesso!</h1>";
    header("Location: ../perfil.php");

?>