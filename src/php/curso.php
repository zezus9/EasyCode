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
            header('Location: perfil.php');    
        }
    }
    else{
        header('Location: cadastro_login.php');
    }

    $id_curso = $_GET['curso'];

    $curso = $sql -> query(
        "SELECT 
            aluno.id,aluno.nome,aluno.avatar,
            curso.linguagem,curso.fases,curso.fase,curso.status,cert.fase
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
        $fase = $aulas[7];
        $faseC = $aulas[5];
        $status = $aulas['status'];
    }

    if ($status == 'NÃO') {
        header('Location: pagecursos.php');
    }
    
    $faseA = !isset($_GET['fase']) ? $fase : $_GET['fase'];

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
        if ($linhaAtual == $faseA) {
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
        } elseif ($linhaAtual <= $fase) {
            echo
            "
                <a href='curso.php?curso=$id_curso&fase=$linhaAtual'>
                    <li class='aulas'>
            ";
            if (mb_strpos($fasesA[$i],"Questão")) {
                echo
                "
                        <span>
                            <i class='bi bi-patch-question-fill'></i>
                        </span>
                        <span>$fasesA[$i]</span>
                    </li>
                </a>
                ";
            } else {
                echo
                "
                        <span>
                            <i class='bi bi-book-fill'></i>
                        </span>
                        <span>$fasesA[$i]</span>
                    </li>
                </a>
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
                <div class='collapse navbar-collapse Josefinfont d-flex justify-content-center' id='navbarSupportedContent'>
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
                                    <iframe class='h-100 col-lg-6 col-md-6 col-11' src='$aula[3]' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
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
                        <!-- QUESTAO -->
                        <form method='post' action='Auxiliares/checkResp.php?curso=$id_curso&fase=$faseA' class='h-100 d-flex flex-column justify-content-between'>
                            <div class='h-50 m-2'>
                                <div class='p-2'>
                                    <h1 class='text-center m-0'><strong>$aula[3]</strong></h1>
                                </div>
                                <div class='h-75'>
                                    <div class='bg-color h-100 d-flex align-items-center justify-content-center'>
                                        <h3 class='text-center'>$aula[4]</h3>
                                    </div>
                                </div>
                            </div>
                            <div class='h-100 d-flex m-3 flex-column justify-content-center align-items-center mx-1 conteudo'>
        ";

        if (trim($aula[2]) == 'alternativa') {
            echo
            " 
                            <!-- ALTERNATIVA -->
                            <div class='h-75 w-75 d-flex flex-wrap justify-content-center'>
                                <input hidden name='questao' value='alternativa'>
            ";

            $arquivo = fopen ("../cursos/$linguagem/Aulas/fase $aulaAtual.txt", 'r');
            $contador = 0;
            $resp = 1;
            while(!feof($arquivo)) {
                $linha = fgets($arquivo, 1024);
                if ($contador > 5) {
                    echo
                    "
                            <div class='col-lg-6 col-12 p-3 h-25 d-flex justify-content-center align-items-center'>
                                <div class='col-md-12 col-12 col-lg-6 w-100'>
                                    <label for='radios$resp' class='h-100 p-2 d-flex justify-content-between align-items-center bordaQ m-1 w-100'>
                                        <input type='radio' name='radios' id='radios$resp' value='$resp' required>
                                        <h3 class='m-0 px-2 text-center'>$linha</h3>
                                    </label>
                                </div>
                            </div>
                    ";
                    $resp += 1;
                }
                $contador += 1;
            }
            fclose($arquivo);

            echo
            "
                            </div>
                        </div>
            ";
        } elseif (trim($aula[2]) == 'Mescolha') {
            echo
            "
                            <!-- MULTIPLA ESCOLHA -->
                            <div class='h-75 w-75 d-flex flex-wrap justify-content-center checkbox'>
                                <input hidden name='questao' value='Mescolha'>
            ";

            $arquivo = fopen ("../cursos/$linguagem/Aulas/fase $aulaAtual.txt", 'r');
            $contador = 0;
            $resp = 1;
            while(!feof($arquivo)) {
                $linha = fgets($arquivo, 1024);
                if ($contador > 5) {
                    echo
                    "
                            <div class='col-lg-6 col-12 p-3 h-25 d-flex justify-content-center align-items-center'>
                                <div class='col-md-12 col-12 col-lg-6 w-100'>
                                    <label for='checks$resp' class='h-100 p-2 d-flex justify-content-between align-items-center bordaQ m-1 w-100'>
                                        <input type='checkbox' name='checks[]' id='checks$resp' value='$resp' class='check'>    
                                        <h3 class='m-0 px-2 text-center'>$linha</h3>
                                    </label>
                                </div>
                            </div>
                    ";
                    $resp += 1;
                }
                $contador += 1;
            }
            fclose($arquivo);

            echo
            "
                            </div>
                        </div>
            ";
        } elseif (trim($aula[2]) == 'botao') {
            echo
            "
                            <!-- BOTOES -->
                            <div class='h-25 borda w-75 m-1 d-flex flex-wrap justify-content-center align-items-center QuestaoB'>
                                <h4 class='m-0 text-center' id='espaco'>Aqui vai a resposta</h4>
                            </div>
                            <div class='h-75 w-75 d-flex flex-wrap m-1'>
                                <input hidden name='questao' value='botao'>
                                <input hidden name='array' id='array' value=''>
            ";

            $arquivo = fopen ("../cursos/$linguagem/Aulas/fase $aulaAtual.txt", 'r');
            $contador = 0;
            while(!feof($arquivo)) {
                $linha = fgets($arquivo, 1024);
                if ($contador > 5) {
                    echo
                    "
                            <div class='col-lg-6 col-12 p-3 h-25 d-flex justify-content-center align-items-center'>
                                <div class='col-md-12 col-12 col-lg-6 w-100'>
                                    <buttons type='submit' class='btn bg-color text-light px-5 p-2 w-100 botoes' name='botoes'>$linha</buttons>
                                </div>
                            </div>
                    ";
                }
                $contador += 1;
            }
            fclose($arquivo);

            echo
            "
                            </div>
                        </div>
            ";
        }
    }
    if (trim($aula[0]) != 'questao') {
        if ($faseA == $faseC) {
            echo
            "
                            <div class='d-flex flex-row-reverse m-3'>
                                <a href='Auxiliares/cursoConc.php?curso=$id_curso'>
                                    <button type='submit' class='btn bg-color text-light'>TERMINAR</button>
                                </a>
                            </div>
            ";
        } elseif ($faseA == $fase) {
            echo
            "
                            <div class='d-flex flex-row-reverse m-3'>
                                <a href='Auxiliares/proximaFase.php?curso=$id_curso&faseA=$fase'>
                                    <button type='submit' class='btn bg-color text-light'>PRÓXIMO</button>
                                </a>
                            </div>
            ";
        } else {
            $nextF = $faseA + 1;
            echo
            "
                             <div class='d-flex flex-row-reverse m-3'>
                                <a href='curso.php?curso=$id_curso&fase=$nextF'>
                                    <button type='submit' class='btn bg-color text-light'>PRÓXIMO</button>
                                </a>
                            </div>
            ";
        }
        echo "</div>";
    } else {
        if (!isset($_GET['result'])) {
            echo
            "
                            <div class='d-flex flex-row-reverse p-3 w-100'>
                                <input type='submit' value='PRONTO' class='btn bg-color text-light submit'>
                            </div>
            ";
            echo "</form>";
        } else {
            $result = $_GET['result'];
            if ($faseA == $fase) {
                echo
                "
                                <div class='w-100 h-25 d-flex position-relative'>
                                    <div class='w-100 d-flex flex-column align-items-center justify-content-center  position-relative'>
                ";

                if ($result == 'true') {
                    echo "<h4 class='text-success'>Resposta correta!</h4>";
                } else {
                    echo "<h4 class='text-danger'>Resposta incorreta!</h4>";
                    if (trim($aula[2]) == "alternativa") {
                        echo "<p>Resposta certa: opção <strong class='bg-color mx-2 px-3 py-1'>$aula[5]</strong></p>";
                    } elseif (trim($aula[2]) == "Mescolha") {
                        echo "<p>Resposta certa: opções ";
                        $resposta = explode(',',trim($aula[5]));
                        for ($f=0; $f < count($resposta); $f++) {
                            echo "<strong class='bg-color mx-1 px-3 py-1'>$resposta[$f]</strong>";
                        }
                        echo "</p>";
                    } elseif (trim($aula[2]) == "botao") {
                        echo "<p>Resposta certa: opções ";
                        $resposta = explode(',',trim($aula[5]));
                        for ($f=0; $f < count($resposta); $f++) {
                            $respostaC = explode(':',$resposta[$f]);
                            echo "<strong class='bg-color mx-1 px-3 py-1'>$respostaC[0]</strong>";
                        }
                        echo "nessa ordem";
                        echo "<p>";
                    }
                }

                echo
                "
                                    </div>
                                    <div class='d-flex m-3 position-absolute bottom-0 end-0'>
                                        <div class='w-100'>
                                            <a href='Auxiliares/proximaFase.php?curso=$id_curso&faseA=$fase'>
                                                <div type='submit' class='btn bg-color text-light'>PRÓXIMO</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                ";
            } else {
                echo
                "
                                <div class='w-100 h-25 d-flex position-relative'>
                                    <div class='w-100 d-flex flex-column align-items-center justify-content-center  position-relative'>
                ";

                if ($result == 'true') {
                    echo "<h4 class='text-success'>Resposta correta!</h4>";
                } else {
                    echo "<h4 class='text-danger'>Resposta incorreta!</h4>";
                    if (trim($aula[2]) == "alternativa") {
                        echo "<p>Resposta certa: opção <strong class='bg-color mx-2 px-3 py-1'>$aula[5]</strong></p>";
                    } elseif (trim($aula[2]) == "Mescolha") {
                        echo "<p>Resposta certa: opções ";
                        $resposta = explode(',',trim($aula[5]));
                        for ($f=0; $f < count($resposta); $f++) {
                            echo "<strong class='bg-color mx-1 px-3 py-1'>$resposta[$f]</strong>";
                        }
                        echo "</p>";
                    } elseif (trim($aula[2]) == "botao") {
                        echo "<p>Resposta certa: opções ";
                        $resposta = explode(',',trim($aula[5]));
                        for ($f=0; $f < count($resposta); $f++) {
                            $respostaC = explode(':',$resposta[$f]);
                            echo "<strong class='bg-color mx-1 px-3 py-1'>$respostaC[0]</strong>";
                        }
                        echo "nessa ordem<p>";
                    }
                }
                $nextF = $faseA + 1;
                echo
                "
                                    </div>
                                    <div class='d-flex m-3 position-absolute bottom-0 end-0 col-3'>
                                        <div class='w-100'>
                                            <a href='curso.php?curso=$id_curso&fase=$nextF'>
                                                <div type='submit' class='btn bg-color text-light'>PRÓXIMO</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                ";
            }
            echo "</div>";
        }
    }
    echo
    "
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