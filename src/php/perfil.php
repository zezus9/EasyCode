<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--link do icon-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
    <div class="sidebar d-flex justify-content-center align-items-center">
        <div>
            <div class="profile">
                <img src="../assets/img/Avatares/d_img.png">
                <h3>Jonathan de Jesus Simões</h3>
                <p>Aluno</p>
            </div>
            <!--menu item-->
            <ul>
                <li>
                    <label onclick="opcoes('home')">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </label>
                </li>
                
                <li>
                    <label onclick="opcoes('certificados')">
                        <span class="icon"><i class="fas fa-certificate"></i></span>
                        <span class="item">Certificados</span>
                    </label>
                </li>
                
                <li>
                    <label onclick="opcoes('dPessoais')">
                        <span class="icon"><i class="fas fa-certificate"></i></span>
                        <span class="item">Dados Pessoais</span>
                    </label>
                </li>
                
                <li>
                    <label onclick="opcoes('dProfissionais')">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Dados Profissionais</span>
                    </label>
                </li>
                
                <li>
                    <label onclick="opcoes('alterSenha')">
                        <span class="icon"><i class="fas fa-user-shield"></i></span>
                        <span class="item">Alterar Senha</span>
                    </label>
                </li>
                
                <li>
                    <label onclick="opcoes('config')">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Configurações</span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
    <section class="secao" id="home">

    </section>
    <section class="secao" id="certificados">
        <div class="container d-flex align-items-center nonSelect">
            <?php
                include "Auxiliares/connect.php";

                $idAluno = "001";
                $certificados = $sql -> query(
                    "SELECT 
                        cert.data_inicio,cert.data_fim,cert.pdf,
                        curso.linguagem,curso.campo,curso.logo,
                        prof.nome AS nome_prof
                    FROM certificado AS cert 
                    INNER JOIN curso ON cert.id_curso = curso.id
                    INNER JOIN professor AS prof ON cert.id_responsavel = prof.id
                    WHERE id_aluno = '$idAluno'");

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
            ?>
        </div>  
    </section>
    <section class="secao" id="dPessoais">

    </section>
    <section class="secao" id="dProfissionais">

    </section>
    <section class="secao" id="alterSenha">

    </section>
    <section class="secao" id="config">

    </section>
    
    <!--novo active menu button using javascript-->
    <script src="../assets/js/apresentacaoPerfil.js"></script>
    <script type="text/javascript" src="../assets/js/vanilla-tilt.js"></script>
</body>
</html>