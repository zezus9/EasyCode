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
                    fwrite($abrirAula,"$aula[1]\n\n$aula[2]\n$aula[4]");
                    $textA = explode('☺',$aula[3]);
                    for ($t=0; $t < count($textA); $t++) {
                        fwrite($abrirAula,"\n$textA[$t]");
                    }
                } elseif ($aula[2] == 'alternativa') {
                    for ($a=1; $a < count($aula); $a++) { 
                        if ($a == 1) {
                            fwrite($abrirAula,"$aula[$a]\n");
                        } elseif ($a == 0) {
                            fwrite($abrirAula,"\n");
                        } elseif ($a == 4) {
                            fwrite($abrirAula,"\nQUESTÃO $questao");
                        } elseif ($a + 1 == count($aula)) {
                            fwrite($abrirAula,"\nResposta: $aula[$a]");
                        } else {
                            fwrite($abrirAula,"\n$aula[$a]");
                        }
                    }
                } elseif ($aula[2] == 'Mescolha') {
                    for ($a=1; $a < count($aula); $a++) { 
                        if ($a == 1) {
                            fwrite($abrirAula,"$aula[$a]\n");
                        } elseif ($a == 0) {
                            fwrite($abrirAula,"\n");
                        } elseif ($a == 4) {
                            fwrite($abrirAula,"\nQUESTÃO $questao");
                        } elseif ($a + 1 == count($aula)) {
                            fwrite($abrirAula,"\nResposta: $aula[$a]");
                        } else {
                            fwrite($abrirAula,"\n$aula[$a]");
                        }
                    }
                } elseif ($aula[2] == 'botao') {
                    for ($a=1; $a < count($aula); $a++) { 
                        if ($a == 1) {
                            fwrite($abrirAula,"$aula[1]\n");
                        } elseif ($a == 0) {
                            fwrite($abrirAula,"\n");
                        } elseif ($a == 4) {
                            fwrite($abrirAula,"\nQUESTÃO $questao");
                        } elseif ($a + 1 == count($aula)) {
                            fwrite($abrirAula,"\nResposta: $aula[$a]");
                        } else {
                            fwrite($abrirAula,"\n$aula[$a]");
                        }
                    }
                }

                fclose($abrirAula);
            }

            $carga = $_POST['carga'];
            $fases = implode('\n',$fases);
            $sql -> query(
                "UPDATE curso SET
                    `duracao` = '$carga',
                    `fases` = '$fases'
                WHERE linguagem = '$selectCurso'");

            echo "<h1>Curso adicionado com sucesso!</h1>";
            header("Refresh: 2; ../perfil.php");
        ?>
    </div>
</body>
</html>