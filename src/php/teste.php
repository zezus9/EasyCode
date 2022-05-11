<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pagecursos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- JS -->
    <script src="../assets/js/pagecursos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Cursos</title>
</head>

<body style="background-color: #cbdfce;" onload="carousel()">
    <div class="container-xl">
    <?php

        include 'connect.php';
        
        $FrontEnd = array();
        $BackEnd = array();
        $Database = array();
        $apresentacard = $sql -> QUERY('SELECT * FROM curso');

        while($card = mysqli_fetch_array($apresentacard)){

            $id = $card['id'];
            $logo = $card['logo'];
            $linguagem = $card['linguagem'];
            $campo = $card['campo'];
            $duracao = $card['duracao'];
            $desc_breve = $card['desc_breve'];

            if($campo == 'FrontEnd'){
                array_push($FrontEnd, $id);
            }
            elseif($campo == 'BackEnd'){
                array_push($BackEnd, $id);
            }
            else{
                array_push($Database, $id);
            }
        }

        echo "
            <div class='row'>
            <div>
                <h3>Front-End</h3>
                <div class='owl-carousel'>
        ";
        for ($i=0; $i < count($FrontEnd); $i++){
            $apresentaCard = $sql -> QUERY("SELECT * FROM curso WHERE id = '$FrontEnd[$i]'");
            echo $apresentaCard[0];
            while ($card = mysqli_fetch_array($apresentaCard)) {
                echo 
                "
                <div class='card'>
                    <figure class='fundocard'>
                        <img src='../assets/img/logo_cursos/$card[logo]'>
                    </figure>
                    <div class='abadedescricao'>
                        <div class='abacard'>
                            <div>
                                <h5 class='titulo'>$card[linguagem]</h5>
                                <span class='subtitulo'>
                                    <i class='fa-solid fa-clock'></i>
                                    Duração: $card[duracao]
                                </span>
                                <br>
                                <a href='template_cursos.html' class='btn botao'>
                                    <i class='bi bi-pencil-square'>&nbsp;</i>
                                    Inscrever-se
                                </a>
                            </div>
                        </div>
                        <p class='descricao'>$card[desc_breve]</p>
                    </div>
                </div>
                ";
            }
        }

        echo 
        "
                </div>
            </div>
        </div>
        <div class='row'>
            <div>
                <h3>Back-End</h3>
                <div class='owl-carousel'>
        ";
        for ($i=0; $i < count($BackEnd); $i++){
            $apresentaCard = $sql -> QUERY("SELECT * FROM curso WHERE id = '$BackEnd[$i]'");
            while ($card = mysqli_fetch_array($apresentaCard)) {
                echo 
                "
                <div class='card'>
                    <figure class='fundocard'>
                        <img src='../assets/img/logo_cursos/$card[logo]'>
                    </figure>
                    <div class='abadedescricao'>
                        <div class='abacard'>
                            <div>
                                <h5 class='titulo'>$card[linguagem]</h5>
                                <span class='subtitulo'>
                                    <i class='fa-solid fa-clock'></i>
                                    Duração: $card[duracao]
                                </span>
                                <br>
                                <a href='template_cursos.html' class='btn botao'>
                                    <i class='bi bi-pencil-square'>&nbsp;</i>
                                    Inscrever-se
                                </a>
                            </div>
                        </div>
                        <p class='descricao'>$card[desc_breve]</p>
                    </div>
                </div>
                ";
            }
        }

        echo 
        "
                </div>
            </div>
        </div>
        <div class='row'>
            <div>
                <h3>Databases</h3>
                <div class='owl-carousel'>
        ";
        for ($i=0; $i < count($Database); $i++){
            $apresentaCard = $sql -> QUERY("SELECT * FROM curso WHERE id = '$Database[$i]'");
            while ($card = mysqli_fetch_array($apresentaCard)) {
                echo 
                "
                <div class='card'>
                    <figure class='fundocard'>
                        <img src='../assets/img/logo_cursos/$card[logo]'>
                    </figure>
                    <div class='abadedescricao'>
                        <div class='abacard'>
                            <div>
                                <h5 class='titulo'>$card[linguagem]</h5>
                                <span class='subtitulo'>
                                    <i class='fa-solid fa-clock'></i>
                                    Duração: $card[duracao]
                                </span>
                                <br>
                                <a href='template_cursos.html' class='btn botao'>
                                    <i class='bi bi-pencil-square'>&nbsp;</i>
                                    Inscrever-se
                                </a>
                            </div>
                        </div>
                        <p class='descricao'>$card[desc_breve]</p>
                    </div>
                </div>
                ";
            }
        }
    ?>
                    </div>
            </div>
        </div>
    </div>


</body>

</html>