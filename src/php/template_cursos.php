<?php
    include 'Auxiliares/connect.php';

    if (!isset($_GET['curso'])) {
        header('Refresh: 0;pagecursos.php');
    }
    
    $id_curso = $_GET['curso'];

    $buscaCurso = $sql -> 
            query("SELECT 
                    cur.linguagem, cur.desc_breve,cur.logo,cur.duracao,cur.fase,
                    prof.nome as nome_prof,prof.avatar,prof.destaque
                FROM curso AS cur
                INNER JOIN professor AS prof ON cur.id_responsavel = prof.id
                WHERE cur.id = '$id_curso'");

    while ($curso = mysqli_fetch_array($buscaCurso)){
        $linguagem = $curso['linguagem'];
        $desc_breve = $curso['desc_breve'];
        $logo = $curso['logo'];
        $avatar = $curso['avatar'];
        $nome_prof = $curso['nome_prof'];
        $destaque = $curso['destaque'];
        $duracao = $curso['duracao'];
        $fase = $curso['fase'];
    }

    // ! HEAD
    echo
    "
    <!DOCTYPE html>
    <html lang='pt-br'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$linguagem</title>
        <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/pagecursos.css'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'
            integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>        
    </head>

    <body class='Background'>
    ";

    // !Header
    echo
    "
        <header>
            <nav class='navbar navbar-expand-lg navbar-light fixed-top Background nonSelect'>
                <div class='container'>
                    <a class='navbar-brand Lovelofont' href='Home.html'><img width='35' src='../assets/img/logoEASYCODE.png'
                            alt='Logo EC'>
                        EASYCODE</a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'
                        aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='navbarNav'>
                        <ul class='navbar-nav Josefinfont d-flex justify-content-center align-items-center p-1'>
                            <li class='nav-item'>
                                <a class='nav-link' href='../Home.html'>Home</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='pagecursos.php'>Cursos</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='../cadastro_login.html'>Inscreva-se / Entrar</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='../sobrenos.html'>Sobre nós</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class='imagem-header'>
                <div class='area-imagem'>
                    <div class='align-self-center'>
                        <h1 class='text-uppercase Lovelofont'>$linguagem</h1>
                        <p>$desc_breve</p>
                    </div>
                    <div class='col-auto d-none d-lg-block m-6'>
                        <img src='../assets/img/logo_cursos/menores/$logo' width='300px'/>
                    </div>
                </div>
        </header>
    ";

    // !Apresentação dos cursos
    echo
    "
        <article class='container'>
            <br>
            <div class='row'>
                <div class='col-12 col-lg-6 col-xl-7 me-auto'>
                    <div class='d-flex flex-column'>
                        <div>
                            <div class='text-muted'>
                                <h5 class='fw-bolder'>Sobre o curso</h5>
                                <div class='text-muted'>
    "
    ;
    
    $arquivo = fopen ("../cursos/$linguagem/descricao.txt", 'r');
    echo "<p>";
    while(!feof($arquivo)) {
        $linha = fgets($arquivo, 1024);
        echo $linha.'<br />';
    }
    echo "</p>";
    fclose($arquivo);

    echo
    "
                                </div>
                                <h4>Professor</h4>
                                <div>
                                    <div class='d-flex d-inline-block m-1'>
                                        <div class='d-flex align-center col-md-3 col-sm-6'>
                                            <img src='../assets/img/Avatares/$avatar' width='100%'>
                                        </div>
                                        <div class='col-md-8  col-sm-6'>
                                            <div class='h-25 d-flex justify-content-start align-items-end'>
                                                <h5 class='text-center'>$nome_prof</h5>
                                            </div>
                                            <div class='h-75 d-flex justify-content-center align-items-center'>
                                                <p>$destaque</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>Duração</h4>
                                <p>O curso terá duração de $duracao horas.</p>
                                <h4>Fases</h4>
                                <p>Apresentará $fase fases.</p>
                                <h4>Conteúdo a ser aprendido</h4>
    ";

    $arquivo = fopen ("../cursos/$linguagem/conteudo.txt", 'r');
    echo "<p>";
    while(!feof($arquivo)) {
        $linha = fgets($arquivo, 1024);
        echo $linha.'<br />';
    }
    echo "</p>";
    fclose($arquivo);

    echo
    "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-12 col-lg-6 col-xl-4'>
                    <div class='sticky-top'>
                        <br>
                        <div class='card shadow fundocard'>
                            <div class='card-body p-xl-5 pb-xl-4'>
                                <h5 class='text-center text-uppercase fw-bolder mb-4'>Vantagens em aprender na Easy Code
                                </h5>
                                <div class='d-grid gap-3 fw-bold text-muted'>
                                    <div class='d-flex flex-row align-items-center'>
                                        <div class='me-3'>
                                            <i class='bi bi-check-circle-fill' style='font-size:1.3rem;'></i>
                                        </div>
                                        Curso 100% gratuito
                                    </div>
                                    <div class='d-flex flex-row align-items-center'>
                                        <div class='me-3'>
                                            <i class='bi bi-award-fill' style='font-size:1.3rem;'></i>
                                        </div>
                                        Fornece certificação
                                    </div>
                                    <div class='d-flex flex-row align-items-center'>
                                        <div class='me-3'>

                                            <i class='bi bi-journals' style='font-size:1.3rem;'></i>
                                        </div>
                                        Materiais de apoio
                                    </div>
                                    <div class='d-flex flex-row align-items-center'>
                                        <div class='me-3'>
                                            <i class='bi bi-geo-alt-fill' style='font-size:1.3rem;'></i>
                                        </div>
                                        Acesso em qualquer lugar
                                    </div>
                                    <div class='d-flex flex-row align-items-center'>
                                        <div class='me-3'>
                                            <i class='bi bi-ui-checks' style='font-size:1.3rem;'></i>
                                        </div>
                                        Ensino interativo
                                    </div>
                                    <a href='' class='btn btn-success' role='button'>FAZER MATRÍCULA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </article>
    ";
    
    // !Explicação de como é realizado os cursos
    // *Colocar videos no fim
    echo
    "
        <section class='container'>
            <h5 class='fw-bolder'>Metodologia Easy Code</h5>
            <div class='text-muted'>
                <p>A metodologia da EasyCode foca na introdução aos assuntos e apresenta o básico para o entendimento das linguagens, com um ensino divertido e responsivo para que o aluno continue se interessando no assunto.</p>
            </div>
        </section>
    ";
    
    // ! FOOTER
    echo
    "
        <footer class='text-center text-white text-lg-start Footer'>
            <div class='container p-4 pb-0'>
                <div class='row'>
                    <div class='col-lg-6 mb-md-0'>
                        <h5 class='text-uppercase'>Easy Code</h5>
                        <p>
                            A plataforma ideal para aprender linguagem de programação.
                        </p>
                    </div>
                    <p class='col-lg-6 mb-md-0 text-center'>
                        <span>
                            Acompanhe-nos nas Redes Sociais <br>
                            <!-- Instagram -->
                            <a class='btn btn-outline-light m-1 logo-instagram' href='#!' role='button'>
                                <b class='bi bi-instagram'></b>
                            </a>

                            <!-- Linkedin -->
                            <a class='btn btn-outline-light m-1 logo-linkedin' href='#!' role='button'>
                                <b class='bi bi-linkedin'></b>
                            </a>

                            <!-- Github -->
                            <a class='btn btn-outline-light m-1 logo-github' href='#!' role='button'>
                                <b class='bi bi-github'></b>
                            </a>
                        </span>
                        <br><br>
                    </p>
                </div>
            </div>
            <div class='text-center p-3 Copyright'>
                © 2022 Easy Code - Todos os Direitos Reservados.
            </div>
        </footer>
        <script src='../assets/js/nav.js'></script> 
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js'
            integrity='sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/'
            crossorigin='anonymous'></script>
    </body>

    </html>
    ";
?>   