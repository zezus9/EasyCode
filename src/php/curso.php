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
        header('Location: ../cadastro_login.html');
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

        $certificados = $sql -> query(
            "SELECT 
                cert.data_inicio,cert.data_fim,cert.pdf,
                curso.linguagem,curso.campo,curso.logo,
                prof.nome AS nome_prof
            FROM certificado AS cert 
            INNER JOIN curso ON cert.id_curso = curso.id
            INNER JOIN professor AS prof ON cert.id_responsavel = prof.id
            WHERE id_aluno = '$idAluno'
            ORDER BY curso.linguagem");
    
        $nãoCertificado = false;
        if (mysqli_num_rows($certificados) == 0) {
            $nãoCertificado = true;
        }
    } else {
        while ($dados = mysqli_fetch_array($dadosUsuario)) {
            $idAluno = $dados['id'];
            $nome = $dados['nome'];
            $avatar = $dados['avatar'];
            $email = $dados['email'];
            $celular = $dados['telefone'];
        }
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

    echo <<<opcoes
    <body>
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
                </ul>
            </div>
            <div class='d-flex justify-content-end align-items-center flex-column h-25 w-100 p-5'>
                <div class='profile'>
                    <img src='../assets/img/Avatares/$avatar' class='avatar'>
                </div>
                <span><i class='bi bi-house-door-fill'></i>Perfil</span>
            </div>
        </nav>
        <section class='secao secaoAp' id='secao_home'>
            <h1>Questões</h1>
        </section>
opcoes;
        echo
        "
        <script type='text/javascript' src='../assets/js/vanilla-tilt.js'></script>
        <script src='../assets/js/app.js' type='module'></script>
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/libs/jquery.mask.js'></script>
        <script src='../assets/js/mascara.js'></script>
        <script src='../assets/js/alterAvatar.js'></script>
        <script src='../assets/js/apresentacaoPerfil.js'></script>
        <script src='../assets/js/perfil.js'></script>
    </body>
    </html>
    ";
?>