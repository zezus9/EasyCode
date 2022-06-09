<?php

    echo
    "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='../assets/css/certificado.css'>
        <title>$nome</title>
    </head>
    <body>
        <div class='body'>
            <section class='section'>
                <div class='div-principal'>
                    <div class='div-secudaria'>
                        <p class='titulo text-uppercase'>CERTIFICADO</p>
                        <p>Certificamos que</p>
                        <p class='texto-verde text-uppercase'>$nome</p>
                        <p>em $data_fim concluiu o curso</p>
                        <p class='texto-verde text-uppercase'>$certificado[linguagem]</p>
                        <br><br><br><br><br><br>
                        <p>ASSINATURA</p>
                        <br><br><br><br><br><br><br><br><br><br><br>
                        <p class='site'>EASY CODE <br> www.easycode.com</p>
                    </div>
                </div>
            </section>
        </div>
        
    </body>
    </html>
    ";

?>