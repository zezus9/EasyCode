<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pagecursos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- JS -->
    <script src="../assets/js/pagecursos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
        crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Cursos</title>
</head>

<body class="Background" onload="carousel()">

    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top Background">
            <div class="container">
                <a class="navbar-brand Lovelofont" href="Home.html"><img width="35" src="../assets/img/logoEASYCODE.png"
                        alt="Logo EC">
                    EASYCODE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav Josefinfont d-flex justify-content-center align-items-center p-1">
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
                            <a class="nav-link" href="../sobrenos.html">Sobre nós</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="imagem-header">
            <div class="area-imagem">
                <div class="m-5">
                    <h1 class="text-uppercase Lovelofont">CURSOS</h1>
                    <p>A melhor plataforma para aprender programação <br> Venha se tornar um aluno da Easy Code</p>
                    <a href="../cadastro_login.html" class="btn btn-success p-2 btn-lg ">&nbsp;&nbsp;Inscrever-se&nbsp;&nbsp;</a>
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
        <form>     
            <h3 class="text-center">Pesquisar cursos</h3>
            <input class="form-control" id="busca" type="text" placeholder="O que deseja aprender?">        
        </form>
    </section><br>
    <!-- Área de pesquisa -->

    <div class="container-xl">
        <p id="result"></p>
    </div>

    <!-- Cards de Cursos -->
    <div class="container-xl">
    <?php

        include 'connect.php';
        
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
                                <a href='template_cursos.php' class='btn botao'>
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
        <div class='row'>
            <div><br>
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
                                <a href='template_cursos.php' class='btn botao'>
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
        <div class='row'>
            <div><br>
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
                                <a href='template_cursos.php' class='btn botao'>
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
                <p class="col-lg-6 mb-md-0 text-center">
                    <span>
                        Acompanhe-nos nas Redes Sociais <br>
                        <!-- Instagram -->
                        <a class="btn btn-outline-light m-1 logo-instagram" href="#!" role="button">
                            <b class="bi bi-instagram"></b>
                        </a>

                        <!-- Linkedin -->
                        <a class="btn btn-outline-light m-1 logo-linkedin" href="#!" role="button">
                            <b class="bi bi-linkedin"></b>
                        </a>

                        <!-- Github -->
                        <a class="btn btn-outline-light m-1 logo-github" href="#!" role="button">
                            <b class="bi bi-github"></b>
                        </a>
                    </span>
                    <br><br>
                </p>
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center p-3 Copyright">
            © 2022 Easy Code - Todos os Direitos Reservados.
        </div>
        <!-- Copyright -->
    </footer>
    <!-- FOOTER -->
    <script>
        $("#busca").keyup(function(){
            var busca = $("#busca").val();
            if (busca.length > 0) {
                $.post('pesquisa-pagecursos.php', {busca: busca},function(data){
                    $("#result").html(data);
                });
            } else {
                $("#result").html("");
            }
        });
    </script>

</body>
</html>