<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <!-- FAVICON -->
    <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sobrenos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body class="Background">

    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top Background nonSelect">
            <div class="container">
                <a class="navbar-brand Lovelofont"><img width="35" src="../assets/img/logoEASYCODE.png"
                        alt="Logo EC">
                    EASYCODE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse Josefinfont" id="navbarSupportedContent">
                    <?php

                        include 'Auxiliares/connect.php';

                        // !Testa se esta logado ou não
                        if (!isset($_SESSION)) {
                            session_start();
                        }
                        
                        // !Testa se esta logado ou não
                        $logado = false;
                        if (isset($_SESSION['matricula'])) {
                            // !Testa se quem está logado é aluno ou professor
                            $logado = true;
                            $usuario = '';
                            $matricula = $_SESSION['matricula'];
                            $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';

                            $dadosUsuario = $sql -> query("SELECT * FROM $usuario WHERE matricula = '$matricula'");

                            while ($dados = mysqli_fetch_array($dadosUsuario)) {
                                $nome = explode(' ',$dados['nome'])[0];
                                $avatar = $dados['avatar'];
                            }
                        }

                        if ($logado) {
                            echo
                            "
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='pagecursos.php'>Cursos</a>
                                </li>
                                <li id='select' class='nav-item d-flex align-items-center'>
                                    <a class='nav-link' href='sobrenos.php'>Sobre nós</a>
                                </li>
                            </ul>
                            ";
                            if ($usuario == "aluno") {
                                echo 
                                "
                                <ul class='navbar-nav ml-auto'>
                                    <li class='nav-item dropdown'>
                                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                            data-bs-toggle='dropdown' aria-expanded='false'>
                                            $nome
                                            <img src='../assets/img/Avatares/$avatar' class='rounded-circle' height='25'/>
                                        </a>
    
                                        <div class='dropdown-menu Background' aria-labelledby='navbarDropdown'>
                                            <a class='dropdown-item' href='perfil.php'>
                                                <i class='bi bi-person-circle'></i> Perfil
                                            </a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='perfil.php'>
                                                <i class='bi bi-journal-check'></i> Cursos Matriculados
                                            </a>
                                            <a class='dropdown-item' href='perfil.php?secoes=certificados'>
                                                <i class='bi bi-award-fill'></i> Certificados
                                            </a>
                                            <a class='dropdown-item' href='Auxiliares/sair.php'>
                                                <i class='bi bi-box-arrow-right'></i> Sair
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                ";
                            }
                            else{
                                echo 
                                "
                                <ul class='navbar-nav ml-auto'>
                                    <li class='nav-item dropdown'>
                                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                            data-bs-toggle='dropdown' aria-expanded='false'>
                                            $nome
                                            <img src='../assets/img/Avatares/$avatar' class='rounded-circle' height='25'/>
                                        </a>
    
                                        <div class='dropdown-menu Background' aria-labelledby='navbarDropdown'>
                                            <a class='dropdown-item' href='perfil.php'>
                                                <i class='bi bi-person-circle'></i> Perfil
                                            </a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='perfil.php?secoes=ministrarCursos'>
                                                <i class='bi bi-journal-plus'></i> Ministrar cursos
                                            </a>
                                            <a class='dropdown-item' href='Auxiliares/sair.php'>
                                                <i class='bi bi-box-arrow-right'></i> Sair
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                ";     
                            }
                        }
                        else{
                            echo
                            "
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='../index.php'>Home</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='pagecursos.php'>Cursos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='cadastro_login.php'>Inscreva-se / Entrar</a>
                                </li>
                                <li id='select' class='nav-item d-flex align-items-center'>
                                    <a class='nav-link' href='sobrenos.php'>Sobre nós</a>
                                </li>
                            </ul>
                            ";
                        }
                    ?>
                </div>
            </div>
        </nav>
        <div class="imagem-header">
            <div class="area-imagem">
                <div class="m-5 text-center">
                    <h1 class="text-uppercase Lovelofont">SOBRE NÓS</h1>
                    <p>
                        A Easy Code foi criada com o intuito de fornecer um aprendizado nas diversas linguagens de
                        programação
                        de forma rápida, interativa e didática. Buscamis oferecer uma porta de entrada para pessoas que
                        estão
                        pensando em iniciar carreira na área de desenvolvimento.
                    </p>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER -->

    <!-- MISSÃO, VISÃO E VALORES -->                
    <section class="pt-4 container text-center">
        <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-sm-6">
                <div class="counter">
                    <div class="counter-icon">
                        <i class="bi bi-flag-fill"></i>
                        <h3>Missão</h3>
                    </div>
                    <div class="counter-content">
                        <span>
                            Trazer um ensino interativo e de qualidade que incentive o aluno a crescer no ramo da programação
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="counter">
                    <div class="counter-icon">
                        <i class="bi bi-eye-fill"></i>
                        <h3>Visão</h3>
                    </div>
                    <div class="counter-content">
                        <span>
                            Se tornar a maior plataforma de ensino de programação.
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="counter">
                    <div class="counter-icon">
                        <i class="bi bi-star-fill"></i>
                        <h3>Valores</h3>
                    </div>
                    <div class="counter-content">
                        <span>
                            <p>Integridade</p>
                            <p>Comprometimento</p>
                            <p>Inovação</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MISSÃO, VISÃO E VALORES -->  

    <!-- DESENVOLVEDORES -->  
    <section class="pt-4 pb-4 container">
        <h3 class="text-center">Desenvolvedores</h3>
        <div class="row g-3 ">
            <div class="col">
                <div class="card fundocard">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img src="../assets/img/Desenvolvedores/ERIKA.jpg">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3"></div>
                        <div class="my-2 text-center">
                            <h3>Erika Nunes</h3>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-uppercase text-center text-muted">Full-Stack</h2>
                        </div>
                        <div class="box">
                            <div>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="https://github.com/ErikaNS123" class="redes">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.linkedin.com/in/erika-nunes-8868a8154/" class="redes">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.instagram.com/kinhanuness/" class="redes">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card fundocard">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img src="../assets/img/Desenvolvedores/JEFFERSON.jpg">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3"></div>
                        <div class="my-2 text-center">
                            <h3>Jefferson Gomes</h3>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-uppercase text-center text-muted">Front-End</h2>
                        </div>
                        <div class="box">
                            <div>
                            <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="https://github.com/Jeffersonpingu" class="redes">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.linkedin.com/in/jefferson-gomes-de-souza-48a214207/" class="redes">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.instagram.com/pinguimbear/" class="redes">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card fundocard">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img src="../assets/img/Desenvolvedores/JONATHAN.jpg">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3"></div>
                        <div class="my-2 text-center">
                            <h3>Jonathan de Jesus</h3>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-uppercase text-center text-muted">Full-Stack</h2>
                        </div>
                        <div class="box">
                            <div>
                            <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="https://github.com/zezus9" class="redes">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.linkedin.com/in/jonathan-de-jesus9/" class="redes">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.instagram.com/zezus9/" class="redes">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card fundocard">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img src="../assets/img/Desenvolvedores/PRISCILA.jpg">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3"></div>
                        <div class="my-2 text-center">
                            <h3>Priscila da Silva</h3>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-uppercase text-center text-muted">Front-End</h2>
                        </div>
                        <div class="box">
                            <div>
                            <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="https://github.com/Priscilamiguel67" class="redes">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="redes">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.instagram.com/priscylla__m/" class="redes">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DESENVOLVEDORES -->  

    <!-- FOOTER -->
    <footer class="text-center text-white text-lg-start Footer">
        <div class="container p-4 pb-0">
            <div class="row">
                <div class="col-lg-6 mb-md-0">
                    <h5 class="text-uppercase">Easy Code</h5>
                    <p>
                        A plataforma ideal para aprender linguagem de programação.
                    </p>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center p-3 Copyright">
            © 2022 Easy Code - Todos os Direitos Reservados.
        </div>
        <!-- Copyright -->
    </footer>
    <!-- FOOTER -->

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/nav.js"></script>
</body>

</html>