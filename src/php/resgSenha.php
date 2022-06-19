<?php

    include 'Auxiliares/connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        $logado = true;
    }
    else{
        $logado = false;
    }
    
    echo
    "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Recuperação de Senha</title>
        <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

        <link rel='stylesheet' href='../assets/css/perfil.css'>
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/inputs.css'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='d-flex align-items-center voltar' onclick='goBack()' style='cursor:pointer;'>
            <img src='../assets/img/voltar.png' width='80px'>
            <h3 class='color p-0 m-0'>VOLTAR</h3>
        </div>
    ";

    if (!isset($_POST['email']) and !isset($_POST['matricula']) and !isset($_POST['nascimento'])) {

        echo
        "
            <section class='h-75'>
                <div class='d-flex justify-content-center align-items-center h-75'>
                    <div class='box-form'>
                        <div class='d-flex justify-content-center align-items-center flex-column w-100 h-100'>
                            <h1>Recuperação de Senha</h1>
                            <br>
                            <form action='$_SERVER[PHP_SELF]' method='post' class='formulario flex flex--coluna form-alt w-50 formResg'>
        ";

        if ($logado) {

            $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';
            $dadosUsuario = $sql -> query("SELECT email FROM $usuario WHERE matricula = '$matricula'");
        
            while ($dados = mysqli_fetch_array($dadosUsuario)) {
                $email = $dados['email'];
            }

            echo "
                                <input hidden value='$email' id='email' name='email'>
                                <input hidden value='$matricula' id='matricula' name='matricula'>
            ";

        } else {
            
            echo
            "
                                <div class='w-100'>
                                    <div class='form-group'>
                                        <div class='input-container'>
                                            <label for='email'><strong>E-mail</strong></label>
                                            <input id='email' class='input' name='email' type='email' required
                                            data-tipo='email'>
                                            <span class='input-mensagem-erro'>Este campo não está valido</span>
                                        </div>
                                    </div>
                                </div>
                                <div class='w-100'>
                                    <div class='form-group'>
                                        <div class='input-container'>
                                            <label for='matricula'><strong>Matricula</strong></label>
                                            <input id='matricula' class='input' name='matricula' type='text' required
                                            data-tipo='matricula'>
                                            <span class='input-mensagem-erro'>Este campo não está valido</span>
                                        </div>
                                    </div>
                                </div>
            ";
        }
        
        echo
        "
                                <div class='w-100'>
                                    <div class='form-group'>
                                        <div class='input-container'>
                                            <label class='text-center' for='nascimento'><strong>Informe sua Data de Nascimento para que possamos confirmar sua identidade</strong></label>
                                            <input id='nascimento' class='input' name='nascimento' placeholder='#' type='text' required min-leng minlength='10' data-tipo='dataNascimento'>
                                            <span class='input-mensagem-erro'>Este campo não está valido</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='d-flex justify-content-center'>
                                    <input type='submit' value='CONFIRMAR INFORMAÇÕES' class='btn btn-outline-secondary bg-color text-light' id='submit'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        ";
    
    } else {

        $matricula = $_POST['matricula'];
        $email = $_POST['email'];
        $nascimento = $_POST['nascimento'];
        
        $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';
        $dadosUsuario = $sql -> query("SELECT nasc FROM $usuario WHERE matricula = '$matricula' AND email = '$email'");

        while ($dados = mysqli_fetch_array($dadosUsuario)) {
            $nasc = implode('/',array_reverse(explode('-',$dados ['nasc'])));
        }

        if (mysqli_num_rows($dadosUsuario) != 0 and $nasc == $nascimento) {
            
            $_SESSION['matricula'] = $matricula;
            echo
            "
                <section class='h-75'>
                        <div class='d-flex justify-content-center align-items-center h-100'>
                            <div class='box-form'>
                                <div class='d-flex justify-content-center align-items-center flex-column w-100 h-100'>
                                    <h1>Recuperação de Senha</h1>
                                    <br>
                                    <form action='Auxiliares/alterSenha.php?rescue=0' method='post' class='formulario flex flex--coluna form-alt w-50 formResg'>
                                        <div>
                                            <div class='w-100'>
                                                <div class='form-group'>
                                                    <div class='input-container'>
                                                        <label for='senha'><strong>Nova senha</strong></label>
                                                        <input id='senha' class='input' type='password' data-tipo='senhaCad'  name='senha' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ \\\/!@#$%^&*_=+-]).{6,12}$'>
                                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='w-100'>
                                                <div class='form-group'>
                                                    <div class='input-container'>
                                                        <label for='senhaNov'><strong>Repita a nova senha</strong></label>
                                                        <input id='senhaNov' class='input' type='password' data-tipo='senhaNov'  name='senhaNov' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ \\\/!@#$%^&*_=+-]).{6,12}$'>
                                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class='d-flex justify-content-center'>
                                        <input type='submit' value='ALTERAR SENHA' class='btn btn-outline-secondary bg-color text-light' id='submit'>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            ";
        } else {
            echo
            "
                <section class='h-75' id='secao_alterSenha'>
                    <div class='d-flex justify-content-center align-items-center h-100'>
                        <div class='box-form'>
                            <div class='d-flex justify-content-center align-items-center flex-column w-100 h-100'>
                                <h1 class='text-center'>Informações incorretas favor tente novamente<h1>
                            </div>
                        </div>
                    </div>
                </section>
            ";
            unset($_POST);
            header("Refresh: 2; resgSenha.php");
        }
    }
    
    echo
    "
    </body>

        <!-- SCRIPTS -->
        <script src='../assets/js/app.js' type='module'></script>
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/libs/jquery.mask.js'></script>
        <script src='../assets/js/mascara.js'></script>
        <script src='../assets/js/resgSenha.js'></script>
        <script>
            function goBack() {
                window.history.back()
            }
        </script>
    </html>
    ";

?>