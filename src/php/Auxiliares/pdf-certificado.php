<?php

    require 'libs/vendor/autoload.php';
    include 'connect.php';

    if (!isset($_SESSION) || !isset($_GET['curso'])) {
        session_start();
    }

    $id_curso = $_GET['curso'];
    
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula'];
        $dadosUsuario = $sql -> query("SELECT nome FROM aluno WHERE matricula = '$matricula'");
        $certificados = $sql -> query(
            "SELECT cert.data_fim, curso.linguagem,curso.duracao 
            FROM certificado as cert
            INNER JOIN curso ON cert.id_curso = curso.id
            WHERE id_curso = $id_curso"
        );
    }
    else{
        header('Location: cadastro_login.php');
    }

    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $nome = $dados['nome'];
    }
    while ($certificado = mysqli_fetch_array($certificados)) {
        $linguagem = $certificado['linguagem'];
        $data_fim = implode('/',array_reverse(explode('-',$certificado['data_fim'])));
        $duracao = $certificado['duracao'];
    }

    use Dompdf\Dompdf as Dompdf;

    $dompdf = new dompdf();

    $data = file_get_contents('libs/img/bgimg-mascote.png');
    $type = pathinfo($data, PATHINFO_EXTENSION);
    $mascote = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $data = file_get_contents('libs/img/bgimg.jpg');
    $type = pathinfo($data, PATHINFO_EXTENSION);
    $bg = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $data = file_get_contents('libs/img/logoEASYCODE.png');
    $type = pathinfo($data, PATHINFO_EXTENSION);
    $logo = 'data:image/' . 'png' . ';base64,' . base64_encode($data);

    $html = "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$linguagem</title>
        <style>
            .corpo{
                background-image: url($bg);
                width: 1000px;
                height: 500px;
                border: 10px solid #008037;
                z-index: 2;
            }

            .section{
                background-image: url($mascote);
                background-repeat: no-repeat;
                background-size: 550px 510px;
                background-position: top right;
                height: 500px;
                z-index: 0;
            }
            
            .div-principal{
                height: 600px;
                padding: 20px;
            }
            
            .titulo{
                font-family: monospace;
                font-size: 50px;
                font-weight: bold;
                color: #008037;
                text-transform: uppercase;
            }

            h1{
                margin: 10px 0 10px 0;
            }
        
            p{
                width: 650px;
                font-size: 15px;
                font-family: cursive;
            }
            
            .texto-verde{
                font-weight: bold;
                padding: 1%;
                font-size: 20px !important;
                color: #008037;
                background-color: #C9E265;
                max-width: 650px;
                min-width: 500px;
                display: inline;
                margin: 10px 0 10px 0;
                text-transform: uppercase;
            }
            
            .site{
                color:#008037;
            }
        </style>
    </head>
    <body>
        <div class='corpo'>
            <section class='section'>
                <div class='div-principal'>
                    <h1 class='titulo'>CERTIFICADO</h1>
                    <p>Certificamos que</p>
                    <p class='texto-verde'>$nome</p>
                    <p>em $data_fim concluiu o curso de</p>
                    <p class='texto-verde'>$linguagem</p>
                    <p>com duração de $duracao horas</p>
                    <br><br>
                    <p>ASSINATURA</p>
                    <br>
                    <p class='site'>EASY CODE <br> www.easycode.com</p>
                    <img src='$logo' width='40px'>
                </div>
            </section>
        </div>
        
    </body>
    </html>
    ";
    
    $dompdf->loadHTML($html);

    $dompdf->setPaper([0,0,830,565]);


    $dompdf->render();
    $dompdf->stream("Certificado EASYCODE - $linguagem",["Attachment" => false]);
?>