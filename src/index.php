<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['matricula'])) {
		header('Location: php/perfil.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Code - Home</title>
    <!-- FAVICON -->
    <link rel='icon' type='imagem/png' href='assets/img/logoEASYCODE.png'>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/stylehome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ICONS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>  
</head>

<body class="hidden">

    <div class="d-none d-xl-block">
        <img class="img" src="assets/img/bgimg-mascote.png">
    </div>
    <!-- HEADER -->
    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light nonSelect">
            <div class="container">
                <a class="navbar-brand Lovelofont" href="index.php"><img width="35" src="assets/img/logoEASYCODE.png"
                        alt="Logo EC">
                    EASYCODE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav Josefinfont d-flex justify-content-center align-items-center p-1">
                        <li id="select" class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/pagecursos.php">Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/cadastro_login.php">Inscreva-se / Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/sobrenos.php">Sobre nós</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- TEXTOS -->
        <section class="text">
            <div class="m-5">
                <div class="typewriter">
                    <p id="text">EASYCODE sua plataforma ideal para aprender programação </p>
                </div>

                <div class="text2">
                    <p>Aprenda diferentes linguagens
                        <br> de programacao aqui na easycode
                    </p>
                </div>
                <a href="php/pagecursos.php" class="btn btn-success rounded-pill p-3 btn-lg ">Saiba mais &nbsp; &nbsp;
                    <b class="bi bi-arrow-right" aria-hidden="true">
                    </b>
                </a>
            </div>
        </section>
    </header>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/typeWriter.js"></script>
    <script src="assets/js/nav.js"></script>
</body>

</html>