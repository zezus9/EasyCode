<?php

    include 'connect.php';

    $nome = $_POST['nome'];
    $cpf = preg_replace('/[^0-9]/','',$_POST['cpf']);
    $celular = explode(' ',$_POST['celular']);
    $celular = preg_replace('/[+() -]/','',implode('+',\array_splice($celular,1,3)));
    $email = $_POST['email'];
    $nascimento = implode('-',array_reverse(explode('/',$_POST['nascimento'])));
    $senha = $_POST['senha'];

    $emailExiste = false;
    $cpfExiste = false;

    echo "$nome <br> $cpf <br> $celular <br> $email <br> $nascimento <br> $senha <br>";
    
    $alunos = $sql -> query("SELECT * FROM aluno");
    
    while ($aluno = mysqli_fetch_array($alunos)) {
        $emailAlunos = $aluno['email'];
        $cpfAlunos = $aluno['CPF'];

        // echo "$cpf <br> $cpfAlunos <br> $email <br> $emailAlunos <br>";

        if ($emailAlunos == $email) {
            $emailExiste = true;
        } elseif ($cpfAlunos == $cpf) {
            $cpfExiste = true;
        }
    }

    if ($emailExiste) {
        echo "Uma conta já foi criada neste e-mail";
    } elseif ($cpfExiste) {
        echo "Uma conta já foi criada neste cpf";
    } else {
        $sql -> query(
            "INSERT INTO aluno (id,nome,telefone,email,cpf,matricula,nasc,avatar,linkedin,github,link_personalizado,senha) 
             VALUES (proximo_id(),
                    '$nome',
                    '$celular',
                    '$email',
                    '$cpf',
                    CONCAT(DATE_FORMAT(CURDATE(),'%y'),proximo_id()),
                    '$nascimento',
                    'd_img.png',NULL,NULL,NULL,'$senha')");

        echo "Usuario adicionado";
    }
    
?>