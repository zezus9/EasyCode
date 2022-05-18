<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pagina certificado</title>
    <link rel="stylesheet"  href="../assets/css/estilo.css">
</head>
<body>
    <div class="container">
        <?php

            include "connect.php";

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
                            <h3>$certificado[linguagem]</h3>
                            <div class='logo_curso'>
                                <img src='../assets/img/logo_cursos/$certificado[logo]' width='150px'>
                            </div>
                        </div>
                        <div class='content'>
                            <h3>$certificado[linguagem]</h3>
                            <br>
                            <p>Campo: $certificado[campo]<p>
                            <p>Data Inicio: $data_ini</p>
                            <p>Data Final: $data_fim</p>
                            <p>Professor: $certificado[nome_prof]</p>
                            <br>
                            <div>
                                <img src='../assets/img/logo_cursos/$certificado[logo]' width='100px'>
                            </div>
                            <a href='../assets/certificados/'>Baixe o PDF</a>
                        </div>
                    </div>
                ";
                // <a href='../assets/certificados/$certificados[pdf]'>Baixe o PDF</a>
            }
        ?>
    </div>
   <script type="text/javascript" src="../assets/js/vanilla-tilt.js"></script>
</body>
</html>