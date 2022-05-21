<?php

    include 'connect.php';
    
    $busca =  $_POST['busca'];

    $query = $sql -> query("SELECT * FROM curso WHERE linguagem LIKE '%$busca%'");

    if(mysqli_num_rows($query) > 0){
        echo 
        "
            <div class='d-flex justify-content-center flex-wrap'>
        ";
        while($card = mysqli_fetch_assoc($query)){
            echo 
            "
                <div class='d-flex col-md-3 col-sm-5 d-inline-block fundocard m-1'>
                    <div class='d-flex align-center col-md-3'>
                        <img src='../assets/img/logo_cursos/menores/$card[logo]' width='100%'>
                    </div>
                    <div class='col-md-7 d-flex justify-content-center align-items-center'>
                        <h5 class='text-center'>$card[linguagem]</h5>
                    </div>
                    <div class='d-flex justify-content-center align-items-center col-md-2 buscaS'>
                        <a href='template_cursos.php?curso=$card[id]'>   
                            <img src='../assets/img/proximo.png' width='100%'>
                        </a>
                    </div>
                </div>
            ";
        }
        echo 
        "
            </div>
        ";
    }else{
    echo "Curso não encontrado";
    }

?>

        