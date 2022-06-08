<?php

    require_once("dompdf/dompdf_config.inc.php");

    // Dompdf namespace
    use dompdf\dompdf;
    // dompdf class
    $dompdf = new dompdf();
    $certificado = file_get_contents('../certificado.php');
    // html que será transformado em PDF
    $dompdf->loadHtml($certificado);
    // Tipo do papel e orientação
    $dompdf->setPaper('A4');
    // Render HTML para PDF
    $dompdf->render();
    // Download do arquivo
    $dadosUsuario = $sql -> query("SELECT * FROM $usuario WHERE matricula = '$matricula'");
    while ($dados = mysqli_fetch_array($dadosUsuario)) {
        $nome = $dados['nome'];
    }
    $dompdf->stream("$nome.pdf");
    
    echo $certificado;

?>