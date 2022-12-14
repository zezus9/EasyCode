<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <!-- FAVICON -->
    <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pagecursos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body class="Background" onload="carousel()">

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
                                <li id='select' class='nav-item d-flex align-items-center'>
                                    <a class='nav-link' href='pagecursos.php'>Cursos</a>
                                </li>
                                <li class='nav-item'>
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
                                <li id='select' class='nav-item d-flex align-items-center'>
                                    <a class='nav-link' href='pagecursos.php'>Cursos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='cadastro_login.php'>Inscreva-se / Entrar</a>
                                </li>
                                <li class='nav-item'>
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
                <div class="m-5">
                    <h1 class="text-uppercase Lovelofont">CURSOS</h1>
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

                        if ($logado) {
                            echo
                            "
                                <p>A melhor plataforma para aprender programação <br> Aproveite os benefícios de fazer parte da equipe Easy Code</p>
                                <a href='perfil.php' class='btn btn-success p-2 btn-lg'>&nbsp;&nbsp;Matriculas&nbsp;&nbsp;</a>
                            ";
                        } else{
                            echo 
                            "
                                <p>A melhor plataforma para aprender programação <br> Venha se tornar um aluno da Easy Code</p>
                                <a href='cadastro_login.php' class='btn btn-success p-2 btn-lg'>&nbsp;&nbsp;Inscrever-se&nbsp;&nbsp;</a>
                            ";
                        }
                    ?>
                </div>
                <div class="col-auto d-none d-lg-block m-3">
                    <img src="../assets/img/mascotecomlogo.png" width="200px" />
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER -->
    
    <!-- Área de pesquisa -->
    <section class="container">    
        <a name='frontend'>
            <form class="m-3">
                <h3 class="d-block text-center">Pesquisar cursos</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <input class="form-control w-50 d-block" id="busca" type="text" placeholder="O que deseja aprender?">        
                </div>
            </form>
        </a>
    </section><br>
    <!-- Área de pesquisa -->

    <div class="container-xl">
        <div id="result"></div>
    </div>

    <!-- Cards de Cursos -->
    <div class="container-xl">
    <?php

        include 'Auxiliares/connect.php';
        
        $FrontEnd = array();
        $BackEnd = array();
        $Database = array();
        $apresentacard = $sql -> QUERY('SELECT * FROM curso ORDER BY linguagem');

        while($card = mysqli_fetch_array($apresentacard)){

            $id = $card['id'];
            $campo = $card['campo'];

            if($campo == 'FrontEnd'){
                array_push($FrontEnd, $id);
            }
            elseif($campo == 'BackEnd'){
                array_push($BackEnd, $id);
            }
            else{
                array_push($Database, $id);
            }
        }

        echo "
            <div class='row'>
                <div>
                    <h3>Front-End</h3>
                    <div class='owl-carousel'>
        ";
        for ($i=0; $i < count($FrontEnd); $i++){
            $apresentaCard = $sql -> QUERY("SELECT * FROM curso WHERE id = '$FrontEnd[$i]'");
            while ($card = mysqli_fetch_array($apresentaCard)) {
                echo 
                "
                <div class='card'>
                    <figure class='fundocard'>
                        <img src='../assets/img/logo_cursos/$card[logo]'>
                    </figure>
                    <div class='abadedescricao'>
                        <div class='abacard'>
                            <div>
                                <h5 class='titulo'>$card[linguagem]</h5>
                                <span class='subtitulo'>
                                    <i class='fa-solid fa-clock'></i>
                                    Duração: $card[duracao]
                                </span>
                                <br>
                                <a href='template_cursos.php?curso=$card[id]' class='btn botao'>
                                    <i class='bi bi-pencil-square'>&nbsp;</i>
                                    Inscrever-se
                                </a>
                            </div>
                        </div>
                        <p class='descricao'>$card[desc_breve]</p>
                    </div>
                </div>
                ";
            }
        }

        echo 
        "
                </div>
            </div>
        </div>
        <a name='backend'><br></a>
        <div class='row'>
            <div>
                <h3>Back-End</h3>
                <div class='owl-carousel'>
        ";
        for ($i=0; $i < count($BackEnd); $i++){
            $apresentaCard = $sql -> QUERY("SELECT * FROM curso WHERE id = '$BackEnd[$i]'");
            while ($card = mysqli_fetch_array($apresentaCard)) {
                echo 
                "
                <div class='card'>
                    <figure class='fundocard'>
                        <img src='../assets/img/logo_cursos/$card[logo]'>
                    </figure>
                    <div class='abadedescricao'>
                        <div class='abacard'>
                            <div>
                                <h5 class='titulo'>$card[linguagem]</h5>
                                <span class='subtitulo'>
                                    <i class='fa-solid fa-clock'></i>
                                    Duração: $card[duracao]
                                </span>
                                <br>
                                <a href='template_cursos.php?curso=$card[id]' class='btn botao'>
                                    <i class='bi bi-pencil-square'>&nbsp;</i>
                                    Inscrever-se
                                </a>
                            </div>
                        </div>
                        <p class='descricao'>$card[desc_breve]</p>
                    </div>
                </div>
                ";
            }
        }

        echo 
        "
                </div>
            </div>
        </div>
        <a name='database'><br></a>
        <div class='row'>
            <div>
                <h3>Databases</h3>
                <div class='owl-carousel'>
        ";
        for ($i=0; $i < count($Database); $i++){
            $apresentaCard = $sql -> QUERY("SELECT * FROM curso WHERE id = '$Database[$i]'");
            while ($card = mysqli_fetch_array($apresentaCard)) {
                echo 
                "
                <div class='card'>
                    <figure class='fundocard'>
                        <img src='../assets/img/logo_cursos/$card[logo]'>
                    </figure>
                    <div class='abadedescricao'>
                        <div class='abacard'>
                            <div>
                                <h5 class='titulo'>$card[linguagem]</h5>
                                <span class='subtitulo'>
                                    <i class='fa-solid fa-clock'></i>
                                    Duração: $card[duracao]
                                </span>
                                <br>
                                <a href='template_cursos.php?curso=$card[id]' class='btn botao'>
                                    <i class='bi bi-pencil-square'>&nbsp;</i>
                                    Inscrever-se
                                </a>
                            </div>
                        </div>
                        <p class='descricao'>$card[desc_breve]</p>
                    </div>
                </div>
                ";
            }
        }
    ?>
                </div>
            </div>
        </div><br>
    </div>
    <!-- Cards de Cursos -->

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
    <script src="../assets/js/pagecursos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/libs/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="../assets/js/nav.js"></script>
    <script>
        $("#busca").keyup(function(){
            var busca = $("#busca").val();
            if (busca.length > 0) {
                $.post('Auxiliares/pesquisa-pagecursos.php', {busca: busca},function(data){
                    $("#result").html(data);
                });
            } else {
                $("#result").html("");
            }
        });
    </script>
    <!-- SCRIPTS -->
</body>
</html>