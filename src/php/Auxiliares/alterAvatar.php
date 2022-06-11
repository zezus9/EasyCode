<?php

    include 'connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';
        $dadosUsuario = $sql -> query("SELECT avatar FROM $usuario WHERE matricula = '$matricula'");
    }
    else{
        header('Location: ../cadastro_login.php');
    }

    $avatar = $_FILES['avatar']['name'];
    $separar = explode('.',$avatar);
    $type = array_reverse($separar);    
    $avatar = $matricula . '.' . $type[0];

    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $avatarA = $dados['avatar'];
    }
    
    if ($avatarA != 'd_img.png') { unlink('../../assets/img/Avatares/' . $avatarA); }

    move_uploaded_file($_FILES['avatar']['tmp_name'],'../../assets/img/Avatares/'.$avatar);
    $sql -> query(
        "UPDATE $usuario SET
            `avatar` = '$avatar'
        WHERE matricula = '$matricula'");
    
    header("Location: ../perfil.php?secoes=dPessoais");

?>