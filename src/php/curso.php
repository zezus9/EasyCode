<?php

    include 'Auxiliares/connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    // !Testa se esta logado ou não
    $logado = false;
    if (isset($_SESSION['matricula'])) {
        // !Testa se quem está logado é aluno ou professor
        $logado = true;
        $matricula = $_SESSION['matricula'];
        $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';
    }
    else{
        header('Location: cadastro_login.php');
    }

    clearstatcache();

    $dadosUsuario = $sql -> query("SELECT * FROM $usuario WHERE matricula = '$matricula'");
    
    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $nome = explode(' ',$dados['nome'])[0];
        $avatar = $dados['avatar'];
    }

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <!--link do icon-->
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$nome</title>
        <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

        <link rel='stylesheet' href='../assets/css/curso.css'>
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/inputs.css'>

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
            <div class='d-flex justify-content-center align-items-center flex-column h-100 w-100'>
                <div class='d-flex justify-content-center align-items-center flex-column h-75 w-100'>
                    <ul class='menu-elements w-100'>
                        <li class='active'>
                            <label for='home' onclick='opcoes("home")'>
                                <span>
                                    <i class='bi bi-house-door-fill'></i>
                                </span>
                                <span>Introdução ao curso</span>
                            </label>
                            <input type='radio' name='opcoes' id='home' class='opcoes'>
                        </li>
                        <li>
                            <label for='home' onclick='opcoes("home")'>
                                <span>
                                    <i class='bi bi-house-door-fill'></i>
                                </span>
                                <span>Introdução ao curso</span>
                            </label>
                            <input type='radio' name='opcoes' id='home' class='opcoes'>
                        </li>
                    </ul>
                </div>
                <div class='navbar navbar-expand navbar-light nonSelect'>
                    <div class="collapse navbar-collapse Josefinfont" id="navbarSupportedContent">
                        <ul class='navbar-nav ml-auto d-flex justify-content-center'>
                            <li class='dropup'>
                                <a class='nav-link dropdown-toggle text-center text-light' href='#' id='navbarDropdown' role='button'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <span>Jonathan</span>
                                </a>
                                <img src='../assets/img/Avatares/d_img.png' class='rounded-circle' height='100em'/>
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
            </div>
        </nav>

        <div>
            <!-- Abrir menu -->
            <a class='botao-hamburguer abrir-menu' href='#' role='button'>
                <i class='bi bi-list'></i> 
            </a>
        </div>
        <!-- Sidebar -->
        <nav class='sidebar d-flex justify-content-around align-items-center flex-column'>
            <div class='d-flex justify-content-center align-items-center flex-column h-75 w-100'>
                <ul class='menu-elements w-100'>
                    <li class='active'>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                    <li>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Introdução ao curso</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes'>
                    </li>
                </ul>
            </div>
            <div class='navbar navbar-expand navbar-light nonSelect'>
                <div class="collapse navbar-collapse Josefinfont" id="navbarSupportedContent">
                    <ul class='navbar-nav ml-auto d-flex justify-content-center'>
                        <li class='dropup'>
                            <a class='nav-link dropdown-toggle text-center text-light' href='#' id='navbarDropdown' role='button'
                                data-bs-toggle='dropdown' aria-expanded='false'>
                                <span>Jonathan</span>
                            </a>
                            <img src='../assets/img/Avatares/d_img.png' class='rounded-circle border-image' height='100em'/>
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
        
        <section class='secao secaoAp' id='secao_home'>
            <h1>Questões</h1>
        </section>
        echo
        "
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/sidebar.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js'></script>
    </body>
    </html>
curso;
?>