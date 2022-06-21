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

    $id_curso = $_GET['curso'];

    $curso = $sql -> query(
        "SELECT 
            aluno.id,aluno.nome,aluno.avatar,
            curso.linguagem,curso.fases,cert.fase
        FROM certificado AS cert
        INNER JOIN curso ON cert.id_curso = curso.id
        INNER JOIN aluno ON cert.id_aluno = aluno.id
        WHERE cert.id_curso = '$id_curso' AND aluno.matricula = '$matricula'"
    );

    while ($aulas = mysqli_fetch_array($curso)){
        $id_aluno = $aulas['id'];
        $nome = $aulas['nome'];
        $avatar = $aulas['avatar'];
        $linguagem = $aulas['linguagem'];
        $fases = $aulas['fases'];
        $fase = $aulas['fase'];
    }

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$linguagem</title>
        <!--link do icon-->
        <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

        <!-- CSS -->
        <link rel='stylesheet' href='../assets/css/curso.css'>
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/inputs.css'>
        <link rel='stylesheet' href='../assets/css/sidebar.css'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>

        <!-- ICONS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>
    </head>
    ";

    echo <<<curso
    <body>
        <div>
            <!-- Abrir menu -->
            <a class='botao-hamburguer abrir-menu' href='#' role='button'>
                <i class='bi bi-list text-light'></i> 
            </a>
        </div>
        <!-- Sidebar -->
        <nav class='sidebar'>
            <!-- Fechar Menu-->
            <div class='fechar-x'>
                <i class='bi bi-x'></i>
            </div>
            <div class='d-flex justify-content-center align-items-center flex-column h-75 w-100'>
                <ul class='menu-elements w-100'>
curso;

    $fasesA = explode('._.',$fases);
    $linhaAtual = 1;
    for ($i=0; $i < count($fasesA); $i++) { 
        if ($linhaAtual < $fase) {
            echo "<li class='aulas'>";
            if (mb_strpos($fasesA[$i],"Questão")) {
                echo
                "
                    <span>
                        <i class='bi bi-patch-question-fill'></i>
                    </span>
                    <span>$fasesA[$i]</span>
                </li>
                ";
            } else {
                echo
                "
                        <i class='bi bi-book-fill'></i>
                    </span>
                    <span>$fasesA[$i]</span>
                </li>
                ";
            }
        } elseif ($linhaAtual == $fase) {
            $aulaAtual = $linhaAtual;
            echo "<li class='active'>";
            if (mb_strpos($fasesA[$i],"Questão")) {
                echo
                "
                    <span>
                        <i class='bi bi-patch-question-fill'></i>
                    </span>
                    <span>$fasesA[$i]</span>
                </li>
                ";
            } else {
                echo
                "
                        <i class='bi bi-book-fill'></i>
                    </span>
                    <span>$fasesA[$i]</span>
                </li>
                ";
            }
        } else {
            echo 
            "
                <li class='aulasBloq'>
                    <span>
                        <i class='bi bi-lock-fill'></i>
                    </span>
                    <span>$fasesA[$i]</span>
                </li>
            ";
        }

        $linhaAtual += 1;
    }

    echo
    "                    
                </ul>
            </div>
            <div class='navbar navbar-expand nonSelect'>                
                <div class='collapse navbar-collapse Josefinfont' id='navbarSupportedContent'>
                    <ul class='navbar-nav ml-auto justify-content-center'>
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
                                <a class='dropdown-item' href='perfil.php?secoes=certificados'>
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
            <div class='p-4 d-flex justify-content-center align-items-center tamanho'>
                <div class='borda h-100 w-100'>
    ";

    $aula = explode("\n",file_get_contents("../cursos/$linguagem/Aulas/fase $aulaAtual.txt"));
    
    if (trim($aula[0]) == 'material') {
        echo 
        "
                    <!-- MATERIAL -->
                    <div class='h-100 d-flex flex-column justify-content-between'>
                        <div class='p-2'>
                            <h1 class='bg-color text-center m-0'><strong>$aula[2]</strong></h1>
                        </div>
                        <div class='h-100 d-flex flex-column conteudo'>
                            <h5 class='mx-3'>
        ";

        $arquivo = fopen ("../cursos/$linguagem/Aulas/fase $aulaAtual.txt", 'r');
        $contador = 0;
        while(!feof($arquivo)) {
            $linha = fgets($arquivo, 1024);
            if ($contador > 2) {
                echo "$linha<br>";
            }
            $contador += 1;
        }
        fclose($arquivo);

        echo
        "
                            </h5>
                        </div>
        ";
    } elseif (trim($aula[0]) == 'video') {
        echo
        "
                        <!-- VIDEO -->
                        <div class='h-100 d-flex flex-column justify-content-between'>
                            <div class='p-2'>
                                <h1 class='bg-color text-center m-0'><strong>$aula[2]</strong></h1>
                            </div>
                            <div class='h-100 w-100 d-flex flex-column conteudo align-items-center'>
                                <div class='h-100 w-100 d-flex justify-content-center'>
                                    <iframe class='h-100 w-50' src='$aula[3]' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                                </div>
                                <div class='p-3 h-25 w-75'>
                                    <h4>
        ";

        $arquivo = fopen ("../cursos/$linguagem/Aulas/fase $aulaAtual.txt", 'r');
        $contador = 0;
        while(!feof($arquivo)) {
            $linha = fgets($arquivo, 1024);
            if ($contador > 3) {
                echo "$linha<br>";
            }
            $contador += 1;
        }
        fclose($arquivo);

        echo
        "
                                    </h4>
                                </div>
                            </div>
        ";
    } else {
        echo
        "
                        <!-- QUESTAO ALTERNATIVA OU MULTIPLA ESCOLHA -->
                        <div class='h-100 d-flex flex-column justify-content-between'>
                            <div class='h-50 m-2'>
                                <div class='p-2'>
                                    <h1 class='text-center m-0'><strong>$aula[4]</strong></h1>
                                </div>
                                <div class='h-75'>
                                    <div class='bg-color h-100 d-flex align-items-center justify-content-center'>
                                        <h3>$aula[3]</h3>
                                    </div>
                                </div>
                            </div>
                        <div class='h-100 d-flex m-3 flex-column justify-content-center align-items-center mx-1 conteudo'>
        ";

        if (trim($aula[2]) == 'alternativa') {
            echo
            " 
                            <!-- ALTERNATIVA -->
                            <div class='h-75 w-75 d-flex flex-wrap'>
            ";

            $arquivo = fopen ("../cursos/$linguagem/Aulas/fase $aulaAtual.txt", 'r');
            $contador = 0;
            while(!feof($arquivo)) {
                $linha = fgets($arquivo, 1024);
                if ($contador > 3) {
                    echo "$linha<br>";
                }
                $contador += 1;
            }
            fclose($arquivo);

            echo
            "
                                <div class='w-50 d-flex p-3 h-25 justify-content-center align-items-center'>
                                    <input type='radio'>
                                    <h3 class='m-0 px-2'>Opção 1</h3>
                                </div>
                            </div>
                        </div>
            ";
        } elseif (trim($aula[2]) == 'Mescolha') {
            echo
            "
                            <!-- MULTIPLA ESCOLHA -->
                            <div class='h-75 w-75 d-flex flex-wrap'>
                                <div class='w-50 d-flex p-3 h-25 justify-content-center align-items-center'>
                                    <input type='checkbox'>
                                    <h3 class='m-0 px-2'>Opção 1</h3>
                                </div>
                            </div>
                        </div>
            ";
        } elseif (trim($aula[2]) == 'botao') {
            echo
            "
                            <!-- BOTOES -->
                            <div class='h-25 borda w-75 d-flex justify-content-center align-items-center'>
                                <h4 class='m-0'>Aqui vai a resposta</h4>
                            </div>
                            <div class='h-75 w-75 d-flex flex-wrap m-1'>
                                <div class='w-50 d-flex p-3 h-25 justify-content-center align-items-center'>
                                    <input type='submit' value='SALVAR' class='btn btn-outline-secondary bg-color text-light px-5 p-2'>
                                </div>
                            </div>
                        </div>
            ";
        }
    }
    echo
    "
                        <div class='d-flex flex-row-reverse m-3'>
                            <input type='submit' value='Próximo' class='btn btn-success'>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
        <!-- SCRIPTS -->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js'></script>
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/sidebar.js'></script>
        <script src='../assets/js/curso.js'></script>
    </html>
    ";
?>