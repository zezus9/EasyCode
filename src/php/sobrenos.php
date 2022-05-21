<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sobrenos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Sobre Nós</title>
</head>

<body class="Background">

    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top Background nonSelect">
            <div class="container">
                <a class="navbar-brand Lovelofont" href="../Home.html"><img width="35" src="../assets/img/logoEASYCODE.png"
                        alt="Logo EC">
                    EASYCODE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse Josefinfont" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                            <a class="nav-link" href="../Home.html">Home</a>
                        </li>
                        <li id="select" class="nav-item">
                            <a class="nav-link" href="pagecursos.php">Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cadastro_login.html">Inscreva-se / Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sobrenos.php">Sobre nós</a>
                        </li>
                    </ul>
                    <?php

                        include 'Auxiliares/connect.php';

                        $Aluno     = $sql -> query("SELECT * FROM aluno");

                        if () {
                            echo 
                            "
                            <ul class='navbar-nav ml-auto'>
                                <li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                        data-bs-toggle='dropdownV aria-expanded='false'>
                                        Aluno
                                        <!-- <img src='assets/img/Avatares/default_image.png' class='rounded-circle'
                                        height='25'/> -->
                                    </a>

                                    <div class='dropdown-menu Background' aria-labelledby='navbarDropdown'>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-person-circle'></i> Perfil
                                        </a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-journal-check'></i> Cursos Matriculados
                                        </a>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-award-fill'></i> Certificados
                                        </a>
                                        <a class='dropdown-item' href='#'>
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
                                        data-bs-toggle='dropdownV aria-expanded='false'>
                                        Professor
                                        <!-- <img src='assets/img/Avatares/default_image.png' class='rounded-circle'
                                        height='25'/> -->
                                    </a>

                                    <div class='dropdown-menu Background' aria-labelledby='navbarDropdown'>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-person-circle'></i> Perfil
                                        </a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='#'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-stack-overflow' viewBox='0 0 16 16'>
                                                <path d='M12.412 14.572V10.29h1.428V16H1v-5.71h1.428v4.282h9.984z'/>
                                                <path d='M3.857 13.145h7.137v-1.428H3.857v1.428zM10.254 0 9.108.852l4.26 5.727 1.146-.852L10.254 0zm-3.54 3.377 5.484 4.567.913-1.097L7.627 2.28l-.914 1.097zM4.922 6.55l6.47 3.013.603-1.294-6.47-3.013-.603 1.294zm-.925 3.344 6.985 1.469.294-1.398-6.985-1.468-.294 1.397z'/>
                                            </svg> Ministrar cursos
                                        </a>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-journal-plus'></i> Cadastro de cursos
                                        </a>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-chat-text-fill'></i> Mensagens
                                        </a>
                                        <a class='dropdown-item' href='#'>
                                            <i class='bi bi-box-arrow-right'></i> Sair
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            ";     
                        }
 
                    ?>
                    
                    
                               
                            <div class="dropdown-menu Background" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person-circle"></i> Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stack-overflow" viewBox="0 0 16 16">
                                        <path d="M12.412 14.572V10.29h1.428V16H1v-5.71h1.428v4.282h9.984z"/>
                                        <path d="M3.857 13.145h7.137v-1.428H3.857v1.428zM10.254 0 9.108.852l4.26 5.727 1.146-.852L10.254 0zm-3.54 3.377 5.484 4.567.913-1.097L7.627 2.28l-.914 1.097zM4.922 6.55l6.47 3.013.603-1.294-6.47-3.013-.603 1.294zm-.925 3.344 6.985 1.469.294-1.398-6.985-1.468-.294 1.397z"/>
                                    </svg> Ministrar cursos
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-journal-plus"></i> Cadastro de cursos
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-chat-text-fill"></i> Mensagens
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-box-arrow-right"></i> Sair
                                </a>
                            </div>
                        </li>
                    </ul>
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

    <section class="container">
        <h3 class="text-center">Desenvolvedores</h3>
        <div class="row g-3">
            <div class="col">
                <div class="card fundocard">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img src="../assets/img/Avatares/default_image.png">
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
                                    <li class="list-inline-item redes"><i class="bi bi-github"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-linkedin"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-instagram"></i></li>
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
                            <img src="../assets/img/Avatares/default_image.png">
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
                                    <li class="list-inline-item redes"><i class="bi bi-github"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-linkedin"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-instagram"></i></li>
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
                            <img src="../assets/img/Avatares/default_image.png">
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
                                    <li class="list-inline-item redes"><i class="bi bi-github"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-linkedin"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-instagram"></i></li>
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
                            <img src="../assets/img/Avatares/default_image.png">
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
                                    <li class="list-inline-item redes"><i class="bi bi-github"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-linkedin"></i></li>
                                    <li class="list-inline-item redes"><i class="bi bi-instagram"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

</body>

</html>