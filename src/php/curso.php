<?php
    
    // http://localhost/EasyCode/src/php/curso.php?curso=005

    include 'Auxiliares/connect.php';

    if (!isset($_SESSION) || !isset($_GET['curso'])) {
        session_start();
    }
    
    // !Testa se esta logado ou não
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        if (substr($matricula,0,1) == 1) {
            header('Location: cadastro_login.php');    
        }
    }
    else{
        header('Location: cadastro_login.php');
    }

    $dadosUsuario = $sql -> query("SELECT * FROM aluno WHERE matricula = '$matricula'");
    
    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $nome = explode(' ',$dados['nome'])[0];
        $avatar = $dados['avatar'];
    }

    $id_curso = $_GET['curso'];

    $curso = $sql -> query("SELECT linguagem from curso WHERE id = '$id_curso'");

    while ($aulas = mysqli_fetch_array($curso)){
        $linguagem = $aulas['linguagem'];
    }

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <!--link do icon-->
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$linguagem</title>
        <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

        <link rel='stylesheet' href='../assets/css/curso.css'>
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/inputs.css'>
        <link rel='stylesheet' href='../assets/css/sidebar.css'>

        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    </head>
    ";

    echo <<<curso
    <body>
        <div>
            <a class='botao-hamburguer abrir-menu' href='#' role='button'>
                <i class='bi bi-list'></i> 
            </a>
        </div>
        <nav class='sidebar'>
            <div class='fechar-x'>
                <i class='bi bi-x'></i>
            </div>
            <div class='d-flex justify-content-center flex-column h-75 w-100'>
                <ul class='menu-elements w-100'>
curso;

    $arquivo = fopen ("../cursos/$linguagem/fases.txt", 'r');
    while(!feof($arquivo)) {
        $linha = fgets($arquivo, 1024);

        echo
        "
            <li class='aulas'>
                <span>
                    <i class='bi bi-house-door-fill'></i>
                </span>
                <span>$linha</span>
            </li>
        ";
    }
    fclose($arquivo);

    echo
    "                    
                </ul>
            </div>
            <div class='navbar navbar-expand navbar-light nonSelect'>
                <div class='collapse navbar-collapse Josefinfont' id='navbarSupportedContent'>
                    <ul class='navbar-nav ml-auto d-flex justify-content-center'>
                        <li class='dropup perfil text-center'>
                            <a class='dropdown-toggle text-light' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <span>$nome</span>
                            </a>
                            <br class='m-5 p-5'>
                            <img src='../assets/img/Avatares/$avatar' class='rounded-circle' height='100em'/>
                            <div class='dropdown-menu border border-2 fundocard' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='perfil.php'>
                                    <i class='bi bi-person-circle'></i> Perfil
                                </a>
                                <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='perfil.php'>
                                    <i class='bi bi-journal-check'></i> Cursos Matriculados
                                </a>
                                <a class='dropdown-item' href='#'>
                                    <i class='bi bi-award-fill'></i> Certificados
                                </a>
                                <a class='dropdown-item' href='Auxiliares/sair.php'>
                                    <i class='bi bi-box-arrow-right'></i> Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>      
        
        <section class='secao fixed-left'>
            <h1>$linguagem</h1>
        </section>
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/sidebar.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js'></script>
    </body>
    </html>
    ";
?>