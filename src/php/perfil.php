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
        if (substr($matricula,0,1) == 0) {
            $usuario = 'aluno';
            $dadosUsuario = $sql -> query("SELECT * FROM aluno WHERE matricula = '$matricula'");
        }
        else{
            $usuario = 'professor';
            $dadosUsuario = $sql -> query("SELECT * FROM professor WHERE matricula = '$matricula'");
        }
    }
    else{
        header('Location: ../cadastro_login.html');
    }

    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $idAluno = $dados['id'];
        $nome = $dados['nome'];
        $avatar = $dados['avatar'];
        $email = $dados['email'];
        $celular = $dados['telefone'];
        $nascimento = implode('/',array_reverse(explode('-',$dados ['nasc'])));
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

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <!--link do icon-->
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$nome</title>
        <link rel='stylesheet' href='../assets/css/perfil.css'>
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/inputs.css'>

        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
        
    </head>
    ";

    echo
    "
    <body>
        <div >
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
            <div> 
                <img width='35' src='../assets/img/logoEASYCODE.png' alt='Logo EC'>
                <span class='Lovelofont'>EASYCODE</span> 
            </div><br>
            <div class='profile'>
                <img src='src='../assets/img/Avatares/$avatar' class='avatar'>
                <h3>$nome</h3>
                <p class='text-uppercase'>$matricula</p>
            </div>
    ";
    echo <<<opcoes
            <ul class='menu-elements'>
                <li class='active'>
                    <label for='home' onclick='opcoes("home")'>
                        <span>
                            <i class='bi bi-house-door-fill'></i>
                        </span>
                        <span>Home</span>
                    </label>
                    <input type='radio' name='opcoes' id='home' checked>
                </li>
                
                <li>
                    <label for='certificados' onclick='opcoes("certificados")'>
                        <span>
                            <i class="bi bi-award-fill"></i> 
                        </span>
                        <span>Certificados</span>
                    </label>
                    <input type='radio' name='opcoes' id='certificados'>
                </li>
                <li>
                    <label for='dPessoais' onclick='opcoes("dPessoais")'>
                        <span>
                            <i class="bi bi-person-lines-fill"></i>
                        </span>
                        <span>Dados Pessoais</span>
                    </label>
                    <input type='radio' name='opcoes' id='dPessoais'>
                </li>
                
                <li>
                    <label for='dProfissionais' onclick='opcoes("dProfissionais")'>
                        <span>
                            <i class="bi bi-person-lines-fill"></i>
                        </span>
                        <span>Dados Profissionais</span>
                    </label>
                    <input type='radio' name='opcoes' id='dProfissionais'>
                </li>
                
                <li>
                    <label for='alterSenha' onclick='opcoes("alterSenha")'>
                        <span>
                            <i class="bi bi-shield-lock-fill"></i> 
                        </span>
                        <span>Alterar Senha</span>
                    </label>
                    <input type='radio' name='opcoes' id='alterSenha'>
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
        </nav>
        <section class='secao' id='secao_home'>
            <h1>Home</h1>
        </section>
        <section class='secao h-100' id='secao_certificados'>
            <div class='container d-flex align-center justify-content-center nonSelect h-100'>
opcoes;

    if ($nãoCertificado) {
        echo 
        "
            <div class='d-flex justify-content-center m-5 p-5'>
                <h1 class='Josefinfont'>Ainda não há nada aqui!</h1>
            </div>
        ";
    } else {
        while ($certificado = mysqli_fetch_array($certificados)) {
            $data_ini = implode('/',array_reverse(explode('-',$certificado['data_inicio'])));
            $data_fim = implode('/',array_reverse(explode('-',$certificado['data_fim'])));
    
            echo 
            "
                <div class='card'>
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
                        <p><strong>Campo:</strong> $certificado[campo]<p>
                        <p><strong>Data Inicio:</strong> $data_ini</p>
                        <p><strong>Data Final:</strong> $data_fim</p>
                        <p><strong>Professor:</strong> $certificado[nome_prof]</p>
                        <br>
                        <div>
                            <img src='../assets/img/logo_cursos/menores/$certificado[logo]' width='90px'>
                        </div>
                        <a href='../assets/certificados/'>Baixe o PDF</a>
                    </div>
                </div>
            ";
        // <a href='../assets/certificados/$certificados[pdf]'>Baixe o PDF</a>
        }
    }

	echo
    "
            </div>  
        </section>
        <section class='secao secaoAp' id='secao_dPessoais'>
            <div class='d-flex justify-content-center align-items-center h-100'>
                <div class='box-form'>
                    <div class='d-flex h-100 w-100'>
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
            <div class='d-flex justify-content-center align-items-center h-100'>
                <div class='box-form'>
                    <div class='d-flex justify-content-center align-items-center flex-column w-100 h-100'>
                        <form action='Auxiliares/alterProfissionais.php' method='post' class='formulario flex flex--coluna form-alt w-50'>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='github'><strong>Linkedin</strong></label>
                                        <input id='github' class='input' name='linkedin' placeholder='#' type='url' required data-tipo='link' value='$linkedin'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='github'><strong>GitHub</strong></label>
                                        <input id='github' class='input' name='github' placeholder='#' type='url' required data-tipo='link' value='$github'>
                                        <span class='input-mensagem-erro'>Este campo não está valido</span>
                                    </div>
                                </div>
                            </div>
                            <div class='w-100'>
                                <div class='form-group'>
                                    <div class='input-container'>
                                        <label for='link'><strong>Link Pessoal</strong></label>
                                        <input id='link' class='input' name='link' placeholder='#' type='url' required  data-tipo='link' value='$link'>
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
        <section class='secao' id='secao_alterSenha'>
            <h1>Alterar Senha</h1>
        </section>
        <section class='secao' id='secao_config'>
            <h1>Configurações</h1>
        </section>
        
        <script src='../assets/js/apresentacaoPerfil.js'></script>
        <script type='text/javascript' src='../assets/js/vanilla-tilt.js'></script>
        <script src='../assets/js/app.js' type='module'></script>
	    <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/util.js'></script>
        <script src='../assets/js/libs/jquery.js'></script>
        <script src='../assets/js/libs/jquery.mask.js'></script>
        <script src='../assets/js/mascara.js'></script>
        <script src='../assets/js/alterAvatar.js'></script>
        <script src='../assets/js/perfil.js'></script>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    </body>
    </html>
    ";
?>