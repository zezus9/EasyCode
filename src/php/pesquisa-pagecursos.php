<?php

    include 'connect.php';
    
    $busca =  $_POST['busca'];

    $query = mysqli_query($sql, "SELECT * FROM curso WHERE linguagem LIKE '%$busca%'");
    $num   = mysqli_num_rows($query);
    if($num >0){
        // while($row = mysqli_fetch_assoc($query)){
        // echo $row['linguagem'].'<br /><hr>';
        echo "
            <div class='row'>
                <div>
                    <h3>Pesquisa rápida</h3>
                    <div class='owl-carousel'>
        ";
        while($card = mysqli_fetch_assoc($query)){
            echo "
            <div class='row'>
                <div>
                    <h3>Pesquisa rápida</h3>
                    <div class='owl-carousel'>
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
                                        <a href='template_cursos.php' class='btn botao'>
                                            <i class='bi bi-pencil-square'>&nbsp;</i>
                                            Inscrever-se
                                        </a>
                                    </div>
                                </div>
                                <p class='descricao'>$card[desc_breve]</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
    }else{
    echo "Curso não encontrado";
    }

?>