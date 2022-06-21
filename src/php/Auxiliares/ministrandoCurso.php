<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <!--link do icon-->
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../../assets/css/style.css'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
</head>
<body style="background-image: url(../../assets/img/bgimg.jpg);height:100vh">
    <div class="d-flex justify-content-center align-items-center h-100">
        <?php

            include 'connect.php';
        
            $selectCurso = $_POST['selectCurso'];
            $conteudoAr = "../../cursos/$selectCurso/conteudo.txt";
            $aulasComp = explode('.-.',$_POST['aulasComp']);
            $qtdAula = 0;
            $questao = 0;
            $fases = Array();

            $conteudo = $_POST['conteudo'];
            $conteudo = explode('</br>',$conteudo);

            $abrirCont = fopen($conteudoAr,"w");
            for ($t=0; $t < count($conteudo); $t++) {
                fwrite($abrirCont,"$conteudo[$t]\n");
            }
            fclose($abrirCont);

            $mascara= "../../cursos/$selectCurso/Aulas/*.txt";
            array_map("unlink",glob($mascara));

            for ($i=0; $i < count($aulasComp); $i++) {
                $qtdAula += 1;
                $aula = explode('-.-',$aulasComp[$i]);

                if ($aula[1] == 'questao') {
                    $questao += 1;
                    array_push($fases,"Questão $questao");
                } else {
                    array_push($fases,"$aula[2]");
                }
                
                $aulas = "../../cursos/$selectCurso/Aulas/fase " . $i+1 .".txt";
                $abrirAula = fopen($aulas,"w");

                if ($aula[1] == 'material') {
                    fwrite($abrirAula,"$aula[1]\n\n$aula[2]");
                    $textA = explode('☺',$aula[3]);
                    for ($t=0; $t < count($textA); $t++) {
                        fwrite($abrirAula,"\n$textA[$t]");
                    }
                } elseif ($aula[1] == 'video') {
                    fwrite($abrirAula,"$aula[1]\n\n$aula[2]\n$aula[3]");
                    $textA = explode('☺',$aula[4]);
                    for ($t=0; $t < count($textA); $t++) {
                        fwrite($abrirAula,"\n$textA[$t]");
                    }
                } elseif ($aula[2] == 'alternativa') {
                    $resposta =  array_reverse($aula);
                    fwrite($abrirAula,"$aula[1]\n\n$aula[2]\nQUESTÃO $questao\n$aula[3]");
                    fwrite($abrirAula,"\nResposta: " . $resposta[0]);
                    for ($a=1; $a < count($aula); $a++) { 
                        if ($a > 4 and $a + 1 != count($aula)) {
                            fwrite($abrirAula,"\n$aula[$a]");
                        }
                    }
                } elseif ($aula[2] == 'Mescolha') {
                    $resposta =  array_reverse($aula);
                    fwrite($abrirAula,"$aula[1]\n\n$aula[2]\nQUESTÃO $questao\n$aula[3]");
                    fwrite($abrirAula,"\nResposta: " . $resposta[0]);
                    for ($a=1; $a < count($aula); $a++) { 
                        echo "$aula[$a] ";
                        if ($a > 4 and $a + 1 != count($aula)) {
                            fwrite($abrirAula,"\n$aula[$a]");
                        }
                    }
                } elseif ($aula[2] == 'botao') {
                    $resposta =  array_reverse($aula);
                    fwrite($abrirAula,"$aula[1]\n\n$aula[2]\nQUESTÃO $questao\n$aula[3]");
                    fwrite($abrirAula,"\nResposta: " . $resposta[0]);
                    for ($a=1; $a < count($aula); $a++) { 
                        if ($a > 4 and $a + 1 != count($aula)) {
                            fwrite($abrirAula,"\n$aula[$a]");
                        }
                    }
                }

                fclose($abrirAula);
            }

            $carga = $_POST['carga'];
            $fases = implode('._.\n',$fases);
            $sql -> query(
                "UPDATE curso SET
                    `fase` = '$qtdAula',
                    `duracao` = '$carga',
                    `fases` = '$fases'
                WHERE linguagem = '$selectCurso'");

            echo "<h1>Curso adicionado com sucesso!</h1>";
            // header("Refresh: 2; ../perfil.php");
        ?>
    </div>
</body>
</html>