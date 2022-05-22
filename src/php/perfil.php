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
        $matricula = $_SESSION['matricula'];
        if (substr($matricula,0,1) == 0) {
            $usuario = "aluno";
            $dadosUsuario = $sql -> query("SELECT * FROM aluno WHERE matricula = '$matricula'");
        }
        else{
            $usuario = "professor";
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

    echo <<<head

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--link do icon-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$nome</title>
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
head;

    echo <<<sidebar
<body>
    <div class="sidebar d-flex justify-content-center align-items-center">
        <div class"w-100">
            <div class="profile">
                <img src="../assets/img/Avatares/$avatar">
                <h3>$nome</h3>
                <p class="text-uppercase">$usuario</p>
            </div>
            <!--menu item-->
            <ul>
                <li>
                    <label for="home" onclick="opcoes('home')">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </label>
                    <input type="radio" name="opcoes" id="home" checked>
                </li>
                
                <li>
                    <label for="certificados" onclick="opcoes('certificados')">
                        <span class="icon"><i class="fas fa-certificate"></i></span>
                        <span class="item">Certificados</span>
                    </label>
                    <input type="radio" name="opcoes" id="certificados">
                </li>
                
                <li>
                    <label for="dPessoais" onclick="opcoes('dPessoais')">
                        <span class="icon"><i class="fas fa-certificate"></i></span>
                        <span class="item">Dados Pessoais</span>
                    </label>
                    <input type="radio" name="opcoes" id="dPessoais">
                </li>
                
                <li>
                    <label for="dProfissionais" onclick="opcoes('dProfissionais')">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Dados Profissionais</span>
                    </label>
                    <input type="radio" name="opcoes" id="dProfissionais">
                </li>
                
                <li>
                    <label for="alterSenha" onclick="opcoes('alterSenha')">
                        <span class="icon"><i class="fas fa-user-shield"></i></span>
                        <span class="item">Alterar Senha</span>
                    </label>
                    <input type="radio" name="opcoes" id="alterSenha">
                </li>
                
                <li>
                    <label for="config" onclick="opcoes('config')">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Configurações</span>
                    </label>
                    <input type="radio" name="opcoes" id="config">
                </li>
            </ul>
        </div>
    </div>
sidebar;
    echo <<<secaoHome
    <section class="secao secaoAp" id="secao_home">
        <h1>Home</h1>
    </section>
secaoHome;
	
	echo <<<secaoCertificados
    <section class="secao" id="secao_certificados">
        <div class="container d-flex align-items-center nonSelect">
secaoCertificados;

    while ($certificado = mysqli_fetch_array($certificados)) {
        $data_ini = implode('/',array_reverse(explode('-',$certificado['data_inicio'])));
        $data_fim = implode('/',array_reverse(explode('-',$certificado['data_fim'])));

    echo <<<Certificado
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
Certificado;
    // <a href='../assets/certificados/$certificados[pdf]'>Baixe o PDF</a>
    }

	echo <<<secao_dPessoais
        </div>  
    </section>
    <section class="secao" id="secao_dPessoais">
        <h1>Dados Pessoais</h1>
    </section>
secao_dPessoais;
	echo <<<secao_dProfissionais
    <section class="secao" id="secao_dProfissionais">
        <h1>Dados Profissionais</h1>
    </section>
secao_dProfissionais;
	echo <<<secao_alterSenha
    <section class="secao" id="secao_alterSenha">
        <h1>Alterar Senha</h1>
    </section>
secao_alterSenha;
	echo <<<secao_config
    <section class="secao" id="secao_config">
        <h1>Configurações</h1>
    </section>
secao_config;
    echo <<<fim
    <!--novo active menu button using javascript-->
    <script src="../assets/js/apresentacaoPerfil.js"></script>
    <script type="text/javascript" src="../assets/js/vanilla-tilt.js"></script>
</body>
</html>
fim;
?>