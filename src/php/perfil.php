<?php

    include 'Auxiliares/connect.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    // !Testa se esta logado ou não
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        $usuario = substr($matricula,0,1) == 0 ? 'aluno' : 'professor';
    }
    else{
        header('Location: cadastro_login.php');
    }

    if (isset($_GET['secoes'])) {
        echo "<input hidden value='$_GET[secoes]' id='secoes'></input>";
    } elseif (isset($_POST['selectCurso'])) {
        echo "<input hidden value='ministrarCursos' id='secoes'></input>";
    }

    clearstatcache();

    $dadosUsuario = $sql -> query("SELECT * FROM $usuario WHERE matricula = '$matricula'");
    
    if ($usuario == 'aluno') {
        while ($dados = mysqli_fetch_array($dadosUsuario)) {
            $idAluno = $dados['id'];
            $nome = $dados['nome'];
            $avatar = $dados['avatar'];
            $email = $dados['email'];
            $celular = $dados['telefone'];
            $linkedin = $dados['linkedin'];
            $github = $dados['github'];
            $link = $dados['link_personalizado'];
        }

        $cursosI = $sql -> query(
            "SELECT 
                curso.linguagem, cert.fase,curso.id
            FROM certificado AS cert 
            INNER JOIN curso ON cert.id_curso = curso.id
            WHERE id_aluno = '$idAluno' AND `status` = 'INICIADO'
            ORDER BY cert.id"
        );

        $nãoCursosI = false;
        if (mysqli_num_rows($cursosI) == 0) {
            $nãoCursosI = true;
        }

        $certificados = $sql -> query(
            "SELECT 
                curso.linguagem,curso.campo,curso.logo, curso.id,
                cert.data_inicio,cert.data_fim,
                prof.nome AS nome_prof
            FROM certificado AS cert 
            INNER JOIN curso ON cert.id_curso = curso.id
            INNER JOIN professor AS prof ON cert.id_responsavel = prof.id
            WHERE id_aluno = '$idAluno' AND `status` = 'TERMINADO'
            ORDER BY cert.id"
        );
    
        $nãoCertificado = false;
        if (mysqli_num_rows($certificados) == 0) {
            $nãoCertificado = true;
        }
    } else {
        while ($dados = mysqli_fetch_array($dadosUsuario)) {
            $idProfessor = $dados['id'];
            $nome = $dados['nome'];
            $avatar = $dados['avatar'];
            $email = $dados['email'];
            $celular = $dados['telefone'];
            $linkedin = $dados['linkedin'];
            $github = $dados['github'];
            $link = $dados['link_personalizado'];
            $descricao = $dados['descricao'];
        }

        $cursosM = $sql -> query(
            "SELECT 
                curso.linguagem,curso.id
            FROM curso
            INNER JOIN professor AS prof ON curso.id_responsavel = prof.id
            WHERE curso.id_responsavel = '$idProfessor'
            ORDER BY curso.linguagem"
        );

        $numCursos = mysqli_num_rows($cursosM);
    }

    if (isset($_POST['voltarCon']) && $_POST['voltarCon'] == 'voltar') {unset($_POST['selectCurso']);unset($_POST['voltarCon']);}
    if (isset($_POST['voltarAul']) && $_POST['voltarAul'] == 'voltar') {unset($_POST['definido']);   unset($_POST['voltarAul']);}

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <!--link do icon-->
        <link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$nome</title>
        
        <!-- CSS -->
        <link rel='stylesheet' href='../assets/css/perfil.css'>
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/inputs.css'>
        <link rel='stylesheet' href='../assets/css/sidebar.css'>
        <link rel='stylesheet' href='../assets/css/pagecursos.css'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
        
        <!-- ICONS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>
    </head>
    ";

    echo
    "
    <body onload='carousel();inicio();'>
        <div>
            <!-- Abrir menu -->
            <a class='botao-hamburguer abrir-menu' href='#' role='button'>
                <i class='bi bi-list'></i> 
            </a>
        </div>
        <!-- Sidebar -->
        <nav class='sidebar'>
            <!-- Fechar Menu-->
            <div class='fechar-x'>
                <i class='bi bi-x'></i>
            </div>
            <div class='d-flex justify-content-center align-items-center flex-column h-100 w-100'>
                <div class='profile'>
                    <img src='../assets/img/Avatares/$avatar' class='avatar'>
                    <h3>$nome</h3>
                    <p class='text-uppercase'>$matricula</p>
                </div>
    ";
    echo <<<opcoes
                <ul class='menu-elements w-100'>
                    <li class='active'>
                        <label for='home' onclick='opcoes("home")'>
                            <span>
                                <i class='bi bi-house-door-fill'></i>
                            </span>
                            <span>Home</span>
                        </label>
                        <input type='radio' name='opcoes' id='home' class='opcoes Radio'>
                    </li>
opcoes;
    if ($usuario == 'aluno') {
        echo <<<certificadoAlunos
                    <li>
                        <label for='certificados' onclick='opcoes("certificados")'>
                            <span>
                                <i class="bi bi-award-fill"></i> 
                            </span>
                            <span>Certificados</span>
                        </label>
                        <input type='radio' name='opcoes' id='certificados' class='opcoes Radio'>
                    </li>
certificadoAlunos;
    }
    else{
        echo <<<ministrarCursos
                    <li>
                        <label for='ministrarCursos' onclick='opcoes("ministrarCursos")'>
                            <span>
                                <i class="bi bi-journal-plus"></i> 
                            </span>
                            <span>Ministrar Cursos</span>
                        </label>
                        <input type='radio' name='opcoes' id='ministrarCursos' class='opcoes Radio'>
                    </li>
ministrarCursos;
    }
    
    echo <<<opcoes
                    <li>
                        <label for='dPessoais' onclick='opcoes("dPessoais")'>
                            <span>
                                <i class="bi bi-person-lines-fill"></i>
                            </span>
                            <span>Dados Pessoais</span>
                        </label>
                        <input type='radio' name='opcoes' id='dPessoais' class='opcoes Radio'>
                    </li>
                    <li>
                        <label for='dProfissionais' onclick='opcoes("dProfissionais")'>
                            <span>
                                <i class="bi bi-person-lines-fill"></i>
                            </span>
                            <span>Dados Profissionais</span>
                        </label>
                        <input type='radio' name='opcoes' id='dProfissionais' class='opcoes Radio'>
                    </li>
                    <li>
                        <label for='alterSenha' onclick='opcoes("alterSenha")'>
                            <span>
                                <i class="bi bi-shield-lock-fill"></i> 
                            </span>
                            <span>Alterar Senha</span>
                        </label>
                        <input type='radio' name='opcoes' id='alterSenha' class='opcoes Radio'>
                    </li>

                    <li>
                        <a href='Auxiliares/sair.php'>
                            <label>
                                <span>
                                    <i class="bi bi-box-arrow-right"></i>
                                </span>
                                <span>Sair</span>
                            </label>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <section class='secao' id='secao_home'>
opcoes;

    if ($usuario == 'aluno') {
        echo
        "
            <div class='container d-flex align-center justify-content-center nonSelect h-100'>
                <div class='h-75 w-100'>
                    <div class='w-100 h-50'>
                        <div class='w-100 h-100 row'>
                            <div class='m-2 h-100 border rounded d-flex justify-content-center align-center flex-column home'>
        ";
        if (!$nãoCursosI) {
            echo
            "
                                <h1 class='text-center color'>Continuar</h1>
                                <div class='d-flex justify-content-center align-items-center h-100 owl-carousel w-100'>
            ";
            while ($curso = mysqli_fetch_array($cursosI)) {
                
                echo
                "
                                <div class='d-flex flex-column col-md-3 col-sm-5 d-inline-block fundocard carouselA w-100'>
                                    <div class='d-flex justify-content-center align-items-center h-100'>
                                        <h5 class='text-center color m-0'>$curso[linguagem]</h5>
                                    </div>
                                    <a href='template_cursos.php?curso=$curso[id]'>
                                        <div class='d-flex h-50 m-3 home'>
                                            <div class='d-flex justify-content-center align-items-center col-10 p-1'>
                                                <p class='text-center overflow-hidden m-0 text-light p-1'>$curso[fase]</p>
                                            </div>
                                            <div class='d-flex justify-content-center align-items-center buscaS col-2'>    
                                                    <img src='../assets/img/proximo.png' width='100%'>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                
                ";
            }
        } else {
            echo 
            "
                                <div class='d-flex justify-content-center align-items-center h-100 w-100'>
                                    <div class='d-flex justify-content-center m-5 w-100'>
                                        <div class='w-100'>
                                            <h1 class='Josefinfont color text-center'>Ainda não há nada aqui...</h1>
                                        </div>
                                    </div>
            ";
        }

        echo
        "
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='h-50 d-flex justify-content-between align-items-center flex-wrap'>
                        <div class='col-md-6 col-12 h-100'>
                            <div class='my-3 h-75 rounded px-5'>
                                <div class='d-flex justify-content-center align-items-center flex-column h-100 home'>
                                    <div class='d-flex d-inline-block fundocard m-2 camposM'>
                                        <div class='col-lg-5 d-none d-lg-block'>
                                            <div class='d-flex justify-content-end align-items-center h-100'>
                                                <p class='sizeF text-center m-0'>mais cursos &nbsp;</p>
                                            </div>
                                        </div>
                                        <div class='col-lg-5 col-md-10 col-sm-10 col-10 d-flex justify-content-start align-items-center'>
                                            <h5 class='sizeF text-center m-0 color'><strong>FRONT-END</strong></h5>
                                        </div>
                                        <div class='d-flex justify-content-center align-items-center col-md-2 buscaS'>
                                            <a href='pagecursos.php#frontend'>   
                                                <img src='../assets/img/proximo.png' width='80em'>
                                            </a>
                                        </div>
                                    </div>
                                    <div class='d-flex d-inline-block fundocard m-2 camposM'>
                                        <div class='col-lg-5 d-none d-lg-block'>
                                            <div class='d-flex justify-content-end align-items-center h-100'>
                                                <p class='sizeF text-center m-0'>mais cursos &nbsp;</p>
                                            </div>
                                        </div>
                                        <div class='col-lg-5 col-md-10 col-sm-10 col-10 d-flex justify-content-start align-items-center'>
                                            <h5 class='sizeF text-center m-0 color'><strong>BACK-END</strong></h5>
                                        </div>
                                        <div class='d-flex justify-content-center align-items-center col-md-2 buscaS'>
                                            <a href='pagecursos.php#backend'>   
                                                <img src='../assets/img/proximo.png' width='80em'>
                                            </a>
                                        </div>
                                    </div>
                                    <div class='d-flex d-inline-block fundocard m-2 camposM'>
                                        <div class='col-lg-5 d-none d-lg-block'>
                                            <div class='d-flex justify-content-end align-items-center h-100'>
                                                <p class='sizeF text-center m-0'>mais cursos &nbsp;</p>
                                            </div>
                                        </div>
                                        <div class='col-lg-5 col-md-10 col-sm-10 col-10 d-flex justify-content-start align-items-center'>
                                            <h5 class='sizeF text-center m-0 color'><strong>DATABASE</strong></h5>
                                        </div>
                                        <div class='d-flex justify-content-center align-items-center col-md-2 buscaS'>
                                            <a href='pagecursos.php#database'>
                                                <img src='../assets/img/proximo.png' width='80em'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6 col-12 h-100'>
                            <div class='my-3 h-75 rounded px-5'>
                                <div class='d-flex justify-content-center align-items-center flex-column h-100 home'>
                                    <div class='h-100 d-flex justify-content-center align-items-center flex-column color'>
                                        <h2>Alguma dúvida?</h2>
                                        <h4>Fale com a gente</h4>
                                        <a href='sobrenos.php'>
                                            <button class='btn btn-outline-secondary fundocard color'>CONTATOS</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    } else{
        //!Professor
        $numAlunos = 0;
        $numCertificados = 0;

        echo
        "
            <div class='container d-flex align-center justify-content-center nonSelect h-100'>
                <div class='h-75 w-100'>
                    <div class='w-100 h-50'>
                        <div class='w-100 h-100 row'>
                            <div class='m-2 h-100 border rounded d-flex justify-content-center align-center flex-column home'>
        ";

        if ($numCursos != 0) {
            echo "<div class='d-flex justify-content-center align-items-center h-100 owl-carousel w-100' h-100>";

            while ($cursoP = mysqli_fetch_array($cursosM)) {
                $matriculados = $sql -> query(
                    "SELECT 
                        curso.id
                    FROM curso
                    INNER JOIN certificado AS cert ON cert.id_curso = curso.id
                    WHERE cert.id_responsavel = '$idProfessor' 
                        AND curso.linguagem = '$cursoP[linguagem]'
                    ORDER BY cert.id"
                );
                $terminados = $sql -> query(
                    "SELECT 
                        curso.id
                    FROM curso
                    INNER JOIN certificado AS cert ON cert.id_curso = curso.id
                    WHERE cert.id_responsavel = '$idProfessor' 
                        AND curso.linguagem = '$cursoP[linguagem]' 
                        AND cert.`status` = 'TERMINADO'
                    ORDER BY cert.id"
                );
                $matriculados = mysqli_num_rows($matriculados);
                $terminados = mysqli_num_rows($terminados);

                $numAlunos += $matriculados;
                $numCertificados += $terminados;
                echo
                    "
                                        <div class='d-flex flex-column col-md-3 col-sm-5 d-inline-block fundocard carouselP w-100'>
                                            <div class='d-flex justify-content-center align-items-center h-50'>
                                                <h5 class='text-center color m-0 text-uppercase'>$cursoP[linguagem]</h5>
                                            </div>
                                            <div class='d-flex align-items-center justify-content-center h-100'>
                                                <div class='d-flex flex-column align-items-end justify-content-center col-7'>
                                                    <p class='m-1'><strong>Matriculados: </strong></p>
                                                    <p class='m-1'><strong>Concluidos: </strong></p>
                                                </div>
                                                <div class='d-flex flex-column align-items-center justify-content-center col-5'>
                                                    <p class='m-1 color2'>$matriculados</p>
                                                    <p class='m-1 color2'>$terminados</p>
                                                </div>
                                            </div>
                                            <a href='template_cursos.php?curso=$cursoP[id]' class='h-25'>
                                                <div class='d-flex h-50 m-3 home'>
                                                    <div class='d-flex justify-content-center align-items-center col-10 p-1'>
                                                        <p class='text-center text-wrap m-0 text-light p-1' style='font-size:0.9em;'>
                                                            Ir para a página do curso
                                                        </p>
                                                    </div>
                                                    <div class='d-flex justify-content-center align-items-center buscaS col-2'>    
                                                        <img src='../assets/img/proximo.png' width='100%'>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                ";
            }
        } else {
            echo
            "
                                <div class='d-flex justify-content-center align-items-center h-100 w-100'>
                                    <div class='d-flex justify-content-center m-5 w-100'>
                                        <div class='w-100'>
                                            <h1 class='Josefinfont color text-center'>Ainda não há nada aqui...</h1>
                                        </div>
                                    </div>
            ";
        }
            echo
            "
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='h-50 d-flex justify-content-between align-items-center flex-wrap'>
                        <div class='col-md-6 col-12 h-100'>
                            <div class='my-3 h-75 px-5'>
                                <div class='d-flex justify-content-center align-items-center h-100 home px-4 py-2'>
                                    <div class='d-flex flex-column m-2 h-100 camposC col-md-4 py-2'>
                                        <div class='h-100 card fundocard'>
                                            <div class='h-25'>
                                                <h6 class='color text-center'>TOTAL DE CURSOS</h6>
                                            </div>
                                            <div class='h-75 d-flex justify-content-center align-items-center'>
                                                <h1 class='color2'>$numCursos</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='d-flex flex-column m-2 h-100 camposC col-md-4 py-2'>
                                        <div class='h-100 card fundocard'>
                                            <div class='h-25'>
                                                <h6 class='color text-center'>TOTAL DE MATRICULAS</h6>
                                            </div>
                                            <div class='h-75 d-flex justify-content-center align-items-center'>
                                                <h1 class='color2'>$numAlunos</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='d-flex flex-column m-2 h-100 camposC col-md-4 py-2'>
                                        <div class='h-100 card fundocard'>
                                            <div class='h-25'>
                                                <h6 class='color text-center'>TOTAL DE CERTIFICADOS</h6>
                                            </div>
                                            <div class='h-75 d-flex justify-content-center align-items-center'>
                                                <h1 class='color2'>$numCertificados</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6 col-12 h-100'>
                            <div class='my-3 h-75 rounded px-5'>
                                <div class='d-flex justify-content-center align-items-center flex-column h-100 home'>
                                    <div class='h-100 d-flex justify-content-center align-items-center flex-column color'>
                                        <h2>Alguma dúvida?</h2>
                                        <h4>Fale com a gente</h4>
                                        <a href='sobrenos.php'>
                                            <button class='btn btn-outline-secondary fundocard color'>CONTATOS</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    echo
    "
        </section>
        <section class='secao' id='secao_ministrarCursos'>
            <div class='d-flex justify-content-center align-items-center h-100'>
                <div class='box-form d-flex p-4 justify-content-center h-100' id='minCursos'>
    ";

    if (!isset($_POST['selectCurso'])) {
        echo 
        "
                    <div class='d-flex align-items-center flex-column w-50 p-3'>
                        <h1 class='d-flex align-center justify-content-center Josefinfont text-color'>MINISTRAR CURSO</h1>
                        <form action='' method='POST' class='w-50 d-flex align-items-center flex-column'>
                            <strong>Qual curso deseja editar?</strong>
                            <div class='col-sm-10'>
                                <select class='text-center inputSel' name='selectCurso' id='selectNC' required>
                                    <option value='none'></option>
        ";

        if ($numCursos > 0) {
            $cursosM = $sql -> query(
                "SELECT 
                    curso.linguagem
                FROM curso
                INNER JOIN professor AS prof ON curso.id_responsavel = prof.id
                WHERE curso.id_responsavel = '$idProfessor'
                ORDER BY curso.linguagem"
            );
        
            while ($curso = mysqli_fetch_array($cursosM)){
                echo "<option value='$curso[linguagem]'>$curso[linguagem]</option>";
            }
        }
        
        echo
        "
                                </select>
                            </div>
                            <div class='m-2'>
                                <input type='submit' value='SALVAR' class='btn btn-outline-secondary bg-color text-light' id='submitNC'>
                            </div>
                        </form>
                    </div>
        ";
    } elseif (isset($_POST['selectCurso']) and !isset($_POST['definido'])) {
        $nomeCurso = $_POST['selectCurso'];
        echo
        "
                    <div class='d-flex align-items-center p-5 flex-column w-50 p-3' style='font-size:1.1em'>
                        <h1 class='Josefinfont text-color text-center'>Definição - $nomeCurso</h1>
                        <form action='$_SERVER[PHP_SELF]' method='POST' class='d-flex align-items-center justify-content-around w-100 flex-column' autocomplete='off'>
                            <input hidden name='selectCurso' value='$nomeCurso'>
                            <input hidden name='definido' value='true'>
                            <input hidden name='voltarCon' value='' id='voltarCon'>
                            <div class='m-3 d-flex justify-content-center align-items-center'>
                                <div class='d-flex flex-column align-items-end'>
                                    <strong class='m-2 p-0'>Carga horária:</strong>
                                    <strong class='m-2 p-0'>Quantidade de fases:</strong>
                                </div>
                                <div class='d-flex flex-column'>
                                    <input class='m-2 p-0 vDefinicao inputNum' type='number'  min='1' max='50' name='carga' required>
                                    <input class='m-2 p-0 vDefinicao inputNum' type='number'  min='2' max='100' name='fases' required>
                                </div>
                            </div>
                            <div class='form-group w-100 d-flex align-items-center flex-column'>
                                <strong class='p-2'>Conteudo ensinado:</strong>
                                <div class='w-75 p-1'>
                                    <textarea class='inputText vDefinicao' rows='6' maxlength='250' minlength='30' name='conteudo' id='conteudo' placeholder='Descreva em tópicos o conteúdo que será ensinado neste curso' required></textarea>
                                </div>
                                <div class='d-flex justify-content-center'>
                                    <input type='submit' value='VOLTAR' class='btn btn-outline-secondary bg-color text-light m-1' id='voltarNC'>
                                    <input type='submit' value='SALVAR' class='btn btn-outline-secondary bg-color text-light m-1' id='enviarC'>
                                </div>
                            </div>
                        </form>
                    </div>
        ";
    } elseif (isset($_POST['selectCurso']) and isset($_POST['definido'])) {
        $aulasComp = isset($_POST['aulasComp']) ? $_POST['aulasComp'] : '';
        $nomeCurso = $_POST['selectCurso'];
        $carga = $_POST['carga'];
        $fases = $_POST['fases'];
        $conteudo = str_replace('☺','</br>',$_POST['conteudo']);
        $faseA = isset($_POST['faseA']) ? $_POST['faseA'] : '1';

        echo
        "
                    <div class='d-flex align-items-center flex-column w-100 p-1'>
                    <h1 class='Josefinfont text-color' id='aulas'>Aula $faseA de $fases - $nomeCurso</h1>
                        <form action='$_SERVER[PHP_SELF]' method='post' enctype='multipart/form-data' class='d-flex align-items-center p-1 flex-column w-100 h-100' id='formAulas' autocomplete='off'>
                            <input hidden name='definido' value='true'>
                            <input hidden name='aulasComp' value='$aulasComp' id='aulasComp'>
                            <input hidden name='selectCurso' value='$nomeCurso' id='nomeCursos'>
                            <input hidden name='carga' value='$carga'>
                            <input hidden name='fases' value='$fases' id='fases'>
                            <input hidden name='faseA' value='$faseA' id='faseA'>
                            <input hidden name='conteudo' value='$conteudo'>
                            <input hidden name='voltarAul' value='' id='voltarAul'>
                            <div class='w-100 h-100 d-flex align-items-center flex-column'>
                                <strong>Adicionar</strong>
                                <select class='m-2 w-50 selects inputSel' id='opcaoMVQ' name='aula' onchange='resetQuestao()'>
                                    <option value='none'>Selecione uma opção</option>
                                    <option value='material'>Material</option>
                                    <option value='video'>Video</option>
                                    <option value='questao'>Questão</option>
                                </select>
                    
                                <!--MATERIAL-->
                                <div class='collapse m-3 w-100 h-100 text-center' id='material'>
                                    <strong>Adicionar Material</strong>
                                    <div class='form-group w-100 h-100 d-flex flex-column align-items-center'>
                                        <input type='text' class='w-50 materialVa input pl' placeholder='Titulo do Material' name='tituloM' id='tituloM'>
                                        <textarea class='inputText my-2 materialVa h-100' minlength='40' placeholder='Cole aqui o conteúdo deste material' name='material' id='material'></textarea>
                                    </div>
                                </div>
                    
                                <!--VIDEO-->
                                <div class='collapse m-3 w-50 text-center' id='video'>
                                    <strong>Adicionar Video</strong>
                                    <div class='form-group'>
                                        <input type='text' class='videoVa input pl' placeholder='Titulo do Video'>
                                        <input type='url' class='input videoVa pl my-2' placeholder='Link do Video no Youtube'>
                                        <textarea class='inputText videoVa h-100' minlength='10' maxlength='300' placeholder='Cole aqui o conteúdo deste material' name='video' id='video'></textarea>
                                    </div>
                                </div>
                    
                                <!--QUESTÕES-->
                                <div class='collapse m-3 w-100 text-center' id='questao'>
                                    <strong>Adicionar Questão</strong>
                                    <div class='form-group w-100 d-flex align-items-center flex-column'>
                                        <div class='col-sm-10 w-50 my-2'>
                                            <select class='selects inputSel' data-val='true' id='opcaoAMB' name='tipoQ'>
                                                <option id='tipoNone'>Tipo de questão</option>
                                                <option value='alternativa'>Alternativa</option>
                                                <option value='Mescolha'>Multipla escolha</option>
                                                <option value='botao'>Botão</option>
                                            </select>
                                        </div>
                                    </div>
        ";

        $qtdeOpcoesA = !isset($_POST['qtdeOpcoesA']) ? '3' : $_POST['qtdeOpcoesA'];
        $qtdeOpcoesM = !isset($_POST['qtdeOpcoesM']) ? '3' : $_POST['qtdeOpcoesM'];
        $qtdeOpcoesB = !isset($_POST['qtdeOpcoesB']) ? '5' : $_POST['qtdeOpcoesB'];

        echo
        "
                    
                                    <!--ALTERNATIVA-->
                                    <div class='collapse AMB w-100 m-2' id='alternativa'>
                                        <div class='d-flex'>
                                            <div class='w-50 p-2 d-flex flex-column justify-content-between'>
                                                <textarea class='inputText my-2 h-100 questaoVa questaoAlt' minlength='10' maxlength='200' placeholder='Pergunta' name='perguntaA'></textarea>
                                                <div>
                                                    <strong>Quantidade de alternativas:</strong>
                                                    <input type='number' min='3' max='5' value='$qtdeOpcoesA' name='qtdeOpcoesA' class='questaoVa questaoAlt inputNum' id='qtdeOpcoesA'>
                                                    <input type='submit' value='SALVAR' class='btn btn-outline-secondary bg-color text-light changeQTDE'>
                                                </div>
                                            </div>
                                            <div class='d-flex flex-column w-50 p-2'>
        ";

        for ($i=1; $i <= $qtdeOpcoesA; $i++) {
            echo<<<qtdeInputs
                                                <div class='d-flex align-items-center'>
                                                    <input type='radio' class='m-1 questaoVa questaoAlt' name='questaoR' id='questaoR$i'>
                                                    <input type='text' class=' input pl my-1 questaoVa questaoAlt' name='opcaoR$i' placeholder='text'>
                                                </div>
qtdeInputs;
        }

        echo
        "                                    
                                            </div>
                                        </div>
                                    </div>

                                    <!--MÚLTIPLA ESCOLHA-->
                                    <div class='collapse AMB w-100 m-2' id='Mescolha'>
                                        <div class='d-flex'>
        
                                            <div class='w-50 p-2 d-flex flex-column justify-content-between'>
                                                <textarea class='inputText my-2 h-100 questaoVa questaoMes' minlength='10' maxlength='200' placeholder='Pergunta' name='perguntaM'></textarea>
                                                <div>
                                                    <strong>Quantidade de escolhas:</strong>
                                                    <input type='number' min='3' max='5' value='$qtdeOpcoesM' name='qtdeOpcoesM' class='questaoVa questaoMes inputNum' id='qtdeOpcoesM'>
                                                    <input type='submit' value='SALVAR' class='btn btn-outline-secondary bg-color text-light changeQTDE'>
                                                </div>
                                            </div>
                                            <div class='d-flex flex-column w-50 p-2'>
        ";

        for ($i=1; $i <= $qtdeOpcoesM; $i++) { 
            echo<<<qtdeInputs
                                                <div class='d-flex align-items-center'>
                                                    <input type='checkbox' class='m-1 questaoC' name='questaoC' id='questaoC$i'>
                                                    <input type='text' class=' input pl my-1 questaoVa questaoMes' name='opcaoC$i' placeholder='text'>
                                                </div>
qtdeInputs;
        }

        echo
        "
                                            </div>
                                        </div>
                                    </div>
                    
                                    <!--BOTÃO-->
                                    <div class='collapse AMB w-100 m-2' id='botao'>
                                        <div class='d-flex'>
                                            <div class='w-50 p-2 d-flex flex-column justify-content-between'>
                                                <textarea class='inputText my-2 h-100 questaoVa questaoBot' minlength='10' maxlength='200' placeholder='Pergunta' name='perguntaB'></textarea>
                                                <div>
                                                    <strong>Quantidade de botões:</strong>
                                                    <input type='number' min='4' max='8' value='$qtdeOpcoesB' name='qtdeOpcoesB' class='questaoVa questaoBot inputNum' id='qtdeOpcoesB'>
                                                    <input type='submit' value='SALVAR' class='btn btn-outline-secondary bg-color text-light changeQTDE'>
                                                </div>
                                            </div>
                                            <div class='d-flex flex-wrap w-50 align-items-center'>
                                                <div class='h-100'>
                                                    <div class='d-flex flex-wrap justify-content-center'>
        ";

        for ($i=1; $i <= $qtdeOpcoesB; $i++) { 
            echo<<<qtdeInputs
                                                    <div class='d-flex btn btn-outline-secondary bg-color text-light m-1' style='width:48%'>
                                                        <input class='mx-2 w-25 text-center ordemP inputNumB' type='number' min='1' max='8' name='ordem' id='ordem$i'>
                                                        <input type='text' class='input questaoVa questaoBot' name='opcaoB$i' placeholder='text'>
                                                    </div>
qtdeInputs;
        }

        echo
        "
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js'></script>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <input type='submit' value='VOLTAR' class='btn btn-outline-secondary bg-color text-light m-1' id='voltarAu'>
                                <input type='submit' value='PRÓXIMO' class='btn btn-outline-secondary bg-color text-light m-1 submit' id='publicar'>
                            </div>
                        </form>
                    </div>
        ";
    }

    echo
    "
                </div>
            </div>
        </section>  
        <section class='secao h-100' id='secao_certificados'>
            <div class='container d-flex align-center justify-content-center nonSelect h-100'>
    ";

    if ($usuario == 'aluno') {

        if ($nãoCertificado) {
            echo 
            "
                <div class='d-flex justify-content-center m-5 p-5'>
                    <h1 class='Josefinfont'>Ainda não há nada aqui...</h1>
                </div>
            ";
        } else {
            while ($certificado = mysqli_fetch_array($certificados)) {
                $data_ini = implode('/',array_reverse(explode('-',$certificado['data_inicio'])));
                $data_fim = implode('/',array_reverse(explode('-',$certificado['data_fim'])));
        
                echo 
                "
                    <div class='cardCertificado'>
                        <div class='before'>
                            <div class='titulo'>
                                <h3>$certificado[linguagem]</h3>
                            </div>
                            <div class='logo_curso'>
                                <img src='../assets/img/logo_cursos/$certificado[logo]' width='150px'>
                            </div>
                        </div>
                        <div class='content'>
                            <h3>$certificado[linguagem]</h3>
                            <br>
                            <p><strong>Data Final:</strong> $data_fim</p>
                            <p><strong>Professor:</strong> $certificado[nome_prof]</p>
                            <br>
                            <div>
                                <img src='../assets/img/logo_cursos/menores/$certificado[logo]' width='90px'>
                            </div>
                            <a href='Auxiliares/pdf-certificado.php?curso=$certificado[id]'>Baixe o PDF</a>
                        </div>
                    </div>
                ";
            }
        }
    }

    echo
    "
            </div>  
        </section>
        <section class='secao' id='secao_dPessoais'>
            <div class='d-flex justify-content-center align-items-center h-100'>
                <div class='box-form'>
                    <div class='d-flex flex-wrap justify-content-center align-items-center h-100 w-100'>
                        <form action='Auxiliares/alterAvatar.php' class='col-md-5 col-sm-10 d-flex justify-content-center align-items-center' method='post' id='form-avatar' enctype='multipart/form-data'>
                            <div class='d-flex justify-content-center align-items-center flex-column h-100 w-50'>
                                <label for='avatar'>
                                    <img src='../assets/img/Avatares/$avatar' class='avatar' width='150em'>
                                </label>
                                <input type='file' accept='image/*' id='avatar' name='avatar' onChange='submitForm()'>
                                <br>
                                <div class='d-flex justify-content-center'>
                                    <h3 class='Josefinfont text-color'>Matricula: $matricula</h3>
                                </div>
                            </div>
                        </form>
                        <form action='Auxiliares/alterPessoais.php' method='post' class='formulario flex-column form-alt col-md-5 col-sm-10 d-flex justify-content-center align-items-center'>
                            <div class='d-flex w-100'>
                                <div class='form-group mb-4 w-100'>
                                    <div class='input-container'>
                                        <label for='nome'><strong>Nome</strong></label>
                                        <input id='nome' class='input' name='nome' placeholder='#' type='text' required
                                        data-tipo='nome' value='$nome'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='d-flex w-100'>
                                <div class='form-group mb-4 w-100'>
                                    <div class='input-container'>
                                        <label for='email'><strong>E-mail</strong></label>
                                        <input id='email' class='input' name='email' placeholder='#' type='email' required
                                        data-tipo='email' value='$email'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='d-flex w-100'>
                                <div class='form-group mb-4 w-100'>
                                    <div class='input-container'>
                                        <label for='celular'><strong>Telefone</strong></label>
                                        <input id='celular' class='input' name='celular' placeholder='#' type='text' required
                                        data-tipo='celular' value='$celular'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <input type='submit' value='SALVAR ALTERAÇÕES' class='btn btn-outline-secondary bg-color text-light'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class='secao' id='secao_dProfissionais'>
            <div class='d-flex justify-content-center align-items-around h-100'>
                <div class='box-form'>
                    <div class='d-flex justify-content-center align-items-center flex-column w-100 h-100'>
                        <form action='Auxiliares/alterProfissionais.php' method='post' class='formulario flex flex--coluna form-alt w-50 p-5'>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='linkedin'><strong>Linkedin</strong></label>
                                        <input id='linkedin' class='input' name='linkedin' placeholder='#' type='url' data-tipo='link' value='$linkedin'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='github'><strong>GitHub</strong></label>
                                        <input id='github' class='input' name='github' placeholder='#' type='url' data-tipo='link' value='$github'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='link'><strong>Link Pessoal</strong></label>
                                        <input id='link' class='input' name='link' placeholder='#' type='url' data-tipo='link' value='$link'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
    ";

    if ($usuario != 'aluno') {
        echo
        "  
                            <div class='w-100'>
                                <div class='form-group h-50 m-2'>
                                    <div class='input-container h-100'>
                                        <label for='descricao'><strong>Formação</strong></label>
                                        <textarea id='descricao' class='inputText h-100' name='descricao' placeholder='$descricao' style='background:transparent'></textarea>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
        ";
    }

    echo
    "
                            <div class='d-flex justify-content-center'>
                                <input type='submit' value='SALVAR ALTERAÇÕES' class='btn btn-outline-secondary bg-color text-light'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class='secao' id='secao_alterSenha'>
            <div class='d-flex justify-content-center align-items-center h-100'>
                <div class='box-form'>
                    <div class='d-flex justify-content-center align-items-center flex-column w-100 h-100'>
                        <form action='Auxiliares/alterSenha.php' method='post' class='formulario flex flex--coluna form-alt w-50'>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='senhaAnt'><strong>Senha antiga</strong></label>
                                        <input id='senhaAnt' class='input' type='password' required data-tipo='senhaCad'  name='senhaAnt' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ \\\/!@#$%^&*_=+-]).{6,12}$'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='senha'><strong>Nova senha</strong></label>
                                        <input id='senha' class='input' type='password' required data-tipo='senhaCad'  name='senha' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ \\\/!@#$%^&*_=+-]).{6,12}$'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='senhaNov'><strong>Repita a nova senha</strong></label>
                                        <input id='senhaNov' class='input' type='password' required data-tipo='senhaNov'  name='senhaNov' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ \\\/!@#$%^&*_=+-]).{6,12}$'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-50'>
                                <a href='resgSenha.php' class='color2'>
                                    <strong>Esqueci a senha</strong>
                                </a>
                            </div>
                            <br>
                            <div class='d-flex justify-content-center'>
                                <input type='submit' value='SALVAR ALTERAÇÕES' class='btn btn-outline-secondary bg-color text-light'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- SCRIPTS -->
        <script src='../assets/js/carouselPerfil.js'></script>
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
        <script src='../assets/js/app.js' type='module'></script>
        <script src='../assets/js/libs/jquery.mask.js'></script>
        <script src='../assets/js/mascara.js'></script>
        <script src='../assets/js/alterAvatar.js'></script>
        <script src='../assets/js/apresentacaoPerfil.js'></script>
        <script src='../assets/js/sidebar.js'></script>
        <script src='../assets/js/aulasCursos.js'></script>
    </body>
    </html>
    ";
?>