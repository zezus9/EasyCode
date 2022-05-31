<?php

    include 'connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        if (substr($matricula,0,1) == 0) {
            $dadosUsuario = $sql -> query("SELECT avatar FROM aluno WHERE matricula = '$matricula'");
        }
        else{
            $dadosUsuario = $sql -> query("SELECT avatar FROM professor WHERE matricula = '$matricula'");
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
        unlink('../../assets/img/Avatares/' . $avatarA);
        move_uploaded_file($_FILES['avatar']['tmp_name'],'../../assets/img/Avatares/'.$avatar);
        $sql -> query(
            "UPDATE aluno SET
                `avatar` = '$avatar'
            WHERE matricula = '$matricula'");
    }
    
    header("Location: ../perfil.php");

?>